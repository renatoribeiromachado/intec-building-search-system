<!DOCTYPE html>
<html lang="pt-BR">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <!-- Bootstrap CSS -->
        <link
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"
            rel="stylesheet"
            integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC"
            crossorigin="anonymous"
        >
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
        <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

        <title>SISTEMA INTEC | ACESSO RESTRITO</title>

        <style>
            /* Show it is fixed to the top 123 */
            body {
                min-height: 75rem;
                padding-top: 6.5rem;
            }
            .menu_bg{
                background:#000742;
            }
        </style>

        @stack('styles')
    </head>
    <body style="background: #f2f6fc">
        <nav class="navbar navbar-expand-md navbar-dark fixed-top menu_bg">
            <div class="container-fluid">
                <div class="container">
                    <a class="navbar-brand" href="{{ route('dashboard.index') }}">
                        <img src="{{ asset('images/logo.png') }}" alt="Logo">
                    </a>
                    
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

                            @can('ver-pesquisas')
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
                                        @can('ver-pesquisa-de-empresas')
                                            <li>
                                                <a class="dropdown-item" href="#">
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

                            @can('ver-administrativo')
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
                                    </ul>
                                </li>
                            @endcan
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
            </div>
        </nav>
          
        <main class="container-fluid" style="background: #f2f6fc">
            @yield('content')
        </main>
        <!-- Option 1: Bootstrap Bundle with Popper -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
            crossorigin="anonymous"></script>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.js"></script><!-- Inserido por Acessohost - 04/05/2023 - Renato Machado - para os Modais --> 

        {{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> importar 2 versões de Jquery dá conflito e para de funcionar corretamente --}}
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
        <script>
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            
            $(document).ready(function () {
                $(".datepicker").datepicker({
                    dateFormat: 'yy-mm-dd' // Define o formato da data
                });

                // jquery mask
                $('.cep').mask('00000-000');
                $('.cnpj').mask('00.000.000/0000-00', {reverse: false});
                $('.date').mask('00/00/0000');
                $('.money').mask('000.000.000.000.000,00', {reverse: true});

                var SPMaskBehavior = function (val) {
                return val.replace(/\D/g, '').length === 11 ? '(00) 00000-0000' : '(00) 0000-00009';
                },
                spOptions = {
                onKeyPress: function(val, e, field, options) {
                    field.mask(SPMaskBehavior.apply({}, arguments), options);
                    }
                };
            
                $('.phone').mask(SPMaskBehavior, spOptions);

                // $(".cpfcnpj").keydown(function() {
                //     try {
                //         $(".cpfcnpj").unmask();
                //     } catch (e) {
                //         // console.log(e)
                //     }

                //     var tamanho = $(".cpfcnpj").val().length;

                //     if(tamanho < 11){
                //         $(".cpfcnpj").mask("999.999.999-99");
                //     } else {
                //         $(".cpfcnpj").mask("99.999.999/9999-99");
                //     }

                //     // adjusting the focus
                //     var elem = this;
                //     setTimeout(function(){
                //         // change the selector position
                //         elem.selectionStart = elem.selectionEnd = 10000;
                //     }, 0);
                //     // clone value to change the focus
                //     var currentValue = $(this).val();
                //     $(this).val('');
                //     $(this).val(currentValue);
                // });
                // end jquery mask

                // alerts
                $('.alert-success').on('click', function () {
                    $( this ).hide('slow');
                })

                setInterval(() => {
                    $('.alert-success').trigger( 'click' );
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
        </script>

        @stack('scripts')

    </body>
</html>
