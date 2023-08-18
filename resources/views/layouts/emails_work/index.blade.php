@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row mb-3" style="background: #eee;">
        <div class="col-md-12 pt-2 pb-2" style="margin: 10px;">
            <p>Olá,</p>
            <p><strong>Segue a lista de obras selecionadas no sistema INTEC Brasil:</strong></p>
            <p>{{ $data['selectedWorks'] }}</p>
            <p>Atenciosamente, {{ $data['senderName'] }}</p>
            <p>Para visualizar as obras acesse: <a href="https://obras.intecbrasil.com.br/login" target="_blank">Plataforma obras INTEC Brasil</a></p>
            <p><strong>INTEC Brasil</strong><br>
            Nossa especialidade é aumentar as vendas de fornecedores da construção civil<br> gerando leads de qualidade de forma segmentada.</p>
        </div>
    </div>
</div>
@endsection

