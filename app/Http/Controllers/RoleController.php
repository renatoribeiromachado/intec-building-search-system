<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRoleRequest;
use App\Http\Requests\UpdateRoleRequest;
use App\Models\Permission;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class RoleController extends Controller
{
    protected $role;
    protected $permission;

    public function __construct(
        Role $role,
        Permission $permission
    ) {
        $this->role = $role;
        $this->permission = $permission;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = $this->role->allRoles();
        return view('layouts.role.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $role = $this->role;
        return view('layouts.role.create', compact('role'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreRoleRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRoleRequest $request)
    {
        $role = $this->role;
        $role->name = $request->name;
        $role->slug = Str::slug($role->name);
        $role->save();

        return redirect()->route('role.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {
        return view('layouts.role.edit', compact('role'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateRoleRequest  $request
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRoleRequest $request, Role $role)
    {
        $role->name = $request->name;
        $role->slug = Str::slug($role->name);
        $role->save();

        session()->flash('success', 'Perfil de usuário atualizado.');

        return redirect()->route('role.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {
        $role->delete();
        return redirect()->route('role.index');
    }

    public function permissions(Request $request, Role $role)
    {
        $role = $this->role->findOrFail($request->id);
        $permissions = $this->permission->orderBy('id', 'desc')->get();

        // if(Auth::user()->role->name != 'Webmaster') {

        //     $permissions = $this->permission
        //                             ->whereNotIn('id', [
        //                                  4, 5, 6, 7, 8, 9, // Roles
        //                                 10, 11, 12, 13, 14, 15, // Permissions
        //                                 16, 17, 18, 19, 20, 21, 22, // Person
        //                                 24, 25, 26, 27, 28, 29, // User
        //                                 38, // Manager
        //                                 69, 70, 71, 72, 73 // Business Status Histories
        //                             ])
        //                             ->orderBy('id', 'desc')->get();
        // }

        // if(Auth::user()->role->name != 'Webmaster' && 
        //     Auth::user()->role->name != 'Administrador') {

        //     $permissions = $this->permission
        //                             ->whereNotIn('id', [
        //                                 4, 5, 6, 7, 8, 9, // Roles
        //                                 10, 11, 12, 13, 14, 15, // Permissions
        //                                 16, 17, 18, 19, 20, 21, 22, // Person
        //                                 24, 25, 26, 27, 28, 29, // User
        //                                 38, // Manager
        //                                 69, 70, 71, 72, 73 // Business Status Histories
        //                             ])
        //                             ->orderBy('id', 'desc')->get();
        // }

        $permissionRoleSyncRoute = route('role.permission.sync.permission_role');

        foreach ($permissions as $permission):
            $permission->selected = ($role->permissions->contains($permission->id)) ? true : false;
        endforeach;

        return view('layouts.settings.roles.permission', compact(
            'role',
            'permissions',
            'permissionRoleSyncRoute'
        ));
    }

    public function syncPermissionRole(Request $request)
    {
        $role = $this->role->findRole($request->role);
        $sync = [];
        $permission = isset($request->permission) ? $request->permission : [];

        foreach ($permission as $key) {
            if (array_key_exists('permission_id', $key)) {
                array_push($sync, $key['permission_id']);
            }
        }

        if (count($sync) > 0) {

            $role->permissions()->sync($sync);

        } else {

            $detach = [];
            foreach ($role->permissions as $perm) {
                array_push($detach, $perm->id);
            }

            $role->permissions()->detach($detach);
        }

        $message = "As <strong>PERMISSÕES</strong> foram atualizadas!";
        session()->flash('success', $message);

        return redirect()->route('role.index');
    }
}
