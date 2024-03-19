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
     
         // Upload da imagem
         try {
             if ($request->hasFile('image') && $request->file('image')->isValid()) {
                 $imagePath = $request->file('image')->store("quarterlyResult/images", 'public');
             } else {
                 throw new \Exception('Imagem inválida.');
             }
         } catch (\Exception $e) {
             Log::error('Erro ao fazer upload da imagem: ' . $e->getMessage());
             return redirect()->back()->with('error', 'Erro ao fazer upload da imagem. Por favor, tente novamente.');
         }
     
         // Upload do PDF
         try {
             if ($request->hasFile('pdf') && $request->file('pdf')->isValid()) {
                 $pdfPath = $request->file('pdf')->store("quarterlyResult/pdfs", 'public');
             } else {
                 throw new \Exception('PDF inválido.');
             }
         } catch (\Exception $e) {
             Log::error('Erro ao fazer upload do PDF: ' . $e->getMessage());
             return redirect()->back()->with('error', 'Erro ao fazer upload do PDF. Por favor, tente novamente.');
         }
     
         // Salvar os dados no banco de dados
         try {
             $result = QuarterlyResult::create([
                 'image' => $imagePath,
                 'pdf' => $pdfPath,
             ]);
             Log::info('Dados salvos com sucesso: ' . print_r($result->toArray(), true));
             return redirect()->back()->with('success', 'Cadastrado com sucesso!!');
         } catch (\Exception $e) {
             Log::error('Erro ao salvar dados no banco de dados: ' . $e->getMessage());
             return redirect()->back()->with('error', 'Erro ao cadastrar. Por favor, tente novamente.');
         }
     }
}
