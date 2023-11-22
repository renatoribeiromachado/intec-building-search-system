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
            $query->whereHas('company', function ($query) use ($trading_name,$authUser) {
                $query->where('companies.trading_name', 'like', '%'.$trading_name.'%')
                        ->where('associate_id', $authUser->contact->company->associate->id);
            });
        }
        
        /*Prioridade*/
        $priority = $request->priority;
        if ($priority && $authUser->role->slug = authUserIsAnAssociate()) {
            $query->where(function ($query) use ($priority,$authUser) {
                $query->where('priority', $priority)
                        ->where('associate_id', $authUser->contact->company->associate->id);
            });
        }
        
        /*Status*/
        $status = $request->status;
        if ($status && $authUser->role->slug = authUserIsAnAssociate()) {
            $query->where(function ($query) use ($status,$authUser) {
                $query->where('status', $status)
                        ->where('associate_id', $authUser->contact->company->associate->id);
            });
        }
        
        /*Data de agendamento*/
        $appointmentDate = $request->appointment_date;
        if ($appointmentDate && $authUser->role->slug = authUserIsAnAssociate()) {
            $appointmentDateUTC = \Carbon\Carbon::createFromFormat('d/m/Y', $appointmentDate)->startOfDay();
            $query->where(function ($query) use ($appointmentDateUTC,$authUser) {
                $query->where('appointment_date', $appointmentDateUTC)
                        ->where('associate_id', $authUser->contact->company->associate->id);
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
            $query->whereBetween('created_at', [$start_date, $end_date])
                    ->where('associate_id', $authUser->contact->company->associate->id);
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
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreWorkRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function summary(Request $request)
    {

        $authUser = Auth::user();
        //dd($authUser->contact->company->associate->id);
        $query = $this->sigCompany->select(
            'id','associate_id','user_id', 'company_id', 'appointment_date',
            'created_at', 'priority', 'status','notes'
        );
        
        /*Se o ACL role = associado-gestora for diferentedo autenticado (false) 
         * ou não for autenticado como associado-gestora (false) authUserIsAnAssociate() 
         * vera os sigs pelo user_id autenticado
        */
        if ($authUser->role->slug == Associate::ASSOCIATE_USER || (! authUserIsAnAssociate())) {
            $query = $query->where('user_id', $authUser->id);
        }
        
        /*Usuarios*/
        $reporters = $request->reporters;
        if ($reporters) {
            $query->whereIn('sig_companies.user_id', $reporters);
        }

        $reports = null;

        if ($authUser->contact && $authUser->contact->company && $authUser->contact->company->associate) {
            $reports = $query->where('associate_id', $authUser->contact->company->associate->id)->get();
        } else {
            $reports = $query->get();
        }

        $statusCounts = [];
        
        $priorityFilter = $request->priority;
        $appointmentDateFilter = $request->appointment_date;
        $statusFilter = $request->status; 
        $startDate = !empty($startDate) ? Carbon::createFromFormat('d/m/Y', $startDate)->startOfDay() : null;
        $endDate = !empty($endDate) ? Carbon::createFromFormat('d/m/Y', $endDate)->endOfDay() : null;

        foreach ($reports as $report) {
            $id = $report->id;
            $status = $report->status;
            $userId = $report->user_id;
            $company = $report->company;
            $userName = $report->user->name;
            $appointmentDate = Carbon::parse($report->appointment_date);
            $createdDate = Carbon::parse($report->created_at);
            $notes = $report->notes;
            $priority = $report->priority;

            // Converta a data de agendamento do relatório para o formato Y-m-d
            $appointmentDateFormatted = $appointmentDate->format('Y-m-d');
            $appointmentDateFormattedFilter = !empty($appointmentDateFilter) ? Carbon::createFromFormat('d/m/Y', $appointmentDateFilter)->format('Y-m-d') : null;

            // Verifique se a prioridade, a data de agendamento, o status e as datas de criação correspondem
            if (
                ($priority == $priorityFilter || empty($priorityFilter)) &&
                (is_null($appointmentDateFormattedFilter) || $appointmentDateFormatted === $appointmentDateFormattedFilter || empty($appointmentDateFilter)) &&
                ($status == $statusFilter || empty($statusFilter)) &&
                (
                    (is_null($startDate) && is_null($endDate)) || // Se ambas as datas de início e término estiverem vazias, não filtrar por data de criação
                    (
                        (is_null($startDate) || $createdDate >= $startDate) && // Verifica a data de início, se fornecida
                        (is_null($endDate) || $createdDate <= $endDate) // Verifica a data de término, se fornecida
                    )
                )
            ) {
                if (!isset($statusCounts[$userId])) {
                    $statusCounts[$userId] = [
                        'user_name' => $userName,
                        'appointments' => [],
                    ];
                }

                if (!isset($statusCounts[$userId]['appointments'][$appointmentDateFormatted])) {
                    $statusCounts[$userId]['appointments'][$appointmentDateFormatted] = [
                        'status' => [],
                        'company_ids' => [],
                        'company_notes' => [], // Incluímos um array para armazenar as notas.
                        'ids' => [], // Incluímos um array para armazenar os IDs dos relatórios.
                    ];
                }

                if (!isset($statusCounts[$userId]['appointments'][$appointmentDateFormatted]['status'][$status])) {
                    $statusCounts[$userId]['appointments'][$appointmentDateFormatted]['status'][$status] = 1;
                } else {
                    $statusCounts[$userId]['appointments'][$appointmentDateFormatted]['status'][$status]++;
                }

                // Adicione o ID do relatório à lista associada a esta data de agendamento e status.
                $statusCounts[$userId]['appointments'][$appointmentDateFormatted]['ids'][$status][] = $id;

                if ($company && isset($company->company_name)) {
                    $companyId = $company->company_name;
                    $statusCounts[$userId]['appointments'][$appointmentDateFormatted]['company_ids'][$status][] = $companyId;
                } else {
                    // Se não existir $work->old_code, adicione uma entrada indicando isso.
                    $statusCounts[$userId]['appointments'][$appointmentDateFormatted]['company_ids'][$status][] = 'Empresa deletada da plataforma';
                }

                // Adicione as notas à lista associada a esta data de agendamento e status.
                $statusCounts[$userId]['appointments'][$appointmentDateFormatted]['company_notes'][$status][] = $notes;
            }
        }


        /*Associado Gestor pode ver todos usuarios da empresa a que pertence*/
        if($authUser->role->slug == Associate::ASSOCIATE_USER || (! authUserIsAnAssociate())){
          $reports = $query->get();  
        }else{
            $reports = $query->where('associate_id', $authUser->contact->company->associate->id)->get();
        }

        return view('layouts.sig_companies.report.summary', [
            'reports' => $reports,
            'statusCounts' => $statusCounts
        ]);
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
