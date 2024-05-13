<nav class="navbar navbar-expand-lg navbar-light" style="background: #000d37;">
            <div class="container">
                <button
                    class="navbar-toggler" style="background: #fff;"
                    type="button"
                    data-bs-toggle="collapse"
                    data-bs-target="#navbarCollapse"
                    >
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarCollapse">
                    
                    <ul class="navbar-nav">
                        
                         @can('ver-administrativo')
                            <li class="nav-item dropdown">
                                <a
                                    class="nav-link dropdown-toggle text-white"
                                    href="#"
                                    id="administrative"
                                    data-bs-toggle="dropdown"
                                    aria-expanded="false"
                                    >
                                    <i class="fa fa-check"></i> ADMINISTRATIVO
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
                                    @can('resultado-mensal')
                                        <li>
                                            <a class="dropdown-item" href="{{ route('mensalResult.index') }}">
                                                Resultado Mensal
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
                                    @can('saiba-mais')
                                    <li>
                                        <a class="dropdown-item" href="{{ route('knowMore.index') }}">
                                            Saiba Mais
                                        </a>
                                    </li>
                                    @endcan
                                </ul>
                            </li>
                        @endcan
                        
                        @can('login-associado')
                            <li class="nav-item dropdown">
                                <a
                                    class="nav-link dropdown-toggle text-white"
                                    href="#"
                                    id="dropdown07XL"
                                    data-bs-toggle="dropdown"
                                    aria-expanded="false"
                                    >
                                    <i class="fa fa-users"></i> MONITORAMENTO
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
                                <a
                                    class="nav-link dropdown-toggle text-white"
                                    href="#"
                                    id="dropdown07XL"
                                    data-bs-toggle="dropdown"
                                    aria-expanded="false"
                                    >
                                    <i class="fa fa-users"></i> MONITORAMENTO
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
                                <a
                                    class="nav-link dropdown-toggle text-white"
                                    href="#"
                                    id="dropdown07XL"
                                    data-bs-toggle="dropdown"
                                    aria-expanded="false"
                                    >
                                    <i class="fa fa-check"></i> DADOS DO PLANO
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
                                <a
                                    class="nav-link dropdown-toggle text-white"
                                    href="#"
                                    id="dropdown07XL"
                                    data-bs-toggle="dropdown"
                                    aria-expanded="false"
                                    >
                                    <i class="fa fa-search"></i> PESQUISAS
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
                                        <a
                                            class="dropdown-item"
                                            href="{{ route('work.search.step_one.index') }}"
                                            >
                                            Obras
                                        </a>
                                    </li>
                                    @endcan
                                </ul>
                            </li>
                        @endcan

                        @can('ver-relatorio')
                           {{-- <li class="nav-item dropdown">
                                <a
                                    class="nav-link dropdown-toggle text-white"
                                    href="#"
                                    id="dropdown07XL"
                                    data-bs-toggle="dropdown"
                                    aria-expanded="false"
                                    >
                                    <i class="fa fa-archive"></i> RELATÓRIO
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
                                <a
                                    class="nav-link dropdown-toggle text-white"
                                    href="#"
                                    id="dropdown07XL"
                                    data-bs-toggle="dropdown"
                                    aria-expanded="false"
                                    >
                                    <i class="fa fa-calendar"></i> RELATÓRIO SIG
                                </a>

                                <ul class="dropdown-menu" aria-labelledby="dropdown07XL">
                                    @can('ver-sig')
                                        <li>
                                            <a
                                                class="dropdown-item"
                                                href="{{ route('sig_works.index') }}"
                                                >
                                                SIG / Obras
                                            </a>
                                        </li>
                                    @endcan

                                    @can('ver-sig-empresa')
                                        <li>
                                            <a
                                                class="dropdown-item"
                                                href="{{ route('sig_companies.index') }}"
                                                >
                                                SIG / Empresa
                                            </a>
                                        </li>
                                    @endcan
                                    
                                    @can('ver-sig-associado')
                                        <li>
                                            <a
                                                class="dropdown-item"
                                                href="{{ route('sig_associate.index') }}"
                                                >
                                                SIG / Associado
                                            </a>
                                        </li>
                                    @endcan
                                </ul>
                            </li>
                            
                            @can('alterar-senha')
                                <li class="nav-item dropdown">
                                    <a
                                        class="nav-link dropdown-toggle text-white"
                                        href="#"
                                        id="dropdown07XL"
                                        data-bs-toggle="dropdown"
                                        aria-expanded="false"
                                        >
                                        <i class="fa fa-lock"></i> ALTERAR SENHA
                                    </a>
                                    
                                    <ul class="dropdown-menu" aria-labelledby="dropdown07XL">
                                     
                                        <li>
                                            <a
                                                class="dropdown-item"
                                                href="{{ route('user-password.password') }}"
                                                >
                                                Alterar
                                            </a>
                                        </li>
                                    
                                    </ul>
                                </li>
                            @endcan
                      
                        <li class="nav-item dropdown">
                            <a
                                class="nav-link dropdown-toggle text-white"
                                href="#"
                                id="dropdown07XL"
                                data-bs-toggle="dropdown"
                                aria-expanded="false"
                                >
                                <i class="fa fa-sign-out"></i>
                                SAIR DO SISTEMA
                            </a>

                            <ul class="dropdown-menu" aria-labelledby="dropdown07XL">
                                <li>
                                    <a class="dropdown-item" href="#">
                                        <form action="{{ route('logout') }}" method="post">
                                            @csrf
                                            @method('post')
                                            <button
                                                type="submit"
                                                class="btn btn-link dropdown-item"
                                                >
                                                Sair
                                            </button>
                                        </form>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>