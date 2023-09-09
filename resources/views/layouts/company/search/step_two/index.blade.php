@extends('layouts.app_customer')

@section('content')
    <div class="container bg-light p-5 rounded">
        <div class="alert alert-primary">
            <h4>PESQUISA DE EMPRESAS</h4>
        </div>
        
        @include('layouts.alerts.success')
        @include('layouts.alerts.all-errors')
        
        <form name="export_form" action="{{ route('company.search.export') }}" method="get">
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
                id="home_page_1"
                name="home_page_1"
                value="{{ request()->home_page }}">
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
                id="primary_email_1"
                name="primary_email_1"
                value="{{ request()->primary_email }}">
            <input
                type="hidden"
                id="cnpj_1"
                name="cnpj_1"
                value="{{ request()->cnpj }}">
            <input
                type="hidden"
                id="search_1"
                name="search_1"
                value="{{ request()->search }}">
            <input
                type="hidden"
                id="searchCompany_1"
                name="searchCompany_1"
                value="{{ request()->searchCompany }}">
            <input
                type="hidden"
                id="cities_ids_1"
                name="cities_ids_1"
                value="{{ request()->cities_ids }}">
            <input
                type="hidden"
                id="state_id"
                name="state_id_1"
                value="{{ request()->state_id }}">
            <!-- participating_company -->
            <input
                type="hidden"
                id="search_1"
                name="search_1"
                value="{{ request()->search }}">
            @foreach ($statesChecked as $stateChecked)
            <input type="hidden" name="states[]" value="{{ $stateChecked }}">
            @endforeach
            
        

        </form>

        <form action="{{ route('company.search.step_three.index') }}" method="get">
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
                id="at_least_one_check_box_was_clicked"
                name="at_least_one_check_box_was_clicked"
                value="{{ $atLeastOneCheckboxWasClicked }}">

            <input
                type="hidden"
                id="trading_name"
                name="trading_name"
                value="{{ request()->trading_name }}">
            <input
                type="hidden"
                id="company_name"
                name="company_name"
                value="{{ request()->company_name }}">
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
                id="cnpj"
                name="cnpj"
                value="{{ request()->cnpj }}">
            <input
                type="hidden"
                id="primary_email"
                name="primary_email"
                value="{{ request()->primary_email }}">
            <input
                type="hidden"
                id="home_page"
                name="home_page"
                value="{{ request()->home_page }}">
            @foreach ($statesChecked as $stateChecked)
            <input type="hidden" name="states[]" value="{{ $stateChecked }}">
            @endforeach
            @foreach ($activityFieldsChecked as $activityFieldChecked)
            <input type="hidden" name="activity_fields[]" value="{{ $activityFieldChecked }}">
            @endforeach

            <div class="row">
                <div class="col mt-3 mb-3">
                    Resultados encontrados: &nbsp;
                    <span class="fs-3">{{ $companies->total() }}</span>
                </div>

                <div class="col mt-3 mb-3 clearfix">
                    <button
                        type="submit"
                        class="btn btn-success submit float-end"
                        title="Pesquisar"
                        >
                        <i class="fa fa-search"></i>
                        Pesquisar
                    </button>
                </div>

            </div>

            <div class="row">
                <div class="col mt-3 mb-3">
                    <button
                        type="button"
                        id="toggleButton"
                        class="btn btn-primary mb-4"
                        onclick="toggleCheckboxes()"
                        >
                        Selecionar Todos
                    </button>
                </div>

                <!--Excel-->
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

            <div>
                {{ $companies->appends(request()->input())->links('vendor.pagination.bootstrap-4') }}
            </div>

            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">CNPJ</th>
                        <th scope="col">Razão Social</th>
                        <th scope="col">Nome Fantasia</th>
                        <th scope="col">Segmento</th>
                        @can('ver-sig-empresa')
                            <th scope="col">Status</th>
                            <th scope="col">SIG</th>
                        @endcan
                    </tr>
                </thead>
                <tbody>
                    @forelse($companies as $company)
                    <tr>
                        <td style="cursor: pointer; width: 200px;">
                            <div style="cursor: pointer;">
                                <div class="form-check">
                                    <input
                                        class="form-check-input company-checkbox"
                                        type="checkbox"
                                        name="companies_selected[]"
                                        value="{{ $company->id }}"
                                        id="flexCheckDefault{{$loop->index}}"
                                        @if(collect($companiesChecked)->contains($company->id))
                                        checked
                                        @endif
                                        >
                                    <label
                                        class="form-check-label"
                                        for="flexCheckDefault{{$loop->index}}"
                                        >
                                        {{ $company->cnpj }}
                                    </label>
                                </div>
                            </div>
                        </td>
                        <td style="width: 430px;">{{ $company->company_name }}</td>
                        <td>{{ $company->trading_name }}</td>
                        <td>{{ optional($company->activityField)->description }}</td>
                        
                        @can('ver-sig-empresa')
                            <td>{{ $company->last_sig_status }}</td>
                            <td>
                                <a
                                    href="javascript:void(0)"
                                    data-bs-toggle="modal"
                                    data-bs-target="#sig"
                                    data-company-id="{{ $company->id }}"
                                    data-name="{{ $company->trading_name }}"
                                    >
                                    <i class="fa fa-check"></i>
                                </a>
                            </td>
                        @endcan
                        
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4">
                            <p class="text-center mb-0 py-4">
                                Nenhum registro de empresa encontrado.
                            </p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </form>
        
        @can('ver-sig-empresa')
        <!-- The Modal -->
        <div class="modal" id="sig">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header bg-primary text-white">
                        <h4 class="modal-title">Cadastro de SIG-Empresa</h4>
                    </div>

                    <!-- Modal body -->
                    <div class="modal-body">
                        <form action="{{ route('sig-company.store') }}" method="post">
                            @csrf

                            <div class="row">
                                <div class="col-md-12">
                                    <p><strong>Empresa:</strong> <span id="modal-name"></span></p>
                                </div>
                            </div>
                            
                            <!--Inputs hidden -->
                            <input type="hidden" name="company_id" value="" id="modal-company-id-input">

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
                                                <th>Empresa</th>
                                                <th>Relator</th>
                                                <th>Prioridade</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                            
                                        <tbody>
                                            @forelse($reports as $report)
                                                
                                                <tr class="report-row" data-company-id="{{ $report->company_id }}">
                                                    <td>
                                                        {{ $report->created_at->format('d/m/Y') }}
                                                    </td>
                                                    <td>
                                                        {{ optional($report->appointment_date)->format('d/m/Y') }}
                                                    </td>
                                                    <td class="text-primary"><strong></strong></td>
                                                    <td>{{ $report->user->name }}</td>
                                                    <td>{{ $report->priority }}</td>
                                                    <td class="text-primary"><strong>{{ $report->status }}</strong></td>
                                                </tr>

                                                @if ($report->notes)
                                                <tr class="report-row" data-company-id="{{ $report->company_id }}">
                                                    <td colspan="6"><strong>Descrição:</strong> *{{ $report->notes }}</td>
                                                </tr>
                                                
                                                
                                                @endif

                                                @empty
                                                <tr>
                                                    <td colspan="6" class="text-center py-4">
                                                        Nenhum SIG de empresa encontrado.
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

        <div>
            {{ $companies->appends(request()->input())->links('vendor.pagination.bootstrap-4') }}
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

        $(document).ready(function () {
            $('.company-checkbox').click(function () {
                let $checkbox = $(this);
                let isChecked = $checkbox.is(':checked')

                btnSelectAll.textContent = 'Deselecionar Todos';

                if (isChecked) {
                    $.ajax({
                        type: "POST",
                        url: base_url() + 'v1/check-company',
                        data: {
                            company: $checkbox.val(),
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
                        url: base_url() + 'v1/remove-check-company',
                        data: {
                            company: $checkbox.val(),
                        },
                        success: function (return_data) {
                            if ((return_data.companies_selected == null) ||
                                (! return_data.companies_selected.length)) {
                                btnSelectAll.textContent = 'Selecionar Todos';
                            }
                        },
                        error: function (event) {
                            console.log(event)
                        }
                    });
                }
            })
        });

        let atLeastOneCheckboxWasClicked = document
            .getElementById('at_least_one_check_box_was_clicked').value;
        // avoid the error maximum call stack size exceeded
        btnSelectAll.addEventListener("click", function(event){
            event.preventDefault()
        });

        let inputSelectAll = document.getElementById('input_select_all');
        let inputSelectAllWasClicked = inputSelectAll.value;

        let inputPageOfPagination = document.getElementById('input_page_of_pagination');
        let pageOfPagination = inputPageOfPagination.value;

        let inputClickedInPage = document.getElementById('clicked_in_page').value;

        console.log(atLeastOneCheckboxWasClicked)
        console.log('Aqui!')

        btnSelectAll.textContent = (inputSelectAllWasClicked == 1)
            // ((atLeastOneCheckboxWasClicked !== '') &&
            //     (inputClickedInPage == pageOfPagination) &&
            //     (inputSelectAllWasClicked == 1))
            ? 'Deselecionar Todos' : 'Selecionar Todos';

        function toggleCheckboxes() {

            let companyIds = [];
            let checkboxes = document.querySelectorAll('input[type="checkbox"]');
            let allChecked = true;

            checkboxes.forEach(function (checkbox) {
                if (! checkbox.checked) {
                    allChecked = false;
                }
                companyIds = [];
            });

            checkboxes.forEach(function (checkbox) {
                if (atLeastOneCheckboxWasClicked != 1) {
                    checkbox.checked = ! allChecked;

                    if (checkbox.checked) {
                        companyIds.push(checkbox.value);
                    }

                    if (! checkbox.checked) {
                        const index = companyIds.indexOf(checkbox.value);
                        if (index > -1) { // only splice companyIds when item is found
                            companyIds.splice(index, 1); // 2nd parameter means remove one item only
                        }
                    }
                }
            });

            $.ajax({
                type: "POST",
                url: base_url() + 'v1/check-all-companies',
                data: {
                    company_ids: companyIds,
                    input_select_all_was_clicked: inputSelectAllWasClicked,
                    input_page_of_pagination: pageOfPagination,
                    clicked_in_page: inputClickedInPage
                },
                success: function (return_data) {
                    console.log(return_data)
                },
                error: function (event) {
                    console.log(event)
                }
            });

            var button = document.getElementById('toggleButton');
            button.textContent = allChecked ? 'Selecionar Todos' : 'Desselecionar Todos';
            // avoid the error maximum call stack size exceeded
            button.addEventListener("click", function(event){
                event.preventDefault()
            });
        }
        
        /*Botão Sig*/
        document.addEventListener('DOMContentLoaded', function () {
            const sigLinks = document.querySelectorAll('a[data-bs-target="#sig"]');
            const modalName = document.getElementById('modal-name');
            const modalCompanyIdInput = document.getElementById('modal-company-id-input');

            sigLinks.forEach(link => {
                link.addEventListener('click', function (event) {
                    event.preventDefault();
                    const companyId = this.getAttribute('data-company-id');
                    const comapnyName = this.getAttribute('data-name');
                    modalName.textContent = comapnyName;
                    modalCompanyIdInput.value = companyId;

                    // Filtra as linhas da tabela
                    const reportRows = document.querySelectorAll('.report-row');
                    reportRows.forEach(row => {
                        const reportCompanyId = row.getAttribute('data-company-id');
                        if (reportCompanyId === companyId) {
                            row.style.display = 'table-row';
                        } else {
                            row.style.display = 'none';
                        }
                    });
                });
            });
        });
    </script>

@endpush