@extends('layouts.app_customer')

@section('content')

    <div class="bg-light p-5 rounded">
        <h1>LISTA DE PERFIS DE USUÁRIOS</h1>

        {{-- <div>
            <form action="{{ route('role.index') }}" method="get">
                <div class="row mb-3">
                    <div class="form-group col">
                        <label for="inputEmail4">Descrição</label>
                        <input
                            type="text" id="description" name="description"
                            class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}"
                            value="{{ old('description', request()->description) }}" placeholder="ex: Fase 1"
                            >
                    </div>

                    <div class="form-group col">
                        <button type="submit" class="btn btn-success btn mt-4 me-1">
                            <i class="fa fa-search"></i> Pesquisar
                        </button>

                        <a
                            href="{{ route('role.index') }}"
                            class="btn btn-warning btn mt-4"
                            title="Limpar a pesquisa"
                            >
                            <i class="fa fa-eraser"></i> Limpar
                        </a>
                    </div>
                </div>
            </form>
        </div> --}}

        @include('layouts.alerts.all-errors')
        @include('layouts.alerts.success')

        <div class="">
            <a class="btn btn-primary float-end"
                href="{{ route('role.create') }}"
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
                @forelse($roles as $role)
                    <tr>
                        <th scope="row" style="width:5%;">{{ $role->id }}</th>
                        <td>{{ $role->name }}</td>
                        <td style="width:15%;">
                            <a
                                href="{{ route('role.edit', $role->id) }}"
                                class="btn btn-sm btn-outline-success me-1"
                                >
                                Editar
                            </a>

                            @can('excluir-funcao-administrativa')
                                @if ($role->name != 'Webmaster')
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
                                                        Tem certeza que deseja excluir o registro do perfil: <br>
                                                        <strong class="text-danger">{{ $role->name }}</strong>?
                                                    </div>
                                                </div>

                                                <div class="modal-footer">
                                                    <button type="button"
                                                        class="btn btn-outline-secondary"
                                                        data-bs-dismiss="modal"
                                                        >
                                                        Fechar
                                                    </button>

                                                    <form action="{{ route('role.destroy', $role->id) }}" method="post">
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
                    <tr>
                        <td colspan="3">
                            <h4>Permissões:</h4>
                            <div class="row mb-3">
                                <div class="col">
                                    <a
                                        href="{{ route('role.permission.edit', $role->id) }}"
                                        class="btn btn-primary btn-sm"
                                        title="Editar permissões"
                                        >
                                        <i class="fa fa-eraser"></i> Editar Permissões
                                    </a>
                                </div>
                            </div>

                            {{-- <ul>
                                @foreach ($role->permissions as $permission)
                                <li>{{ $permission->name }}</li>
                                @endforeach
                            </ul> --}}


                            <ul>
                                @foreach ($role->permissions as $perm)
        
                                    @if($loop->index % 20 == 0)
                                        </ul>
                                        <ul class="float-start">
                                    @endif
                                    
                                    <li>{{ $perm->name }}</li>
        
                                @endforeach
                            </ul>
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
            {{ $roles->appends(request()->input())->links('vendor.pagination.bootstrap-4') }}
        </div>
    </div>
@endsection
