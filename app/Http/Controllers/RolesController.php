<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Permission;
use App\Models\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class RolesController extends Controller
{

    protected $permission;
    protected $role;

    public function __construct(
        Permission $permission,
        Role $role
    )
    {
        $this->permission = $permission;
        $this->role = $role;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $where = [];
        if(Auth::user()->role->name != 'Webmaster') {
            $where[] = ['name', '!=', 'Webmaster'];
        }

        $roles       = $this->role->where($where)->paginate(10);
        $permission  = $this->permission;

        return view('settings.roles.index', compact(
            'roles', 
            'permission'
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
        $role = $this->role;
        $inputs = $request->all();
        $role->name = $inputs['name'];
        $role->slug = Str::slug($role->name);

        $role->save();

        return redirect()->back()
            ->with('success',  'A função administrativa <strong>' . $role->name . '</strong> foi criada!');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Role $role)
    {
        $inputs = $request->all();

        $role->name = $inputs['name'];
        $role->slug = Str::slug($role->name);

        $role->save();

        return redirect()->back()
            ->with('success',  'A função administrativa <strong>' . $role->name . '</strong> foi editada!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {
        $role->delete();

        return redirect()->back()
            ->with('success',  'A função administrativa <strong>' . $role->name . '</strong> foi deletada!');
    }

    public function permissions(Request $request)
    {
        $role        = $this->role->findOrFail($request->id);
        $permissions = $this->permission->orderBy('id', 'desc')->get();

        if(Auth::user()->role->name != 'Webmaster') {

            $permissions = $this->permission
                                    ->whereNotIn('id', [
                                         4, 5, 6, 7, 8, 9, // Roles
                                        10, 11, 12, 13, 14, 15, // Permissions
                                        16, 17, 18, 19, 20, 21, 22, // Person
                                        24, 25, 26, 27, 28, 29, // User
                                        38, // Manager
                                        69, 70, 71, 72, 73 // Business Status Histories
                                    ])
                                    ->orderBy('id', 'desc')->get();
        }

        if(Auth::user()->role->name != 'Webmaster' && 
            Auth::user()->role->name != 'Administrador') {

            $permissions = $this->permission
                                    ->whereNotIn('id', [
                                        4, 5, 6, 7, 8, 9, // Roles
                                        10, 11, 12, 13, 14, 15, // Permissions
                                        16, 17, 18, 19, 20, 21, 22, // Person
                                        24, 25, 26, 27, 28, 29, // User
                                        38, // Manager
                                        69, 70, 71, 72, 73 // Business Status Histories
                                    ])
                                    ->orderBy('id', 'desc')->get();
        }

        $permission_role_sync_route = route('perm.sync.permission_role');

        foreach ($permissions as $permission):

            $permission->selected = ($role->permissions->contains($permission->id)) ? true : false;

        endforeach;

        return view('settings.roles.permission', compact(
            'role', 
            'permissions', 
            'permission_role_sync_route'
        ));
    }

    public function syncPermissionRole(Request $request)
    {
        $role       = $this->role->findRole($request->role);
        $sync       = [];
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

        return redirect()->route('role.perm.edit', ['id' => $role->id])
                ->with('success', 'As <strong>PERMISSÕES</strong> foram atualizadas!');
    }
}
