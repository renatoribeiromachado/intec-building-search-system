<div class="container-fluid">
     
    <div class="container">
 
        <div class="row mt-2">
 
            <div class="row mt-2">
                <div class="form-group col-md-5 mb-2">
                    <label for="company_name">Razão Social</label>
                    <input type="text" id="company_name" name="company_name" class="form-control {{ $errors->has('company_name') ? 'is-invalid' : '' }}" value="{{ old('company_name', $company->company_name) }}" placeholder="">
                </div>

                <div class="form-group col-md-5 mb-2">
                    <label for="inputEmail4">Nome Fantasia</label>
                    <input type="text" id="trading_name" name="trading_name" class="form-control {{ $errors->has('trading_name') ? 'is-invalid' : '' }}" value="{{ old('trading_name', $company->trading_name) }}" placeholder="">
                </div>
                
                <div class="form-group col-md-2 mb-2">
                    <label for="inputEmail4">Revisão</label>
                    <input type="number" id="revision" name="revision" class="form-control {{ $errors->has('revision') ? 'is-invalid' : '' }}" value="{{ old('revision', $company->revision) }}" placeholder="" maxlength="3">
                </div>
                
            </div>
                
            <div class="row mt-2">

                <div class="form-group col-md-3 mb-2">
                    <label for="inputPassword4">CNPJ</label>
                    <input type="text" id="cnpj" name="cnpj" class="form-control cnpj {{ $errors->has('cnpj') ? 'is-invalid' : '' }}" value="{{ old('cnpj', $company->cnpj) }}" placeholder="">
                </div>

                <div class="form-group col-md-6 mb-2">
                    <label for="exemploFormControlInput1">E-mail</label>
                    <input type="email" id="primary_email" name="primary_email" class="form-control" value="{{ old('primary_email', $company->primary_email) }}" placeholder="">
                </div>

                <div class="form-group col-md-3 mb-2">
                    <label for="phone_one">Telefone</label>
                    <input type="text" id="phone_one" name="phone_one" class="form-control phone" value="{{ old('phone_one', $company->phone_one) }}" placeholder="">
                </div>
            </div>

            <div class="row mt-2">
                <div class="form-group col-md-2">
                    <label for="inputZip">CEP</label>
                    <input type="text" id="zip_code" name="zip_code" class="form-control cep" value="{{ old('zip_code', $company->zip_code) }}" placeholder="">
                </div>

                <div class="form-group col-md-5 mb-2">
                    <label for="inputAddress">Endereço</label>
                    <input type="text" id="address" name="address" class="form-control" value="{{ old('address', $company->address) }}" placeholder="">
                </div>

                <div class="form-group col-md-2">
                    <label for="inputAddress2">Número</label>
                    <input type="text" id="number" name="number" class="form-control" value="{{ old('number', $company->number) }}" placeholder="" maxlength="5">
                </div>

                <div class="form-group col-md-3 mb-2">
                    <label for="complement">Complemento</label>
                    <input type="text" id="complement" name="complement" class="form-control" value="{{ old('complement', $company->complement) }}" placeholder="">
                </div>
            </div>

            <div class="row mt-2">
                <div class="form-group col-md-5 mb-2">
                    <label for="district">Bairro</label>
                    <input type="text" id="district" name="district" class="form-control" value="{{ old('district', $company->district) }}" placeholder="">
                </div>

                <div class="form-group col-md-5 mb-2">
                    <label for="inputCity">Cidade</label>
                    <input type="text" id="city" name="city" class="form-control" value="{{ old('city', $company->city) }}" placeholder="">
                </div>

                <div class="form-group col-md-2 mb-2">
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
            
            <div class="row mt-2">
                <div class="form-group col-md-3 mb-2">
                    <label for="state_registration">Inscrição Estadual</label>
                    <input type="text" id="state_registration" name="state_registration" class="form-control" value="{{ old('state_registration', $company->state_registration) }}" placeholder="">
                </div>
                
                <div class="form-group col-md-3 mb-2">
                    <label for="city_registration">Inscrição Municipal</label>
                    <input type="text" id="city_registration" name="city_registration" class="form-control" value="{{ old('city_registration', $company->city_registration) }}" placeholder="">
                </div>
                
                <div class="form-group col-md-4 mb-2">
                    <label for="activity_field">Atividade</label>
                    <select id="activity_field" name="activity_field_id" class="form-control">
                        @forelse ($activityFields as $activityField)
                            @if ($loop->index == 0)
                            <option selected>-- Selecione --</option>
                            @endif
    
                            <option
                                value="{{ $activityField->id }}"
                                @if (old('researcher_id', $company->activity_field_id) == $activityField->id) selected @endif
                                >
                                {{ $activityField->description }}
                            </option>
                            @empty
                            <option selected>-- Selecione --</option>
                        @endforelse
                    </select>
                </div>
                
                <div class="form-group col-md-2 mb-2">
                    <label for="is_active">Status</label>
                    <select id="is_active" name="is_active" class="form-control">
                        <option value="" selected>-- Selecione --</option>
                        <option
                            value="1"
                            @if(old('is_active', $company->is_active) == 1) selected @endif>
                            Ativada
                        </option>
                        <option
                            value="0"
                            @if(old('is_active', $company->is_active) == 0) selected @endif>
                            Desativada
                        </option>
                    </select>
                </div>
            </div>
            
            <div class="row mt-2">
                <div class="form-group col-md-3 mb-2">
                    <label for="home_page">Site</label>
                    <input type="text" id="home_page" name="home_page" class="form-control" value="{{ old('home_page', $company->home_page) }}" placeholder="">
                </div>
                
                <div class="form-group col-md-5 mb-2">
                    <label for="primary_email">E-mail</label>
                    <input type="email" id="primary_email" name="email" class="form-control" value="{{ old('primary_email', $company->primary_email) }}" placeholder="">
                </div>
                
                <div class="form-group col-md-2 mb-2">
                    <label for="last_review">Atualização</label>
                    <input
                        type="text" id="last_review" name="last_review" class="form-control date"
                        value="{{ old('last_review', optional($company->last_review)->format('d/m/Y')) }}"
                        placeholder="">
                </div>
                
                <div class="form-group col-md-2 mb-2">
                    <label for="researcher">Pesquisador</label>
                    <select id="researcher" name="researcher_id" class="form-control">
                        @forelse ($researchers as $researcher)
                            @if ($loop->index == 0)
                            <option selected>-- Selecione --</option>
                            @endif
    
                            <option
                                value="{{ $researcher->id }}"
                                @if (old('researcher_id', $company->researcher_id) == $researcher->id) selected @endif
                                >
                                {{ $researcher->name }}
                            </option>
                            @empty
                            <option selected>-- Selecione --</option>
                        @endforelse
                    </select>
                </div>
            </div>
            
            <div class="row mt-2">
                <div class="form-group col-md-12 mb-2">
                    <label for="notes">Observações</label>
                    <textarea
                        type="text" id="notes" name="notes"
                        class="form-control {{ $errors->has('notes') ? 'is-invalid' : '' }}"
                        rows="5" placeholder=""
                        >{{ old('notes', $company->notes) }}</textarea>
                </div>
            </div>
        </div>
    </div>
</div> 
