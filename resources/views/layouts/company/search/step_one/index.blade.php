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

                <div class="row  mt-2 bg-light border">
                    <div class="col-md-12">
                        <p class="text-uppercase"><input type="checkbox" class="nordeste checkRegiaoGeral" />
                            <b>Nordeste</b> <code>* Selecione Todos</code></p>
                        <hr>
                    </div>
                    <div class="col-md-4 pt-3">
                        <p class="text-right"><strong></strong> <input type="checkbox" name="state[]"
                                class="checkRegiaoGeral checkNordeste" value /></p>
                    </div>
                </div>

                <div class="row  mt-2 bg-light border">
                    <div class="col-md-12">
                        <p class="text-uppercase"><input type="checkbox" class="sudeste checkRegiaoGeral" />
                            <strong>Sudeste</strong></p>
                        <hr>
                    </div>
                    <div class="col-md-4 pt-3">
                        <p class="text-right"><strong></strong> <input type="checkbox" name="state[]"
                                class="checkRegiaoGeral checkSudeste" value /></p>
                    </div>
                </div>

                <div class="row mt-2 bg-light border">
                    <div class="col-md-12">
                        <p class="text-uppercase"><input type="checkbox" class="sul checkRegiaoGeral" />
                            <strong>Sul</strong> <code>* Selecione Todos</code></p>
                        <hr>
                    </div>
                    <div class="col-md-4 pt-3">
                        <p class="text-right"><strong></strong> <input type="checkbox" name="state[]"
                                class="checkRegiaoGeral checkSul" value /></p>
                    </div>
                </div>

                <div class="row mt-2 bg-light border">
                    <div class="col-md-12 jumbotronBox">
                        <p class="text-uppercase"><input type="checkbox" class="norte checkRegiaoGeral" />
                            <strong>Norte</strong> <code>* Selecione Todos</code></p>
                        <hr>
                    </div>
                    <div class="col-md-4 pt-3">
                        <p class="text-right"><strong></strong> <input type="checkbox" name="state[]"
                                class="checkRegiaoGeral checkNorte" value /></p>
                    </div>
                </div>

                <div class="row mt-2 bg-light border">
                    <div class="col-md-12">
                        <p class="text-uppercase"><input type="checkbox" class="centro-oeste checkRegiaoGeral" />
                            <strong>Centro-Oeste</strong> <code>* Selecione Todos</code></p>
                        <hr>
                    </div>
                    <div class="col-md-4 pt-3">
                        <p class="text-right"><strong></strong> <input type="checkbox" name="state[]"
                                class="checkRegiaoGeral checkCentro" value /></p>
                    </div>
                </div>

                {{-- <form action id="formulario" method="POST"> --}}

                {{-- @if (($segmentSubTypeOne->count() + $segmentSubTypeTwo->count() +
                    $segmentSubTypeThree->count()) > 0) --}}

                <div class="row mt-4">
                    <div class="col-md-12">
                        <label class="control-label text-uppercase">
                            <i class="fa fa-check-square-o"></i>
                            <strong>Segmentos de Atuação</strong>
                        </label>
                    </div>
                </div>


                <!--INDUSTRIAL-->
                {{-- <x-state-checkbox-group
                    id="segment-sub-type-all-1"
                    input-one-name="segment-sub-types[0]"
                    class-one="industrial"
                    label-text="Industrial"
                    :data-list="$activityFields"
                    class-two="Ind"
                    list-input-id-for="segment-sub-type-one-"
                    list-input-name="segment_sub_types[]"
                    collection-relation=""
                /> --}}

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

        /*SEGMENTO DE ATUAÇÃO*/
        // const geralCheckbox = document.querySelector('.regiaoGeral');
        // const checkboxesGeral = document.querySelectorAll('.checkRegiaoGeral');
        // geralCheckbox.addEventListener('click', function() {
        //     const isChecked = geralCheckbox.checked;
        //     checkboxesGeral.forEach(checkbox => {
        //         checkbox.checked = isChecked;
        //     });
        // });

        // /*REGIÃO NORDESTE*/
        // const nordesteCheckbox = document.querySelector('.nordeste');
        // const checkboxesNord = document.querySelectorAll('.checkNordeste');
        // nordesteCheckbox.addEventListener('click', function() {
        //     const isChecked = nordesteCheckbox.checked;
        //     checkboxesNord.forEach(checkbox => {
        //         checkbox.checked = isChecked;
        //     });
        // });

        // /*REGIÃO SULDESTE*/
        // const sudesteCheckbox = document.querySelector('.sudeste');
        // const checkboxesSudeste = document.querySelectorAll('.checkSudeste');
        // sudesteCheckbox.addEventListener('click', function() {
        //     const isChecked = sudesteCheckbox.checked;
        //     checkboxesSudeste.forEach(checkbox => {
        //         checkbox.checked = isChecked;
        //     });
        // });

        // /*REGIÃO SUL*/
        // const sulCheckbox = document.querySelector('.sul');
        // const checkboxesSul = document.querySelectorAll('.checkSul');
        // sulCheckbox.addEventListener('click', function() {
        //     const isChecked = sulCheckbox.checked;
        //     checkboxesSul.forEach(checkbox => {
        //         checkbox.checked = isChecked;
        //     });
        // });

        // /*REGIÃO NORTE*/
        // const norteCheckbox = document.querySelector('.norte');
        // const checkboxesNor = document.querySelectorAll('.checkNorte');
        // norteCheckbox.addEventListener('click', function() {
        //     const isChecked = norteCheckbox.checked;
        //     checkboxesNor.forEach(checkbox => {
        //         checkbox.checked = isChecked;
        //     });
        // });

        // /*REGIÃO NORTE*/
        // const centroCheckbox = document.querySelector('.centro-oeste');
        // const checkboxesCen = document.querySelectorAll('.checkCentro');
        // centroCheckbox.addEventListener('click', function() {
        //     const isChecked = centroCheckbox.checked;
        //     checkboxesCen.forEach(checkbox => {
        //         checkbox.checked = isChecked;
        //     });
        // });
    </script>

@endpush
