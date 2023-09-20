<?php

namespace App\Http\Controllers;

use App\Models\Associate;
use Illuminate\Http\Request;
use App\Models\Sig;
use App\Models\SigAssociate;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class SigAssociateController extends Controller
{
    protected $sigAssociate;
    protected $user;

    public function __construct(
        SigAssociate $sigAssociate,
        User $user
    ) {
        $this->sigAssociate = $sigAssociate;
        $this->user = $user;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $associates = $this->sigAssociate->get();

        return view('layouts.sig_associate.index', compact(
            'associates',
        ));
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreWorkRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        //dd($request->all());
        $authUser = Auth::user();

//        try {
//            DB::beginTransaction();
//
//            $sigAssociate = $this->sigAssociate;
//            $sigAssociate->user_id = $authUser->id;
//            $sigAssociate->code_associate = $request->code_associate;
//            $sigAssociate->appointment_date = convertPtBrDateToEnDate($request->appointment_date);
//            $sigAssociate->notes = $request->notes;
//            $sigAssociate->save();
//
//            DB::commit();
//
//        } catch (Exception $ex) {
//
//            DB::rollBack();
//
//            return redirect()->back()
//                ->withInput($request->all())
//                ->withErrors(['error' => $ex->getMessage()]);
//        }
        
        $data = [
            'user_id' => $authUser->id,
            'code_associate' => $request->code_associate,
            'appointment_date' => convertPtBrDateToEnDate($request->appointment_date),
            'notes' => $request->notes
        ];
        
        $this->sigAssociate->create($data);
        
        session()->flash('success', 'Registro de SIG criado com sucesso.');

        return redirect()->back();
    }

    
    /**
     * Update register by id
     *
     * @param  \App\Http\Requests\StoreUpdateProduct  $request
     * @param  int  $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $formattedAppointmentDate = \Carbon\Carbon::createFromFormat('d/m/Y', $request->appointment_date)->format('Y-m-d');

        $data = $request->all();
        
        $data['appointment_date'] = $formattedAppointmentDate;

        if (!$sigAssociate = $this->sigAssociate->find($request->id)) {
            return redirect()->back();
        }

        $sigAssociate->update($data);

        session()->flash('success', 'Editado com sucesso.');

        return redirect()->back();
    }

    
     /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (!$sigAssociate = $this->sigAssociate->find($id)) {
            return redirect()->back();
        }

        $sigAssociate->delete();
        session()->flash('success', 'Deletado com sucesso.');

        return redirect()->back();
    }
}
