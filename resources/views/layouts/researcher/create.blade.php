@extends('layouts.app_customer_create')

@section('content')

    <div class="container bg-light p-5 rounded">
        <h1>CADASTRO DE PESQUISADOR</h1>

        <form action="{{ route('researcher.store') }}" method="POST" role="form">
            @csrf
            @method('post')

            @include('layouts.forms.add_edit_researcher')

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
