<div class="container-fluid">
     
    <div class="container">
 
        <div class="row mt-2">
 
            <div class="row mt-2">
                <div class="form-group col-md-5 mb-2">
                    <label for="company_name">Razão Social</label>
                    <input type="text" id="company_name" name="company_name" class="form-control @error('company_name') is-invalid @enderror" value="{{ old('company_name', $company->company_name) }}" placeholder="">
                    @error('company_name')
                        <div class="invalid-feedback">
                            {{ $errors->first('company_name') }}
                        </div>
                    @enderror
                </div>

                <div class="form-group col-md-5 mb-2">
                    <label for="inputEmail4">Nome Fantasia</label>
                    <input type="text" id="trading_name" name="trading_name" class="form-control @error('trading_name') is-invalid @enderror" value="{{ old('trading_name', $company->trading_name) }}" placeholder="">
                    @error('trading_name')
                        <div class="invalid-feedback">
                            {{ $errors->first('trading_name') }}
                        </div>
                    @enderror
                </div>
                
                <div class="form-group col-md-2 mb-2">
                    <label for="inputEmail4">Revisão</label>
                    <input type="number" id="revision" name="revision" class="form-control @error('revision') is-invalid @enderror" value="{{ old('revision', $company->revision) }}" placeholder="" maxlength="3">
                    @error('revision')
                        <div class="invalid-feedback">
                            {{ $errors->first('revision') }}
                        </div>
                    @enderror
                </div>
                
            </div>
                
            <div class="row mt-2">

                <div class="form-group col-md-3 mb-2">
                    <label for="inputPassword4">CNPJ</label>
                    <input type="text" id="cnpj" name="cnpj" class="form-control cnpj @error('cnpj') is-invalid @enderror" value="{{ old('cnpj', $company->cnpj) }}" placeholder="">
                    @error('cnpj')
                        <div class="invalid-feedback">
                            {{ $errors->first('cnpj') }}
                        </div>
                    @enderror
                </div>

                <div class="form-group col-md-6 mb-2">
                    <label for="exemploFormControlInput1">E-mail</label>
                    <input type="email" id="primary_email" name="primary_email" class="form-control @error('primary_email') is-invalid @enderror" value="{{ old('primary_email', $company->primary_email) }}" placeholder="">
                    @error('primary_email')
                        <div class="invalid-feedback">
                            {{ $errors->first('primary_email') }}
                        </div>
                    @enderror
                </div>

                <div class="form-group col-md-3 mb-2">
                    <label for="phone_one">Telefone</label>
                    <input type="text" id="phone_one" name="phone_one" class="form-control phone @error('phone_one') is-invalid @enderror" value="{{ old('phone_one', $company->phone_one) }}" placeholder="">
                    @error('phone_one')
                        <div class="invalid-feedback">
                            {{ $errors->first('phone_one') }}
                        </div>
                    @enderror
                </div>
            </div>

            <div class="row mt-2">
                <div class="form-group col-md-2">
                    <label for="inputZip">CEP</label>
                    <input type="text" id="zip_code" name="zip_code" class="form-control cep @error('zip_code') is-invalid @enderror" value="{{ old('zip_code', $company->zip_code) }}" placeholder="">
                    @error('zip_code')
                        <div class="invalid-feedback">
                            {{ $errors->first('zip_code') }}
                        </div>
                    @enderror
                </div>

                <div class="form-group col-md-5 mb-2">
                    <label for="inputAddress">Endereço</label>
                    <input type="text" id="address" name="address" class="form-control @error('address') is-invalid @enderror" value="{{ old('address', $company->address) }}" placeholder="">
                    @error('address')
                        <div class="invalid-feedback">
                            {{ $errors->first('address') }}
                        </div>
                    @enderror
                </div>

                <div class="form-group col-md-2">
                    <label for="inputAddress2">Número</label>
                    <input type="text" id="number" name="number" class="form-control @error('number') is-invalid @enderror" value="{{ old('number', $company->number) }}" placeholder="" maxlength="5">
                    @error('number')
                        <div class="invalid-feedback">
                            {{ $errors->first('number') }}
                        </div>
                    @enderror
                </div>

                <div class="form-group col-md-3 mb-2">
                    <label for="complement">Complemento</label>
                    <input type="text" id="complement" name="complement" class="form-control @error('complement') is-invalid @enderror" value="{{ old('complement', $company->complement) }}" placeholder="">
                    @error('complement')
                        <div class="invalid-feedback">
                            {{ $errors->first('complement') }}
                        </div>
                    @enderror
                </div>
            </div>

            <div class="row mt-2">
                <div class="form-group col-md-5 mb-2">
                    <label for="district">Bairro</label>
                    <input type="text" id="district" name="district" class="form-control @error('district') is-invalid @enderror" value="{{ old('district', $company->district) }}" placeholder="">
                    @error('district')
                        <div class="invalid-feedback">
                            {{ $errors->first('district') }}
                        </div>
                    @enderror
                </div>

                <div class="form-group col-md-5 mb-2">
                    <label for="inputCity">Cidade</label>
                    <input type="text" id="city" name="city" class="form-control @error('city') is-invalid @enderror" value="{{ old('city', $company->city) }}" placeholder="">
                    @error('city')
                        <div class="invalid-feedback">
                            {{ $errors->first('city') }}
                        </div>
                    @enderror
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
                    @error('state')
                        <div class="invalid-feedback">
                            {{ $errors->first('state') }}
                        </div>
                    @enderror
                </div>
            </div>
            
            <div class="row mt-2">
                <div class="form-group col-md-3 mb-2">
                    <label for="state_registration">Inscrição Estadual</label>
                    <input type="text" id="state_registration" name="state_registration" class="form-control @error('state_registration') is-invalid @enderror" value="{{ old('state_registration', $company->state_registration) }}" placeholder="">
                    @error('state_registration')
                        <div class="invalid-feedback">
                            {{ $errors->first('state_registration') }}
                        </div>
                    @enderror
                </div>
                
                <div class="form-group col-md-3 mb-2">
                    <label for="city_registration">Inscrição Municipal</label>
                    <input type="text" id="city_registration" name="city_registration" class="form-control @error('city_registration') is-invalid @enderror" value="{{ old('city_registration', $company->city_registration) }}" placeholder="">
                    @error('city_registration')
                        <div class="invalid-feedback">
                            {{ $errors->first('city_registration') }}
                        </div>
                    @enderror
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
                    @error('activity_field_id')
                        <div class="invalid-feedback">
                            {{ $errors->first('activity_field_id') }}
                        </div>
                    @enderror
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
                    @error('is_active')
                        <div class="invalid-feedback">
                            {{ $errors->first('is_active') }}
                        </div>
                    @enderror
                </div>
            </div>
            
            <div class="row mt-2">
                <div class="form-group col-md-3 mb-2">
                    <label for="home_page">Site</label>
                    <input type="text" id="home_page" name="home_page" class="form-control @error('home_page') is-invalid @enderror" value="{{ old('home_page', $company->home_page) }}" placeholder="">
                    @error('home_page')
                        <div class="invalid-feedback">
                            {{ $errors->first('home_page') }}
                        </div>
                    @enderror
                </div>
                
                <div class="form-group col-md-5 mb-2">
                    <label for="primary_email">E-mail</label>
                    <input type="email" id="primary_email" name="primary_email" class="form-control @error('primary_email') is-invalid @enderror" value="{{ old('primary_email', $company->primary_email) }}" placeholder="">
                    @error('primary_email')
                        <div class="invalid-feedback">
                            {{ $errors->first('primary_email') }}
                        </div>
                    @enderror
                </div>
                
                <div class="form-group col-md-2 mb-2">
                    <label for="last_review">Atualização</label>
                    <input
                        type="text" id="last_review" name="last_review" class="form-control date @error('last_review') is-invalid @enderror"
                        value="{{ old('last_review', optional($company->last_review)->format('d/m/Y')) }}"
                        placeholder="">
                    @error('last_review')
                        <div class="invalid-feedback">
                            {{ $errors->first('last_review') }}
                        </div>
                    @enderror
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
                    @error('researcher_id')
                        <div class="invalid-feedback">
                            {{ $errors->first('researcher_id') }}
                        </div>
                    @enderror
                </div>
            </div>
            
            <div class="row mt-2">
                <div class="form-group col-md-12 mb-2">
                    <label for="notes">Observações</label>
                    <textarea
                        type="text" id="notes" name="notes"
                        class="form-control @error('notes') is-invalid @enderror"
                        rows="5" placeholder=""
                        >{{ old('notes', $company->notes) }}</textarea>
                    @error('notes')
                        <div class="invalid-feedback">
                            {{ $errors->first('notes') }}
                        </div>
                    @enderror
                </div>
            </div>
        </div>
    </div>
</div> 
