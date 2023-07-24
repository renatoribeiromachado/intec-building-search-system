@extends('layouts.app_customer')

@section('content')

    <div class="bg-light p-5 rounded">
        <h1>LISTA DE OBRAS</h1>

        {{-- <div>
            <form action="{{ route('work.index') }}" method="get">
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
                            href="{{ route('work.index') }}"
                            class="btn btn-warning btn mt-4"
                            title="Limpar a pesquisa"
                            >
                            <i class="fa fa-eraser"></i> Limpar
                        </a>
                    </div>
                </div>
            </form>
        </div> --}}

        <div class="">
            <a class="btn btn-primary float-end"
                href="{{ route('work.create') }}"
                >
                Novo Cadastro
            </a>
        </div>

        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Código Antigo</th>
                    <th scope="col">Projeto</th>
                    <th scope="col">Revisado em</th>
                    <th scope="col">Valor</th>
                    <th scope="col">Fase</th>
                    <th scope="col">Segmento</th>
                    <th scope="col">Ações</th>
                </tr>
            </thead>
            <tbody>
                @forelse($works as $work)
                    <tr>
                        <th scope="row">{{ $work->id }}</th>
                        <td>{{ $work->old_code }}</td>
                        <td>{{ $work->name }}</td>
                        <td>{{ optional($work->last_review)->format('d/m/Y') }}</td>
                        <td>{{ $work->price }}</td>
                        <td>{{ optional($work->phase)->description }}</td>
                        <td>{{ optional($work->segment)->description }}</td>
                        <td>
                            <a
                                href="{{ route('work.edit', $work->id) }}"
                                class="btn btn-sm btn-outline-success me-1"
                                >
                                Editar
                            </a>

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
                                                Tem certeza que deseja excluir o registro da obra: <br>
                                                <strong class="text-danger">{{ $work->name }}</strong>?
                                            </div>
                                        </div>

                                        <div class="modal-footer">
                                            <button type="button"
                                                class="btn btn-outline-secondary"
                                                data-bs-dismiss="modal"
                                                >
                                                Fechar
                                            </button>

                                            <form action="{{ route('work.destroy', $work->id) }}" method="post">
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
            {{ $works->appends(request()->input())->links('vendor.pagination.bootstrap-4') }}
        </div>
    </div>
@endsection
