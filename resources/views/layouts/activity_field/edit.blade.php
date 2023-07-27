@extends('layouts.app_customer')

@section('content')

    <div class="bg-light p-5 rounded">
        <h1>EDIÇÃO DE ATIVIDADE DE EMPRESA</h1>

        <form action="{{ route('activity_field.update', $activityField->id) }}" method="POST" role="form">
            @csrf
            @method('put')

            @include('layouts.forms.add_edit_activity_field')

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
