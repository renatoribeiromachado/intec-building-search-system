
@extends('layouts.app')

@section('content')
<p>Olá,</p>
<p>{{ $mailData['body'] }}</p>
<p>Data do Agendamento: {{ date('d/m/Y', strtotime($mailData['appointment_date'])) }}</p>
<p>Empresa: {{ $mailData['trading_name'] }}</p>
<p>Prioridade: {{ $mailData['priority'] }}</p>
<p>Status: {{ $mailData['status'] }}</p>
<p>Observação: {{ $mailData['notes'] }}</p>

@endsection

