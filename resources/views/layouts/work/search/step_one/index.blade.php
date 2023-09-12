@extends('layouts.app_customer')

@section('content')
    <div class="container-fluid">
        <div class="container">
            <div class="row mt-2">
                <div class="col-md-12 mt-2">
                    <p class="text-center"><strong>PESQUISA DE OBRAS</strong> - <code>FILTRO</code></p>
                </div>
            </div>

            {{-- @include('layouts.alerts.all-errors') --}}

            <form action="{{ route('work.search.step_two.index') }}" id="formulario" method="get">
                @csrf
                @method('GET')

                <!--PERIODOS-->
                <div class="row mt-2 bg-light border">
                    <div class="col-md-12 pt-3">
                        <p class="text-uppercase">
                            <i class="fa fa-search"></i> <strong>Busca por Período</strong> <code>* entre Datas</code>
                        </p>
                        <hr>
                    </div>

                    <div class="col-md-6 pb-5">
                        <label for="last_review_from" class="control-label">
                            <strong>Data Inicial</strong>
                        </label>
                        <input
                            type="text"
                            name="last_review_from"
                            class="date form-control datepicker @error('last_review_from') is-invalid @enderror"
                            value="{{ old('last_review_from') }}"
                            placeholder="Data Inicial..."/>
                            @error('last_review_from')
                            <div class="invalid-feedback">
                                <strong>{{ $errors->first('last_review_from') }}</strong>
                            </div>
                            @enderror
                    </div>
                    <div class="col-md-6 pb-5">
                        <label for="last_review_to" class="control-label">
                            <strong>Data Final</strong>
                        </label>
                        <input
                            type="text"
                            name="last_review_to"
                            class="date form-control datepicker @error('last_review_to') is-invalid @enderror"
                            value="{{ old('last_review_to') }}"
                            placeholder="Data Final..."/>
                            @error('last_review_to')
                            <div class="invalid-feedback">
                                <strong>{{ $errors->first('last_review_to') }}</strong>
                            </div>
                            @enderror
                    </div>
                </div>

                <!--FASES-->
               <div class="row mt-4">
                    <div class="col-md-12">
                        <label class="control-label text-uppercase">
                            <i class="fa fa-check-square-o"></i> <strong>Selecione as Fases</strong>
                        </label>
                    </div>
                </div>

                <!--FASE 1-->
                <div class="row mt-2 bg-light border">
                    <div class="col-md-12 pt-3">
                        <p class="text-uppercase">
                            <input
                                type="checkbox"
                                name="phases[0]"
                                id="stage-all-1" 
                                class="phase1"
                                value="1"
                                >
                            <label for="stage-all-1"><b>Fase 1</b> <code>* Selecione Todos</code></label>
                        </p>
                        <hr>
                    </div>

                    @foreach($stagesOne as $stageOne)
                        <div class="col-md-4">
                            <p class="text-right">
                                <input
                                    type="checkbox"
                                    id="stage-{{ $stageOne ->id }}"
                                    name="stages[]"
                                    class="F1"
                                    value="{{ $stageOne->id }}"
                                    />
                                <label for="stage-{{ $stageOne->id }}">
                                    <strong>{{ $stageOne->description }}</strong>
                                </label>
                            </p>
                        </div>
                    @endforeach
                </div>
                
                <!--FASE 2-->
                <div class="row mt-3 bg-light border">
                    <div class="col-md-12 pt-3">
                        <p class="text-uppercase">
                            <input
                                type="checkbox"
                                name="phases[0]"
                                id="stage-all-2"
                                class="phase2"
                                value="2"
                                >
                            <label for="stage-all-2"><b>Fase 2</b> <code>* Selecione Todos</code></label>
                        </p>
                        <hr>
                    </div>

                    @foreach($stagesTwo as $stageTwo)
                        <div class="col-md-4">
                            <p class="text-right">
                                <input
                                    type="checkbox"
                                    id="stage-two-{{ $stageTwo ->id }}"
                                    name="stages[]"
                                    class="F2"
                                    value="{{ $stageTwo->id }}"
                                    />
                                <label for="stage-two-{{ $stageTwo->id }}">
                                    <strong>{{ $stageTwo->description }}</strong>
                                </label>
                            </p>
                        </div>
                    @endforeach
                </div>
                
                <!--FASE 3-->
                <div class="row mt-3 bg-light border mb-5">
                    <div class="col-md-12 pt-3">
                        <p class="text-uppercase">
                            <input
                                type="checkbox"
                                name="phases[0]"
                                id="stage-all-3"
                                class="phase3"
                                value="3"
                                >
                            <label for="stage-all-3"><b>Fase 3</b> <code>* Selecione Todos</code></label>
                        </p>
                        <hr>
                    </div>

                    @foreach($stagesThree as $stageThree)
                        <div class="col-md-4">
                            <p class="text-right">
                                <input
                                    type="checkbox"
                                    id="stage-three-{{ $stageThree ->id }}"
                                    name="stages[]"
                                    class="F3"
                                    value="{{ $stageThree->id }}"
                                    />
                                <label for="stage-three-{{ $stageThree->id }}">
                                    <strong>{{ $stageThree->description }}</strong>
                                </label>
                            </p>
                        </div>
                    @endforeach
                </div>
                
                @if (($segmentSubTypeOne->count() + $segmentSubTypeTwo->count() +
                    $segmentSubTypeThree->count()) > 0)
                    <!--SEGMENTO E ATUAÇÕES-->
                    <div class="row mt-4">
                        <div class="col-md-12">
                            <label class="control-label text-uppercase">
                                <strong>
                                    <i class="fa fa-check-square-o"></i>
                                    Segmentos de Atuação
                                </strong>
                            </label>
                        </div>
                    </div>
                
                    @if (($segmentSubTypeOne->count() > 0))
                        <!--INDUSTRIAL-->
                        <x-state-checkbox-group
                            id="segment-sub-type-all-1"
                            input-one-name="segment-sub-types[0]"
                            class-one="industrial"
                            label-text="Industrial"
                            :data-list="$segmentSubTypeOne"
                            class-two="Ind"
                            list-input-id-for="segment-sub-type-one-"
                            list-input-name="segment_sub_types[]"
                            collection-relation=""
                        />
                    @endif
                
                    @if (($segmentSubTypeTwo->count() > 0))
                        <!--COMERCIAL-->
                        <x-state-checkbox-group
                            id="segment-sub-type-all-2"
                            input-one-name="segment-sub-types[0]"
                            class-one="comercial"
                            label-text="Comercial"
                            :data-list="$segmentSubTypeTwo"
                            class-two="Com"
                            list-input-id-for="segment-sub-type-two-"
                            list-input-name="segment_sub_types[]"
                            collection-relation=""
                        />
                    @endif
                
                    @if (($segmentSubTypeThree->count() > 0))
                        <!--RESIDENCIAL-->
                        <x-state-checkbox-group
                            id="segment-sub-type-all-3"
                            input-one-name="segment-sub-types[0]"
                            class-one="residential"
                            label-text="Residencial"
                            :data-list="$segmentSubTypeThree"
                            class-two="Res"
                            list-input-id-for="segment-sub-type-three-"
                            list-input-name="segment_sub_types[]"
                            collection-relation=""
                        />
                    @endif
                @endif

                @if (($statesOne->count() + $statesTwo->count() + $statesThree->count() +
                    $statesFour->count() + $statesFive->count()) > 0)
                    <!--MARCAR TODAS AS REGIÕES-->
                    <div class="row mt-5 mb-3">
                        <div class="col-md-12">
                            <label class="control-label text-uppercase">
                                <strong>
                                    <i class="fa fa-check-square-o"></i>
                                    Regiões do Brasil
                                </strong>
                                <input type="checkbox" class="regiaoGeral" />
                                <code>* Selecione Todas as Regiões</code>
                            </label>
                        </div>
                    </div>
                @endif

                @if ($statesOne->count() > 0)
                    <!--NORTE-->
                    <x-state-checkbox-group
                        id="zone-all-1"
                        input-one-name="zones[0]"
                        class-one="norte checkRegiaoGeral"
                        label-text="Norte"
                        :data-list="$statesOne"
                        class-two="checkNorte checkRegiaoGeral"
                        list-input-id-for="state-one-"
                        list-input-name="states[]"
                        collection-relation=""
                    />
                @endif

                @if ($statesTwo->count() > 0)
                    <!--NORDESTE-->
                    <x-state-checkbox-group
                        id="zone-all-2"
                        input-one-name="zones[0]"
                        class-one="nordeste checkRegiaoGeral"
                        label-text="Nordeste"
                        :data-list="$statesTwo"
                        class-two="checkNordeste checkRegiaoGeral"
                        list-input-id-for="state-two-"
                        list-input-name="states[]"
                        collection-relation=""
                    />
                @endif

                @if ($statesThree->count() > 0)
                    <!--CENTRO-OESTE-->
                    <x-state-checkbox-group
                        id="zone-all-3"
                        input-one-name="zones[0]"
                        class-one="centro-oeste checkRegiaoGeral"
                        label-text="Centro-Oeste"
                        :data-list="$statesThree"
                        class-two="checkCentroOeste checkRegiaoGeral"
                        list-input-id-for="state-three-"
                        list-input-name="states[]"
                        collection-relation=""
                    />
                @endif

                @if ($statesFour->count() > 0)
                    <!--SUDESTE-->
                    <x-state-checkbox-group
                        id="zone-all-4"
                        input-one-name="zones[0]"
                        class-one="sudeste checkRegiaoGeral"
                        label-text="Sudeste"
                        :data-list="$statesFour"
                        class-two="checkSudeste checkRegiaoGeral"
                        list-input-id-for="state-four-"
                        list-input-name="states[]"
                        collection-relation=""
                    />
                @endif

                @if ($statesFive->count() > 0)
                    <!--SUL-->
                    <x-state-checkbox-group
                        id="zone-all-5"
                        input-one-name="zones[0]"
                        class-one="sul checkRegiaoGeral"
                        label-text="Sul"
                        :data-list="$statesFive"
                        class-two="checkSul checkRegiaoGeral"
                        list-input-id-for="state-five-"
                        list-input-name="states[]"
                        collection-relation=""
                    />
                @endif

                <!--FILTRO ESPECIFICO-->
                <div class="row mt-4 pb-4 bg-light border">
                    <div class="col-md-12 pt-3">
                        <p class="text-left"> <i class="fa fa-check"></i><strong>FILTRO ESPECÍFICO</strong></p>
                        <hr>
                    </div>

                    <!-- Inicio Lado esquerdo -->
                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-md-3">
                                <label class="control-label"> Padrão</label>
                                <select name="investment_standard" class="form-select">
                                    <option value="0">-- Selecione --</option>
                                    <option value="Alto">Alto</option>
                                    <option value="Médio">Médio</option>
                                    <option value="Baixo">Baixo</option>
                                </select>
                            </div>
                            <div class="col-md-9">
                                <x-intec-input
                                    label-input-id="name"
                                    label-text="Nome da Obra"
                                    input-type="text"
                                    input-name="name"
                                    class-one=""
                                    label-class=""
                                    input-value="{{ old('name') }}"
                                    :input-readonly="false"
                                />
                            </div>
                        </div>

                        <div class="row mt-2">
                            <div class="col-md-12">
                                <x-intec-input
                                    label-input-id="address"
                                    label-text="Endereço"
                                    input-type="text"
                                    input-name="address"
                                    class-one=""
                                    label-class=""
                                    input-value="{{ old('address') }}"
                                    :input-readonly="false"
                                />
                            </div>
                        </div>

                        <!--Estado-->
                        <div class="row mt-2">
                            <div class="col-md-3">
                                <x-intec-select
                                    select-name="state_id"
                                    select-label="Estado"
                                    select-class="form-select"
                                    required=""
                                    placeholder="-- Selecione --"
                                    :collection="$states"
                                    value=""
                                />
                            </div>
                            
                            <!--Cidades-->
                            <div class="col-md-9">
                                <label for="city_id" class="control-label">
                                    Cidade
                                </label>

                                <select id="city_id" name="city_id" class="form-select cidade">
                                    <option value="0"> -- Selecione primeiro o Estado --</option>
                                </select>
                            </div>
                        </div>

                        <div class="row mt-2">
                            <label class="control-label">Área Construída(m²)</label>
                            <div class="col-md-6">
                                <select name="qa" class="form-select">
                                    <option value="0">-- Selecione --</option>
                                    <option value=">">Maior que</option>
                                    <option value="<">Menor que</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <input type="text" name="total_area" class="form-control" value=""/>
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-md-12">
                                <x-intec-input
                                    label-input-id="autocomplete-input"
                                    label-text="Empresa participante"
                                    input-type="text"
                                    input-name="search"
                                    class-one=""
                                    label-class=""
                                    placeholder="Digite a Fantasia da Empresa"
                                    input-value="{{ old('search') }}"
                                    :input-readonly="false"
                                />
                                <ul id="autocomplete-list" class="autocomplete-list"></ul>
                                
                            </div>
                        </div>
                        
                        @can('ver-filtro-pesquisador-obras')
                            <div class="row mt-2">
                                <div class="col-md-12">
                                    <label class="control-label"> Pesquisador</label>
                                    <select name="researcher_id" class="form-select form-group">
                                        <option value="0">-- Selecione --</option>
                                        @foreach($researchers as $researcher)
                                            <option value="{{ $researcher->id }}">{{ $researcher->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        @endcan
                        
                        {{--<div class="row mt-2">
                            <div class="col-md-12">
                                <label class="control-label"> Descrição</label>
                                <input type="text" name="notes" class="form-control" id="notes" value="" />
                            </div>
                        </div>
                        --}}
                        
                        
                        {{--
                            <div class="col-md-6">
                                <label class="control-label"> Status atual do SIG</label>
                                <select name="sig_id" class="form-select">
                                    <option value="0">-- Selecione --</option>

                                </select>
                            </div>
                        
                        --}}

                    </div><!--fim lado direito-->

                    <!-- Inicio Lado direito -->
                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-md-12">
                                <label class="control-label"> Código da Obra <code>*para selecionar mais de uma Obra, separe por virgula</code></label>
                                <input type="text" name="old_code" class="form-control" value="" placeholder="Mais de uma obra, ex: RE00145,CO04785" />
                            </div>
                        </div>

                        <div class="row mt-2">
                            <div class="col-md-12">
                                <x-intec-input
                                    label-input-id="district"
                                    label-text="Bairro"
                                    input-type="text"
                                    input-name="district"
                                    class-one=""
                                    label-class=""
                                    input-value="{{ old('district') }}"
                                    :input-readonly="false"
                                />
                            </div>
                        </div>
                       
                        <!-- Cidades selecionadas -->
                        <div class="row mt-2">
                            <div class="col-md-12">
                                <label class="control-label">Cidades Selecionadas - <a class="clear" onclick="limparSelecionadas()">Limpar selecionada(s)</a> *</label>
                                <input type="text" name="selected_cities" class="form-control" id="selectedCitiesInput" style="color: blue;" placeholder="Selecione por Estado, mais será consultado até 4 Cidade(s) ..." readonly>
                                <input type="hidden" name="cities_ids" id="citiesIdsInput" value="">
                            </div>
                        </div>

                        <script>
                            let selectCidade = document.getElementById("city_id");
                            let selectEstado = document.getElementById("state_id");
                            let inputSelectedCities = document.getElementById("selectedCitiesInput");
                            let inputCitiesIds = document.getElementById("citiesIdsInput");

                            selectCidade.addEventListener("change", function () {
                                if (inputSelectedCities.value.split(",").length <= 3) {
                                    if (selectCidade.selectedIndex > 0) {
                                        let cidadeSelecionada = selectCidade.options[selectCidade.selectedIndex].text;
                                        let cidadeId = selectCidade.options[selectCidade.selectedIndex].value;
                                        let inputText = inputSelectedCities.value;
                                        let inputIds = inputCitiesIds.value;

                                        if (inputText.length > 0) {
                                            inputText += ", ";
                                            inputIds += ",";
                                        }

                                        inputText += cidadeSelecionada;
                                        inputIds += cidadeId;

                                        inputSelectedCities.value = inputText;
                                        inputCitiesIds.value = inputIds;

                                        selectCidade.selectedIndex = 0;
                                    }
                                } else {
                                    alert("Limite de 4 cidades selecionadas atingido.");
                                }
                            });

                            // Adiciona um evento de escuta para o elemento de seleção de estado
                            selectEstado.addEventListener("change", function () {
                                // Limpa os campos quando o estado é alterado
                                inputSelectedCities.value = "";
                                inputCitiesIds.value = "";
                            });

                            // Função para limpar as cidades selecionadas
                            function limparSelecionadas() {
                                inputSelectedCities.value = "";
                                inputCitiesIds.value = "";
                                selectCidade.selectedIndex = 0;
                            }
                        </script>


                        <div class="row mt-2">
                            <div class="col-md-6">
                                <label class="control-label"> Valor do Investimento </label>

                                <select name="qi" class="form-select">
                                    <option value="0">-- Selecione --</option>
                                    <option value=">=">Maior que</option>
                                    <option value="<=">Menor que</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="control-label"> R$</label>
                                <input type="text" name="price" class="form-control money" value=""/>
                            </div>
                        </div>
                        
                        <div class="row mt-2">
                            <div class="col-md-6">
                                <label class="control-label"> Modalidade</label>
                                <select name="modality_id" class="form-select">
                                    <option value="">-- Selecione --</option>
                                    @foreach($activityFields as $activityField)
                                        <option value="{{ $activityField->id }}">{{ $activityField->description}}</option>
                                    @endforeach
                                </select> 
                            </div>
                           
                            <div class="col-md-6">
                                <label class="control-label"> Pavimentos</label>
                                <input type="text" name="floor" class="form-control" value=""/>
                            </div>

                        </div> 
                     

                        <div class="row mt-2">
                            <label class="control-label"> Número de Revisão</label>
                            <div class="col-md-6">
                                <select name="qr" class="form-select">
                                    <option value="0">-- Selecione --</option>
                                    <option value=">">Maior que</option>
                                    <option value="<">Menor que</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <input type="text" name="revision" class="form-control" value=""/>
                            </div>
                        </div>
                        
                        
                        {{--
                        <div class="row mt-2">
                            <div class="col-md-6">
                                <label class="control-label"> Início das Obras *</label>
                                <input type="text" name="initial_start" class="form-control datepicker" value="" placeholder="Data incial do mês desejado para Inicio"/>
                                <input type="text" name="start_end" class="form-control datepicker" value="" placeholder="Data final do mês desejado para Inicio"/> 
                            </div>
                            <div class="col-md-6">
                                <label class="control-label"> Término das Obras *</label>
                                <input type="text" name="initial_term" class="form-control datepicker" value="" placeholder="Data incial do mês desejado para Término"/>
                                <input type="text" name="end_final" class="form-control datepicker" value="" placeholder="Data final do mês desejado para Término"/> 
                            </div>
                        </div>
                        --}}
                    </div><!--fim lado direito-->
                </div> 

                <div class="row mt-4 pb-4">

                    <!--PESQUISAS SALVAS-->
                    {{-- <div class="col-md-3">
                        <label class="control-label"> <i class="fa fa-search"></i> <strong>Pesquisa(s) Salva(s)</strong></label>
                        <select name="" id="selecao" class="form-select">
                            <option value="0">-- Selecione --</option>
                        </select>
                    </div> --}}

                    <!--PESQUISAS DELETAR-->
                    {{-- <div class="col-md-3">
                        <label class="control-label text-danger"> <strong>Deletar Pesquisa(s)</strong></label>
                        <select name="" id="delete" class="form-select">
                            <option value="0">Selecione - Delete automatico</option>
                        </select>
                    </div> --}}

                    <!--ORDENAÇÃO-->
                    {{-- <div class="col-md-3">
                        <label class="control-label"> <strong>Ordenar por</strong></label>
                        <select name="order" class="form-select">
                            <option value="name">Nome da obra</option>
                            <option value="old_code">Codigo da Obra</option>
                            <option value="adress">Endereço</option>
                            <option value="trading_name">Nome Fantasia da Empresa</option>
                            <option value="city">Cidade</option>
                        </select>
                    </div> --}}

                    <!--BOTÕES-->
                    <div class="col-md-3">
                        <label class="control-label"> <strong>Ação</strong></label>
                        <br>
                        {{--
                        <button
                            type="submit"
                            class="btn btn-primary create"
                            title="Salvar Pesquisa"
                            value="1"
                            onclick="Acao('');"
                            >
                            <i class="fa fa-search"></i> Salvar Pesquisa
                        </button>
                        --}}
                        <button type="submit" class="btn btn-success submit" title="Pesquisar">
                            <i class="fa fa-search"></i> Pesquisar
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('scripts')

    <script>
        $(document).ready(function () {
            $('#state_id').on('change', function () {
                let stateId = $(this).val();

                $.ajax({
                    url: base_url() + 'v1/state-cities',
                    method: 'POST',
                    data: {
                        state_acronym: stateId
                    },
                    success: function (return_data) {
                        let options = `<option value="" style="background:#fff;color:#454c54;">
                            Cidades não encontradas.
                            </option>`;

                        if (return_data.cities.length <= 0) {
                            $('select[name="city_id"]').html(options);
                        } else {
                            options = `<option value="" style="background:#fff;color:#454c54;">
                                -- Selecione --
                                </option>`;
                            
                            for (var i = 0; i < return_data.cities.length; i++) {
                                if (return_data.cities[i] !== "") {
                                    options += `<option value="${return_data.cities[i].id}"
                                        style="background:#fff;color:#454c54;">
                                        ${return_data.cities[i].description}</option>`;
                                }
                            }
                            $('select[name="city_id"]').html(options);
                        }
                    }
                })
            })
        })

        /*PHASE 1*/
        const phase1Checkbox = document.querySelector('.phase1');
        const checkboxesF1 = document.querySelectorAll('.F1');
        phase1Checkbox.addEventListener('click', function() {
            const isChecked = phase1Checkbox.checked;
            checkboxesF1.forEach(checkbox => {
                checkbox.checked = isChecked;
            });
        });

        /*PHASE 2*/
        const phase2Checkbox = document.querySelector('.phase2');
        const checkboxesF2 = document.querySelectorAll('.F2');
        phase2Checkbox.addEventListener('click', function() {
            const isChecked = phase2Checkbox.checked;
            checkboxesF2.forEach(checkbox => {
                checkbox.checked = isChecked;
            });
        });

        /*PHASE 3*/
        const phase3Checkbox = document.querySelector('.phase3');
        const checkboxesF3 = document.querySelectorAll('.F3');
        phase3Checkbox.addEventListener('click', function() {
            const isChecked = phase3Checkbox.checked;
            checkboxesF3.forEach(checkbox => {
                checkbox.checked = isChecked;
            });
        });

        @if (($segmentSubTypeOne->count() > 0))
        /*INDUSTRIAL*/
        const industrialCheckbox = document.querySelector('.industrial');
        const checkboxesInd = document.querySelectorAll('.Ind');
        industrialCheckbox.addEventListener('click', function() {
            const isChecked = industrialCheckbox.checked;
            checkboxesInd.forEach(checkbox => {
                checkbox.checked = isChecked;
            });
        });
        @endif
        
        @if (($segmentSubTypeTwo->count() > 0))
        /*COMERCIAL*/
        const commercialCheckbox = document.querySelector(".comercial");
        const comCheckboxes = document.querySelectorAll(".Com");
        commercialCheckbox.addEventListener("click", function () {
            const isChecked = commercialCheckbox.checked;
            comCheckboxes.forEach((checkbox) => {
                checkbox.checked = isChecked;
            });
        });
        @endif
        
        @if (($segmentSubTypeThree->count() > 0))
        /*RESIDENCIAL*/
        const residentialCheckbox = document.querySelector('.residential');
        const checkboxesRes = document.querySelectorAll('.Res');
        residentialCheckbox.addEventListener('click', function() {
            const isChecked = residentialCheckbox.checked;
            checkboxesRes.forEach(checkbox => {
                checkbox.checked = isChecked;
            });
        });
        @endif

        @if (($statesOne->count() + $statesTwo->count() + $statesThree->count() +
            $statesFour->count() + $statesFive->count()) > 0)
        /*REGIÃO GERAL*/
        const geralCheckbox = document.querySelector('.regiaoGeral');
        const checkboxesGeral = document.querySelectorAll('.checkRegiaoGeral');
        geralCheckbox.addEventListener('click', function() {
            const isChecked = geralCheckbox.checked;
            checkboxesGeral.forEach(checkbox => {
                checkbox.checked = isChecked;
            });
        });
        @endif

        @if ($statesOne->count() > 0)
        /*REGIÃO NORTE*/
        const norteCheckbox = document.querySelector('.norte');
        const checkboxesNor = document.querySelectorAll('.checkNorte');
        norteCheckbox.addEventListener('click', function() {
            console.log('asdfasdfasdfa !!!!!')
            const isChecked = norteCheckbox.checked;
            checkboxesNor.forEach(checkbox => {
                checkbox.checked = isChecked;
            });
        });
        @endif

        @if ($statesTwo->count() > 0)
        /*REGIÃO NORDESTE*/
        const nordesteCheckbox = document.querySelector('.nordeste');
        const checkboxesNordeste = document.querySelectorAll('.checkNordeste');
        nordesteCheckbox.addEventListener('click', function() {
            const isChecked = nordesteCheckbox.checked;
            checkboxesNordeste.forEach(checkbox => {
                checkbox.checked = isChecked;
            });
        });
        @endif

        @if ($statesThree->count() > 0)
        /*REGIÃO CENTRO-OESTE*/
        const centroCheckbox = document.querySelector('.centro-oeste');
        const checkboxesCen = document.querySelectorAll('.checkCentroOeste');
        centroCheckbox.addEventListener('click', function() {
            const isChecked = centroCheckbox.checked;
            checkboxesCen.forEach(checkbox => {
                checkbox.checked = isChecked;
            });
        });
        @endif

        @if ($statesFour->count() > 0)
        /*REGIÃO SULDESTE*/
        const sudesteCheckbox = document.querySelector('.sudeste');
        const checkboxesSudeste = document.querySelectorAll('.checkSudeste');
        sudesteCheckbox.addEventListener('click', function() {
            const isChecked = sudesteCheckbox.checked;
            checkboxesSudeste.forEach(checkbox => {
                checkbox.checked = isChecked;
            });
        });
        @endif

        @if ($statesFive->count() > 0)
        /*REGIÃO SUL*/
        const sulCheckbox = document.querySelector('.sul');
        const checkboxesSul = document.querySelectorAll('.checkSul');
        sulCheckbox.addEventListener('click', function() {
            const isChecked = sulCheckbox.checked;
            checkboxesSul.forEach(checkbox => {
                checkbox.checked = isChecked;
            });
        });
        @endif
    </script>

@endpush

