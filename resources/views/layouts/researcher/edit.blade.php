@extends('layouts.app_customer')

@section('content')

    <div class="bg-light p-5 rounded">
        <h1>EDIÇÃO DE PESQUISADOR</h1>

        <form action="{{ route('researcher.update', $researcher->id) }}" method="POST" role="form">
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
