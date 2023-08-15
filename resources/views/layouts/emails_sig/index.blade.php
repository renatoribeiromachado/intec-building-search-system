
@extends('layouts.app')

@section('content')
<p>Olá,</p>
<p>{{ $mailData['body'] }}</p>
<p>Data do Agendamento: {{ date('d/m/y', strtotime($mailData['appointment_date'])) }}</p>
<p>Prioridade: {{ $mailData['priority'] }}</p>
<p>Status: {{ $mailData['status'] }}</p>
<p>Nota: {{ $mailData['note'] }}</p>

@endsection

