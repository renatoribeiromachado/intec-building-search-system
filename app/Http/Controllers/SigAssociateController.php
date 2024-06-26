<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SigAssociate;
use App\Http\Requests\StoreSigAssociateRequest;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Pagination\Paginator;
//Paginator::useBootstrap();


class SigAssociateController extends Controller
{
    protected $sigAssociate;
    protected $user;

    public function __construct(
        SigAssociate $sigAssociate,
        User $user
    ) {
        $this->sigAssociate = $sigAssociate;
        $this->user = $user;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        /// Inicialize a consulta de sig_associates
        $sig_associates = $this->sigAssociate->query();

        // Verifique e aplique a pesquisa com base no código do associado
        if (!empty($request->code_associate)) {
            $sig_associates->where('code_associate', $request->code_associate);
        }

        // Verifique e aplique a pesquisa com base no usuário repórter
        if (!empty($request->reporter)) {
            $sig_associates->where('user_id', $request->reporter);
        }
        
        if (!empty($request->appointment_date)) {
            $appointmentDateUTC = \Carbon\Carbon::createFromFormat('d/m/Y', $request->appointment_date)->startOfDay();
            $sig_associates->where('appointment_date', $appointmentDateUTC);
        }

        // Obtenha os registros paginados
        $sig_associates = $sig_associates->paginate(10);
        
        $rapporteurs = $this->sigAssociate
                                ->select('user_id', \DB::raw('MAX(id) as max_id')) // Usando MAX(id) para obter o último registro de cada grupo
                                ->groupBy('user_id')
                                ->orderBy('max_id', 'desc') // Ordenando pelo id máximo
                                ->with('user')
                                ->get();

        return view('layouts.sig_associate.index', compact(
            'sig_associates',
            'rapporteurs'
        ));
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function sigGeral()
    {
        $sig_associates = $this->sigAssociate->orderBy('id', 'desc')->paginate();

        return view('layouts.sig_associate.geral', compact(
            'sig_associates',
        ));
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreWorkRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSigAssociateRequest $request)
    {
        
        //dd($request->all());
        $authUser = Auth::user();

        $data = [
            'user_id' => $authUser->id,
            'code_associate' => $request->code_associate,
            'appointment_date' => convertPtBrDateToEnDate($request->appointment_date),
            'notes' => $request->notes
        ];
        
        $this->sigAssociate->create($data);
        
        session()->flash('success', 'Registro de SIG criado com sucesso.');

        return redirect()->back();
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
        //dd($request->all());
        $formattedAppointmentDate = \Carbon\Carbon::createFromFormat('d/m/Y', $request->appointment_date)->format('Y-m-d');

        $data = $request->all();
        
        $data['appointment_date'] = $formattedAppointmentDate;

        if (!$sigAssociate = $this->sigAssociate->find($request->id)) {
            return redirect()->back();
        }

        $sigAssociate->update($data);

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
        if (!$sigAssociate = $this->sigAssociate->find($id)) {
            return redirect()->back();
        }

        $sigAssociate->delete();
        session()->flash('success', 'Deletado com sucesso.');

        return redirect()->back();
        
        
    }
    
    
    public function search(Request $request)
    {
        
        // Inicialize a consulta de sig_associates
        $sig_associates = $this->sigAssociate->query();

        // Verifique e aplique a pesquisa com base no código do associado
        if (!empty($request->code_associate)) {
            $sig_associates->where('code_associate', $request->code_associate);
        }

        // Verifique e aplique a pesquisa com base no usuário repórter
        if (!empty($request->reporter)) {
            $sig_associates->where('user_id', $request->reporter);
        }
        
        if (!empty($request->appointment_date)) {
            $appointmentDateUTC = \Carbon\Carbon::createFromFormat('d/m/Y', $request->appointment_date)->startOfDay();
            $sig_associates->where('appointment_date', $appointmentDateUTC);
        }

        // Obtenha os registros paginados
        $sig_associates = $sig_associates->paginate(10);

        // Obtenha os raportadores
        $rapporteurs = $this->sigAssociate
            ->select('user_id', \DB::raw('MAX(id) as max_id'))
            ->groupBy('user_id')
            ->orderBy('max_id', 'desc')
            ->with('user')
            ->get();

        return view('layouts.sig_associate.index', compact('sig_associates', 'rapporteurs'));
    }

 
}
