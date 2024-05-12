@extends('layouts.app_customer_create')

@section('content')

<div class="container bg-light p-5 rounded">
    <div class="row">
        <div class="col-md-12">
            <div class="alert alert-info"><h4>SIG Geral - Associados</h4></div>
        </div>
    </div>
    
    <div class="row mt-5">
        <div class="col-md-12">
            <div class="table table-responsive">
                <table class="table table-condensed">
                    <thead class="bg-dark text-white">
                        <tr>
                            <th>Código associado</th>
                            <th>Criado em</th>
                            <th>Agendado para</th>
                            <th>Relator</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($sig_associates AS $sig_associate)
                        <tr>
                            <td>{{ $sig_associate->code_associate }}</td>
                            <td>{{ date('d/m/Y', strtotime($sig_associate->created_at)) }}</td>
                            <td>{{ date('d/m/Y', strtotime($sig_associate->appointment_date)) }}</td>
                            <td style="width:60%;">{{ $sig_associate->user->name }}</td>
                        </tr>
                        <tr>
                            <td colspan="4">
                                <strong>Anotação:</strong>
                                <span class="text-primary">{{ $sig_associate->notes }}</span>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        
        <div class="card-header">
            {!! $sig_associates->links() !!}
        </div>
   
    </div>
    
    <!--MODAL UPDATE-->
    <div class="modal fade" id="update" tabindex="-1" role="dialog" aria-labelledby="formUpdate">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header bg-success text-white">
                    <h5 class="modal-title" id="formUpdate">Editando SIG - Associado</h5>
                </div>
                <div class="modal-body">

                    <form action="{{ route('sig_associate.update') }}" method="POST">

                        @method('PUT')
                        @csrf
                        
                        <!--usado para edição, pois estou usando modal-->
                        <input type="hidden" id="id" name="id" class="form-control" value=""> 

                        <div class="row mt-2">
                            
                             <div class="col-md-4">
                                <label class="control-label">Código do associado</label>   
                                <input type="text" name="code_associate" id="code" class="form-control" value="" readonly=""/>
                            </div>
                            <div class="col-md-4">
                                <label class="control-label">Agendado para</label>   
                                <input type="text" name="appointment_date" id="appointment" class="form-control datepicker" value=""/>
                            </div>
                            
                        </div>

                         <div class="row mt-2">
                            <div class="col-md-12">
                                <label for="notes">Anotação</label>
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
    
    <script>
    document.addEventListener('DOMContentLoaded', function () {
        const editButtons = document.querySelectorAll('.edit-btn');

        editButtons.forEach(function (button) {
            button.addEventListener('click', function () {
                const id = button.getAttribute('data-id');
                const appointmentDate = button.getAttribute('data-appointment');
                const formattedDate = formatDate(appointmentDate); // Função para formatar a data
                const code = button.getAttribute('data-code');
                const notes = button.getAttribute('data-notes');
                
                const idInput = document.getElementById('id');
                const appointmentInput = document.getElementById('appointment');
                const codeInput = document.getElementById('code');
                const notesInput = document.getElementById('notes');
                
                idInput.value = id;
                appointmentInput.value = formattedDate;
                codeInput.value = code;
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
