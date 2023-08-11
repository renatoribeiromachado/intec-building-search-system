<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Contact;
use App\Models\Role;
use App\Models\User;
use Exception;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class UserController extends Controller
{
    const IS_ACTIVE = [
        'Inativo',
        'Ativo',
    ];

    protected $user;
    protected $role;
    protected $contact;

    public function __construct(
        User $user,
        Role $role,
        Contact $contact
    ) {
        $this->user = $user;
        $this->role = $role;
        $this->contact = $contact;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('ver-lista-de-usuarios');

        $users = $this->user->allUsers();
        return view('layouts.user.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('criar-usuario');

        $isActive = collect(self::IS_ACTIVE);

        $user = $this->user;
        $roles = $this->role
            ->whereNotIn('slug', [
                'associado-gestora',
                'associado-usuario',
                'webmaster',
                'contato'
            ])
            ->get();
        return view('layouts.user.create', compact(
            'user',
            'roles',
            'isActive'
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
        $this->authorize('criar-usuario');
        
        $request->validate([
            'name' => ['required', 'string', 'max:255', 'regex:/^[a-zA-Z ]+$/u'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Password::defaults()],
            'role_id' => ['required'],
        ], [
            'name.required' => 'O campo Nome é obrigatório',
            'email.required' => 'O campo E-mail é obrigatório',
            'password.required' => 'O campo Senha é obrigatório',
            'role_id.required' => 'O campo Perfil é obrigatório',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role_id' => $request->role_id,
            'is_active' => $request->is_active
        ]);

        event(new Registered($user));

        return redirect()->route('user.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $this->authorize('editar-usuario');

        $isActive = collect(self::IS_ACTIVE);

        $roles = $this->role
            ->whereNotIn('slug', [
                'associado-gestora',
                'associado-usuario',
                'webmaster',
                'contato'
            ])
            ->get();
        return view('layouts.user.edit', compact(
            'user',
            'roles',
            'isActive'
        ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $this->authorize('editar-usuario');

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,'.$user->id],
            'password' => ['nullable', 'confirmed', Password::defaults()],
            'role_id' => ['required'],
        ], [
            'name.required' => 'O campo Nome é obrigatório',
            'email.required' => 'O campo E-mail é obrigatório',
            'email.unique' => 'Este E-mail já está sendo utilizado',
            // 'password.required' => 'O campo Senha é obrigatório',
            'role_id.required' => 'O campo Perfil é obrigatório',
        ]);

        $user->name = $request->name;
        $user->email = $request->email;
        if (isset($request->password)) {
            $user->password = Hash::make($request->password);
        }
        $user->role_id = $request->role_id;
        $user->is_active = $request->is_active;
        $user->save();

        return redirect()->route('user.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, User $user)
    {
        $this->authorize('excluir-usuario');

        try {

            DB::beginTransaction();
            
            $user->delete();

            DB::commit();

        } catch (Exception $ex) {

            DB::rollBack();

            return redirect()->back()
                ->withInput($request->all())
                ->withErrors(['message' => $ex->getMessage()]);
                
        }

        session()->flash('success', 'Usuário excluído.');

        return redirect()->route('user.index');
    }
}
