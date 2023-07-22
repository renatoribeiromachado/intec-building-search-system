<!--FOLLOWUP-->
<?php
    if (!class_exists('Login')) :
        header('Location: ../../painel.php');
        die;
    endif;
    
    $read = new Read;
?>
<div class="container">
    <h4><b>Cadastro de SIG - Empresa</b></h4>
    <?php
        $RazaoSocial = filter_input(INPUT_GET, 'RazaoSocial', FILTER_DEFAULT);
        $Codigo      = filter_input(INPUT_GET, 'Codigo', FILTER_DEFAULT);
        $dataBd      = date("Y-m-d");
        
        $data = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        if (!empty($data) && isset($data['SendPostForm'])):
            $tmp = explode("/",$data['DataAgenda']);
            $data['DataAgenda'] = $tmp[2] . "-" . $tmp[1] . "-" . $tmp[0];
            unset($data['SendPostForm']);
            require('_models/AdminSigEmpresa.class.php');
            $cadastra = new AdminSigEmpresa;
            $cadastra->ExeCreate($data);
            WSErro($cadastra->getError()[0],$cadastra->getError()[1]);
        endif;  
    ?>  
    <form class="search" autocomplete="off" name="PostForm" action="" method="post">
        <input type="hidden" name="IDUSUARIO" value="<?= $userlogin['usu_Usuario_int_PK'];?>"/>
        <input type="hidden" name="token" value="abcdr12546584@12345htt!@#$"/>
        <input type="hidden" name="IDEMPRESA_OBRA" id="id" value="<?= $Codigo;?>" />
        <input type="hidden" name="IDASSOCIADO" value="<?= $userlogin['emp_IdEmpresa_int_FK'];?>" />
        <input type="hidden" name="DATA" value="<?= $dataBd;?>" />
        <input type="hidden" name="INDTIPO" id="tipo" value="0" />
   
        <div class="col-lg-12">
            <p><b>EMPRESA:</b> <?= $RazaoSocial;?></p>
            <p><b>DATA:</b> <?= $dataBd = date("d/m/Y", strtotime($dataBd));?></p>
        </div>
        <div class="form-group">
            <div class="col-sm-4">
                <label class="control-label"> Agendar Para</label>
                <input type="text" name="DataAgenda" class="form-control datepicker" value="" placeholder="Digite a Data..." required>
                <div class="help-block with-errors"></div>
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-4">
                <label class="control-label"> Prioridade</label>
                <select name="PRIORIDADE" class="form-control">
                    <option value="1">Baixa</option>
                    <option value="2">Média</option>
                    <option value="3">Alta</option>
                </select>
                <div class="help-block with-errors"></div>
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-4">
                <label class="control-label"> Status</label>
                <select name="IDSTATUSSIG" class="form-control">
                    <?php
                        $readEst = $read;
                        $readEst->ExeRead("tb_statussig_sts","ORDER BY DescricaoStatusSIG");
                        if($readEst->getResult()):
                        foreach($readEst->getResult() AS $sts):
                            extract($sts);
                            echo "<option value='$IdStatusSIG'>{$DescricaoStatusSIG}</option>";
                        endforeach;
                        endif;
                    ?>
                </select>
                <div class="help-block with-errors"></div>
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-12">
                <label class="control-label">Descrição</label>
                <textarea name="DESCRICAO" class="form-control" rows="3"></textarea>
                <div class="help-block with-errors"></div>
            </div>
        </div>
        <div class="modal-footer">
            <div class="col-sm-12">
                <button type="button" class="btn btn-danger fechar">Fechar</button>
                <button name="SendPostForm" type="submit" class="btn btn-primary submit" value="1" >Cadastrar</button>
           </div>
        </div>
    </form>
    
    <div class="row top10"></div>
    
    <div class="col-md-12">
        <p class="boxtitle"><i class="glyphicon glyphicon-check"></i> <b>SIG RELATADO PARA ESSA EMPRESA: <?= $RazaoSocial;?></b></p>
        <table class="table table-bordered table-condensed">
            <?php
                //LEITURA 
                $readF = $read;
                $readF->FullRead("SELECT fup.IDFOLLOWUP, fup.DATA,
                                    fup.DataAgenda,
                                    fup.PRIORIDADE,
                                    fup.DESCRICAO,
                                    usu.usu_Usuario_chr
                                    FROM tb_followup_fup AS fup
                                        INNER JOIN tb_usuario_usu AS usu
                                    ON usu.usu_Usuario_int_PK = fup.IDUSUARIO
                                    WHERE fup.IDEMPRESA_OBRA = $Codigo
                                    AND fup.IDASSOCIADO = {$userlogin['emp_IdEmpresa_int_FK']}
                                    ORDER BY fup.IDFOLLOWUP ASC");
                if(!$readF->getResult()):
                    WSErro("Nenhum SIG relatado para essa Empresa até o momento!", WS_INFOR);
                    else:
                    foreach($readF->getResult() as $fo):
                        extract($fo);  
            ?>
            <tr>
                <th><b>Data</b></th>
                <th><b>Empresa</b></th>
                <th><b>Relator</b></th> 
                <th><b>Agendamento</b></th>
                <th><b>Status SIG</b></th>
            </tr>
            <tr>
                <td><?= Check::Date($DATA);?></td>
                <td><?= $RazaoSocial;?></td>
                <td><?= $usu_Usuario_chr;?></td>
                <td><?= Check::Date($DataAgenda);?></td>
                <?php
                    $readSta = $read;
                    $readSta->FullRead("SELECT fup.IDEMPRESA_OBRA,
                                                sts.DescricaoStatusSIG 
                                                FROM tb_followup_fup as fup
                                                    LEFT JOIN tb_statussig_sts AS sts
                                                ON sts.IdStatusSIG = fup.IDSTATUSSIG 
                                                WHERE fup.IDEMPRESA_OBRA = $Codigo
                                                    AND fup.IDFOLLOWUP = $IDFOLLOWUP
                                                AND fup.IDASSOCIADO = " .$userlogin['emp_IdEmpresa_int_FK']. " 
                                                ORDER BY fup.IDFOLLOWUP DESC LIMIT 1");  
                ?>
                <td class="text-primary text-center">
                    <b><?php 
                            if($readSta->getResult()){
                            foreach($readSta->getResult() AS $rest){
                                extract ($rest); 
                                echo $DescricaoStatusSIG;
                            }}
                        ?>
                    </b>
                </td>
            </tr> 
            <tr>
                <td colspan="5"><?= $DESCRICAO;?></td>   
            </tr>
            <?php
                switch($PRIORIDADE){
                    case 1:
                        $PRIORIDADE = "Baixa";
                        break;
                    case 2:
                        $PRIORIDADE = "Média";
                        break;
                    case 3:
                        $PRIORIDADE = "Alta";
                        break;
                }
            ?>
            <tr>
                <td colspan="5"><b>Prioridade:</b> <span class="text-danger"><b><?= $PRIORIDADE;?></b></span></td>   
            </tr>
            <?php
                endforeach;
                endif;  
            ?>
        </table>
    </div>
</div>
<script>
    $(function(){
        $(".fechar").on("click", function() {
            window.close();  
        });
    });
</script>