<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Permission;
use Illuminate\Support\Facades\Auth;
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
        $permissions = $this->permission->orderBy('id', 'asc')->paginate(20);

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

        return view(
            'layouts.settings.permissions.index', compact(
                'permissions'
            )
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $permission = $this->permission;
        $inputs = $request->all();

        $permission->name = $inputs['name'];
        $permission->slug = Str::slug($permission->name);

        $permission->save();

        return redirect()->back()
            ->with('success',  'A permissão <strong>' . $permission->name . '</strong> foi adicionada!');

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
        $inputs = $request->all();

        $permission->name = $inputs['name'];
        $permission->slug = Str::slug($permission->name);

        $permission->save();

        return redirect()->back()
            ->with('success',  'A permissão <strong>' . $permission->name . '</strong> foi editada!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Permission $permission)
    {
        $route = route('permission.undo', ['permission' => $permission]);
        $permission->delete();

        return redirect()->back()
            ->with('success',  'A permissão <strong>' . $permission->name . '</strong> foi deletada!' . undoLink($route));
    }

    public function undo(Request $request)
    {
        $permission = $this->permission->onlyTrashed()->where('uuid', $request->permission)->firstOrFail();
        $permission->restore();
        return redirect()->back()->with('success', 'Exclusão desfeita!');
    }
}
