@extends('layouts.app_customer')

@section('content')

<div class="container bg-light p-5 rounded">
    <div class="row">
        <div class="col-md-12">
            <div class="alert alert-info"><h4>SIG - Associado <code>(exclusivo Intec)</code></h4></div>
        </div>
    </div>
  @include('layouts.alerts.success')
    <div class="row">
        <div class="col-md-12">
            <form action="{{ route('sig_associate.store') }}" method="post">
                @csrf

                <div class="row">
                    <div class="col-md-2">
                        <label class="form-label"><strong>Código do Associado</strong></label>
                        <input type="text" class="form-control" name="code_associate" value="">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label"><strong>Data de agendamento</strong></label>
                        <div class="input-group">
                            <div class="input-group-text">
                                <i class="fa fa-calendar"></i>
                            </div>
                            <input
                                type="text"
                                name="appointment_date"
                                class="form-control datepicker"
                                placeholder="Digite a data de agendamento..."
                                >
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
                    <button type="submit" class="btn btn-primary">Salvar</button>
                </div>
            </form>
        </div>
    </div>

</div>


@endsection
