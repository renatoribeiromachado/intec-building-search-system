@extends('layouts.app_customer')

@section('content')
    <div class="container pb-4 bg-light border">
        <div class="row mt-4">
            <div class="col-md-12">
                <h4><i class="fa fa-check"></i> GERAR PEDIDO</h4>
            </div>
        </div>

        @include('layouts.alerts.all-errors')
        @include('layouts.alerts.success')

        <form action="{{ route('associate.order.store', $company->id) }}" method="post" role="form">
            @csrf
            @method('post')

            @include('layouts.forms.add_edit_order')

            <div class="row mt-4">
                <div class="col-md-12">
                    <button
                        type="submit"
                        class="btn btn-success"
                        >
                        Gerar Pedido
                    </button>
                </div>
            </div>
        </form>
    </div>
@endsection