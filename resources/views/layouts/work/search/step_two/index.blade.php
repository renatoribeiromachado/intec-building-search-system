@extends('layouts.app_customer')

@section('content')

<div class="container bg-light p-5 rounded">
    <div class="alert alert-primary">
        <h4>PESQUISA DE OBRAS</h4>
    </div>

    <form action="{{ route('work.search.step_three.index') }}" method="get">
        @csrf
        @method('get')

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

            <div class="col mt-3 mb-3 clearfix">
                <button type="submit" class="btn btn-success submit float-end" title="Pesquisar">
                    <i class="fa fa-search"></i> Pesquisar
                </button>
            </div>
        </div>
        
        <!-- Botão para alternar entre selecionar e desmarcar todos os checkboxes -->
        <button
            type="button"
            id="toggleButton"
            class="btn btn-primary mb-4"
            onclick="toggleCheckboxes()"
            >
            Selecionar Todos
        </button>

        <div>
            {{ $works->appends(request()->input())->links('vendor.pagination.bootstrap-4') }}
        </div>

        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Código</th>
                    <th scope="col">Projeto</th>
                    <th scope="col">Revisado</th>
                    <th scope="col">Valor</th>
                    <th scope="col">Fase</th>
                    <th scope="col">Estágio</th>
                    <th scope="col">Segmento</th>
                </tr>
            </thead>
            <tbody>
                @forelse($works as $work)
                    <tr class="
                        @if($work && $work->segment_description == 'INDUSTRIAL') industrial @endif
                        @if($work && $work->segment_description == 'RESIDENCIAL') residencial @endif
                        @if($work && $work->segment_description == 'COMERCIAL') comercial @endif
                    ">
                        <td style="cursor: pointer;">
                            <div style="cursor: pointer;">
                                <div class="form-check">
                                    <input
                                        class="form-check-input work-checkbox"
                                        type="checkbox"
                                        name="works_selected[]"
                                        value="{{ $work->id }}"
                                        id="flexCheckDefault{{$loop->index}}"
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
                        <td>{{ \Carbon\Carbon::parse($work->last_review)->format('d/m/Y') }}</td>
                        <td>R$ {{ convertDecimalToBRL($work->price )}}</td>
                        <td>{{ $work->phase_description }}</td>
                        <td>{{ $work->stage_description }}</td>
                        <td>{{ $work->segment_description }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8">
                            <p class="text-center mb-0 py-4">
                                Nenhuma obra encontrada com base nos critérios selecionados.
                            </p>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </form>

    <div>
        {{ $works->appends(request()->input())->links('vendor.pagination.bootstrap-4') }}
    </div>
</div>
@endsection

@push('styles')

    <style>
        .industrial{
            background: #acc4d0;

        }
        .comercial{
            background: #b5b253;
        }
        .residencial{
            background: #ccb364;
        }
    </style>

@endpush

@push('scripts')

    <script>
        $(document).ready(function () {
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

        function toggleCheckboxes() {

            let workIds = [];
            let selectAll = false;
            var checkboxes = document.querySelectorAll('input[type="checkbox"]');
            var allChecked = true;

            checkboxes.forEach(function (checkbox) {
                if (! checkbox.checked) {
                    allChecked = false;
                }
                workIds = [];
            });

            checkboxes.forEach(function (checkbox) {
                checkbox.checked = ! allChecked;

                if (checkbox.checked) {
                    selectAll = true;
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
                    is_all_works_checked: selectAll,
                },
                success: function (return_data) {
                    // console.log(return_data)
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
            })
        }
    </script>

@endpush