@extends('layouts.app_customer')

@section('content')

    <div class="bg-light p-5 rounded">
        <h1>LISTA DE USUÁRIOS</h1>

        <div>
            <form action="{{ route('user.index') }}" method="get">
                <div class="row mb-3">
                    <div class="form-group col">
                        <label for="inputPassword4">Nome</label>
                        <input
                            type="text" id="name" name="name"
                            class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}"
                            value="{{ old('name', request()->name) }}" placeholder="ex: Fabrício Oliveira"
                            >
                    </div>

                    <div class="form-group col">
                        <label for="inputEmail4">E-mail</label>
                        <input
                            type="text" id="email" name="email"
                            class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}"
                            value="{{ old('email', request()->email) }}" placeholder="ex: fabricio.oliveira@outlook.com"
                            >
                    </div>

                    <div class="form-group col">
                        <button type="submit" class="btn btn-success btn mt-4 me-1">
                            <i class="fa fa-search"></i> Pesquisar
                        </button>

                        <a
                            href="{{ route('user.index') }}"
                            class="btn btn-warning btn mt-4"
                            title="Limpar a pesquisa"
                            >
                            <i class="fa fa-eraser"></i> Limpar
                        </a>
                    </div>
                </div>
            </form>
        </div>

        @can('criar-usuario')
            <div class="">
                <a class="btn btn-primary float-end"
                    href="{{ route('user.create') }}"
                    >
                    Novo Cadastro
                </a>
            </div>
        @endcan

        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nome</th>
                    <th scope="col">E-mail</th>
                    <th scope="col">Perfil</th>
                    <th scope="col">Situação</th>
                    <th scope="col">Ações</th>
                </tr>
            </thead>
            <tbody>
                @forelse($users as $user)
                    <tr>
                        <th scope="row">{{ $user->id }}</th>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->role->name }}</td>
                        <td>
                            @if((bool) $user->is_active)
                                Ativo
                            @else
                                Inativo
                            @endif
                        </td>
                        <td style="width:15%;">
                            <a
                                href="{{ route('user.edit', $user->id) }}"
                                class="btn btn-sm btn-outline-success me-2"
                                >
                                Editar
                            </a>

                            @can('excluir-usuario')
                                @if ($user->role->name != 'Webmaster' && $user->role->name != 'Suporte')
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
                                                        Tem certeza que deseja excluir o registro do usuário: <br>
                                                        <strong class="text-danger">{{ $user->name }}</strong>?
                                                    </div>
                                                </div>

                                                <div class="modal-footer">
                                                    <button type="button"
                                                        class="btn btn-outline-secondary"
                                                        data-bs-dismiss="modal"
                                                        >
                                                        Fechar
                                                    </button>

                                                    <form action="{{ route('user.destroy', $user->id) }}" method="post">
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
                                @endif
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
            {{ $users->appends(request()->input())->links('vendor.pagination.bootstrap-4') }}
        </div>
    </div>
@endsection
