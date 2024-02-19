@extends('layouts.app_customer')

@section('content')

    <div class="row mt-5">
        <div class="table">
            <table class="table table-condensed">
                <thead style="background:#ff7a00; border-top-left-radius: 20px; border-top-right-radius: 20px;">
                    <tr>
                        <th>Relator</th>
                        <th>Agendado</th>
                        <th>SiG</th>
                        <th>Qtd</th>
                        <th>Cód da(s) obra(s) <code>clique na obra para ver notificação</code></th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($statusCounts as $userId => $userData)
                        @foreach ($userData['appointments'] as $appointmentDate => $appointmentData)
                            @foreach ($appointmentData['status'] as $status => $count)
                                <tr>
                                    <td><strong>{{ $userData['user_name'] }}</strong></td>
                                    <td>{{ date('d/m/Y', strtotime($appointmentDate)) }}</td>
                                    <td>{{ $status }}</td>
                                    <td><strong>{{ $count }}</strong></td>
                                    <td>
                                        @foreach ($appointmentData['work_ids'][$status] as $index => $workId)
                                        <a href="#" class="open-modal" data-toggle="modal" data-target="#workModal{{ $appointmentData['ids'][$status][$index] }}" title="Clique para ver o que foi notificado">
                                               {{ $workId }}
                                            </a>
                                            @if (!$loop->last)
                                                {{ ', ' }}
                                            @endif
                                        @endforeach

                                    </td>
                                </tr>
                            @endforeach
                        @endforeach
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function () {
        // Manipulador de clique para abrir o modal
        $('.open-modal').click(function () {
            let targetModal = $(this).data('target');
            $(targetModal).modal('show');
        });

        // Adicione um manipulador de clique para fechar o modal quando o botão "Fechar" for clicado
        $('.close-modal').click(function () {
            let targetModal = $(this).closest('.modal'); // Encontra o modal pai do botão "Fechar"
            $(targetModal).modal('hide');
        });
    });
    </script>

    <!-- Modais -->
    @foreach ($statusCounts as $userId => $userData)
        @foreach ($userData['appointments'] as $appointmentDate => $appointmentData)
            @foreach ($appointmentData['ids'] as $status => $workIds)
                @foreach ($workIds as $workId)
                    <!-- Modal -->
                    <div class="modal fade" id="workModal{{$workId}}" tabindex="-1" role="dialog" aria-labelledby="workModalLabel{{$workId}}" aria-hidden="true" data-backdrop="static" data-keyboard="false">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header bg-warning">
                                    <h5 class="modal-title" id="workModalLabel{{$workId}}">O que foi notificado nessa Obra!</h5>
                                </div>
                                <div class="modal-body">
                                    @php
                                        $priority = \App\Models\Sig::where('id', $workId)->pluck('priority')->all();
                                        $notes = \App\Models\Sig::where('id', $workId)->pluck('notes')->all();
                                        $created_at = \App\Models\Sig::where('id', $workId)->pluck('created_at')->all();
                                    @endphp
                                    
                                    @if (!empty($created_at))
                                        @foreach ($created_at as $created_at)
                                        <strong>SIG criado em:</strong> {{ date('d/m/Y', strtotime($created_at)) }}<br>
                                        <hr>
                                        @endforeach
                                    @else
                                        Nenhuma data disponível.
                                    @endif
                                    
                                    @if (!empty($priority))
                                        @foreach ($priority as $priority)
                                        <strong>Prioridade:</strong> {{ $priority }}<br>
                                        <hr>
                                        @endforeach
                                    @else
                                        Nenhuma prioridade disponível.
                                    @endif

                                    @if (!empty($notes))
                                        @foreach ($notes as $note)
                                          <strong>Notificação:</strong>  {{ $note }}<br>
                                        @endforeach
                                    @else
                                        Nenhuma notificação disponível.
                                    @endif
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger close-modal" data-target="#workModa{{$workId}}">Fechar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endforeach
        @endforeach
    @endforeach

@endsection
