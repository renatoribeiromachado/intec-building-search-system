@extends('layouts.app_customer')

@section('content')

    <div class="bg-light p-5 rounded">
        <h1>LISTA DE PERMISSÕES</h1>
        
        @can('criar-permissao')
            <div class="">
                <button
                    data-bs-toggle="modal"
                    data-bs-target="#addPermission"
                    type="button"
                    class="btn btn-primary float-end"
                    >
                    Novo Cadastro
                </button>
            </div>
        @endcan

        @include('layouts.alerts.all-errors')
        @include('layouts.alerts.success')

        <!-- Modal to edit Permission -->
        <x-intec-modal
            id="addPermission"
            aria-labelledby="addPermissionLabel"
            route="{{ route('permission.store') }}"
            title="Adicionar Permissão"
            collection="{{ $permission }}"
            submit-button-class="btn btn-primary"
            submit-button-text="Salvar"
            size=""
            http-method="post"
            >
            <div class="container-fluid">
                <div class="container">
                    @include('layouts.forms.add_edit_permission')
                    {{-- resources/views/layouts/forms/add_edit_permission.blade.php --}}
                </div>
            </div>
        </x-intec-modal>

        <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Descrição</th>
                    <th scope="col" class="text-center">Ação</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($permissions as $permission)
                    <tr>
                        <th scope="row" style="width: 10px;">{{ $permission->id }}</th>
                        <td>{{ $permission->name }}</td>
                        <td class="width:15%;">
                            <div class="text-center">
                                <a
                                    data-bs-toggle="modal"
                                    data-bs-target="#editPermission{{ $loop->iteration }}"
                                    title="Editar Permissão"
                                    class="btn btn-outline-success"
                                    >
                                    Editar
                                </a>
                            </div>

                            {{-- <a data-toggle="modal" data-target="#deletePermissionModal{{ $loop->iteration }}" title="Deletar Permissão" class="btn btn-link" tabindex="{{ $tabindex++ }}">
                                <svg width="1.8em" height="1.8em" viewBox="0 0 16 16" class="bi bi-trash pl-1 text-danger" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                                    <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4L4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                                </svg>
                            </a>

                            <!-- Modal to add Permission -->
                            <div class="modal fade" id="createPermissionModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title text-center" id="myModalLabel">
                                                <span><strong>ADICIONAR PERMISSÃO</strong></span>
                                            </h5>

                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>

                                        <div class="modal-body">
                                            <form action="{{ route('permission.store', ['permission' => $permission->uuid]) }}" method="post">
                                                @csrf

                                                <input type="text" id="name" name="name" class="form-control" placeholder="ex: Ver Módulo" required>
                                                
                                                <div>
                                                    <div class="form-row">
                                                        <div class="form-group col-md-2 mr-4">
                                                            <button type="button" class="btn btn-default mt-4" data-dismiss="modal">
                                                                Cancelar
                                                            </button>
                                                        </div>
                                                        <div class="form-group col-md-2">
                                                            <button type="submit" class="btn btn-primary mt-4" role="button">
                                                                Adicionar
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /.modal Modal to add Permission --> --}}

                            <!-- Modal to edit Permission -->
                            <x-intec-modal
                                id="editPermission{{$loop->iteration}}"
                                aria-labelledby="editPermissionLabel{{$loop->iteration}}"
                                route="{{ route('permission.update', $permission->id) }}"
                                title="Atualizar Permissão"
                                collection="{{ $permission }}"
                                submit-button-class="btn btn-primary"
                                submit-button-text="Salvar"
                                size=""
                                http-method="put"
                                >
                                <div class="container-fluid">
                                    <div class="container">
                                        @include('layouts.forms.add_edit_permission')
                                        {{-- resources/views/layouts/forms/add_edit_permission.blade.php --}}
                                    </div>
                                </div>
                            </x-intec-modal>

                            {{--<div class="modal fade" id="editPermissionModal{{ $loop->iteration }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title text-center" id="myModalLabel">
                                                <span><strong>EDITAR PERMISSÃO</strong></span>
                                            </h5>

                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>

                                        <div class="modal-body">
                                            <form action="{{ route('permission.update', ['permission' => $permission->id]) }}" method="post">
                                                @csrf
                                                @method('PUT')

                                                <input type="text" id="name" name="name" class="form-control" value="{{ old('name', $permission->name) }}" placeholder="ex: Ver Módulo">
                                                
                                                <div>
                                                    <div class="form-row">
                                                        <div class="form-group col-md-2 ml-50 mr-4">
                                                            <button type="button" class="btn btn-default mt-4" data-dismiss="modal">
                                                                Cancelar
                                                            </button>
                                                        </div>
                                                        <div class="form-group col-md-2">
                                                            <button type="submit" class="btn btn-primary mt-4" role="button">
                                                                Salvar
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /.modal Modal to edit Permission -->

                            <!-- Modal to delete Permission -->
                            <div class="modal fade" id="deletePermissionModal{{ $loop->iteration }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title text-center" id="myModalLabel">
                                                <span style="color:#ac2925;"><strong>ATENÇÃO!</strong></span>
                                            </h5>

                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>

                                        <div class="modal-body text-center">
                                            Você deseja realmente <strong style="color:#ac2925;">excluir</strong> a permissão <br> 
                                            <strong style="color:#ac2925;">{{ $permission->name }}</strong>?
                                        </div>

                                        <div class="modal-footer">
                                            <form action="{{ route('permission.destroy', ['permission' => $permission->id]) }}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger" role="button">
                                                    Excluir
                                                </button>
                                                <button type="button" class="btn btn-default" data-dismiss="modal">
                                                    Cancelar
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /.modal Modal to delete Permission -->
                        </td> --}}
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="mt-4 text-center">
            {{ $permissions->appends(request()->input())->links('vendor.pagination.bootstrap-4') }}
        </div>
    </div>
@endsection
