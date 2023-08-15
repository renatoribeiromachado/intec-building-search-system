<?php
    if (!class_exists('Login')) :
        header('Location: ../../painel.php');
        die;
    endif;
    
    $read = new Read;
    $read->ExeRead("menu_permissao", "WHERE id_usuario = '".$userlogin['usu_Usuario_int_PK']."' AND id_sub_pagina='3'");
    if($read->getResult()):
        foreach($read->getResult() AS $res):
            extract($res);
        endforeach;
    endif;
   
    if($id_usuario = $userlogin['usu_Usuario_int_PK'] && $id_sub_pagina == 3){
    
    //Edição    
    $id      = filter_input(INPUT_POST, "Codigo", FILTER_VALIDATE_INT);
    $data    = filter_input_array(INPUT_POST, FILTER_DEFAULT);
    
    if (isset($data) && isset($data['SendDados'])):
        unset($data['SendDados']);
        $data['DataCadastro'] = Check::Data($data['DataCadastro']);
        $data['Publicacao']   = Check::Data($data['Publicacao']);
        $data['Atualizacao']  = Check::Data($data['Atualizacao']);

        $data['Inicio']  = ($data['Inicio'] ? Check::Data($data['Inicio']) : null);
        $data['Termino'] = ($data['Termino'] ? Check::Data($data['Termino']) : null);
        //VALOR
        $data['Valor']   = str_replace('.', '', $data['Valor']);
        $data['Valor']   = str_replace(',', '.', $data['Valor']);
        require('_models/AdminObras.class.php');
        require('_models/AdminObrasRevisao.class.php');
        //require('_models/AdminGeolocation.class.php');
        $create = new AdminObrasRevisao;
        $create->ExeCreate($data);
        //$createG = new AdminGeolocation;
        //$createG->ExeCreate($data);
        $update = new AdminObras;
        $update->ExeUpdate($id,$data);
    endif;
     
    //delete
    $delete = filter_input(INPUT_GET, 'delete', FILTER_VALIDATE_INT);
    if(isset($delete)):
        require_once("_models/AdminObras.class.php");
        $deletar = new AdminObras;
        $deletar->ExeDelete($delete);
        WSErro($deletar->getError()[0],$deletar->getError()[1]);
        return;
    endif;
?>
<div class="bg-info bottom20 content" id="updateObra">
    <div class="col-md-12 bottom20 bg_orange">
        <p class="text-center"><i class="glyphicon glyphicon-check"></i> EDITANDO OBRA <code>Dados Cadastrais</code></p>
    </div>
    <?php
        //require_once "class/Maps.php";
        //$gmaps = new Maps('AIzaSyDDSlCleF-DknwNsDA2qjLeaWTxkyf7JyU');
         
        $IdObra = filter_input(INPUT_GET, "IdObra" , FILTER_VALIDATE_INT);
        $IdEmpresa = filter_input(INPUT_GET, "IdEmpresa" , FILTER_VALIDATE_INT);
        $readO = $read;
        $readO ->FullRead("SELECT obr.id, obr.Codigo,
                                    obr.CodigoAntigo,
                                    obr.Atualizacao,
                                    obr.Publicacao,
                                    obr.NrDaRevisao,
                                    obr.Pesquisador,
                                    obr.Projeto,
                                    obr.Valor,
                                    obr.Cub,
                                    obr.Padrao,
                                    obr.AreaConstruida,
                                    obr.CapacidadeDeProducao,
                                    obr.ProdutoFinal,
                                    obr.MateriaPrima,
                                    obr.Endereco,
                                    obr.numero,
                                    obr.Complemento,
                                    obr.CEP,
                                    obr.Cidade,
                                    obr.Estado,
                                    obr.Inicio,
                                    obr.Termino,
                                    obr.IdEstagio,
                                    obr.EstagioAtual,
                                    obr.IdTipo,
                                    obr.DescProj1,
                                    obr.IdEstado,
                                    obr.IdFase,
                                    obr.DataCadastro,
                                    obr.InicioTermino,
                                    obr.INDDEMO,
                                    obr.INDSTATUS,
                                    obr.OBR_REGIAO_IND,
                                    obr.OBR_REGIAO_ENUM_IND,
                                    obr.obr_IdSubTipo,
                                    obr.obr_EstagioDetalhes_chr,
                                    obr.obr_DescResidEdificio_chr,
                                    obr.obr_DescResidResidenciais_chr,
                                    obr.obr_DescResidCondominios_chr,
                                    obr.obr_DescResidPavimentos_chr,
                                    obr.obr_DescResidApartamentos_chr,
                                    obr.obr_DescResidDormitorios_chr,
                                    obr.obr_DescResidSuite_chr,
                                    obr.obr_DescResidBanheiro_chr,
                                    obr.obr_DescResidLavabo_chr,
                                    obr.obr_DescResidSala_chr,
                                    obr.obr_DescResidCopa_chr,
                                    obr.obr_DescResidATV_chr,
                                    obr.obr_DescResidDepEmpreg_chr,
                                    obr.obr_DescResidOutros_chr,
                                    obr.obr_AreaLazer_int,
                                    obr.obr_DescInfoAdicTotalUnicades_chr,
                                    obr.obr_DescInfoAdicAreaUtil_chr,
                                    obr.obr_DescInfoAdicAreaTerreno_chr,
                                    obr.obr_DescInfoAdicElevador_chr,
                                    obr.obr_DescInfoAdicVagas_chr,
                                    obr.obr_DescInfoAdicCobert_chr,
                                    obr.obr_DescInfoAdicArCondic_chr,
                                    obr.obr_DescInfoAdicAquecimento_chr,
                                    obr.obr_DescInfoAdicFundacoes_chr,
                                    obr.obr_DescInfoAdicEstrutura_chr,
                                    obr.obr_DescInfoAdicAcabamento_chr,
                                    obr.obr_DescInfoAdicFachada_chr,
                                    obr.obr_Foto_chr,
                                    obr.obr_Mapa_chr,
                                    obr.obr_IdTipoCotacao_int,
                                    obr.obr_ValorDolar_chr,
                                    obr.obr_OutrosAreaLazer_chr,
                                    obr.obr_IdTipoCotacao_int,
                                    pes.IdPesquisador,
                                    pes.SiglaPesquisador,
                                    seg.seg_Segmento_chr AS segmento,
                                    tip.DescricaoTipo,
                                    fas.IdFase AS faseId,
                                    fas.DescricaoFase AS DescFase,
                                    estg.IdEstagio,
                                    estg.DescricaoEstagio,
                                    est.UF,
                                    sta.DescricaoStatus AS status
                                    FROM tb_obras_obr AS obr
                                        LEFT JOIN tb_pesquisadores_pes AS pes
                                    ON pes.IdPesquisador = obr.Pesquisador
                                        LEFT JOIN tb_estados_est As est
                                    ON est.IdEstado = obr.IdEstado
                                        LEFT JOIN tb_segmento_seg As seg
                                    ON seg.seg_Segmento_int_PK = obr.obr_IdSubTipo
                                        LEFT JOIN tb_tipos_tip As tip
                                    ON tip.IdTipo = obr.IdTipo
                                        LEFT JOIN tb_fases_fas As fas
                                    ON fas.IdFase = obr.IdFase
                                        LEFT JOIN tb_estagio_est As estg
                                    ON estg.IdEstagio = obr.IdEstagio  
                                        LEFT JOIN tb_status_sta As sta
                                    ON sta.IdStatus = obr.INDSTATUS
                                    WHERE obr.Codigo = $IdObra 
                                    GROUP BY obr.codigo
                                    ");
        if(!$readO->getResult()):
            WSErro("Obra não Encontrada",WS_INFOR);
            else:
                foreach($readO->getResult() AS $obr):
                    extract($obr); 
                    //$adress = $Endereco. ' - ' .$Complemento. ' , ' .$Cidade. ' - ' .$UF;
                    //echo $adress;
                    //$dados  = $gmaps->geoLocal($adress);
                    
                    $Valor = number_format($Valor,2,",",".");
    ?>
    <!--Formulário Geral-->
    <form class="update search" name="PostForm" action="" method="post">
        <input type="hidden" class="form-control" name="Codigo" value="<?= $IdObra;?>"/>
        <!-- longitude latitude e id da obra
        <input type="hidden" name="idAdress" class="form-control" value="<?= $id;?>"/>
        <input type="hidden" name="longitude" class="form-control" value="<?= $dados->lng;?>"/>
        <input type="hidden" name="latitude" class="form-control" value="<?= $dados->lat;?>"/>
        -->

        <div class="col-md-2" style="margin-right: 10px;">
            <?php
                if($obr_Foto_chr == NULL){
                    echo "<a href='' data-toggle='modal' data-target='#updateFoto' title='Editar Foto' data-id='$Codigo'><img src='images/logomarca.png' width='196' height='123' alt='Indisponivel'/></a>";
                }else{
            ?> 
            <a href="" data-toggle="modal" data-target="#updateFoto" title="Editar Foto" data-id="<?= $Codigo;?>"><img src="../tim.php?src=uploads/<?= $obr_Foto_chr;?>&w=220&h=110" alt="<?= $Projeto;?>"/></a>
            <?php
                } 
            ?>
        </div>
        <div class="col-sm-2">
            <label class="control-label"><i class="glyphicon glyphicon-check"></i> Código</label>
            <input type="text" name="" class="form-control" value="<?= $Codigo;?>" readonly=""/>
            <div class="help-block with-errors"></div>
        </div>
        <div class="col-sm-2">
            <label class="control-label"><i class="glyphicon glyphicon-check"></i> Data de Cadastro</label>
            <input type="text" name="DataCadastro" class="form-control datepicker" value="<?= date("d/m/Y", strtotime($DataCadastro));?>" readonly=""/>
            <div class="help-block with-errors"></div>
        </div>
        <div class="col-sm-2">
            <label class="control-label"><i class="glyphicon glyphicon-check"></i> Código INTECNet</label>
            <input type="text" name="CodigoAntigo" class="form-control" value="<?= $CodigoAntigo;?>"/>
            <div class="help-block with-errors"></div>
        </div>
        <div class="col-sm-2">
            <label class="control-label"><i class="glyphicon glyphicon-check"></i> Data de Publicação</label>
            <input type="text" name="Publicacao" class="form-control" value="<?= date("d/m/Y", strtotime($Publicacao));?>" readonly=""/>
            <div class="help-block with-errors"></div>
        </div>
          
        <div class="row bottom20">    
        </div>
        
        <div class="col-sm-6">
            <label class="control-label"><i class="glyphicon glyphicon-check"></i> Pesquisador</label>
            <select name="Pesquisador" class="form-control form-group">
                <?php
                    if(!$IdPesquisador){
                       echo "<option value='0'>Pesquisador não existe ou não foi cadastrado, Selecione</option>";
                    }else{
                        echo "<option value='$IdPesquisador'>$SiglaPesquisador</option>";
                    }
                       $readPes = $read;
                        $readPes->ExeRead("tb_pesquisadores_pes", "ORDER BY SiglaPesquisador");
                        if(!$readPes->getResult()):
                            echo "<option value='0'>Não encontrado</option>";
                        else:
                            foreach($readPes->getResult() as $pe):
                                extract($pe);
                                echo "<option value='$IdPesquisador'>$SiglaPesquisador</option>";
                            endforeach;
                        endif;
                ?>
                </select>
            <div class="help-block with-errors"></div>
        </div>
        <div class="col-sm-3">
            <label class="control-label"><i class="glyphicon glyphicon-check"></i> Revisão</label>
            <?php
                if($userlogin['usu_Usuario_int_PK'] == 6025 || $userlogin['usu_Usuario_int_PK'] == 10675 || $userlogin['usu_Usuario_int_PK'] == 10937 || $userlogin['usu_Usuario_int_PK'] == 6446){
                    echo "<input type='text' name='NrDaRevisao' class='form-control' value='$NrDaRevisao' required=''/>";
                }else{
            ?>            
            <input type="text" name="NrDaRevisao" data-num-revisao="<?= $NrDaRevisao;?>" class="form-control" value="<?= $NrDaRevisao;?>" readonly=""/>
            <?php } ?>
            <div class="error"></div>
        </div>
        <?php
            $dataAtual = date("d/m/Y");
            if($Atualizacao == NULL ? $Atualizacao = $dataAtual : $Atualizacao = date("d/m/Y", strtotime($Atualizacao)));
        ?>
        <div class="col-sm-3">
            <label class="control-label"><i class="glyphicon glyphicon-check"></i> Data de Atualização</label>
            <input type="hidden" class="atualizacao" value="<?=$Atualizacao;?>"/>
            <input type="hidden" class="atualizacaoAtual" value=""/>
            <input type="text" name="Atualizacao" class="form-control datepicker" value="<?=$Atualizacao;?>"/>
            <div class="help-block with-errors"></div>
        </div>
        <div class="col-sm-12">
            <label class="control-label"><i class="glyphicon glyphicon-check"></i> Obra</label>
            <input type="text" name="Projeto" class="form-control text-uppercase" value="<?= $Projeto;?>"/>
            <div class="help-block with-errors"></div>
        </div>
        <div class="col-sm-3">
            <label class="control-label"><i class="glyphicon glyphicon-check"></i> CEP</label>
            <input type="text" name="CEP" class="form-control cep" id="cep" value="<?= $CEP;?>"/>
            <div class="help-block with-errors"></div>
        </div>
        <div class="col-sm-7">
            <label class="control-label"><i class="glyphicon glyphicon-check"></i> Endereço</label>
            <input type="text" name="Endereco" class="form-control" id="rua" value="<?= $Endereco;?>"/>
            <div class="help-block with-errors"></div>
        </div>
        <div class="col-sm-2">
            <label class="control-label"><i class="glyphicon glyphicon-check"></i> Nº</label>
            <input type="text" name="numero" class="form-control" id="numero" value="<?= $numero;?>"/>
            <div class="help-block with-errors"></div>
        </div>
        <div class="col-sm-5">
            <label class="control-label"><i class="glyphicon glyphicon-check"></i> Bairro</label>
            <input type="text" name="Complemento" class="form-control" id="bairro" value="<?= $Complemento;?>"/>
            <div class="help-block with-errors"></div>
        </div>
        <div class="col-sm-2">
            <label class="control-label"><i class="glyphicon glyphicon-check"></i> UF</label>
            <select name="IdEstado" class="form-control" id="uf">
                <option value="<?= $IdEstado;?>"><?= $UF;?></option>
                    <?php
                        $readE = $read;
                        $readE->ExeRead("tb_estados_est", "ORDER BY UF");
                        if($readE->getResult()):
                            foreach($readE->getResult() AS $est):
                                extract($est);
                                echo "<option ";
                                    if($IdEstado == $data['IdEstado']){
                                        echo "selected='selected'";
                                    }
                                echo "value='$IdEstado'>$UF</option>";
                            endforeach;
                        endif;
                    ?>
            </select>
            <div class="help-block with-errors"></div>
        </div>
        <div class="col-sm-5">
            <label class="control-label"><i class="glyphicon glyphicon-check"></i> Cidade</label>
            <select name="Cidade" class="form-group form-control" id="cidade">
                    <option value="<?= $Cidade;?>"><?= $Cidade;?></option>
                    <?php
                        $readC = $read;
                        $readC->ExeRead("tb_cidades_cid", "ORDER BY cidade");
                        if($readC->getResult()):
                            foreach($readC->getResult() AS $cid):
                                extract($cid);
                                echo "<option ";
                                    if($cidade == $data['cidade']){
                                        echo "selected='selected'"; 
                                    }
                                echo "value='$cidade'>$cidade</option>";
                            endforeach;
                        endif;
                    ?>
                </select>
            <div class="help-block with-errors"></div>
        </div>
        <div class="col-sm-6">
            <label class="control-label"><i class="glyphicon glyphicon-check"></i> Segmento de Atuação</label>
            <select name="obr_IdSubTipo" class="form-control form-group">
                <option value="<?= $obr_IdSubTipo;?>"><?= $segmento;?></option>
                <?php
                    $readSeg = $read;
                    $readSeg->ExeRead("tb_segmento_seg","ORDER BY seg_Segmento_chr");
                    if(!$readSeg->getResult()):
                        echo "<option value='0'>Não encontrado</option>";
                        else:
                            foreach($readSeg->getResult() as $seg):
                                extract($seg);
                                if($segmento != $seg_Segmento_chr){
                                    echo "<option value='$seg_Segmento_int_PK'>$seg_Segmento_chr</option>";
                                 }
                            endforeach;
                    endif;
                ?>
            </select>
            <div class="help-block with-errors"></div>
        </div>
        <div class="col-sm-6">
            <label class="control-label"><i class="glyphicon glyphicon-check"></i> Sub-Tipo</label>
            <select name="IdTipo" class="form-control">
                <?php
                    $readTipoSelect = $read;
                    $readTipoSelect->ExeRead("tb_tipos_tip","WHERE IdTipo = $IdTipo");
                    if(!$readTipoSelect->getResult()):
                        echo "<option value='0'>Não encontrado</option>";
                        else:
                        foreach($readTipoSelect->getResult() as $tipsel):
                            extract($tipsel);
                            echo "<option value='$IdTipo'>$DescricaoTipo</option>";
                        endforeach;
                    endif;
                    
                    $readT = $read;
                    $readT->ExeRead("tb_tipos_tip","WHERE seg_Segmento_int_FK = $seg_Segmento_int_PK");
                    if(!$readT->getResult()):
                        echo "<option value='0'>Não encontrado</option>";
                        else:
                        foreach($readT->getResult() as $tip):
                            extract($tip);
                            echo "<option value='$IdTipo'>$DescricaoTipo</option>";
                        endforeach;
                    endif;
                ?>
            </select>
            <div class="help-block with-errors"></div>
        </div>
        <div class="row"></div>
        <div class="col-sm-6">
            <label class="control-label"><i class="glyphicon glyphicon-check"></i> Fase</label>
            <select name="IdFase" class="form-control form-group">
                <option value="<?= $faseId;?>"><?= $DescFase;?></option>
                <?php
                    $readFA = $read;
                    $readFA->ExeRead("tb_fases_fas", "ORDER BY DescricaoFase");
                    if(!$readFA->getResult()):
                        echo "<option value='0'>Não encontrado</option>";
                        else:
                            foreach($readFA->getResult() as $fas):
                                extract($fas);
                                if($DescFase != $DescricaoFase){
                                    echo "<option value='$IdFase'>$DescricaoFase</option>";
                                }
                            endforeach;
                    endif;
                ?>
            </select>
            <div class="help-block with-errors"></div>
        </div>
        <div class="col-sm-6">
            <label class="control-label"><i class="glyphicon glyphicon-check"></i> Estagio Atual</label>
            <select name="IdEstagio" class="form-group form-control">
                <?php
                    $readEstSelect = $read;
                    $readEstSelect->ExeRead("tb_estagio_est","WHERE IdEstagio = $IdEstagio");
                    if(!$readEstSelect->getResult()):
                        echo "<option value='0'>Não encontrado</option>";
                        else:
                        foreach($readEstSelect->getResult() as $estsel):
                            extract($estsel);
                            echo "<option value='$IdEstagio'>$DescricaoEstagio</option>";
                        endforeach;
                    endif;
              
                    $readEst = $read;
                    $readEst->ExeRead("tb_estagio_est","WHERE IDFASE = $faseId");
                    if(!$readEst->getResult()):
                        echo "<option value='0'>Não encontrado</option>";
                        else:
                        foreach($readEst->getResult() as $est):
                            extract($est);
                            echo "<option value='$IdEstagio'>$DescricaoEstagio</option>";
                        endforeach;
                    endif; 
                ?> 
            </select>
            <div class="help-block with-errors"></div>
        </div>
        <div class="col-sm-3">
            <label class="control-label"><i class="glyphicon glyphicon-check"></i> Início da Obra</label>
            <?php
                if($Inicio == NULL){
                    echo "<td><input type='text' name='Inicio' class='form-control datepicker' id='Inicio' value=''/></td>";
                }else{
            ?>
            <input type="text" name="Inicio" class="form-control datepicker" id="Inicio" value="<?= date("d/m/Y", strtotime($Inicio));?>"/>
            <?php }?>
            <div class="help-block with-errors"></div>
        </div>
        <div class="col-sm-3">
            <label class="control-label"><i class="glyphicon glyphicon-check"></i> Término da Obra</label>
            <?php
                if($Termino == NULL){
                    echo "<td><input type='text' name='Termino' class='form-control datepicker' id='Termino' value=''/></td>";
                }else{
            ?>
            <input type="text" name="Termino" class="form-control datepicker" id="Termino" value="<?= date("d/m/Y", strtotime($Termino));?>"/>
            <?php }?>
            <div class="help-block with-errors"></div>
        </div>
        <div class="col-sm-3">
            <label class="control-label"><i class="glyphicon glyphicon-check"></i> Início / Término</label>
            <input type="text" name="InicioTermino" class="form-control" value="<?= $InicioTermino;?>"/>
            <div class="help-block with-errors"></div>
        </div>
        <div class="col-sm-3">
            <label class="control-label"><i class="glyphicon glyphicon-check"></i> Valor</label>
            <?php
                if($Valor){
                    echo "<input type='text' name='Valor' class='form-control dinheiro' value='".$Valor."'/>";
                }else{
                    echo "<input type='text' name='Valor' class='form-control dinheiro' value='0,00'/>";
                }
            ?>
            <div class="help-block with-errors"></div>
        </div>
        
        <div class="col-sm-2">
            <label class="control-label"><i class="glyphicon glyphicon-check"></i> PADRÃO <code>investimento</code></label>
            <select name="Padrao" class="form-control">
                <option value="<?= $Padrao;?>"><?= $Padrao;?></option>
                <option value="0">Selecione</option>
                <option value="Alto">Alto</option>
                <option value="Baixo">Baixo</option>
                <option value="Medio">Médio</option>  
            </select>
            <div class="help-block with-errors"></div>
        </div>
       
        <div class="col-sm-2">
            <label class="control-label"><i class="glyphicon glyphicon-check"></i> Área total do Projeto</label>
            <input type="text" name="AreaConstruida" class="form-control" value="<?= $AreaConstruida;?>"/>
            <div class="help-block with-errors"></div>
        </div>
        <div class="col-sm-2">
            <label class="control-label"><i class="glyphicon glyphicon-check"></i> Cub</label>
            <input type="text" name="Cub" class="form-control" value="<?= $Cub;?>"/>
            <div class="help-block with-errors"></div>
        </div>
        
        <div class="col-sm-4">
            <label class="control-label"><i class="glyphicon glyphicon-check"></i> Tipo de Cotação</label>
            <select name="obr_IdTipoCotacao_int" class="form-control">
                <?php
                    $readCot = $read;
                    $readCot->ExeRead("tb_cotacao_cto", "WHERE id='$obr_IdTipoCotacao_int'");
                    foreach($readCot->getResult() AS $cot):
                        extract($cot);
                        echo "<option value='$id'>$nome</option>";
                    endforeach;
              
                    $readCot->ExeRead("tb_cotacao_cto", "ORDER BY nome");
                    foreach($readCot->getResult() AS $cot):
                        extract($cot);
                        echo "<option value='$id'>$nome</option>";
                    endforeach;
                ?>
            </select>
            <div class="help-block with-errors"></div>
        </div>
        <div class="col-sm-2">
            <label class="control-label"><i class="glyphicon glyphicon-check"></i> R$</label>
            <input type="text" name="obr_ValorDolar_chr" class="form-control" value="<?= $obr_ValorDolar_chr;?>" />
            <div class="help-block with-errors"></div>
        </div>
        
        <!--DESCRIÇÃO-->
        <div class="col-md-12 top20 bottom20">
            <p><i class="glyphicon glyphicon-ok"></i> <b>DESCRIÇÃO</b></p>
        
            <table class="table table-bordered table-condensed">
                <tr>
                    <th>Edificio(s) residencial(s)</th> 
                    <th>Casa(s)</th>
                    <th>Condominio</th>
                    <th>Apartamento(s) por Andar</th>
                    <th>Pavimento(s)</th>
                </tr>
                <tr>
                    <td><input type="text" name="obr_DescResidEdificio_chr" class="dados" value="<?= $obr_DescResidEdificio_chr;?>"/></td>
                    <td><input type="text" name="obr_DescResidResidenciais_chr" class="dados" value="<?= $obr_DescResidResidenciais_chr;?>"/></td>
                    <td><input type="text" name="obr_DescResidCondominios_chr" class="dados" value="<?= $obr_DescResidCondominios_chr;?>"/></td>
                    <td><input type="text" name="obr_DescResidApartamentos_chr" class="dados" value="<?= $obr_DescResidApartamentos_chr;?>"/></td>
                    <td><input type="text" name="obr_DescResidPavimentos_chr" class="dados" value="<?= $obr_DescResidPavimentos_chr;?>"/></td>
                </tr>
                <tr>
                    <th>Suites(s)</th>
                    <th>Banheiro(s)</th>
                    <th>Dormitório(s)</th>
                    <th colspan="2">Lavabo(s)</th>
                </tr>
                <tr>
                    <td><input type="text" name="obr_DescResidSuite_chr" class="dados" value="<?= $obr_DescResidSuite_chr;?>"/></td>
                    <td><input type="text" name="obr_DescResidBanheiro_chr" class="dados" value="<?= $obr_DescResidBanheiro_chr;?>"/></td>
                    <td><input type="text" name="obr_DescResidDormitorios_chr" class="dados" value="<?= $obr_DescResidDormitorios_chr;?>"/></td>
                    <td colspan="2"><input type="text" name="obr_DescResidLavabo_chr" class="dados" value="<?= $obr_DescResidLavabo_chr;?>"/></td>
                </tr>
                <tr>
                    <th>Sala(s) de estar / jantar</th>
                    <th>Copa(s) / Cozinha(s)</th>
                    <th>Área(s) de serviço / Terraço(s) / Varanda(s)</th>
                    <th colspan="2">Dependência de empregada</th>
                </tr>
                <tr>
                    <td><select name="obr_DescResidSala_chr" class="form-control">
                            <option value="<?= $obr_DescResidSala_chr;?>"><?= $obr_DescResidSala_chr;?></option>
                            <option value="0/0">0/0</option>
                            <option value="0/1">0/1</option>
                            <option value="1/0">1/0</option>
                            <option value="1/1">1/1</option>
                        </select>
                    </td>
                    <td><select name="obr_DescResidCopa_chr" class="form-control">
                            <option value="<?= $obr_DescResidCopa_chr;?>"><?= $obr_DescResidCopa_chr;?></option>
                            <option value="0/0">0/0</option>
                            <option value="0/1">0/1</option>
                            <option value="1/0">1/0</option>
                            <option value="1/1">1/1</option>
                        </select>
                    </td>
                    <td><select name="obr_DescResidATV_chr" class="form-control">
                            <option value="<?= $obr_DescResidATV_chr;?>"><?= $obr_DescResidATV_chr;?></option>
                            <option value="0/0/0">0/0/0</option>
                            <option value="1/0/1">1/0/1</option>
                            <option value="1/1/1">1/1/1</option>
                            <option value="1/1/0">1/1/0</option>
                            <option value="1/0/0">1/0/0</option>
                        </select>
                    </td>
                    <td colspan="2"><input type="text" name="obr_DescResidDepEmpreg_chr" class="dados" value="<?= $obr_DescResidDepEmpreg_chr;?>"/></td>
                </tr>
            </table>
        </div>
        <?php
            $soma = $obr_AreaLazer_int;
            $checkbox = [ 
                        1 => 1, 
                        2 => 2, 
                        3 => 4, 
                        4 => 8, 
                        5 => 16, 
                        6 => 32, 
                        7 => 64, 
                        8 => 128, 
                        9 => 256, 
                        10 => 512, 
                        11 => 1024
                    ];
       
            $i = 1;
            $key = [];
            while ($soma != 0) {
                if (($soma & $checkbox[$i]) != 0) {
                    $key[] = $i;
                    $soma = $soma - $checkbox[$i];
                }
                $i++;
            }
        ?>
        <!--AREA DE LAZER-->
        <div class="col-md-12 top20 bottom20">
            <p><i class="glyphicon glyphicon-ok"></i> <b>ÁREA DE LAZER</b></p>
        </div>
        <div class="col-md-3">
            <input type="checkbox" name="" value="1" <?= in_array("1", $key) ? "checked" : ""; ?> /> Salão de festas
        </div>
        <div class="col-md-3">
            <input type="checkbox" name="" value="2" <?= in_array("2", $key) ? "checked" : ""; ?>/> Salão de jogos
        </div>
        <div class="col-md-3">
            <input type="checkbox" name="" value="4" <?= in_array("3", $key) ? "checked" : ""; ?>/> Piscina
        </div>
        <div class="col-md-3">
            <input type="checkbox" name="" value="8" <?= in_array("4", $key) ? "checked" : ""; ?>/> Sauna
        </div>
        <div class="col-md-3">
            <input type="checkbox" name="" value="16" <?= in_array("5", $key) ? "checked" : ""; ?>/> Churrasqueira
        </div>
        <div class="col-md-3">
            <input type="checkbox" name="" value="32" <?= in_array("6", $key) ? "checked" : ""; ?>/> Quadra
        </div>
        <div class="col-md-3">
            <input type="checkbox" name="" value="64" <?= in_array("7", $key) ? "checked" : ""; ?>/> Fitness
        </div>
        <div class="col-md-3">
            <input type="checkbox" name="" value="128" <?= in_array("8", $key) ? "checked" : ""; ?>/> Gourmet
        </div>
        <div class="col-md-3">
            <input type="checkbox" name="" value="256" <?= in_array("9", $key) ? "checked" : ""; ?>/> Playground
        </div>
        <div class="col-md-3">
            <input type="checkbox" name="" value="512" <?= in_array("10", $key) ? "checked" : ""; ?>/> Spa
        </div>
        <div class="col-md-3">
            <input type="checkbox" name="" value="1024" <?= in_array("11", $key) ? "checked" : ""; ?>/> Brinquedoteca
        </div>
        
        <!--SOMA DOS CHECKBOX(s)-->
        <div class="col-md-3">
            <input type="hidden" name="obr_AreaLazer_int" class="form-control" value="0" />
        </div>
        
        <div class="col-md-12 top20">
            <label class="control-label"><i class="glyphicon glyphicon-check"></i> Outros</label>
            <input type="text" name="obr_OutrosAreaLazer_chr" class="form-control" value="<?= $obr_OutrosAreaLazer_chr;?>" />
            <div class="help-block with-errors"></div>
        </div>
        
        <!--INFORMAÇÕES ADICIONAIS-->
        <div class="col-md-12 top20 bottom20">
            <p><i class="glyphicon glyphicon-ok"></i> <b>INFORMAÇÕES ADICIONAIS</b></p>
        
            <table class="table table-bordered table-condensed">
                <tr>
                    <th>Total de Unidade(s)</th>
                    <th>Área Útil (m2)</th>
                    <th>Área do Terreno (m2)</th>
                    <th>Elevador(s)</th>
                    <th>Vaga(s)</th>
                    <th>Cobertura(s)</th>
                </tr>
                <tr>
                    <td><input type="text" name="obr_DescInfoAdicTotalUnicades_chr" class="dados" value="<?= $obr_DescInfoAdicTotalUnicades_chr;?>"/></td>
                    <td><input type="text" name="obr_DescInfoAdicAreaUtil_chr" class="dados" value="<?= $obr_DescInfoAdicAreaUtil_chr;?>"/></td>
                    <td><input type="text" name="obr_DescInfoAdicAreaTerreno_chr" class="dados" value="<?= $obr_DescInfoAdicAreaTerreno_chr;?>"/></td>
                    <td><input type="text" name="obr_DescInfoAdicElevador_chr" class="dados" value="<?= $obr_DescInfoAdicElevador_chr;?>"/></td>
                    <td><input type="text" name="obr_DescInfoAdicVagas_chr" class="dados" value="<?= $obr_DescInfoAdicVagas_chr;?>"/></td>
                    <td><input type="text" name="obr_DescInfoAdicCobert_chr" class="dados" value="<?= $obr_DescInfoAdicCobert_chr;?>"/></td>
                </tr>
                <tr>
                    <th>Ar condiconado</th>
                    <th>Aquecimento</th>
                    <th>Fundações</th>
                    <th>Estrutura</th>
                    <th>Acabamento</th>
                    <th>Fachada</th>
                </tr>
                <tr>
                    <td><input type="text" name="obr_DescInfoAdicArCondic_chr" class="dados text-uppercase" value="<?= $obr_DescInfoAdicArCondic_chr;?>"/></td>
                    <td><input type="text" name="obr_DescInfoAdicAquecimento_chr" class="dados text-uppercase" value="<?= $obr_DescInfoAdicAquecimento_chr;?>"/></td>
                    <td><select name="obr_DescInfoAdicFundacoes_chr" class="dados">
                            <option value="<?= $obr_DescInfoAdicFundacoes_chr;?>"><?= $obr_DescInfoAdicFundacoes_chr;?></option>
                            <option value="CASAS">CASAS</option>
                            <option value="Sapata Isolada">Sapata Isolada</option>
                            <option value="Radier">Radier</option>
                            <option value="Sapata Corrida">Sapata Corrida</option>
                            <option value="Viga Baldrame">Viga Baldrame</option>
                            <option value="Bate-Estacas">Bate-Estacas</option>
                            <option value="Estacas">Estacas</option>
                            <option value="Estaca hélice contínua">Estaca hélice contínua</option>
                            <option value="Tubulão">Tubulão</option>
                            <option value="Direta">Direta</option>
                            <option value="Blocos de Fundação">Blocos de Fundação</option>
                            <option value="Franki">Franki</option>
                            <option value="Estaca Raiz">Estaca Raiz</option>
                        </select>
                    </td>
                    <td><select name="obr_DescInfoAdicEstrutura_chr" class="dados">
                            <option value="<?= $obr_DescInfoAdicEstrutura_chr;?>"><?= $obr_DescInfoAdicEstrutura_chr;?></option>
                            <option value="CASAS">CASAS</option>
                            <option value="Bloco Estrutural">Bloco Estrutural</option>
                            <option value="Estruturas metálicas">Estruturas metálicas</option>
                            <option value="Concreto armado">Concreto armado</option>
                            <option value="Concreto protendido">Concreto protendido</option>
                            <option value="Steel frame">Steel frame</option>
                            <option value="Steel deck">Steel deck</option>
                            <option value="Wood frame">Wood frame</option>
                            <option value="Alvenaria estrutural">Alvenaria estrutural</option>
                            <option value="Baldrame">Baldrame</option>
                            <option value="Laje Nervurada">Laje Nervurada</option>
                            <option value="Pré Moldado">Pré Moldado</option>
                            <option value="Parede de Concreto">Parede de Concreto</option>
                        </select>
                    </td>
                    <td><input type="text" name="obr_DescInfoAdicAcabamento_chr" class="dados text-uppercase" value="<?= $obr_DescInfoAdicAcabamento_chr;?>"/></td>
                    <td><input type="text" name="obr_DescInfoAdicFachada_chr" class="dados text-uppercase" value="<?= $obr_DescInfoAdicFachada_chr;?>"/></td>
                </tr>
            </table>
        </div>
        
        <div class="col-sm-12">
            <label class="control-label"><i class="glyphicon glyphicon-check"></i> Descrições Complementares</label>
            <textarea name="DescProj1" class="form-control" rows="5"><?= $DescProj1;?></textarea>
            <div class="help-block with-errors"></div>
        </div>
        <div class="col-sm-3">
            <label class="control-label"><i class="glyphicon glyphicon-check"></i> Status</label>
            <select name="INDSTATUS" class="form-control">
                <option value="<?= $INDSTATUS;?>"><?= $status;?></option>
                <?php
                    $readSt = $read;
                    $readSt->ExeRead("tb_status_emp", "ORDER BY DescricaoStatus");
                    if(!$readSt->getResult()):
                        echo "<option value='0'>Não encontrado</option>";
                        else:
                            foreach($readSt->getResult() as $st):
                                extract($st);
                                if($status !=$DescricaoStatus){
                                    echo "<option value='$IdStatus'>$DescricaoStatus</option>";
                                }
                            endforeach;
                    endif;
                ?>
            </select>
            <div class="help-block with-errors"></div>
        </div>
        <?php
            endforeach;
            endif;
        ?>    
        <!--CONTATOS-->
        <div class="col-md-12 bottom20 bg_orange">
            <p class="text-center"><i class="glyphicon glyphicon-user"></i> CONTATO(s) <code>insira contatos ilimitados</code></p>
        </div>
        <!--LISTA CONTATOS ADD-->
        <div class="col-md-12" id="addContato">
            <table class="table table-bordered table-condensed">
                <tr>
                    <th class="bg-primary"><b>Nome</b></th>
                    <th class="bg-primary"><b>Cargo</b></th>
                    <th class="bg-primary"><b>Empresa</b></th>
                    <th class="bg-primary"><b>Telefone Obra</b></th>
                    <th class="bg-primary"><b>Telefone 1</b></th>
                    <th class="bg-primary"><b>Telefone 2</b></th>
                    <th class="bg-primary"><b>Celular 1</b></th>
                    <th class="bg-primary"><b>Celular 2</b></th>
                    <th class="bg-primary"><b>E-mail</b></th>
                    <th class="bg-primary" colspan="2"><b>AÇÃO</b></th>
                </tr>
                <?php
                    //*DELETE - levo o Codigo do cliente para retornar na pagina update*//
                    $excluir = filter_input(INPUT_GET, 'excluir', FILTER_VALIDATE_INT);
                    if (isset($excluir)):
                        require_once('_models/AdminContatoObras.class.php');
                        $delete = new AdminContatoObras;
                        $delete->ExeDelete($excluir, $IdObra);
                    endif;
                    $readCt = $read;
                    $readCt->FullRead("SELECT cob.id,
                                            cob.NomeContato,
                                            cob.IdCargo,
                                            cob.IDEMPRESA,
                                            cob.DDDFax,
                                            cob.Fax,
                                            cob.DDD,
                                            cob.Telefone,
                                            cob.EMail,
                                            cob.DDD2,
                                            cob.TELEFONE2,
                                            cob.DDD3,
                                            cob.TELEFONE3,
                                            cob.DDD4,
                                            cob.TELEFONE4,
                                            car.DescricaoCargo AS cargo,
                                            emp.Fantasia,
                                            emp.RazaoSocial
                                            FROM tb_contatoobras_cob AS cob
                                                LEFT JOIN tb_cargos_car AS car
                                            ON car.IdCargo = cob.IdCargo
                                                LEFT JOIN tb_empresas_emp AS emp
                                            ON emp.Codigo = cob.IDEMPRESA
                                            WHERE cob.IdObra = $IdObra
                                            ORDER BY cob.NomeContato");
                                            
                    if(!$readCt->getResult()):
                        WSErro("Contato(s) não encontrado(s) ou ainda não cadastrado(s)", WS_INFOR);
                        else:
                        foreach($readCt->getResult() AS $ct):
                            extract($ct);
                ?>
                <tr>
                    <td><i class="glyphicon glyphicon-user"></i> <?= $NomeContato;?></td>
                    <td><?= $cargo;?></td>
                    <td><?= $Fantasia;?></td>
                    <td>(<?= $DDDFax;?>) <?= $Fax;?></td>
                    <td>(<?= $DDD;?>) <?= $Telefone;?></td>
                    <td>(<?= $DDD2;?>) <?= $TELEFONE2;?></td>
                    <td>(<?= $DDD3;?>) <?= $TELEFONE3;?></td>
                    <td>(<?= $DDD4;?>) <?= $TELEFONE4;?></td>
                    <td><a href="mailto:<?= $EMail;?>"><?= $EMail;?></a></td>
                    <?php
                        //Id do Vendedor (COMERCIAL) é 4
                        if($userlogin['IdGrupo'] != 4){
                    ?>
                    <td><button type="button" class="btn btn-success glyphicon glyphicon-edit" title="Editar <?=$NomeContato;?>" data-toggle="modal" data-target="#updateContato" 
                            data-id="<?= $id; ?>"
                            data-nome="<?= $NomeContato; ?>"
                            data-empresa="<?= $Fantasia; ?>"
                            data-cargo="<?= $IdCargo; ?>"
                            data-dddfax="<?= $DDDFax; ?>" 
                            data-fax="<?= $Fax; ?>"
                            data-ddd="<?= $DDD; ?>" 
                            data-telefone="<?= $Telefone; ?>"
                            data-ddd2="<?= $DDD2; ?>" 
                            data-telefone2="<?= $TELEFONE2; ?>"
                            data-ddd3="<?= $DDD3; ?>" 
                            data-celular1="<?= $TELEFONE3; ?>"
                            data-ddd4="<?= $DDD4; ?>" 
                            data-celular2="<?= $TELEFONE4; ?>"
                            data-email="<?= $EMail; ?>">
                        </button>
                    </td>
                    <td><a href="painel.php?exe=obras/update-obras&IdObra=<?= $Codigo;?>&excluir=<?= $id;?>#addContato" title="excluir" class="btn btn-danger"><i class="glyphicon glyphicon-remove" onclick="return confirm ('Deseja realmente deletar?');"></i></a></td>
                </tr>
                <?php
                }else{
                      echo "<td><a class='btn btn-default'>DESABILITADO</a></td>";
                    }
                    endforeach;
                    endif;
                ?> 
                <tr>
                    <tbody class="contatoAdd"></tbody>
                </tr>
            </table>
        </div>
        
        <!--EMPRESAS PARTICIPANTES-->
        <div class="col-md-12 bottom20 bg_orange">
            <p class="text-center"><i class="glyphicon glyphicon-user"></i> EMPRESA(s) PARTICIPANTE(s)</p>
        </div>
        <!--LISTA EMPRESAS ADD-->
        <div class="col-md-12" id="addEmp">
            <table class="table table-bordered table-condensed">
                <tr>
                    <th class="bg-primary"><b>Nome Fantasia</b></th>
                    <th class="bg-primary"><b>Razão Social</b></th>
                    <th class="bg-primary"><b>Modalidade</b></th>
                    <th class="bg-primary" colspan="2"><b>AÇÃO</b></th>
                </tr>
                <?php
                    //*DELETE - levo o Codigo do cliente para retornar na pagina update*//
                    $excluirEmp = filter_input(INPUT_GET, 'excluir', FILTER_VALIDATE_INT);
                    $excluirMod = filter_input(INPUT_GET, 'IDMODALIDADE', FILTER_VALIDATE_INT);
                    if (isset($excluir)):
                        require_once('_models/AdminEmpresaObras.class.php');
                        $delete = new AdminEmpresaObras;
                        $delete->ExeDelete($excluirEmp, $excluirMod, $IdObra);
                    endif;
                 
                    $readEmp = $read;
                    $readEmp->FullRead("SELECT emo.IdEmpresa,
                                                emo.IDMODALIDADE,
                                                emp.Fantasia,
                                                emp.RazaoSocial,
                                                md.DescricaoModalidade
                                                FROM tb_empresas_obras_emo AS emo
                                                    INNER JOIN tb_empresas_emp AS emp
                                                ON emp.Codigo = emo.IdEmpresa
                                                    INNER JOIN tb_modalidades_mod AS md
                                                ON md.IdModalidade = emo.IDMODALIDADE
                                                WHERE emo.IdObra = $IdObra
                                            ");
                                            
                    if(!$readEmp->getResult()):
                        WSErro("Empresa(s) não encontrada(s) ou ainda não cadastrada(s)", WS_INFOR);
                        else:
                        foreach($readEmp->getResult() AS $emp):
                            extract($emp);
                ?>
                <tr>
                    <td><?= $Fantasia;?></td>
                    <td><?= $RazaoSocial;?></td>
                    <td><?= $DescricaoModalidade;?></td>
                    <?php
                        //Id do Vendedor (COMERCIAL) é 4
                        if($userlogin['IdGrupo'] != 4){
                    ?>
                    <td><button type="button" class="btn btn-success glyphicon glyphicon-edit" title="Editar <?=$Fantasia;?>" data-toggle="modal" data-target="#updateEmpresa" 
                            data-id="<?= $IdEmpresa; ?>"
                            data-obra="<?= $IdObra; ?>"
                            data-empresa="<?= $Fantasia; ?>"
                            data-modalidade="<?= $IDMODALIDADE; ?>">
                        </button>
                    </td>
                    <td><a href="painel.php?exe=obras/update-obras&IdObra=<?= $Codigo;?>&excluir=<?= $IdEmpresa;?>&IDMODALIDADE=<?= $IDMODALIDADE;?>#addEmp" title="excluir" class="btn btn-danger"><i class="glyphicon glyphicon-remove" onclick="return confirm ('Deseja realmente deletar?');"></i></a></td>
                </tr>
                <?php
                    }else{
                      echo "<td><a class='btn btn-default'>DESABILITADO</a></td>";
                    }
                    endforeach;
                    endif;
                ?> 
                <tr>
                    <tbody class="empresaAdd"></tbody>
                </tr>
            </table>
        </div>
        <?php
            //Id do Vendedor (COMERCIAL) é 4
            if($userlogin['IdGrupo'] != 4){
        ?>
        <!--BOTOES DE ADD-->
        <div class="modal-footer">
            <div class="col-sm-12">
                <button type="button" class="btn btn-warning btnAddEmp" title="Add Nova(s) Empresa(s) Participante(s)">Add Empresa(s) Participante(s) <i class="glyphicon glyphicon-ok"></i></button>
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-Contato" title="Adicionar contato" >Add Novo Contato <i class="glyphicon glyphicon-ok"></i></button>
                <?php
                    if($userlogin['USU_TIPOUSUARIO_INT'] == 4){
                        echo "<a href='painel.php?exe=obras/update-obras&delete=$Codigo' class='btn btn-danger' title='Excluir Obra'><i class='glyphicon glyphicon-remove'></i> Excluir</a>";
                    }else{
                        echo "";
                    }
                ?>
                <a href="painel.php?exe=obras/cadastro-obras" class="btn btn-info" title="Novo Cadastro de Obra"><i class="glyphicon glyphicon-copy"></i> Novo Cadastro</a>
                <a href="painel.php?exe=obras/pesquisa-obra" class="btn btn-primary back" title="Voltar"> <i class="glyphicon glyphicon-chevron-left"></i> Voltar</a>
                <button type="submit" name="SendDados" class="btn btn-success submit" value="1" title="Gravar Dados"><i class="glyphicon glyphicon-record"></i> Gravar</button>
            </div>
        </div>
        <?php
            }else{
                echo "";
            }
        ?>
    </form>
    
    <!--Revisões-->
    <div class="col-sm-12 top20">
        <div id="flip">
            <p><a style="cursor:pointer" title="Ver Revisões"><i class="glyphicon glyphicon-hand-right"></i> <b>Ver Revisão(s) salva(s) para essa Obra <span class="badge badge-primary"><?= $CodigoAntigo;?></span></b></a> <code>* Clique para ver Revisões Salvas</code></p>
        </div>
        <div id="panel">
            <table class="table table-bordered table-condensed">
                <tr>
                    <td colspan="3"><b>Revisões Salvas<b></td>
                </tr>
                <tr>
                    <th><b>Atualização</b></th>
                    <th><b>Nº da Revisão</b></th>
                    <th><b>Verificar dados dessa Obra</b></th>
                </tr>
                <?php
                    $readRev = $read;
                    $readRev->ExeRead("tb_obras_obr_revisao_rev", "WHERE Codigo = {$Codigo} GROUP BY NrDaRevisao");
                    if($readRev->getResult()):
                        foreach($readRev->getResult() AS $rev):
                            extract($rev);
                ?>
                <tr>
                    <td><i class="glyphicon glyphicon-ok"></i> <?= date("d/m/Y", strtotime($Atualizacao)); ?></td>
                    <td><span class="badge badge-primary"><?= $NrDaRevisao; ?></span></td>
                    <td><a href="painel.php?exe=obras/revisao&NrDaRevisao=<?= $NrDaRevisao;?>&Codigo=<?= $Codigo;?>" title="Visualizar Revisão" target="_blank" class="btn btn-success"><i class="glyphicon glyphicon-eye-open"></i> Visualizar</a></td>
                </tr>
            <?php
                endforeach;
                endif;
            ?>
            </table>
        </div>
    </div> 
    
    <!--MODAL CREATE CONTATO-->
    <div class="modal fade" id="modal-Contato" tabindex="-1" role="dialog" aria-labelledby="formUpdate">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="formUpdate">Cadastrar Novo Contato</h4>
                </div>
                <div class="modal-body">
                    <?php
                        $data = filter_input_array(INPUT_POST, FILTER_DEFAULT);
                        if (isset($data) && isset($data['SendPostForm'])):
                            unset($data['SendPostForm']);
                            require('_models/AdminContatoObras.class.php');
                            $create = new AdminContatoObras;
                            $create->ExeCreate($data);
                            //WSErro($create->getError()[0], $create->getError()[1]);
                        endif;
                    ?>
                    <form class="createNewcontato" name="PostForm" action="" method="post">
                        <input type="hidden" name="IdObra" value="<?= $Codigo;?>" />
                        <div class="form-group">
                            <div class="col-sm-12">
                                <label class="control-label"><i class="glyphicon glyphicon-user"></i> Nome</label>
                                <input type="text" name="NomeContato" class="form-control" value="" placeholder="Nome..." required>
                                <div class="help-block with-errors"></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-6">
                                <label class="control-label"><i class="glyphicon glyphicon-check"></i> Cargo</label>
                                <select name="IdCargo" class="form-control">
                                    <option value="0">SELECIONE</option>
                                    <?php
                                        $readCa = $read;
                                        $readCa->ExeRead("tb_cargos_car", "ORDER BY DescricaoCargo");
                                        if(!$readCa->getResult()):
                                            echo "<option value='0'>Não encontrado</option>";
                                            else:
                                                foreach($readCa->getResult() as $ca):
                                                    extract($ca);
                                                    echo "<option value='$IdCargo'>$DescricaoCargo</option>";
                                                endforeach;
                                        endif;
                                    ?>
                                </select>
                                <div class="help-block with-errors"></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-6">
                                <label class="control-label"><i class="glyphicon glyphicon-phone-alt"></i> Telefone Obra</label>
                                <br>
                                <input type="text" name="DDDFax" autocomplete="off" class="ddd" value="" maxlength="2">
                                <input type="text" name="Fax" autocomplete="off" class="telefone tel" value="" placeholder="Telefone...">
                                <div class="help-block with-errors"></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-6">
                                <label class="control-label"><i class="glyphicon glyphicon-phone-alt"></i> Telefone 1</label>
                                <br>
                                <input type="text" name="DDD" autocomplete="off" class="ddd" value="" maxlength="2">
                                <input type="text" name="Telefone" autocomplete="off" class="telefone tel" value="" placeholder="Telefone...">
                                <div class="help-block with-errors"></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-6">
                                <label class="control-label"><i class="glyphicon glyphicon-phone"></i> Telefone 2 / 0800</label>
                                <br>
                                <input type="text" name="DDD2" autocomplete="off" class="ddd" value="" maxlength="2">
                                <input type="text" name="TELEFONE2" autocomplete="off" class="tel" value="" placeholder="Telefone...">
                                <div class="help-block with-errors"></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-6">
                                <label class="control-label"><i class="glyphicon glyphicon-phone"></i> Celular 1</label>
                                <br>
                                <input type="text" name="DDD3" autocomplete="off" class="ddd" value="" maxlength="2">
                                <input type="text" name="TELEFONE3" autocomplete="off" class="celular tel" value="" placeholder="Celular...">
                                <div class="help-block with-errors"></div>
                            </div>
                        </div> 
                        <div class="form-group">
                            <div class="col-sm-6">
                                <label class="control-label"><i class="glyphicon glyphicon-phone"></i> Celular 2</label>
                                <br>
                                <input type="text" name="DDD4" autocomplete="off" class="ddd" value="" maxlength="2">
                                <input type="text" name="TELEFONE4" autocomplete="off" class="celular tel" value="" placeholder="Celular...">
                                <div class="help-block with-errors"></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-12">
                                <label class="control-label"><i class="glyphicon glyphicon-envelope"></i> E-mail</label>
                                <input type="text" name="EMail" class="form-control" value="" placeholder="E-mail...">
                                <div class="help-block with-errors"></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-12">
                                <label class="control-label"><i class="glyphicon glyphicon-check"></i> Empresa <code>Obrigatório</code></label>
                                <input type="text" name="IDEMPRESA" class="form-control" id="busca-empresaCr" value="" placeholder="Empresa..." required="">
                                <div class="help-block with-errors"></div>
                            </div>
                        </div>
                        
                        <div class="modal-footer">
                            <div class="col-sm-12">
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Fechar</button>
                                <input type="submit" class="btn btn-primary" value="Cadastrar" name="SendPostForm" />
                           </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
    <!--MODAL UPDATE CONTATO-->
    <div class="modal fade" id="updateContato" tabindex="-1" role="dialog" aria-labelledby="formUpdate">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="formUpdate">Editar</h4>
                </div>
                <div class="modal-body">
                    <?php
                        $data = filter_input_array(INPUT_POST, FILTER_DEFAULT);
                        $id   = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
                         if (!empty($data['SendPostFormUp'])):
                            unset($data['SendPostFormUp']);
                            require_once('_models/AdminContatoObras.class.php');
                            $update = new AdminContatoObras;
                            $update->ExeUpdate($id, $data);
                        endif;
                    ?>
                    <form class="updateContato search" name="PostForm" action="" method="post">
                        <input type="hidden" name="IdObra" value="<?= $IdObra;?>" />
                        <input type="hidden" name="id" id="id" value="" />
                        <div class="form-group">
                            <div class="col-sm-12">
                                <label class="control-label"><i class="glyphicon glyphicon-user"></i> Nome</label>
                                <input type="text" name="NomeContato" id="nome" class="form-control" value="" placeholder="Nome..." required>
                                <div class="help-block with-errors"></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-6">
                                <label class="control-label"><i class="glyphicon glyphicon-check"></i> Cargo</label>
                                <select name="IdCargo" id="cargo" class="form-control">
                                    <option value="0">SELECIONE</option>
                                    <?php
                                        $readCa = $read;
                                        $readCa->ExeRead("tb_cargos_car", "ORDER BY DescricaoCargo");
                                        if(!$readCa->getResult()):
                                            echo "<option value='0'>Não encontrado</option>";
                                            else:
                                                foreach($readCa->getResult() as $ca):
                                                    extract($ca);
                                                    echo "<option value='$IdCargo'>$DescricaoCargo</option>";
                                                endforeach;
                                        endif;
                                    ?>
                                </select>
                                <div class="help-block with-errors"></div>
                            </div>
                        </div>
                          <div class="form-group">
                            <div class="col-sm-6">
                                <label class="control-label"><i class="glyphicon glyphicon-phone-alt"></i> Telefone Obra</label>
                                <br>
                                <input type="text" name="DDDFax" autocomplete="off" class="ddd" id="dddfax" value="" maxlength="2">
                                <input type="text" name="Fax" autocomplete="off" class="telefone tel" id="fax" value="" placeholder="Telefone...">
                                <div class="help-block with-errors"></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-6">
                                <label class="control-label"><i class="glyphicon glyphicon-phone-alt"></i> Telefone 1</label>
                                <br>
                                <input type="text" name="DDD" autocomplete="off" class="ddd" id="ddd" value="" maxlength="2">
                                <input type="text" name="Telefone" autocomplete="off" class="tel" id="telefone" value="" placeholder="Telefone...">
                                <div class="help-block with-errors"></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-6">
                                <label class="control-label"><i class="glyphicon glyphicon-phone"></i> Telefone 2 / 0800</label>
                                <br>
                                <input type="text" name="DDD2" autocomplete="off" class="ddd" id="ddd2" value="" maxlength="2">
                                <input type="text" name="TELEFONE2" autocomplete="off" class="tel" id="telefone2" value="" placeholder="Telefone...">
                                <div class="help-block with-errors"></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-6">
                                <label class="control-label"><i class="glyphicon glyphicon-phone"></i> Celular 1</label>
                                <br>
                                <input type="text" name="DDD3" autocomplete="off" class="ddd" id="ddd3" value="" maxlength="2">
                                <input type="text" name="TELEFONE3" autocomplete="off" class="celular tel" id="celular1" value="" placeholder="Celular...">
                                <div class="help-block with-errors"></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-6">
                                <label class="control-label"><i class="glyphicon glyphicon-phone"></i> Celular 2</label>
                                <br>
                                <input type="text" name="DDD4" autocomplete="off" class="ddd" id="ddd4" value="" maxlength="2">
                                <input type="text" name="TELEFONE4" autocomplete="off" class="celular tel" id="celular2" value="" placeholder="Celular...">
                                <div class="help-block with-errors"></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-12">
                                <label class="control-label"><i class="glyphicon glyphicon-envelope"></i> E-mail</label>
                                <input type="text" name="EMail" class="form-control" id="email" value="" placeholder="E-mail...">
                                <div class="help-block with-errors"></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-12">
                                <label class="control-label"><i class="glyphicon glyphicon-check"></i> Empresa <code>Obrigatório</code></label>
                                <input type="text" name="IDEMPRESA" class="form-control" id="busca-empresaUp" value="" placeholder="Empresa..." required>
                                <div class="help-block with-errors"></div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <div class="col-sm-12">
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Fechar</button>
                                <input type="submit" class="btn btn-success submit" value="Atualizar" name="SendPostFormUp" />
                           </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
    <!--MODAL CREATE EMPRESA-->
    <div class="modal modalEmpresa" id="modal-Empresa">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Adicionar Empresa <code>É permitido apenas uma Adição por vez</code></h4>
                </div>
                <div class="modal-body">
                    <?php
                        $data = filter_input_array(INPUT_POST, FILTER_DEFAULT);
                         if (!empty($data['SendPostFormEmpresaAdd'])):
                            unset($data['SendPostFormEmpresaAdd']);
                            require_once('_models/AdminEmpresaObras.class.php');
                            $create = new AdminEmpresaObras;
                            $create->ExeCreate($data);
                        endif;
                    ?>
                    <form action="" class="modalEmpresas empresa" method="post">
                        <input type="hidden" name="IdObra" class="form-control" value="<?= $Codigo;?>"/>
                        <label class="control-label"><i class="glyphicon glyphicon-tasks"></i>  Empresa</label>
                        <input type="text" name="" id="busca-empresa-participante" class="form-control" placeholder="Busca por Empresa..." required/>
                        <table class="table table-bordered table-condensed">
                            <thead>
                                <tr>
                                <th colspan="8" class="text-center"><b>************************ E M P R E S A  ************************</b></th>
                                </tr>
                            </thead>
                            <thead>
                                <tr>
                                    <th>Cód</th>
                                    <th>Empresa</th>
                                    <th>Modalidade</th>
                                    <th>Excluir</th>
                                </tr>
                            </thead>
                            <tbody class="tbody">
                                <tr class="duplicate" style="display:none;">
                                    <td><input type="text" name="IdEmpresa" class="dados Codigo" value="" /></td>
                                    <td><input type="text" name="" class="form-control RazaoSocial" value="" /></td>
                                    <td><select name="IDMODALIDADE" class="form-control modalidade">
                                            <option value="0">SEL...</option>
                                            <?php
                                                $readMo = $read;
                                                $readMo->ExeRead("tb_modalidades_mod", "ORDER BY DescricaoModalidade");
                                                if(!$readMo->getResult()):
                                                    echo "<option>Não encontrado</option>";
                                                    else:
                                                        foreach($readMo->getResult() AS $mo):
                                                            extract($mo);
                                                            echo "<option value='$IdModalidade'>$DescricaoModalidade</option>";
                                                        endforeach;
                                                endif;
                                            ?>
                                        </select>        
                                    </td>
                                    <td><button class="btn btn-danger">X</button></td>
                                </tr>      
                            </tbody>
                        </table>
                        <div class="modal-footer">
                            <div class="col-sm-12">
                                <button type="button" class="btn btn-danger closeModalEmpresa">Fechar</button>
                                <input type="submit" class="btn btn-success" value="Cadastrar" name="SendPostFormEmpresaAdd" />
                            </div>
                        </div>
                    </form>
               </div>
            </div>
        </div>
    </div>
    
    <!--MODAL UPDATE EMPRESA-->
    <div class="modal fade" id="updateEmpresa" tabindex="-1" role="dialog" aria-labelledby="formUpdate">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="formUpdate">Editar</h4>
                </div>
                <div class="modal-body">
                    <?php
                        $data = filter_input_array(INPUT_POST, FILTER_DEFAULT);
                        $id   = filter_input(INPUT_POST, 'IdEmpresa', FILTER_VALIDATE_INT);
                         if (!empty($data['SendPostFormEmpresa'])):
                            unset($data['SendPostFormEmpresa']);
                            require_once('_models/AdminEmpresaObras.class.php');
                            $update = new AdminEmpresaObras;
                            $update->ExeUpdate($id, $data);
                        endif;
                    ?>
                    <form class="updateEmpresa" name="PostForm" action="" method="post">
                        <input type="hidden" name="IdObra" value="<?= $IdObra;?>" />
                        <input type="hidden" name="IdEmpresa" id="id" value="" />
                   
                        <div class="form-group">
                            <div class="col-sm-12">
                                <label class="control-label"><i class="glyphicon glyphicon-check"></i> Modalidade</label>
                                <select name="IDMODALIDADE" class="form-control modalidade" id="modalidade">
                                    <option value="0">SEL...</option>
                                    <?php
                                        $readMo = $read;
                                        $readMo->ExeRead("tb_modalidades_mod", "ORDER BY DescricaoModalidade");
                                        if(!$readMo->getResult()):
                                            echo "<option>Não encontrado</option>";
                                            else:
                                                foreach($readMo->getResult() AS $mo):
                                                    extract($mo);
                                                    echo "<option value='$IdModalidade'>$DescricaoModalidade</option>";
                                                endforeach;
                                        endif;
                                    ?>
                                </select>  
                                <div class="help-block with-errors"></div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <div class="col-sm-12">
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Fechar</button>
                                <input type="submit" class="btn btn-success" value="Atualizar" name="SendPostFormEmpresa" />
                           </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
    <!--MODAL UPDATE FOTO-->
    <div class="modal fade" id="updateFoto" tabindex="-1" role="dialog" aria-labelledby="formUpdate">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="formUpdate">Editar</h4>
                </div>
                <div class="modal-body">
                    <?php
                        $data = filter_input_array(INPUT_POST, FILTER_DEFAULT);
                        $id   = filter_input(INPUT_POST, 'Codigo', FILTER_VALIDATE_INT);
                         if (!empty($data['SendPostFormFoto'])):
                            unset($data['SendPostFormFoto']);
                            //Foto da Obra
                            $data['obr_Foto_chr'] = ( $_FILES['obr_Foto_chr']['tmp_name'] ? $_FILES['obr_Foto_chr'] : null );
                            require_once('_models/AdminFoto.class.php');
                            $update = new AdminFoto;
                            $update->ExeUpdate($id, $data);
                        endif;
                    ?>
                    <form class="search" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="Codigo" id="id" value="" />
                        <div class="form-group">
                            <div class="col-sm-12">
                                <label class="control-label"><i class="glyphicon glyphicon-camera"></i> Foto</label>
                                <input type="file" name="obr_Foto_chr" value="" class="form-control"/>
                                <div class="help-block with-errors"></div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <div class="col-sm-12">
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Fechar</button>
                                <button type="submit" name="SendPostFormFoto" class="btn btn-success submit" value="1">Atualizar</button>
                           </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
      
    <!-- Script para pegar os dados do formulario -->
    <script>
        $('#updateFoto').on('show.bs.modal', function (event) {
          var button   = $(event.relatedTarget) // Button that triggered the modal
          var id       = button.data('id') // Extract info from data-* attribute
         
          var modal = $(this)
          modal.find('.modal-title').text('Editando Foto')
          //modal.find('.modal-body input').val(id)
          modal.find('#id').val(id)
        })
        
        $('#updateContato').on('show.bs.modal', function (event) {
          var button   = $(event.relatedTarget) // Button that triggered the modal
          var id       = button.data('id') // Extract info from data-* attribute
          var nome     = button.data('nome')
          var empresa  = button.data('empresa')
          var cargo    = button.data('cargo')
          var dddfax   = button.data('dddfax')
          var fax      = button.data('fax')
          var ddd      = button.data('ddd')
          var telefone = button.data('telefone')
          var ddd2     = button.data('ddd2')
          var telefone2 = button.data('telefone2')
          var ddd3     = button.data('ddd3')
          var celular1 = button.data('celular1')
          var ddd4     = button.data('ddd4')
          var celular2 = button.data('celular2')
          var email    = button.data('email')
          
          var modal = $(this)
          modal.find('.modal-title').text('Editando Contato - ' + nome)
          //modal.find('.modal-body input').val(id)
          modal.find('#id').val(id)
          modal.find('#nome').val(nome)
          modal.find('#busca-empresaUp').val(empresa)
          modal.find('#cargo').val(cargo)
          modal.find('#dddfax').val(dddfax)
          modal.find('#fax').val(fax)
          modal.find('#ddd').val(ddd)
          modal.find('#telefone').val(telefone)
          modal.find('#ddd2').val(ddd2)
          modal.find('#telefone2').val(telefone2)
          modal.find('#ddd3').val(ddd3)
          modal.find('#celular1').val(celular1)
          modal.find('#ddd4').val(ddd4)
          modal.find('#celular2').val(celular2)
          modal.find('#email').val(email)
        })
        
        $('#updateEmpresa').on('show.bs.modal', function (event) {
          var button     = $(event.relatedTarget) // Button that triggered the modal
          var id         = button.data('id') // Extract info from data-* attribute
          var empresa    = button.data('empresa')
          var modalidade = button.data('modalidade')
          
          var modal = $(this)
          modal.find('.modal-title').text('Editando Empresa - ' + empresa)
          //modal.find('.modal-body input').val(id)
          modal.find('#id').val(id)
          modal.find('#modalidade').val(modalidade)
        })
 
 
        $(function (){      
            //
            $("#panel").hide();
            $("#flip").on("click",function(){
                $("#panel").slideToggle("slow");
            });
            //Populando Tipo de Segmento
            $("select[name='obr_IdSubTipo']").on("change", function(){
                var obr_IdSubTipo = $(this).val();
                $("select[name='IdTipo']").html("");
                //alert(obr_IdSubTipo); 
                $.ajax({
                    url: "json/subtipo.php",
                    type: "POST",
                    data: {obr_IdSubTipo: obr_IdSubTipo},
                    dataType: "JSON",
                    
                    success: function(data){
                       
                        $("select[name='IdTipo']").append("<option value='0'>-- AGORA, SELECIONE O SUBTIPO --</option>");
                        $.each(data.DescricaoTipo,function(i,e){
                            $("select[name='IdTipo']").append("<option value="+ e.IdTipo +">"+ e.DescricaoTipo +"</option>");
                        });
                    },
                    error: function(data){
                        $("select[name='IdTipo']").append('<option value="0">-- Subtipo não encontrado --</option>');
                     }
                }); 
            });
            
            //Populando Fases
            $("select[name='IdFase']").on("change", function(){
                var IdFase = $(this).val();
                $("select[name='IdEstagio']").html("");
                //alert(id_fase); 
                $.ajax({
                    url: "json/estagio.php",
                    type: "POST",
                    data: {IdFase: IdFase},
                    dataType: "JSON",
        
                    success: function(data){
                       
                        $("select[name='IdEstagio']").append("<option value='0'>-- AGORA, SELECIONE O ESTAGIO --</option>");
                        $.each(data.DescricaoEstagio,function(i,e){
                            $("select[name='IdEstagio']").append("<option value="+ e.IdEstagio +">"+ e.DescricaoEstagio +"</option>");
                        });
                    },
                    error: function(data){
                        $("select[name='IdEstagio']").append('<option value="0">-- Estagio não encontrado --</option>');
                     }
                }); 
            });
            
            //MODAL ADD EMPRESA
            var $create       = $(".update"),//form Principal
                $mEmpresas    = $(".modalEmpresas"),//form Modal
                $empresasAdd  = $(".empresaAdd"),//class onde lista AS EMPRESAS
                $modalEmpresa = $(".modalEmpresa");//class Modal
            
            //Config para o modal
            var $container = $(".content"),//Aqui  a busca do produto
                $empresa   = $container.find(".empresa"),//Aqui a tabela onde ficara as empresas
                $tbody     = $empresa.find(".tbody"),//Aqui onde mostrar as empresas selecionado na busca
                $add       = [];
            
            //Abre modal
            $create.on("click", ".btnAddEmp", function() {
                $modalEmpresa.fadeIn(250);
            });
    
            //Fecha modal usei closeModal pois ja existe uma classe modal no bootstrap
            $mEmpresas.on("click", ".closeModalEmpresa", function() {
                $modalEmpresa.fadeOut(250);
            });
    
            //Remove
            $create.on("click", ".btnRemove", function() {
                $(this).parents(".addEmpresa").remove();
            });
    
            //Busca Empresa Participante
            $("#busca-empresa-participante").autocomplete({
                    minLength: 1,
                    source: "json/empresa-fantasia.php",
                    appendTo: "#modal-Empresa",
                    select: function(i, e){
                    //if($add.indexOf(e.item.Codigo)!= -1){
                        //alert("Esta Empresa ja foi adicionada");
                    //}else{
                        $tbody.find(".duplicate").clone().each(function(){
                            $(this).find(".Codigo").val(e.item.Codigo);
                            $(this).find(".RazaoSocial").val(e.item.Fantasia);
                        }).removeClass("duplicate").show().appendTo(".tbody");
                        $add.push(e.item.Codigo);
                   // }
                }
            });
            
            //Remover a empresa da lista atraves do parents
            $empresa.on("click", ".btn-danger", function(){
                 $(this).parents("tr").remove();
    
                 //Reseta todos os ids adicionados
                $empresa = [];
                $tbody.find(".tbody").each(function() {
                    $empresa.push(parseInt(this.value));
                });
            });
            
            $("#empresa").on("click", function(){
                $(this).val("");    
            });
            
            //Validação Formulario Geral
            $(".update").on("submit", function(){
                if($("select[name='Pesquisador']").val()== 0) {
                    alert("Selecione o Pesquisador");
                    return false;
                }if($("select[name='IdEstado']").val()== 0) {
                    alert("Selecione o Estado");
                    return false;
                }if($("select[name='OBR_REGIAO_IND']").val()== 0) {
                    alert("Selecione a Região");
                    return false;
                }if($("select[name='IdTipo']").val()== 0) {
                    alert("Selecione o Tipo de Segmento");
                    return false; 
                }if($("select[name='IdFase']").val()== 0) {
                    alert("Selecione a Fase");
                    return false;
                }if($("select[name='INDSTATUS']").val()== 0) {
                    alert("Selecione o Status");
                    return false;
                }       
            });
            
             //Validando Revisão
            $(".error").hide();
            $("input[name='Atualizacao']").on("blur", function(){
                //var atualizacaoAtual = $(this).val();
                //$(".atualizacaoAtual").val(atualizacaoAtual);
                //$revisao = $("input[name='NrDaRevisao']").val();
                $revisao = $("input[name='NrDaRevisao']").data('num-revisao');
                //if($(".atualizacao']").val() != $(".atualizacaoAtual").val()){
                    $total = parseFloat($revisao) + 1;
                    $("input[name='NrDaRevisao']").val($total); 
                    $(".error").html("Nº da Revisão atualizado").show();
                //}  
            });
            
            //Altera o valor da div error
            $("input[name='NrDaRevisao']").on('keyup', function() {
                var value = $(this).val();
                $(".error").text('Inserido Revisão - ' +value).css("background", "#0080FF");
            });
            
            //Validando Inicio e Termino da Obra
//            $("input[name='Termino']").on("change", function(){
//                if($(this).val() <= $("input[name='Inicio']").val()){
//                   alert("A Data de Término não pode ser menor ou igual que a data de Início, por favor corrija");
//                   $(this).val(''); 
//                }   
//            });  
            
            //VALIDANDO ATUALIZAÇÃO
//            $("input[name='Atualizacao']").on("change", function(){
//                if($(this).val() <= $("input[name='Publicacao']").val()){
//                   alert("A Data de Atualizacao não pode ser menor ou igual que a data de Publicacao, por favor corrija");
//                   $(this).val(''); 
//                }   
//            });
        });
        
        //Função Checkbox Area de lazer
        function somar(){
            var result = $("input:checked");
            var total  = 0;
            for(var i=0; i<result.length; i++){
                total = total + parseFloat(result[i].value);
            }
            $("input[name='obr_AreaLazer_int']").val(total);
        }
        somar();
        $(":checkbox").click(somar);
    </script>
</div>
<?php
    }else{
        WSErro("Desculpa, mas você não tem acesso a essa Área, procure o Administrador", WS_INFOR);
    }
?>  