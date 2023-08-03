@extends('layouts.app_customer')

@section('content')
<div class="container pb-4 bg-light border">

<div class="row mt-4">
    <div class="col-md-12">
        <h4><i class="fa fa-check"></i> CADASTRO DE ASSOCIADO</h4>    
    </div>
</div>
<form class="search" action="" method="post">
@csrf

<div class="row mt-2">
    <div class="col-md-3">
        <label><strong>Selecione o CNPJ para esse associado:</strong></label>
        <select name="" class="form-select">
            <option value="">-- Selecione --</option>
            <option value="">22.333.444/0001-10</option>
            <option value="">11.222.333/0001-10</option>
        </select>
    </div>
    
    <div class="col-md-2 mb-2">
        <label><strong>Status:</strong></label>
        <select id="position" name="position_id" class="form-select">
            <option value="">-- Selecione --</option>
            <option value="Ativo">Ativo</option>
            <option value="Inativo">Inativo</option>
        </select>
    </div>
</div>

<div class="row mt-2">
    <div class="col-md-6">
        <label><strong>Razão Social:</strong></label>
        <input type="text" name="" class="form-control"  value="" />
    </div>

    <div class="col-md-6">
        <label><strong>Fantasia:</strong></label>
        <input type="text" name="" class="form-control"  value="" />
    </div>
</div>

<div class="row mt-2">
    <div class="col-md-3">
        <label><strong>CNPJ:</strong></label>
        <input type="text" name="" class="form-control"  value="" />
    </div>

    <div class="col-md-3">
        <label><strong>IE:</strong></label>
        <input type="text" name="" class="form-control"  value="" />
    </div>

    <div class="col-md-3">
        <label><strong>Ramo:</strong></label>
        <select name="" class="form-select">
            <option value="">-- Selecione --</option>
            <option value="Comércio">Comércio</option>
            <option value="Fabricação">Fabricação</option>
            <option value="Indústria">Indústria</option>
            <option value="Serviços">Serviços</option>
        </select>
    </div>

    <div class="col-md-3">
        <label><strong>Atividade:</strong></label>
        <select name="" class="form-select">
            <option value="">-- Selecione --</option>
        </select>
    </div>
</div>

<div class="row mt-2">
    <div class="col-md-2">
        <label><strong>Aniversário da empresa:</strong></label>
        <input type="text" name="" class="form-control"  value="" />
    </div>

    <div class="col-md-4">
        <label><strong>Site:</strong></label>
        <input type="text" name="" class="form-control"  value="" />
    </div>

    <div class="col-md-2">
        <label><strong>Emissão:</strong></label>
        <input type="text" name="" class="form-control"  value="" />
    </div>

    <div class="col-md-4">
        <label><strong>Vendedor(a):</strong></label>
        <select name="" class="form-select">
            <option value="">-- Selecione --</option>
        </select>
    </div>
</div>

<div class="row mt-2">
    <div class="col-md-2">
        <label><strong>CEP:</strong></label>
        <input type="text" name="" class="form-control"  value="" />
    </div>

    <div class="col-md-10">
        <label><strong>Endereço:</strong></label>
        <input type="text" name="" class="form-control"  value="" />
    </div>
</div>

<div class="row mt-2">

    <div class="col-md-4">
        <label><strong>Bairro:</strong></label>
        <input type="text" name="" class="form-control"  value="" />
    </div>
    <div class="col-md-4">
        <label><strong>Cidade:</strong></label>
        <input type="text" name="" class="form-control"  value="" />
    </div>

    <div class="col-md-2">
        <label><strong>Nº:</strong></label>
        <input type="text" name="" class="form-control"  value="" />
    </div>
    <div class="col-md-2">
        <label><strong>UF:</strong></label>
        <select name="" class="form-select">
            <option value="">-- Selecione --</option>
        </select>
    </div>
</div>

<div class="row mt-2">
    <div class="col-md-12">
        <label><strong>Produtos e serviços:</strong></label>
        <input type="text" name="" class="form-control"  value="" />
    </div>
</div>

<div class="row mt-4">
    <div class="col-md-12">
        <a href="" class="btn btn-primary">Salvar e add Contatos / Pedido / Assinatura / Dados de acesso</a>
    </div>
</div>
</form>

</div>

    
@endsection
