<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            // IMPORTANT: Do not move the order of permissions persistence!

            // FOR ADMINISTRATIVE RESOURCES
            ['name' => 'Ver Administrativo'],

            // FOR SETTINGS
            ['name' => 'Ver Configurações'],
            ['name' => 'Ver Configurações Globais'],
            ['name' => 'Editar Configurações Globais'],
            ['name' => 'Editar Proprietário do Projeto'],

            // FOR ROLES
            ['name' => 'Ver Lista de Funções Administrativas'],
            ['name' => 'Criar Função Administrativa'],
            ['name' => 'Editar Função Administrativa'],
            ['name' => 'Ver Função Administrativa'],
            ['name' => 'Atualizar Função Administrativa'],
            ['name' => 'Excluir Função Administrativa'],

            // FOR PERMISSIONS
            ['name' => 'Ver Lista de Permissões'],
            ['name' => 'Criar Permissão'],
            ['name' => 'Editar Permissão'],
            ['name' => 'Ver Permissão'],
            ['name' => 'Atualizar Permissão'],
            ['name' => 'Excluir Permissão'],

            // FOR USERS
            ['name' => 'Ver Lista de Usuários'],
            ['name' => 'Criar Usuário'],
            ['name' => 'Ver Usuário'],
            ['name' => 'Editar Usuário'],
            ['name' => 'Habilitar Usuário'],
            ['name' => 'Desabilitar Usuário'],
            ['name' => 'Excluir Usuário'],

            // FOR COMPANIES
            ['name' => 'Ver Lista de Empresas'],
            ['name' => 'Criar Empresa'],
            ['name' => 'Ver Empresa'],
            ['name' => 'Editar Empresa'],
            ['name' => 'Habilitar Empresa'],
            ['name' => 'Desabilitar Empresa'],
            ['name' => 'Excluir Empresa'],
            ['name' => 'Pesquisar Empresa'],
            ['name' => 'Destacar Empresa'],
            ['name' => 'Importar Empresas'],

            // FOR ACTIVITY FIELDS
            ['name' => 'Ver Lista de Atividades de Empresas'],
            ['name' => 'Criar Atividade de Empresa'],
            ['name' => 'Ver Atividade de Empresa'],
            ['name' => 'Editar Atividade de Empresa'],
            ['name' => 'Habilitar Atividade de Empresa'],
            ['name' => 'Desabilitar Atividade de Empresa'],
            ['name' => 'Excluir Atividade de Empresa'],
            ['name' => 'Pesquisar Atividade de Empresa'],

            // FOR PHASES
            ['name' => 'Ver Lista de Fases'],
            ['name' => 'Criar Fase'],
            ['name' => 'Ver Fase'],
            ['name' => 'Editar Fase'],
            ['name' => 'Habilitar Fase'],
            ['name' => 'Desabilitar Fase'],
            ['name' => 'Excluir Fase'],
            ['name' => 'Pesquisar Fase'],

            // FOR RESEARCHERS
            ['name' => 'Ver Lista de Pesquisadores'],
            ['name' => 'Criar Pesquisador'],
            ['name' => 'Ver Pesquisador'],
            ['name' => 'Editar Pesquisador'],
            ['name' => 'Habilitar Pesquisador'],
            ['name' => 'Desabilitar Pesquisador'],
            ['name' => 'Excluir Pesquisador'],
            ['name' => 'Pesquisar Pesquisador'],

            // FOR WORK
            ['name' => 'Ver Lista de Obras'],
            ['name' => 'Criar Obra'],
            ['name' => 'Ver Obra'],
            ['name' => 'Editar Obra'],
            ['name' => 'Habilitar Obra'],
            ['name' => 'Desabilitar Obra'],
            ['name' => 'Excluir Obra'],
            ['name' => 'Pesquisar Obra'],

            // FOR SEGMENT
            ['name' => 'Ver Lista de Segmentos de Atuação'],
            ['name' => 'Criar Segmento de Atuação'],
            ['name' => 'Ver Segmento de Atuação'],
            ['name' => 'Editar Segmento de Atuação'],
            ['name' => 'Habilitar Segmento de Atuação'],
            ['name' => 'Desabilitar Segmento de Atuação'],
            ['name' => 'Excluir Segmento de Atuação'],
            ['name' => 'Pesquisar Segmento de Atuação'],

            // FOR SEGMENT SUB TYPES
            ['name' => 'Ver Lista de Subtipos de Segmentos de Atuação'],
            ['name' => 'Criar Subtipo de Segmento de Atuação'],
            ['name' => 'Ver Subtipo de Segmento de Atuação'],
            ['name' => 'Editar Subtipo de Segmento de Atuação'],
            ['name' => 'Habilitar Subtipo de Segmento de Atuação'],
            ['name' => 'Desabilitar Subtipo de Segmento de Atuação'],
            ['name' => 'Excluir Subtipo de Segmento de Atuação'],
            ['name' => 'Pesquisar Subtipo de Segmento de Atuação'],

            // FOR SEGMENT SUB TYPES
            ['name' => 'Ver Lista de Estágios'],
            ['name' => 'Criar Subtipo de Estágio'],
            ['name' => 'Ver Subtipo de Estágio'],
            ['name' => 'Editar Subtipo de Estágio'],
            ['name' => 'Habilitar Subtipo de Estágio'],
            ['name' => 'Desabilitar Subtipo de Estágio'],
            ['name' => 'Excluir Subtipo de Estágio'],
            ['name' => 'Pesquisar Subtipo de Estágio'],

            // FOR POSITIONS
            ['name' => 'Ver Lista de Cargos'],
            ['name' => 'Criar Cargo'],
            ['name' => 'Ver Cargo'],
            ['name' => 'Editar Cargo'],
            ['name' => 'Habilitar Cargo'],
            ['name' => 'Desabilitar Cargo'],
            ['name' => 'Excluir Cargo'],
            ['name' => 'Pesquisar Cargo'],

            // FOR ORDER
            ['name' => 'Ver Lista de Pedidos'],
            ['name' => 'Criar Pedido'],
            ['name' => 'Ver Pedido'],
            ['name' => 'Editar Pedido'],
            ['name' => 'Habilitar Pedido'],
            ['name' => 'Desabilitar Pedido'],
            ['name' => 'Excluir Pedido'],
            ['name' => 'Pesquisar Pedido'],

            // FOR SEARCH
            ['name' => 'Ver Pesquisas'],
            ['name' => 'Ver Pesquisa de Empresas'],
            ['name' => 'Ver Pesquisa de Obras'],
        ];

        $permissionsQuantity = count($permissions);

        Permission::factory($permissionsQuantity)
            ->make()
            ->each(function ($permission, $key) use ($permissions) {
                $permission->name = $permissions[$key]['name'];
                $permission->slug = Str::slug($permission->name);
                $permission->save();
            });
    }
}
