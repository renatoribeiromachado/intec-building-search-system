<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KnowMore;

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

}
