@extends('layouts.app_customer')

@section('content')

    <div class="bg-light p-5 rounded">
        <h1>CADASTRO DE FASE</h1>

        <form action="{{ route('phase.store') }}" method="POST" role="form">
            @csrf
            @method('post')

            @include('layouts.forms.add_edit_phase')

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
