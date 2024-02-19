@extends('layouts.app_customer')

@section('content')
    <div class="row mt-5" style="background:#ff7a00; border-top-left-radius: 20px; border-top-right-radius: 20px;">
        <div class="table">
            <table class="table table-condensed">
                <thead class="table-dark">
                    <tr>
                        <th>Data</th>
                        <th>Codigo da obra</th>
                        <th>Relator</th>
                        <th>Prioridade</th>
                        <th>Status</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($reports as $report)
                    <tr>
                        <td>{{ date('d/m/Y', strtotime($report->created_at)) }}</td>
                        <td>{{ $report->code }}</td>
                        <td>{{ $report->user->name }}</td>
                        <td>{{ $report->priority }}</td>
                        <td>{{ $report->status }}</td>
                    </tr>
                    
                </tbody>
                <tr>
                    <td>{{ $report->notes }}</td>
                    @endforeach
                </tr>
            </table>
        </div>

    </div>
@endsection
