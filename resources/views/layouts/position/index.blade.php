@extends('layouts.app_customer')

@section('content')

    <div class="bg-light p-5 rounded">
        <h1>LISTA DE CARGOS</h1>

        <div>
            <form action="{{ route('position.index') }}" method="get">
                <div class="row mb-3">
                    <div class="form-group col">
                        <label for="inputEmail4">Descrição</label>
                        <input
                            type="text" id="description" name="description"
                            class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}"
                            value="{{ old('description', request()->description) }}" placeholder="ex: COMPRADOR GERAL"
                            >
                    </div>

                    <div class="form-group col">
                        <button type="submit" class="btn btn-success btn mt-4 me-1">
                            <i class="fa fa-search"></i> Pesquisar
                        </button>

                        <a
                            href="{{ route('position.index') }}"
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
                href="{{ route('position.create') }}"
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
                @forelse($positions as $position)
                    <tr>
                        <th scope="row" style="width:5%;">{{ $position->id }}</th>
                        <td>{{ $position->description }}</td>
                        <td style="width:15%;">
                            <a
                                href="{{ route('position.edit', $position->id) }}"
                                class="btn btn-sm btn-outline-success me-1"
                                >
                                Editar
                            </a>

                            @can('excluir-cargo')
                                <a
                                    href="#"
                                    class="btn btn-sm btn-outline-danger"
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
                                    aria-labelledby="staticBackdropLabel{{$loop->index}}"
                                    aria-hidden="true"
                                    >
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="staticBackdropLabel{{$loop->index}}">Excluir Registro</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>

                                            <div class="modal-body">
                                                <div class="text-center">
                                                    Tem certeza que deseja excluir o registro da cargo: <br>
                                                    <strong class="text-danger">{{ $position->description }}</strong>?
                                                </div>
                                            </div>

                                            <div class="modal-footer">
                                                <button type="button"
                                                    class="btn btn-outline-secondary"
                                                    data-bs-dismiss="modal"
                                                    >
                                                    Fechar
                                                </button>

                                                <form action="{{ route('position.destroy', $position->id) }}" method="post">
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

        <div>
            {{ $positions->appends(request()->input())->links('vendor.pagination.bootstrap-4') }}
        </div>
    </div>
@endsection
