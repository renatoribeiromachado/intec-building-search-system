@extends('layouts.app_customer')

@section('content')

    <div class="bg-light p-5 rounded">
        <h1>LISTA DE EMPRESAS</h1>

        <div class="">
            <a class="btn btn-primary float-end"
                href="{{ route('company.create') }}"
                >
                Novo Cadastro
            </a>
        </div>

        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Razão Social</th>
                    <th scope="col">Nome Fantasia</th>
                    <th scope="col">CNPJ</th>
                    <th scope="col">Cidade</th>
                    <th scope="col">Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach($companies as $company)
                    <tr>
                        <th scope="row">{{ $company->id }}</th>
                        <td>{{ $company->company_name }}</td>
                        <td>{{ $company->trading_name }}</td>
                        <td>{{ $company->cnpj }}</td>
                        <td>{{ $company->city }}</td>
                        <td>
                            <a
                                href="{{ route('company.edit', $company->id) }}"
                                class="btn btn-sm btn-outline-success mr-2"
                                >
                                Editar
                            </a>

                            <a
                                href="#"
                                class="btn btn-sm btn-outline-danger"
                                data-bs-toggle="modal"
                                data-bs-target="#staticBackdrop"
                                >
                                Excluir
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Modal -->
        <div class="modal fade"
            id="staticBackdrop"
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
        </div>
    </div>
@endsection
