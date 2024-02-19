@extends('layouts.app_customer')

@section('content')

    <div class="row mt-5" style="background:#ff7a00; border-top-left-radius: 20px; border-top-right-radius: 20px;">
        <div class="col-md-12 pt-2">
        <p class="text-center"><strong>SIG - EMPRESAS</strong></p>
        </div>
    </div>

    <div class="row pt-2 bg-light">
        <div class="col-md-12">
            <form action="{{ route('sig_companies.report') }}" id="formulario" method="get">
                @csrf

                <div class="row">
                    <div class="col-md-12">
                        <label class="form-label"><strong>Nome da empresa</strong></label>
                        <input type="text" class="form-control" name="trading_name" value="">
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
                document.getElementById('formulario').action = "{{ route('sig_companies.summary') }}";
            });

            // Adicione um ouvinte de evento de clique ao botão "Pesquisar"
            document.getElementById('gerar-relatorio').addEventListener('click', function() {
                // Redireciona o formulário para a rota desejada
                document.getElementById('formulario').action = "{{ route('sig_companies.report') }}";
            });
        });
    </script>

@endsection
