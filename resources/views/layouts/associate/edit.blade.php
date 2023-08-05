@extends('layouts.app_customer')

@section('content')
    <div class="container pb-4 bg-light border">
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
                    <button
                        type="submit"
                        class="btn btn-outline-success me-1 text-dark"
                        >
                        Atualizar alteração de cadastro
                    </button>
                </div>
            </div>
        </form>
    </div>
@endsection