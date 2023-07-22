@extends('layouts.app_customer')

@section('content')

<div class="bg-light p-5 rounded">
    <h1>CADASTRO DE EMPRESA</h1>

    <form action="{{ route('company.store') }}" method="POST" role="form">
        @csrf
        @method('post')

        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="company_name">Razão Social</label>
                <input type="text" id="company_name" name="company_name" class="form-control {{ $errors->has('company_name') ? 'is-invalid' : '' }}" value="{{ old('company_name', $company->company_name) }}" placeholder="ex: Minha Empresa LTDA">
            </div>

            <div class="form-group col-md-6">
                <label for="inputEmail4">Nome Fantasia</label>
                <input type="text" id="trading_name" name="trading_name" class="form-control {{ $errors->has('trading_name') ? 'is-invalid' : '' }}" value="{{ old('trading_name', $company->trading_name) }}" placeholder="ex: Minha Empresa">
            </div>
            
            <div class="form-group col-md-3">
                <label for="inputPassword4">CNPJ</label>
                <input type="text" id="cnpj" name="cnpj" class="form-control cnpj {{ $errors->has('cnpj') ? 'is-invalid' : '' }}" value="{{ old('cnpj', $company->cnpj) }}" placeholder="ex: 23.025.414/0001-23">
            </div>

            <div class="form-group col-md-4">
                <label for="exemploFormControlInput1">E-mail</label>
                <input type="email" id="email" name="email" class="form-control" value="{{ old('email', $company->email) }}" placeholder="nome@exemplo.com">
            </div>

            <div class="form-group col-md-3">
                <label for="inputPassword4">Telefone</label>
                <input type="text" id="phone" name="phone" class="form-control phone" value="{{ old('phone_one', $company->phone_one) }}" placeholder="ex: (16) 99123-1234">
            </div>
        </div>
        
        <div class="form-row">
            <div class="form-group col-md-2">
                <label for="inputZip">CEP</label>
                <input type="text" id="zip_code" name="zip_code" class="form-control cep" value="{{ old('zip_code', $company->zip_code) }}" placeholder="ex: 14200-000">
            </div>

            <div class="form-group col-md-5">
                <label for="inputAddress">Endereço</label>
                <input type="text" id="address" name="address" class="form-control" value="{{ old('address', $company->address) }}" placeholder="ex: Rua Nove de Julho">
            </div>

            <div class="form-group col-md-2">
                <label for="inputAddress2">Número</label>
                <input type="text" id="number" name="number" class="form-control" value="{{ old('number', $company->number) }}" placeholder="ex: 302">
            </div>

            <div class="form-group col-md-3">
                <label for="complement">Complemento</label>
                <input type="text" id="complement" name="complement" class="form-control" value="{{ old('complement', $company->complement) }}" placeholder="ex: Apto 12">
            </div>
        </div>
        
        <div class="form-row">
            <div class="form-group col-md-4">
                <label for="complement">Bairro</label>
                <input type="text" id="district" name="district" class="form-control" value="{{ old('district', $company->district) }}" placeholder="ex: Jd. Primavera">
            </div>

            <div class="form-group col-md-4">
                <label for="inputCity">Cidade</label>
                <input type="text" id="city" name="city" class="form-control" value="{{ old('city', $company->city) }}" placeholder="ex: Ribeirão Preto">
            </div>

            <div class="form-group col-md-2">
                <label for="state">Estado</label>
                <select id="state" name="state" class="form-control">
                <option selected>-- Selecione --</option>
                    <option value="AC" {{ old('state', $company->state) == 'AC' ? 'selected="selected"' : '' }}>AC</option>
                    <option value="AP" {{ old('state', $company->state) == 'AP' ? 'selected="selected"' : '' }}>AP</option>
                    <option value="AM" {{ old('state', $company->state) == 'AM' ? 'selected="selected"' : '' }}>AM</option>
                    <option value="BA" {{ old('state', $company->state) == 'BA' ? 'selected="selected"' : '' }}>BA</option>
                    <option value="CE" {{ old('state', $company->state) == 'CE' ? 'selected="selected"' : '' }}>CE</option>
                    <option value="DF" {{ old('state', $company->state) == 'DF' ? 'selected="selected"' : '' }}>DF</option>
                    <option value="ES" {{ old('state', $company->state) == 'ES' ? 'selected="selected"' : '' }}>ES</option>
                    <option value="GO" {{ old('state', $company->state) == 'GO' ? 'selected="selected"' : '' }}>GO</option>
                    <option value="MA" {{ old('state', $company->state) == 'MA' ? 'selected="selected"' : '' }}>MA</option>
                    <option value="MT" {{ old('state', $company->state) == 'MT' ? 'selected="selected"' : '' }}>MT</option>
                    <option value="MS" {{ old('state', $company->state) == 'MS' ? 'selected="selected"' : '' }}>MS</option>
                    <option value="MG" {{ old('state', $company->state) == 'MG' ? 'selected="selected"' : '' }}>MG</option>
                    <option value="PA" {{ old('state', $company->state) == 'PA' ? 'selected="selected"' : '' }}>PA</option>
                    <option value="PB" {{ old('state', $company->state) == 'PB' ? 'selected="selected"' : '' }}>PB</option>
                    <option value="PR" {{ old('state', $company->state) == 'PR' ? 'selected="selected"' : '' }}>PR</option>
                    <option value="PE" {{ old('state', $company->state) == 'PE' ? 'selected="selected"' : '' }}>PE</option>
                    <option value="PI" {{ old('state', $company->state) == 'PI' ? 'selected="selected"' : '' }}>PI</option>
                    <option value="RJ" {{ old('state', $company->state) == 'RJ' ? 'selected="selected"' : '' }}>RJ</option>
                    <option value="RN" {{ old('state', $company->state) == 'RN' ? 'selected="selected"' : '' }}>RN</option>
                    <option value="RS" {{ old('state', $company->state) == 'RS' ? 'selected="selected"' : '' }}>RS</option>
                    <option value="RO" {{ old('state', $company->state) == 'RO' ? 'selected="selected"' : '' }}>RO</option>
                    <option value="RR" {{ old('state', $company->state) == 'RR' ? 'selected="selected"' : '' }}>RR</option>
                    <option value="SC" {{ old('state', $company->state) == 'SC' ? 'selected="selected"' : '' }}>SC</option>
                    <option value="SE" {{ old('state', $company->state) == 'SE' ? 'selected="selected"' : '' }}>SE</option>
                    <option value="SP" {{ old('state', $company->state) == 'SP' ? 'selected="selected"' : '' }}>SP</option>
                    <option value="TO" {{ old('state', $company->state) == 'TO' ? 'selected="selected"' : '' }}>TO</option>
                    <option value="AL" {{ old('state', $company->state) == 'AL' ? 'selected="selected"' : '' }}>AL</option>
                </select>
            </div>
        </div>

        <div class="form-row my-3">
            <div class="form-group">
                <button
                    type="submit"
                    class="btn btn-primary"
                    >
                    Salvar</button>
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
