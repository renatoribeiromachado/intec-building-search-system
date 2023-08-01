@extends('layouts.app_customer')

@section('content')

<div class="bg-light p-5 rounded">
    <h1>OBRAS</h1>

    <form action="{{ route('work.search.step_three.index') }}" method="get">
        @csrf
        @method('get')

        <div class="row">
            <div class="col mt-3 mb-3 clearfix">
                <button type="submit" class="btn btn-success submit float-end" title="Pesquisar">
                    <i class="fa fa-search"></i> Pesquisar
                </button>
            {{-- </div> --}}

            {{-- <div class="col mt-3 mb-3 clearfix"> --}}
                <a href="{{ url()->full() }}"
                    class="btn btn-outline-success submit float-end me-3" title="Pesquisar">
                    <i class="fa fa-search"></i> Deselecionar Todos
                </a>
            </div>
        </div>

        <table class="table">
            <thead>
                <tr>
                    {{-- <th scope="col">#</th> --}}
                    {{-- <th scope="col">Código Antigo</th> --}}
                    <th scope="col">Projeto</th>
                    <th scope="col">Revisado em</th>
                    <th scope="col">Valor</th>
                    <th scope="col">Fase</th>
                    <th scope="col">Segmento</th>
                </tr>
            </thead>
            <tbody>
                @forelse($works as $work)
                    <tr>
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
                                        {{ $work->old_code }} {{ $work->name }}
                                    </label>
                                </div>
                            </div>
                        </td>
                        {{-- <td>{{ $work->old_code }}</td> --}}
                        {{-- <td>{{ $work->name }}</td> --}}
                        <td>{{ \Carbon\Carbon::parse($work->last_review)->format('d/m/Y') }}</td>
                        <td>R$ {{ convertDecimalToBRL($work->price )}}</td>
                        <td>{{ $work->phase_description }}</td>
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
