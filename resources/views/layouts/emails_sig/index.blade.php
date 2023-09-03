
@extends('layouts.app')

@section('content')
<p>Olá,</p>
<p>{{ $mailData['body'] }}</p>
<p>Data do Agendamento: {{ date('d/m/Y', strtotime($mailData['appointment_date'])) }}</p>
<p>Codigo da obra: {{ $mailData['old_code'] }}</p>
<p>Prioridade: {{ $mailData['priority'] }}</p>
<p>Status: {{ $mailData['status'] }}</p>
<p>Observação: {{ $mailData['notes'] }}</p>

@endsection

