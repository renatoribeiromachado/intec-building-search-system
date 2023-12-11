@extends('layouts.app_customer')

@section('content')
<div class="container">
    <div class="bg-light p-5 rounded" style="padding-bottom: 100px !important;">
        <div class="container">
            <h3>EDIÇÃO DE OBRA</h3>
        </div>

        <form
            action="{{ route('work.update', $work->id) }}"
            method="POST"
            role="form"
            enctype="multipart/form-data"
            >
            @csrf
            @method('put')

            @include('layouts.forms.add_edit_work')


            <div class="container">
                <div class="row my-3 mb-5">
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
            </div>
        </form>

        <div class="container">
            <div class="row">
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
        </div>

        @include('layouts.work.modals.show_companies_modal')

        <a name="companies-list-section"></a>

        <div class="container">
            <div class="row">
                <h3 class="my-4">Empresa(s) Vinculada(s)</h3>

                <table class="table mx-2">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">CNPJ</th>
                            <th scope="col">Razão Social</th>
                            <th scope="col">Nome Fantasia</th>
                            <th scope="col">Atividade(s)</th>
                            <th scope="col">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($work->companies as $company)
                            <tr>
                                <th scope="row" style="width: 20px;">{{ $company->id }}</th>
                                <td style="width: 190px;">{{ $company->cnpj }}</td>
                                <td style="width: 260px;">{{ $company->company_name }}</td>
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
                                                Atualizar Atividades
                                            </button>
                                        </div>

                                        <div class="col-12 mb-2 mt-1">
                                            <button
                                                type="button"
                                                class="btn btn-success"
                                                data-bs-toggle="modal"
                                                data-bs-target="#addCompanyContacts{{$loop->index}}"
                                                >
                                                Atualizar Contatos Responsáveis
                                            </button>
                                        </div>
                                    </div>

                                    @include('layouts.work.modals.remove_company_modal')

                                    @include('layouts.work.modals.add_company_activities_modal')

                                    @include('layouts.work.modals.add_company_contacts_modal')

                                </td>
                            </tr>

                            @if ($company->contacts()->exists())
                                <tr>
                                    <td colspan="6">
                                        <table class="table table-borderless">
                                            <th>
                                                <h3>Contatos</h3>
                                            </th>
                                            <tr>
                                                <td>
                                                    <div class="row">
                                                        @foreach (
                                                            $work->companyContacts()
                                                                ->where('contact_work.company_id', $company->id)
                                                                ->orderBy('name', 'asc')
                                                                ->get() as $workCompanyContact
                                                        )


                                                            <div class="col intec-contact-wrapper">
                                                                @if ($workCompanyContact->name)
                                                                    <!-- Contact Name -->
                                                                    {{ $workCompanyContact->name }}  <br>
                                                                @endif

                                                                @if ($workCompanyContact->position)
                                                                    <!-- Contact Position -->
                                                                    ({{ optional($workCompanyContact->position)->description }}) <br>
                                                                @endif

                                                                @if ($workCompanyContact->ddd && $workCompanyContact->main_phone)
                                                                    <!-- Contact Phone 1 -->
                                                                    ({{ $workCompanyContact->ddd }})
                                                                    {{ $workCompanyContact->main_phone }} <br>
                                                                @endif

                                                                @if ($workCompanyContact->ddd_two && $workCompanyContact->phone_two)
                                                                    <!-- Contact Phone 2 -->
                                                                    ({{ $workCompanyContact->ddd_two }})
                                                                    {{ $workCompanyContact->phone_two }} <br>
                                                                @endif

                                                                @if ($workCompanyContact->ddd_three && $workCompanyContact->phone_three)
                                                                    <!-- Contact Phone 3 -->
                                                                    ({{ $workCompanyContact->ddd_three }})
                                                                    {{ $workCompanyContact->phone_three }} <br>
                                                                @endif

                                                                @if ($workCompanyContact->ddd_four && $workCompanyContact->phone_four)
                                                                    <!-- Contact Phone 4 -->
                                                                    ({{ $workCompanyContact->ddd_four }})
                                                                    {{ $workCompanyContact->phone_four }} <br>
                                                                @endif

                                                                @if ($workCompanyContact->email)
                                                                    <!-- Contact E-mail 1 -->
                                                                    <a href="mailto:{{ $workCompanyContact->email }}">
                                                                        {{ $workCompanyContact->email }}
                                                                    </a> <br>
                                                                @endif

                                                                @if ($workCompanyContact->secondary_email)
                                                                    <!-- Contact E-mail 2 -->
                                                                    <a href="mailto:{{ $workCompanyContact->secondary_email }}">
                                                                        {{ $workCompanyContact->secondary_email }}
                                                                    </a> <br>
                                                                @endif

                                                                @if ($workCompanyContact->tertiary_email)
                                                                    <!-- Contact E-mail 3 -->
                                                                    <a href="mailto:{{ $workCompanyContact->tertiary_email }}">
                                                                        {{ $workCompanyContact->tertiary_email }}
                                                                    </a> <br>
                                                                @endif
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            @endif

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
                
                /*Segmento*/

               // Carregue os subtipos relacionados ao segmento selecionado ao carregar a página
                loadSubtypes();

                // Atualize os subtipos quando o segmento for alterado
                $('#segment').on('change', function () {
                    loadSubtypes();
                });

                function loadSubtypes() {
                    var segment = $('#segment').val();

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
                                                + '" style="background:#fff;color:#454c54;"';

                                            // Verifique se o subtipo é o mesmo que o associado à obra
                                            if (return_data.segmentSubTypes[i].id == '{{ $work->segment_sub_type_id }}') {
                                                options += ' selected';
                                            }

                                            options += '>'
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
                        // Se nenhum segmento estiver selecionado, limpe os subtipos
                        $('select[name="segment_sub_type_id"]').html('<option value="" style="background:#fff;color:#454c54;">-- Selecione primeiro o segmento --</option>');
                    }
                }

                /*Fase*/
                // Carregue os estágios relacionados à fase selecionada ao carregar a página
                loadStages();

                // Atualize os estágios quando a fase for alterada
                $('#phase').on('change', function () {
                    loadStages();
                });

                function loadStages() {
                    var phase = $('#phase').val();

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
                                                + '" style="background:#fff;color:#454c54;"';

                                            // Verifique se o estágio é o mesmo associado à obra
                                            if (return_data.stages[i].id == '{{ $work->stage_id }}') {
                                                options += ' selected';
                                            }

                                            options += '>'
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
                        // Se nenhuma fase estiver selecionada, limpe os estágios
                        $('select[name="stage_id"]').html('<option value="" style="background:#fff;color:#454c54;">-- Selecione primeiro a fase --</option>');
                    }
                }

            })
        </script>
    @endpush

    @push('styles')
        <style>
            #activity-field-wrapper {
                display: none;
            }
            .intec-contact-wrapper {
                min-height: 260px;
            }
        </style>
    @endpush
@endsection
