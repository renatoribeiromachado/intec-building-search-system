@extends('layouts.app_customer')

@section('content')
    <div class="container">
        @include('layouts.alerts.success')
        @include('layouts.alerts.all-errors')
        <div class="row">
            <div class="table-responsive">
                <table class="table table-condensed">
                    <thead class="table-dark">
                        <tr>
                            <th>Criado em</th>
                            <th>Agendado para</th>
                            <th>Codigo da obra</th>
                            <th>Relator</th>
                            <th>Prioridade</th>
                            <th>Status</th>
                            <th>Editar</th>
                            <th>Excluir</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($reports as $report)
                            <tr>
                                <td>{{ $report->created_at->format('d/m/Y') }}</td>
                                <td>{{ optional($report->appointment_date)->format('d/m/Y') }}</td>
                                <td class="text-primary">
                                    @if ($report->work)
                                        {{ $report->work->old_code }}
                                    @else
                                    <p>{{ $report->work_id }} - Essa obra foi deletada da plataforma</p>
                                    @endif
                                </td>
                                <td>{{ $report->user->name }}</td>
                                <td>{{ $report->priority }}</td>
                                <td>{{ $report->status }}</td>

                                <td>
                                    <a href="#" class="btn btn-outline-success me-1 edit-btn"
                                       data-bs-toggle="modal" data-bs-target="#update"
                                       data-id="{{ $report->id }}"
                                       data-appointment="{{ $report->appointment_date }}"
                                       data-priority="{{ $report->priority }}"
                                       data-status="{{ $report->status }}"
                                       data-notes="{{ $report->notes }}"><i class="fa fa-edit"></i></a>
                                </td>
                                <td>
                                    <form action="{{ route('sig.destroy', $report->id) }}" method="POST" onsubmit="return confirm('Tem certeza que deseja deletar?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger shadow"><i class="fa fa-trash"></i></button>
                                    </form>
                                </td>
                            </tr>

                            @if ($report->notes)
                                <tr>
                                    <th>Descrição</th>
                                </tr>

                                <tr>
                                    <td colspan="6">{{ $report->notes }}</td>
                                </tr>

                                <tr>
                                    <td colspan="8" class="text-center pt-1" style="background: #000d37;"></td>
                                </tr>
                            @endif

                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-4">
                                    Nenhum SIG de obras encontrado.
                                </td>
                            </tr>
                        @endforelse

                    </tbody>
                </table>
            </div>
        </div>
        
        <!--MODAL UPDATE-->
    <div class="modal fade" id="update" tabindex="-1" role="dialog" aria-labelledby="formUpdate">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header bg-success text-white">
                    <h5 class="modal-title" id="formUpdate">Editando SIG</h5>
                </div>
                <div class="modal-body">

                    <form action="{{ route('sig.update') }}" method="POST">

                        @method('PUT')
                        @csrf
                        
                        <!--usado para edição, pois estou usando modal-->
                        <input type="hidden" id="id" name="id" class="form-control" value=""> 

                        <div class="row mt-2">
                            <div class="col-md-4">
                                <label class="control-label">Agendado para</label>   
                                <input type="text" name="appointment_date" id="appointment" class="form-control datepicker" value=""/>
                            </div>
                            <div class="col-md-4">
                                    <label for="priority">Prioridade</label>
                                    <select id="priority" name="priority" class="form-select">
                                        @foreach ($priorities as $priority)
                                            <option value="{{ $priority }}">{{ $priority }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-md-4">
                                    <label for="status">Status</label>
                                    <select id="status" name="status" class="form-select">
                                        @foreach ($statuses as $status)
                                            <option value="{{ $status }}">{{ $status }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        
                             <div class="row mt-2">
                                <div class="col-md-12">
                                    <label for="notes">Descriçao</label>
                                    <textarea id="notes" name="notes" class="form-control" rows="5"></textarea>
                                </div>
                            </div>
                        
                        <div class="modal-footer">
                            <div class="col-sm-12">
                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Fechar</button>
                                <input type="submit" class="btn btn-success" value="Atualizar" />
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
        
    <!-- Seu HTML existente -->

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const editButtons = document.querySelectorAll('.edit-btn');

        editButtons.forEach(function (button) {
            button.addEventListener('click', function () {
                const reportId = button.getAttribute('data-id');
                const appointmentDate = button.getAttribute('data-appointment');
                const formattedDate = formatDate(appointmentDate); // Função para formatar a data
                
                const priority = button.getAttribute('data-priority');
                const status = button.getAttribute('data-status');
                const notes = button.getAttribute('data-notes');
                
                const idInput = document.getElementById('id');
                const appointmentInput = document.getElementById('appointment');
                const priorityInput = document.getElementById('priority');
                const statusInput = document.getElementById('status');
                const notesInput = document.getElementById('notes');
                
                idInput.value = reportId;
                appointmentInput.value = formattedDate;
                priorityInput.value = priority;
                statusInput.value = status;
                notesInput.value = notes;
            });
        });
    });

    function formatDate(dateString) {
        const options = { year: 'numeric', month: 'numeric', day: 'numeric' };
        const date = new Date(dateString);
        return date.toLocaleDateString('pt-BR', options);
    }
</script>

    </div>
@endsection
