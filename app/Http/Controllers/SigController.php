<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Sig;
use Illuminate\Support\Facades\Auth;

class SigController extends Controller
{
    protected $sig;


    public function __construct(Sig $sig) {
        $this->sig = $sig;
    
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('layouts.sig_works.index');
    }
    
     /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreWorkRequest  $request
     * @return \Illuminate\Http\Response
     */
    
    public function report(Request $request)
    {
        $user = Auth::user();
        $query = $this->sig->with('user')->where('user_id', $user->id);

        /*Obra*/
        $code = $request->code;
        if ($code) {
            $query->where('code', 'LIKE', '%' . $code . '%');
        }
        
        /*Prioridade*/
        $priority = $request->priority;
        if ($priority) {
            $query->where('priority', $priority);
        }
        
        /*Statgus*/
        $status = $request->status;
        if ($status) {
            $query->where('priority', $status);
        }

//        $reporter = $request->input('reporter');
//        if ($reporter) {
//            $query->where('reporter', 'LIKE', '%' . $reporter . '%'); 
//        }
        
        /*Datas de cadastro*/
        $startDate = $request->start_date;
        $endDate = $request->end_date;
        if ($startDate && $endDate) {
            $query->whereBetween('created_at', [$startDate, $endDate]); 
        }

        $reports = $query->get();

        return view('layouts.sig_works.report', [
            'reports' => $reports,
        ]);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreWorkRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
{
    $user = Auth::user();
    $data = $request->all();

    $data['user_email'] = $user->email;
    $data['user_id'] = $user->id;
    $this->sig->create($data);

    return redirect()->back()->with('success', 'Registro criado com sucesso.');
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
        

        return redirect()->route();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Work  $work
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        
        return redirect()->route('');
    }

    
}
