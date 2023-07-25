@include('layouts.alerts.all-errors')
<div class="container-fluid">
    
    <div class="container">
        
        <div class="row mt-2">
            
            <div class="col-md-2 mb-2">
                <label for="old_code">Código</label>
                <input type="text" id="old_code" name="old_code" class="form-control @error('old_code') is-invalid @enderror" value="{{ old('old_code', $work->old_code) }}" placeholder="">
                @error('old_code')
                    <div class="invalid-feedback">
                        {{ $errors->first('old_code') }}
                    </div>
                @enderror
            </div>

            <div class="col-md-2 mb-2">
                <label for="inputPassword4">Data Publicação</label>
                <input type="text" id="last_review" name="last_review" class="form-control date @error('last_review') is-invalid @enderror" value="{{ old('last_review', optional($work->last_review)->format('d/m/Y')) }}" placeholder="">
                @error('last_review')
                    <div class="invalid-feedback">
                        {{ $errors->first('last_review') }}
                    </div>
                @enderror
            </div>

            <div class="col-md-6 mb-2">
                <label for="researcher">Pesquisador</label>
                <select id="researcher" name="researcher_id" class="form-select @error('researcher_id') is-invalid @enderror">
                    @forelse ($researchers as $researcher)
                        @if ($loop->index == 0)
                        <option selected>-- Selecione --</option>
                        @endif

                        <option
                            value="{{ $researcher->id }}"
                            @if (old('researcher_id', $work->researcher_id) == $researcher->id) selected @endif
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

            <div class="col-md-2 mb-2">
                <label for="inputPassword4">Revisão</label>
                <input type="number" id="revision" name="revision" class="form-control @error('revision') is-invalid @enderror" value="{{ old('revision', $work->revision) }}">
                @error('revision')
                    <div class="invalid-feedback">
                        {{ $errors->first('revision') }}
                    </div>
                @enderror
            </div>
        </div>

        <div class="row mt-2">
            <div class="col-md-9 mb-2">
                <label for="inputPassword4">Obra</label>
                <input type="text" id="name" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $work->name) }}" placeholder="">
                @error('name')
                    <div class="invalid-feedback">
                        {{ $errors->first('name') }}
                    </div>
                @enderror
            </div>

            <div class="col-md-3 mb-2">
                <label for="inputPassword4">Foto</label>
                <input type="file" id="image" name="image" class="form-control" value="{{ old('name', $work->image) }}">
            </div>
        </div>

        <div class="row mt-2">
            <div class="col-md-2 mb-2">
                <label for="inputZip">CEP</label>
                <input type="text" id="zip_code" name="zip_code" class="form-control cep @error('zip_code') is-invalid @enderror" value="{{ old('zip_code', $work->zip_code) }}" placeholder="">
                @error('zip_code')
                    <div class="invalid-feedback">
                        {{ $errors->first('zip_code') }}
                    </div>
                @enderror
            </div>

            <div class="form-group col-md-5 mb-2">
                <label for="inputAddress">Endereço</label>
                <input type="text" id="address" name="address" class="form-control @error('address') is-invalid @enderror" value="{{ old('address', $work->address) }}" placeholder="">
                @error('address')
                    <div class="invalid-feedback">
                        {{ $errors->first('address') }}
                    </div>
                @enderror
            </div>

            <div class="col-md-3 mb-2">
                <label for="complement">Bairro</label>
                <input type="text" id="district" name="district" class="form-control @error('district') is-invalid @enderror" value="{{ old('district', $work->district) }}" placeholder="">
                @error('district')
                    <div class="invalid-feedback">
                        {{ $errors->first('district') }}
                    </div>
                @enderror
            </div>

            <div class="col-md-2 mb-2">
                <label for="inputAddress2">Número</label>
                <input type="text" id="number" name="number" class="form-control @error('number') is-invalid @enderror" value="{{ old('number', $work->number) }}" placeholder="">
                @error('number')
                    <div class="invalid-feedback">
                        {{ $errors->first('number') }}
                    </div>
                @enderror
            </div>
        </div>

        <div class="row mt-2">

            <div class="col-md-4 mb-2">
                <label for="inputCity">Cidade</label>
                <input type="text" id="city" name="city" class="form-control @error('city') is-invalid @enderror" value="{{ old('city', $work->city) }}" placeholder="">
                @error('city')
                    <div class="invalid-feedback">
                        {{ $errors->first('city') }}
                    </div>
                @enderror
            </div>

            <div class="col-md-2 mb-2">
                <label for="state">Estado</label>
                <select id="state" name="state" class="form-select @error('state') is-invalid @enderror">
                    <option selected>-- Selecione --</option>
                    <option value="AC" {{ old('state', $work->state) == 'AC' ? 'selected="selected"' : '' }}>AC</option>
                    <option value="AP" {{ old('state', $work->state) == 'AP' ? 'selected="selected"' : '' }}>AP</option>
                    <option value="AM" {{ old('state', $work->state) == 'AM' ? 'selected="selected"' : '' }}>AM</option>
                    <option value="BA" {{ old('state', $work->state) == 'BA' ? 'selected="selected"' : '' }}>BA</option>
                    <option value="CE" {{ old('state', $work->state) == 'CE' ? 'selected="selected"' : '' }}>CE</option>
                    <option value="DF" {{ old('state', $work->state) == 'DF' ? 'selected="selected"' : '' }}>DF</option>
                    <option value="ES" {{ old('state', $work->state) == 'ES' ? 'selected="selected"' : '' }}>ES</option>
                    <option value="GO" {{ old('state', $work->state) == 'GO' ? 'selected="selected"' : '' }}>GO</option>
                    <option value="MA" {{ old('state', $work->state) == 'MA' ? 'selected="selected"' : '' }}>MA</option>
                    <option value="MT" {{ old('state', $work->state) == 'MT' ? 'selected="selected"' : '' }}>MT</option>
                    <option value="MS" {{ old('state', $work->state) == 'MS' ? 'selected="selected"' : '' }}>MS</option>
                    <option value="MG" {{ old('state', $work->state) == 'MG' ? 'selected="selected"' : '' }}>MG</option>
                    <option value="PA" {{ old('state', $work->state) == 'PA' ? 'selected="selected"' : '' }}>PA</option>
                    <option value="PB" {{ old('state', $work->state) == 'PB' ? 'selected="selected"' : '' }}>PB</option>
                    <option value="PR" {{ old('state', $work->state) == 'PR' ? 'selected="selected"' : '' }}>PR</option>
                    <option value="PE" {{ old('state', $work->state) == 'PE' ? 'selected="selected"' : '' }}>PE</option>
                    <option value="PI" {{ old('state', $work->state) == 'PI' ? 'selected="selected"' : '' }}>PI</option>
                    <option value="RJ" {{ old('state', $work->state) == 'RJ' ? 'selected="selected"' : '' }}>RJ</option>
                    <option value="RN" {{ old('state', $work->state) == 'RN' ? 'selected="selected"' : '' }}>RN</option>
                    <option value="RS" {{ old('state', $work->state) == 'RS' ? 'selected="selected"' : '' }}>RS</option>
                    <option value="RO" {{ old('state', $work->state) == 'RO' ? 'selected="selected"' : '' }}>RO</option>
                    <option value="RR" {{ old('state', $work->state) == 'RR' ? 'selected="selected"' : '' }}>RR</option>
                    <option value="SC" {{ old('state', $work->state) == 'SC' ? 'selected="selected"' : '' }}>SC</option>
                    <option value="SE" {{ old('state', $work->state) == 'SE' ? 'selected="selected"' : '' }}>SE</option>
                    <option value="SP" {{ old('state', $work->state) == 'SP' ? 'selected="selected"' : '' }}>SP</option>
                    <option value="TO" {{ old('state', $work->state) == 'TO' ? 'selected="selected"' : '' }}>TO</option>
                    <option value="AL" {{ old('state', $work->state) == 'AL' ? 'selected="selected"' : '' }}>AL</option>
                </select>
                @error('state')
                    <div class="invalid-feedback">
                        {{ $errors->first('state') }}
                    </div>
                @enderror
            </div>
        </div>

        <div class="row mt-2">
            <div class="col-md-3 mb-2">
                <label for="segment">Segmento de Atuação</label>
                <select id="segment" name="segment_id" class="form-select @error('segment_id') is-invalid @enderror">
                    @foreach ($segments as $segment)
                    @if ($loop->index == 0)
                    <option selected>-- Selecione --</option>
                    @endif

                    <option
                        value="{{ $segment->id }}"
                        @if (old('segment_id', $work->segment_id) == $segment->id) selected @endif
                        >
                        {{ $segment->description }}
                    </option>
                    @endforeach
                </select>
                @error('segment_id')
                    <div class="invalid-feedback">
                        {{ $errors->first('segment_id') }}
                    </div>
                @enderror
            </div>

            <div class="col-md-3 mb-2">
                <label for="segment_sub_type">Subtipo</label>
                <select id="segment_sub_type" name="segment_sub_type_id" class="form-select @error('segment_sub_type_id') is-invalid @enderror">
                    @forelse ($segmentSubTypes as $segmentSubType)
                    @if ($loop->index == 0)
                    <option value="" selected>-- Selecione primeiro o segmento --</option>
                    @endif

                    <option
                        value="{{ $segmentSubType->id }}"
                        @if (old('segment_sub_type_id', $work->segment_sub_type_id) == $segmentSubType->id) selected @endif
                        >
                        {{ $segmentSubType->description }}
                    </option>

                    @empty
                    <option value="" selected>-- Selecione primeiro o segmento --</option>

                    @endforelse
                </select>
                @error('segment_sub_type_id')
                    <div class="invalid-feedback">
                        {{ $errors->first('segment_sub_type_id') }}
                    </div>
                @enderror
            </div>

            <div class="col-md-3 mb-2">
                <label for="phase">Fase</label>
                <select id="phase" name="phase_id" class="form-select @error('phase_id') is-invalid @enderror">
                    @foreach ($phases as $phase)
                    @if ($loop->index == 0)
                    <option selected>-- Selecione --</option>
                    @endif

                    <option
                        value="{{ $phase->id }}"
                        @if (old('phase_id', $work->phase_id) == $phase->id) selected @endif
                        >
                        {{ $phase->description }}
                    </option>
                    @endforeach
                </select>
                @error('phase_id')
                    <div class="invalid-feedback">
                        {{ $errors->first('phase_id') }}
                    </div>
                @enderror
            </div>

            <div class="col-md-3 mb-2">
                <label for="stage">Estágio</label>
                <select id="stage" name="stage_id" class="form-select @error('stage_id') is-invalid @enderror">
                    @forelse ($stages as $stage)
                    @if ($loop->index == 0)
                    <option value="" selected>-- Selecione primeiro a fase --</option>
                    @endif

                    <option
                        value="{{ $stage->id }}"
                        @if (old('stage_id', $work->stage_id) == $stage->id) selected @endif
                        >
                        {{ $stage->description }}
                    </option>

                    @empty
                    <option value="" selected>-- Selecione primeiro a fase --</option>

                    @endforelse
                </select>
                @error('stage_id')
                    <div class="invalid-feedback">
                        {{ $errors->first('stage_id') }}
                    </div>
                @enderror
            </div>
        </div>

        <div class="row mt-2">
            <div class="form-group col-md-2 mb-2">
                <label for="started_at">Início da Obra</label>
                <input type="text" id="started_at" name="started_at" class="form-control date @error('started_at') is-invalid @enderror" value="{{ old('started_at', optional($work->started_at)->format('d/m/Y')) }}" placeholder="">
                @error('started_at')
                    <div class="invalid-feedback">
                        {{ $errors->first('started_at') }}
                    </div>
                @enderror
            </div>

            <div class="form-group col-md-2 mb-2">
                <label for="ends_at">Término da Obra</label>
                <input type="text" id="ends_at" name="ends_at" class="form-control date @error('ends_at') is-invalid @enderror" value="{{ old('ends_at', optional($work->ends_at)->format('d/m/Y')) }}" placeholder="">
                @error('ends_at')
                    <div class="invalid-feedback">
                        {{ $errors->first('ends_at') }}
                    </div>
                @enderror
            </div>

            <div class="form-group col-md-2 mb-2">
                <label for="start_and_end">Início / Término</label>
                <input type="text" id="start_and_end" name="start_and_end" class="form-control @error('start_and_end') is-invalid @enderror" value="{{ old('start_and_end', $work->start_and_end) }}" placeholder="">
                @error('start_and_end')
                    <div class="invalid-feedback">
                        {{ $errors->first('start_and_end') }}
                    </div>
                @enderror
            </div>

            <div class="form-group col-md-3 mb-2">
                <label for="inputPassword4">Investimento</label>
                <input type="text" id="price" name="price" class="form-control money @error('price') is-invalid @enderror" value="{{ old('price', $work->price) }}" placeholder="">
                @error('price')
                    <div class="invalid-feedback">
                        {{ $errors->first('price') }}
                    </div>
                @enderror
            </div>

            <div class="form-group col-md-3 mb-2">
                <label for="inputPassword4">PADRÃO <code>investimento</code></label>
                <select name="investment_standard" class="form-select @error('investment_standard') is-invalid @enderro">
                    <option value="">-- Selecione --</option>
                    <option value="alto">Alto</option>
                    <option value="baixo">Baixo</option>
                    <option value="medio">Médio</option>
                </select>
                @error('investment_standard')
                    <div class="invalid-feedback">
                        {{ $errors->first('investment_standard') }}
                    </div>
                @enderror
            </div>

        </div>

        <div class="row mt-2">
            <div class="form-group col-md-3 mb-2">
                <label for="inputPassword4">Área total do Projeto</label>
                <input type="text" id="total_project_area" name="total_project_area" class="form-control @error('total_project_area') is-invalid @enderror" value="{{ old('total_project_area', $work->total_project_area) }}" placeholder="">
                @error('total_project_area')
                    <div class="invalid-feedback">
                        {{ $errors->first('total_project_area') }}
                    </div>
                @enderror
            </div>
        </div>

        <div class="row mt-2">
            <div class="form-group col-md-12 mb-2">
                
                <p><strong>DESCRIÇÃO</strong></p>

                <table class="table table-bordered table-condensed">
                    <tr>
                        <th>Edifício(s) residencial(s)</th>
                        <th>Casa(s)</th>
                        <th>Condomínio</th>
                        <th>Pavimento(s)</th>
                        <th>Apartamento(s) por Andar</th>
                    </tr>
                    <tr>
                        <td>
                            <input type="text" name="tower" class="form-control @error('tower') is-invalid @enderror" value="{{ old('tower', $work->tower) }}"/>
                            @error('tower')
                                <div class="invalid-feedback">
                                    {{ $errors->first('tower') }}
                                </div>
                            @enderror
                        </td>
                        <td>
                            <input type="text" name="house" class="form-control @error('house') is-invalid @enderror" value="{{ old('house', $work->house) }}" />
                            @error('house')
                                <div class="invalid-feedback">
                                    {{ $errors->first('house') }}
                                </div>
                            @enderror
                        </td>
                        <td>
                            <input type="text" name="condominium" class="form-control @error('condominium') is-invalid @enderror" value="{{ old('condominium', $work->condominium) }}"/>
                            @error('condominium')
                                <div class="invalid-feedback">
                                    {{ $errors->first('condominium') }}
                                </div>
                            @enderror
                        </td>
                        <td>
                            <input type="text" name="floor" class="form-control @error('floor') is-invalid @enderror" value="{{ old('floor', $work->floor) }}"/>
                            @error('floor')
                                <div class="invalid-feedback">
                                    {{ $errors->first('floor') }}
                                </div>
                            @enderror
                        </td> 
                        <td>
                            <input type="text" name="apartment_per_floor" class="form-control @error('apartment_per_floor') is-invalid @enderror" value="{{ old('apartment_per_floor', $work->apartment_per_floor) }}"/>
                            @error('apartment_per_floor')
                                <div class="invalid-feedback">
                                    {{ $errors->first('apartment_per_floor') }}
                                </div>
                            @enderror
                        </td>
                    </tr>
                    <tr>
                        <th>Dormitório(s)</th>
                        <th>Suítes(s)</th>
                        <th>Banheiro(s)</th>
                        <th colspan="2">Lavabo(s)</th>
                    </tr>
                    <tr>
                        <td>
                            <input type="text" name="bedroom" class="form-control @error('bedroom') is-invalid @enderror" value="{{ old('bedroom', $work->bedroom) }}"/>
                            @error('bedroom')
                                <div class="invalid-feedback">
                                    {{ $errors->first('bedroom') }}
                                </div>
                            @enderror
                        </td>
                        <td>
                            <input type="text" name="suite" class="form-control @error('suite') is-invalid @enderror" value="{{ old('suite', $work->suite) }}"/>
                            @error('suite')
                                <div class="invalid-feedback">
                                    {{ $errors->first('suite') }}
                                </div>
                            @enderror
                        </td>
                        <td>
                            <input type="text" name="bathroom" class="form-control @error('bathroom') is-invalid @enderror" value="{{ old('bathroom', $work->bathroom) }}"/>
                            @error('bathroom')
                                <div class="invalid-feedback">
                                    {{ $errors->first('bathroom') }}
                                </div>
                            @enderror
                        </td>
                        <td colspan="2">
                            <input type="text" name="washbasin" class="form-control @error('washbasin') is-invalid @enderror" value="{{ old('washbasin', $work->washbasin) }}"/>
                            @error('washbasin')
                                <div class="invalid-feedback">
                                    {{ $errors->first('washbasin') }}
                                </div>
                            @enderror
                        </td>
                    </tr>
                    <tr>
                        <th>Sala(s) de estar / jantar</th>
                        <th>Copa(s) / Cozinha(s)</th>
                        <th>Área(s) de serviço / Terraço(s) / Varanda(s)</th>
                        <th colspan="2">Dependência de empregada</th>
                    </tr>
                    <tr>
                        <td><select name="living_room" class="form-select @error('living_room') is-invalid @enderror">
                                <option value="0">-- Selecione --</option>
                                <option value="0/0">0/0</option>
                                <option value="0/1">0/1</option>
                                <option value="1/0">1/0</option>
                                <option value="1/1">1/1</option>
                            </select>
                            @error('living_room')
                                <div class="invalid-feedback">
                                    {{ $errors->first('living_room') }}
                                </div>
                            @enderror
                        </td>
                        <td><select name="cup_and_kitchen" class="form-select @error('cup_and_kitchen') is-invalid @enderror">
                                <option value="0">-- Selecione --</option>
                                <option value="0/0">0/0</option>
                                <option value="0/1">0/1</option>
                                <option value="1/0">1/0</option>
                                <option value="1/1">1/1</option>
                            </select>
                            @error('cup_and_kitchen')
                                <div class="invalid-feedback">
                                    {{ $errors->first('cup_and_kitchen') }}
                                </div>
                            @enderror
                        </td>
                        <td><select name="service_area_terrace_balcony" class="form-select @error('service_area_terrace_balcony') is-invalid @enderror">
                                <option value="0"> -- Selecione --</option>
                                <option value="0/0/0">0/0/0</option>
                                <option value="1/0/1">1/0/1</option>
                                <option value="1/1/1">1/1/1</option>
                                <option value="1/1/0">1/1/0</option>
                                <option value="1/0/0">1/0/0</option>
                            </select>
                            @error('service_area_terrace_balcony')
                                <div class="invalid-feedback">
                                    {{ $errors->first('service_area_terrace_balcony') }}
                                </div>
                            @enderror
                        </td>
                        <td colspan="2">
                            <input type="text" name="maid_dependency" class="form-control {@error('maid_dependency') is-invalid @enderror" value="{{ old('maid_dependency', $work->maid_dependency) }}"/>
                            @error('maid_dependency')
                                <div class="invalid-feedback">
                                    {{ $errors->first('maid_dependency') }}
                                </div>
                            @enderror  
                        </td>
                    </tr>
                </table>
            </div>

        </div>

        <div class="row mt-2">
            <!--AREA DE LAZER-->
            <div class="col-md-12">
                <p><strong>ÁREA DE LAZER</strong></p>
            </div>
            <div class="col-md-3">
                <input type="checkbox" name="" value="1" /> Salão de festas
            </div>
            <div class="col-md-3">
                <input type="checkbox" name="" value="2" /> Salão de jogos
            </div>
            <div class="col-md-3">
                <input type="checkbox" name="" value="4" /> Piscina
            </div>
            <div class="col-md-3">
                <input type="checkbox" name="" value="8" /> Sauna
            </div>
            <div class="col-md-3">
                <input type="checkbox" name="" value="16" /> Churrasqueira
            </div>
            <div class="col-md-3">
                <input type="checkbox" name="" value="32" /> Quadra
            </div>
            <div class="col-md-3">
                <input type="checkbox" name="" value="64" /> Fitness
            </div>
            <div class="col-md-3">
                <input type="checkbox" name="" value="128" /> Gourmet
            </div>
            <div class="col-md-3">
                <input type="checkbox" name="" value="256" /> Playground
            </div>
            <div class="col-md-3">
                <input type="checkbox" name="" value="512" /> Spa
            </div>
            <div class="col-md-3">
                <input type="checkbox" name="" value="1024" /> Brinquedoteca
            </div>

            <!--Soma dos checkbox-->
            <div class="col-md-3">
                <input type="hidden" name="recreation_area" class="form-control" value="0" />
            </div>

            <div class="col-md-12 mt-2">
                <label class="control-label"> <strong>Outros</strong></label>
                <input type="text" name="other_leisure" class="form-control @error('other_leisure') is-invalid @enderror" value="{{ old('other_leisure', $work->other_leisure) }}" />
                @error('other_leisure')
                    <div class="invalid-feedback">
                        {{ $errors->first('other_leisure') }}
                    </div>
                @enderror
            </div>

        </div>

        <div class="row mt-2">
            <!--INFORMAÇÕES ADICIONAIS-->
            <div class="col-md-12 mt-2 mb-2">
                <p><strong>INFORMAÇÕES ADICIONAIS</strong></p>

                <table class="table table-bordered table-condensed">
                    <tr>
                        <th>Total de Unidade(s)</th>
                        <th>Área Útil (m2)</th>
                        <th>Área do Terreno (m2)</th>
                        <th>Elevador(s)</th>
                        <th>Vaga(s)</th>
                        <th>Cobertura(s)</th>
                    </tr>
                    <tr>
                        <td>
                            <input type="text" name="total_unities" class="form-control @error('total_unities') is-invalid @enderror" value="{{ old('total_unities', $work->total_unities) }}"/>
                            @error('total_unities')
                                <div class="invalid-feedback">
                                    {{ $errors->first('total_unities') }}
                                </div>
                            @enderror
                        </td>
                        <td>
                            <input type="text" name="useful_area" class="form-control @error('useful_area') is-invalid @enderror" value="{{ old('useful_area', $work->useful_area) }}"/>
                            @error('useful_area')
                                <div class="invalid-feedback">
                                    {{ $errors->first('useful_area') }}
                                </div>
                            @enderror
                        </td>
                        <td>
                            <input type="text" name="total_area" class="form-control @error('total_area') is-invalid @enderror" value="{{ old('total_area', $work->total_area) }}"/>
                            @error('total_area')
                                <div class="invalid-feedback">
                                    {{ $errors->first('total_area') }}
                                </div>
                            @enderror
                        </td>
                        <td>
                            <input type="text" name="elevator" class="form-control @error('elevator') is-invalid @enderror" value="{{ old('elevator', $work->elevator) }}"/>
                            @error('elevator')
                                <div class="invalid-feedback">
                                    {{ $errors->first('elevator') }}
                                </div>
                            @enderror
                        </td>
                        <td>
                            <input type="text" name="garage" class="form-control @error('garage') is-invalid @enderror" value="{{ old('garage', $work->garage) }}"/>
                            @error('garage')
                                <div class="invalid-feedback">
                                    {{ $errors->first('garage') }}
                                </div>
                            @enderror
                        </td>
                        <td>
                            <input type="text" name="coverage" class="form-control @error('coverage') is-invalid @enderror" value="{{ old('coverage', $work->coverage) }}"/>
                            @error('coverage')
                                <div class="invalid-feedback">
                                    {{ $errors->first('coverage') }}
                                </div>
                            @enderror
                        </td>
                    </tr>
                    <tr>
                        <th>Ar condiconado</th>
                        <th>Aquecimento</th>
                        <th>Fundações</th>
                        <th>Estrutura</th>
                        <th>Acabamento</th>
                        <th>Fachada</th>
                    </tr>
                    <tr>
                        <td>
                            <input type="text" name="air_conditioner" class="form-control @error('air_conditioner') is-invalid @enderror" value="{{ old('air_conditioner', $work->air_conditioner) }}"/>
                            @error('air_conditioner')
                                <div class="invalid-feedback">
                                    {{ $errors->first('air_conditioner') }}
                                </div>
                            @enderror
                        </td>
                        <td>
                            <input type="text" name="heating" class="form-control @error('heating') is-invalid @enderror" value="{{ old('heating', $work->heating) }}"/>
                            @error('heating')
                                <div class="invalid-feedback">
                                    {{ $errors->first('heating') }}
                                </div>
                            @enderror
                        </td>
                        <td>
                            <select name="foundry" class="form-select @error('foundry') is-invalid @enderror">
                                <option value="">-- Selecione --</option>
                                <option value="CASAS">CASAS</option>
                                <option value="Sapata Isolada">Sapata Isolada</option>
                                <option value="Radier">Radier</option>
                                <option value="Sapata Corrida">Sapata Corrida</option>
                                <option value="Viga Baldrame">Viga Baldrame</option>
                                <option value="Bate-Estacas">Bate-Estacas</option>
                                <option value="Estacas">Estacas</option>
                                <option value="Estaca hélice contínua">Estaca hélice contínua</option>
                                <option value="Tubulão">Tubulão</option>
                                <option value="Direta">Direta</option>
                                <option value="Blocos de Fundação">Blocos de Fundação</option>
                                <option value="Franki">Franki</option>
                                <option value="Estaca Raiz">Estaca Raiz</option>
                            </select>
                            @error('foundry')
                                <div class="invalid-feedback">
                                    {{ $errors->first('foundry') }}
                                </div>
                            @enderror
                        </td>
                        <td>
                            <select name="frame" class="form-select @error('frame') is-invalid @enderror">
                                <option value="">-- Selecione --</option>
                                <option value="casas">Casas</option>
                                <option value="Bloco Estrutural">Bloco Estrutural</option>
                                <option value="Estruturas metálicas">Estruturas metálicas</option>
                                <option value="Concreto armado">Concreto armado</option>
                                <option value="Concreto protendido">Concreto protendido</option>
                                <option value="Steel frame">Steel frame</option>
                                <option value="Steel deck">Steel deck</option>
                                <option value="Wood frame">Wood frame</option>
                                <option value="Alvenaria estrutural">Alvenaria estrutural</option>
                                <option value="Baldrame">Baldrame</option>
                                <option value="Laje Nervurada">Laje Nervurada</option>
                                <option value="Pré Moldado">Pré Moldado</option>
                                <option value="Parede de Concreto">Parede de Concreto</option>
                            </select>
                            @error('frame')
                                <div class="invalid-feedback">
                                    {{ $errors->first('frame') }}
                                </div>
                            @enderror
                        </td>
                        <td>
                            <input type="text" name="completion" class="form-control @error('completion') is-invalid @enderror" value="{{ old('completion', $work->completion) }}"/>
                            @error('completion')
                                <div class="invalid-feedback">
                                    {{ $errors->first('completion') }}
                                </div>
                            @enderror
                        </td>
                        <td>
                            <input type="text" name="facade" class="form-control @error('facade') is-invalid @enderror" value="{{ old('facade', $work->facade) }}"/>
                            @error('facade')
                                <div class="invalid-feedback">
                                    {{ $errors->first('facade') }}
                                </div>
                            @enderror
                        </td>
                    </tr>
                </table>
            </div>

        </div>

        <div class="form-row mt-2">
            <div class="form-group col-md-12 mb-2">
                <label for="notes"><strong>DESCRIÇÕES COMPLEMENTARES</strong></label>
                <textarea type="text" id="notes" name="notes" class="form-control @error('notes') is-invalid @enderror" rows="5" placeholder="">{{ old('notes', $work->notes) }}</textarea>
                @error('notes')
                    <div class="invalid-feedback">
                        {{ $errors->first('notes') }}
                    </div>
                @enderror
            </div>
        </div>

        <div class="row">
            <div class="col-sm-3">
                <label class="control-label"><strong>STATUS</strong></label>
                <select name="status" class="form-select @error('status') is-invalid @enderror">
                    <option value="0">-- Selecione --</option>
                    <option
                        value="1"
                        @if(old('is_active', $work->status) == 1) selected @endif>
                        Ativada
                    </option>
                    <option
                        value="0"
                        @if(old('is_active', $work->status) == 0) selected @endif>
                        Desativada
                    </option>
                </select>
                @error('status')
                    <div class="invalid-feedback">
                        {{ $errors->first('status') }}
                    </div>
                @enderror
            </div>
        </div>
        
        <!--Botão-->
        <div class="row mt-2">
            <div class="modal-footer">
                <div class="col-sm-12">
                    <button type="submit" class="btn btn-success" title="Gravar Dados"> ADD Empresa(s) Participante(s)</button>
                </div>
            </div>
        </div>

        <hr class="my-3">

        <div class="row">
            <div class="col">
                <h3>Contatos</h3>
                <ul>
                    @foreach ($work->contacts()->get() as $contact)
                    <li>{{ $contact->name }} - (<a href="mailto:{{ $contact->email }}">{{ $contact->email }}</a>)</li>
                    @endforeach
                </ul>
            </div>
        </div>

        <hr class="my-3">
    </div>
</div>