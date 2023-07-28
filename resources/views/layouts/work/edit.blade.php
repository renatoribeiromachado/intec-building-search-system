@extends('layouts.app_customer')

@section('content')

    <div class="bg-light p-5 rounded" style="padding-bottom: 400px !important;">
        <h1>EDIÇÃO DE OBRA</h1>

        <form
            action="{{ route('work.update', $work->id) }}"
            method="POST"
            role="form"
            enctype="multipart/form-data"
            >
            @csrf
            @method('put')

            @include('layouts.forms.add_edit_work')

            <div class="row my-3 mx-2 mb-5">
                <div class="form-group">
                    <button
                        type="submit"
                        class="btn btn-primary me-2"
                        >
                        Salvar
                    </button>
        
                    <button
                        id="showSearchCompanyActivityFields"
                        type="button"
                        class="btn btn-success"
                        title="ADD Empresa(s) Participante(s)"
                        >
                        ADD Empresa(s) Participante(s)
                    </button>
                </div>
            </div>
        </form>

        <div class="row mx-2">
            <div id="activity-field-wrapper">
                <div class="col-md-4 mb-2">
                    <label for="activity_field_for_search">Atividade</label>
                    <select
                        id="activity_field_for_search" name="activity_field_for_search"
                        class="form-select @error('activity_field_for_search') is-invalid @enderror"
                        >
                        @foreach ($activityFieldsForSearch as $activityFieldForSearch)
                            @if ($loop->index == 0)
                            <option value="">-- Selecione --</option>
                            @endif

                            <option value="{{ $activityFieldForSearch->id }}">
                                {{ $activityFieldForSearch->description }}
                            </option>
                        @endforeach
                    </select>

                    @error('activity_field_for_search')
                        <div class="invalid-feedback">
                            {{ $errors->first('activity_field_for_search') }}
                        </div>
                    @enderror
                </div>

                <div class="col-md-4 mb-2">
                    <label for="trading_name">Nome Fantasia</label>
                    <input
                        type="text"
                        id="trading_name"
                        name="trading_name"
                        class="form-control @error('trading_name') is-invalid @enderror"
                        value="{{ old('trading_name', optional($work->trading_name)->format('d/m/Y')) }}"
                        placeholder="">
                    @error('trading_name')
                        <div class="invalid-feedback">
                            {{ $errors->first('trading_name') }}
                        </div>
                    @enderror
                </div>

                <div class="col-md-8 mt-4">
                    <button
                        type="button"
                        class="btn btn-warning"
                        title="ADD Empresa(s) Participante(s)"
                        id="showCompaniesListModal"
                        >
                        Pesquisar
                    </button>
                </div>
            </div>
        </div>

        @include('layouts.work.modals.show_companies_modal')

        <a name="companies-list-section"></a>

        <div class="row mx-2">
            <h2 class="my-4">Empresa(s) Vinculada(s)</h2>

            <table class="table mx-2">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">CNPJ</th>
                        <th scope="col">Razão Social</th>
                        <th scope="col">Atividade(s)</th>
                        <th scope="col">Contato(s)</th>
                        <th scope="col">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($work->companies as $company)
                        <tr>
                            <th scope="row" style="width:5%">{{ $company->id }}</th>
                            <td style="width:20%">{{ $company->cnpj }}</td>
                            <td>{{ $company->trading_name }}</td>
                            <td>
                                @foreach (
                                    $work->companyActivityFields()
                                        ->where('activity_field_work.company_id', $company->id)
                                        ->get() as $workCompanyActivity
                                    )
                                    {{ $workCompanyActivity->description }} <br>
                                @endforeach
                            </td>
                            <td>
                                @foreach (
                                    $work->companyContacts()
                                        ->where('contact_work.company_id', $company->id)
                                        ->get() as $workCompanyContact
                                    )
                                    {{ $workCompanyContact->name }}  <br>
                                    ({{ optional($workCompanyContact->position)->description}}) <br>
                                    ({{ $workCompanyContact->ddd }}) {{ $workCompanyContact->main_phone }} <br>
                                    <a href="mailto:{{ $workCompanyContact->email }}">
                                        {{ $workCompanyContact->email }}
                                    </a> <br>
                                @endforeach
                            </td>
                            <td style="width:30%">
                                <div class="row">
                                    <div class="col-12 mb-2 mt-1">
                                        <button
                                            type="button"
                                            class="btn btn-danger"
                                            data-bs-toggle="modal"
                                            data-bs-target="#removeCompanyFromWork{{$loop->index}}"
                                            >
                                            Remover Empresa Participante
                                        </button>
                                    </div>

                                    <div class="col-12 mb-2 mt-1">
                                        <button
                                            type="button"
                                            class="btn btn-info"
                                            data-bs-toggle="modal"
                                            data-bs-target="#addCompanyActivities{{$loop->index}}"
                                            >
                                            Incluir/Atualizar Atividades
                                        </button>
                                    </div>

                                    <div class="col-12 mb-2 mt-1">
                                        <button
                                            type="button"
                                            class="btn btn-success"
                                            data-bs-toggle="modal"
                                            data-bs-target="#addCompanyContacts{{$loop->index}}"
                                            >
                                            Inclui/Atualizar Contatos Responsáveis
                                        </button>
                                    </div>
                                </div>

                                @include('layouts.work.modals.remove_company_modal')

                                @include('layouts.work.modals.add_company_activities_modal')

                                @include('layouts.work.modals.add_company_contacts_modal')

                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="py-4 text-center">
                                <p>Nenhum contato encontrado.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

        </div>
    </div>

    @push('scripts')
        <script>
            $(document).ready(function () {

                $('#showSearchCompanyActivityFields').on('click', function (event) {
                    $('#activity-field-wrapper').toggle(600)
                });

                var myModal = new bootstrap.Modal(document.getElementById("searchCompanies"), {});

                $('#showCompaniesListModal').on('click', function (event) {

                    var activityField = $('#activity_field_for_search').val();
                    var tradingName = $('#trading_name').val();

                    if (activityField == "") {
                        alert('Atenção: Selecione uma Atividade para iniciar a pesquisa!');
                        return;
                    }

                    myModal.show();

                    $.ajax({
                        type: "GET",
                        url: base_url() + `v1/companies-by-activity-field/${activityField}`,
                        data: {'_token': $('meta[name=csrf-token]').attr('content'), 'trading_name': tradingName},
                        success: function (return_data) {
                            
                            var html = '';

                            for (var i = 0; i < return_data.companies.length; i++) {

                                html += `
                                <div class="col-md-4 mb-1 mt-1">
                                    <input
                                        type="checkbox"
                                        name="companies_list[]"
                                        value="${return_data.companies[i].id}"
                                        class="form-check-input me-1"
                                        id="companies-list-${return_data.companies[i].id}"
                                        />
                                    <label
                                        class="form-check-label"
                                        for="companies-list-${return_data.companies[i].id}">
                                        ${return_data.companies[i].cnpj}
                                    </label>
                                </div>
                                <div class="col-md-8">
                                    ${return_data.companies[i].trading_name}
                                </div>`;

                                if (! ((return_data.companies.length-1) == i)) {
                                    html += `<hr class="my-2 m-auto" style="width:90%">`;
                                }

                            }

                            $('#wrapp-companies-list').html(html)
                        },
                        error: function () {

                            var html = 'Nenhum registro encontrado.';

                        }
                    });

                })

                $('#segment').bind('change', function () {
                    var segment = $(this).val();

                    if (segment.length > 0) {

                        $.ajax({
                            type: "GET",
                            url: base_url() + 'v1/segment-sub-types',
                            data: {'_token': $('meta[name=csrf-token]').attr('content'), segment: segment},
                            success: function (return_data) {
                                if (return_data.segmentSubTypes.length <= 0) {
                                    let segmentHtml = `<option
                                                    value=""
                                                    style="background:#fff;color:#454c54;"
                                                    >
                                                    Sub-tipos não encontrados.
                                                </option>`;
                                    $('select[name="segment_sub_type_id"]').html(segmentHtml);
                                } else {

                                    var options = '<option value="" style="background:#fff;color:#454c54;">-- Selecione --</option>';
                                    
                                    for (var i = 0; i < return_data.segmentSubTypes.length; i++) {
                                        if (return_data.segmentSubTypes[i] !== "") {
                                            options += '<option value="' + return_data.segmentSubTypes[i].id
                                                + '" style="background:#fff;color:#454c54;">'
                                                + return_data.segmentSubTypes[i].description + '</option>';
                                        }
                                    }
                                    $('select[name="segment_sub_type_id"]').html(options);
                                }
                            },
                            error: function (event) {
                                console.log(event)
                                let segmentHtml = `<option
                                                    value=""
                                                    style="background:#fff;color:#454c54;"
                                                    >
                                                    Sub-tipos não encontrados.
                                                </option>`;
                                $('select[name="segment_sub_type_id"]').html(segmentHtml);
                            }
                        });
                        
                    } else {
                        // $('#span-subtipo').hide();
                    }
                });

                $('#phase').bind('change', function () {
                    var phase = $(this).val();

                    if (phase.length > 0) {

                        $.ajax({
                            type: "GET",
                            url: base_url() + 'v1/stages',
                            data: {'_token': $('meta[name=csrf-token]').attr('content'), phase: phase},
                            success: function (return_data) {
                                if (return_data.stages.length <= 0) {
                                    $('select[name="stage_id"]')
                                        .html('<option value="" style="background:#fff;color:#454c54;"> Estágios não encontrados. </option>');
                                } else {

                                    var options = '<option value="" style="background:#fff;color:#454c54;">-- Selecione --</option>';
                                    
                                    for (var i = 0; i < return_data.stages.length; i++) {
                                        if (return_data.stages[i] !== "") {
                                            options += '<option value="' + return_data.stages[i].id
                                                + '" style="background:#fff;color:#454c54;">'
                                                + return_data.stages[i].description + '</option>';
                                        }
                                    }
                                    $('select[name="stage_id"]').html(options);
                                }
                            },
                            error: function (event) {
                                console.log(event)
                                let phaseHtml = `<option
                                                value=""
                                                style="background:#fff;color:#454c54;"
                                                >
                                                Estágios não encontrados!
                                            </option>`;
                                $('select[name="stage_id"]').html(html);
                            }
                        });
                        
                    } else {
                        // $('#span-subtipo').hide();
                    }
                });

            })
        </script>
    @endpush

    @push('styles')
        <style>
            #activity-field-wrapper {
                display: none;
            }
        </style>
    @endpush
@endsection
