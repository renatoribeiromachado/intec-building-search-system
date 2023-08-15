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
                    <th scope="col">SIG</th>
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
                                {{-- <input class="form-check-input" type="checkbox" name="works_selected[]" value="{{ $work->id }}" id="flexCheckDefault{{$loop->index}}">
                                <label class="form-check-label" for="flexCheckDefault{{$loop->index}}">
                                    {{ $work->old_code }}
                                </label> --}}
                            </div>
                        </div>
                    </td>
                    <td>{{ $work->name }}</td>
                    <td>
                        @if(isset($work->last_review))
                        {{ \Carbon\Carbon::parse($work->last_review)->format('d/m/Y') }}
                        @endif
                    </td>
                    <td>R$ {{ convertDecimalToBRL($work->price )}}</td>
                    <td>{{ $work->phase_description }}</td>
                    <td>{{ $work->stage_description }}</td>
                    <td>{{ $work->segment_description }}</td>
                    <td>
                        <a href="" data-bs-toggle="modal" data-bs-target="#sig" data-work-id="{{ $work->id }}" data-code="{{ $work->old_code }}">
                            <i class="fa fa-check"></i>
                        </a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="8">
                        <p class="text-center mb-0 py-4">
                            Nenhum registro de obra encontrado.
                        </p>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </form>
    <!-- The Modal -->
    <div class="modal" id="sig">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Cadstro de SIG-Obra</h4>
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
                        <input type="hidden" name="code" value="" id="modal-code-input">
                        <div class="row">
                            <div class="col-md-4">
                                <label>Agendar para</label>
                                <input type="text" name="appointment_date" class="form-control datepicker" value="">
                            </div>
                            <div class="col-md-4">
                                <label>Prioridade</label>
                                <select name="priority" class="form-select">
                                    <option value="Baixa">Baixa</option>
                                    <option value="Média">Média</option>
                                    <option value="Alta">Alta</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label>Status</label>
                                <select name="status" class="form-select">
                                    <option value="Em contato">Em contato</option>
                                    <option value="Em negociação">Em negociação</option>
                                    <option value="Pedido efetivado">Pedido efetivado</option>
                                    <option value="Proposta enviada">Proposta enviada</option>
                                    <option value="Sem interesse">Sem interesse</option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <label>Descriçao</label>
                                <textarea name="note" class="form-control" rows="5"></textarea>
                            </div>
                        </div>
                        
                        <!-- Modal footer -->
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Fechar</button>
                            <button type="submit" class="btn btn-primary">Cadastrar</button>
                        </div>
                        
                    </form>
                </div>
                
            </div>
        </div>
    </div>
    <script>
    document.addEventListener('DOMContentLoaded', function () {
        const sigLinks = document.querySelectorAll('a[data-bs-target="#sig"]');
        const modalCode = document.getElementById('modal-code');
         const modalWorkIdInput = document.getElementById('modal-work-id-input');
        const modalCodeInput = document.getElementById('modal-code-input');

        sigLinks.forEach(link => {
            link.addEventListener('click', function (event) {
                event.preventDefault();
                const workId = this.getAttribute('data-work-id');
                const Code = this.getAttribute('data-code');
                modalCode.textContent = Code;
                modalWorkIdInput.value = workId;
                modalCodeInput.value = Code;
            });
        });
    });
    </script>
    <div>
        {{ $works->appends(request()->input())->links('vendor.pagination.bootstrap-4') }}
    </div>
</div>
@endsection

@push('styles')
    <style>
        .industrial {
            background: #acc4d0;
        }
        .comercial {
            background: #b5b253;
        }
        .residencial {
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
            ? 'Deselecionar Todos' : 'Selecionar Todos';

        function toggleCheckboxes() {

            let workIds = [];
            let checkboxes = document.querySelectorAll('input[type="checkbox"]');
            let allChecked = true;

            checkboxes.forEach(function (checkbox) {
                if (! checkbox.checked) {
                    allChecked = false;
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
            button.textContent = allChecked ? 'Selecionar Todos' : 'Deselecionar Todos';
            // avoid the error maximum call stack size exceeded
            button.addEventListener("click", function(event){
                event.preventDefault()
            });
        }
    </script>

@endpush
