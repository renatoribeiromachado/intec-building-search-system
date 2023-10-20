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
            <form action="{{ route('sig_works.report') }}" id="formulario" method="get">
                @csrf
                @method('GET')

                <div class="row">
                    <div class="col-md-12">
                        <label class="form-label"><strong>Código da obra</strong></label>
                        <input type="text" class="form-control" name="code" value="">
                    </div>
                </div>

                <div class="row mt-2">
                    <div class="col-md-6">
                        <label class="form-label"><strong>Nome do relator</strong></label>
                        <select name="reporters[]" class="form-select" multiple size="2"
                        style="height: 90px;"
                        >
                            @foreach ($associates as $contact)
                                @if ($loop->iteration == 1)
                                <option value="">--Selecione--</option>
                                @endif

                                @if (authUserIsAnAssociate())
                                <option value="{{ $contact->user->id }}">{{ $contact->user->name }}</option>
                                @endif

                                @if (! authUserIsAnAssociate())
                                <option value="{{ $contact->id }}">{{ $contact->name }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6">
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label">
                                    <strong>Prioridade</strong>
                                </label>
                                <select name="priority" class="form-select">
                                    @foreach ($priorities as $priority)
                                        @if ($loop->iteration == 1)
                                        <option value="">--Selecione--</option>
                                        @endif

                                        <option value="{{ $priority }}">
                                            {{ $priority }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">
                                    <strong>Status</strong>
                                </label>
                                <select name="status" class="form-select">
                                    @foreach ($statuses as $status)
                                        @if ($loop->iteration == 1)
                                        <option value="">--Selecione--</option>
                                        @endif

                                        <option value="{{ $status }}">
                                            {{ $status }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
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
                {{--
                <div class="row mt-2">
                    <div class="col-md-12">
                        <label class="form-label"><strong>Descrição</strong></label>
                        <textarea name="notes" class="form-control" rows="5"></textarea>
                    </div>
                </div>
                --}}
                
                <div class="modal-footer">
                    @can('ver-resumo-sig')
                        <button type="submit" class="btn btn-info" id="gerar-resumo">Gerar resumo</button>
                    @endcan
                    <button type="submit" class="btn btn-primary" id="gerar-relatorio">Gerar relatório</button>
                </div>

            </form>
        </div>
    </div>
    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Adicione um ouvinte de evento de clique ao botão "Salvar Pesquisa"
            document.getElementById('gerar-resumo').addEventListener('click', function() {
                // Redireciona o formulário para a rota desejada
                document.getElementById('formulario').action = "{{ route('sig_works.summary') }}";
            });

            // Adicione um ouvinte de evento de clique ao botão "Pesquisar"
            document.getElementById('gerar-relatorio').addEventListener('click', function() {
                // Redireciona o formulário para a rota desejada
                document.getElementById('formulario').action = "{{ route('sig_works.report') }}";
            });
        });
    </script>

</div>
@endsection
