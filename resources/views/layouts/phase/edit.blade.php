@extends('layouts.app_customer')

@section('content')

    <div class="bg-light p-5 rounded">
        <h1>EDIÇÃO DE FASE</h1>

        <form action="{{ route('phase.update', $phase->id) }}" method="POST" role="form">
            @csrf
            @method('post')
            <input type="hidden" name="phase_id" value="{{ $phase->id }}">

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
