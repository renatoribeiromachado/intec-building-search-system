<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Popup;


class PopupController extends Controller
{
    protected $permission;

    public function __construct(
        Popup $popup
    ) {
        $this->popup = $popup;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $popup = $this->popup->get();

        return view('layouts.popup.index', compact(
            'popup'
        ));
    }

    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //dd($request->all());
       if (!$popup = $this->popup->find($id)) {
            return redirect()->back();
        }

        $data = $request->all();

        $popup->update($data);

        return redirect()->back()->with('success', 'Atualizado com sucesso!!');
    }
}
