<x-app-layout>

    @section('content')

    @php
        $tabindex = 1
    @endphp

    <nav aria-label="breadcrumb" class="pt-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Funções Administrativas</li>
        </ol>
    </nav>

    <div class="max-w-full text-right py-4 lg:px-4">
        <a data-toggle="modal" data-target="#createRoleModal" title="Nova Função Administrativa" class="btn btn-link" tabindex="{{ $tabindex++ }}">
            <x-jet-button>
                {{ __('Adicionar') }}
            </x-jet-button>
        </a>
    </div>

    <div class="bg-white sm:rounded-lg max-w-full mx-auto mb-5 py-10 lg:px-8 shadow-md">
        <table class="table table-hover">

            <thead>
                <th>DESCRIÇÃO</th>
                <th>PERMISSÕES</th>
                <th class="text-center" style="width: 233px;">AÇÃO</th>
            </thead>
        
            <tbody>
        
                @foreach ($roles as $role)
        
                    <tr>
                        <td style="width: 200px;vertical-align:top!important;">
                            {{ $role->name }}
                        </td>
                        <td>
                            <p>Pode:</p>
                            <ul>
                                @foreach ($role->permissions as $perm)
        
                                    @if($loop->index % 20 == 0)
                                        </ul>
                                        <ul class="float-left">
                                    @endif
                                    
                                    <li>{{ $perm->name }}</li>
        
                                @endforeach
                            </ul>
                        </td>
                        <td class="text-center" style="width: 250px;vertical-align:top!important;">
                            {{-- @can('ver-lista-de-permissoes', $permission) --}}
                                <a class="btn text-warning btn-md" href="{{ route('role.perm.edit', ['id' => $role->id]) }}" 
                                    title="Editar Permissões" tabindex="{{ $tabindex++ }}">
                                    <svg width="1.5em" height="1.5em" viewBox="0 0 16 16" class="bi bi-lock" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" d="M11.5 8h-7a1 1 0 0 0-1 1v5a1 1 0 0 0 1 1h7a1 1 0 0 0 1-1V9a1 1 0 0 0-1-1zm-7-1a2 2 0 0 0-2 2v5a2 2 0 0 0 2 2h7a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2h-7zm0-3a3.5 3.5 0 1 1 7 0v3h-1V4a2.5 2.5 0 0 0-5 0v3h-1V4z"/>
                                    </svg>
                                </a>
                            {{-- @endcan --}}
        
                            {{-- @can('editar-funcao-administrativa', $permission) --}}
                                <a data-toggle="modal" data-target="#editRoleModal{{ $loop->iteration }}" class="btn text-primary btn-md" title="Remover Função Administrativa" tabindex="{{ $tabindex++ }}">
                                    <svg width="1.5em" height="1.5em" viewBox="0 0 16 16" class="bi bi-pencil" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5L13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175l-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z"/>
                                    </svg>
                                </a>
                            {{-- @endcan --}}
        
                            {{-- @can('excluir-funcao-administrativa', $permission) --}}
                                <a data-toggle="modal" data-target="#deleteRoleModal{{ $loop->iteration }}" class="btn text-danger btn-md" title="Remover Função Administrativa" tabindex="{{ $tabindex++ }}">
                                    <svg width="1.5em" height="1.5em" viewBox="0 0 16 16" class="bi bi-trash" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                                        <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4L4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                                    </svg>
                                </a>
                            {{-- @endcan --}}

                            <!-- Modal to add Role -->
                            <div class="modal fade" id="createRoleModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title text-center" id="myModalLabel">
                                                <span><strong>Nova Função Administrativa</strong></span>
                                            </h5>

                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>

                                        <div class="modal-body">
                                            <form action="{{ route('role.store', ['role' => $role->uuid]) }}" method="post">
                                                @csrf

                                                <input type="text" id="name" name="name" class="form-control" placeholder="ex: Corretor">
                                                
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
                            <!-- /.modal Modal to add Role -->

                            <!-- Modal to edit Role -->
                            <div class="modal fade" id="editRoleModal{{ $loop->iteration }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title text-center" id="myModalLabel">
                                                <span><strong>Editar Função Administrativa</strong></span>
                                            </h5>

                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>

                                        <div class="modal-body">
                                            <form action="{{ route('role.update', ['role' => $role->uuid]) }}" method="post">
                                                @csrf
                                                @method('PUT')

                                                <input type="text" id="name" name="name" class="form-control" value="{{ old('name', $role->name) }}" placeholder="ex: Corretor">
                                                
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
                            <!-- /.modal Modal to edit Role -->
        
                            <!-- Modal to delete roles -->
                            <div class="modal fade" id="deleteRoleModal{{ $loop->iteration }}" tabindex="-1" role="dialog">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
        
                                        <div class="modal-header">
                                                
                                            <h5 class="modal-title" id="myModalLabel">
                                                <span style="color:#ac2925;"><strong>ATENÇÃO!</strong></span>
                                            </h5>
        
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
        
                                        </div>
        
                                        <div class="modal-body text-center">
        
                                            Você deseja realmente <strong style="color: #ac2925;">excluir</strong> 
                                            a função administrativa <br>
                                            <strong style="color: #ac2925;">{{ $role->name }}</strong>?
        
                                        </div>
        
                                        <div class="modal-footer">
        
                                            {{-- @can('excluir-funcao-administrativa', $permission) --}}
        
                                            <form action="{{ route('role.destroy', ['role' => $role->uuid]) }}" method="post">
                                                @csrf
                                                @method('DELETE')
        
                                                <button type="submit" class="btn btn-danger" role="button">
                                                    Excluir
                                                </button>
        
                                                <button type="button" class="btn btn-default" data-dismiss="modal">
                                                    Cancelar
                                                </button>
        
                                                <input type="hidden" name="role_id" value="{{ $role->id }}">
                                                {{ csrf_field() }}
        
                                            </form>
        
                                            {{-- @else
        
                                            <a href="#" class="btn btn-default" data-dismiss="modal" role="button">
                                                Cancelar
                                            </a>
        
                                            @endcan --}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /.modal Modal to delete roles -->
                        </td>
                    </tr>
        
                @endforeach
            </tbody>
        </table>
        
        <div class="panel-footer text-center">
            {{ $roles->appends(request()->input())->links() }}
        </div>
    </div>
</x-app-layout>