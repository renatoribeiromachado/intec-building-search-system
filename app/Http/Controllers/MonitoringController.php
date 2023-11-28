<?php

namespace App\Http\Controllers;
//use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Associate;
use Illuminate\Support\Facades\Auth;
use App\Models\LoginHistory;

class MonitoringController extends Controller
{
   
    protected $loginHistory;
    protected $associate;

    public function __construct(LoginHistory $loginHistory, Associate $associate) 
    {
        $this->loginHistory = $loginHistory;
        $this->associate = $associate;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $monitorings = $this->loginHistory->whereNotNull('associate_id')->orderBy('created_at','desc')->paginate(20);

        return view('layouts.monitoring.index', compact('monitorings'));
    } 
    
    /*Pesquisa por id associado*/
    public function search(Request $request)
    {
        $associate = $this->associate->where('old_code', $request->code)->orderBy('created_at','desc')->first();

        if ($associate) {
            $associateId = $associate->id;
            //$monitoring = $this->loginHistory->where('associate_id', $associateId)->get();
            $monitoring = $this->loginHistory->where('associate_id', $associateId)->whereNotNull('associate_id')->orderBy('created_at','desc')->get();

            return view('layouts.monitoring.search', compact('monitoring'));
        } else {
            return redirect()->back()->with('error', 'Desculpa, Associado não encontrado.');
        }
    }
    
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function gestor()
    {
        $authUser = Auth::user();

        if (authUserIsAnAssociate()) {
            $associateId = $this->associate
                ->where('company_id', $authUser->contact->company->id)
                ->value('id');

            // Adicione esta linha para depuração
            //dd($associateId);

            // Consulta à tabela login_histories diretamente pelo ID do associado
            $monitorings = $this->loginHistory
                ->where('associate_id', $associateId)
                ->orderBy('created_at', 'desc')
                ->paginate(20);
        } else {
            $monitorings = collect(); // Empty collection for non-associates.
        }

        return view('layouts.monitoring_gestor.index', compact('monitorings'));
    }
    
    /*Pesquisa por usuario*/
    public function searchGestor(Request $request)
    {
        $monitoring = $this->loginHistory->where('user_id', $request->user_id)->orderBy('created_at','desc')->paginate(20);
        return view('layouts.monitoring_gestor.search', compact('monitoring'));
  
    }
   

}
