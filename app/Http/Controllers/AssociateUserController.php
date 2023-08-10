<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Contact;
use App\Models\Position;
use App\Models\Role;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class AssociateUserController extends Controller
{
    protected $contact;
    protected $position;
    protected $role;
    protected $user;

    public function __construct(
        Contact $contact,
        Position $position,
        Role $role,
        User $user,
    ) {
        $this->contact = $contact;
        $this->position = $position;
        $this->role = $role;
        $this->user = $user;
    }

    public function create(Request $request, Company $company)
    {
        $contact = $this->contact;

        $positions = $this->position->getPositionList();
        
        $defaultPassword = 'intec!@#';

        $roles = $this->role
            ->select('id', 'name')
            ->whereIn('slug', ['associado-gestora', 'associado-usuario'])
            ->orderBy('name', 'asc')
            ->get()->pluck('name', 'id');

        $isActive = collect([
            'Inativo',
            'Ativo',
        ]);

        return view('layouts.associate.user.create', compact(
            'company',
            'contact',
            'positions',
            'defaultPassword',
            'roles',
            'isActive',
        ));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreWorkRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Company $company)
    {
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

        return redirect()->route('associate.edit', $company->associate->id);
    }

    public function edit(Request $request, Company $company, Contact $contact)
    {
        $positions = $this->position->getPositionList();
        
        $defaultPassword = null; // 'intec!@#';

        $roles = $this->role
            ->select('id', 'name')
            ->whereIn('slug', ['associado-gestora', 'associado-usuario'])
            ->orderBy('name', 'asc')
            ->get()->pluck('name', 'id');
        $isActive = collect([
            'Inativo',
            'Ativo',
        ]);
        
        return view('layouts.associate.user.edit', compact(
            'company',
            'contact',
            'positions',
            'defaultPassword',
            'roles',
            'isActive',
        ));
    }

    public function update(Request $request, Company $company, Contact $contact)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'], // , 'regex:/^[a-zA-Z ]+$/u'
            'email' => ['required', 'string', 'email', 'max:255', "unique:users,email,{$contact->user->id},id"],
            'password' => ['nullable', Password::defaults()],
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
            if (isset($request->password) ) {
                $user->password = Hash::make($request->password);
            }
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

        return redirect()->route('associate.edit', $company->associate->id);
    }

    public function destroy(Request $request, Company $company, Contact $contact)
    {
        try {

            DB::beginTransaction();

            $contact->delete();
            $contact->user()->delete();

            DB::commit();

        } catch (Exception $ex) {

            DB::rollBack();

            return redirect()->back()
                ->withInput($request->all())
                ->withErrors(['message' => $ex->getMessage()]);
                
        }

        session()->flash('success', 'Acesso para o associado excluído.');

        return redirect()->route('associate.edit', $company->associate->id);
    }
}
