@extends('layouts.app_customer_dashboard')

@section('content')

    <!--div 2-->
    
        <div class="row">
            <div class="col-12 col-md-12">
                <p class="pt-4"><img src='../images/logomarca_intec_menu.png' class="img-fluid" alt="Logomarca"></p>
            </div>

            <!-- Mobile Layout -->
            <div class="col-12 d-md-none">
                <div class="row">
                    <div class="col-12">
                        <nav class="navbar navbar-dark">
                            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                                data-bs-target="#mobileMenu" aria-controls="mobileMenu" aria-expanded="false"
                                aria-label="Toggle navigation">
                                <span class="navbar-toggler-icon"></span>
                            </button>

                            <div class="collapse navbar-collapse" id="mobileMenu">
                                <ul class="navbar-nav ms-auto px-1">

                                    <li class="nav-item dropdown pt-5 item1">
                                        <a class="nav-link text-white" href="{{ route('dashboard.index') }}"
                                            aria-expanded="false">
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
                                                <a class="dropdown-item"
                                                    href="{{ route('company.index') }}">Empresas</a>
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
                                                <a class="dropdown-item"
                                                    href="{{ route('company.search.step_one.index') }}">
                                                    Empresas
                                                </a>
                                            </li>
                                            @endcan

                                            @can('ver-pesquisa-de-obras')
                                            <li>
                                                <a class="dropdown-item"
                                                    href="{{ route('work.search.step_one.index') }}">
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
                        </nav>
                    </div>
                </div>
            </div>

        </div>

        <div class="row">
            <div class="col-5 col-md-6 custom-div-2 mt-5 shadow">

                <div class="row">
                    <div class="col-md-12">
                        <p><i class="fa fa-calendar icon"></i><br>
                            <strong class="cd">Compromissos do dia</strong><br>
                            <span style="color: #ff6b1a;"><strong>Reuniões do Dia</span></strong>
                        </p>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <p><i class="fa fa-calendar"></i> {{ date('d/m/Y') }}</p>
                    </div>
                    <div class="col-md-6">
                        <p><i class="fa fa-clock-o"></i> {{ date('H:i:s') }}</p>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <p><i class="fa fa-user"></i> <strong class="cd">{{ auth()->user()->name }}</strong></p>
                    </div>
                    <div class="col-md-6">
                        <p><i class="fa fa-map-marker"></i> <strong class="cd">São Paulo</strong></p>
                    </div>
                </div>

            </div>

            <div class="col-5 col-md-6 custom-div-2 mt-5 shadow">

                <div class="row">
                    <div class="col-md-12">
                        <p><i class="fa fa-calendar icon"></i><br>
                            <strong class="cd">Próximo compromisso</strong><br>
                            <span style="color: #ff6b1a;"><strong>Reuniões</span></strong>
                        </p>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <p><i class="fa fa-calendar"></i> 11/01/2023</p>
                    </div>
                    <div class="col-md-6">
                        <p><i class="fa fa-clock-o"></i> 10:00</p>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <p><i class="fa fa-user"></i> <strong class="cd">{{ auth()->user()->name }}</strong></p>
                    </div>
                    <div class="col-md-6">
                        <p><i class="fa fa-map-marker"></i> <strong class="cd">São Paulo</strong></p>
                    </div>
                </div>

            </div>

        </div>


        <div class="table-responsive top-report">

            <div class="col-md-12">

                <table class="table table-borderless">

                    <thead class="text-white">
                        <tr class="tr">
                            <th>REGIÕES</th>
                            <th class="d-none d-md-block text-center">TOTAL DE OBRAS</th>
                            <th class=" d-md-none">OBRAS</th>
                            <th class="text-center">RESIDENCIAL</th>
                            <th class="text-center">COMERCIAL</th>
                            <th class="text-center">INDUSTRIAL</th>
                        </tr>
                    </thead>

                    <tbody class="text-white text-lg">
                        <tr>
                            <td>Sul</td>
                            <td class="text-center">{{ $southWorksCount }}</td>
                            <td class="text-center">{{ $southResidentialWorks }}</td>
                            <td class="text-center">{{ $southComercialWorks }}</td>
                            <td class="text-center">{{ $southIndustrialWorks }}</td>
                        </tr>
                        <tr class="custom-tr">
                            <td>Sudeste</td>
                            <td class="text-center">{{ $southeastWorksCount }}</td>
                            <td class="text-center">{{ $southeastResidentialWorks }}</td>
                            <td class="text-center">{{ $southeastComercialWorks }}</td>
                            <td class="text-center">{{ $southeastIndustrialWorks }}</td>
                        </tr>
                        <tr>
                            <td>Norte</td>
                            <td class="text-center">{{ $northWorksCount }}</td>
                            <td class="text-center">{{ $northResidentialWorks }}</td>
                            <td class="text-center">{{ $northComercialWorks }}</td>
                            <td class="text-center">{{ $northIndustrialWorks }}</td>
                        </tr>
                        <tr class="custom-tr">
                            <td>Nordeste</td>
                            <td class="text-center">{{ $northeastWorksCount }}</td>
                            <td class="text-center">{{ $northeastResidentialWorks }}</td>
                            <td class="text-center">{{ $northeastComercialWorks }}</td>
                            <td class="text-center">{{ $northeastIndustrialWorks }}</td>
                        </tr>
                        <tr>
                            <td>Centro-Oeste</td>
                            <td class="text-center">{{ $midwestWorksCount }}</td>
                            <td class="text-center">{{ $midwestResidentialWorks }}</td>
                            <td class="text-center">{{ $midwestComercialWorks }}</td>
                            <td class="text-center">{{ $midwestIndustrialWorks }}</td>
                        </tr>
                    </tbody>

                </table>

            </div>

        </div>
@endsection