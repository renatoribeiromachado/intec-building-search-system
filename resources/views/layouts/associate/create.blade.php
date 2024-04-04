@extends('layouts.app_customer_create')

@section('content')
    <div class="container pb-4 mb-5 bg-light border">
        <div class="row mt-4 pb-4">
            <div class="col-md-12">
                <h4><i class="fa fa-check"></i> CADASTRO DE ASSOCIADO</h4>
            </div>
        </div>

        {{-- @include('layouts.alerts.all-errors') --}}
        @include('layouts.alerts.success')

        <form action="{{ route('associate.store') }}" method="post" role="form">
            @csrf
            @method('post')

            @include('layouts.forms.add_edit_associate')

            <div class="row mt-4">
                <div class="col-md-12">
                    <button
                        type="submit"
                        class="btn btn-primary"
                        >
                        Salvar e add Contatos / Pedido / Assinatura / Dados de acesso
                    </button>
                </div>
            </div>
        </form>
    </div>
@endsection
