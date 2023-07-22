<?php
    if (!class_exists('Login')) :
        header('Location: ../../imp.php');
        die;
    endif;
?>
     
<div>
    <?php 
         if(!isset($_SESSION['empresas_checked'])){
            WSErro("Para visualizar os dados você deverá selecionar uma ou mais empresas(s), por favor, feche essa Aba e faça nova pesquisa!!", WS_INFOR);
        }else{
        $allEmpresas = [];
        foreach ($_SESSION['empresas_checked'] AS $empresaPagina){
            array_push($allEmpresas, ...$empresaPagina);
        }
        foreach($allEmpresas AS $value){
            $read = new Read;
            $read->FullRead("SELECT emp.Codigo,
                                    emp.RazaoSocial,
                                    emp.Fantasia,
                                    emp.Endereco,
                                    emp.numero,
                                    emp.Complemento,
                                    emp.Cidade,
                                    emp.Estado,
                                    emp.CEP,
                                    emp.IdAtividade,
                                    emp.WebSite,
                                    emp.CNPJ,
                                    emp.Email,
                                    emp.EMAIL, 
                                    emp.EMAIL2,
                                    emp.INDSTATUS,
                                    emp.Atualizacao,
                                    emp.NrDaRevisao,
                                    emp.Observacao,
                                    est.UF, 
                                    ati.DescricaoAtividade
                                    FROM tb_empresas_emp AS emp
                                        LEFT JOIN tb_estados_est AS est
                                    ON est.IdEstado = emp.Estado
                                        LEFT JOIN tb_atividades_ati AS ati
                                    ON ati.IdAtividade = emp.IdAtividade
                                    WHERE emp.Codigo = $value
                                    ORDER BY emp.RazaoSocial");
            $count = $read->getRowCount();
            if($read->getResult()):
                foreach($read->getResult() as $res):
                    extract($res);
    ?>
    
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
        .alinhadoDireita {text-align:right;}
        .margin{ margin-top:20px;}
        .pg{page-break-after: always;}
    </style> 
    
    <script>
        function fncXMHide(p) {
            obj = document.getElementById(p);
            obj.style.display = 'none';
            fncLoadPageBreak();
        }
    </script>
    
    <div class="container pg" id="<?= $Codigo;?>">
        <?php include "inc/header-empresa.php";?>
                   
            <div class="col-md-12">
                <p>Última Atualização: <b><?= date('d/m/Y', strtotime($Atualizacao));?> </b> / Revisão: <b><?= $NrDaRevisao;?></b> Emitido em: <b><?= date("d/m/Y - H:i:s");?></b></p>    
            </div>
                
            <!--BOTÕES-->
            <div class="col-md-4 margin-top">
                <button class='btn btn-primary' type='button' onclick='fncXMHide("<?= $Codigo;?>")' title="DESATIVAR EMPRESA"><i class="glyphicon glyphicon-eye-open"></i> Desativar</button>
                <a class="btn btn-default" title="Cadastrar SIG" onclick="window.open('imp.php?exe=pesquisas/createSigEmp&Codigo=<?= $Codigo;?>&RazaoSocial=<?= $RazaoSocial; ?>', 'Pagina', 'STATUS=NO, TOOLBAR=NO, LOCATION=NO, DIRECTORIES=NO, RESISABLE=NO, SCROLLBARS=YES, TOP=10, LEFT=10, WIDTH=775, HEIGHT=455');"><i class="glyphicon glyphicon-align-left"></i> NOVO SIG</a>
            </div>
                
            <div class="row">
            </div>
                
            <div class="col-xs-12 margin">
                <p class="text-success boxtitle"><b>DADOS DA EMPRESA:</b></p>
                <table class="table table-condensed">
                    <tr>
                        <td><b>Razão Social</b>: <?= $RazaoSocial;?></td>
                        <td><b>Fantasia</b>: <?= $Fantasia;?></td>
                    </tr>
                    <tr>
                        <td><b>Endereço:</b> <?= $Endereco;?>, <?= $numero;?></td>
                        <td><b>Bairro:</b> <?= $Complemento;?></td>
                    </tr>
                    <tr>
                        <td><b>Cidade:</b> <?= $Cidade;?></td>
                        <td><b>Estado:</b> <?= $UF;?></td>
                    </tr>

                    <tr>
                        <td><b>CEP:</b> <?= $CEP;?></td>
                        <td><b>CNPJ:</b> <?= $CNPJ;?></td>
                    </tr>

                    <tr>
                        <td><b>Atividade:</b> <?= $DescricaoAtividade;?></td>
                        <td><b>Site:</b> <?= $WebSite;?></td> 
                    </tr>
                    <tr>
                        <td><b>E-MAIL:</b> <a href="mailto:<?= $EMAIL;?>" class='no-print'><?= $EMAIL;?></a><span class="print" style="display:none;"><?= $EMAIL;?></span></td>
                        <td><b>E-MAIL Secundário:</b> <a href="mailto:<?= $EMAIL2;?>" class="no-print"><?= $EMAIL2;?></a> <span class="print" style="display:none;"><?= $EMAIL2;?></span></td>
                    </tr>
                     <tr>
                        <td><b>OBSERVAÇÃO:</b> <?= $Observacao;?></td>
                    </tr>

                    <?php
                        $readC = $read;
                        $readC->FullRead("SELECT cem.NomeContato,
                                                cem.IdCargo,
                                                cem.DDD,
                                                cem.DDD2,
                                                cem.DDD3,
                                                cem.Telefone,
                                                cem.DDDFax,
                                                cem.Fax,
                                                cem.TELEFONE2,
                                                cem.TELEFONE3,
                                                cem.EMail AS EMailContato,
                                                car.DescricaoCargo
                                                FROM tb_contatoempresas_cem AS cem
                                                    LEFT JOIN tb_cargos_car AS car
                                                ON car.IdCargo = cem.IdCargo 
                                                WHERE cem.IdEmpresa = $value
                                                ORDER BY cem.NomeContato");
                        if($readC->getResult()):
                            foreach($readC->getResult() as $cem):
                                extract($cem); 
                    ?>
                    <tr>
                        <td><b>CONTATOS</b> <?= $DescricaoCargo;?> - <?= $NomeContato;?></td>
                        <td><b>TELEFONE</b> <?= '(' .$DDD. ') ' .$Telefone;?></td>
                    </tr>
                    <tr>
                        <td><b>CELULAR (1)</b> <?= '(' .$DDD2. ') ' .$TELEFONE2;?></td>
                        <td><b>CELULAR (2)</b> <?= '(' .$DDD3. ') ' .$TELEFONE3;?></td>
                    </tr>
                    <tr>
                        <td><b>FAX</b> <?= '(' .$DDDFax. ') ' .$Fax;?></td>
                        <td><b>E-MAIL CONTATO</b> <a href="mailto:<?= $EMailContato;?>" class="no-print"><?= $EMailContato;?></a> <span class="print" style="display:none;"><?= $EMailContato;?></span></td>
                    </tr>
                    <?php
                        endforeach;
                        endif;
                    ?>
                </table>
            </div>
            <p class="text-center">&copy; INTECBRASIL - Informações Técnicas da Construção - Todos os Direitos Reservados vs.:: 1.0.1 - 2018</p>
            <!--
            <div class="modal-footer">
                <button class="print btn btn-info"><i class="glyphicon glyphicon-print"></i> Imprimir</button>
            </div>
            -->
        </div>
        <?php
            endforeach;
            endif;
            }
            }
        ?>
</div>
<script>
    $(function(){
     $('.print').on('click', function() {
        window.print();
        return false;
      });  
    });
    
    //Deleta a sessão
    function uncheck(){
        $.ajax({
            url: "request.php?exe=pesquisas/unsetCheckedEmperesas",
            type: "POST",
            success: function(){
                console.log('sessao deletada')
            }
        });
    }
    uncheck();
</script>