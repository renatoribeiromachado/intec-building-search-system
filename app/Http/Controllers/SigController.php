<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Sig;
use Illuminate\Support\Carbon;
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
