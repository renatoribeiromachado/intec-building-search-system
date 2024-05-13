<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MensalResult;
use Illuminate\Support\Facades\Storage;


class MensalResultController extends Controller
{
    protected $mensalResult;

    public function __construct(
        MensalResult $mensalResult
    ) {
        $this->mensalResult = $mensalResult;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $mensalResults = $this->mensalResult->get();

        return view('layouts.mensalResults.index', compact(
            'mensalResults'
        ));
    }

    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */


    public function store(Request $request)
    {
        $data = $request->all();
        $this->mensalResult->create($data);

        return redirect()->back()->with('success', 'Cadastrado com sucesso!!');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePhaseRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {

        if (!$mensalResult = $this->mensalResult->find($request->id)) {
            return redirect()->back();
        }

        $data = $request->all();
        $mensalResult->update($data);

        return redirect()->back()->with('success', 'Atualizado com sucesso!!');
    }


}
