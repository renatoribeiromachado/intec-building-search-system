@extends('layouts.app_customer')

@section('content')

<div class="container">
    @include('layouts.alerts.success')
    <div class="row mt-5">
        <div class="col-md-12">
            <table class="table table-borded">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nome</th>
                        <th scope="col">E-mail</th>
                        <th scope="col">Alterar Senha</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($user as $user)
                    <tr>
                        <th scope="row">{{ $user->id }}</th>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>
                            <a href="#" class="btn btn-outline-success me-1 edit-btn"
                                data-bs-toggle="modal" data-bs-target="#update"
                                data-id="{{ $user->id }}"><i class="fa fa-edit"></i>
                            </a>
                        </td>
                    <tr>
                        @endforeach
                </tbody>
            </table>
        </div>
    </div>
    
    <!--MODAL UPDATE-->
    <div class="modal fade" id="update" tabindex="-1" role="dialog" aria-labelledby="formUpdate">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-success">
                    <h5 class="modal-title" id="formUpdate">Alterar Senha</h5>
                </div>
                <div class="modal-body">

                    <form id="editForm" action="{{ route('user-password.updatePassword') }}" method="POST">

                        @method('PUT')
                        @csrf
                        
                        <input type="hidden" name="id" id="id" class="form-control" value="" required>
                        
                        <div class="row">
                            <div class="col-sm-12">
                                <label class="control-label"> Senha: <code>digite uma senha forte</code></label>
                                <input type="text" name="password"  class="form-control" value="" placeholder="Insira uma nova senha" required="">
                            </div>

                        </div>

                        <div class="modal-footer">
                            <div class="col-sm-12">
                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Fechar</button>
                                <input type="submit" class="btn btn-success" value="Atualizar" id="saveChangesBtn" />
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
    <script>
        // Aguarde o documento estar completamente carregado
        document.addEventListener('DOMContentLoaded', function () {
            // Adicione um ouvinte de evento de clique a todos os botões de edição
            var editButtons = document.querySelectorAll('.edit-btn');
            editButtons.forEach(function (button) {
                button.addEventListener('click', function () {
                    // Obtenha os valores dos atributos de dados do botão de edição clicado
                    var id = this.getAttribute('data-id');
                   
                    // Preencha os campos do modal com os valores obtidos
                    document.getElementById('id').value = id;

                });
            });
        });
    </script>
</div>
    @endsection
