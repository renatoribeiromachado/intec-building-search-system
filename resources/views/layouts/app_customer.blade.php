<!DOCTYPE html>
<html lang="pt-BR">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <link
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"
            rel="stylesheet"
            integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC"
            crossorigin="anonymous"
            >
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css"/><link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
        <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
        
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
                background-image: url("{{ asset('images/header-dashboard-three.png') }}");
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
            
            .label-font-bold {
                font-weight: bold;
            }
            
           /* Estilo para o menu principal */
            .navbar-nav .nav-link {
                color: white; /* Cor do texto normal */
                transition: color 0.3s; /* Transição suave de cor */
            }

            /* Estilo quando o mouse passa por cima do link */
            .navbar-nav .nav-link:hover {
                color: yellow; /* Cor que o texto vai ficar ao passar o mouse */
            }

            /* Estilo para o menu dropdown */
            .navbar-nav .nav-item.dropdown:hover .dropdown-menu {
                display: block;
                background-color: #000d37; /* Cor de fundo do menu dropdown */
            }

            /* Estilo para os itens do menu dropdown */
            .navbar-nav .nav-item.dropdown .dropdown-menu .dropdown-item {
                color: white; /* Cor do texto normal no menu dropdown */
            }

            /* Estilo quando o mouse passa por cima do item do menu dropdown */
            .navbar-nav .nav-item.dropdown .dropdown-menu .dropdown-item:hover {
                color: black; /* Cor que o texto vai ficar ao passar o mouse */
            }

            /* Estilo para a <li> do menu dropdown */
            .navbar-nav .nav-item.dropdown:hover {
                background-color: #ff4600; /* Cor de fundo da <li> */
            }

            /* Estilo para o link dentro da <li> do menu dropdown */
            .navbar-nav .nav-item.dropdown:hover .nav-link {
                color: white; /* Cor do texto ao passar o mouse */
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
            
            .footer {
                text-align: center;
                color:white;
                padding: 20px;
                background-color: #000d37;
            }

            .social-icons {
                font-size: 24px;
                margin: 0 10px;
                color: #fff;
            }
        </style>

        @stack('styles')
    </head>
    <body style="background: #fff">

        <header class="bg-dark text-white py-3 parallax">
            <div class="container d-flex justify-content-between align-items-center">
                <div class="logo">
                    <a class="navbar-brand" href="{{ route('dashboard.index') }}">
                        <img src='{{ asset('images/logomarca-header.png') }}' class="img-fluid" alt="Logomarca" width="280">
                    </a>
                </div>

                <ul class="navbar-nav me-0 mb-2 mb-md-0">
                    <li class="nav-item dropdown text-white">
                        <i class="fa fa-user"></i>
                        {{ auth()->user()->name }}
                        <small>({{ \Auth::guard('web')->user()->role->name }})</small>
                    </li>
                </ul>
            </div> 
        </header>

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

        <main class="container-fluid mt-3" style="background: #fff">
            @yield('content')
        </main>
        <a href="https://api.whatsapp.com/send?phone=5511988327074&text=&text=Ol%C3%A1%20tenho%20d%C3%BAvida%20sobre%20a%20plataforma%2C%20pode%20me%20ajudar%3F" class="whatsapp-button" target="_blank">
            <i class="fa fa-whatsapp whatsapp-icon"></i>
            Fale Conosco no WhatsApp
        </a>

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

    </body>
</html>
