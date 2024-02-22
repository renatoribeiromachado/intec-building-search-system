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

    <title>INTEC BRASIL - PROSPECTE EM GRANDES OBRAS E CONSTRUTORAS</title>

    <style>

        

        /* CSS para mudar a cor do link da paginação para laranja */
        .pagination .page-link {
            color: #ff6b1a; /* Cor laranja */
        }

        /* CSS para mudar a cor do link ativo da paginação para laranja */
        .pagination .page-item.active .page-link {
            background-color: #ff6b1a; /* Cor de fundo laranja */
            border-color: #ff6b1a; /* Cor da borda laranja */
        }

        .orange-btn {
            background-color: #ff6b1a; /* Cor de fundo laranja */
            border-color: #ff6b1a; /* Cor da borda laranja */
            color: #fff; /* Cor do texto branco */
        }

        .orange-icon {
            color: #ff6b1a; /* Cor laranja */
        }

        /* Estilos para o checkbox laranja */
        .orange-checkbox {
            width: 14px;
            height: 14px;
            border: 2px solid #ff6b1a; /* Cor da borda laranja */
            border-radius: 3px;
            outline: none;
            transition: background-color 0.3s;
            position: relative;
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;
        }

        /* Estilos para o preenchimento do checkbox quando marcado */
        .orange-checkbox:checked {
            background-color: #ff6b1a; /* Cor de fundo laranja */
        }

        /* Estilos para o ícone de check */
        .orange-checkbox::after {
            content: '\f00c'; /* Código do ícone de check do Font Awesome */
            font-family: 'FontAwesome';
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            color: #fff; /* Cor do ícone branco */
            font-size: 12px; /* Tamanho do ícone */
            opacity: 0;
            transition: opacity 0.3s;
        }

        /* Estilos para o ícone de check quando o checkbox está marcado */
        .orange-checkbox:checked::after {
            opacity: 1;
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
        .block3{
            background:#e8edef;border-radius: 20px;max-width:25%;margin-left:25px;
        }
        
        .custom-works {
            border-radius: 20px;
            padding: 23px;
            max-width: 80%;
            margin-right: 45px;
            margin-left: 45px;
            background: #000;
        }

        .datepicker-container{
            padding:22px;
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

        .label-font-bold {
            font-weight: bold;
        }

        /* Estilo para o datepicker */
        .flatpickr-calendar {
            background-color: #000 !important; /* Altere para a cor desejada */
            color: #fff !important; /* Altere para a cor desejada */
            border: ipx solid #000 !important; /* Altera a cor da borda para preto */
            max-width: 275px !important;
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

        /* Media query para notebooks com largura máxima de 1200px */
        @media only screen and (min-width: 1201px) and (max-device-width: 1600px) {
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

            .block3{
                background:#e8edef;border-radius: 20px;max-width:21%;margin-left:25px;
            }
            
            .custom-works {
                border-radius: 20px;
                padding: 20px;
                max-width: 80%;
                margin-right: 30px;
                margin-left: 30px;
                background: #000;
            }

            .datepicker-container{
                padding:22px;
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

            /* Estilo para o datepicker */
            .flatpickr-calendar {
                background-color: #000 !important; /* Altere para a cor desejada */
                color: #fff !important; /* Altere para a cor desejada */
                border: ipx solid #000 !important; /* Altera a cor da borda para preto */
                max-width: 180px !important;
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

            .datepicker-container{
                padding-left:10% !important;
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

            .block3{
                background:#e8edef;border-radius: 20px;max-width:96%;margin:10px;
            }

            .custom-works {
                border-radius: 20px;
                padding: 23px;
                max-width: 100%;
                margin-right: 0px;
                margin-left: 0px;
                background: #000;
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
        }

        /* Estilo para o datepicker */
        .flatpickr-calendar {
            background-color: #000 !important; /* Altere para a cor desejada */
            color: #fff !important; /* Altere para a cor desejada */
            border: ipx solid #000 !important; /* Altera a cor da borda para preto */
            max-width: 275px;
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

<body class="bg-white">

    <div class="container-fluid">

        <div class="row pt-5">
            <!-- div 1 - Desktop Menu Layout -->
            <div class="col-md-2 d-none d-md-block">
                @include('layouts.includes.menu') 
            </div>

            <!--Main-->
            <main class="col-md-8">

                <div class="row">
                    @include('layouts.includes.menu_mobile') 
                    @include('layouts.includes.sig') 
                </div>

                @yield('content')
            </main>

            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
            <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
            <!-- Carregue o arquivo JavaScript do idioma Português do Flatpickr -->
            <script src="https://npmcdn.com/flatpickr/dist/l10n/pt.js"></script>
            
            <!--div 3-->
            <div class="col-md-3 block3">
                <div class="row pt-3">
                    <div class="custom-works datepicker-container">
                        <span id="datepicker-container"></span>
                    </div>
                </div>

                <script>
                    document.addEventListener('DOMContentLoaded', function () {
                        // Configurar o datepicker usando Flatpickr
                        flatpickr("#datepicker-container", {
                            inline: true, // Exibe o datepicker diretamente no contêiner
                            dateFormat: "d/m/Y", // Formato da data (opcional, ajuste conforme necessário)
                            locale: "pt", // Definindo o idioma para Português
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
                        <h1 class="text-center">{{ $residentialWorks }}</h1>
                        <h5 class="text-center">Obras Residenciais</h5> 
                    </div>
                </div>

                <div class="row pt-4">
                    <div class="text-white custom-works">
                        <h1 class="text-center">{{ $businessWorks }}</h1>
                        <h5 class="text-center">Obras Comerciais</h5> 
                    </div>
                </div>

                <div class="row pt-4">
                    <div class="text-white custom-works">
                        <h1 class="text-center">{{ $industrialWorks }}</h1>
                        <h5 class="text-center">Obras Industriais</h5> 
                    </div>
                </div>

            </div>

            @include('layouts.includes.footer')

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
        
        <!--botão whatsapp-->
        @include('layouts.includes.whatsapp')

    </div>

</body>
</html>