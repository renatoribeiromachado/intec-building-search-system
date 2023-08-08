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
        // ===========================================
        // ======= Webmaster's Permission ============
        // ===========================================
        $webmasterRole = (new Role())->userRole('Webmaster')->firstOrFail();

        $webmasterPermissions = Permission::all();

        $webmasterRole->permissions()->attach($webmasterPermissions);


        // ===========================================
        // ======= Supporter's Permission ============
        // ===========================================
        $supportRole = (new Role())->userRole('Suporte')->firstOrFail();

        $supportPermissions = Permission::all();

        $supportRole->permissions()->attach($supportPermissions);


        // ===========================================
        // ======= Administrator's Permission ========
        // ===========================================
        $administratorRole = (new Role)->userRole('Administrador')->firstOrFail();

        $administratorPermissions = Permission::whereNotIn('name', [

            // FOR SETTINGS
            'Ver Configurações',
            'Ver Configurações Globais',
            'Editar Configurações Globais',
            'Editar Proprietário do Projeto',

            // FOR ROLES
            'Excluir Função Administrativa',

            // FOR PERMISSIONS
            'Ver Lista de Permissões',
            'Ver Permissão',

            // FOR COMPANIES
            'Importar Empresas',

        ])->get();

        $administratorRole->permissions()->attach($administratorPermissions);


        // ===========================================
        // ======= Operator's Permission =============
        // ===========================================
        $operatorRole = (new Role)->userRole('Operador')->firstOrFail();

        $operatorPermissions = Permission::whereIn('name', [

            // FOR ADMINISTRATIVE RESOURCES
            'Ver Administrativo',

            // FOR COMPANIES
            'Ver Lista de Empresas',
            'Criar Empresa',
            'Ver Empresa',
            'Editar Empresa',
            'Habilitar Empresa',
            'Desabilitar Empresa',
            'Pesquisar Empresa',
            'Destacar Empresa',

            // FOR ACTIVITY FIELDS
            'Ver Lista de Atividades de Empresas',
            'Criar Atividade de Empresa',
            'Ver Atividade de Empresa',
            'Editar Atividade de Empresa',
            'Habilitar Atividade de Empresa',
            'Desabilitar Atividade de Empresa',
            'Pesquisar Atividade de Empresa',

            // FOR PHASES
            'Ver Lista de Fases',
            'Criar Fase',
            'Ver Fase',
            'Editar Fase',
            'Habilitar Fase',
            'Desabilitar Fase',
            'Pesquisar Fase',

            // FOR RESEARCHERS
            'Ver Lista de Pesquisadores',
            'Criar Pesquisador',
            'Ver Pesquisador',
            'Editar Pesquisador',
            'Habilitar Pesquisador',
            'Desabilitar Pesquisador',
            'Pesquisar Pesquisador',

            // FOR WORK
            'Ver Lista de Obras',
            'Criar Obra',
            'Ver Obra',
            'Editar Obra',
            'Habilitar Obra',
            'Desabilitar Obra',
            'Pesquisar Obra',

            // FOR SEGMENT
            'Ver Lista de Segmentos de Atuação',
            'Criar Segmento de Atuação',
            'Ver Segmento de Atuação',
            'Editar Segmento de Atuação',
            'Habilitar Segmento de Atuação',
            'Desabilitar Segmento de Atuação',
            'Pesquisar Segmento de Atuação',

            // FOR SEGMENT SUB TYPES
            'Ver Lista de Subtipos de Segmentos de Atuação',
            'Criar Subtipo de Segmento de Atuação',
            'Ver Subtipo de Segmento de Atuação',
            'Editar Subtipo de Segmento de Atuação',
            'Habilitar Subtipo de Segmento de Atuação',
            'Desabilitar Subtipo de Segmento de Atuação',
            'Pesquisar Subtipo de Segmento de Atuação',

            // FOR SEGMENT SUB TYPES
            'Ver Lista de Estágios',
            'Criar Subtipo de Estágio',
            'Ver Subtipo de Estágio',
            'Editar Subtipo de Estágio',
            'Habilitar Subtipo de Estágio',
            'Desabilitar Subtipo de Estágio',
            'Pesquisar Subtipo de Estágio',

            // FOR POSITIONS
            'Ver Lista de Cargos',
            'Criar Cargo',
            'Ver Cargo',
            'Editar Cargo',
            'Habilitar Cargo',
            'Desabilitar Cargo',
            'Pesquisar Cargo',
                
        ])->get();

        $operatorRole->permissions()->attach($operatorPermissions);

        // ===========================================
        // ======= Associate's Permission =============
        // ===========================================
        $associateRole = (new Role)->userRole('Associado')->firstOrFail();

        $associatePermissions = Permission::whereIn('name', [

            // FOR SEARCH
            'Ver Pesquisas',
            'Ver Pesquisa de Obras',
            
        ])->get();

        $associateRole->permissions()->attach($associatePermissions);
    }
}
