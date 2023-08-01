@extends('layouts.app_customer')

@section('content')

<style>
    /*CSS para impressão*/
    @media print {
        .print{
            display: block !important;
        }
        .no-print{
            display: none;
        }
    }
    body {
        margin:0;
        padding:0;
        line-height: 1.4em;
    }
    @page {
        margin: 0.5cm;
    }

    table{
        border: none !important;
    }
    p{
        font-size: 10px;
    }
    tr{
        background: white !important;
        border: none !important;
    }
    th{
        font-size: 10px;
        border: none !important;
    }
    td{
        font-size: 10px;
        border: none !important;
        padding: 0 !important;
    }
    input[type=checkbox] {
        -moz-appearance:none !important;
        -webkit-appearance:none !important;
        -o-appearance:none !important;
        outline: none !important;
        content: none !important;
    }
    input[type=checkbox]:before {
        font-family: "FontAwesome" !important;
        content: "\f00c" !important;
        font-size: 10px !important;
        color: transparent !important;
        background: #fef2e0 !important;
        display: block !important;
        width: 12px !important;
        height: 12px !important;
        border: 1px solid black !important;
        margin-right: 1px !important;
    }

    input[type=checkbox]:checked:before {
        color: black !important;
    }
    .alinhadoDireita {
        text-align:right;
    }
    .margin{
        margin-top:-20px;
    }
    .pg{
        page-break-after: always;
    }
</style>

