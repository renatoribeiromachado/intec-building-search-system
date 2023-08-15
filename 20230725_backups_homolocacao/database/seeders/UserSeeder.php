<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $webmasterRole = (new Role())->userRole('Webmaster')->firstOrFail();
        $supportRole = (new Role)->userRole('Suporte')->firstOrFail();
        $administratorRole = (new Role)->userRole('Administrador')->firstOrFail();

        User::factory()->create([
            // 'person_id' => $personOne->id,
            'role_id' => $webmasterRole->id,
            'name' => 'Raphael Paulino',
            'email' => 'paulino@633k.com.br',
            'password' => '$2y$10$ycqc2nm0msy99BDpHfKA6OARUPp63omleARK99ggCkI587eJZ33FW'
        ]);

        User::factory()->create([
            // 'person_id' => $personOne->id,
            'role_id' => $supportRole->id,
            'name' => 'Renato Machado',
            'email' => 'renato@gmail.com',
            'password' => '$2y$10$up8dFLosbqaULAG.8B5kRO.avv21.HjbpFkiFURS7OPBGPZ9tRMWK'
        ]);
    }
}
