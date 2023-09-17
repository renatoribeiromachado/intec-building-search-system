@extends('layouts.app_customer')

@section('content')

<div class="container bg-light p-5 rounded">
    <div class="alert alert-primary">
        <h4>PESQUISA DE OBRAS</h4>
    </div>

    @include('layouts.alerts.success')
    @include('layouts.alerts.all-errors')

    <div class="col-md-2 mt-2 mb-3 clearfix">
        <form name="export_form" action="{{ route('work.search.export') }}" method="get">
            @csrf

            <input
                type="hidden"
                id="input_select_all_1"
                name="input_select_all_1"
                value="{{ $inputSelectAll }}">
            <input
                type="hidden"
                id="input_page_of_pagination_1"
                name="input_page_of_pagination_1"
                value="{{ $inputPageOfPagination }}">
            <input
                type="hidden"
                id="clicked_in_page_1"
                name="clicked_in_page_1"
                value="{{ $clickedInPage }}">

            <input
                type="hidden"
                id="last_review_from_1"
                name="last_review_from_1"
                value="{{ convertPtBrDateToEnDate(request()->last_review_from) }}">
            <input
                type="hidden"
                id="last_review_to_1"
                name="last_review_to_1"
                value="{{ convertPtBrDateToEnDate(request()->last_review_to) }}">
            <input
                type="hidden"
                id="investment_standard_1"
                name="investment_standard_1"
                value="{{ request()->investment_standard }}">
            <input
                type="hidden"
                id="name_1"
                name="name_1"
                value="{{ request()->name }}">
            <input
                type="hidden"
                id="old_code_1"
                name="old_code_1"
                value="{{ request()->old_code }}">
            <input
                type="hidden"
                id="address_1"
                name="address_1"
                value="{{ request()->address }}">
            <input
                type="hidden"
                id="district_1"
                name="district_1"
                value="{{ request()->district }}">
            <input
                type="hidden"
                id="qa_1"
                name="qa_1"
                value="{{ request()->qa }}">
            <input
                type="hidden"
                id="total_area_1"
                name="total_area_1"
                value="{{ request()->total_area }}">
            <input
                type="hidden"
                id="qi_1"
                name="qi_1"
                value="{{ request()->qi }}">
            <input
                type="hidden"
                id="price_1"
                name="price_1"
                value="{{ request()->price }}">
            <input
                type="hidden"
                id="qr_1"
                name="qr_1"
                value="{{ request()->qr }}">
            <input
                type="hidden"
                id="state_id_1"
                name="state_id_1"
                value="{{ request()->state_id }}">
            
            <input
                type="hidden"
                id="cities_ids_1"
                name="cities_ids_1"
                value="{{ request()->cities_ids }}">
            
            <input
                type="hidden"
                id="researcher_id_1"
                name="researcher_id_1"
                value="{{ request()->researcher_id }}">
            <input
                type="hidden"
                id="revision_1"
                name="revision_1"
                value="{{ request()->revision }}">
            <!-- participating_company -->
            <input
                type="hidden"
                id="search_1"
                name="search_1"
                value="{{ request()->search }}">
            <!-- Modalidade -->
            <input
                type="hidden"
                id="modality_id_1"
                name="modality_id_1"
                value="{{ request()->modality_id }}">
            <!-- Pavimento -->
            <input
                type="hidden"
                id="floor_1"
                name="floor_1"
                value="{{ request()->floor }}">
            
            @foreach ($statesChecked as $stateChecked)
            <input type="hidden" name="states[]" value="{{ $stateChecked }}">
            @endforeach
            @foreach ($segmentSubTypesChecked as $segmentSubTypeChecked)
            <input type="hidden" name="segment_sub_types[]" value="{{ $segmentSubTypeChecked }}">
            @endforeach
            @foreach ($stagesChecked as $stageChecked)
            <input type="hidden" name="stages[]" value="{{ $stageChecked }}">
            @endforeach
        </form>
    </div>

    <form id="checkboxForm" action="{{ route('work.search.step_three.index') }}" method="get" target="_blank">
        @csrf
        @method('get')

        <input
            type="hidden"
            id="input_select_all"
            name="input_select_all"
            value="{{ $inputSelectAll }}">
        <input
            type="hidden"
            id="input_page_of_pagination"
            name="input_page_of_pagination"
            value="{{ $inputPageOfPagination }}">
        <input
            type="hidden"
            id="clicked_in_page"
            name="clicked_in_page"
            value="{{ $clickedInPage }}">

        <input
            type="hidden"
            id="last_review_from"
            name="last_review_from"
            value="{{ convertPtBrDateToEnDate(request()->last_review_from) }}">
        <input
            type="hidden"
            id="last_review_to"
            name="last_review_to"
            value="{{ convertPtBrDateToEnDate(request()->last_review_to) }}">
        <input
            type="hidden"
            id="investment_standard"
            name="investment_standard"
            value="{{ request()->investment_standard }}">
        <input
            type="hidden"
            id="name"
            name="name"
            value="{{ request()->name }}">
        <input
            type="hidden"
            id="old_code"
            name="old_code"
            value="{{ request()->old_code }}">
        <input
            type="hidden"
            id="address"
            name="address"
            value="{{ request()->address }}">
        <input
            type="hidden"
            id="district"
            name="district"
            value="{{ request()->district }}">
        <input
            type="hidden"
            id="qa"
            name="qa"
            value="{{ request()->qa }}">
        <input
            type="hidden"
            id="total_area"
            name="total_area"
            value="{{ request()->total_area }}">
        <input
            type="hidden"
            id="qi"
            name="qi"
            value="{{ request()->qi }}">
        <input
            type="hidden"
            id="price"
            name="price"
            value="{{ request()->price }}">
        <input
            type="hidden"
            id="qr"
            name="qr"
            value="{{ request()->qr }}">
        <input
            type="hidden"
            id="revision"
            name="revision"
            value="{{ request()->revision }}">
        <!-- participating_company -->
        <input
            type="hidden"
            id="search"
            name="search"
            value="{{ request()->search }}">
        @foreach ($statesChecked as $stateChecked)
        <input type="hidden" name="states[]" value="{{ $stateChecked }}">
        @endforeach
        @foreach ($segmentSubTypesChecked as $segmentSubTypeChecked)
        <input type="hidden" name="segment_sub_types[]" value="{{ $segmentSubTypeChecked }}">
        @endforeach
        @foreach ($stagesChecked as $stageChecked)
        <input type="hidden" name="stages[]" value="{{ $stageChecked }}">
        @endforeach

        <div class="row">
            <div class="col mt-3 mb-3">
                Resultados encontrados: &nbsp;
                <span class="fs-3">{{ $works->total() }}</span>
            </div>

            <div class="col-md-2 mt-2 mb-3 clearfix">
                <button
                    type="submit"
                    class="btn btn-success submit float-end"
                    title="Pesquisar"
                    id="pesquisarButton"
                    disabled
                    >
                    <i class="fa fa-search"></i> Pesquisar
                </button>
            </div>
        </div>

        <div class="row">
            <div class="col mt-3 mb-3">
                <!-- Botão para alternar entre selecionar e desmarcar todos os checkboxes -->
                <button
                    type="button"
                    id="toggleButton"
                    class="btn btn-primary mb-4"
                    onclick="toggleCheckboxes()"
                    data-toggle-state="select"
                    >
                    Selecionar Todos
                </button>
            </div>

            <div class="col-md-2 mt-2 mb-3 clearfix">
                <button
                    id="btn-export-spreadsheet"
                    type="button"
                    class="btn btn-success"
                    >
                    Exportar para Excel
                </button>
            </div>
        </div>

        <div class="row">
            <div class="table table-responsive">
                {{ $works->appends(request()->input())->links('vendor.pagination.bootstrap-4') }}
            </div>
        </div>
        
        <div class="table table-responsive">  
            <table class="table">
                <thead>
                    <tr class="bg-primary text-white">
                        <th scope="col">Código</th>
                        <th scope="col">Obra</th>
                        <th scope="col">Endereço</th>
                        <th scope="col">Cidade</th>
                        <th scope="col">UF</th>
                        <th scope="col">Fantasia</th>
                        <th scope="col">Estágio</th>
                        <th scope="col">Tipo</th>
                        <th scope="col">Atualização</th>
                        @can('ver-sig')
                        <th scope="col">Status</th>
                        <th scope="col">SIG</th>
                        @endcan
                    </tr>
                </thead>
                <tbody>
                    @forelse($works as $work) 
                            <tr style="background:{{ $work->segment_background }};">
                                <td style="cursor: pointer;">
                                    <div style="cursor: pointer;">
                                        <div class="form-check">
                                            <input
                                                class="form-check-input work-checkbox"
                                                type="checkbox"
                                                name="works_selected[]"
                                                value="{{ $work->id }}"
                                                id="flexCheckDefault{{$loop->index}}"
                                                data-work-id="{{ $work->id }}"
                                                data-work-code="{{ $work->old_code }}"
                                                @if(collect($worksChecked)->contains($work->id))
                                                checked
                                                @endif
                                                >
                                            <label
                                                class="form-check-label"
                                                for="flexCheckDefault{{$loop->index}}"
                                                >
                                                {{ $work->old_code }}
                                            </label>
                                        </div>
                                    </div>
                                </td>
                                <td>{{ $work->name }}</td>
                                {{--<td>R$ {{ convertDecimalToBRL($work->price )}}</td>--}}
                                <td>{{ $work->address }}, {{ $work->number }}</td>
                                <td>{{ $work->city }}</td>
                                <td><span class="badge bg-secondary">{{ $work->state }}</span></td>
                                <td>
                                    @foreach($work->companies as $company)
                                        {{ $company->trading_name }}@if(! $loop->last), @endif <br>
                                    @endforeach
                                </td>
                                {{--<td>{{ $work->phase_description }}</td>--}}
                                <td>{{ $work->stage_description }}</td>
                                <td>{{ $work->segmentSubType->description }}</td>
                                <td>
                                    @if(isset($work->last_review))
                                    {{ \Carbon\Carbon::parse($work->last_review)->format('d/m/Y') }}
                                    @endif
                                </td>
                                @can('ver-sig')
                                    <td>{{ $work->last_sig_status }}</td>
                                    <td>
                                        <a
                                            href="javascript:void(0)"
                                            data-bs-toggle="modal"
                                            data-bs-target="#sig"
                                            data-work-id="{{ $work->id }}"
                                            data-code="{{ $work->old_code }}"
                                            >
                                            <i class="fa fa-check"></i>
                                        </a>
                                    </td>
                                @endcan
                            </tr>
                        
                        @empty
                        <tr>
                            <td colspan="@can('ver-sig') 10 @else 8 @endcan">
                                <p class="text-center mb-0 py-4">
                                    Nenhum registro de obra encontrado.
                                </p>
                            </td>
                        </tr>
                        @endforelse
                </tbody>
            </table>
        </div>
    </form>

    @can('ver-sig')
        <!-- The Modal -->
        <div class="modal" id="sig">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header bg-primary text-white">
                        <h4 class="modal-title">Cadastro de SIG-Obra</h4>
                    </div>

                    <!-- Modal body -->
                    <div class="modal-body">
                        <form action="{{ route('sig.store') }}" method="post">
                            @csrf

                            <div class="row">
                                <div class="col-md-12">
                                    <p>Código: <span id="modal-code"></span></p>
                                </div>
                            </div>
                            
                            <!--Inputs hidden -->
                            <input type="hidden" name="work_id" value="" id="modal-work-id-input">

                            <div class="row">
                                <div class="col-md-4">
                                    <label>Agendar para</label>
                                    <input type="text" name="appointment_date" class="form-control datepicker" value="" required="">
                                </div>

                                <div class="col-md-4">
                                    <label for="priority">Prioridade</label>
                                    <select id="priority" name="priority" class="form-select">
                                        @foreach ($priorities as $priority)
                                            <option value="{{ $priority }}">{{ $priority }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-md-4">
                                    <label for="status">Status</label>
                                    <select id="status" name="status" class="form-select">
                                        @foreach ($statuses as $status)
                                            <option value="{{ $status }}">{{ $status }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <label for="notes">Descriçao</label>
                                    <textarea id="notes" name="notes" class="form-control" rows="5"></textarea>
                                </div>
                            </div>
                            
                            <!-- Modal footer -->
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Fechar</button>
                                <button type="submit" class="btn btn-primary">Cadastrar</button>
                            </div>
                        </form>
                        
                        <div class="row mt-3">
                            <div class="col-md-12">
                                <label class="form-label"><strong>Sig(s) cadastrados</strong></label>
                                <div class="table-responsive" style="overflow: auto; height: 200px;">
                                    <table class="table table-condensed">
                                        <thead class="table-dark">
                                            <tr>
                                                <th>Criado</th>
                                                <th>Agendado</th>
                                                <th>Codigo</th>
                                                <th>Relator</th>
                                                <th>Prioridade</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                            
                                        <tbody>
                                            @forelse($reports as $report)
                                                
                                                <tr class="report-row" data-work-id="{{ $report->work_id }}">
                                                    <td>
                                                        {{ $report->created_at->format('d/m/Y') }}
                                                    </td>
                                                    <td>
                                                        {{ optional($report->appointment_date)->format('d/m/Y') }}
                                                    </td>
                                                    <td class="text-primary"><strong>{{ $report->work->old_code }}</strong></td>
                                                    <td>{{ $report->user->name }}</td>
                                                    <td>{{ $report->priority }}</td>
                                                    <td class="text-primary"><strong>{{ $report->status }}</strong></td>
                                                </tr>

                                                @if ($report->notes)
                                                <tr class="report-row" data-work-id="{{ $report->work_id }}">
                                                    <td colspan="6"><strong>Descrição:</strong> *{{ $report->notes }}</td>
                                                </tr>
                                                
                                                
                                                @endif

                                                @empty
                                                <tr>
                                                    <td colspan="6" class="text-center py-4">
                                                        Nenhum SIG de obras encontrado.
                                                    </td>
                                                </tr>
                                            @endforelse
                                  
                                        </tbody>
                                    </table>
                                </div>
                            </div>                            
                        </div>
                    </div> <!-- /.modal-body -->
                </div> <!-- /.modal-content -->
            </div>
        </div>
    @endcan
    
    <div class="row">
        <div class="table table-responsive">
            {{ $works->appends(request()->input())->links('vendor.pagination.bootstrap-4') }}
        </div>
    </div>
</div>
@endsection

@push('scripts')

    <script>
        $(document).ready(function () {
            $('#btn-export-spreadsheet').click(function (event) {
                event.preventDefault();
                let $form = $('form[name="export_form"]');
                $form.submit();
            });

            $('.work-checkbox').click(function () {
                let $checkbox = $(this);
                let isChecked = $checkbox.is(':checked')

                if (isChecked) {
                    $.ajax({
                        type: "POST",
                        url: base_url() + 'v1/check-work',
                        data: {
                            work: $checkbox.val(),
                        },
                        success: function (return_data) {
                            // console.log(return_data)
                        },
                        error: function (event) {
                            console.log(event)
                        }
                    });
                }

                if (! isChecked) {
                    $.ajax({
                        type: "POST",
                        url: base_url() + 'v1/remove-check-work',
                        data: {
                            work: $checkbox.val(),
                        },
                        success: function (return_data) {
                            // console.log(return_data)
                        },
                        error: function (event) {
                            console.log(event)
                        }
                    });
                }
            })
        });

        let btnSelectAll = document.getElementById('toggleButton');
        // avoid the error maximum call stack size exceeded
        btnSelectAll.addEventListener("click", function(event){
            event.preventDefault()
        });

        let inputSelectAll = document.getElementById('input_select_all');
        let inputSelectAllWasClicked = inputSelectAll.value;

        let inputPageOfPagination = document.getElementById('input_page_of_pagination');
        let pageOfPagination = inputPageOfPagination.value;

        let inputClickedInPage = document.getElementById('clicked_in_page').value;

        btnSelectAll.textContent =
            ((inputClickedInPage == pageOfPagination) && (inputSelectAllWasClicked == 1))
            ? 'Desselecionar Todos' : 'Selecionar Todos';

        function toggleCheckboxes() {

            let workIds = [];
            let checkboxes = document.querySelectorAll('input[type="checkbox"]');
            let searchButton = document.getElementById('pesquisarButton');
            let allChecked = true;

            checkboxes.forEach(function (checkbox) {
                if (! checkbox.checked) {
                    allChecked = false;
                    searchButton.disabled = false;
                }else{
                    searchButton.disabled = true;
                }
                workIds = [];
            });

            checkboxes.forEach(function (checkbox) {
                checkbox.checked = ! allChecked;

                if (checkbox.checked) {
                    workIds.push(checkbox.value);
                }

                if (! checkbox.checked) {
                    const index = workIds.indexOf(checkbox.value);
                    if (index > -1) { // only splice workIds when item is found
                        workIds.splice(index, 1); // 2nd parameter means remove one item only
                    }
                }
            });

            $.ajax({
                type: "POST",
                url: base_url() + 'v1/check-all-works',
                data: {
                    work_ids: workIds,
                    input_select_all_was_clicked: inputSelectAllWasClicked,
                    input_page_of_pagination: pageOfPagination,
                    clicked_in_page: inputClickedInPage
                },
                success: function (return_data) {
                    // console.log(return_data)
                },
                error: function (event) {
                    console.log(event)
                }
            });

            var button = document.getElementById('toggleButton');
            button.textContent = allChecked ? 'Selecionar Todos' : 'Desselecionar Todos';
            const pesquisarButton = document.getElementById('pesquisarButton');
            // avoid the error maximum call stack size exceeded
            button.addEventListener("click", function(event){
                event.preventDefault()
                pesquisarButton.disabled = !peloMenosUmMarcado;
            });
        }
        
        /*Botão Sig*/
        document.addEventListener('DOMContentLoaded', function () {
            const sigLinks = document.querySelectorAll('a[data-bs-target="#sig"]');
            const modalCode = document.getElementById('modal-code');
            const modalWorkIdInput = document.getElementById('modal-work-id-input');

            sigLinks.forEach(link => {
                link.addEventListener('click', function (event) {
                    event.preventDefault();
                    const workId = this.getAttribute('data-work-id');
                    const workOldCode = this.getAttribute('data-code');
                    modalCode.textContent = workOldCode;
                    modalWorkIdInput.value = workId;

                    // Filtra as linhas da tabela
                    const reportRows = document.querySelectorAll('.report-row');
                    reportRows.forEach(row => {
                        const reportWorkId = row.getAttribute('data-work-id');
                        if (reportWorkId === workId) {
                            row.style.display = 'table-row';
                        } else {
                            row.style.display = 'none';
                        }
                    });
                });
            });
        });

        
        /*Desabilita o botão pesquisar somente qdo um check ou mais estiver checado - 17/08/2023 - Renato Machado*/
        const checkboxSearch = document.querySelectorAll('input[type="checkbox"]');
        const pesquisarButton = document.getElementById('pesquisarButton');

        checkboxSearch.forEach(checkbox => {
            checkbox.addEventListener('change', () => {
                let peloMenosUmMarcado = false;
                checkboxSearch.forEach(checkbox => {
                    if (checkbox.checked) {
                        peloMenosUmMarcado = true;
                    }
                });
                
                pesquisarButton.disabled = !peloMenosUmMarcado;
            });
        });

    </script>

@endpush
