<?php

namespace App\Http\Controllers;

use App\Models\Associate;
use Illuminate\Http\Request;
use App\Models\Sig;
use Illuminate\Support\Facades\Auth;

class SigController extends Controller
{
    protected $sig;

    public function __construct(
        Sig $sig
    ) {
        $this->sig = $sig;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $statuses = Sig::STATUSES;
        $priorities = Sig::PRIORITIES;
        $authUser = Auth::user();
        $associates = [];

        if ($this->userIsAssociate()) {
            $associates = $authUser->contact->company->contacts();

            if ($authUser->role->slug == Associate::ASSOCIATE_MANAGER) {
                $associates = $associates->whereHas('user');
            }
    
            if ($authUser->role->slug == Associate::ASSOCIATE_USER) {
                $associates = $associates->whereHas('user', function ($q) use ($authUser) {
                        return $q->where('users.id', $authUser->id);
                    });
            }

            $associates = $associates
                ->orderBy('contacts.name', 'asc')
                ->get();
        }

        return view('layouts.sig_works.index', compact(
            'statuses',
            'priorities',
            'associates',
        ));
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreWorkRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $authUser = Auth::user();
        $theUserCanRegistrySig = $this->userIsAssociate();

        if (! $theUserCanRegistrySig) {
            echo "<br><a href='javascript:void(0);' onclick='history.back()'>Voltar</a><br><br>";
            die('Registro de SIG não permitido para usuários não associados.');
        }

        $sig = $this->sig;
        $sig->user_id = $authUser->id;
        $sig->work_id = $request->work_id;
        $sig->associate_id = $authUser->contact->company->associate->id;
        $sig->appointment_date = $request->appointment_date;
        $sig->priority = $request->priority;
        $sig->status = $request->status;
        $sig->notes = $request->notes;
        $sig->created_by = auth()->guard('web')->user()->id;
        $sig->updated_by = auth()->guard('web')->user()->id;
        $sig->save();

        session()->flash('success', 'Registro de SIG criado com sucesso.');

        return redirect()->back();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreWorkRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function report(Request $request)
    {
        $authUser = Auth::user();
        $query = $this->sig->select(
            'id', 'user_id', 'work_id', 'appointment_date',
            'created_at', 'priority', 'status'
        );

        if ($authUser->role->slug == Associate::ASSOCIATE_USER) {
            $query = $query->where('user_id', $authUser->id);
        }

        /*Obra*/
        $oldCode = $request->code;
        if ($oldCode) {
            $query->whereHas('work', function ($q) use ($oldCode) {
                return $q->where('works.old_code', 'like', '%'.$oldCode.'%');
            });
        }
        
        /*Prioridade*/
        $priority = $request->priority;
        if ($priority) {
            $query->where('priority', $priority);
        }
        
        /*Status*/
        $status = $request->status;
        if ($status) {
            $query->where('status', $status);
        }

        $appointmentDate = $request->appointment_date;
        if ($appointmentDate) {
            $appointmentDateUTC = \Carbon\Carbon::parse($appointmentDate);
            $query->where('appointment_date', $appointmentDateUTC);
        }

       $reporters = $request->reporters;
       if ($reporters) {
           $query->whereIn('sigs.user_id', $reporters);
       }
        
        /*Datas de cadastro*/
        $startDate = $request->start_date;
        $endDate = $request->end_date;
        if ($startDate && $endDate) {
            $query->whereBetween('created_at', [$startDate, $endDate]);
        }

        $reports = $query->get();

        return view('layouts.sig_works.report.index', [
            'reports' => $reports,
        ]);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Work  $work
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
       
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateWorkRequest  $request
     * @param  \App\Models\Work  $work
     * @return \Illuminate\Http\Response
     */
    public function update()
    {
        // return redirect()->route();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Work  $work
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        
        // return redirect()->route('');
    }

    private function userIsAssociate()
    {
        return in_array(
            Auth::user()->role->slug, [
                Associate::ASSOCIATE_MANAGER,
                Associate::ASSOCIATE_USER
            ]
        );
    }
}
