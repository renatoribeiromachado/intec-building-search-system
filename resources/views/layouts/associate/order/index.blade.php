@extends('layouts.app_customer')

@section('content')
<div class="container">
    <div class="row mt-4">
        <div class="col-md-12">
            <p><i class="fa fa-check"></i> <strong>Plano atual</strong></p>
        </div>

        <div class="col-md-12">
            <div class="table table-responsive">
                <table class="table table-condensed">
                    <tr>
                        <th class="bg-dark text-white">Cód.</th>
                        <th class="bg-dark text-white">Posição</th>
                        <th class="bg-dark text-white">Plano</th>
                        <th class="bg-dark text-white">Início</th>
                        <th class="bg-dark text-white">Término</th>
                        <th class="bg-dark text-white">Detalhes</th>
                    </tr>
                    @foreach ($orders as $order)
                        <tr>
                            <td>{{ $order->old_code }}</td>
                            <td>{{ $order->situation }}</td>
                            <td>{{ optional($order->plan)->description }}</td>
                            <td>{{ optional($order->start_at)->format('d/m/Y') }}</td>
                            <td>{{ optional($order->ends_at)->format('d/m/Y') }}</td>
                            <td>{{ $order->work_notes }}</td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
</div>
@endsection