@extends('layouts.app_customer_create')

@section('content')

<div class="container bg-light p-5 rounded">
    <div class='container'>
        @include('layouts.alerts.success')
        <div class='row'>
            <div class='col-md-12'>
                <div class='alert alert-info'>
                    <h3> <i class='fa fa-exclamation'></i> Resultado Mensal</h3>
                </div>
            </div>
        </div>

        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Obras novas e atualizadas</th>
                    <th>Residencial</th>
                    <th>Comercial</th>
                    <th>Industrial</th>
                    <th>Editar</th>
                </tr>
            </thead>
            <tbody>
                @foreach($mensalResults as $mensalResult)
                    <tr>
                        <td>{{ $mensalResult->new_works }}</td>
                        <td>{{ $mensalResult->residencial }}</td>
                        <td>{{ $mensalResult->comercial }}</td>
                        <td>{{ $mensalResult->industrial}}</td>
                        <td>
                            <a href="#" class="btn btn-outline-success me-1 edit-btn"
                                data-bs-toggle="modal" data-bs-target="#update"
                                data-id="{{ $mensalResult->id }}"
                                data-works="{{ $mensalResult->new_works }}"
                                data-residencial="{{ $mensalResult->residencial }}"
                                data-comercial="{{ $mensalResult->comercial }}"
                                data-industrial="{{ $mensalResult->industrial }}"><i class="fa fa-edit"></i>
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
                        <h5 class="modal-title" id="formUpdate">Cadastrazr</h5>
                    </div>
                    <div class="modal-body">

                        <form id="createForm" action="{{ route('mensalResult.store') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-sm-3">
                                    <label class="control-label"> OBRAS NOVAS E ATUALIZADAS</label>
                                    <input type="text" name="new_works" class="form-control" required>
                                </div>
                                <div class="col-sm-3">
                                    <label class="control-label"> Residencial</label>
                                    <input type="text" name="residencial" class="form-control" required>
                                </div>
                                <div class="col-sm-3">
                                    <label class="control-label"> Comercial</label>
                                    <input type="text" name="comercial" class="form-control" required>
                                </div>
                                <div class="col-sm-3">
                                    <label class="control-label"> Industrial</label>
                                    <input type="text" name="industrial" class="form-control" required>
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

        <!-- Alterar -->
        <div class="modal fade" id="update">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form  action="{{ route('mensalResult.update') }}" method="post">
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
                                <div class="col-sm-12">
                                    <label class="control-label"> OBRAS NOVAS E ATUALIZADAS</label>
                                    <input type="text" name="new_works" id="new_works" class="form-control" required>
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-sm-4">
                                    <label class="control-label"> Residencial</label>
                                    <input type="text" name="residencial" id="residencial" class="form-control" required>
                                </div>
                                <div class="col-sm-4">
                                    <label class="control-label"> Comercial</label>
                                    <input type="text" name="comercial" id="comercial" class="form-control" required>
                                </div>
                                <div class="col-sm-4">
                                    <label class="control-label"> Industrial</label>
                                    <input type="text" name="industrial" id="industrial" class="form-control" required>
                                </div>
                            <div>
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
                        let new_works = this.getAttribute('data-works');
                        let residencial = this.getAttribute('data-residencial');
                        let comercial = this.getAttribute('data-comercial');
                        let industrial = this.getAttribute('data-industrial');

                        document.getElementById('id').value = id;
                        document.getElementById('new_works').value = new_works;
                        document.getElementById('residencial').value = residencial;
                        document.getElementById('comercial').value = comercial;
                        document.getElementById('industrial').value = industrial;
                    });
                });
            });
        </script>

    </div>
</div>
@endsection