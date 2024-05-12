@extends('layouts.app_customer_create')

@section('content')

<div class="container bg-light p-5 rounded">
    <div class='container'>
        @include('layouts.alerts.success')
        <div class='row'>
            <div class='col-md-12'>
                <div class='alert alert-info'>
                    <h3> <i class='fa fa-exclamation'></i> Saiba mais</h3>
                    <p>
                        <a href="#" class="btn btn-outline-primary me-1 edit-btn" data-bs-toggle="modal" data-bs-target="#create">
                            Cadastrar
                        </a>
                    </p>
                </div>
            </div>
        </div>

        <div class='row'>
            <div class='col-md-12'>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Titulo</th>
                            <th>Descrição</th>
                            <th>Foto</th>
                            <th>Editar</th>
                            <th>Excluir</th>
                        </tr>
                    </thead>
                    <tbody>
                       
                        @foreach($knows as $know)
                            <tr>
                                <td>{{ $know->title }}</td>
                                <td>{{ $know->description }}</td>
                                <td><img src="{{ url("storage/{$know->image}") }}" class="img-thumbnail img-fluid shadow" alt="{{ $know->title }}" style="max-width: 110px;"> </td>
                                <td>
                                    <a href="#" class="btn btn-outline-success me-1 edit-btn"
                                        data-bs-toggle="modal" data-bs-target="#update"
                                        data-id="{{ $know->id }}"
                                        data-title="{{ $know->title }}"
                                        data-description="{{ $know->description }}"><i class="fa fa-edit"></i>
                                    </a>
                                <td>
                                    <form action="{{ route('knowMore.destroy', $know->id) }}" method="POST" onsubmit="return confirm('Tem certeza que deseja deletar?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger shadow"><i class="fa fa-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                       
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Alterar -->
        <div class="modal fade" id="update">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form  action="{{ route('knowMore.update') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <!-- Modal Header -->
                        <div class="modal-header bg-info">
                            <h5 class="modal-title">Você confirma essa atualização?</h5>
                        </div>
                        <!-- Usado para edição, pois estou usando modal -->
                        <input type="hidden" id="id" name="id" class="form-control" value="">

                        <!-- Modal body -->
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-sm-6">
                                    <label class="control-label"> Foto</label>
                                    <input name="image" class="form-control" type="file">
                                </div>
                                <div class="col-sm-6">
                                    <label class="control-label"> Titulo</label>
                                    <input name="title" class="form-control" id="title" type="text" required>
                                </div>
                            </div>
                            <div class="row pt-2">
                                <div class="col-sm-12">
                                    <label class="control-label"> Descrição</label>
                                    <textarea name="description"  id="description" rows="4" class="form-control"></textarea>
                                        
                                </div>
                            </div>
                        </div>

                        <!-- Modal footer -->
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Fechar</button>
                            <button type="submit" class="btn btn-success" id="saveChangesBtnQtd">Confirmar atualização</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        
        <script>
        document.addEventListener("DOMContentLoaded", function() {
                // Seleciona todos os botões de edição
                var editButtons = document.querySelectorAll('.edit-btn');

                // Adiciona um evento de clique para cada botão de edição
                editButtons.forEach(function(button) {
                    button.addEventListener('click', function() {
                        let id = this.getAttribute('data-id');
                        let title = this.getAttribute('data-title');
                        let description = this.getAttribute('data-description');

                        document.getElementById('id').value = id;
                        document.getElementById('title').value = title;
                        document.getElementById('description').value = description;
                    });
                });
            });
        </script>

        <!--MODAL CREATE-->
        <div class="modal fade" id="create" tabindex="-1" role="dialog" aria-labelledby="formCreated">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-primary">
                        <h5 class="modal-title" id="formUpdate">Cadastrar</h5>
                    </div>
                    <div class="modal-body">

                        <form id="createForm" action="{{ route('knowMore.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-sm-6">
                                    <label class="control-label"> Foto</label>
                                    <input name="image" class="form-control" type="file" required>
                                </div>
                                <div class="col-sm-6">
                                    <label class="control-label"> Titulo</label>
                                    <input name="title" class="form-control" type="text" required>
                                </div>
                            </div>
                            <div class="row pt-2">
                                <div class="col-sm-12">
                                    <label class="control-label"> Descrição</label>
                                    <textarea name="description" rows="4" class="form-control"></textarea>
                                        
                                </div>
                            </div>
                            <div class="modal-footer">
                                <div class="col-sm-12">
                                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Fechar</button>
                                    <input type="submit" class="btn btn-primary" value="Cadastrar" id="saveChangesBtn" />
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection