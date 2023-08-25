@extends('layouts.app_customer')

@section('content')

<style>
            .no-border {
                border: 1px solid white;
                background: white;
            }
            .parallax {
                background-image: url("../images/header-dashboard-three.png");
                background-size: cover;
                background-position: center;
                height: 140px; /* Defina a altura desejada */
                display: flex;
                align-items: center;
                justify-content: center;
            }

        </style>
        
        <div class="container-fluid">
            <div class="container">
                <div class="row mt-5">
                    <div class="col-md-12 text-center">
                        <h2 style="color: #000d37;">Bem vindo a INTEC</h2>
                        <h3 style="color: #f64004;">A principal ferramenta de prospecção de obras do pais</h3>
                    </div>
                </div>

                <div class="row mt-5">
                    <div class="col-md-4 pt-5">
                        <h3 class="text-center" style="color: #000d37;"><strong>Dominando a <br>Prospecção em Obras</strong></h3>
                        <p class="text-center" style="font-size:18px;">Gerando leads de alta qualidade, nosso compromisso é elevar o seu sucesso com parceria e inovação. Para quem sabe o que quer, 
                            a INTEC é a chave para uma prospecção inteligente no mercado da construção civil. </p>

                        <p class="text-center" style="color: #f64004;"><strong>Enquanto alguns esperam, nós te colocamos à frente.</strong></p>

                    </div>
                    <div class="col-md-8">
                        <h3 class="text-center">Obras no Sistema</h3>
                        <div class="table-responsive">
                            <table class="table table-bordered">

                                <thead class="text-center" style="border: 1px solid #000d37;">

                                    <tr class="text-white" style="background: #000d37;">
                                        <th style="border: 1px solid white;background: white; border-right: 1px solid #001143;"></th>
                                        <th>TOTAL DE OBRAS</th>
                                        <th>RESIDENCIAL</th>
                                        <th>COMERCIAL</th>
                                        <th>INDUSTRIAL</th>
                                    </tr>
                                </thead>

                                <tbody class="text-center" style="border: 1px solid #000d37;">
                                    <tr>
                                        <td class="no-border" style="border-bottom:1px solid #fff; border-right: 1px solid #001143;"></td>
                                        <td>{{ $worksInBrazil }}</td>
                                        <td>{{ $residentialWorks }}</td>
                                        <td>{{ $businessWorks }}</td>
                                        <td>{{ $industrialWorks }}</td>
                                    </tr>
                                </tbody>

                                <thead>
                                    <tr class="text-white text-end" style="background: #f64004;border: 1px solid #000d37;">
                                        <th class="no-border" style="border-right: 1px solid #000d37;background: white;"></th>
                                        <th>Total</th>
                                        <th>Residencial</th>
                                        <th>Comercial</th>
                                        <th>Industrial</th>
                                    </tr>
                                </thead>

                                <tbody class="text-end" style="border: 1px solid #000d37;">
                                    <tr>
                                        <td style="background: #f64004;color:white;">Sudeste</td>
                                        <td>{{ $southeastWorksCount }}</td>
                                        <td>{{ $southeastIndustrialWorks }}</td>
                                        <td>{{ $southeastComercialWorks }}</td>
                                        <td>{{ $southeastResidentialWorks }}</td>
                                    </tr>
                                    <tr>
                                        <td style="background: #f64004;color:white;">Sul</td>
                                        <td>{{ $southWorksCount }}</td>
                                        <td>{{ $southIndustrialWorks }}</td>
                                        <td>{{ $southComercialWorks }}</td>
                                        <td>{{ $southResidentialWorks }}</td>
                                    </tr>
                                    <tr>
                                        <td style="background: #f64004;color:white;">Norte</td>
                                        <td>{{ $northWorksCount }}</td>
                                        <td>{{ $northIndustrialWorks }}</td>
                                        <td>{{ $northComercialWorks }}</td>
                                        <td>{{ $northResidentialWorks }}</td>
                                    </tr>
                                    <tr>
                                        <td style="background: #f64004;color:white;">Nordeste</td>
                                        <td>{{ $northeastWorksCount }}</td>
                                        <td>{{ $northeastIndustrialWorks }}</td>
                                        <td>{{ $northeastComercialWorks }}</td>
                                        <td>{{ $northeastResidentialWorks }}</td>
                                    </tr>
                                    <tr>
                                        <td style="background: #f64004;color:white;">Centro-Oeste</td>
                                        <td>{{ $midwestWorksCount }}</td>
                                        <td>{{ $midwestIndustrialWorks }}</td>
                                        <td>{{ $midwestComercialWorks }}</td>
                                        <td>{{ $midwestResidentialWorks }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>

            </div>

        </div>

@endsection
