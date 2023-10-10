@extends('layouts.app_customer')

@section('content')
<div class="container">

    <div class="bg-light p-5 rounded">
        <h3>FILTRO DE ASSOCIADOS</h3>
        
        <div class="mt-4 p-5 text-black rounded" style="background: #e0e0e0;">
            <form action="{{ route('associate.index') }}" method="get" class="search mb-4">
                @csrf

                <div class="row mt-2">
                    <div class="col-md-2">
                        <x-intec-input
                            label-input-id="search_old_code"
                            label-text="Cód"
                            input-type="text"
                            input-name="search_old_code"
                            class-one=""
                            label-class=""
                            input-value="{{ request()->search_old_code }}"
                            :input-readonly="false"
                            placeholder="Digite o Código..."
                        />
                    </div>
                    
                    <div class="col-md-2">
                        <x-intec-input
                            label-input-id="search_order"
                            label-text="Nº Pedido"
                            input-type="text"
                            input-name="search_order"
                            class-one=""
                            label-class=""
                            input-value="{{ request()->search_order }}"
                            :input-readonly="false"
                            placeholder="Digite o Pedido..."
                        />
                    </div>

                    <div class="col-md-3">
                        <x-intec-input
                            label-input-id="search_cnpj"
                            label-text="CNPJ"
                            input-type="text"
                            input-name="search_cnpj"
                            class-one="cnpj"
                            label-class=""
                            input-value="{{ request()->search_cnpj }}"
                            :input-readonly="false"
                            placeholder="Digite o CNPJ..."
                        />
                    </div>
                </div>
                    
                <div class="row mt-3">

                    <div class="col-md-6">
                        <x-intec-input
                            label-input-id="search_company_name"
                            label-text="Razão Social"
                            input-type="text"
                            input-name="search_company_name"
                            class-one=""
                            label-class=""
                            input-value="{{ request()->search_company_name }}"
                            :input-readonly="false"
                            placeholder="Digite a Razão Social..."
                        />
                    </div>

                    <div class="col-md-6">
                        <x-intec-input
                            label-input-id="search_trading_name"
                            label-text="Nome Fantasia"
                            input-type="text"
                            input-name="search_trading_name"
                            class-one=""
                            label-class=""
                            input-value="{{ request()->search_trading_name }}"
                            :input-readonly="false"
                            placeholder="Digite a Fantasia..."
                        />
                    </div>
                </div>

                <div class="row mt-4">
                    <div class="col-md-12">
                        <button
                            type="submit"
                            class="btn btn-success submit"
                            title="Pesquisar"
                            >
                            <i class="fa fa-search"></i>
                            Pesquisar
                        </button>

                        <a
                            href="{{ route('associate.index') }}"
                            class="btn btn-warning"
                            title="Voltar para o início da pesquisa"
                            >
                            <i class="fa fa-eraser"></i>
                        </a>
                    </div>
                </div>
            </form> 
        </div>
        
        <div class="row mt-3 mb-2">
            <div class="col">
                @can('ver-excel-associados')
                    <a
                        href="{{ route('associate.export') }}"
                        class="btn btn-success float-start"
                        title="Exportar Excel (Associado)"
                        >
                        <i class="fa fa-ok"></i>
                        Exportar Excel
                    </a>
                @endcan
                
                <a
                    href="{{ route('associate.create') }}"
                    class="btn btn-primary float-end"
                    title="Cadastrar Novo Cliente (Associado)"
                    >
                    <i class="fa fa-ok"></i>
                    Cadastrar Novo
                </a>
            </div>
        </div>
        
        @include('layouts.alerts.all-errors')

        <div class="table-responsive mt-4">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Cód</th>
                        <th scope="col">CNPJ</th>
                        <th scope="col">Razão Social</th>
                        <th scope="col">Nome Fantasia</th>
                        <th scope="col">Status</th>
                        <th scope="col">Pedido</th>
                        <th scope="col">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($associates as $associate)
                        <tr>
                            <th scope="row">{{ $associate->old_code }}</th>
                            <td>{{ $associate->company->cnpj }}</td>
                            <td>{{ $associate->company->company_name }}</td>
                            <td>{{ $associate->company->trading_name }}</td>
                            {{--<td>{{ optional($associate->company->activityField)->description }}</td>--}}
                            @if($associate->company->is_active != 1 )
                                <td class='text-danger'><strong>Inativo</strong></td>
                                @else
                                <td class='text-success'><strong>Ativo</strong></td>
                            @endif

                            <!--Numero do pedido, mostrar sempre o ultimo-->
                            @php
                                $lastOrderId = $associate->company->orders->isNotEmpty() ? $associate->company->orders->last()->old_code : null;
                                $lastOrderIdDisplayed = false;
                            @endphp

                            @foreach ($associate->company->orders as $order)
                                @if ($lastOrderId !== null && !$lastOrderIdDisplayed)
                                <td><span class="badge bg-secondary">{{ $lastOrderId }}</span></td>
                                    @php
                                        $lastOrderIdDisplayed = true; 
                                    @endphp
                                @endif
                            @endforeach

                            <td style="width: 15%;">
                                <a
                                    href="{{ route('associate.edit', $associate->id) }}"
                                    class="btn btn-sm btn-outline-success me-1 mb-2"
                                    >
                                    Ver
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center py-5">
                                Nenhum associado encontrado.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if ($associates)
            <div>
                {{ $associates->appends(request()->input())->links('vendor.pagination.bootstrap-4') }}
            </div>
        @endif

    </div>
</div>
@endsection

