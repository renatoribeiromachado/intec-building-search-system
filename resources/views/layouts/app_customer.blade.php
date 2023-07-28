<!DOCTYPE html>
<html lang="pt-BR">
    <head>
        {{-- <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Document</title> --}}

        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

        <title>SISTEMA SINTEC | ACESSO RESTRITO</title>

        <style>
            /* Show it is fixed to the top */
            body {
                min-height: 75rem;
                padding-top: 4.5rem;
            }
        </style>

        @stack('styles')
    </head>
    <body>
        <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
            <div class="container-fluid">
                <a class="navbar-brand" href="{{ route('dashboard') }}">INTEC</a>
                <button
                    class="navbar-toggler"
                    type="button"
                    data-bs-toggle="collapse"
                    data-bs-target="#navbarCollapse"
                    aria-controls="navbarCollapse"
                    aria-expanded="false" aria-label="Toggle navigation"
                    >
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarCollapse">
                    <ul class="navbar-nav me-auto mb-2 mb-md-0">
                        <li class="nav-item">
                            <a
                                class="nav-link active"
                                aria-current="page"
                                href="{{ route('dashboard') }}"
                                >
                                Início
                            </a>
                        </li>
                        {{-- <li class="nav-item">
                            <a class="nav-link" href="#">Link</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
                        </li> --}}
                        <li class="nav-item dropdown">
                            <a
                                class="nav-link dropdown-toggle"
                                href="#"
                                id="dropdown07XL"
                                data-bs-toggle="dropdown"
                                aria-expanded="false"
                                >
                                PESQUISAS
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="dropdown07XL">
                                {{-- @can('ver-empresas') --}}
                                    <li><a class="dropdown-item" href="#">Empresas</a></li>
                                {{-- @endcan --}}

                                <li><a class="dropdown-item" href="{{ route('search.work.index') }}">Obras</a></li>
                            </ul>
                        </li>

                        <li class="nav-item dropdown">
                            <a
                                class="nav-link dropdown-toggle"
                                href="#"
                                id="administrative"
                                data-bs-toggle="dropdown"
                                aria-expanded="false"
                                >
                                ADMINISTRATIVO
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="administrative">
                                {{-- @can('ver-empresas') --}}
                                    <li><a class="dropdown-item" href="{{ route('company.index') }}">Empresas</a></li>
                                {{-- @endcan --}}

                                <li>
                                    <a class="dropdown-item" href="{{ route('activity_field.index') }}">
                                        Atividades de Empresas
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="{{ route('user.index') }}">
                                        Usuários
                                    </a>
                                </li>
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
                                    <a class="dropdown-item" href="{{ route('role.index') }}">
                                        Perfis de Usuários
                                    </a>
                                </li>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="{{ route('position.index') }}">
                                        Cargos
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                    {{-- <form class="d-flex">
                        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                        <button class="btn btn-outline-success" type="submit">Search</button>
                    </form> --}}
                    <ul class="navbar-nav me-0 mb-2 mb-md-0">
                        <li class="nav-item dropdown">
                            <a
                                class="nav-link dropdown-toggle"
                                href="#"
                                id="dropdown-logout"
                                data-bs-toggle="dropdown"
                                aria-expanded="false"
                                >
                                {{ auth()->user()->name }} <small>({{ \Auth::guard('web')->user()->role->name; }})</small>
                            </a>

                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdown-logout">
                                <li>
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
                                </li>
                            </ul>
                        </li>
                    </ul>
                    {{-- 
                    <form action="{{ route('logout') }}" class="d-flex">
                        <button class="btn btn-link" type="submit">Sair</button>
                    </form> --}}
                </div>
            </div>
        </nav>
          
        <main class="container">
            @yield('content')
        </main>
        <!-- Option 1: Bootstrap Bundle with Popper -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.js"></script>
        <script>
            $(document).ready(function () {
                // jquery mask
                $('.cep').mask('00000-000');
                $('.cnpj').mask('00.000.000/0000-00', {reverse: false});
                $('.date').mask('00/00/0000');
                // $('.money').mask('000.000.000.000.000,00', {reverse: true});

                var SPMaskBehavior = function (val) {
                return val.replace(/\D/g, '').length === 11 ? '(00) 00000-0000' : '(00) 0000-00009';
                },
                spOptions = {
                onKeyPress: function(val, e, field, options) {
                    field.mask(SPMaskBehavior.apply({}, arguments), options);
                    }
                };
            
                $('.phone').mask(SPMaskBehavior, spOptions);
                // end jquery mask
            });

            base_url = function () {
                if (document.location.hostname === "localhost") {
                    var url = "{!! config('app.url') !!}/";
                } else {
                    var url = "{!! config('app.url') !!}";
                }
                return url;
            };
        </script>

        @stack('scripts')

    </body>
</html>