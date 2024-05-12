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

        @foreach($knows as $know)

        @endforeach


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