@extends('layouts.app_customer')

@section('content')
    <div class="container-fluid">
        <div class="container">
            <div class="row mt-2">
                <div class="col-md-12 mt-2">
                    <p class="text-center"><strong>PESQUISA DE OBRAS</strong> - <code>FILTRO</code></p>
                </div>
            </div>

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
                        <label class="control-label"><strong>Data Inicial</strong></label>
                        <input
                            type="text"
                            name="started_at"
                            class="date form-control datepicker"
                            value=""
                            placeholder="Data Inicial..."/>
                    </div>
                    <div class="col-md-6 pb-5">
                        <label class="control-label"><strong>Data Final</strong></label>
                        <input
                            type="text"
                            name="ends_at"
                            class="date form-control datepicker"
                            value=""
                            placeholder="Data Final..."/>
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
                <div class="row mt-3 bg-light border">
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

                <!--SEGMENTO E ATUAÇÕES-->
                {{-- <div class="row mt-4">
                    <div class="col-md-12">
                        <label class="control-label text-uppercase"> <i class="fa fa-check-square-o"></i> <strong>Segmentos de Atuação</strong></label>
                    </div>
                </div>

                <!--INDUSTRIAL-->
                <div class="row mt-2 bg-light border">
                    <div class="col-md-12 pt-3">
                        <p class="text-uppercase"><input type="checkbox" class="industrial" /> <strong>Industrial</strong>  <code>* Selecione Todos</code></p>
                        <hr>
                    </div>              
                    <div class="col-md-4">
                        <p class="text-right"><strong></strong> <input type="checkbox" name="type[]" class="Ind" value="" /></p>
                    </div>
                </div>

                <!--COMERCIAL-->
                <div class="row mt-2 bg-light border">
                    <div class="col-md-12">
                        <p class="text-uppercase"><input type="checkbox" class="commercial" /> <strong>Comercial</strong>  <code>* Selecione Todos</code></p>
                        <hr>
                    </div>
                    <div class="col-md-4">
                        <p class="text-right"><strong></strong> <input type="checkbox" name="type[]" class="Com" value="" /></p>
                    </div>
                </div>

                <!--RESIDENCIAL-->
                <div class="row mt-2 bg-light border">

                    <div class="col-md-12 jumbotronBox">
                        <p class="text-uppercase"><input type="checkbox" class="residential" /> <strong>Residencial</strong> <code>* Selecione Todos</code></p>
                        <hr>
                    </div>
                    <div class="col-md-4">
                        <p class="text-right"><strong></strong> <input type="checkbox" name="type[]" class="Res" value="" /></p>
                    </div>
                </div> --}}

                <!--MARCAR TODAS AS REGIÕES-->
                {{-- <div class="row mt-4">
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
                </div> --}}

                <!--NORDESTE-->
                {{-- <div class="row  mt-2 bg-light border">
                    <div class="col-md-12">
                        <p class="text-uppercase"><input type="checkbox" class="nordeste checkRegiaoGeral" /> <b>Nordeste</b> <code>* Selecione Todos</code></p>
                        <hr>
                    </div>
                    <div class="col-md-4 pt-3">
                        <p class="text-right"><strong></strong> <input type="checkbox" name="state[]" class="checkRegiaoGeral checkNordeste" value="" /></p>
                    </div>
                </div> --}}

                <!--SUDESTE-->
                {{-- <div class="row mt-2 bg-light border">
                    <div class="col-md-12">
                        <p class="text-uppercase"><input type="checkbox" class="sudeste checkRegiaoGeral" /> <strong>Sudeste</strong></p>
                        <hr>
                    </div>
                    <div class="col-md-4 pt-3">
                        <p class="text-right"><strong></strong> <input type="checkbox" name="state[]" class="checkRegiaoGeral checkSudeste" value="" /></p>
                    </div>
                </div> --}}

                <!--SUL-->
                {{-- <div class="row mt-2 bg-light border">
                    <div class="col-md-12">
                        <p class="text-uppercase"><input type="checkbox" class="sul checkRegiaoGeral" /> <strong>Sul</strong> <code>* Selecione Todos</code></p>
                        <hr>
                    </div>
                    <div class="col-md-4 pt-3">
                        <p class="text-right"><strong></strong> <input type="checkbox" name="state[]" class="checkRegiaoGeral checkSul" value="" /></p>
                    </div>
                </div>

                <!--NORTE-->
                <div class="row mt-2 bg-light border">
                    <div class="col-md-12 jumbotronBox">
                        <p class="text-uppercase"><input type="checkbox" class="norte checkRegiaoGeral" /> <strong>Norte</strong>  <code>* Selecione Todos</code></p>
                        <hr>
                    </div>
                    <div class="col-md-4 pt-3">
                        <p class="text-right"><strong></strong> <input type="checkbox" name="state[]" class="checkRegiaoGeral checkNorte" value="" /></p>
                    </div>
                </div>

                <!--CENTRO-OESTE-->
                <div class="row mt-2 bg-light border">
                    <div class="col-md-12">
                        <p class="text-uppercase"><input type="checkbox" class="centro-oeste checkRegiaoGeral" /> <strong>Centro-Oeste</strong> <code>* Selecione Todos</code></p>
                        <hr>
                    </div>
                    <div class="col-md-4 pt-3">
                        <p class="text-right"><strong></strong> <input type="checkbox" name="state[]" class="checkRegiaoGeral checkCentro" value="" /></p>
                    </div>
                </div> --}}

                <!--FILTRO ESPECIFICO-->
                {{-- <div class="row mt-4 pb-4 bg-light border">
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
                                    <option value="Baixo">Baixo</option>
                                    <option value="Medio">Médio</option>  
                                </select>
                            </div>
                            <div class="col-md-9">
                                <label class="control-label"> Nome da Obra</label>
                                <input type="text" name="name" class="form-control" id="busca-obra" value="" />
                            </div>
                        </div>

                        <div class="row mt-2">
                            <div class="col-md-12">
                                <label class="control-label"> Endereço </label>
                                <input type="text" name="adress" class="form-control" id="busca-adress" value="" />
                            </div>
                        </div>

                        <!--Estado-->
                        <div class="row mt-2">
                            <div class="col-md-2">
                                <label class="control-label"> Estado</label>
                                <select name="state" class="form-select">
                                    <option value="">Sel</option>
                                </select>
                            </div>
                            
                            <!--Cidades-->
                            <div class="col-md-10">
                                <label class="control-label"> <code>*Selecione até 4 cidade(s) para busca</code></label>
                                <select name="city" class="form-select cidade" id="selected"><!--IMPORTANTE O id="selected"-->
                                    <option value="0"> -- Selecione primeiro o Estado --</option>
                                </select>
                                <div style="display: none;">
                                    <div class="selected"><!--importante a classe selected-->
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row mt-2">
                            <div class="col-md-12">
                                <label class="control-label"> CEP Inicial</label>
                                <input type="text" name="initial_zip_code" class="form-control cep" value="" />
                            </div>
                        </div>

                        <div class="row mt-2">
                            <label class="control-label"> Área Construída(m²)</label>
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
                                <label class="control-label"> Empresa Participante</label>
                                <input type="text" name="company" class="form-control" id="company" value="" />
                            </div>
                        </div>

                        <div class="row mt-2">
                            <div class="col-md-12">
                                <label class="control-label"> Descrição</label>
                                <input type="text" name="notes" class="form-control" id="notes" value="" />
                            </div>
                        </div>

                        <div class="row mt-2">
                            <div class="col-md-6">
                                <label class="control-label"> Pesquisador *Associado não verá</label>
                                <select name="name" class="form-select form-group">
                                    <option value="0">-- Selecione --</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="control-label"> Status atual do SIG</label>
                                <select name="sig_id" class="form-select">
                                    <option value="0">-- Selecione --</option>

                                </select>
                            </div>
                        </div>

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
                                <label class="control-label"> Bairro</label>
                                <input type="text" name="district" class="form-control"  id="district" value="" />
                            </div>
                        </div>

                        <!--Cidades selecioandas-->
                        <div class="row mt-2">
                            <div class="col-md-12">
                                <label class="control-label">Cidades Selecionadas - <a class="clear">Limpar selecionada(s)</a></label>
                                <input type="text" name="cities" class="form-control viewSelect" style="color:blue;" placeholder="Selecione independente do Estado, mas será consultado até 4 Cidade(s) ..." readonly="">
                            </div>
                        </div>

                        <div class="row mt-2">
                            <div class="col-md-12">
                                <label class="control-label"> CEP final</label>
                                <input type="text" name="final_zip_code" class="form-control cep" value="" />
                            </div>
                        </div>

                        <div class="row mt-2">
                            <div class="col-md-6">
                                <label class="control-label"> Valor do Investimento</label>

                                <select name="qi" class="form-select">
                                    <option value="0">-- Selecione --</option>
                                    <option value=">">Maior que</option>
                                    <option value="<">Menor que</option>
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
                                <select name="modality_description" class="form-select modalidade">
                                    <option value="">-- Selecione --</option>
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

                        <div class="row mt-2">
                            <div class="col-md-6">
                                <label class="control-label"> Início das Obras</label>
                                <input type="text" name="initial_start" class="form-control datepicker" value="" placeholder="Data incial do mês desejado para Inicio"/>
                                <input type="text" name="start_end" class="form-control datepicker" value="" placeholder="Data final do mês desejado para Inicio"/> 
                            </div>
                            <div class="col-md-6">
                                <label class="control-label"> Término das Obras</label>
                                <input type="text" name="initial_term" class="form-control datepicker" value="" placeholder="Data incial do mês desejado para Término"/>
                                <input type="text" name="end_final" class="form-control datepicker" value="" placeholder="Data final do mês desejado para Término"/> 
                            </div>
                        </div>   
                    </div><!--fim lado direito-->
                </div> --}}

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
    </script>

@endpush


