@extends('layouts.app_customer')

@section('content')

<div class="container bg-light p-5 rounded">
    <div class="row">
        <div class="col-md-12">
            <div class="alert alert-primary"><h4>SIG - Obras</h4></div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <form action="{{ route('sig_works.report') }}" method="post">
                @csrf
                <div class="row">
                    <div class="col-md-12">
                        <label class="form-label"><strong>Código da obra</strong></label>
                        <input type="text" class="form-control" name="code" value="">
                    </div>
                </div>

                <div class="row mt-2">
                    <div class="col-md-6">
                        <label class="form-label"><strong>Nome do relator</strong></label>
                        <input type="text" class="form-control" name="reporter" value="">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label"><strong>Prioridade</strong></label>
                        <select name="priority" class="form-select">
                            <option value="">--Selecione--</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label"><strong>Status</strong></label>
                        <select name="status" class="form-select">
                            <option value="">--Selecione--</option>
                        </select>
                    </div>
                </div>

                <div class="row mt-2">
                    <div class="col-md-6">
                        <div class="input-group mb-3">
                            <div class="input-group-text">
                                <i class="fa fa-calendar"></i>
                            </div>
                            <input type="text" name="start_date" class="form-control datepicker" placeholder="Digite a data de cadastro de..">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="input-group mb-3">
                            <div class="input-group-text">
                                <i class="fa fa-calendar"></i>
                            </div>
                            <input type="text" name="end_date" class="form-control datepicker" placeholder="Digite a data de cadastro até..">
                        </div>
                    </div>
                </div>

                <div class="row mt-2">
                    <div class="col-md-12">
                        <label class="form-label"><strong>Descrição</strong></label>
                        <textarea name="notes" class="form-control" rows="5"></textarea>
                    </div>
                </div>
                
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Gerar relatório</button>
                </div>
            </form>
        </div>
    </div>

</div>


@endsection
