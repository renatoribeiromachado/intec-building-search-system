@extends('layouts.app_customer_create')

@section('content')

    <div class="container bg-light p-5 rounded">
        <h3>EDIÇÃO DE DADOS DE ACESSO</h3>

        <form
            action="{{ route('associate.user.update', [$company->id, $contact->id]) }}"
            method="POST"
            role="form"
            autocomplete="off"
            >
            @csrf
            @method('put')

            @include('layouts.associate.modals.add_edit_associate_user')

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
