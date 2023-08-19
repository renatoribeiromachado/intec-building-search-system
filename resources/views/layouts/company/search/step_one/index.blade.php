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

                    {{-- <div class="col-md-6">
                        <div class="row">
                            <div class="col-md-12">
                                <label class="control-label">Fantasia</label>
                                <input type="text" name class="form-control" id="busca-obra" value />
                            </div>
                        </div>

                        <div class="row mt-2">
                            <div class="col-md-12">
                                <label class="control-label">Endereço</label>
                                <input type="text" name class="form-control" id="busca-adress" value />
                            </div>
                        </div>

                        <div class="row mt-2">
                            <div class="col-md-2">
                                <label class="control-label">Estado</label>
                                <select name="state" class="form-select">
                                    <option value>--Selecione--</option>
                                </select>
                            </div>

                            <div class="col-md-10">
                                <label class="control-label">
                                    <code>*Selecione até 4 cidade(s) para busca</code>
                                </label>

                                <select name="city" class="form-select cidade" id="selected">
                                    <option value="0">-- Selecione primeiro o Estado --</option>
                                </select>

                                <div style="display: none;">
                                    <div class="selected">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row mt-2">
                            <div class="col-md-12">
                                <label class="control-label">Site</label>
                                <input type="text" name class="form-control" id="company" value />
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-md-12">
                                <label class="control-label">Razão Social</label>
                                <input type="text" name class="form-control" value />
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-md-12">
                                <label class="control-label">Bairro</label>
                                <input type="text" name class="form-control" id="district" value />
                            </div>
                        </div>

                        <div class="row mt-2">
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
                        </div>

                        <div class="row mt-2">
                            <div class="col-md-4">
                                <label class="control-label">CNPJ</label>
                                <input type="text" name class="form-control" value />
                            </div>
                            <div class="col-md-8">
                                <label class="control-label">Email</label>
                                <input type="text" name class="form-control" value />
                            </div>
                        </div>
                    </div> --}}
                </div>

                <div class="row mt-4 pb-4">
                    <div class="col-md-3">
                        <label class="control-label">
                            <i class="fa fa-search"></i>
                            <strong>Pesquisa(s) Salva(s)</strong>
                        </label>
                        <select name id="selecao" class="form-select">
                            <option value="0">-- Selecione --</option>
                        </select>
                    </div>

                    <div class="col-md-3">
                        <label class="control-label text-danger"> <strong>Deletar Pesquisa(s)</strong></label>
                        <select name id="delete" class="form-select">
                            <option value="0">Selecione - Delete automatico</option>
                        </select>
                    </div>

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
                            onclick="Acao('');"
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

    {{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> --}}
    {{-- <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script> --}}
    <script>
        $(document).ready(function() {
            $(".datepicker").datepicker();
        });

        /*REGIÃO NORDESTE*/
        const nordesteCheckbox = document.querySelector('.nordeste');
        const checkboxesNord = document.querySelectorAll('.checkNordeste');
        nordesteCheckbox.addEventListener('click', function() {
            const isChecked = nordesteCheckbox.checked;
            checkboxesNord.forEach(checkbox => {
                checkbox.checked = isChecked;
            });
        });

        /*REGIÃO SULDESTE*/
        const sudesteCheckbox = document.querySelector('.sudeste');
        const checkboxesSudeste = document.querySelectorAll('.checkSudeste');
        sudesteCheckbox.addEventListener('click', function() {
            const isChecked = sudesteCheckbox.checked;
            checkboxesSudeste.forEach(checkbox => {
                checkbox.checked = isChecked;
            });
        });

        /*REGIÃO SUL*/
        const sulCheckbox = document.querySelector('.sul');
        const checkboxesSul = document.querySelectorAll('.checkSul');
        sulCheckbox.addEventListener('click', function() {
            const isChecked = sulCheckbox.checked;
            checkboxesSul.forEach(checkbox => {
                checkbox.checked = isChecked;
            });
        });

        /*REGIÃO NORTE*/
        const norteCheckbox = document.querySelector('.norte');
        const checkboxesNor = document.querySelectorAll('.checkNorte');
        norteCheckbox.addEventListener('click', function() {
            const isChecked = norteCheckbox.checked;
            checkboxesNor.forEach(checkbox => {
                checkbox.checked = isChecked;
            });
        });

        /*REGIÃO CENTRO-OESTE*/
        const centroCheckbox = document.querySelector('.centro-oeste');
        const checkboxesCen = document.querySelectorAll('.checkCentroOeste');
        centroCheckbox.addEventListener('click', function() {
            const isChecked = centroCheckbox.checked;
            checkboxesCen.forEach(checkbox => {
                checkbox.checked = isChecked;
            });
        });
    </script>

@endpush
