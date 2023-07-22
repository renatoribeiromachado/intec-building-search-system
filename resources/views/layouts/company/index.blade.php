@extends('layouts.app_customer')

@section('content')

<div class="bg-light p-5 rounded">
    <h1>LISTA DE EMPRESAS</h1>

    <div class="">
        <a class="btn btn-primary float-end"
            href="{{ route('company.create') }}"
            >
            Novo Cadastro
        </a>
    </div>

    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Razão Social</th>
                <th scope="col">Nome Fantasia</th>
                <th scope="col">CNPJ</th>
                <th scope="col">Cidade</th>
                <th scope="col">Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach($companies as $company)
                <tr>
                    <th scope="row">{{ $company->id }}</th>
                    <td>{{ $company->company_name }}</td>
                    <td>{{ $company->trading_name }}</td>
                    <td>{{ $company->cnpj }}</td>
                    <td>{{ $company->city }}</td>
                    <td>
                        <a href="{{ route('company.edit', $company->id) }}">
                            Editar
                        </a>
                    </td>
                </tr>
            @endforeach
          {{-- <tr>
            <th scope="row">2</th>
            <td>Jacob</td>
            <td>Thornton</td>
            <td>@fat</td>
          </tr> --}}
          {{-- <tr>
            <th scope="row">3</th>
            <td colspan="2">Larry the Bird</td>
            <td>@twitter</td>
          </tr> --}}
        </tbody>
    </table>
</div>

@push('scripts')

    {{-- <script src="{{ asset('vendor/jquery-mask-plugin/dist/jquery.mask.min.js') }}"></script> --}}
    <script>
    $(document).ready(function () {
        // jquery mask
        $('.cep').mask('00000-000');
        $('.cnpj').mask('00.000.000/0000-00', {reverse: false});

        var SPMaskBehavior = function (val) {
        return val.replace(/\D/g, '').length === 11 ? '(00) 00000-0000' : '(00) 0000-00009';
        },
        spOptions = {
        onKeyPress: function(val, e, field, options) {
            field.mask(SPMaskBehavior.apply({}, arguments), options);
            }
        };
    
        $('.phone').mask(SPMaskBehavior, spOptions);
        // end jquery mask
    });
    </script>

@endpush

@endsection
