<?php

namespace App\Http\Controllers;
//use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Associate;

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

//        $monitorings = $this->loginHistory->select('user_id', 
//                DB::raw('MAX(associate_id) as associate_id'), 
//                DB::raw('MAX(user_id) as user_id'),
//                DB::raw('MAX(ip) as ip'),
//                DB::raw('MAX(user_agent) as user_agent'),
//                DB::raw('MAX(created_at) as created_at'),
//                DB::raw('COUNT(*) as total'))
//        ->groupBy('user_id')
//        ->get();
        $monitorings = $this->loginHistory->whereNotNull('associate_id')->paginate(20);

        return view('layouts.monitoring.index', compact('monitorings'));
    } 
    
    /*Pesquisa por id associado*/
    public function search(Request $request)
    {
        $associate = $this->associate->where('old_code', $request->code)->first();

        if ($associate) {
            $associateId = $associate->id;
            //$monitoring = $this->loginHistory->where('associate_id', $associateId)->get();
            $monitoring = $this->loginHistory->where('associate_id', $associateId)->whereNotNull('associate_id')->get();

            return view('layouts.monitoring.search', compact('monitoring'));
        } else {
            return redirect()->back()->with('error', 'Desculpa, Associado não encontrado.');
        }
    }

}
