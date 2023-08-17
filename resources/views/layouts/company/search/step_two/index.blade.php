@extends('layouts.app_customer')

@section('content')
    <div class="container bg-light p-5 rounded">
        <div class="alert alert-primary">
            <h4>PESQUISA DE EMPRESAS</h4>
        </div>

        <form action="{{ route('company.search.step_three.index') }}" method="get">
            @csrf
            @method('get')

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
                {{-- onclick="toggleCheckboxes()" --}}
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
                    </tr>
                </thead>
                <tbody>
                    @forelse($companies as $company)
                    <tr>
                        <td style="cursor: pointer;">
                            <div style="cursor: pointer;">
                                <div class="form-check">
                                    <input
                                        class="form-check-input work-checkbox"
                                        type="checkbox"
                                        name="companies_selected[]"
                                        value="{{ $company->id }}"
                                        id="flexCheckDefault{{$loop->index}}"
                                        {{-- @if(collect($worksChecked)->contains($company->id))
                                        checked
                                        @endif --}}
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
                        <td>{{ $company->company_name }}</td>
                        <td>{{ $company->trading_name }}</td>
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
