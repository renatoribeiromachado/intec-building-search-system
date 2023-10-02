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

class SigCompanyController extends Controller
{
    //protected $sig;
    protected $sigCompany;
    protected $user;

    public function __construct(
        SigCompany $sigCompany,
        User $user
    ) {
        //$this->sig = $sig;
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

        return view('layouts.sig_companies.index', compact(
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
        
        //dd($request->all());
        $authUser = Auth::user();

        try {
            DB::beginTransaction();

            $sigCompany = $this->sigCompany;
            $sigCompany->user_id = $authUser->id;
            $sigCompany->company_id = $request->company_id;
            $sigCompany->associate_id = (authUserIsAnAssociate())
                ? $authUser->contact->company->associate->id
                : null;
            $sigCompany->appointment_date = convertPtBrDateToEnDate($request->appointment_date);
            $sigCompany->priority = $request->priority;
            $sigCompany->status = $request->status;
            $sigCompany->notes = $request->notes;
            $sigCompany->created_by = auth()->guard('web')->user()->id;
            $sigCompany->updated_by = auth()->guard('web')->user()->id;
            $sigCompany->save();

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
        $query = $this->sigCompany->select(
            'id','associate_id', 'user_id', 'company_id', 'appointment_date',
            'created_at', 'priority', 'status','notes'
        );
        
        /*Se o ACL role = associado-gestora for diferentedo autenticado (false) 
         * ou não for autenticado como associado-gestora (false) authUserIsAnAssociate() 
         * vera os sigs pelo user_id autenticado
        */
        if ($authUser->role->slug == Associate::ASSOCIATE_USER || (!authUserIsAnAssociate())) 
        {
            $query = $query->where('user_id', $authUser->id);
        }

        /*Empresa*/
        $trading_name = $request->trading_name;
        if ($trading_name && $authUser->role->slug = authUserIsAnAssociate()) {
            $query->whereHas('company', function ($query) use ($trading_name) {
                $query->where('companies.trading_name', 'like', '%'.$trading_name.'%');
            });
        }
        
        /*Prioridade*/
        $priority = $request->priority;
        if ($priority && $authUser->role->slug = authUserIsAnAssociate()) {
            $query->where(function ($query) use ($priority) {
                $query->where('priority', $priority);
            });
        }
        
        /*Status*/
        $status = $request->status;
        if ($status && $authUser->role->slug = authUserIsAnAssociate()) {
            $query->where(function ($query) use ($status) {
                $query->where('status', $status);
            });
        }
        
        /*Data de agendamento*/
        $appointmentDate = $request->appointment_date;
        if ($appointmentDate && $authUser->role->slug = authUserIsAnAssociate()) {
            $appointmentDateUTC = \Carbon\Carbon::createFromFormat('d/m/Y', $appointmentDate)->startOfDay();
            $query->where(function ($query) use ($appointmentDateUTC) {
                $query->where('appointment_date', $appointmentDateUTC);
            });
        }
        
        /*Usuarios*/
        $reporters = $request->reporters;
        if ($reporters) {
            $query->whereIn('user_id', $reporters);
        }

        /* Data de cadastro */
        $start_date = $request->input('start_date');
        $end_date = $request->input('end_date');

        if ($start_date && $end_date && $authUser->role->slug = authUserIsAnAssociate()) {
            $start_date = Carbon::createFromFormat('d/m/Y', $start_date)->format('Y-m-d');
            $end_date = Carbon::createFromFormat('d/m/Y', $end_date)->format('Y-m-d');
            $query->whereBetween('created_at', [$start_date, $end_date]);
        }
        
        /*Descrição*/
//        $notes = $request->notes;
//        if ($notes) {
//            $query->where(function ($q) use ($notes, $authUser) {
//                return $q->where('notes', 'like', '%'.$notes.'%')
//                        ->where('user_id', $authUser->id);
//            });
//        }

        /*Associdao pode ver todos da empresa*/
//        if($this->sigCompany->associate_id == null){
//          $reports = $query->where('user_id', $authUser->id)->get();  
//        }else{
//            $reports = $query->where('associate_id', $authUser->contact->company->associate->id)->get();
//        }
        
        /*Associado Gestor pode ver todos usuarios da empresa a que pertence*/
        if($authUser->role->slug == Associate::ASSOCIATE_USER || (! authUserIsAnAssociate())){
          $reports = $query->get();  
        }else{
            $reports = $query->where('associate_id', $authUser->contact->company->associate->id)->get();
        }

        return view('layouts.sig_companies.report.index', [
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

        if (!$sig = $this->sigCompany->find($request->id)) {
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
        if (!$sig = $this->sigCompany->find($id)) {
            return redirect()->back();
        }

        $sig->delete();
        session()->flash('success', 'Deletado com sucesso.');

        return redirect()->back();
    }
}
