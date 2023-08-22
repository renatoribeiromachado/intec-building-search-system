@extends('layouts.app_customer')

@section('content')
    <div class="container-fluid">
        <div class="container">
            <div class="row mt-2">
                <div class="col-md-12 mt-2">
                    <p class="text-center">
                        <strong>PESQUISA DE EMPRESA</strong>
                        - <code>FILTRO</code>
                    </p>
                </div>
            </div>

            <form action="{{ route('company.search.step_two.index') }}" id="formulario" method="get">
                @csrf
                @method('GET')

                @if (($statesOne->count() + $statesTwo->count() + $statesThree->count() +
                    $statesFour->count() + $statesFive->count()) > 0)
                    <div class="row mt-4">
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
                        <div class="col-md-4 pt-3">
                            <p class="text-right">
                                <input
                                    type="checkbox"
                                    id="activity-field-{{ $activityField->id }}"
                                    name="activity_fields[]"
                                    class="activity_fields"
                                    value="{{ $activityField->id }}"
                                    >
                                <label for="activity-field-{{ $activityField->id }}">
                                    <strong>{{ $activityField->description }}</strong>
                                </label>
                            </p>
                        </div>
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
                                    label-input-id="trading_name"
                                    label-text="Nome Fantasia"
                                    input-type="text"
                                    input-name="trading_name"
                                    class-one=""
                                    label-class=""
                                    input-value=""
                                    :input-readonly="false"
                                    placeholder=""
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
                    </div>

                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-md-12">
                                <x-intec-input
                                    label-input-id="company_name"
                                    label-text="Razão Social"
                                    input-type="text"
                                    input-name="company_name"
                                    class-one=""
                                    label-class=""
                                    input-value=""
                                    :input-readonly="false"
                                />
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

                        {{-- <div class="row mt-2">
                            <div class="col-md-12">
                                <label class="control-label">
                                    Cidades Selecionadas
                                    - <a class="clear">Limpar selecionada(s)</a>
                                </label>
                                <input
                                    type="text"
                                    name=""
                                    class="form-control viewSelect"
                                    style="color:blue;"
                                    placeholder="Selecione independente do Estado, mas será consultado até 4 Cidade(s)..."
                                    readonly
                                    >
                            </div>
                        </div> --}}

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
                        </div>
                    </div>
                </div>

                <div class="row mt-4 pb-4">
                    {{-- <div class="col-md-3">
                        <label class="control-label">
                            <i class="fa fa-search"></i>
                            <strong>Pesquisa(s) Salva(s)</strong>
                        </label>
                        <select name id="selecao" class="form-select">
                            <option value="0">-- Selecione --</option>
                        </select>
                    </div> --}}

                    {{-- <div class="col-md-3">
                        <label class="control-label text-danger"> <strong>Deletar Pesquisa(s)</strong></label>
                        <select name id="delete" class="form-select">
                            <option value="0">Selecione - Delete automatico</option>
                        </select>
                    </div> --}}

                    <div class="col-md-3">
                        {{-- <label class="control-label"> <strong>Ação</strong></label>
                        <br>
                        <button
                            type="submit"
                            class="btn btn-primary create"
                            title="Salvar Pesquisa"
                            value="1"
                            onclick="Acao('');"
                            >
                            <i class="fa fa-search"></i>Salvar Pesquisa
                        </button> --}}

                        <button
                            type="submit"
                            class="btn btn-success submit"
                            title="Pesquisar"
                            {{-- onclick="Acao('');" --}}
                            >
                            <i class="fa fa-search"></i>
                            Pesquisar
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
