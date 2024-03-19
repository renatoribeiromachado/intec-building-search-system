<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\QuarterlyResult;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;


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
            'pdf' => 'required|mimes:pdf|max:2048',
        ]);

        // Cria um novo objeto QuarterlyResult
        $quarterlyResult = new QuarterlyResult();

        // Aplica o upload da imagem
        $this->applyImageUpload($request, $quarterlyResult);

        // Upload do PDF
        if ($request->hasFile('pdf')) {
            $pdfPath = $request->file('pdf')->store("quarterlyResult", 'public');
            $quarterlyResult->pdf = $pdfPath;
        }

        // Salvar os dados no banco de dados
        try {
            $quarterlyResult->save();
            return redirect()->back()->with('success', 'Cadastrado com sucesso!!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Erro ao cadastrar. Por favor, tente novamente.');
        }
    }



    private function applyImageUpload(Request $request, QuarterlyResult $quarterlyResult): void
    {
        // Verifica se o arquivo de imagem está presente no request
        if ($request->hasFile('image')) {
            
            // Obtém o arquivo de imagem do request
            $file = $request->file('image');
            
            // Gera um nome aleatório para o arquivo
            $fileName = uniqid() . '_' . time() . '.' . $file->getClientOriginalExtension();
            
            // Define o diretório de armazenamento
            $directory = 'quarterlyResult/images';
            
            // Armazena a imagem no diretório especificado
            $uploadedImage = $file->storeAs($directory, $fileName, 'public');
            
            // Verifica se o upload foi bem-sucedido
            if ($uploadedImage) {
                // Atualiza os campos do modelo com os caminhos de armazenamento
                $quarterlyResult->storage_image_link = $directory . '/' . $fileName;
                $quarterlyResult->public_image_link = Storage::url($directory . '/' . $fileName);
                // Salva as alterações no banco de dados
                $quarterlyResult->save();
            }
        }
    }

}
