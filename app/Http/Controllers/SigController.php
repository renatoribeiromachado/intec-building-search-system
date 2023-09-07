<?php

namespace App\Http\Controllers;

use App\Models\Associate;
use Illuminate\Http\Request;
use App\Models\Sig;
use App\Models\SigCompany;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class SigController extends Controller
{
    protected $sig;
    protected $sigCompany;
    protected $user;

    public function __construct(Sig $sig, SigCompany $sigCompany, User $user) 
    {
        $this->sig = $sig;
        $this->sigCompany = $sigCompany;
        $this->user = $user;

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

        if (! authUserIsAnAssociate()) {
            $associates = $this->user->where('id', $authUser->id)->get();
        }

        if (authUserIsAnAssociate()) {
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
        $associated = $authUser->contact->company->associate->id;

        return view('layouts.sig_works.index', compact(
            'statuses',
            'priorities',
            'associates',
            'associated'
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

        try {
            DB::beginTransaction();

            $sig = $this->sig;
            $sig->user_id = $authUser->id;
            $sig->work_id = $request->work_id;
            $sig->associate_id = (authUserIsAnAssociate())
                ? $authUser->contact->company->associate->id
                : null;
            $sig->appointment_date = convertPtBrDateToEnDate($request->appointment_date);
            $sig->priority = $request->priority;
            $sig->status = $request->status;
            $sig->notes = $request->notes;
            $sig->created_by = auth()->guard('web')->user()->id;
            $sig->updated_by = auth()->guard('web')->user()->id;
            $sig->save();

            DB::commit();

        } catch (Exception $ex) {

            DB::rollBack();

            return redirect()->back()
                ->withInput($request->all())
                ->withErrors(['error' => $ex->getMessage()]);
        }

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
        $statuses = Sig::STATUSES;
        $priorities = Sig::PRIORITIES;
        $authUser = Auth::user();
        $query = $this->sig->select(
            'id','associate_id','user_id', 'work_id', 'appointment_date',
            'created_at', 'priority', 'status','notes'
        );

        if (
            $authUser->role->slug == Associate::ASSOCIATE_USER
            || (! authUserIsAnAssociate())
        ) {
            $query = $query->where('user_id', $authUser->id);
        }

        /*Obra*/
        $oldCode = $request->code;
        if ($oldCode) {
            $query->whereHas('work', function ($q) use ($oldCode, $authUser) {
                return $q->where('works.old_code', 'like', '%'.$oldCode.'%')
                        ->where('user_id', $authUser->id);
            });
        }
        
        /*Prioridade*/
        $priority = $request->priority;
        if ($priority) {
            $query->where(function ($query) use ($priority, $authUser) {
                $query->where('priority', $priority)
                        ->where('user_id', $authUser->id);
            });
        }
        
        /*Status*/
        $status = $request->status;
        if ($status) {
             $query->where(function ($query) use ($status, $authUser) {
                $query->where('status', $status)
                        ->where('user_id', $authUser->id);
            });
        }
        
        /*Data de agendamento*/
        $appointmentDate = $request->appointment_date;
        if ($appointmentDate) {
            $appointmentDateUTC = \Carbon\Carbon::createFromFormat('d/m/Y', $appointmentDate)->startOfDay();
            $query->where(function ($query) use ($appointmentDateUTC, $authUser) {
                $query->where('appointment_date', $appointmentDateUTC)
                      ->where('user_id', $authUser->id);
            });
        }
        
        $reporters = $request->reporters;
        if ($reporters) {
            $query->whereIn('sigs.user_id', $reporters);
        }
       
        /* Data de cadastro */
        $start_date = $request->input('start_date');
        $end_date = $request->input('end_date');

        if ($start_date && $end_date) {
            $start_date = Carbon::createFromFormat('d/m/Y', $start_date)->format('Y-m-d');
            $end_date = Carbon::createFromFormat('d/m/Y', $end_date)->format('Y-m-d');

            $query->whereBetween('created_at', [$start_date, $end_date])
                   ->where('user_id', $authUser->id);
        }
        
        /*Descrição*/
        $notes = $request->notes;
        if ($notes) {
            $query->where(function ($q) use ($notes, $authUser) {
                return $q->where('notes', 'like', '%'.$notes.'%')
                        ->where('user_id', $authUser->id);
            });
        }

        /*Associdao pode ver todos da empresa*/
        $reports = $query->where('associate_id', $authUser->contact->company->associate->id)->get();

        return view('layouts.sig_works.report.index', [
            'reports' => $reports,
            'statuses' => $statuses,
            'priorities' => $priorities
        ]);
    }
    
    /**
     * Update register by id
     *
     * @param  \App\Http\Requests\StoreUpdateProduct  $request
     * @param  int  $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $formattedAppointmentDate = \Carbon\Carbon::createFromFormat('d/m/Y', $request->appointment_date)->format('Y-m-d');

        $data = $request->all();
        
        $data['appointment_date'] = $formattedAppointmentDate;

        if (!$sig = $this->sig->find($request->id)) {
            return redirect()->back();
        }

        $sig->update($data);

        session()->flash('success', 'Editado com sucesso.');

        return redirect()->back();
    }

    
     /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (!$sig = $this->sig->find($id)) {
            return redirect()->back();
        }

        $sig->delete();
        session()->flash('success', 'Deletado com sucesso.');

        return redirect()->back();
    }
}
