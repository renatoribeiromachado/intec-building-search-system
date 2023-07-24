@include('layouts.alerts.all-errors')
<div class="container-fluid">
    
    <div class="container">
        
        <div class="row mt-2">
            
            <div class="col-md-2 mb-2">
                <label for="old_code">Código</label>
                <input type="text" id="old_code" name="old_code" class="form-control {{ $errors->has('old_code') ? 'is-invalid' : '' }}" value="{{ old('old_code', $work->old_code) }}" placeholder="">
            </div>

            <div class="col-md-2 mb-2">
                <label for="inputPassword4">Data Publicação</label>
                <input type="text" id="last_review" name="last_review" class="form-control date {{ $errors->has('last_review') ? 'is-invalid' : '' }}" value="{{ old('last_review', optional($work->last_review)->format('d/m/Y')) }}" placeholder="">
            </div>

            <div class="col-md-6 mb-2">
                <label for="inputPassword4">Pesquisador</label>
                <select id="researcher" name="researcher_id" class="form-control">
                    <option selected>-- Selecione --</option>
                    @foreach ($researchers as $researcher)
                        @if ($loop->index == 0)
                        <option selected>-- Selecione --</option>
                        @endif

                        <option
                            value="{{ $researcher->id }}"
                            @if (old('researcher_id', $work->researcher_id) == $researcher->id) selected @endif
                            >
                            {{ $researcher->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-2 mb-2">
                <label for="inputPassword4">Revisão</label>
                <input type="number" id="revision" name="revision" class="form-control {{ $errors->has('revision') ? 'is-invalid' : '' }}" value="{{ old('revision', $work->revision) }}">
            </div>
        </div>

        <div class="row mt-2">
            <div class="col-md-9 mb-2">
                <label for="inputPassword4">Obra</label>
                <input type="text" id="name" name="name" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" value="{{ old('name', $work->name) }}" placeholder="">
            </div>

            <div class="col-md-3 mb-2">
                <label for="inputPassword4">Foto</label>
                <input type="file" id="image" name="image" class="form-control {{ $errors->has('image') ? 'is-invalid' : '' }}" value="{{ old('name', $work->image) }}">
            </div>
        </div>

        <div class="row mt-2">
            <div class="col-md-2 mb-2">
                <label for="inputZip">CEP</label>
                <input type="text" id="zip_code" name="zip_code" class="form-control cep" value="{{ old('zip_code', $work->zip_code) }}" placeholder="">
            </div>

            <div class="form-group col-md-5 mb-2">
                <label for="inputAddress">Endereço</label>
                <input type="text" id="address" name="address" class="form-control" value="{{ old('address', $work->address) }}" placeholder="">
            </div>

            <div class="col-md-3 mb-2">
                <label for="complement">Bairro</label>
                <input type="text" id="district" name="district" class="form-control" value="{{ old('district', $work->district) }}" placeholder="">
            </div>

            <div class="col-md-2 mb-2">
                <label for="inputAddress2">Número</label>
                <input type="text" id="number" name="number" class="form-control" value="{{ old('number', $work->number) }}" placeholder="">
            </div>
        </div>

        <div class="row mt-2">

            <div class="col-md-4 mb-2">
                <label for="inputCity">Cidade</label>
                <input type="text" id="city" name="city" class="form-control" value="{{ old('city', $work->city) }}" placeholder="">
            </div>

            <div class="col-md-2 mb-2">
                <label for="state">Estado</label>
                <select id="state" name="state" class="form-control">
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
            </div>
        </div>

        <div class="row mt-2">
            <div class="col-md-3 mb-2">
                <label for="segment">Segmento de Atuação</label>
                <select id="segment" name="segment_id" class="form-control">
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
            </div>

            <div class="col-md-3 mb-2">
                <label for="segment_sub_type">Subtipo</label>
                <select id="segment_sub_type" name="segment_sub_type_id" class="form-control">
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
            </div>

            <div class="col-md-3 mb-2">
                <label for="phase">Fase</label>
                <select id="phase" name="phase_id" class="form-control">
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
            </div>

            <div class="col-md-3 mb-2">
                <label for="stage">Estágio</label>
                <select id="stage" name="stage_id" class="form-control">
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
            </div>
        </div>

        <div class="row mt-2">
            <div class="form-group col-md-2 mb-2">
                <label for="started_at">Início da Obra</label>
                <input type="text" id="started_at" name="started_at" class="form-control date {{ $errors->has('started_at') ? 'is-invalid' : '' }}" value="{{ old('started_at', optional($work->started_at)->format('d/m/Y')) }}" placeholder="">
            </div>

            <div class="form-group col-md-2 mb-2">
                <label for="ends_at">Término da Obra</label>
                <input type="text" id="ends_at" name="ends_at" class="form-control date {{ $errors->has('ends_at') ? 'is-invalid' : '' }}" value="{{ old('ends_at', optional($work->ends_at)->format('d/m/Y')) }}" placeholder="">
            </div>

            <div class="form-group col-md-2 mb-2">
                <label for="start_and_end">Início / Término</label>
                <input type="text" id="start_and_end" name="start_and_end" class="form-control {{ $errors->has('start_and_end') ? 'is-invalid' : '' }}" value="{{ old('start_and_end', $work->start_and_end) }}" placeholder="">
            </div>

            <div class="form-group col-md-3 mb-2">
                <label for="inputPassword4">Investimento</label>
                <input type="text" id="price" name="price" class="form-control money {{ $errors->has('price') ? 'is-invalid' : '' }}" value="{{ old('price', $work->price) }}" placeholder="">
            </div>

            <div class="form-group col-md-3 mb-2">
                <label for="inputPassword4">PADRÃO <code>investimento</code></label>
                <select name="investment_standard" class="form-control">
                    <option value="">-- Selecione --</option>
                    <option value="alto">Alto</option>
                    <option value="baixo">Baixo</option>
                    <option value="medio">Médio</option>
                </select>
            </div>

        </div>

        <div class="row mt-2">
            <div class="form-group col-md-3 mb-2">
                <label for="inputPassword4">Área total do Projeto</label>
                <input type="text" id="total_project_area" name="total_project_area" class="form-control {{ $errors->has('total_project_area') ? 'is-invalid' : '' }}" value="{{ old('total_project_area', $work->total_project_area) }}" placeholder="">
            </div>

            <div class="form-group col-md-3 mb-2">
                <label for="inputPassword4">Cub</label>
                <input type="text" id="cub" name="cub" class="form-control {{ $errors->has('cub') ? 'is-invalid' : '' }}" value="{{ old('cub', $work->cub) }}" placeholder="">
            </div>

            <div class="form-group col-md-3 mb-2">
                <label for="inputPassword4">Tipo de Cotação</label>
                <input type="text" id="quotation_type" name="quotation_type" class="form-control {{ $errors->has('quotation_type') ? 'is-invalid' : '' }}" value="{{ old('quotation_type', $work->quotation_type) }}" placeholder="">
            </div>

            <div class="form-group col-md-3 mb-2">
                <label for="inputPassword4">R$</label>
                <input type="text" id="coin" name="coin" class="form-control {{ $errors->has('coin') ? 'is-invalid' : '' }}" value="{{ old('coin', $work->coin) }}" placeholder="">
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
                        <td><input type="text" name="tower" class="form-control {{ $errors->has('tower') ? 'is-invalid' : '' }}" value="{{ old('tower', $work->tower) }}"/></td>
                        <td><input type="text" name="house" class="form-control {{ $errors->has('house') ? 'is-invalid' : '' }}" value="{{ old('house', $work->house) }}" /></td>
                        <td><input type="text" name="condominium" class="form-control {{ $errors->has('condominium') ? 'is-invalid' : '' }}" value="{{ old('condominium', $work->condominium) }}"/></td>
                        <td><input type="text" name="floor" class="form-control {{ $errors->has('floor') ? 'is-invalid' : '' }}" value="{{ old('floor', $work->floor) }}"/></td> 
                        <td><input type="text" name="apartment_per_floor" class="form-control {{ $errors->has('apartment_per_floor') ? 'is-invalid' : '' }}" value="{{ old('apartment_per_floor', $work->apartment_per_floor) }}"/></td>
                    </tr>
                    <tr>
                        <th>Dormitório(s)</th>
                        <th>Suítes(s)</th>
                        <th>Banheiro(s)</th>
                        <th colspan="2">Lavabo(s)</th>
                    </tr>
                    <tr>
                        <td><input type="text" name="bedroom" class="form-control {{ $errors->has('bedroom') ? 'is-invalid' : '' }}" value="{{ old('bedroom', $work->bedroom) }}"/></td>
                        <td><input type="text" name="suite" class="form-control {{ $errors->has('suite') ? 'is-invalid' : '' }}" value="{{ old('suite', $work->suite) }}"/></td>
                        <td><input type="text" name="bathroom" class="form-control {{ $errors->has('bathroom') ? 'is-invalid' : '' }}" value="{{ old('bathroom', $work->bathroom) }}"/></td>
                        <td colspan="2"><input type="text" name="washbasin" class="form-control {{ $errors->has('washbasin') ? 'is-invalid' : '' }}" value="{{ old('washbasin', $work->washbasin) }}"/></td>
                    </tr>
                    <tr>
                        <th>Sala(s) de estar / jantar</th>
                        <th>Copa(s) / Cozinha(s)</th>
                        <th>Área(s) de serviço / Terraço(s) / Varanda(s)</th>
                        <th colspan="2">Dependência de empregada</th>
                    </tr>
                    <tr>
                        <td><select name="living_room" class="form-control">
                                <option value="0">-- Selecione --</option>
                                <option value="0/0">0/0</option>
                                <option value="0/1">0/1</option>
                                <option value="1/0">1/0</option>
                                <option value="1/1">1/1</option>
                            </select>
                        </td>
                        <td><select name="cup_and_kitchen" class="form-control">
                                <option value="0">-- Selecione --</option>
                                <option value="0/0">0/0</option>
                                <option value="0/1">0/1</option>
                                <option value="1/0">1/0</option>
                                <option value="1/1">1/1</option>
                            </select>
                        </td>
                        <td><select name="service_area_terrace_balcony" class="form-control">
                                <option value="0"> -- Selecione --</option>
                                <option value="0/0/0">0/0/0</option>
                                <option value="1/0/1">1/0/1</option>
                                <option value="1/1/1">1/1/1</option>
                                <option value="1/1/0">1/1/0</option>
                                <option value="1/0/0">1/0/0</option>
                            </select>
                        </td>
                        <td colspan="2">
                            <input type="text" name="maid_dependency" class="form-control {{ $errors->has('maid_dependency') ? 'is-invalid' : '' }}" value="{{ old('maid_dependency', $work->maid_dependency) }}"/>
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
                <input type="text" name="other_leisure" class="form-control {{ $errors->has('other_leisure') ? 'is-invalid' : '' }}" value="{{ old('other_leisure', $work->other_leisure) }}" />
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
                        <td><input type="text" name="total_unities" class="form-control {{ $errors->has('total_unities') ? 'is-invalid' : '' }}" value="{{ old('total_unities', $work->total_unities) }}"/></td>
                        <td><input type="text" name="useful_area" class="form-control {{ $errors->has('useful_area') ? 'is-invalid' : '' }}" value="{{ old('useful_area', $work->useful_area) }}"/></td>
                        <td><input type="text" name="total_area" class="form-control {{ $errors->has('total_area') ? 'is-invalid' : '' }}" value="{{ old('total_area', $work->total_area) }}"/></td>
                        <td><input type="text" name="elevator" class="form-control {{ $errors->has('elevator') ? 'is-invalid' : '' }}" value="{{ old('elevator', $work->elevator) }}"/></td>
                        <td><input type="text" name="garage" class="form-control {{ $errors->has('garage') ? 'is-invalid' : '' }}" value="{{ old('garage', $work->garage) }}"/></td>
                        <td><input type="text" name="coverage" class="form-control {{ $errors->has('coverage') ? 'is-invalid' : '' }}" value="{{ old('coverage', $work->coverage) }}"/></td>
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
                        <td><input type="text" name="air_conditioner" class="form-control {{ $errors->has('air_conditioner') ? 'is-invalid' : '' }}" value="{{ old('air_conditioner', $work->air_conditioner) }}"/></td>
                        <td><input type="text" name="heating" class="form-control {{ $errors->has('heating') ? 'is-invalid' : '' }}" value="{{ old('heating', $work->heating) }}"/></td>
                        <td>
                            <select name="foundry" class="form-control">
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
                        </td>
                        <td>
                            <select name="frame" class="form-control">
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
                        </td>
                        <td><input type="text" name="completion" class="form-control {{ $errors->has('completion') ? 'is-invalid' : '' }}" value="{{ old('completion', $work->completion) }}"/></td>
                        <td><input type="text" name="facade" class="form-control {{ $errors->has('facade') ? 'is-invalid' : '' }}" value="{{ old('facade', $work->facade) }}"/></td>
                    </tr>
                </table>
            </div>

        </div>

        <div class="form-row mt-2">
            <div class="form-group col-md-12 mb-2">
                <label for="notes"><strong>DESCRIÇÕES COMPLEMENTARES</strong></label>
                <textarea type="text" id="notes" name="notes" class="form-control {{ $errors->has('notes') ? 'is-invalid' : '' }}" rows="5" placeholder="">{{ old('notes', $work->notes) }}</textarea>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-3">
                <label class="control-label"><strong>STATUS</strong></label>
                <select name="status" class="form-control">
                    <option value="0">-- Selecione --</option>  
                </select>
            </div>
        </div>
        
        <!--Botão-->
        <div class="row mt-2">
            <div class="modal-footer">
                <div class="col-sm-12">
                    <button type="submit" class="btn btn-primary" title="Gravar Dados"> ADD Contato(s)</button>
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