<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Permission;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PermissionsController extends Controller
{

    protected $permission;

    public function __construct(
        Permission $permission
    )
    {
        $this->permission = $permission;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('ver-funcao-administrativa');

        $permission = $this->permission;
        
        $permissions = $this->permission
            ->orderBy('id', 'asc')
            ->paginate(50);

        // if(Auth::user()->role->name != 'Webmaster') {
            
        //     $permissions = $this->permission
        //                             ->whereNotIn('id', [
        //                                     4, 5, 6, 7, 8, 9, // Roles
        //                                 10, 11, 12, 13, 14, 15, // Permissions
        //                                 16, 17, 18, 19, 20, 21, 22, // Person
        //                             ])
        //                             ->orderBy('id', 'desc')->paginate(20);
        // }

        // if(Auth::user()->role->name != 'Webmaster' && 
        //     Auth::user()->role->name != 'Administrador') {

        //     $permissions = $this->permission
        //                             ->whereNotIn('id', [
        //                                 4, 5, 6, 7, 8, 9, // Roles
        //                                 10, 11, 12, 13, 14, 15, // Permissions
        //                                 16, 17, 18, 19, 20, 21, 22, // Person
        //                                 24, 25,
        //                             ])
        //                             ->orderBy('id', 'desc')->paginate(20);
        // }

        return view('layouts.settings.permission.index', compact(
            'permissions',
            'permission',
        ));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {

            DB::beginTransaction();

            $permission = $this->permission;
            $permission->name = $request->name;
            $permission->slug = Str::slug($request->name);
            $permission->save();

            DB::commit();

        } catch(Exception $ex) {

            DB::rollBack();

            return redirect()->back()
                ->withInput($request->all())
                ->withErrors(['message' => $ex->getMessage()]);
            
        }

        session()->flash('success', 'Permissão criada.');

        return redirect()->back();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Permission $permission)
    {
        try {

            DB::beginTransaction();

            $permission->name = $request->name;
            $permission->slug = Str::slug($request->name);
            $permission->save();

            DB::commit();

        } catch(Exception $ex) {

            DB::rollBack();

            return redirect()->back()
                ->withInput($request->all())
                ->withErrors(['message' => $ex->getMessage()]);
            
        }

        session()->flash('success', 'Permissão atualizada.');

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Permission $permission)
    {
        try {

            DB::beginTransaction();

            $permission->delete();

            DB::commit();

        } catch(Exception $ex) {

            DB::rollBack();

            return redirect()->back()
                ->withInput($request->all())
                ->withErrors(['message' => $ex->getMessage()]);
            
        }

        session()->flash('success', 'Permissão excluída.');

        return redirect()->back();

        // $route = route('permission.undo', ['permission' => $permission]);
        // $permission->delete();

        // return redirect()->back()
        //     ->with('success',  'A permissão <strong>' . $permission->name . '</strong> foi deletada!' . undoLink($route));
    }

    public function undo(Request $request)
    {
        $permission = $this->permission->onlyTrashed()->where('uuid', $request->permission)->firstOrFail();
        $permission->restore();
        return redirect()->back()->with('success', 'Exclusão desfeita!');
    }
}
