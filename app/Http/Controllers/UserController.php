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
        $roles = $this->role->findRoles();
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

        $roles = $this->role->findRoles();
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
    public function destroy(User $user)
    {
        $this->authorize('excluir-usuario');

        $user->delete();
        return redirect()->route('user.index');
    }

    public function storeAssociateUser(Request $request, Company $company)
    {
        $this->authorize('criar-usuario');

        $request->validate([
            'name' => ['required', 'string', 'max:255'], // , 'regex:/^[a-zA-Z ]+$/u'
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', Password::defaults()],
            'role_id' => ['required'],
            'position_id' => ['required'],
            'user_is_active' => ['required'],
        ], [
            'name.required' => 'O campo Nome é obrigatório',
            'email.required' => 'O campo E-mail é obrigatório',
            'password.required' => 'O campo Senha é obrigatório',
            'position_id.required' => 'O campo Cargo é obrigatório',
            'role_id.required' => 'O campo Perfil é obrigatório',
            'user_is_active.required' => 'O campo Status é obrigatório',
        ]);

        try {

            DB::beginTransaction();

            $user = $this->user->create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role_id' => $request->role_id,
                'is_active' => $request->user_is_active,
            ]);

            $this->contact->create([
                'user_id' => $user->id,
                'position_id' => $request->position_id,
                'company_id' => $company->id,
                'name' => $user->name,
                'ddd' => $request->ddd,
                'main_phone' => $request->main_phone,
                'ddd_two' => $request->ddd_two,
                'phone_two' => $request->phone_two,
                'email' => $user->email,
                'is_active' => $request->user_is_active,
                'created_by' => auth()->user()->id,
                'updated_by' => auth()->user()->id,
            ]);

            DB::commit();

        } catch (Exception $ex) {

            DB::rollBack();

            return redirect()->back()
                ->withInput($request->all())
                ->withErrors(['message' => $ex->getMessage()]);
                
        }

        session()->flash('success', 'Acesso para o associado criado.');

        return redirect()->back();
    }

    public function updateAssociateUser(Request $request, Company $company, Contact $contact)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'], // , 'regex:/^[a-zA-Z ]+$/u'
            'email' => ['required', 'string', 'email', 'max:255', "unique:users,email,{$contact->user->id},id"],
            'password' => ['required', Password::defaults()],
            'role_id' => ['required'],
            'position_id' => ['required'],
            'user_is_active' => ['required'],
        ], [
            'name.required' => 'O campo Nome é obrigatório',
            'email.required' => 'O campo E-mail é obrigatório',
            'password.required' => 'O campo Senha é obrigatório',
            'position_id.required' => 'O campo Cargo é obrigatório',
            'role_id.required' => 'O campo Perfil é obrigatório',
            'user_is_active.required' => 'O campo Status é obrigatório',
        ]);

        try {

            DB::beginTransaction();

            $user = $contact->user;
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->role_id = $request->role_id;
            $user->is_active = $request->user_is_active;
            $user->save();

            $contact->position_id = $request->position_id;
            $contact->name = $user->name;
            $contact->ddd = $request->ddd;
            $contact->main_phone = $request->main_phone;
            $contact->ddd_two = $request->ddd_two;
            $contact->phone_two = $request->phone_two;
            $contact->email = $user->email;
            $contact->is_active = $request->user_is_active;
            $contact->updated_by = auth()->user()->id;
            $contact->save();

            DB::commit();

        } catch (Exception $ex) {

            DB::rollBack();

            return redirect()->back()
                ->withInput($request->all())
                ->withErrors(['message' => $ex->getMessage()]);
                
        }

        session()->flash('success', 'Acesso para o associado atualizado.');

        return redirect()->back();
    }

    public function destroyAssociateUser(Request $request, Company $company, Contact $contact)
    {
        try {

            DB::beginTransaction();

            $contact->delete();

            DB::commit();

        } catch (Exception $ex) {

            DB::rollBack();

            return redirect()->back()
                ->withInput($request->all())
                ->withErrors(['message' => $ex->getMessage()]);
                
        }

        session()->flash('success', 'Acesso para o associado excluído.');

        return redirect()->back();
    }
}
