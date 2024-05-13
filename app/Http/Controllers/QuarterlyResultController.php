<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\QuarterlyResult;
use Illuminate\Support\Facades\Storage;


class QuarterlyResultController extends Controller
{
    protected $quarterlyResult;

    public function __construct(
        QuarterlyResult $quarterlyResult
    ) {
        $this->quarterlyResult = $quarterlyResult;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $quarterlyResults = $this->quarterlyResult->get();

        return view('layouts.quarterlyResults.index', compact(
            'quarterlyResults'
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
        // Validação dos campos
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            //'pdf' => 'required|mimes:pdf|max:2048',
        ]);

        // Upload da imagem
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store("quarterlyResult", 'public');
            $data['image'] = $imagePath;
        }

        // Upload do PDF
        if ($request->hasFile('pdf')) {
            $pdfPath = $request->file('pdf')->store("quarterlyResult", 'public');
            $data['pdf'] = $pdfPath;
        }

        // Salvar os dados no banco de dados
        QuarterlyResult::create($data);

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

        if (!$quarterlyResult = $this->quarterlyResult->find($request->id)) {
            return redirect()->back();
        }

        // Verifica se uma nova imagem foi enviada
        if ($request->hasFile('image')) {
            // Se sim, exclui a imagem existente, se houver
            if ($quarterlyResult->image) {
                // Certifique-se de excluir o arquivo real do armazenamento, por exemplo, usando o método Storage::delete()
                Storage::delete($quarterlyResult->image);
            }

            // Salva a nova imagem e atualiza o caminho no banco de dados
            $imagePath = $request->file('image')->store("quarterlyResult", 'public');
            $quarterlyResult->image = $imagePath; // Atualiza o caminho da imagem no modelo
        }

        // Upload do PDF
        if ($request->hasFile('pdf')) {

            if ($quarterlyResult->pdf) {
                // Certifique-se de excluir o arquivo real do armazenamento, por exemplo, usando o método Storage::delete()
                Storage::delete($quarterlyResult->pdf);
            }

            $pdfPath = $request->file('pdf')->store("quarterlyResult", 'public');
            $quarterlyResult->pdf = $pdfPath;
        }


        // Atualiza os outros dados
        $quarterlyResult->save();

        return redirect()->back()->with('success', 'Atualizado com sucesso!!');
    }

}
