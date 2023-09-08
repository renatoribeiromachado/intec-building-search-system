@extends('layouts.app_customer')

@section('content')
<div class="container-fluid">
    <div class="container">
        <div class="row mt-5">
            <div class="col-md-12 text-center">
                <h2 style="color: #000d37;">Monitoramento de associado</h2>
            </div>
            
            <div class="mt-5 table table-responsive">
                <table class="table table-condensed">
                    <thead>
                        <tr>
                            <th>Código</th>
                            <th>Associado</th>
                            <th>Usuário</th>
                            <th>Data</th>
                            <th>IP</th>
                            <th>Browser</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($monitoring->isEmpty())
                            <tr>
                                <td colspan="6" class="text-center"><strong>Nenhum login registrado</strong></td>
                            </tr>
                        @else
                            @foreach ($monitoring as $record)
                                <tr>
                                    @if ($record->associate)
                                        <td>{{ $record->associate->old_code }}</td>
                                        <td>{{ $record->associate->company->trading_name }}</td>
                                        <td>{{ $record->user->name }}</td>
                                        <td>{{ date('d/m/Y', strtotime($record->created_at)) }}</td>
                                        <td>{{ $record->ip }}</td>
                                        <td>{{ $record->user_agent }}</td>

                                    @endif
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>

        </div>

    </div>
</div>
@endsection