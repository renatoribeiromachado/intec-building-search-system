@extends('layouts.app_customer')

@section('content')
<div class="container pb-4 bg-light border">

    <div class="row mt-4">
        <div class="col-lg-12">
            <h4 class="text-center">
                <i class="fa fa-check"></i>
                <strong>CADASTRO DE ASSOCIADOS</strong> -
                <code>Filtro</code>
            </h4>
        </div>
    </div>

    <form action="{{ route('associate.index') }}" method="get" class="search mb-4">
        @csrf

        <div class="row mt-2">
            <div class="col-md-2">
                <x-intec-input
                    label-input-id="search_cnpj"
                    label-text="Codigo"
                    input-type="text"
                    input-name="search_id"
                    class-one=""
                    input-value="{{ request()->search_id }}"
                    :input-readonly="false"
                    placeholder="Digite o Codigo..."
                />
            </div>

            <div class="col-md-2">
                <x-intec-input
                    label-input-id="search_cnpj"
                    label-text="CNPJ"
                    input-type="text"
                    input-name="search_cnpj"
                    class-one=""
                    input-value="{{ request()->search_cnpj }}"
                    :input-readonly="false"
                    placeholder="Digite o CNPJ..."
                />
            </div>

            <div class="col-md-4">
                <x-intec-input
                    label-input-id="search_company_name"
                    label-text="Razão Social"
                    input-type="text"
                    input-name="search_company_name"
                    class-one=""
                    input-value="{{ request()->search_company_name }}"
                    :input-readonly="false"
                    placeholder="Digite a Razão Social..."
                />
            </div>

            <div class="col-md-4">
                <x-intec-input
                    label-input-id="search_trading_name"
                    label-text="Nome Fantasia"
                    input-type="text"
                    input-name="search_trading_name"
                    class-one=""
                    input-value="{{ request()->search_trading_name }}"
                    :input-readonly="false"
                    placeholder="Digite a Fantasia..."
                />
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-md-12">
                <a
                    href="{{ route('associate.create') }}"
                    class="btn btn-primary"
                    title="Cadastrar Novo Cliente (Associado)"
                    >
                    <i class="fa fa-ok"></i>
                    Cadastrar Novo
                </a>

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
                    <i class="fa fa-ok"></i>
                    Limpar
                </a>
            </div>
        </div>
    </form>

    @include('layouts.alerts.all-errors')

    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">CNPJ</th>
                <th scope="col">Razão Social</th>
                <th scope="col">Nome Fantasia</th>
                <th scope="col">Atividade</th>
                <th scope="col">Cidade</th>
                <th scope="col">Ações</th>
            </tr>
        </thead>
        <tbody>
            @forelse($associates as $associate)
                <tr>
                    <th scope="row">{{ $associate->id }}</th>
                    <td>{{ $associate->company->cnpj }}</td>
                    <td>{{ $associate->company->company_name }}</td>
                    <td>{{ $associate->company->trading_name }}</td>
                    <td>{{ optional($associate->company->activityField)->description }}</td>
                    <td>{{ $associate->company->city }}</td>
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

    @if ($associates)
        <div>
            {{ $associates->appends(request()->input())->links('vendor.pagination.bootstrap-4') }}
        </div>
    @endif
@endsection

