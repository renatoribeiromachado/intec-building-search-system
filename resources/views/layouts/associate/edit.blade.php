@extends('layouts.app_customer')

@section('content')
    <div class="container pb-4 mb-5 bg-light border">
        <div class="row mt-4">
            <div class="col-md-12">
                <h4><i class="fa fa-check"></i> Adicionar contatos / Pedido / Assinatura / Acesso</h4>
            </div>
        </div>

        @include('layouts.alerts.all-errors')
        @include('layouts.alerts.success')

        <form action="{{ route('associate.update', $associate->id) }}" method="post" role="form">
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
                        type="submit"
                        class="btn btn-outline-success me-1 text-dark"
                        >
                        Atualizar alteração de cadastro
                    </button>
                </div>
            </div>
        </form>

        {{-- @if ($company->order->exists())
            <x-intec-modal
                id="editOrder"
                aria-labelledby="editOrderLabel"
                route="{{ route('associate.contact.update', optional($company->order)->id) }}"
                title="Adicionar Contato"
                collection="{{ $contact }}"
                submit-button-class="btn btn-primary"
                submit-button-text="Salvar"
                size="modal-xl"
                http-method="post"
                >
                <div class="container-fluid">
                    <div class="container">
                        @include('layouts.associate.modals.add_edit_associate_contact')
                        @include('layouts.forms.add_edit_order')
                    </div>
                </div>
            </x-intec-modal>
        @endif --}}

        @include('layouts.associate.contact.table_index')

        @include('layouts.associate.order.table_index')

    </div>
@endsection
