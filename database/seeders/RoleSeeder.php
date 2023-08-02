<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [
            ['name' => 'Webmaster'],
            ['name' => 'Suporte'],
            ['name' => 'Administrador'],
            ['name' => 'Associado'],
            ['name' => 'Contato'],
            ['name' => 'Operador'],
            ['name' => 'Vendedor'],
        ];

        $rolesQuantity = count($roles);
        Role::factory($rolesQuantity)
            ->make()
            ->each(function ($role, $key) use ($roles) {
                $roleName = $roles[$key]['name'];
                $role->name = $roleName;
                $role->slug = Str::slug($roleName);
                $role->save();
            });
    }
}
