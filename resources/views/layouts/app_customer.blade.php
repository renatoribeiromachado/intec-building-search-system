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
            background-image: url("{{ asset('images/header-dashboard-three.png') }}");
            background-size: cover;
            background-position: center;
            height: 140px;
            /* Defina a altura desejada */
            display: flex;
            align-items: center;
            justify-content: center;
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
       
        .label-font-bold {
            font-weight: bold;
        }

        .h6 {
            padding-top: 5px !important;
            font-size: 13px !important;
            font-weight: bold !important;
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

        .custon-div-bloco-3 {
            border-radius: 20px;
            padding: 10px !important;
            max-width: 90%;
            margin-right: 15px;
            margin-left: 15px;
            background: #e96300;
        }

        .label-font-bold {
            font-weight: bold;
        }

        
        /* Media query para notebooks com largura máxima de 1200px */
        @media screen and (min-width: 1201px) {
    
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

            .custom-div-bloco-3 {
                border-radius: 20px;
                padding: 10px;
                max-width: 90%;
                margin-right: 15px;
                margin-left: 15px;
                background: #e96300;
            }

            .div-search{
                border-radius: 20px;
                padding: 10px !important;
                max-width: 100%;
                margin-top: 30px;
                margin-left: 0;
                background: #e8edef;
                
            }

            .custom-div-bloco-search {
                border-radius: 20px;
                padding: 10px;
                max-width: 90%;
                margin-right: 15px;
                margin-left: 15px;
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

            .div-search{
                border-radius: 20px;
                padding: 10px !important;
                max-width: 100%;
                margin-top: 30px;
                margin-left: 0;
                background: #e8edef;
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
    </style>

    @stack('styles')
</head>

<body class="bg-dark parallax1">
  
    <div class="container-fluid">

        <div class="row pt-5">
            <!-- Desktop menu Layout -->
            <!--div 1-->
            <div class="col-md-2 d-none d-md-block">
                @include('layouts.includes.menu')  
            </div>

            <main class="col-md-8">
                @yield('content')
            </main>

            <!--div 3-->
            <div class="col-md-3" style="background: #fd753d;border-radius: 20px;max-width:23%;margin-left:25px;">
                <div class="row pt-3">
                    <div class="col-md-12 text-white custom-div-bloco-3">
                        <h4 class="title p-2">RESULTADO MENSAL</h4>

                        <p class="text-center pt-1 sub"><strong>2.344</strong> OBRAS NOVAS E ATUALIZADAS</p>
                        <p class="text-center subtiltle">Residencial: <strong>19.456</strong></p>
                        <p class="text-center subtiltle">Comercial: <strong>2598</strong></p>
                        <p class="text-center subtiltle">Industrial: <strong>1586</strong></p>
                    </div>
                </div>

                <div class="row pt-4">
                    <div class="col-md-12 text-white custom-div-bloco-3">
                        <h4 class="title p-2">ANALISE TRIMESTRAL</h4>

                        <div class="row pt-3">

                            <div class="col-6 col-md-6">
                                <img src="../images/analise-trimestral.png" class="img-fluid"
                                    alt="Resusltado trimestral Intec Brasil">
                            </div>

                            <div class="col-6 col-md-6">
                                <img src="../images/analise-trimestral.png" class="img-fluid"
                                    alt="Resusltado trimestral Intec Brasil">
                            </div>

                        </div>
                    </div>

                </div>

                <div class="row pt-4">
                    <div class="col-md-12 text-white custom-div-bloco-3">
                        <h4 class="title p-2">SAIBA MAIS</h4>

                        <div class="row pt-3">

                            <div class="col-4 col-md-5">
                                <img src="../images/agencia.png" class="img-fluid img-thumbnail"
                                    alt="Resusltado trimestral Intec Brasil">
                            </div>

                            <div class="col-8 col-md-7">
                                <p class="h6 text-dark">AGÊNCIA DE MARKETING DIGITAL INTEC BRASIL</p>
                            </div>

                        </div>

                        <div class="row pt-3">

                            <div class="col-4 col-md-5">
                                <img src="../images/agencia2.png" class="img-fluid img-thumbnail"
                                    alt="Resusltado trimestral Intec Brasil">
                            </div>

                            <div class="col-8 col-md-7">
                                <p class="h6 text-dark">FINALIZAMOS APURAÇÃO DAS 100 MAIORES CONSTRUTORAS DO BRASIL!</p>
                            </div>

                        </div>
                    </div>

                </div>
            </div>

            <!--OBRAS GERAL -->
            <div class="row mt-5 pb-5 bg-white parallax2 total-work">

                <div class="col-md-12 mt-5">
                    <h2 class="text-center title-work">MAIS DE 19 MIL GRANDES OBRAS CATALOGADAS</h2>
                </div>

                <div class="row mt-2">

                    <div class="col-md-4 pt-5 pb-5 border-right">
                        <h2 class="text-center h1">{{ $residentialWorks }}</h2>
                        <p class="text-center p-work">Obras Residenciais</p>
                    </div>

                    <div class="col-md-4 pt-5 pb-5 border-right">
                        <h2 class="text-center h1">{{ $businessWorks }}</h2>
                        <p class="text-center p-work">Obras comerciais</p>
                    </div>

                    <div class="col-md-4 pt-5 pb-5">
                        <h2 class="text-center h1">{{ $industrialWorks }}</h2>
                        <p class="text-center p-work">Obras Industriais</p>
                    </div>

                </div>

            </div>
            
            <!--Footer-->
            @include('layouts.includes.footer')

            <!-- Option 1: Bootstrap Bundle with Popper -->
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
                integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
                crossorigin="anonymous"></script>

            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
         
            <!-- Inserido por Acessohost - 04/05/2023 - Renato Machado - para os Modais -->
            <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
            
            @stack('scripts')
        </div>

        <!--botão whatsapp-->
        @include('layouts.includes.whatsapp')

    </div>

</body>
</html>