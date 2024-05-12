<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KnowMore;
use Illuminate\Support\Facades\Storage;

class KnowMoreController extends Controller
{
    protected $know;

    public function __construct(
        KnowMore $know
    ) {
        $this->know = $know;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $knows = $this->know->get();

        return view('layouts.knowMore.index', compact(
            'knows'
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
        // Validação dos campos
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Upload da imagem
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store("knoMore", 'public');
            $data['image'] = $imagePath;
        }

        // Salvar os dados no banco de dados
        KnowMore::create($data);

        return redirect()->back()->with('success', 'Cadastrado com sucesso!!');
    }

 /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        return view('layouts.knowMore.edit', compact('phase'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePhaseRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {

        if (!$know = $this->know->find($request->id)) {
            return redirect()->back();
        }

        // Verifica se uma nova imagem foi enviada
        if ($request->hasFile('image')) {
            // Se sim, exclui a imagem existente, se houver
            if ($know->image) {
                // Certifique-se de excluir o arquivo real do armazenamento, por exemplo, usando o método Storage::delete()
                Storage::delete($know->image);
            }

            // Salva a nova imagem e atualiza o caminho no banco de dados
            $imagePath = $request->file('image')->store("knowMore", 'public');
            $know->image = $imagePath; // Atualiza o caminho da imagem no modelo
        }

        // Atualiza os outros dados
        $know->title = $request->title;
        $know->description = $request->description;
        $know->save();

        return redirect()->back()->with('success', 'Atualizado com sucesso!!');
    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Phase  $phase
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $know = $this->know->find($id);
        
        if (!$know = $this->know->find($id)) {
            return redirect()->back();
        }
        
        if (Storage::exists($know->image)) {
            Storage::delete($know->image);
        }

        $know->delete();
        
        return redirect()->back()->with('success', 'Deletado com sucesso!!');

    }
}

