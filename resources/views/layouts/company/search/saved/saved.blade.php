@extends('layouts.app_customer')

@section('content')
    <div class="container-fluid">
        <div class="container">
            <div class="row mt-2">
                <div class="col-md-12 mt-2">
                    <p class="text-center"><strong>PESQUISA DE EMPRESA - SALVA</strong> - <code>FILTRO</code></p>
                </div>
            </div>

            {{-- @include('layouts.alerts.all-errors') --}}
            @foreach($companySaveds as $companySaved)

            <form action="{{ route('company.search.step_two.index') }}" id="formulario" method="get">
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
                        <input type="text" name="last_review_from" class="date form-control datepicker @error('last_review_from') is-invalid @enderror"
                            @if($companySaved->last_review_from) value="{{ date("d/m/Y", strtotime($companySaved->last_review_from)) }}" @endif
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
                        <input type="text" name="last_review_to" class="date form-control datepicker @error('last_review_to') is-invalid @enderror"
                            @if($companySaved->last_review_to) value="{{ date("d/m/Y", strtotime($companySaved->last_review_to)) }}" @endif
                            placeholder="Data Final..."/>

                            @error('last_review_to')
                            <div class="invalid-feedback">
                                <strong>{{ $errors->first('last_review_to') }}</strong>
                            </div>
                            @enderror
                    </div>
                </div>
                
                @if (($statesOne->count() + $statesTwo->count() + $statesThree->count() +
                    $statesFour->count() + $statesFive->count()) > 0)
                    <!--MARCAR TODAS AS REGIÕES-->
                    <div class="row mt-3 mb-3">
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

                <!--NORTE-->
                @if ($statesOne->count() > 0)
                    <div class="row mt-2 bg-light border"> 
                        <div class="col-md-12">
                            @php
                                $savedId = request()->saved_id;
                                $companySaved = \App\Models\CompanySearchSaved::find($savedId);
                                $checkedValues = $companySaved ? (is_array($companySaved->states) ? $companySaved->states : json_decode($companySaved->states, true) ?? []) : [];
                            @endphp

                            <p class="text-uppercase pt-3">
                                <input type="checkbox" name="states[]" value="{{ $statesOne }}" class="norte checkRegiaoGeral" id="zone-all-1" />
                                <strong>Norte <code>* Selecione Todos</code></strong>
                            </p>

                            <hr>
                        </div>

                        @foreach ($statesOne as $checkbox)
                            <div class="col-md-4 pt-3">
                                <p class="text-right text-uppercase">
                                    <input type="checkbox" class="checkNorte checkRegiaoGeral" name="states[]" id="zone-{{ $checkbox->id }}" value="{{ $checkbox->id }}" {{ in_array($checkbox->id, $checkedValues) ? 'checked' : '' }}>
                                    <label for="zone-{{ $checkbox->id }}"><strong>{{ $checkbox->description }}</strong></label>
                                </p>
                            </div>
                        @endforeach
                    </div>
                @endif

                <!--NORDESTE-->
                @if ($statesTwo->count() > 0)
    
                    <div class="row mt-2 bg-light border"> 
                        <div class="col-md-12">
                            @php
                                $savedId = request()->saved_id;
                                $companySaved = \App\Models\CompanySearchSaved::find($savedId);
                                $checkedValues = $companySaved ? (is_array($companySaved->states) ? $companySaved->states : json_decode($companySaved->states, true) ?? []) : [];
                            @endphp

                            <p class="text-uppercase pt-3">
                                <input type="checkbox" name="states[]" value="{{ $statesTwo }}" class="nordeste checkRegiaoGeral" id="zone-all-2" />
                                <strong>Nordeste <code>* Selecione Todos</code></strong>
                            </p>

                            <hr>
                        </div>

                        @foreach ($statesTwo as $checkbox)
                            <div class="col-md-4 pt-3">
                                <p class="text-right text-uppercase">
                                    <input type="checkbox" class="checkNordeste checkRegiaoGeral" name="states[]" id="zone-{{ $checkbox->id }}" value="{{ $checkbox->id }}" {{ in_array($checkbox->id, $checkedValues) ? 'checked' : '' }}>
                                    <label for="zone-{{ $checkbox->id }}"><strong>{{ $checkbox->description }}</strong></label>
                                </p>
                            </div>
                        @endforeach
                    </div>
                @endif

                <!--CENTRO-OESTE-->
                @if ($statesThree->count() > 0)
                    <div class="row mt-2 bg-light border"> 
                        <div class="col-md-12">
                            @php
                                $savedId = request()->saved_id;
                                $companySaved = \App\Models\CompanySearchSaved::find($savedId);
                                $checkedValues = $companySaved ? (is_array($companySaved->states) ? $companySaved->states : json_decode($companySaved->states, true) ?? []) : [];
                            @endphp

                            <p class="text-uppercase pt-3">
                                <input type="checkbox" name="states[]" value="{{ $statesThree }}" class="centro-oeste checkRegiaoGeral" id="zone-all-3" />
                                <strong>Centro-Oeste <code>* Selecione Todos</code></strong>
                            </p>

                            <hr>
                        </div>

                        @foreach ($statesThree as $checkbox)
                            <div class="col-md-4 pt-3">
                                <p class="text-right text-uppercase">
                                    <input type="checkbox" class="checkCentroOeste checkRegiaoGeral" name="states[]" id="zone-{{ $checkbox->id }}" value="{{ $checkbox->id }}" {{ in_array($checkbox->id, $checkedValues) ? 'checked' : '' }}>
                                    <label for="zone-{{ $checkbox->id }}"><strong>{{ $checkbox->description }}</strong></label>
                                </p>
                            </div>
                        @endforeach
                    </div>
                @endif

                <!--SUDESTE-->
                @if ($statesFour->count() > 0)
                    <div class="row mt-2 bg-light border"> 
                        <div class="col-md-12">
                            @php
                                $savedId = request()->saved_id;
                                $companySaved = \App\Models\CompanySearchSaved::find($savedId);
                                $checkedValues = $companySaved ? (is_array($companySaved->states) ? $companySaved->states : json_decode($companySaved->states, true) ?? []) : [];
                            @endphp

                            <p class="text-uppercase pt-3">
                                <input type="checkbox" name="states[]" value="{{ $statesFour }}" class="sudeste checkRegiaoGeral" id="zone-all-4" />
                                <strong>Sudeste <code>* Selecione Todos</code></strong>
                            </p>

                            <hr>
                        </div>

                        @foreach ($statesFour as $checkbox)
                            <div class="col-md-4 pt-3">
                                <p class="text-right text-uppercase">
                                    <input type="checkbox" class="checkSudeste checkRegiaoGeral" name="states[]" id="zone-{{ $checkbox->id }}" value="{{ $checkbox->id }}" {{ in_array($checkbox->id, $checkedValues) ? 'checked' : '' }}>
                                    <label for="zone-{{ $checkbox->id }}"><strong>{{ $checkbox->description }}</strong></label>
                                </p>
                            </div>
                        @endforeach
                    </div>
                @endif

                <!--SUL-->
                @if ($statesFive->count() > 0)
                    <div class="row mt-2 bg-light border"> 
                        <div class="col-md-12">
                            @php
                                $savedId = request()->saved_id;
                                $companySaved = \App\Models\CompanySearchSaved::find($savedId);
                                $checkedValues = $companySaved ? (is_array($companySaved->states) ? $companySaved->states : json_decode($companySaved->states, true) ?? []) : [];
                            @endphp

                            <p class="text-uppercase pt-3">
                                <input type="checkbox" name="states[]" value="{{ $statesFive }}" class="sul checkRegiaoGeral" id="zone-all-5" />
                                <strong>Sul <code>* Selecione Todos</code></strong>
                            </p>

                            <hr>
                        </div>

                        @foreach ($statesFive as $checkbox)
                            <div class="col-md-4 pt-3">
                                <p class="text-right text-uppercase">
                                    <input type="checkbox" class="checkSul checkRegiaoGeral" name="states[]" id="zone-{{ $checkbox->id }}" value="{{ $checkbox->id }}" {{ in_array($checkbox->id, $checkedValues) ? 'checked' : '' }}>
                                    <label for="zone-{{ $checkbox->id }}"><strong>{{ $checkbox->description }}</strong></label>
                                </p>
                            </div>
                        @endforeach
                    </div>
                @endif
                
                <div class="row mt-4">
                    <div class="col-md-12">
                        <label class="control-label text-uppercase">
                            <i class="fa fa-check-square-o"></i>
                            <strong>Segmentos de Atuação</strong>
                        </label>
                    </div>
                </div>

                <div class="row mt-2 bg-light border">
                    @foreach($activityFields as $activityField)
                        @if($activityField->id !== 24)
                            @php
                                $savedId = request()->saved_id;
                                $companySaved = \App\Models\CompanySearchSaved::find($savedId);
                                $checkedValues = $companySaved ? (is_array($companySaved->activity_fields) ? $companySaved->activity_fields : json_decode($companySaved->activity_fields, true) ?? []) : [];
                            @endphp
                            <div class="col-md-4 pt-3">
                                <p class="text-right">
                                    <input type="checkbox" id="activity-field-{{ $activityField->id }}"
                                        name="activity_fields[]"
                                        class="activity_fields"
                                        value="{{ $activityField->id }}" {{ in_array($activityField->id, $checkedValues) ? 'checked' : '' }}
                                    >
                                    <label for="activity-field-{{ $activityField->id }}">
                                        <strong>{{ $activityField->description }}</strong>
                                    </label>
                                </p>
                            </div>
                        @endif
                    @endforeach
                </div>
                
                <div class="row mt-4 pb-4 bg-light border">
                    <div class="col-md-12 pt-3">
                        <p class="text-left"> <i class="fa fa-check"></i><strong>FILTRO ESPECÍFICO</strong></p>
                        <hr>
                    </div>

                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-md-12">
                                <x-intec-input
                                    label-input-id="autocomplete-input"
                                    label-text="Nome Fantasia"
                                    input-type="text"
                                    input-name="search"
                                    class-one=""
                                    label-class=""
                                    input-value="{{ $companySaved->search }}"
                                    :input-readonly="false"
                                    placeholder="Digite a Fantasia da Empresa"
                                />
                                <ul id="autocomplete-list" class="autocomplete-list"></ul>
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
                                    input-value="{{ $companySaved->address }}"
                                    :input-readonly="false"
                                />
                            </div>
                        </div>

                        <div class="row mt-2">
                            <div class="col-md-3">
                                <x-intec-select
                                    select-name="state_id"
                                    select-label="Estado"
                                    select-class="form-select"
                                    required=""
                                    placeholder="-- Selecione --"
                                    :collection="$states"
                                    value="{{ $companySaved->state_id }}"
                                />
                            </div>

                            <div class="col-md-9">
                                <label for="city_id" class="control-label">
                                    Cidade
                                </label>

                                <select id="city_id" name="city_id" class="form-select cidade">
                                    <option value="0">-- Selecione primeiro o Estado --</option>
                                </select>
                            </div>
                        </div>

                        <div class="row mt-2">
                            <div class="col-md-12">
                                <x-intec-input
                                    label-input-id="home_page"
                                    label-text="Site"
                                    input-type="text"
                                    input-name="home_page"
                                    class-one=""
                                    label-class=""
                                    input-value="{{ $companySaved->home_page }}"
                                    :input-readonly="false"
                                />
                            </div>
                        </div>
                        
                        @can('ver-filtro-pesquisador-obras')
                            <div class="row mt-2">
                                <div class="col-md-12">
                                    <label class="control-label"> Pesquisador</label>
                                    <select name="researcher_id" class="form-select form-group">
                                    <option value="{{ $companySaved->researcher_id }}">
                                        @if ($companySaved->researcher_id)
                                            {{ \App\Models\Researcher::find($companySaved->researcher_id)->name }}
                                        @else
                                            -- Selecione --
                                        @endif
                                    </option>

                                    @foreach($researchers as $researcher)
                                        <option value="{{ $researcher->id }}">{{ $researcher->name }}</option>
                                    @endforeach
                                </select>

                                </div>
                            </div>
                        @endcan
                        
                    </div>

                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-md-12">
                                <x-intec-input
                                    label-input-id="autocomplete-input-rz"
                                    label-text="Razão Social"
                                    input-type="text"
                                    input-name="searchCompany"
                                    class-one=""
                                    label-class=""
                                    input-value="{{ $companySaved->searchCompany }}"
                                    :input-readonly="false"
                                    placeholder="Digite a Razão Social da Empresa"
                                />
                                <ul id="autocomplete-list-rz" class="autocomplete-list"></ul>
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
                                    input-value="{{ $companySaved->district }}"
                                    :input-readonly="false"
                                />
                            </div>
                        </div>

                        <!-- Cidades selecionadas -->
                        <div class="row mt-2">
                            <div class="col-md-12">
                                <label class="control-label">Cidades Selecionadas - <a class="clear" onclick="limparSelecionadas()">Limpar selecionada(s)</a> *</label>
                                @php
                                    $citiesIdsArray = json_decode($companySaved->cities_ids, true);
                                    $citiesNames = [];

                                    if (!empty($citiesIdsArray)) {
                                        foreach ($citiesIdsArray as $cityId) {
                                            $cityId = trim($cityId);

                                            if (!empty($cityId)) {
                                                // Obtém a cidade diretamente pelo ID
                                                $city = \App\Models\City::find($cityId);

                                                if ($city) {
                                                    $citiesNames[] = $city->description; // Use o campo correto da cidade
                                                } else {
                                                    // Adicione um log para depuração
                                                    \Log::info("City not found for ID: $cityId");
                                                }
                                            }
                                        }
                                    } else {
                                        // Adicione um log para depuração
                                        \Log::info("No city IDs found in the array");
                                    }

                                    // Converte a array de nomes em uma string separada por vírgulas
                                    $formattedCitiesNames = implode(', ', $citiesNames);
                                @endphp

                                <input type="text" name="selected_cities" class="form-control" id="selectedCitiesInput" 
                                       value="{{ $formattedCitiesNames }}" style="color: blue;" 
                                       placeholder="Selecione por Estado, mais será consultado até 4 Cidade(s) ..." readonly>
                                <input type="hidden" name="cities_ids" id="citiesIdsInput" value="{{ implode(',', json_decode($companySaved->cities_ids, true)) }}">
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
                            <div class="col-md-4">
                                <x-intec-input
                                    label-input-id="cnpj"
                                    label-text="CNPJ"
                                    input-type="text"
                                    input-name="cnpj"
                                    class-one="cnpj"
                                    label-class=""
                                    input-value="{{ $companySaved->cnpj }}"
                                    :input-readonly="false"
                                />
                            </div>
                            <div class="col-md-8">
                                <x-intec-input
                                    label-input-id="primary_email"
                                    label-text="E-mail Principal"
                                    input-type="email"
                                    input-name="primary_email"
                                    class-one=""
                                    label-class=""
                                    input-value="{{ $companySaved->primary_email }}"
                                    :input-readonly="false"
                                />
                            </div>
                        </div>
                    </div>
                </div>
                
                 <div class="row mt-4 pb-4">

                    <!--BOTÕES-->
                    <div class="col-md-3">
                        <label class="control-label"> <strong>Ação</strong></label>
                        <br>
                        
                        <button type="submit" class="btn btn-success submit" title="Pesquisar" id="pesquisar">
                            <i class="fa fa-search"></i> Pesquisar
                        </button>
                    </div>
                </div>

             </form>
           
        </div>
    </div>
@endforeach
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
        
// Função para atualizar os checkboxes das regiões
function updateRegiaoCheckboxes(regiaoCheckboxes, isChecked) {
    regiaoCheckboxes.forEach(checkbox => {
        checkbox.checked = isChecked;
    });
}

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


