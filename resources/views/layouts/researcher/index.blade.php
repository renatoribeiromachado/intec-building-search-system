@extends('layouts.app_customer')

@section('content')

    <div class="bg-light p-5 rounded">
        <h1>LISTA DE PESQUISADORES</h1>

        <div>
            <form action="{{ route('researcher.index') }}" method="get">
                <div class="row mb-3">
                    <div class="form-group col">
                        <label for="name">Nome</label>
                        <input
                            type="text" id="name" name="name"
                            class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}"
                            value="{{ old('name', request()->name) }}" placeholder="ex: TS"
                            >
                    </div>

                    <div class="form-group col">
                        <button type="submit" class="btn btn-success btn mt-4 me-1">
                            <i class="fa fa-search"></i> Pesquisar
                        </button>

                        <a
                            href="{{ route('researcher.index') }}"
                            class="btn btn-warning btn mt-4"
                            title="Limpar a pesquisa"
                            >
                            <i class="fa fa-eraser"></i> Limpar
                        </a>
                    </div>
                </div>
            </form>
        </div>

        <div class="">
            <a class="btn btn-primary float-end"
                href="{{ route('researcher.create') }}"
                >
                Novo Cadastro
            </a>
        </div>

        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Descrição</th>
                    <th scope="col">Ações</th>
                </tr>
            </thead>
            <tbody>
                @forelse($researchers as $researcher)
                    <tr>
                        <th scope="row" style="width:5%;">{{ $researcher->id }}</th>
                        <td>{{ $researcher->name }}</td>
                        <td style="width:15%;">
                            <a
                                href="{{ route('researcher.edit', $researcher->id) }}"
                                class="btn btn-sm btn-outline-success me-1"
                                >
                                Editar
                            </a>

                            <a
                                href="#"
                                class="btn btn-sm btn-outline-danger"
                                data-bs-toggle="modal"
                                data-bs-target="#deleteResearcher{{$loop->index}}"
                                >
                                Excluir
                            </a>

                            <!-- Modal -->
                            <div class="modal fade"
                                id="deleteResearcher{{$loop->index}}"
                                data-bs-backdrop="static"
                                data-bs-keyboard="false"
                                tabindex="-1"
                                aria-labelledby="deleteResearcherLabel"
                                aria-hidden="true"
                                >
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="deleteResearcherLabel">Excluir Registro</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>

                                        <div class="modal-body">
                                            <div class="text-center">
                                                Tem certeza que deseja excluir o registro do(a) pesquisador(a): <br>
                                                <strong class="text-danger">{{ $researcher->name }}</strong>?
                                            </div>
                                        </div>

                                        <div class="modal-footer">
                                            <button type="button"
                                                class="btn btn-outline-secondary"
                                                data-bs-dismiss="modal"
                                                >
                                                Fechar
                                            </button>

                                            <form action="{{ route('researcher.destroy', $researcher->id) }}" method="post">
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

        <div>
            {{ $researchers->appends(request()->input())->links('vendor.pagination.bootstrap-4') }}
        </div>
    </div>
@endsection
