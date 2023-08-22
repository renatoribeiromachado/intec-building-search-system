@extends('layouts.app_customer')

@section('content')

<style>
    /*CSS para impressão*/
    @media print {
        .print{
            display: block !important;
        }
        .no-print{
            display: none;
        }
    }
    body {
        /* margin:0; */
        /* padding:0; */
        line-height: 1.4em;
        padding-bottom: 70px;
    }
    @page {
        margin: 0.5cm;
    }

    table{
        border: none !important;
    }
    p{
        /* font-size: 10px; */
    }
    tr{
        background: white !important;
        border: none !important;
    }
    th{
        /* font-size: 10px; */
        border: none !important;
    }
    td{
        /* font-size: 10px; */
        border: none !important;
        padding: 0 !important;
    }
    /* input[type=checkbox] {
        -moz-appearance:none !important;
        -webkit-appearance:none !important;
        -o-appearance:none !important;
        outline: none !important;
        content: none !important;
    }
    input[type=checkbox]:before {
        font-family: "FontAwesome" !important;
        content: "\f00c" !important;
        font-size: 10px !important;
        color: transparent !important;
        background: #fef2e0 !important;
        display: block !important;
        width: 12px !important;
        height: 12px !important;
        border: 1px solid black !important;
        margin-right: 1px !important;
    }

    input[type=checkbox]:checked:before {
        color: black !important;
    } */

    .alinhadoDireita {
        text-align:right;
    }

    .margin{
        margin-top:-20px;
    }

    .pg{
        page-break-after: always;
    }
</style>

<div class="container pt-3">
    
    @forelse ($companies as $company)
        <div class="row mt-2">
            <div class="col-md-12">
                <img
                    src="{{ asset('images/relatorio-empresas.png') }}"
                    class="img-fluid"
                    alt="Descrição da Imagem"
                    >
                <p class="pt-1">
                    Última Atualização:
                    <strong>{{ optional($company->last_review)->format('d/m/Y') }}</strong> -
                    Revisão: <strong>{{ $company->revision }}</strong> -
                    Emitido em:
                    <strong>
                        {{ now()->setTimezone(
                        config('timezones.brazil'))->format('d/m/Y') }}
                    </strong>
                </p>
            </div>
        </div>
    
        <div class="row mt-2 mb-3">
            <div class="col-md-12">
                <p class="text-success"><b>DADOS DA EMPRESA {{ $loop->iteration }}:</b></p>
                <table class="table table-condensed mt-2">
                    <tr>
                        <td style="width:78% !important;">
                            <strong>Razão Social:</strong>  {{ $company->company_name }}<br>
                            <strong>Fantasia:</strong>  {{ $company->trading_name }}<br>

                            <strong>Endereço:</strong> {{ $company->address }}, {{ $company->number }}<br>

                            <strong>Cidade:</strong> {{ $company->city }}<br>

                            <strong>CEP:</strong> {{ $company->zip_code }}<br>

                            <strong>Segmento:</strong> {{ optional($company->activityField)->description }}<br>

                            <strong>E-mail:</strong> {{ $company->primary_email }} <br>
                        </td>
                        <td>
                            <strong>Bairro</strong>: {{ $company->district }}<br>

                            <strong>Estado:</strong> {{ $company->state }}<br>

                            <strong>CNPJ:</strong> {{ $company->cnpj }}<br>

                            <strong>Site:</strong> {{ $company->home_page }}<br>

                            <strong>E-mail Secundário:</strong> {{ $company->secondary_email }}<br>
                        </td>
                    </tr>

                    <tr>
                        <td colspan="2">
                            <strong>Observações:</strong> {{ $company->notes }}
                        </td>
                    </tr>

                    @foreach($company->contacts as $contact)
                        <tr>
                            <td class="pt-2">
                                <strong>Contato:</strong> ({{ $contact->name }})<br>
                                <strong>Telefone 1:</strong> ({{ $contact->ddd }}) {{ $contact->main_phone }}<br>
                                <strong>Telefone 2:</strong> ({{ $contact->ddd_two }}) {{ $contact->phone_two }}<br>
                            </td>
                            <td class="pb-2">
                                <strong>Telefone 3:</strong> ({{ $contact->ddd_three }}) {{ $contact->phone_three }}<br>
                                <strong>Telefone 4:</strong> ({{ $contact->ddd_four }}) {{ $contact->phone_four }}<br>
                                <strong>E-mail:</strong> <a href="mailto:{{ $contact->email }}">{{ $contact->email }}</a><br>
                            </td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
        @empty
        <div class="row mt-2 mb-3">
            <div class="col-md-12">
                <p class="text-center">
                    Nenhuma empresa encontrada com base nos critérios selecionados.
                </p>
            </div>
        </div>
        
    @endforelse
</div>
@endsection