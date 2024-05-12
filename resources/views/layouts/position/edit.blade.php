@extends('layouts.app_customer_create')

@section('content')

    <div class="container bg-light p-5 rounded">
        <h1>EDIÇÃO DE CARGO</h1>

        <form action="{{ route('position.update', $position->id) }}" method="POST" role="form">
            @csrf
            @method('post')

            @include('layouts.forms.add_edit_position')

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
