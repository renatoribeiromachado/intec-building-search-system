@extends('layouts.app_customer_create')

@section('content')

    <div class="bg-light p-5 rounded">
        <h3>FILTRO DE EMPRESAS</h3>

        <div class="mt-4 p-5 text-black rounded" style="background: #e0e0e0;">
            <form action="{{ route('company.index') }}" method="get">
                <div class="row mb-3">
                    <div class="form-group col">
                        <label for="inputPassword4">CNPJ</label>
                        <input
                            type="text" id="cnpj" name="cnpj"
                            class="form-control cnpj {{ $errors->has('cnpj') ? 'is-invalid' : '' }}"
                            value="{{ old('cnpj', request()->cnpj) }}" placeholder="ex: 23.025.414/0001-23"
                            >
                    </div>

                    <div class="form-group col">
                        <label for="inputEmail4">Nome Fantasia</label>
                        <input
                            type="text" id="trading_name" name="trading_name"
                            class="form-control {{ $errors->has('trading_name') ? 'is-invalid' : '' }}"
                            value="{{ old('trading_name', request()->trading_name) }}" placeholder="ex: Minha Empresa"
                            >
                    </div>

                    <div class="form-group col">
                        <button type="submit" class="btn btn-success btn mt-4 me-1">
                            <i class="fa fa-search"></i> Pesquisar
                        </button>

                        <a
                            href="{{ route('company.index') }}"
                            class="btn btn-warning btn mt-4"
                            title="Limpar a pesquisa"
                            >
                            <i class="fa fa-eraser"></i>
                        </a>
                    </div>
                </div>
            </form>

            @can('importar-empresas')
                <form action="{{ route('company.import') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('post')
                    
                    <div class="row mb-3">
                        <div class="col-md-5 mb-2">
                            <label for="company_name">Planilha de Empresas</label>

                            <input
                                type="file"
                                name="file"
                                class="form-control"
                                style="min-width: 200px;margin-right:15px;"
                                required
                                >

                            {{-- <input type="text"
                                id="company_name"
                                name="company_name"
                                class="form-control @error('company_name') is-invalid @enderror"
                                value="{{ old('company_name', $company->company_name) }}"
                                placeholder=""
                                >
                            @error('company_name')
                                <div class="invalid-feedback">
                                    {{ $errors->first('company_name') }}
                                </div>
                            @enderror --}}
                        </div>
                        <div class="form-group col">
                            <button type="submit" class="btn btn-success btn mt-4 me-1">
                                <i class="fa fa-search"></i> Importar
                            </button>
                        </div>
                    </div>
                </form>
            @endcan
        </div>

        <div class="row mt-3 mb-2">
            <div class="col">
                <a class="btn btn-primary float-end"
                    href="{{ route('company.create') }}"
                    >
                    Novo Cadastro
                </a>
            </div>
        </div>

        @include('layouts.alerts.all-errors')

        <div class="table-responsive mt-4">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">CNPJ</th>
                        <th scope="col">Razão Social</th>
                        <th scope="col">Nome Fantasia</th>
                        <th scope="col">Atividade</th>
                        <th scope="col">Cidade</th>
                        <th scope="col">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($companies as $company)
                        <tr>
                            <th scope="row">{{ $company->id }}</th>
                            <td>{{ $company->cnpj }}</td>
                            <td>{{ $company->company_name }}</td>
                            <td>{{ $company->trading_name }}</td>
                            <td>{{ optional($company->activityField)->description }}</td>
                            <td>{{ $company->city }}</td>
                            <td style="width: 15%;">
                                <a
                                    href="{{ route('company.edit', $company->id) }}"
                                    class="btn btn-sm btn-outline-success me-1 mb-2"
                                    >
                                    Editar
                                </a>

                                @can('excluir-empresa')
                                    <a
                                        href="#"
                                        class="btn btn-sm btn-outline-danger mb-2"
                                        data-bs-toggle="modal"
                                        data-bs-target="#staticBackdrop{{$loop->index}}"
                                        >
                                        Excluir
                                    </a>

                                    <!-- Modal -->
                                    <div class="modal fade"
                                        id="staticBackdrop{{$loop->index}}"
                                        data-bs-backdrop="static"
                                        data-bs-keyboard="false"
                                        tabindex="-1"
                                        aria-labelledby="staticBackdropLabel"
                                        aria-hidden="true"
                                        >
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="staticBackdropLabel">Excluir Registro</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>

                                                <div class="modal-body">
                                                    <div class="text-center">
                                                        Tem certeza que deseja excluir o registro da empresa: <br>
                                                        <strong class="text-danger">{{ $company->company_name }}</strong>?
                                                    </div>
                                                </div>

                                                <div class="modal-footer">
                                                    <button type="button"
                                                        class="btn btn-outline-secondary"
                                                        data-bs-dismiss="modal"
                                                        >
                                                        Fechar
                                                    </button>

                                                    <form action="{{ route('company.destroy', $company->id) }}" method="post">
                                                        @csrf
                                                        @method('delete')

                                                        <button
                                                            type="submit"
                                                            class="btn btn-outline-danger"
                                                            >
                                                            Deletar
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div><!-- End the Modal -->
                                @endcan
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6">
                                <p class="text-center mb-0 py-4">
                                    Nenhum registro encontrado.
                                </p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <div>
            {{ $companies->appends(request()->input())->links('vendor.pagination.bootstrap-4') }}
        </div>
    </div>

@endsection
