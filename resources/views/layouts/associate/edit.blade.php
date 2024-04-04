@extends('layouts.app_customer_create')

@section('content')
    <div class="container pb-4 mb-5 bg-light border">
        <div class="row mt-4 pb-4">
            <div class="col-md-12">
                <h4><i class="fa fa-check"></i> Adicionar contatos / Pedido / Assinatura / Acesso</h4>
            </div>
        </div>

        @include('layouts.alerts.all-errors')
        @include('layouts.alerts.success')

        <form
            action="{{ route('associate.update', $associate->id) }}"
            method="post"
            role="form"
            autocomplete="off"
            >
            @csrf
            @method('put')

            @include('layouts.forms.add_edit_associate')

            <div class="row mt-4">
                <div class="col-md-12">
                    <a
                        href="{{ route('associate.order.create', $company->id) }}"
                        class="btn btn-outline-info me-1 text-dark"
                        >
                        Gerar pedido
                    </a>

                    <button
                        type="button"
                        class="btn btn-outline-success me-1"
                        data-bs-toggle="modal"
                        data-bs-target="#addContact"
                        >
                        Add contatos
                    </button>

                    <button
                        type="button"
                        class="btn btn-outline-primary me-1"
                        data-bs-toggle="modal"
                        data-bs-target="#addSignature"
                        >
                        Dados da assinatura
                    </button>

                    {{-- <button
                        type="button"
                        class="btn btn-outline-secondary me-1"
                        data-bs-toggle="modal"
                        data-bs-target="#addAccess"
                        >
                        Dados de acesso
                    </button> --}}

                    <a
                        href="{{ route('associate.user.create', $company->id) }}"
                        class="btn btn-outline-secondary me-1"
                        >
                        Dados de acesso
                    </a>

                    <button
                        type="submit"
                        class="btn btn-outline-success me-1 text-dark"
                        >
                        Atualizar alteração de cadastro
                    </button>
                </div>
            </div>
        </form>

        @include('layouts.associate.contact.table_index')

        @include('layouts.associate.user.table_index')

        @include('layouts.associate.order.table_index')

    </div>
@endsection
