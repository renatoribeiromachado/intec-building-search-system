<style>

    .custom-menu {
        width: 118px !important;
        height: 750px !important;
        background-color: #ff6b1a;
        border-radius: 40px;
    }

    /* Estilo para o menu principal */
    .navbar-nav .nav-link {
        background-color: #ff6b1a;
        color: black;
        /* Cor do texto normal */
        transition: color 0.3s, background-color 0.3s;
        /* Transição suave de cor para texto e fundo */
    }

    /* Estilo para o menu dropdown */
    .navbar-nav .nav-item.dropdown:hover .dropdown-menu {
        display: block;
        width: max-content !important;
        background-color: #000d37;
        /* Cor de fundo do menu dropdown */
        z-index: 999 !important;
    }

    /* Estilo para os itens do menu dropdown */
    .navbar-nav .nav-item.dropdown .dropdown-menu .dropdown-item {
        color: white !important;
        /* Cor do texto normal no menu dropdown */
    }

    /* Estilo quando o mouse passa por cima do item do menu dropdown */
    .navbar-nav .nav-item.dropdown .dropdown-menu .dropdown-item:hover {
        background-color: #000d37;
        color: red !important;
        /* Cor que o texto vai ficar ao passar o mouse (vermelho) */
    }

    /* Estilo para a <li> do menu dropdown */
    .navbar-nav .nav-item.dropdown:hover {
        background-color: #000d37;
        /* Cor de fundo da <li> */
    }

    /* Estilo para a <li> do primeiro link*/
    .item1:hover {
        background-color: #ff6b1a !important;
        /* Cor de fundo da <li> */
        border-radius: 40px;
    }

    /* Estilo para o link dentro da <li> do menu dropdown */
    .navbar-nav .nav-item.dropdown:hover .nav-link {
        color: black !important;
        /* Cor do texto ao passar o mouse (vermelho) */
        background-color: #ff6b1a !important;
        /* Cor de fundo ao passar o mouse (verde) */
    }
