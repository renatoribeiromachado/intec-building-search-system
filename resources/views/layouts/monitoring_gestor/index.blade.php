@extends('layouts.app_customer')

@section('content')
<div class="container-fluid">
    <div class="container">
        <div class="row mt-5">
            <div class="col-md-12 text-center">
                <h2 style="color: #000d37;">Monitoramento de usuário(s) na Plataforma</h2>
            </div>
            
            @if(session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif
            
            <div class="col-md-4 mt-5">
                <form action="{{ route('monitoring.searchGestor') }}" class="form-inline" method="get">
                    
                    @csrf
                    <div class="row">
                        <div class="col-sm-8">
                            <input type="text" name="user_id" class="form-control" value="" placeholder="Digite o código do usuário">
                        </div>
                        <div class="col-sm-4">
                            <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i></button>
                        </div>
                    </div>
                </form>
            </div>
            
            <div class="mt-5 table table-responsive">
                <table class="table table-condensed">
                    <thead>
                        <tr>
                            <th>Codigo</th>
                            <th>Associado</th>
                            <th>Usuário</th>
                            <th>Data</th>
                            <th>IP</th>
                            <th>Browser</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($monitorings as $monitoring)
                        <tr>
                            <td>{{ $monitoring->user_id }}</td>
                            <td>{{ $monitoring->associate->company->trading_name }}</td>
                            <td>{{ $monitoring->user->name }}</td>
                            <td>{{ date('d/m/Y', strtotime($monitoring->created_at)) }}</td>
                            <td>{{ $monitoring->ip }}</td>
                            <td>{{ $monitoring->user_agent  }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            
        </div>
        
        <div class="card-header">
            {!! $monitorings->links() !!}
        </div>

    </div>
</div>
@endsection

