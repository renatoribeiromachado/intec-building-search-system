@extends('layouts.app_customer_create')

@section('content')

<div class="container bg-light p-5 rounded">
    <div class='container'>
        @include('layouts.alerts.success')
        <div class='row'>
            <div class='col-md-12'>
                <div class='alert alert-info'>
                    <h3> <i class='fa fa-exclamation'></i> Resultado Trimestral</h3>
                    <p>
                        @can('cadastrar-resultado-trimestral')
                            <a href="#" class="btn btn-outline-primary me-1 edit-btn" data-bs-toggle="modal" data-bs-target="#create">
                                Cadastrar
                            </a>
                        @endcan
                    </p>
                </div>
            </div>
        </div>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Imagem</th>
                    <th>PDF</th>
                    <th>Editar</th>
                </tr>
            </thead>

            <tbody>
                @foreach($quarterlyResults as $quarterlyResult)
                    <tr>
                        <td><img src="{{ url("storage/{$quarterlyResult->image}") }}" class="img-thumbnail img-fluid shadow" alt="Resultado trimestral" style="max-width: 90px;"></td>
                        <td>{{ $quarterlyResult->pdf }}</td>
                        <td><a href="#" class="btn btn-outline-success me-1 edit-btn"
                                data-bs-toggle="modal" data-bs-target="#update"
                                data-id="{{ $quarterlyResult->id }}"><i class="fa fa-edit"></i>
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>


        <!--MODAL CREATE-->
        <div class="modal fade" id="create" tabindex="-1" role="dialog" aria-labelledby="formCreated">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-primary">
                        <h5 class="modal-title text-white" id="formUpdate">Cadastrar</h5>
                    </div>
                    <div class="modal-body">

                        <form id="createForm" action="{{ route('quarterlyResult.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-sm-6">
                                    <label class="control-label"> Foto</label>
                                    <input name="image" class="form-control" type="file" required>
                                </div>
                                <div class="col-sm-6">
                                    <label class="control-label"> PDF</label>
                                    <input name="pdf" class="form-control" type="file">
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

    <!-- Alterar -->
    <div class="modal fade" id="update">
        <div class="modal-dialog">
            <div class="modal-content">
                <form  action="{{ route('quarterlyResult.update') }}" method="post" enctype="multipart/form-data">
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
                                <label class="control-label"> PDF</label>
                                <input name="pdf" class="form-control" type="file">
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
                    document.getElementById('id').value = id;
        
                });
            });
        });
    </script>

</div>
@endsection