</style>
<div class="custom-menu">

    <ul class="navbar-nav text-center">
        <li class="nav-item dropdown pt-5 item1">
            <a class="nav-link text-white" href="{{ route('dashboard.index') }}" aria-expanded="false">
                <i class="fa fa-home icon"></i>
            </a>
        </li>

        @can('ver-administrativo')
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle text-white" href="#" id="administrative"
                data-bs-toggle="dropdown" aria-expanded="false">
                <i class="fa fa-check icon"></i>
            </a>
            <ul class="dropdown-menu" aria-labelledby="administrative">
                {{-- @can('ver-configuracoes') --}}
                <li>
                    <a class="dropdown-item" href="{{ route('associate.index') }}">
                        Associados
                    </a>
                </li>
                <li>
                    <a class="dropdown-item" href="{{ route('work.exportExcel') }}">
                        Exportar Excel
                    </a>
                </li>
                {{-- @endcan --}}

                <li>
                    <a class="dropdown-item" href="{{ route('company.index') }}">Empresas</a>
                </li>
                <li>
                    <a class="dropdown-item" href="{{ route('activity_field.index') }}">
                        Atividades de Empresas
                    </a>
                </li>

                @can('ver-usuario')
                <li>
                    <a class="dropdown-item" href="{{ route('user.index') }}">
                        Usuários
                    </a>
                </li>
                @endcan

                @can('ver-funcao-administrativa')
                <li>
                    <a class="dropdown-item" href="{{ route('role.index') }}">
                        Perfis de Usuários
                    </a>
                </li>
                @endcan

                <li>
                    <a class="dropdown-item" href="{{ route('researcher.index') }}">
                        Pesquisadores
                    </a>
                </li>
                <li>
                    <a class="dropdown-item" href="{{ route('work.index') }}">
                        Obras
                    </a>
                </li>
                <li>
                    <a class="dropdown-item" href="{{ route('segment.index') }}">
                        Segmentos de Atuação
                    </a>
                </li>
                <li>
                    <a class="dropdown-item" href="{{ route('segment_sub_type.index') }}">
                        Subtipos de Segmentos de Atuação
                    </a>
                </li>
                <li>
                    <a class="dropdown-item" href="{{ route('phase.index') }}">
                        Fases
                    </a>
                </li>
                <li>
                    <a class="dropdown-item" href="{{ route('stage.index') }}">
                        Estágios
                    </a>
                </li>
                <li>
                    <a class="dropdown-item" href="{{ route('position.index') }}">
                        Cargos
                    </a>
                </li>

                @can('ver-funcao-administrativa')
                <li>
                    <a class="dropdown-item" href="{{ route('permission.index') }}">
                        Permissões
                    </a>
                </li>
                @endcan

                @can('ver-popup')
                <li>
                    <a class="dropdown-item" href="{{ route('popup.index') }}">
                        Pop-up
                    </a>
                </li>
                @endcan
                @can('resultado-trimestral')
                <li>
                    <a class="dropdown-item" href="{{ route('quarterlyResult.index') }}">
                        Resultado Trimestral
                    </a>
                </li>
                @endcan
            </ul>
        </li>
        @endcan

        @can('login-associado')
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle text-white" href="#" id="dropdown07XL"
                data-bs-toggle="dropdown" aria-expanded="false">
                <i class="fa fa-users icon"></i>
            </a>
            <ul class="dropdown-menu" aria-labelledby="dropdown07XL">
                <li>
                    <a class="dropdown-item" href="{{ route('monitoring.index') }}">
                        Associado
                    </a>
                </li>
            </ul>
        </li>
        @endcan

        @can('login-de-associado-gestor')
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle text-white" href="#" id="dropdown07XL"
                data-bs-toggle="dropdown" aria-expanded="false">
                <i class="fa fa-users icon"></i>
            </a>
            <ul class="dropdown-menu" aria-labelledby="dropdown07XL">
                <li>
                    <a class="dropdown-item" href="{{ route('monitoring.gestor') }}">
                        Acesso de usuário
                    </a>
                </li>
            </ul>
        </li>
        @endcan

        @can('plano-do-associado')
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle text-white" href="#" id="dropdown07XL"
                data-bs-toggle="dropdown" aria-expanded="false">
                <i class="fa fa-check icon"></i>
            </a>
            <ul class="dropdown-menu" aria-labelledby="dropdown07XL">
                <li>
                    <a class="dropdown-item" href="{{ route('associate.order.index') }}">
                        Plano
                    </a>
                </li>
            </ul>
        </li>
        @endcan


        @can('ver-pesquisas')
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle text-white" href="#" id="dropdown07XL"
                data-bs-toggle="dropdown" aria-expanded="false">
                <i class="fa fa-search icon"></i>
            </a>
            <ul class="dropdown-menu" aria-labelledby="dropdown07XL">
                @can('ver-pesquisa-de-empresas')
                <li>
                    <a class="dropdown-item" href="{{ route('company.search.step_one.index') }}">
                        Empresas
                    </a>
                </li>
                @endcan

                @can('ver-pesquisa-de-obras')
                <li>
                    <a class="dropdown-item" href="{{ route('work.search.step_one.index') }}">
                        Obras
                    </a>
                </li>
                @endcan
            </ul>
        </li>
        @endcan

        @can('ver-relatorio')
        {{-- <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle text-white" href="#" id="dropdown07XL"
                data-bs-toggle="dropdown" aria-expanded="false">
                <i class="fa fa-archive icon"></i>
            </a>

            <ul class="dropdown-menu" aria-labelledby="dropdown07XL">
                <li>
                    <a class="dropdown-item" href="#">
                        Estamos em atualização
                    </a>
                </li>
            </ul>
        </li>
        --}}
        @endcan


        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle text-white" href="#" id="dropdown07XL"
                data-bs-toggle="dropdown" aria-expanded="false">
                <i class="fa fa-calendar icon"></i>
            </a>

            <ul class="dropdown-menu" aria-labelledby="dropdown07XL">
                @can('ver-sig')
                <li>
                    <a class="dropdown-item" href="{{ route('sig_works.index') }}">
                        SIG / Obras
                    </a>
                </li>
                @endcan

                @can('ver-sig-empresa')
                <li>
                    <a class="dropdown-item" href="{{ route('sig_companies.index') }}">
                        SIG / Empresa
                    </a>
                </li>
                @endcan

                @can('ver-sig-associado')
                <li>
                    <a class="dropdown-item" href="{{ route('sig_associate.index') }}">
                        SIG / Associado
                    </a>
                </li>
                @endcan
            </ul>
        </li>

        @can('alterar-senha')
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle text-white" href="#" id="dropdown07XL"
                data-bs-toggle="dropdown" aria-expanded="false">
                <i class="fa fa-lock icon"></i>
            </a>

            <ul class="dropdown-menu" aria-labelledby="dropdown07XL">

                <li>
                    <a class="dropdown-item" href="{{ route('user-password.password') }}">
                        Alterar
                    </a>
                </li>

            </ul>

        </li>
        @endcan

        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle text-white" href="#" id="dropdown07XL"
                data-bs-toggle="dropdown" aria-expanded="false">
                <i class="fa fa-sign-out icon"></i>
            </a>

            <ul class="dropdown-menu" aria-labelledby="dropdown07XL">
                <li>
                    <a class="dropdown-item" href="#">
                        <form action="{{ route('logout') }}" method="post">
                            @csrf
                            @method('post')
                            <button type="submit" class="btn btn-link dropdown-item">
                                SAIR DO SISTEMA
                            </button>
                        </form>
                    </a>
                </li>
            </ul>
        </li>

    </ul>
</div>