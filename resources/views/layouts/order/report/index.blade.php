@extends('layouts.app_order_report')

@section('content')
    <div class="container">
        <div class="row mt-4">
            <table class="table table-bordered remove-margin-bottom">
                <tr>
                    <th class="text-center">
                        INSTRUMENTO DE CONTRATO DE SERVIÇOS AO BANCO DE DADOS INTEC
                    </th>
                </tr>
                <tr>
                    <th class="text-center">
                        <img
                            src="{{ asset('images/intec_default_mini.png') }}"
                            alt="Imagem da Obra"
                            width="280"
                            class="img-fluid"
                        >
                    </th>
                </tr>
                <tr>
                    <td class="text-center">
                        <strong>Informações Técnicas da Construção EIRELI CNPJ:</strong>
                        {{ $order->company->associate->linked_company }}
                    </td>
                </tr>
                <tr>
                    <th class="text-center">
                        PEDIDO DE FORNECIMENTO DE INFORMAÇÕES / DADOS CADASTRAIS
                    </th>
                </tr>
            </table>

            <table class="table table-bordered remove-margin-bottom">
                <tr>
                    <td>
                        <strong>Razão Social:</strong>
                        {{ $order->company->company_name }}
                    </td>
                    <td>
                        <strong>Fantasia:</strong>
                        {{ $order->company->trading_name }}
                    </td>
                    <td>
                        <strong>Codigo:</strong>
                        {{ fillLeftWithZeros($order->company->associate->id) }}
                        /
                        <strong>Pedido:</strong>
                        {{ fillLeftWithZeros($order->id) }}
                    </td>
                </tr>
            </table>

            <table class="table table-bordered remove-margin-bottom">
                <tr>
                    <td>
                        <strong>CNPJ/CPF:</strong>
                        {{ $order->company->cnpj }}
                    </td>
                    <td>
                        <strong>IE:</strong>
                        {{ $order->company->state_registration }}
                    </td>
                    <td>
                        <strong>Ramo:</strong>
                        {{ $order->company->associate->business_branch }}
                    </td>
                    <td>
                        <strong>Atividade:</strong>
                        {{ $order->company->activityField->description }}
                    </td>
                </tr>
            </table>

            <table class="table table-bordered remove-margin-bottom">
                <tr>
                    <td>
                        <strong>Aniversário da empresa:</strong>
                        {{ $order->company->associate->company_date_birth }}
                    </td>
                    <td>
                        <strong>Site:</strong>
                        {{ $order->company->home_page }}
                    </td>
                    <td>
                        <strong>Emissão:</strong>
                        {{ $order->company->associate->contract_due_date_start->format('d/m/Y') }}
                    </td>
                    <td>
                        <strong>Vendedor(a):</strong>
                        {{ $order->company->associate->salesperson->name }}
                    </td>
                </tr>
            </table>

            <table class="table table-bordered remove-margin-bottom">
                <tr>
                    <td>
                        <strong>Endereço:</strong>
                        {{ $order->company->address }}
                    </td>
                    <td>
                        <strong>Bairro:</strong>
                        {{ $order->company->district }}
                    </td>
                    <td>
                        <strong>Cidade:</strong>
                        {{ $order->company->city }}
                    </td>
                    <td>
                        <strong>UF:</strong>
                        {{ $order->company->state }}
                    </td>
                    <td>
                        <strong>CEP:</strong>
                        {{ $order->company->zip_code }}
                    </td>
                </tr>

                @foreach($contacts as $contact)
                    <tr>
                        <td>
                            <strong>Contato:</strong>
                            {{ $contact->name }}
                        </td>
                        <td>
                            <strong>Telefone:</strong>
                            {{ $contact->ddd }} - {{ $contact->main_phone }}
                        </td>
                        <td colspan="2">
                            <strong>Celular:</strong>
                            {{ $contact->ddd_two }} - {{ $contact->phone_two }}
                        </td>
                        <td colspan="2">
                            <strong>E-mail principal:</strong>
                            {{ $contact->email }}
                        </td>
                    </tr>
                @endforeach
            </table>

            <table class="table table-bordered remove-margin-bottom">
                <tr>
                    <th class="text-center">
                        Informações de Obras:
                        {{ $order->work_notes }}
                    </th>
                </tr>
            </table>

            <table class="table table-bordered remove-margin-bottom">
                <tr>
                    <td>
                        <strong>Posição:</strong>
                        {{ $order->situation }}<br>
                        <strong>Plano:</strong>
                        {{ $order->plan->description }}<br>
                        <strong>Início:</strong>
                        {{ $order->start_at->format('d/m/Y') }}<br>
                        <strong>Término:</strong>
                        {{ $order->ends_at->format('d/m/Y') }}
                    </td>
                    <td>
                        <strong>Valor Original:</strong><br>
                        R$ {{ convertDecimalToBRL($order->original_price) }}<br>
                        <strong>Total de Desconto Aplicado:</strong><br>
                        R$ {{ convertDecimalToBRL($order->discount) }}
                    </td>
                    <td>
                        <strong>Valor Concedido:</strong><br>
                        R$ {{ convertDecimalToBRL($order->final_price) }}<br>
                        <strong>1º Vencto:</strong><br>
                        {{ $order->first_due_date->format('d/m/Y') }}
                    </td>
                    <td>
                        <strong>Condição Facilitada De Pagamento:</strong><br>
                        {{ $order->easy_payment_condition }}
                    </td>
                </tr>
            </table>

            <table class="table table-bordered remove-margin-bottom">
                <tr>
                    <th class="text-center">RESUMO DO PEDIDO / OBSERVAÇÕES</th>
                </tr>
                <tr>
                    <td>
                        {!! nl2br($order->notes) !!}
                    </td>
                </tr>
            </table>

            <table class="table table-bordered remove-margin-bottom">
                <tr>
                    <th>Nome</th>
                    <th>Cargo</th>
                    <th>Telefone/Celular</th>
                    <th>E-Mail</th>
                </tr>

                @foreach($associateUsers as $associateUser)
                    <tr>
                        <td>
                            {{ $associateUser->name }}
                        </td>
                        <td>
                            {{ optional($associateUser->position)->description }}
                        </td>
                        <td>
                            @if ($associateUser->ddd && $associateUser->main_phone)
                            ({{ $associateUser->ddd }}) {{ $associateUser->main_phone }} /
                            @endif
                            @if ($associateUser->ddd_two && $associateUser->phone_two)
                            ({{ $associateUser->ddd_two }}) {{ $associateUser->phone_two }}
                            @endif
                        </td>
                        <td>
                            {{ $associateUser->user->email }}
                        </td>
                    </tr>
                @endforeach
            </table>

            <table class="table table-bordered remove-margin-bottom">
                <tr>
                    <th class="text-center">PRODUTOS E SERVIÇOS</th>
                </tr>
                <tr>
                    <td class="text-center">
                        {{ $order->company->associate->products_and_services }}
                    </td>
                </tr>
            </table>
        </div>
    </div>
@endsection
