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

            // ['name' => 'Ver Módulos'],

            // FOR SETTINGS
            ['name' => 'Ver Configurações'],
            ['name' => 'Ver Configurações Globais'],
            ['name' => 'Editar Configurações Globais'],
            // ['name' => 'Editar Proprietário do Projeto'],

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

            // // FOR PEOPLE
            // ['name' => 'Ver Lista de Pessoas'],
            // ['name' => 'Criar Pessoa'],
            // ['name' => 'Ver Pessoa'],
            // ['name' => 'Editar Pessoa'],
            // ['name' => 'Habilitar Pessoa'],
            // ['name' => 'Desabilitar Pessoa'],
            // ['name' => 'Excluir Pessoa'],

            // FOR USERS
            ['name' => 'Ver Lista de Usuários'],
            ['name' => 'Criar Usuário'],
            ['name' => 'Ver Usuário'],
            ['name' => 'Editar Usuário'],
            ['name' => 'Habilitar Usuário'],
            ['name' => 'Desabilitar Usuário'],
            ['name' => 'Excluir Usuário'],

            // // FOR USERS PROFILE
            // ['name' => 'Ver Perfil'],
            // ['name' => 'Excluir Foto do Perfil'],

            // // FOR PROFESSIONALS
            // ['name' => 'Ver Profissionais'],
            // ['name' => 'Ver Lista de Solicitações para se Tornar Profissional'],
            // ['name' => 'Aprovar Solicitação para se Tornar Profissional'],

            // // FOR REPORTS
            // ['name' => 'Pesquisar Relatórios'],

            // // FOR DASHBOARD
            // ['name' => 'Ver Dashboard'],
            // ['name' => 'Ver Indicadores do Dashboard'],
            // ['name' => 'Ver Tabela de Orçamentos no Dashboard'],
            // ['name' => 'Ver Tabela de Integradores no Dashboard'],
            // ['name' => 'Ver Tabela de Vendedores no Dashboard'],

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

            // // FOR LOCALES
            // ['name' => 'Ver Lista de Locais de Trabalho'],
            // ['name' => 'Criar Local de Trabalho'],
            // ['name' => 'Ver Local de Trabalho'],
            // ['name' => 'Editar Local de Trabalho'],
            // ['name' => 'Habilitar Local de Trabalho'],
            // ['name' => 'Desabilitar Local de Trabalho'],
            // ['name' => 'Excluir Local de Trabalho'],
            // ['name' => 'Pesquisar Local de Trabalho'],
            // ['name' => 'Destacar Local de Trabalho'],

            // // FOR CREWS
            // ['name' => 'Ver Lista de Equipes'],
            // ['name' => 'Criar Equipe'],
            // ['name' => 'Ver Equipe'],
            // ['name' => 'Editar Equipe'],
            // ['name' => 'Habilitar Equipe'],
            // ['name' => 'Desabilitar Equipe'],
            // ['name' => 'Excluir Equipe'],
            // ['name' => 'Pesquisar Equipe'],
            // ['name' => 'Destacar Equipe'],

            // // FOR AGENTS
            // ['name' => 'Ver Lista de Corretores'],
            // ['name' => 'Criar Corretor'],
            // ['name' => 'Ver Corretor'],
            // ['name' => 'Editar Corretor'],
            // ['name' => 'Habilitar Corretor'],
            // ['name' => 'Desabilitar Corretor'],
            // ['name' => 'Excluir Corretor'],
            // ['name' => 'Pesquisar Corretor'],
            // ['name' => 'Destacar Corretor'],
            // ['name' => 'Importar Corretores'],
            // ['name' => 'Exportar Corretores'],

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
