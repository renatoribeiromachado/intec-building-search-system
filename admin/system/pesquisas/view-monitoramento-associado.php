<?php
   if (!class_exists('Login')) :
        header('Location: ../../painel.php');
        die;
    endif;
    
    $read = new Read;

    $Fantasia = filter_input(INPUT_POST, 'Fantasia', FILTER_DEFAULT);
    $inicial  = filter_input(INPUT_POST, 'data_inicial', FILTER_DEFAULT);
    $final    = filter_input(INPUT_POST, 'data_final', FILTER_DEFAULT);
    
    $readAss = $read;
    $readAss->ExeRead("tb_associados_ass", "WHERE Fantasia = '$Fantasia'");
    if($readAss->getResult()):
        foreach($readAss->getResult() AS $ass):
            extract($ass);
        endforeach;
    endif;

?>
<div class="bg-info bottom20">
    <div class="col-md-12 bottom20 bg_purple">
        <p class="text-center"><i class="glyphicon glyphicon-check"></i> Acesso Associado</p>
    </div>
    
       <!--PERIODOS-->
    <div class="container-fluid">
        <div class="col-md-12 jumbotronBox">
            <form class="search" action="painel.php?exe=pesquisas/view-monitoramento-associado" method="POST">
                <div class="col-md-12">
                    <p class="text-warning text-uppercase boxtitle"><i class="glyphicon glyphicon-search"></i> <b>Busca por Período</b> <code>* entre Datas</code></p>
                </div>
                <div class="col-md-12">
                    <label class="control-label"><i class="glyphicon glyphicon-user"></i> Associado</label>
                    <input type="text" name="Fantasia" class="form-control" id="busca-associadoFantasia" value="" placeholder="Associado...">                           
                    <div class="help-block with-errors"></div>
                </div>
                <div class="col-md-6">
                    <div class="input-group bottom20">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                        <input type="text" name="data_inicial" class="form-control datepicker" value="" placeholder="Insira Data Inicial...">                                      
                        <div class="help-block with-errors"></div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="input-group bottom20">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                        <input type="text" name="data_final" class="form-control datepicker" value="" placeholder="Insira Data Final...">                                      
                        <div class="help-block with-errors"></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="col-sm-12">
                        <a href="painel.php?exe=pesquisas/monitoramento-associados" class="btn btn-primary back" title="Nova Pesquisa"><i class="glyphicon glyphicon-search"></i> Nova Pesquisa</a>
                        <button type="submit" class="btn btn-success submit" title="Pesquisar" name="SendPostForm"><i class="glyphicon glyphicon-search"></i> Pesquisar</button> 
                    </div>
                </div>
            </form>
        </div> 
    </div>
    
    <div class="container-fluid">
        <table class="table table-bordered table-condensed">
            <tr>
                <th><i class="glyphicon glyphicon-user"></i> <b>Usuário</b></th>
                <th><i class="glyphicon glyphicon-check"></i> <b>Associado</b></th>
                <th><i class="glyphicon glyphicon-calendar"></i> <b>Data de Acesso</b></th>
                <th><i class="glyphicon glyphicon-hourglass"></i> <b>Login de Acesso</b></th>
                <th><i class="glyphicon glyphicon-hourglass"></i> <b>IP</b></th>
                <th><i class="glyphicon glyphicon-hourglass"></i> <b>Browser</b></th>
                <th><i class="glyphicon glyphicon-hourglass"></i> <b>Status</b></th>
            </tr>
            <?php  
                //CONDITION
                $condition = array();
                
                if(!isset($_GET['condition'])){
                    if(!empty($Fantasia)) {
                        $condition[] = "his.IdAssociado= '" . $Codigo . "'";             
                    }
                    //Inicial          
                    if(!empty($inicial) && empty($final)) {
                        $condition[] = "his.DataAcesso  = '" .Check::JustData($inicial). "'";              
                    }//Final
                    if(empty($inicial) && !empty($final)) {
                        $condition[] = "his.DataAcesso  = '" .Check::JustData($final). "'";              
                    }
                    //PERIODO           
                    elseif(!empty($inicial) && !empty($final)) {
                        $condition[] = "his.DataAcesso  BETWEEN '".Check::JustData($inicial). "' AND '" .Check::JustData($final)."'";              
                    }
                    //CONDITION
                    $condition = implode(' AND ', $condition);
                   
                } else {
                    $condition = $_GET['condition'];  
                }
                
                //Validação senão for digitado nada nos inputs retorna ao index
                if($condition == ''){
                     header("Location:painel.php?exe=pesquisas/monitoramento-associados");
                }
                
                //LEITURA condition
                $querySql = "SELECT his.IdUsuario,
                                    his.DataAcesso,
                                    his.Email,
                                    his.Login,
                                    his.IPAcesso,
                                    his.Browser,
                                    ass.Fantasia,
                                    ass.IdStatus,
                                    ass.DataAtivacao,
                                    st.DescricaoStatus,
                                    usu.usu_Usuario_chr
                                    FROM tb_usuariohistorico_his AS his
                                        LEFT JOIN tb_associados_ass AS ass
                                    ON ass.Codigo = his.IdAssociado
                                        INNER JOIN tb_usuario_usu AS usu
                                    ON usu.usu_Usuario_int_PK = his.IdUsuario
                                        LEFT JOIN tb_status_sta as st
                                    ON st.IdStatus = ass.IdStatus
                                    WHERE $condition";
  
                //PAGINACAO
                $pagi = 0;
                $getPage = filter_input(INPUT_GET, 'page', FILTER_VALIDATE_INT);
                $Pager = new Pager('painel.php?exe=pesquisas/view-monitoramento-associado&condition='.$condition.'&page=');
                $Pager->ExePager($getPage, 50);

                //PAGINACAO TOPO
                echo "<div class='col-md-12 text-center'>";
                    $Pager->ExeFullPaginator($querySql);
                    echo $Pager->getPaginator();
                echo "</div>";
                
                //LEITURA paginação
                $readLog = $read;
                $readLog->FullRead("{$querySql} ORDER BY his.DataAcesso DESC, his.DataAcesso DESC LIMIT :limit OFFSET :offset", "limit={$Pager->getLimit()}&offset={$Pager->getOffset()}");
                if(!$readLog->getResult()):
                    WSErro("Sua Pesquisa não encontrou informações de Associado(s) para Monitorar, faça nova pesquisa!!", WS_INFOR);
            
                    else:
                        $count = $readLog->getRowCount();
                        echo "<div class='col-md-12'><p><i class='glyphicon glyphicon-ok'></i> Exibindo <span class='badge badge-primary'>" . $count . '</span> registro(s) de <span class="badge badge-primary">' . $Pager->getRowCount(). '</span> encontrado(s)</p></div>'; 
                        foreach($readLog->getResult() AS $log):
                            extract($log); 
            ?>
           
            <tr>
                <td><i class="glyphicon glyphicon-ok"></i> <?= $usu_Usuario_chr;?></td>
                <td><?= $Fantasia;?></td>
                <td><?= date("d/m/Y H:i:s", strtotime($DataAcesso));?></td>
                <?php
                    if($DataAcesso > $DataAtivacao && $IdStatus != 1){
                    echo "<td class='text-danger'>Houve uma tentativa de acesso</td>";
                }else{
                ?>
                <td><?= $Login;?></td>
                <?php } ?>

                <td><?= $IPAcesso;?></td>
                <td><?= $Browser;?></td>
                <td><?= $DescricaoStatus;?></td>
            </tr>
            <?php
                endforeach;
                endif;
            ?>
            <tr>
            <p> Este Associado esta <span class='badge badge-primary'><?= $DescricaoStatus;?></span> desde <span class='badge badge-primary'><?= date("d/m/Y", strtotime($DataAtivacao));?></span></p>
            </tr>
        </table>
        <?php
            //PAGINACAO FOOTER
            echo "<div class='col-md-12 text-center'>";
                $Pager->ExeFullPaginator($querySql);
                echo $Pager->getPaginator();
            echo "</div>";
        ?>
    </div>
</div>