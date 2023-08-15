<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Seeder;

class PermissionRoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $webmasterRole = (new Role())->userRole('Webmaster')->firstOrFail();

        $webmasterPermissions = Permission::all();

        $webmasterRole->permissions()->attach($webmasterPermissions);

        // // ======= Administrator's Permission ========
        // $administratorRole = (new Role)->userRole('Administrador')->firstOrFail();

        // // now we retrieve all permissions
        // $administratorPermissions = Permission::whereNotIn('name', [

        //     // FOR ROLES
        //     'Ver Lista de Funções Administrativas', 
        //     'Ver Função Administrativa',

        //     // FOR PERMISSIONS
        //     'Ver Lista de Permissões', 
        //     'Ver Permissão', 

        //     // FOR SETTINGS
        //     'Ver Configurações Globais',

        //     // FOR PEOPLE
        //     'Ver Lista de Pessoas', 
        //     'Criar Pessoa', 
        //     'Editar Pessoa', 
        //     'Habilitar Pessoa', 
        //     'Desabilitar Pessoa', 
        //     'Excluir Pessoa', 
                
        // ])->get();

        // // then, for each permission we will bind Administrator role
        // $administratorRole->permissions()->attach($administratorPermissions);

        // $humanResourceRole = (new Role)->userRole('Recursos Humanos')->firstOrFail();

        // $rhPermissions = Permission::whereIn('name', [

        //     // FOR AGENTS
        //     'Ver Lista de Corretores',
        //     'Criar Corretor',
        //     'Ver Corretor',
        //     'Editar Corretor',
        //     'Habilitar Corretor',
        //     'Desabilitar Corretor',
        //     'Excluir Corretor',
        //     'Pesquisar Corretor',
        //     'Destacar Corretor',
        //     'Exportar Corretores',

        //     //FOR LOCALES
        //     'Ver Lista de Locais de Trabalho',
        //     'Criar Local de Trabalho',
        //     'Ver Local de Trabalho',
        //     'Editar Local de Trabalho',
        //     'Habilitar Local de Trabalho',
        //     'Desabilitar Local de Trabalho',
        //     'Excluir Local de Trabalho',
        //     'Pesquisar Local de Trabalho',
        //     'Destacar Local de Trabalho',

        //     // FOR CREWS
        //     'Ver Lista de Equipes',
        //     'Criar Equipe',
        //     'Ver Equipe',
        //     'Editar Equipe',
        //     'Habilitar Equipe',
        //     'Desabilitar Equipe',
        //     'Excluir Equipe',
        //     'Pesquisar Equipe',
        //     'Destacar Equipe',

        //     // FOR COMPANIES
        //     'Ver Lista de Unidades',
        //     'Criar Unidade',
        //     'Ver Unidade',
        //     'Editar Unidade',
        //     'Habilitar Unidade',
        //     'Desabilitar Unidade',
        //     'Excluir Unidade',
        //     'Pesquisar Unidade',
        //     'Destacar Unidade',
                
        // ])->get();

        // $humanResourceRole->permissions()->attach($rhPermissions);

        // $rhConsultRole = (new Role)->userRole('Recursos Humanos Consulta')->firstOrFail();

        // $rhConsultPermissions = Permission::whereIn('name', [

        //     // FOR AGENTS
        //     'Ver Lista de Corretores',
        //     'Ver Corretor',
        //     'Pesquisar Corretor',

        //     //FOR LOCALES
        //     'Ver Lista de Locais de Trabalho',
        //     'Ver Local de Trabalho',
        //     'Pesquisar Local de Trabalho',

        //     //FOR CREWS
        //     'Ver Lista de Equipes',
        //     'Ver Equipe',
        //     'Pesquisar Equipe',

        //     // FOR COMPANIES
        //     'Ver Lista de Unidades',
        //     'Ver Unidade',
        //     'Pesquisar Unidade',
                
        // ])->get();

        // $rhConsultRole->permissions()->attach($rhConsultPermissions);
    }
}
