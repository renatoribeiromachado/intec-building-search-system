
@extends('layouts.app')

@section('content')
<p>Olá,</p>
<p>{{ $mailData['body'] }}</p>
<p>Data do Agendamento: {{ date('d/m/Y', strtotime($mailData['appointment_date'])) }}</p>
<p>Código do Associado: {{ $mailData['code_associate'] }}</p>
<p>anotação: {{ $mailData['notes'] }}</p>

@endsection

