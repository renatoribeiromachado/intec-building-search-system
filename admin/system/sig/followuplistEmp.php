<?php
    if (!class_exists('Login')) :
        header('Location: ../../painel.php');
        die;
    endif;
    
    $read = new Read;
?>
<div class="bg-info bottom20">
    <div class="col-md-12 bottom20 bg_blue">
        <p class="text-center"><i class="glyphicon glyphicon-check"></i> SIG's Cadastrados de Empresa</p>
    </div>
    <div class="container-fluid">
        <table class="table table-bordered table-condensed">
            
            <?php
                //VIA GET
                $Codigo  = filter_input(INPUT_GET, 'Codigo', FILTER_DEFAULT);
                $readEmp = $read;
                $readEmp->ExeRead("tb_empresas_emp", "WHERE Codigo = {$Codigo}");

                if(!$readEmp->getResult()):
                    WSErro("Não Existe Empresa cadastrada com esse Código", WS_INFOR);
                    else:
                    foreach($readEmp->getResult() as $emp):
                        extract($emp);      
            ?>
            <tr>
                <td colspan="5"><i class="glyphicon glyphicon-check"></i> <b><?= $RazaoSocial;?></b></td>
            </tr>
            <tr>
                <th colspan="4"></th>
                <th><b>Novo SIG</b></th>
            </tr>
            <tr>
                <td colspan="4"></td>
                <td><a title="Cadastrar Novo SIG" class="btn btn-default search" data-toggle="modal" data-target="#followup" 
                        data-id="<?= $Codigo; ?>" 
                        data-empresa="<?= $RazaoSocial; ?>">
                        <i class="glyphicon glyphicon-align-left"></i>
                    </a>
                </td>
            </tr>
            <tr>
                <th><b>Descrição</b></th>
                <th><b>Relator</b></th>
                <th><b>Data</b></th>
                <th><b>Agendamento</b></th>
                <th><b>Excluir</b></th>
            </tr>
            <?php
                endforeach;
                endif;
                
                //DELETE
                $del = filter_input(INPUT_GET, 'del', FILTER_DEFAULT);
                $Cod = filter_input(INPUT_GET, 'Cod', FILTER_DEFAULT);
                if ($del):
                    require ('_models/AdminFollowupEmp.class.php');
                    $delete = new AdminFollowupEmp;
                    $delete->ExeDelete($del);
                    header("Location: painel.php?exe=sig/followuplistEmp&Codigo={$Cod}");
                endif;
                
                //LEITURA
                $read = $read;
                $read->FullRead("SELECT fup.IDFOLLOWUP,
                                        fup.IDUSUARIO,
                                        fup.IDEMPRESA_OBRA,
                                        fup.DATA,
                                        fup.DESCRICAO,
                                        fup.DataAgenda,
                                        usu.usu_Usuario_chr
                                        FROM tb_followup_fup AS fup
                                            INNER JOIN tb_usuario_usu AS usu
                                        ON usu.usu_Usuario_int_PK = fup.IDUSUARIO
                                        WHERE fup.IDEMPRESA_OBRA = {$Codigo}
                                        AND fup.IDUSUARIO = {$userlogin['usu_Usuario_int_PK']}
                                        ORDER BY fup.DATA");
                if(!$read->getResult()):
                echo "<div class='col-md-12'>";
                    WSErro("Não Existe SIG's cadastrado(s) ainda, clique no Botão <b>Novo SIG</b> abaixo!!", WS_INFOR);
                echo "</div>";
                    else:
                    foreach($read->getResult() as $res):
                        extract($res);      
            ?>
            <tr>
                <td><i class="glyphicon glyphicon-ok"></i> <?= $DESCRICAO;?></td>
                <td><?= $usu_Usuario_chr;?></td>
                <td><?= date("d/m/Y", strtotime($DATA));?></td>
                <td><?= date("d/m/Y", strtotime($DataAgenda));?></td>
                <td><a href="painel.php?exe=sig/followuplistEmp&del=<?= $IDFOLLOWUP;?>&Cod=<?= $IDEMPRESA_OBRA;?>" title="deletar"><i class="glyphicon glyphicon-remove"></i></a></td>
            </tr>
            <?php
                endforeach;
                endif;
            ?>
        </table>
        
        <!--BOTÕES-->
        <div class="modal-footer">
            <div class="col-md-12">
                <a href="painel.php?exe=sig/empresa" class="btn btn-primary" title="Nova Pesquisa"><i class="glyphicon glyphicon-ok"></i> Nova Pesquisa SIG</a>
            </div>
        </div>
    </div>
    
    <!--FOLLOWUP-->
    <div class="modal fade" id="followup" tabindex="-1" role="dialog" aria-labelledby="formUpdate">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="formUpdate"><i class="glyphicon glyphicon-align-left"></i> <b>SIG Obra</b></h4>
                </div>
                <div class="modal-body">
                    <?php
                        $dataBd = date("Y-m-d");
                        $data = filter_input_array(INPUT_POST, FILTER_DEFAULT);
                        if ($data && isset($data['Send'])):
                            $data['DataAgenda'] = Check::JustData($data['DataAgenda']);
                            unset($data['Send']);
                            require('_models/AdminFollowupEmp.class.php');
                            $cadastra = new AdminFollowupEmp;
                            $cadastra->ExeCreate($data);
                        endif;
                    ?>
                    <form class="search" name="PostForm" action="" method="post">
                        <input type="hidden" name="IDUSUARIO" value="<?= $userlogin['usu_Usuario_int_PK'];?>"/>
                        <input type="hidden" name="token" value="abcdr12546584@12345htt!@#$"/>
                        <input type="hidden" name="IDASSOCIADO" value="<?= $userlogin['emp_IdEmpresa_int_FK'];?>" />
                        <input type="hidden" name="IDEMPRESA_OBRA" id="id" value="" />
                        <input type="hidden" name="DATA" value="<?= $dataBd;?>" />
                        <input type="hidden" name="INDTIPO" id="tipo" value="0" />
         
                        <div class="col-lg-12">
                            <p><b>EMPRESA:</b> <span id="nomeEmpresa"></span></p>
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
                                <textarea name="DESCRICAO" class="form-control" rows="5"></textarea>
                                <div class="help-block with-errors"></div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <div class="col-sm-12">
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Fechar</button>
                                <button type="submit" class="btn btn-primary submit" value="1" name="Send" />Cadastrar</button>
                           </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Script para pegar os dados do formulario -->
<script>
    $('#followup').on('show.bs.modal', function (event) {
      var button    = $(event.relatedTarget) // Button that triggered the modal
      var id        = button.data('id') // Extract info from data-* attribute
      var empresa   = button.data('empresa')
      var tipo      = button.data('tipo')

      // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
      // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.

      var modal = $(this)
      modal.find('.modal-title').text('SIG Empresa - ' + empresa)
      //modal.find('.modal-body input').val(id)
      modal.find('#id').val(id)
      modal.find('#empresa').val(empresa)
      modal.find('#nomeEmpresa').text(empresa)
      modal.find('#tipo').val(tipo)
    })
</script> 