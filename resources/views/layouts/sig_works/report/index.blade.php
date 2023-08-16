@extends('layouts.app_customer')

@section('content')
    <div class="container">
        <div class="row">
            <div class="table">
                <table class="table table-condensed">
                    <thead class="table-dark">
                        <tr>
                            <th>Criado em</th>
                            <th>Agendado para</th>
                            <th>Codigo da obra</th>
                            <th>Relator</th>
                            <th>Prioridade</th>
                            <th>Status</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($reports as $report)
                            <tr>
                                <td>
                                    {{ $report->created_at->format('d/m/Y') }}
                                </td>
                                <td>
                                    {{ optional($report->appointment_date)->format('d/m/Y') }}
                                </td>
                                <td>{{ $report->work->old_code }}</td>
                                <td>{{ $report->user->name }}</td>
                                <td>{{ $report->priority }}</td>
                                <td>{{ $report->status }}</td>
                            </tr>
                            
                            @if ($report->notes)
                            <tr>
                                <td colspan="6">{{ $report->notes }}</td>
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
    </div>
@endsection
