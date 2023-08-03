@extends('layouts.app_customer')

@section('content')
<div class="container pb-4 bg-light border">

    <div class="row mt-4">
        <div class="col-lg-12">
            <h4 class="text-center"><i class="fa fa-check"></i> <strong>CADASTRO DE ASSOCIADOS</strong> - <code>Filtro</code></h4>
        </div>
    </div>

    <form class="search" action="{{ route('annotations.store') }}" method="post">
    @csrf

        <div class="row mt-2">
            <div class="col-md-2">
                <label class="control-label">Busca por Codigo</label>
                <input type="text" name="Codigo" class="form-control" placeholder="Digite o Codigo..">
            </div>
            <div class="col-md-2">
                <label class="control-label">Busca por CNPJ</label>
                <input type="text" name="CNPJ" class="form-control cnpj" placeholder="Digite o CNPJ...">
            </div>
            <div class="col-md-4">
                <label class="control-label">Busca por Razão Social</label>
                <input type="text" name="RazaoSocial" id="busca-associado" class="form-control" placeholder="Digite a Razão Social...">
            </div>
            <div class="col-md-4">
                <label class="control-label">Busca por Fantasia</label>
                <input type="text" name="Fantasia" id="busca-associadoFantasia" class="form-control" placeholder="Digite a Fantasia...">
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-md-12">
                <a href="{{ url('associated_registration') }}" class="btn btn-primary" title="Cadastrar Novo Cliente (Associado)"><i class="fa fa-ok"></i> Cadastrar Novo</a>
                <button type="submit" class="btn btn-success submit" title="Pesquisar" ><i class="fa fa-search"></i> Pesquisar</button> 
            </div>
        </div>

    </form>

    
@endsection
