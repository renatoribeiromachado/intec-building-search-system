@extends('layouts.app_customer')

@section('content')
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Permissões') }}
        </h2>
    </x-slot>

    @section('content')

    <div class="bg-light p-5 rounded">
        <h1>PERMISSÕES</h1>

        @php
            $tabindex = 1
        @endphp
        

        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Descrição</th>
                    {{-- <th scope="col" class="text-center">Ação</th> --}}
                </tr>
            </thead>
            <tbody>
                @foreach ($permissions as $permission)
                    <tr>
                        <td>{{ $permission->name }}</td>
                        {{-- <td class="text-center">
                            <a data-toggle="modal" data-target="#editPermissionModal{{ $loop->iteration }}" title="Editar Permissão" class="btn btn-link" tabindex="{{ $tabindex++ }}">
                                <svg width="1.8em" height="1.8em" viewBox="0 0 16 16" class="bi bi-pencil-square text-info" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456l-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                    <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                                </svg>
                            </a>

                            <a data-toggle="modal" data-target="#deletePermissionModal{{ $loop->iteration }}" title="Deletar Permissão" class="btn btn-link" tabindex="{{ $tabindex++ }}">
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
                            <!-- /.modal Modal to add Permission -->

                            <!-- Modal to edit Permission -->
                            <div class="modal fade" id="editPermissionModal{{ $loop->iteration }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
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
