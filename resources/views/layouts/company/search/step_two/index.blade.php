@extends('layouts.app_customer')

@section('content')
    <div class="container bg-light p-5 rounded">
        <div class="alert alert-primary">
            <h4>PESQUISA DE EMPRESAS</h4>
        </div>

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

            <button
                type="button"
                id="toggleButton"
                class="btn btn-primary mb-4"
                onclick="toggleCheckboxes()"
                >
                Selecionar Todos
            </button>

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
                    </tr>
                    @empty
                    <tr>
                        <td colspan="3">
                            <p class="text-center mb-0 py-4">
                                Nenhum registro de empresa encontrado.
                            </p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </form>

        <div>
            {{ $companies->appends(request()->input())->links('vendor.pagination.bootstrap-4') }}
        </div>
    </div>
@endsection

@push('scripts')

    <script>
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
            button.textContent = allChecked ? 'Selecionar Todos' : 'Deselecionar Todos';
            // avoid the error maximum call stack size exceeded
            button.addEventListener("click", function(event){
                event.preventDefault()
            });
        }
    </script>

@endpush