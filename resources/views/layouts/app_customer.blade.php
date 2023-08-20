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
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css"/><link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

        <title>SISTEMA INTEC | ACESSO RESTRITO</title>

        <style>
            /* Show it is fixed to the top 123 */

            .menu_bg{
                background:#000742;
            }
            footer {
                background-color: black;
                color: white;
                text-align: center;
                padding: 20px;
            }
            footer p {
                margin: 10px 0;
            }
            .parallax {
                background-image: url("{{ asset('images/header.png') }}");
                background-size: cover;
                background-position: center;
                height: 140px; /* Defina a altura desejada */
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
            footer {
                background-color: black;
                color: white;
                text-align: center;
                padding: 20px;
            }
            footer p {
                margin: 10px 0;
            }
            .parallax {
                background-image: url("{{ asset('images/header.png') }}");
                background-size: cover;
                background-position: center;
                height: 140px; /* Defina a altura desejada */
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
        </style>

        @stack('styles')
    </head>
    <body style="background: #f2f6fc">

        <header class="bg-dark text-white py-3 parallax">
            <div class="container d-flex justify-content-between align-items-center">
                <div class="logo">
                    <a class="navbar-brand" href="{{ route('dashboard.index') }}">
                        <img src="{{ asset('images/logo.png') }}" class="img-fluid" alt="Logomarca" width="280">
                    </a>
                </div>

                <ul class="navbar-nav me-0 mb-2 mb-md-0">
                    <li class="nav-item dropdown">
                        <i class="fa fa-user"></i>
                        {{ auth()->user()->name }}
                        <small>({{ \Auth::guard('web')->user()->role->name }})</small>
                    </li>
                </ul>
            </div>
        </header>

        <nav class="navbar navbar-expand-lg navbar-light bg-white">
            <div class="container">
                <button
                    class="navbar-toggler"
                    type="button"
                    data-bs-toggle="collapse"
                    data-bs-target="#navbarCollapse"
                    >
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarCollapse">
                    <ul class="navbar-nav">
                        @can('ver-pesquisas')
                        <li class="nav-item dropdown">
                            <a
                                class="nav-link dropdown-toggle"
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

                        <li class="nav-item dropdown">
                            <a
                                class="nav-link dropdown-toggle"
                                href="#"
                                id="dropdown07XL"
                                data-bs-toggle="dropdown"
                                aria-expanded="false"
                                >
                                <i class="fa fa-archive"></i> RELATÓRIO
                            </a>

                            <ul class="dropdown-menu" aria-labelledby="dropdown07XL">
                                 <li>
                                    <a
                                        class="dropdown-item"
                                        href="{{ route('sig_works.index') }}"
                                        >
                                        SIG / Obras
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <li class="nav-item dropdown">
                            <a
                                class="nav-link dropdown-toggle"
                                href="#"
                                id="dropdown07XL"
                                data-bs-toggle="dropdown"
                                aria-expanded="false"
                                >
                                <i class="fa fa-calendar"></i> SIG
                            </a>

                            <ul class="dropdown-menu" aria-labelledby="dropdown07XL">
                                <li>
                                    <a class="dropdown-item" href="#">
                                        Estamos em atualização
                                    </a>
                                </li>
                            </ul>
                        </li>

                        @can('ver-administrativo')
                        <li class="nav-item dropdown">
                            <a
                                class="nav-link dropdown-toggle"
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
                            </ul>
                        </li>
                        @endcan

                        <li class="nav-item dropdown">
                            <a
                                class="nav-link dropdown-toggle"
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

        <main class="container-fluid mt-3" style="background: #f2f6fc">
            @yield('content')
        </main>
        <a href="https://api.whatsapp.com/send?phone=5511988327074&text=&text=Ol%C3%A1%20tenho%20d%C3%BAvida%20sobre%20a%20plataforma%2C%20pode%20me%20ajudar%3F" class="whatsapp-button" target="_blank">
            <i class="fa fa-whatsapp whatsapp-icon"></i>
            Fale Conosco no WhatsApp
        </a>

        <footer>
            <p>Intec Brasil - Informações Técnicas da Construção - Todos os direitos reservados</p>
        </footer>
        <!-- Option 1: Bootstrap Bundle with Popper -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
                integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
                crossorigin="anonymous"></script>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.js"></script><!-- Inserido por Acessohost - 04/05/2023 - Renato Machado - para os Modais --> 

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
                $('.cnpj').mask('00.000.000/0000-00', {reverse: false});
                $('.date').mask('00/00/0000');
                $('.money').mask('000.000.000.000.000,00', {reverse: true});

                var SPMaskBehavior = function (val) {
                    return val.replace(/\D/g, '').length === 11 ? '(00) 00000-0000' : '(00) 0000-00009';
                },
                spOptions = {
                    onKeyPress: function (val, e, field, options) {
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
                    $(this).hide('slow');
                })

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
        </script>

        @stack('scripts')

    </body>
</html>
