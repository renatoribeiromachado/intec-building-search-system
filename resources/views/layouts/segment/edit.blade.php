@extends('layouts.app_customer_create')

@section('content')

    <div class="container bg-light p-5 rounded">
        <h1>EDIÇÃO DE SEGMENTO</h1>

        <form action="{{ route('segment.update', $segment->id) }}" method="POST" role="form">
            @csrf
            @method('put')

            @include('layouts.forms.add_edit_segment')

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
