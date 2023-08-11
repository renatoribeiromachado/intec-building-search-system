@extends('layouts.app_customer')

@section('content')

<div class="container bg-light p-5 rounded">
    <div class="alert alert-primary"><h4>PESQUISA DE OBRAS</h4></div>

    <form action="{{ route('work.search.step_three.index') }}" method="get">
        @csrf
        @method('get')

        <div class="row">
            <div class="col mt-3 mb-3">
                Resultados encontrados: &nbsp;
                <span class="fs-3">{{ $works->total() }}</span>
            </div>

            <div class="col mt-3 mb-3 clearfix">
                <button type="submit" class="btn btn-success submit float-end" title="Pesquisar">
                    <i class="fa fa-search"></i> Pesquisar
                </button>
                {{--
                <a href="{{ url()->full() }}"
                    class="btn btn-outline-success submit float-end me-3" title="Pesquisar">
                    <i class="fa fa-search"></i> Deselecionar Todos
                </a>--}}
            </div>
        </div>
        <script>
          function toggleCheckboxes() {
            var checkboxes = document.querySelectorAll('input[type="checkbox"]');
            var allChecked = true;

            checkboxes.forEach(function(checkbox) {
                if (!checkbox.checked) {
                    allChecked = false;
                }
            });

            checkboxes.forEach(function(checkbox) {
                checkbox.checked = !allChecked;
            });

            var button = document.getElementById('toggleButton');
            button.textContent = allChecked ? 'Selecionar Todos' : 'Deselecionar Todos';
        }
    </script>
    <!-- Botão para alternar entre selecionar e desmarcar todos os checkboxes -->
    
<button type="button" id="toggleButton" class="btn btn-primary" onclick="toggleCheckboxes()">Selecionar Todos</button>

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
                                        class="form-check-input"
                                        type="checkbox"
                                        name="works_selected[]"
                                        value="{{ $work->id }}"
                                        id="flexCheckDefault{{$loop->index}}">
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
                                Nenhum registro de obra encontrado.
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