<div class="container">
    <div class="row mt-2">
        <div class="col-md-12">
            <p><strong>Código</strong>:  - Última Atualização: <strong> </strong> - Revisão: <strong></strong> - Emitido em: <strong></strong></p>    
        </div>
    </div> 

    <div class="row mt-2">
        <!--BOTÕES-->
        <div class="col-md-4">
            <button class='btn btn-primary' type='button' onclick='' title="DESATIVAR OBRA"> Desativar</button>
            <a class="btn btn-default" title="Cadastrar SIG" onclick=""> NOVO SIG</a>
        </div>
    </div>  

    <div class="row mt-2">
        <div class="col-md-12">
            <p class="text-success"><b>DADOS DA OBRA:</b></p>
            <table class="table table-condensed">
                <tr>
                    <td style="width:85% !important;"><strong>Nome da Obra</strong>:  <br>
                        <strong>Endereço</strong>: <br>
                        <strong>Bairro</strong>:<br>
                        <strong>Cidade</strong>:  <strong>Estado:</strong> - <strong>CEP:</strong><br>
                        <strong>Segmento</strong>: <span class="text-uppercase"></span> -  <b>Subtipo</b>:<br>
                        <strong>Início da obra</strong>:  <strong>Término da obra</strongb> - <strong>Início / Término</strong>: <br>
                            <strong>Fase</strong>:  <strong>Estágio</strong>: <br>
                            <strong>Área total do Projeto</strong>: <br>
                            <strong>Padrão do investimento</strong>:<br>
                    </td>
                    <td style="width:15% !important;">
                        <picture>
                            <img src="" class="img-fluid" alt=""/>
                        </picture>
                    </td>
                </tr>
            </table>
            <table class="table table-condensed">
                <tr>
                    <td>
                        <p></p>
                        <strong>Detalhes</strong: 
                            <p></p>
                    </td> 
                </tr>
            </table>
        </div>
    </div>

    <!--INFORMAÇÕES ADICIONAIS-->
    <div class="row mt-2">
        <div class="col-md-12">
            <p class="text-success"><b>DESCRIÇÃO:</b></p>
            <table class="table table-condensed">
                <tr>
                    <td><strong>Edifício(s) Residenciais</strong>: <span class="text"></span>
                        <br>
                        <strong>Nº de pavimentos</strong>: <span class="text"></span>
                        <br>
                        <strong>Apart. Por andar</strong>: 
                        <br>
                        <strong>Dormitório(s)</strong>: 
                        <br>
                        <strong>Condominio</strong>: 
                    </td>
                    <td>  
                        <strong>Suíte(s)</strong> 
                        <br>
                        <strong>Banheiro(s)</strong>: 
                        <br>
                        <strong>Lavabo(s)</strong>: 
                        <br>
                        <strong>Sala(s) de jantar / estar</strong>: 
                    </td>

                    <td>
                        <strong>Área(s) de Serv. / Terraço(s) / Varanda(s)</strong>: 
                        <br>
                        <strong>Copa / Cozinha</strong>: 
                        <br>
                        <strong>Dependência(s) de empregada(s)</strong>: 
                    </td>
                </tr>
            </table>
        </div>
    </div>

    <!--Informações adicionais -->
    <div class="row mt-2">
        <div class="col-md-12">
            <p class="text-success"><b>INFORMAÇÕES ADICIONAIS:</b></p>
            <table class="table table-condensed">
                <tr>
                    <td>
                        <strong>Total de unidades</strong>: 
                        <br>
                        <strong>Área Útil(m²)</strong>: 
                        <br>
                        <strong>Vaga(s)</strong>:
                    </td>
                    <td>
                        <strong>A. Terreno(m²)</strong>: 
                        <br>
                        <strong>Elevadore(s)</strong>: 
                        <br>
                        <strong>Cobertura(s)(m²)</strong>: 
                    </td>
                    <td>
                        <strong>Ar Condicionado</strong>: 
                        <br>
                        <strong>Aquecimento</strong>: 
                        <br>
                        <strong>Fundações</strong>: 
                    </td>
                    <td>
                        <strong>Estrutura</strong>: 
                        <br>
                        <strong>Acabamento</strong>:
                        <br>
                        <strong>Fachada</strong>: 
                    </td>
                </tr>
            </table>
        </div>
    </div>

    <!--AREA DE LAZER-->
    <div class="row mt-2">
        <div class="col-md-12">
            <p class="boxtitle text-success"><strong>ÁREA DE LAZER</strong> <code>*Itens marcados estão disponiveis na Obra</code></p>
            <table class="table table-condensed">
                <tr>
                    <td><input type="checkbox" name="" value="" disabled=""/> Salão de festas</td>
                    <td><input type="checkbox" name="" value="" disabled=""/> Salão de jogos</td>
                    <td><input type="checkbox" name="" value=""  disabled=""/> Piscina</td>
                    <td><input type="checkbox" name="" value="" disabled=""/> Sauna</td>
                    <td><input type="checkbox" name="" value="" disabled=""/> Churrasqueira</td>
                    <td><input type="checkbox" name="" value="" disabled=""/> Quadra</td>
                </tr>
                <tr>
                    <td><input type="checkbox" name="" value=""  disabled=""/> Fitness</td>
                    <td><input type="checkbox" name="" value="" disabled=""/> Gourmet</td>
                    <td><input type="checkbox" name="" value="" disabled=""/> Playground</td>
                    <td><input type="checkbox" name="" value=""  disabled=""/> Spa</td>
                    <td><input type="checkbox" name="" value=""  disabled=""/> Brinquedoteca</td>
                </tr>
                <tr>
                    <td colspan="6"><strong>Outros</strong>: </td>  
                </tr>
            </table>
        </div>
    </div>

    <div class="row mt-2">
        <div class="col-md-12">
            <table class="table table-condensed">
                <tr>
                    <td><strong>Ar Condicionado</strong></td>
                    <td><strong>Aquecimento</strong></td>
                    <td><strong>Fundações</strong></td>
                    <td><strong>Estrutura</strong></td>
                    <td><strong>Acabamento</strong></td>
                    <td><strong>Fachada</strong></td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
            </table>
        </div>
    </div>

    <!--CONTATOS-->
    <div class="row mt-2">
        <div class="col-md-12">
            <p class="boxtitle text-success"><strong>CONTATO(s) DA OBRA</strong></p>
            <table class="table table-condensed">
                <tr>
                    <td><strong>Nome</strong></td>
                    <td><strong>Cargo</strong></td>
                    <td><strong>Empresa</strong></td>
                    <td><strong>Obra</strong></td>
                    <td><strong>Telefone</strong></td>
                    <td><strong>Telefone2</strong></td>
                    <td><strong>Celular</strong></td>
                    <td><strong>Celular 2</strong></td>
                    <td><strong>E-mail</strong></td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td><a href="mailto:" class="no-print"></a><span class="print" style="display:none;"></span></td>
                </tr>
            </table>
        </div>
    </div>

    <!--EMPRESAS PARTICIPANTES-->
    <div class="row mt-2">
        <div class="col-md-12">
            <p class="boxtitle text-success"><strong>EMPRESA(s) PARTICIPANTE(s)</strong></p>
            <table class="table table-condensed">

                <tbody>
                    <tr>
                        <td><strong>Modalidade(s):</strong> - <strong>Razão social:</strong>  - <strong>CNPJ:</strong></td>
                    </tr>
                    <tr>
                        <td><strong>Nome Fantasia:</strong></td>
                        <td><strong>Atividade:</strong> </td>
                    </tr>
                    <tr>
                        <td><strong>Endereço:</strong> </td>
                        <td><strong>Site:</strong></td>
                    </tr>
                    <tr>
                        <td><strong>Cidade:</strong> </td>
                        <td><strong>E-mail:</strong> </td>
                        <td><strong>E-mail Secundário:</strong> </td>
                    </tr>

                    <!--CONTATOS-->
                    <tr>
                        <td><strong>Nome</strong>:</td>
                        <td><strong>Cargo</strong>: </td>
                        <td><strong>Celular</strong>: </td>
                        <td><strong>Telefone</strong>: </td>
                    </tr>
                </tbody>
            </table> 
        </div>
    </div>
</div>
@endsection