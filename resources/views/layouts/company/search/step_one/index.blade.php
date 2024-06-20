@extends('layouts.app_customer')

@section('content')

    <style>
       .description_segment{
            font-size:14px !important;
        }

        @media only screen and (min-width: 1201px) and (max-device-width: 1600px) {

            .description_segment{
                font-size:11px !important;
            }
            
        }
    </style>
 
    <div class="row mt-5" style="background:#ff7a00; border-top-left-radius: 20px; border-top-right-radius: 20px;">
        <div class="col-md-12 pt-2">
            <p class="text-center"><strong>PESQUISA DE EMPRESAS</strong></p>
        </div>
    </div>

    <form action="{{ route('company.search.step_two.index') }}" id="formulario" method="get">
        @csrf
        @method('GET')
        
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
                <input type="text" name="last_review_from" class="date form-control datepicker " value placeholder="Data Inicial..." />
            </div>
            <div class="col-md-6 pb-5">
                <label for="last_review_to" class="control-label">
                    <strong>Data Final</strong>
                </label>
                <input type="text" name="last_review_to" class="date form-control datepicker " value placeholder="Data Final..." />
            </div>
        </div>
        
        @if (($statesOne->count() + $statesTwo->count() + $statesThree->count() +
            $statesFour->count() + $statesFive->count()) > 0)
            <div class="row mt-4">
                <div class="col-md-12">
                    <label class="control-label text-uppercase">
                        <strong>
                            <i class="fa fa-check-square-o"></i>
                            Regiões do Brasil
                        </strong>
                        <input type="checkbox" class="regiaoGeral orange-checkbox" />
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
                class-one="norte checkRegiaoGeral orange-checkbox"
                label-text="Norte"
                :data-list="$statesOne"
                class-two="checkNorte checkRegiaoGeral orange-checkbox"
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
                class-one="nordeste checkRegiaoGeral orange-checkbox"
                label-text="Nordeste"
                :data-list="$statesTwo"
                class-two="checkNordeste checkRegiaoGeral orange-checkbox"
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
                class-one="centro-oeste checkRegiaoGeral orange-checkbox"
                label-text="Centro-Oeste"
                :data-list="$statesThree"
                class-two="checkCentroOeste checkRegiaoGeral orange-checkbox"
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
                class-one="sudeste checkRegiaoGeral orange-checkbox"
                label-text="Sudeste"
                :data-list="$statesFour"
                class-two="checkSudeste checkRegiaoGeral orange-checkbox"
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
                class-one="sul checkRegiaoGeral orange-checkbox"
                label-text="Sul"
                :data-list="$statesFive"
                class-two="checkSul checkRegiaoGeral orange-checkbox"
                list-input-id-for="state-five-"
                list-input-name="states[]"
                collection-relation=""
            />
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
                    <div class="col-md-4 pt-3">
                        <p class="text-right description_segment">
                            <input
                                type="checkbox"
                                id="activity-field-{{ $activityField->id }}"
                                name="activity_fields[]"
                                class="activity_fields orange-checkbox"
                                value="{{ $activityField->id }}"
                            >
                            <label for="activity-field-{{ $activityField->id }}">
                                <strong class="description_segment">{{ $activityField->description }}</strong>
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
                            input-value=""
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
                            input-value=""
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
                            value=""
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
                            input-value=""
                            :input-readonly="false"
                        />
                    </div>
                </div>
                
                @can('ver-filtro-pesquisador-empresas')
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
                            input-value=""
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
                            input-value=""
                            :input-readonly="false"
                        />
                    </div>
                </div>

                <!-- Cidades selecionadas -->
                <div class="row mt-2">
                    <div class="col-md-12">
                        <label class="control-label">Cidades Selecionadas - <a class="clear" onclick="limparSelecionadas()">Limpar selecionada(s)</a> *</label>
                        <input type="text" name="selected_cities" class="form-control" id="selectedCitiesInput" style="color: blue;" placeholder="Selecione por Estado, mais será consultado até 4 Cidades" readonly>
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
                            <div class="col-md-4">
                                <x-intec-input
                                    label-input-id="cnpj"
                                    label-text="CNPJ"
                                    input-type="text"
                                    input-name="cnpj"
                                    class-one="cnpj"
                                    label-class=""
                                    input-value=""
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
                                    input-value=""
                                    :input-readonly="false"
                                />
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
                        
                        </div>
                    </div>
                </div>

        <div class="row mt-4 pb-4">
            
            <!--PESQUISAS SALVAS-->
            @can('salvar-pesquisa-empresa')
                <div class="col-md-3">
                    <label class="control-label">
                        <i class="fa fa-search"></i>
                        <strong>Pesquisa(s) Salva(s)</strong>
                    </label>
                    <form action='' method='get'>
                        @csrf
                        <div class="row">
                            <div class="input-group mb-3">
                                <div class="input-group mb-3">
                                    <select name='saved_id' id="selecao" class="form-select">
                                        <option value="0">-- Selecione --</option>
                                        @foreach($companySaveds as $companySaved)
                                            <option value="{{ $companySaved->id }}">{{ $companySaved->search_name }}</option>
                                        @endforeach
                                    </select>
                                    <button type='submit' class="btn btn-success" id='pesquisa-salva'><i class='fa fa-search'></i></button> 
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
    
                <div class="col-md-3">
                    <label class="control-label text-danger"> <strong>Deletar Pesquisa(s)</strong></label>
                    <select name="" id="delete" class="form-select" onchange="showModal()">
                        <option value="0">-- Selecione - Delete --</option>
                        @foreach($companySaveds as $companySaved)
                            <option value="{{ $companySaved->id }}">{{ $companySaved->search_name }}</option>
                        @endforeach
                    </select>
                </div>

                <script>
                    function showModal() {
                        var selectedCompanyId = document.getElementById("delete").value;
                        var modal = new bootstrap.Modal(document.getElementById("searchSaved"));

                        if (selectedCompanyId !== "0") {
                            document.getElementById("companyId").value = selectedCompanyId;
                            modal.show();
                        } else {
                            modal.hide();
                        }
                        }

                        function closeModal() {
                        var modal = document.getElementById("myModal");
                        modal.style.display = "none";
                        }
                </script>

                <!-- The Modal -->
                <div class="modal" id="searchSaved">
                    <div class="modal-dialog">
                        <div class="modal-content">

                            <!-- Modal Header -->
                            <div class="modal-header bg-danger">
                                <h5 class="modal-title text-white">Deletar Pesquisa de Empresa Salva</h5>
                            </div>

                            <!-- Modal body -->
                            <div class="modal-body">
                                <form action="{{ route('company.search.destroy') }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <input type="hidden" name="id" class="form-control" id="companyId" value=""/>

                                    <div class="modal-body">
                                        <p>Tem certeza que deseja deletar esta pesquisa de empresa salva?</p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-primary">Sim</button>
                                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endcan

            <div class="col-md-4">
                <label class="control-label"> <strong>Ação</strong></label>
                <br>
                @can('salvar-pesquisa-empresa')
                    <button type="submit" class="btn btn-primary submit" title="Pesquisar" id="salvar-pesquisa">
                        <i class="fa fa-search"></i> Salvar Pesquisa
                    </button>
                @endcan
                <button
                    type="submit"
                    class="btn btn-success submit"
                    title="Pesquisar"
                    id="pesquisar"
                    >
                    <i class="fa fa-search"></i>
                    Pesquisar
                </button>
            </div>
        </div>
    </form>
           
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Adicione um ouvinte de evento de clique ao botão "Salvar Pesquisa"
            document.getElementById('salvar-pesquisa').addEventListener('click', function() {
                // Redireciona o formulário para a rota desejada
                document.getElementById('formulario').action = "{{ route('company.search.saved-view') }}";
            });

            // Adicione um ouvinte de evento de clique ao botão "Pesquisar"
            document.getElementById('pesquisar').addEventListener('click', function() {
                // Redireciona o formulário para a rota desejada
                document.getElementById('formulario').action = "{{ route('company.search.step_two.index') }}";
            });
                // Adicione um ouvinte de evento de clique ao botão "Pesquisar"
            document.getElementById('pesquisa-salva').addEventListener('click', function() {
                // Redireciona o formulário para a rota desejada
                document.getElementById('formulario').action = "{{ route('company.search.companies') }}";
            });
            
        });
    </script>
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