@extends('layouts.app_customer_create')

@section('content')

    <div class="bg-light p-5 rounded">
        <h1>LISTA DE PERMISSÕES</h1>

        <div>
            <form action="{{ route('permission.index') }}" method="get">
                <div class="row mb-3">
                    <div class="col">
                        <x-intec-input
                            label-input-id="search_name"
                            label-text="Nome"
                            input-type="text"
                            input-name="search_name"
                            class-one=""
                            label-class="label-font-bold"
                            input-value="{{ request()->search_name }}"
                            :input-readonly="false"
                            placeholder="ex: Ver Lista de Obras ou apenas Lista de Obras"
                        />
                    </div>

                    <div class="col">
                        <button
                            type="submit"
                            class="btn btn-success btn mt-4 me-1"
                            >
                            <i class="fa fa-search"></i> Pesquisar
                        </button>

                        <a
                            href="{{ route('permission.index') }}"
                            class="btn btn-warning btn mt-4"
                            title="Limpar a pesquisa"
                            >
                            <i class="fa fa-eraser"></i> Limpar
                        </a>
                    </div>
                </div>
            </form>
        </div>
        
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
                        <th scope="row" style="width: 2%;">{{ $permission->id }}</th>
                        <td style="width:75%;">{{ $permission->name }}</td>
                        <td>
                            <div class="text-center">
                                <a
                                    data-bs-toggle="modal"
                                    data-bs-target="#editPermission{{ $loop->iteration }}"
                                    title="Editar Permissão"
                                    class="btn btn-sm btn-outline-success me-2"
                                    >
                                    Editar
                                </a>
    
                                <a
                                    data-bs-toggle="modal"
                                    data-bs-target="#deletePermission{{ $loop->iteration }}"
                                    title="Deletar Permissão"
                                    class="btn btn-sm btn-outline-danger"
                                    >
                                    Excluir
                                </a>
                            </div>

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
                                    </div>
                                </div>
                            </x-intec-modal>

                            <!-- Modal to delete Permission -->
                            <x-intec-modal
                                id="deletePermission{{$loop->iteration}}"
                                aria-labelledby="deletePermissionLabel{{$loop->iteration}}"
                                route="{{ route('permission.destroy', $permission->id) }}"
                                title="Excluir Permissão"
                                collection="{{ $permission }}"
                                submit-button-class="btn btn-danger"
                                submit-button-text="Deletar"
                                size=""
                                http-method="delete"
                                >
                                <div class="container-fluid">
                                    <div class="container">
                                        <div class="text-center">
                                            Tem certeza que deseja excluir o registro da permissão: <br>
                                            <strong class="text-danger">{{ $permission->name }}</strong>?
                                        </div>
                                    </div>
                                </div>
                            </x-intec-modal>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="mt-4 text-center">
            {{ $permissions->appends(request()->input())->links('vendor.pagination.bootstrap-4') }}
        </div>
    </div>
@endsection
