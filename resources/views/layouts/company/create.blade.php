@extends('layouts.app_customer_create')

@section('content')
    <div class="container bg-light p-5 rounded">
        <h3>CADASTRO DE EMPRESA</h3>

        <form action="{{ route('company.store') }}" method="POST" role="form" class="needs-validation">
            @csrf
            @method('post')

            @include('layouts.forms.add_edit_company')

            <div class="form-row my-3">
                <div class="form-group">
                    <button
                        type="submit"
                        class="btn btn-primary"
                        >
                        Salvar
                    </button>
                </div>
            </div>
        </form>
    </div>
@endsection
