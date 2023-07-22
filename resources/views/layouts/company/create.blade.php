@extends('layouts.app_customer')

@section('content')

<div class="bg-light p-5 rounded">
    <h1>CADASTRO DE EMPRESA</h1>

    <form action="{{ route('company.store') }}" method="POST" role="form">
        @csrf
        @method('post')

        @include('layouts.forms.add_edit_company')

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
