@extends('layouts.app_customer_create')

@section('content')

    <div class="row mt-5">
        <div class="col-md-12">
            <h4>Exportar obras para excel por período</h4>
            <form id="export-form" action="{{ route('work.export') }}" method="POST">
                @csrf <!-- Certifique-se de incluir o token CSRF para proteção contra ataques CSRF -->
                <div class="row">
                    <div class="row">
                        <div class="col-md-3">
                            <input type="text" class="form-control datepicker" placeholder="Data inicial..." name="startDate" required>
                        </div>
                        <div class="col-md-3">
                            <input type="text" class="form-control datepicker" placeholder="Data final.." name="endDate" reequired>
                        </div>
                        <div class="col-md-3">
                            <button type="submit" class="btn btn-primary" id="export-button">Exportar</button>
                        </div>
                    </div>               
            </form>
        </div>
    </div>
    </div>
    <div class="row mt-4">
        <div id="loading-text" style="display: none;">Aguarde Exportando, isso pode levar alguns segundos...</div>
    </div>

    <script>
        document.getElementById('export-form').addEventListener('submit', function () {
            document.getElementById('export-button').style.display = 'none';
            document.getElementById('loading-text').style.display = 'block';
        });
    </script>
@endsection
