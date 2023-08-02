@extends('layouts.app_customer')

@section('content')

<div class="container pb-4 bg-light border">
        <div class="row mt-3">
            <h4 class="text-center" style="color:#ff3b00">Bem vindo a Intec - Informações Técnicas da Construção</h4>
            <p class="text-center">A empresa pioneira no ramo de informações online de obras do Brasil</p>
        </div>

        <div class="row mt-3">
            <div class="col-md-4">
                <ul class="list-group">
                    <li class="list-group-item bg-danger text-white"><i class="fa fa-check"></i> Resultado mensal</li>
                    <li class="list-group-item text-center"><strong>OBRAS NOVAS E ATUALIZADAS</strong></li>
                    <li class="list-group-item text-warning text-center"><strong>EM JULHO 2023</strong></li>
                    <li class="list-group-item text-center">19.344 <strong>obras em todo Brasil</strong></li>
                    <li class="list-group-item text-center">Residencial: 10.220</li>
                    <li class="list-group-item text-center">Comercial: 7.450</li>
                    <li class="list-group-item text-center">Industrial: 1.664</li>
                </ul>
            </div>

            <div class="col-md-4">
                <ul class="list-group">
                    <li class="list-group-item bg-primary text-white"><i class="fa fa-check"></i> Saiba mais</li>
                    <li class="list-group-item text-center">Quem somos nós?</li>
                    <li class="list-group-item">Empresa de inteligência comercial especialidada em criação de leads no mercado nacional da construção civil.</li>
                    <li class="list-group-item">Prospecção</li>
                    <li class="list-group-item">Contato de Construtoras</li>
                    <li class="list-group-item">Análise de Mercado</li>
                </ul>
            </div>

            <div class="col-md-4">
                <ul class="list-group">
                    <li class="list-group-item bg-warning text-white">
                        <i class="fa fa-check"></i> Analise trimestral
                    </li>
                    <li class="list-group-item text-center">
                        Relatório trimestral de obras <br>
                        <img
                            src="{{ asset('images/dashboard-trimestral.png') }}"
                            alt="Imagem Relatório Trimestral"
                            class="img-fluid"
                            >
                    </li>

                </ul>
            </div>

        </div>
        
        <div class="row mt-3">
            <p><i class="fa fa-check"></i> <strong>Estatística de obra(s) cadastrada(s) até o momento</strong></p>
        </div>

        <div class="container mt-1 border shadow">
            <div class="row">


                <div class="col-md-4 pt-4">
                    <p><strong>Segmentos</strong></p>
                    <hr>
                    <table class="table table-condensed">
                        <tr>
                            <th style="background: #acc4d0;color:black">Industrial</th>
                            <td class="text-end" style="background: #acc4d0;color:black"><span class="badge bg-secondary">1591</span></td>
                        </tr>
                        <tr>
                            <th style="background: #b5b253;color:black">Comercial</th>
                            <td class="text-end" style="background: #b5b253;color:black"><span class="badge bg-secondary">3495</span></td>
                        </tr>
                        <tr>
                            <th style="background: #ccb364;color:black">Residencial</th>
                            <td class="text-end" style="background: #ccb364;color:black"><span class="badge bg-secondary">5847</span></td>
                        </tr>
                    </table>
                </div>

                <div class="col-md-8 pt-4">
                    <p><strong>Regiões e Segmentos</strong></p>
                    <hr>
                    <table class="table table-condensed">
                        <tr>
                            <th style="background: #235877;color:white">Região</th>
                            <th style="background: #235877;color:white">Total</th>
                            <th style="background: #acc4d0;color:black">Industrial</th>
                            <th style="background: #b5b253;color:black">Comercial</th>
                            <th style="background: #ccb364;color:black">Residencial</th>
                        </tr>
                        <tr>
                            <td style="background: #235877;color:white">Norte</td>
                            <td style="background: #235877;color:white"><span class="badge bg-secondary">750</span></td>
                            <td style="background: #acc4d0;color:black">250</td>
                            <td style="background: #b5b253;color:black">120</td>
                            <td style="background: #ccb364;color:black">380</td>
                        </tr>
                        <tr>
                            <td style="background: #235877;color:white">Nordeste</td>
                            <td style="background: #235877;color:white"><span class="badge bg-secondary">452</span></td>
                            <td style="background: #acc4d0;color:black">140</td>
                            <td style="background: #b5b253;color:black">125</td>
                            <td style="background: #ccb364;color:black">300</td>
                        </tr>
                        <tr>
                            <td style="background: #235877;color:white">Sul</td>
                            <td style="background: #235877;color:white"><span class="badge bg-secondary">7.200</span></td>
                            <td style="background: #acc4d0;color:black">2.500</td>
                            <td style="background: #b5b253;color:black">1.950</td>
                            <td style="background: #ccb364;color:black">3.730</td>
                        </tr>
                        <tr>
                            <td style="background: #235877;color:white">Sudeste</td>
                            <td style="background: #235877;color:white"><span class="badge bg-secondary">10.040</span></td>
                            <td style="background: #acc4d0;color:black">5.850</td>
                            <td style="background: #b5b253;color:black">3.245</td>
                            <td style="background: #ccb364;color:black">945</td>
                        </tr>
                        <tr>
                            <td style="background: #235877;color:white">Centro-Oeste</td>
                            <td style="background: #235877;color:white"><span class="badge bg-secondary">542</span></td>
                            <td style="background: #acc4d0;color:black">152</td>
                            <td style="background: #b5b253;color:black">115</td>
                            <td style="background: #ccb364;color:black">275</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection


{{-- <x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    You're logged in!
                </div>
            </div>
        </div>
    </div>
</x-app-layout> --}}
