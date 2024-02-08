<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet"
        type="text/css" />
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

    <title>SISTEMA INTEC | ACESSO RESTRITO</title>

    <style>
        .parallax {
            background-image: url("{{ asset('images/header.png') }}");
            background-size: cover;
            background-position: center;
            height: 140px;
            /* Defina a altura desejada */
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .whatsapp-button {
            position: fixed;
            bottom: 20px;
            right: 20px;
            background-color: green;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 50px;
            font-size: 18px;
            cursor: pointer;
            box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.3);
            display: flex;
            align-items: center;
            text-decoration: none;
        }

        .whatsapp-icon {
            font-size: 24px;
            margin-right: 10px;
        }

        .parallax {
            background-image: url("{{ asset('images/header.png') }}");
            background-size: cover;
            background-position: center;
            height: 140px;
            /* Defina a altura desejada */
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .whatsapp-button {
            position: fixed;
            bottom: 20px;
            right: 20px;
            background-color: green;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 50px;
            font-size: 18px;
            cursor: pointer;
            box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.3);
            display: flex;
            align-items: center;
            text-decoration: none;
        }

        .whatsapp-icon {
            font-size: 24px;
            margin-right: 10px;
        }

        .parallax {
            background-image: url("{{ asset('images/header-dashboard-three.png') }}");
            background-size: cover;
            background-position: center;
            height: 140px;
            /* Defina a altura desejada */
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .whatsapp-button {
            position: fixed;
            bottom: 20px;
            right: 20px;
            background-color: green;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 50px;
            font-size: 18px;
            cursor: pointer;
            box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.3);
            display: flex;
            align-items: center;
            text-decoration: none;
        }

        .whatsapp-icon {
            font-size: 24px;
            margin-right: 10px;
        }

        .label-font-bold {
            font-weight: bold;
        }

        /*Auto-complete Obras/empresas*/
        .autocomplete-list {
            position: absolute;
            z-index: 1000;
            background-color: #fff;
            border: 1px solid #ccc;
            width: auto;
            max-height: 200px;
            overflow-y: auto;
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .autocomplete-list li {
            padding: 8px;
            cursor: pointer;
            transition: background-color 0.2s;
        }

        .autocomplete-list li:hover {
            background-color: #f5f5f5;
        }

        #autocomplete-input {
            position: relative;
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

        .h6 {
            padding-top: 5px !important;
            font-size: 13px !important;
            font-weight: bold !important;
        }

        .parallax1 {
            background-image: url("../images/parallax-1-1.png");
            background-size: cover;
            background-position: center;
            height: auto;
            /* Defina a altura desejada */
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .parallax2 {
            background-image: url("../images/parallax-3.png");
            background-size: cover;
            background-position: center;
            height: auto;
            /* Defina a altura desejada */
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .text-lg {
            font-size: 1.5rem;
        }

        .col-md-2 {
            flex: 0 0 8.33333%;
            /* Define a largura da coluna para 8.33333%, ou seja, uma coluna em um total de 12 */
            max-width: 10.2% !important;
        }

        .user-icon {
            position: absolute;
            top: 30%;
            left: 18%;
            font-size: 2rem;
            /* Ajuste o tamanho do ícone conforme necessário */
            color: #ffffff;
        }

        .custom-tr {
            background: rgba(50, 50, 50, 0.9);
            /* Cor de fundo com opacidade de 0.1 */
        }

        .top-report {
            margin-top: 100px;
        }

        .social-icons {
            font-size: 24px;
            margin: 0 10px;
            color: #000;
            transition: color 0.3s;
            /* Adiciona uma transição suave para a mudança de cor */
        }

        .social-icons:hover {
            color: #ff6b1a;
            /* Altera a cor para vermelho ao passar o mouse */
        }

        .icon {
            font-size: 1.6rem;
            /* Ajuste o tamanho do ícone conforme necessário */
        }

        .tr {
            background: #ff6b1a;
            border-radius: 50px !important;
        }

        .title {
            background: #fff;
            color: #ff6b1a;
            border-radius: 20px;
            padding-left: 20px;
            padding-right: 10px;
            font-size: 20px;
            text-align: center;
        }

        .total-work {
            min-height: 500px;
            border-top-left-radius: 400px;
        }

        .title-work {
            color: #ff6b1a;
            font-size: 38px;
        }

        .p-work {
            font-size: 20px;
        }

        .border-right {
            border-right: 6px solid #ff6b1a;
        }

        .subtiltle {
            font-size: 19px;
        }

        .custom-menu {
            width: 118px !important;
            height: 750px !important;
            background-color: #ff6b1a;
            border-radius: 40px;
        }

        .custom-div-2 {
            border-radius: 20px;
            padding: 10px !important;
            max-width: 45.8%;
            margin-right: 15px;
            margin-left: 17px;
            background: #fff;
        }

        .div-2 {
            padding: 10px !important;
            margin-left: 20px;
        }

        .div-3 {
            border-radius: 20px;
            padding: 10px !important;
            max-width: 45.8%;
            margin-left: 65px;
            background: #ff6b1a;
        }

                
        /*Auto-complete Obras/empresas*/
        .autocomplete-list {
            position: absolute;
            z-index: 1000;
            background-color: #fff;
            border: 1px solid #ccc;
            width: auto;
            max-height: 200px;
            overflow-y: auto;
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .autocomplete-list li {
            padding: 8px;
            cursor: pointer;
            transition: background-color 0.2s;
        }

        .autocomplete-list li:hover {
            background-color: #f5f5f5;
        }

        #autocomplete-input {
            position: relative;
        }

        .whatsapp-button {
            position: fixed;
            bottom: 20px;
            right: 20px;
            background-color: green;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 50px;
            font-size: 18px;
            cursor: pointer;
            box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.3);
            display: flex;
            align-items: center;
            text-decoration: none;
        }

        .whatsapp-icon {
            font-size: 24px;
            margin-right: 10px;
        }

        .label-font-bold {
            font-weight: bold;
        }

        footer {
            color: black;
            text-align: center;
            padding: 20px;
        }

        footer p {
            margin: 10px 0;
        }

        /* Media query para notebooks com largura máxima de 1200px */
        @media screen and (min-width: 1201px) {
            .custom-menu {
                width: 80px;
                /* Reduz a largura do menu para notebooks */
            }

            .custom-div-2 {
                border-radius: 20px;
                padding: 10px;
                max-width: 40.8%;
                margin-right: 15px;
                margin-left: 17px;
                background: #fff;
            }

            .div-2 {
                padding: 10px;
                margin-left: 20px;
            }

            .div-3 {
                border-radius: 20px;
                padding: 10px;
                max-width: 40.8%;
                margin-left: 65px;
                background: #ff6b1a;
            }

            
            .div-search{
                border-radius: 20px;
                padding: 10px !important;
                max-width: 20%;
                margin-top: 30px;
                margin-left: 0;
                background: #e8edef;
                
            }
            
            .custom-works {
                border-radius: 20px;
                padding: 23px;
                max-width: 80%;
                margin-right: 45px;
                margin-left: 45px;
                background: #000;
            }

            .title {
                background: #fff;
                color: #ff6b1a;
                border-radius: 20px;
                padding-left: 20px;
                padding-right: 10px;
                font-size: 16px;
                text-align: center;
            }

            .cd {
                font-size: 12px;
            }

            .sub {
                font-size: 14px !important;
            }

            .subtiltle {
                font-size: 17px;
            }
        }

        /*Celular*/
        @media (max-width: 767px) {

            /* Estilos específicos para dispositivos móveis */
            .user-icon {
                font-size: 2rem;
                /* Tamanho menor para telas menores */
                top: 40%;
                /* Ajuste a posição vertical conforme necessário para dispositivos móveis */
                left: 18%;
                /* Ajuste a posição horizontal conforme necessário para dispositivos móveis */
            }

            .text-lg {
                font-size: 1.0rem;
            }

            .tr {
                background: #ff6b1a;
                border-radius: 50px !important;
            }

            .top-report {
                margin-top: 30px;
            }

            .title-work {
                color: #ff6b1a;
                font-size: 24px;
            }

            .title {
                background: #fff;
                color: #ff6b1a;
                border-radius: 20px;
                padding-left: 20px;
                padding-right: 10px;
                font-size: 18px;
                text-align: center;
            }

            .total-work {
                min-height: 300px !important;
                border-top-left-radius: 120px;
            }

            .div-2 {
                padding: 10px !important;
                margin-left: 0px;
            }

            .div-3 {
                border-radius: 20px;
                padding: 10px !important;
                max-width: 100%;
                margin-top: 30px;
                margin-left: 0;
                background: #ff6b1a;
            }

            .mt-5 {
                margin-top: 30px !important;
            }

            .pt-4 {
                padding-top: 15px !important;
            }

            .pt-5 {
                padding-top: 20px !important;
            }

            .pb-5 {
                padding-bottom: 20px !important;
            }

            .cd {
                font-size: 14px;
            }

            .pl-10 {
                padding-left: 10px !important;
            }

            .social-icons {
                font-size: 24px;
                margin: 0 10px;
                color: #fff;
            }

            footer {
                color: black;
                text-align: center;
                padding: 20px;
            }

            footer p {
                margin: 10px 0;
            }

            .p-mobile-footer {
                font-size: 13px !important;
            }

        }

        /* Estilo para o datepicker */
        .flatpickr-calendar {
            background-color: #000 !important; /* Altere para a cor desejada */
            color: #fff !important; /* Altere para a cor desejada */
            border: ipx solid #000 !important; /* Altera a cor da borda para preto */
        }

        /* Estilo para a borda do datepicker */
        .flatpickr-calendar .flatpickr-innerContainer {
            border: 1px solid #000 !important; /* Altera a cor da borda para preto */
        }

        /* Estilo para os números do dia dentro do datepicker */
        .flatpickr-day {
            color: #fff !important; /* Altere para a cor desejada */
        }
        /* Estilo para o título do mês dentro do datepicker */
        .flatpickr-month {
            color: #fff !important; /* Altere para a cor desejada */
        }
        /* Estilo para a seta esquerda (anterior) */
        .flatpickr-prev-month {
            color: #fff !important; /* Altere para a cor desejada */
        }

        /* Estilo para a seta direita (próximo) */
        .flatpickr-next-month {
            color: #fff !important; /* Altere para a cor desejada */
        }
        /* Estilo para o dia atual */
        .today {
            background-color: #ff6600 !important; /* Altere para a cor desejada */
            color: #fff !important; /* Altere para a cor desejada */
        }
    </style>

    @stack('styles')
</head>

<body class="bg-white parallax1">

    <div class="container-fluid">

        <div class="row pt-5">
            <!-- Desktop Layout -->
            <!--div 1-->
            <div class="col-md-1 d-none d-md-block">

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
            </div>

            <main class="col-md-8">
                @yield('content')
            </main>

            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
            <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
            
            <!--div 3-->
            <div class="col-md-3" style="background: #e8edef;border-radius: 20px;max-width:23%;margin-left:25px;">
                <div class="row pt-3">
                    <div class="custom-works" style="padding:22px;">
                        <span id="datepicker-container"></span>
                    </div>
                </div>

                <script>
                    document.addEventListener('DOMContentLoaded', function () {
                        // Configurar o datepicker usando Flatpickr
                        flatpickr("#datepicker-container", {
                            inline: true, // Exibe o datepicker diretamente no contêiner
                            dateFormat: "d/m/Y", // Formato da data (opcional, ajuste conforme necessário)
                            onOpen: function () {
                                // O que fazer quando o datepicker é aberto
                                console.log("Datepicker aberto!");
                            },
                            onClose: function () {
                                // O que fazer quando o datepicker é fechado
                                console.log("Datepicker fechado!");
                            },
                            style: "border: none !important;"
                        });
                    });
                </script>

                <div class="row pt-4">
                    <div class="text-white custom-works">
                        <h1 class="text-center">8599</h1>
                        <h5 class="text-center">Obras Residenciais</h5> 
                    </div>
                </div>

                <div class="row pt-4">
                    <div class="text-white custom-works">
                        <h1 class="text-center">7476</h1>
                        <h5 class="text-center">Obras Comerciais</h5> 
                    </div>
                </div>

                <div class="row pt-4">
                    <div class="text-white custom-works">
                        <h1 class="text-center">5231</h1>
                        <h5 class="text-center">Obras Industriais</h5> 
                    </div>
                </div>
            </div>


            <footer class="footer mt-5">
                <div class="container">
                    <div class="row">
                        <div class="col-md-6">
                            <p>Redes sociais:<br>
                                <a href="https://www.facebook.com/" target="_blank" class="social-icons">
                                    <i class="fa fa-facebook"></i>
                                </a>
                                <a href="https://www.instagram.com/" target="_blank" class="social-icons">
                                    <i class="fa fa-instagram"></i>
                                </a>
                            </p>
                        </div>

                        <div class="col-md-6">
                            <p>Entre em contato:<br>
                                contato@intecbrasil.com.br<br>
                                (11) 4659-0013<br>
                                Rua Alencar Araripe, 985 - Sacomã - São Paulo - SP</p>
                        </div>

                    </div>

                    <div class="row mt-2">
                        <div class="col-md-12">
                            <p>Intec Brasil - Informações Técnicas da Construção - Todos os direitos reservados</p>
                        </div>
                    </div>
                </div>

            </footer>

            <!-- Option 1: Bootstrap Bundle with Popper -->
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
                integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
                crossorigin="anonymous"></script>

            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.js"></script>
            <!-- Inserido por Acessohost - 04/05/2023 - Renato Machado - para os Modais -->

            <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
            <script>

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $(document).ready(function () {
                    $(".datepicker").datepicker({
                        // dateFormat: 'yy-mm-dd' // Define o formato da data
                        dateFormat: 'dd/mm/yy' // Define o formato da data
                    });

                    // jquery mask
                    $('.cep').mask('00000-000');
                    $('.cnpj').mask('00.000.000/0000-00', { reverse: false });
                    $('.date').mask('00/00/0000');
                    $('.money').mask('000.000.000.000.000,00', { reverse: true });

                    var SPMaskBehavior = function (val) {
                        return val.replace(/\D/g, '').length === 11 ? '(00) 00000-0000' : '(00) 0000-00009';
                    },
                        spOptions = {
                            onKeyPress: function (val, e, field, options) {
                                field.mask(SPMaskBehavior.apply({}, arguments), options);
                            }
                        };

                    $('.phone').mask(SPMaskBehavior, spOptions);

                    // Manipular o evento keyup do CEP usando jQuery
                    $('#zip_code').keyup(function () {
                        const zipCode = $(this).val();
                        const url = `https://viacep.com.br/ws/${zipCode}/json/`;

                        fetch(url)
                            .then(response => {
                                if (!response.ok) {
                                    throw new Error('Erro na solicitação');
                                }
                                return response.json();
                            })
                            .then(resposta => {
                                $('#address').val(resposta.logradouro);
                                $('#district').val(resposta.bairro);
                                $('#city').val(resposta.localidade);
                                $('#state option[value="' + resposta.uf + '"]').prop('selected', true);
                                $('#number').focus();
                            })
                            .catch(error => {
                                console.error(error);
                                // Lide com erros aqui
                            });
                    });

                    // alerts
                    $('.alert-success').on('click', function () {
                        $(this).hide('slow');
                    });

                    setInterval(() => {
                        $('.alert-success').trigger('click');
                    }, 3000);
                    // end alerts
                });

                base_url = function () {
                    if (document.location.hostname === "localhost") {
                        var url = "{!! config('app.url') !!}/";
                    } else {
                        var url = "{!! config('app.url') !!}";
                    }
                    return url;
                };

                /*Auto-complete Obras/Empresas - Renato Machado 31/08/2023*/
                const autocompleteInput = document.getElementById('autocomplete-input');
                const autocompleteList = document.getElementById('autocomplete-list');

                autocompleteInput.addEventListener('input', async (event) => {
                    const query = event.target.value;
                    if (query.length >= 1) {
                        const companies = await fetchCompanies(query);
                        updateAutocomplete(companies);
                    } else {
                        clearAutocompleteList();
                    }
                });

                document.addEventListener('click', (event) => {
                    if (!autocompleteInput.contains(event.target)) {
                        clearAutocompleteList();
                    }
                });

                async function fetchCompanies(query) {
                    const response = await fetch(`/works/works/getCompany?search=${query}`);
                    const data = await response.json();
                    return data;
                }

                function updateAutocomplete(results) {
                    clearAutocompleteList();

                    results.forEach(company => {
                        const listItem = document.createElement('li');
                        listItem.textContent = company.trading_name;
                        listItem.addEventListener('click', () => {
                            autocompleteInput.value = company.trading_name;
                            clearAutocompleteList();
                        });
                        autocompleteList.appendChild(listItem);
                    });

                    autocompleteList.style.display = 'block';
                }

                function clearAutocompleteList() {
                    autocompleteList.innerHTML = '';
                    autocompleteList.style.display = 'none';
                }

                /*Auto-complete Empresas (Razão social) - Renato Machado 31/08/2023*/
                const autocompleteInputRz = document.getElementById('autocomplete-input-rz');
                const autocompleteListRz = document.getElementById('autocomplete-list-rz');

                autocompleteInputRz.addEventListener('input', async (event) => {
                    const query = event.target.value;
                    if (query.length >= 1) {
                        const companies = await fetchCompaniesRz(query);
                        updateAutocompleteRz(companies);
                    } else {
                        clearAutocompleteListRz();
                    }
                });

                document.addEventListener('click', (event) => {
                    if (!autocompleteInputRz.contains(event.target)) {
                        clearAutocompleteListRz();
                    }
                });

                async function fetchCompaniesRz(query) {
                    const response = await fetch(`/works/works/getCompanyName?searchCompany=${query}`);
                    const data = await response.json();
                    return data;
                }

                function updateAutocompleteRz(results) {
                    clearAutocompleteListRz();

                    results.forEach(company => {
                        const listItem = document.createElement('li');
                        listItem.textContent = company.company_name;
                        listItem.addEventListener('click', () => {
                            autocompleteInputRz.value = company.company_name;
                            clearAutocompleteListRz();
                        });
                        autocompleteListRz.appendChild(listItem);
                    });

                    autocompleteListRz.style.display = 'block';
                }

                function clearAutocompleteListRz() {
                    autocompleteListRz.innerHTML = '';
                    autocompleteListRz.style.display = 'none';
                }

            </script>

            @stack('scripts')
        </div>

        <a href="https://api.whatsapp.com/send?phone=5511988327074&text=&text=Ol%C3%A1%20tenho%20d%C3%BAvida%20sobre%20a%20plataforma%2C%20pode%20me%20ajudar%3F"
            class="whatsapp-button" target="_blank">
            <i class="fa fa-whatsapp whatsapp-icon"></i>
            Fale Conosco no WhatsApp
        </a>

    </div>

</body>

</html>