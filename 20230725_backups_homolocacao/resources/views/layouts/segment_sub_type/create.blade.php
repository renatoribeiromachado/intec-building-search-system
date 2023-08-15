@extends('layouts.app_customer')

@section('content')

    <div class="bg-light p-5 rounded">
        <h1>CADASTRO DE SUBTIPO DE SEGMENTO DE ATUAÇÃO</h1>

        <form action="{{ route('segment_sub_type.store') }}" method="POST" role="form">
            @csrf
            @method('post')

            @include('layouts.forms.add_edit_segment_sub_type')

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
