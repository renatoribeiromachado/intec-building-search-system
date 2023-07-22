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
    
    $readC = $read;  
    $readC->FullRead("SELECT id,Codigo FROM tb_obras_obr", "ORDER BY Codigo DESC LIMIT 1");
    if($readC->getResult()):
        foreach($readC->getResult() AS $obr):
            extract($obr);
            $Codigo = $Codigo + $userlogin['usu_Usuario_int_PK'];
        endforeach;
    endif; 
?>
<div class="bg-info content">
    <div class="col-md-12 bottom20 bg_red">
        <p class="text-center"><i class="glyphicon glyphicon-check"></i> CADASTRO DE OBRAS</p>
    </div>
    
      <!--Formulário Geral-->
    <form class="create search" autocomplete="off" name="PostForm" action="" method="post" enctype="multipart/form-data">
        <?php
            //CADASTRO
            $data = filter_input_array(INPUT_POST, FILTER_DEFAULT);
            if ($data):
                
                $data['Inicio']  = ($data['Inicio'] ? Check::Data($data['Inicio']) : null);
                $data['Termino'] = ($data['Termino'] ? Check::Data($data['Termino']) : null);
                
                //Foto da Obra
                $data['obr_Foto_chr'] = ( $_FILES['obr_Foto_chr']['tmp_name'] ? $_FILES['obr_Foto_chr'] : 'null' );
                
                //VALOR
                $data['Valor'] = str_replace('.', '', $data['Valor']);
                $data['Valor'] = str_replace(',', '.', $data['Valor']);
               
                require('_models/AdminObras.class.php');
                $create = new AdminObras;
                $create->ExeCreate($data);
              
                WSErro($create->getError()[0], $create->getError()[1]);

            endif;
        ?>
        <input type="hidden" name="usuario" value="<?= $userlogin['usu_Usuario_chr']; ?>" />
        <div class="col-sm-3">
            <label class="control-label"><i class="glyphicon glyphicon-check"></i> Código</label>
            <input type="text" name="Codigo" class="form-control" value="<?= $Codigo;?>" readonly=""/>
            <div class="help-block with-errors"></div>
        </div>
        <div class="col-sm-3">
            <label class="control-label"><i class="glyphicon glyphicon-check"></i> Data de Cadastro</label>
            <input type="text" name="DataCadastro" class="form-control datepicker" value="<?= date("d/m/Y"); ?>" required/>
            <div class="help-block with-errors"></div>
        </div>
        <div class="col-sm-3">
            <label class="control-label"><i class="glyphicon glyphicon-check"></i> Código INTECNet</label>
            <input type="text" name="CodigoAntigo" class="form-control text-uppercase" id="codigo" value="<?php if(isset($data['CodigoAntigo'])) echo $data['CodigoAntigo']; ?>" required/>
            <div class="text-danger" id="resposta"></div>
        </div>
        <div class="col-sm-3">
            <label class="control-label"><i class="glyphicon glyphicon-check"></i> Data Publicação</label>
            <input type="text" name="Publicacao" class="form-control" value="<?= date("d/m/Y"); ?>" readonly=""/>
            <div class="help-block with-errors"></div>
        </div>
        <div class="col-sm-10">
            <label class="control-label"><i class="glyphicon glyphicon-check"></i> Pesquisador</label>
            <select name="Pesquisador" class="form-control form-group">
                    <option value="0">SELECIONE</option>
                    <?php
                        $readPes = $read;
                        $readPes->ExeRead("tb_pesquisadores_pes", "ORDER BY SiglaPesquisador");
                        if(!$readPes->getResult()):
                            echo "<option value='0'>Não encontrado</option>";
                            else:
                                foreach($readPes->getResult() as $pe):
                                    extract($pe);
                                    echo "<option ";
                                        if($IdPesquisador == $data['Pesquisador']){
                                            echo "selected='selected'"; 
                                        }
                                    echo "value='$IdPesquisador'>$SiglaPesquisador</option>";
                                endforeach;
                        endif;
                    ?>
                </select>
            <div class="help-block with-errors"></div>
        </div>
        <div class="col-sm-2">
            <label class="control-label"><i class="glyphicon glyphicon-check"></i> Revisão</label>
            <input type="text" name="NrDaRevisao" class="form-control" value="1" required/>
            <div class="help-block with-errors"></div>
        </div>
        <div class="col-sm-8">
            <label class="control-label"><i class="glyphicon glyphicon-check"></i> Obra</label>
            <input type="text" name="Projeto" class="form-control text-uppercase" value="<?php if(isset($data['Projeto'])) echo $data['Projeto']; ?>" required/>
            <div class="help-block with-errors"></div>
        </div>
        <!--FOTOS-->
        <div class="form-group">
            <div class="col-sm-4">
                <label class="control-label"><i class="glyphicon glyphicon-camera"></i> Foto</label>
                <input type="file" name="obr_Foto_chr" value="" class="form-control"/>
                <div class="help-block with-errors"></div>
            </div>
        </div>
        
        <div class="col-sm-2">
            <label class="control-label"><i class="glyphicon glyphicon-check"></i> CEP</label>
            <input type="text" name="CEP" class="form-control cep" id="cep" value="<?php if(isset($data['CEP'])) echo $data['CEP']; ?>" required/>
            <div class="help-block with-errors"></div>
        </div>
        <div class="col-sm-8">
            <label class="control-label"><i class="glyphicon glyphicon-check"></i> Endereço</label>
            <input type="text" name="Endereco" class="form-control" id="rua" value="<?php if(isset($data['Endereco'])) echo $data['Endereco']; ?>"/>
            <div class="help-block with-errors"></div>
        </div>
        <div class="form-group">
            <div class="col-sm-2">
                <label class="control-label"><i class="glyphicon glyphicon-check"></i> Nº</label>
                <input type="text" name="numero" id="numero" class="form-control" value="<?php if(isset($data['numero'])) echo $data['numero']; ?>" placeholder="Nº...">
                <div class="help-block with-errors"></div>
            </div>
        </div>
        <div class="col-sm-5">
            <label class="control-label"><i class="glyphicon glyphicon-check"></i> Bairro</label>
            <input type="text" name="Complemento" class="form-control" id="bairro" value="<?php if(isset($data['Complemento'])) echo $data['Complemento']; ?>"/>
            <div class="help-block with-errors"></div>
        </div>
        <div class="col-sm-2">
            <label class="control-label"><i class="glyphicon glyphicon-check"></i> UF</label>
            <select name="IdEstado" class="form-control" id="uf">
                <option value="0">SELECIONE</option>
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
                <option value="0"> </option>
                <?php
                    $readC = $read;
                    $readC->FullRead("SELECT cidade FROM tb_cidades_cid", "ORDER BY cidade");
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
       
        <!--SEGMENTO-->
        <div class="col-sm-6">
            <label class="control-label"><i class="glyphicon glyphicon-check"></i> Segmento de Atuação</label>
            <select name="obr_IdSubTipo" class="form-control form-group">
                <option value="0">SELECIONE</option>
                <?php
                    $readSeg = $read;
                    $readSeg->ExeRead("tb_segmento_seg","ORDER BY seg_Segmento_chr");
                    if(!$readSeg->getResult()):
                        echo "<option value='0'>Não encontrado</option>";
                        else:
                            foreach($readSeg->getResult() as $seg):
                                extract($seg);
                                echo "<option ";
                                if($seg_Segmento_int_PK == $data['obr_IdSubTipo']){
                                    echo "selected='selected'";
                                }
                                echo "value='$seg_Segmento_int_PK'>$seg_Segmento_chr</option>";
                            endforeach;
                    endif;
                ?>
            </select>
            <div class="help-block with-errors"></div>
        </div>
        <!--SELEÇÃO DE SUBTIPOS-->
        <div class="form-group">  
            <div class="col-sm-6">
                <label class="control-label"><i class="glyphicon glyphicon-check"></i> Subtipo</label>
                    <select name="IdTipo" class="form-group form-control">
                        <option value="0"> - SELECIONE PRIMEIRO O SEGMENTO</option>
                    </select>
                <div class="help-block with-errors"></div>
            </div>
        </div>
        <div class="col-sm-6">
            <label class="control-label"><i class="glyphicon glyphicon-check"></i> Fase</label>
            <select name="IdFase" class="form-control form-group">
                <option value="0">SELECIONE</option>
                <?php
                    $readFA = $read;
                    $readFA->ExeRead("tb_fases_fas","ORDER BY DescricaoFase");
                    if(!$readFA->getResult()):
                        echo "<option value='0'>Não encontrado</option>";
                        else:
                            foreach($readFA->getResult() as $fas):
                                extract($fas);
                                echo "<option ";
                                    if($IdFase == $data['IdFase']){
                                        echo "selected='selected'";
                                    }
                                echo "value='$IdFase'>$DescricaoFase</option>";
                            endforeach;
                    endif;
                ?>
            </select>
            <div class="help-block with-errors"></div>
        </div>
        <!--SELEÇÃO DE ESTÁGIO-->
        <div class="form-group">  
            <div class="col-sm-6">
                <label class="control-label"><i class="glyphicon glyphicon-check"></i> Estágio</label>
                    <select name="IdEstagio" class="form-group form-control">
                        <option value="0"> - SELECIONE PRIMEIRO A FASE</option>
                    </select>
                <div class="help-block with-errors"></div>
            </div>
        </div>
        <div class="col-sm-4">
            <label class="control-label"><i class="glyphicon glyphicon-check"></i> Início da Obra</label>
            <input type="text" name="Inicio" class="form-control datepicker" value="<?php if(isset($data['Inicio'])) echo $data['Inicio']; ?>"/>
            <div class="help-block with-errors"></div>
        </div>
        <div class="col-sm-4">
            <label class="control-label"><i class="glyphicon glyphicon-check"></i> Término da Obra</label>
            <input type="text" name="Termino" class="form-control datepicker" value="<?php if(isset($data['Termino'])) echo $data['Termino']; ?>"/>
            <div class="help-block with-errors"></div>
        </div>
        <div class="col-sm-4">
            <label class="control-label"><i class="glyphicon glyphicon-check"></i> Início / Término</label>
            <input type="text" name="InicioTermino" class="form-control" value="<?php if(isset($data['InicioTermino'])) echo $data['InicioTermino']; ?>"/>
            <div class="help-block with-errors"></div>  
        </div>
        <div class="col-sm-2">
            <label class="control-label"><i class="glyphicon glyphicon-check"></i> INVESTIMENTO</label>
            <input type="text" name="Valor" class="form-control dinheiro" value="0,00"/> 
            <div class="help-block with-errors"></div>
        </div>
        <div class="col-sm-2">
            <label class="control-label"><i class="glyphicon glyphicon-check"></i> PADRÃO <code>investimento</code></label>
            <select name="Padrao" class="form-control">
                <option value="0">SELECIONE</option>
                <option value="Alto">Alto</option>
                <option value="Baixo">Baixo</option>
                <option value="Medio">Médio</option>  
            </select>
            <div class="help-block with-errors"></div>
        </div>
      
        <div class="col-sm-2">
            <label class="control-label"><i class="glyphicon glyphicon-check"></i> Área total do Projeto</label>
            <input type="text" name="AreaConstruida" class="form-control" value="<?php if(isset($data['AreaConstruida'])) echo $data['AreaConstruida']; ?>"/>
            <div class="help-block with-errors"></div>
        </div>
        <div class="col-sm-2">
            <label class="control-label"><i class="glyphicon glyphicon-check"></i> Cub</label>
            <input type="text" name="Cub" class="form-control" value="<?php if(isset($data['Cub'])) echo $data['Cub']; ?>"/>
            <div class="help-block with-errors"></div>
        </div>
     
        <div class="col-sm-3">
            <label class="control-label"><i class="glyphicon glyphicon-check"></i> Tipo de Cotação</label>
            <select name="obr_IdTipoCotacao_int" class="form-control">
                <?php
                    $readCot = $read;
                    $readCot->ExeRead("tb_cotacao_cto", "ORDER BY nome");
                    foreach($readCot->getResult() AS $cot):
                        extract($cot);
                        echo "<option value='$id'>$nome</option>";
                    endforeach;
                ?>
            </select>
            <div class="help-block with-errors"></div>
        </div>
        <div class="form-group">
            <div class="col-sm-1">
                <label class="control-label"><i class="glyphicon glyphicon-check"></i> R$</label>
                <input type="text" name="obr_ValorDolar_chr" class="form-control" value="" placeholder="R$...">
                <div class="help-block with-errors"></div>
            </div>
        </div> 

        <!--DESCRIÇÃO-->
        <div class="col-md-12 top20 bottom20">
            <p><i class="glyphicon glyphicon-ok"></i> <b>DESCRIÇÃO</b></p>
       
            <table class="table table-bordered table-condensed">
                <tr>
                    <th>Edifício(s) residencial(s)</th>
                    <th>Casa(s)</th>
                    <th>Condomínio</th>
                    <th>Pavimento(s)</th>
                    <th>Apartamento(s) por Andar</th>
                </tr>
                <tr>
                    <td><input type="text" name="obr_DescResidEdificio_chr" class="dados" value="<?php if($data['obr_DescResidEdificio_chr'] == $data['obr_DescResidEdificio_chr']) echo $data['obr_DescResidEdificio_chr'];?>"/></td>
                    <td><input type="text" name="obr_DescResidResidenciais_chr" class="dados" value="<?php if($data['obr_DescResidResidenciais_chr'] == $data['obr_DescResidResidenciais_chr']) echo $data['obr_DescResidResidenciais_chr'] ;?>"/></td>
                    <td><input type="text" name="obr_DescResidCondominios_chr" class="dados" value="<?php if($data['obr_DescResidCondominios_chr'] == $data['obr_DescResidCondominios_chr']) echo $data['obr_DescResidCondominios_chr'] ;?>"/></td>
                    <td><input type="text" name="obr_DescResidPavimentos_chr" class="dados" value="<?php if($data['obr_DescResidPavimentos_chr'] == $data['obr_DescResidPavimentos_chr']) echo $data['obr_DescResidPavimentos_chr'] ;?>"/></td> 
                    <td><input type="text" name="obr_DescResidApartamentos_chr" class="dados" value="<?php if($data['obr_DescResidApartamentos_chr'] == $data['obr_DescResidApartamentos_chr']) echo $data['obr_DescResidApartamentos_chr'] ;?>"/></td>
                </tr>
                <tr>
                    <th>Dormitório(s)</th>
                    <th>Suítes(s)</th>
                    <th>Banheiro(s)</th>
                    <th colspan="2">Lavabo(s)</th>
                </tr>
                <tr>
                    <td><input type="text" name="obr_DescResidDormitorios_chr" class="dados" value="<?php if($data['obr_DescResidDormitorios_chr'] == $data['obr_DescResidDormitorios_chr']) echo $data['obr_DescResidDormitorios_chr'] ;?>"/></td>
                    <td><input type="text" name="obr_DescResidSuite_chr" class="dados" value="<?php if($data['obr_DescResidSuite_chr'] == $data['obr_DescResidSuite_chr']) echo $data['obr_DescResidSuite_chr'] ;?>"/></td>
                    <td><input type="text" name="obr_DescResidBanheiro_chr" class="dados" value="<?php if($data['obr_DescResidBanheiro_chr'] == $data['obr_DescResidBanheiro_chr']) echo $data['obr_DescResidBanheiro_chr'] ;?>"/></td>
                    <td colspan="2"><input type="text" name="obr_DescResidLavabo_chr" class="dados" value="<?php if($data['obr_DescResidLavabo_chr'] == $data['obr_DescResidLavabo_chr']) echo $data['obr_DescResidLavabo_chr'] ;?>"/></td>
                </tr>
                <tr>
                    <th>Sala(s) de estar / jantar</th>
                    <th>Copa(s) / Cozinha(s)</th>
                    <th>Área(s) de serviço / Terraço(s) / Varanda(s)</th>
                    <th colspan="2">Dependência de empregada</th>
                </tr>
                <tr>
                    <td><select name="obr_DescResidSala_chr" class="form-control">
                            <option value="0">Selecione</option>
                            <?php
                                echo "<option ";
                                if($data['obr_DescResidSala_chr'] == $data['obr_DescResidSala_chr']){
                                    echo "selected='selected'";
                                }
                                echo "value='".$data['obr_DescResidSala_chr']."'>".$data['obr_DescResidSala_chr']."</option>";
                            ?>
                            <option value="0/0">0/0</option>
                            <option value="0/1">0/1</option>
                            <option value="1/0">1/0</option>
                            <option value="1/1">1/1</option>
                        </select>
                    </td>
                    <td><select name="obr_DescResidCopa_chr" class="form-control">
                            <option value="0">Selecione</option>
                            <?php
                                echo "<option ";
                                if($data['obr_DescResidCopa_chr'] == $data['obr_DescResidCopa_chr']){
                                    echo "selected='selected'";
                                }
                                echo "value='".$data['obr_DescResidCopa_chr']."'>".$data['obr_DescResidCopa_chr']."</option>";
                            ?>
                            <option value="0/0">0/0</option>
                            <option value="0/1">0/1</option>
                            <option value="1/0">1/0</option>
                            <option value="1/1">1/1</option>
                        </select>
                    </td>
                    <td><select name="obr_DescResidATV_chr" class="form-control">
                            <option value="0">Selecione</option>
                            <?php
                                echo "<option ";
                                if($data['obr_DescResidATV_chr'] == $data['obr_DescResidATV_chr']){
                                    echo "selected='selected'";
                                }
                                echo "value='".$data['obr_DescResidATV_chr']."'>".$data['obr_DescResidATV_chr']."</option>";
                            ?>
                            <option value="0/0/0">0/0/0</option>
                            <option value="1/0/1">1/0/1</option>
                            <option value="1/1/1">1/1/1</option>
                            <option value="1/1/0">1/1/0</option>
                            <option value="1/0/0">1/0/0</option>
                        </select>
                    </td>
                    <td colspan="2"><input type="text" name="obr_DescResidDepEmpreg_chr" class="dados" value="<?php if($data['obr_DescResidDepEmpreg_chr'] == $data['obr_DescResidDepEmpreg_chr']) echo $data['obr_DescResidDepEmpreg_chr'];?>"/></td>
                </tr>
            </table>
        </div>
        
        <!--AREA DE LAZER-->
        <div class="col-md-12 top20 bottom20">
            <p><i class="glyphicon glyphicon-ok"></i> <b>ÁREA DE LAZER</b></p>
        </div>
        <div class="col-md-3">
            <input type="checkbox" name="" value="1" /> Salão de festas
        </div>
        <div class="col-md-3">
            <input type="checkbox" name="" value="2" /> Salão de jogos
        </div>
        <div class="col-md-3">
            <input type="checkbox" name="" value="4" /> Piscina
        </div>
        <div class="col-md-3">
            <input type="checkbox" name="" value="8" /> Sauna
        </div>
        <div class="col-md-3">
            <input type="checkbox" name="" value="16" /> Churrasqueira
        </div>
        <div class="col-md-3">
            <input type="checkbox" name="" value="32" /> Quadra
        </div>
        <div class="col-md-3">
            <input type="checkbox" name="" value="64" /> Fitness
        </div>
        <div class="col-md-3">
            <input type="checkbox" name="" value="128" /> Gourmet
        </div>
        <div class="col-md-3">
            <input type="checkbox" name="" value="256" /> Playground
        </div>
        <div class="col-md-3">
            <input type="checkbox" name="" value="512" /> Spa
        </div>
        <div class="col-md-3">
            <input type="checkbox" name="" value="1024" /> Brinquedoteca
        </div>
        
        <!--Soma dos checkbox-->
        <div class="col-md-3">
            <input type="hidden" name="obr_AreaLazer_int" class="form-control" value="0" />
        </div>
           
        <div class="col-md-12 top20">
            <label class="control-label"><i class="glyphicon glyphicon-check"></i> Outros</label>
            <input type="text" name="obr_OutrosAreaLazer_chr" class="form-control" value="<?php if(isset($data['obr_OutrosAreaLazer_chr'])) echo $data['obr_OutrosAreaLazer_chr']; ?>" />
            <div class="help-block with-errors"></div>
        </div>
        
        <!--INFORMAÇÕES ADICIONAIS-->
        <div class="col-md-12 top20 bottom20">
            <p><i class="glyphicon glyphicon-ok"></i> <b>Informações Adicionais</b></p>
        
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
                    <td><input type="text" name="obr_DescInfoAdicTotalUnicades_chr" class="dados" value="<?php if(isset($data['obr_DescInfoAdicTotalUnicades_chr'])) echo $data['obr_DescInfoAdicTotalUnicades_chr']; ?>"/></td>
                    <td><input type="text" name="obr_DescInfoAdicAreaUtil_chr" class="dados" value="<?php if(isset($data['obr_DescInfoAdicAreaUtil_chr'])) echo $data['obr_DescInfoAdicAreaUtil_chr']; ?>"/></td>
                    <td><input type="text" name="obr_DescInfoAdicAreaTerreno_chr" class="dados" value="<?php if(isset($data['obr_DescInfoAdicAreaTerreno_chr'])) echo $data['obr_DescInfoAdicAreaTerreno_chr']; ?>"/></td>
                    <td><input type="text" name="obr_DescInfoAdicElevador_chr" class="dados" value="<?php if(isset($data['obr_DescInfoAdicElevador_chr'])) echo $data['obr_DescInfoAdicElevador_chr']; ?>"/></td>
                    <td><input type="text" name="obr_DescInfoAdicVagas_chr" class="dados" value="<?php if(isset($data['obr_DescInfoAdicVagas_chr'])) echo $data['obr_DescInfoAdicVagas_chr']; ?>"/></td>
                    <td><input type="text" name="obr_DescInfoAdicCobert_chr" class="dados" value="<?php if(isset($data['obr_DescInfoAdicCobert_chr'])) echo $data['obr_DescInfoAdicCobert_chr']; ?>"/></td>
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
                    <td><input type="text" name="obr_DescInfoAdicArCondic_chr" class="dados" value="<?php if(isset($data['obr_DescInfoAdicArCondic_chr'])) echo $data['obr_DescInfoAdicArCondic_chr']; ?>"/></td>
                    <td><input type="text" name="obr_DescInfoAdicAquecimento_chr" class="dados" value="<?php if(isset($data['obr_DescInfoAdicAquecimento_chr'])) echo $data['obr_DescInfoAdicAquecimento_chr']; ?>"/></td>
                    <td><select name="obr_DescInfoAdicFundacoes_chr" class="dados">
                            <option value="">Selecione</option>
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
                            <option value="">Selecione</option>
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
                    <td><input type="text" name="obr_DescInfoAdicAcabamento_chr" class="dados" value="<?php if(isset($data['obr_DescInfoAdicAcabamento_chr'])) echo $data['obr_DescInfoAdicAcabamento_chr']; ?>"/></td>
                    <td><input type="text" name="obr_DescInfoAdicFachada_chr" class="dados" value="<?php if(isset($data['obr_DescInfoAdicFachada_chr'])) echo $data['obr_DescInfoAdicFachada_chr']; ?>"/></td>
                </tr>
            </table>
        </div>
        <div class="col-sm-12">
            <label class="control-label"><i class="glyphicon glyphicon-check"></i> Descrições Complementares</label>
            <textarea name="DescProj1" class="form-control" rows="5"><?php if(isset($data['DescProj1'])) echo $data['DescProj1']; ?></textarea>
            <div class="help-block with-errors"></div>
        </div>
        <div class="col-sm-3">
            <label class="control-label"><i class="glyphicon glyphicon-check"></i> Status</label>
            <select name="INDSTATUS" class="form-control">
                    <option value="0">SELECIONE</option>
                    <?php
                        $readSt = $read;
                        $readSt->ExeRead("tb_status_emp", "ORDER BY DescricaoStatus");
                        if(!$readSt->getResult()):
                            echo "<option value='0'>Não encontrado</option>";
                            else:
                                foreach($readSt->getResult() as $st):
                                    extract($st);
                                    echo "<option ";
                                        if($IdStatus == $data['INDSTATUS']){
                                            echo "selected = 'selected'";   
                                        }
                                    echo "value='$IdStatus'>$DescricaoStatus</option>";
                                endforeach;
                        endif;
                    ?>
                </select>
            <div class="help-block with-errors"></div>
        </div>
                     
        <!--Botão-->
        <div class="modal-footer">
            <div class="col-sm-12">
                <a href="painel.php?exe=obras/index" class="btn btn-primary back" title="Voltar"> <i class="glyphicon glyphicon-chevron-left"></i> Voltar</a>
                <button type="submit" class="btn btn-success submit" title="Gravar Dados"><i class="glyphicon glyphicon-record"></i> Gravar e ADD Contato(s) e Empresa(s) Participante(s)</button>
            </div>
        </div>
    </form> 
     
    <script>
        $(function (){
                //Validando Codigo da Obra
                $("#resposta").hide();
                var codigo = $("#codigo"); 
                codigo.blur(function() { 
                    $.ajax({ 
                        url: 'json/verificaCodigo.php', 
                        type: 'POST', 
                        data:{"codigo" : codigo.val()}, 
                        success: function(data) { 
                        console.log(data); 
                        data = $.parseJSON(data); 
                        $("#resposta").text(data.codigo).show();
                    } 
                }); 
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
            
            //Populando Modalidade
            $("select[name='IDMODALIDADE[]']").on("change", function(){
                var IDMODALIDADE = $(this).val();
                $("input[name='IDMODALIDADEDesc']").html("");
                $.ajax({
                    url: "json/modalidade.php",
                    type: "POST",
                    data: {IDMODALIDADE: IDMODALIDADE},
                    dataType: "JSON",
                    success: function(data){
                        $.each(data.DescricaoModalidade,function(i,e){
                            $("input[name='IDMODALIDADEDesc']").val(e.DescricaoModalidade);
                        });
                    },
                    error: function(data){
                        $("input[name='IDMODALIDADEDesc']").val('Não encontrado');
                     }
                }); 
            });
            
            //MODAL CONTATO
            var $create       = $(".create"),//form Principal
                $mContatos    = $(".modalContatos"),//form Modal
                $contatos     = $(".contatoAdd"),//class onde lista os contatos
                $modalContato = $(".modalContato"),//class Modal
                $mEmpresas    = $(".modalEmpresas"),//form Modal
                $empresasAdd  = $(".empresaAdd"),//class onde lista AS EMPRESAS
                $modalEmpresa = $(".modalEmpresa");//class Modal   
            
            //Abre modal
            $create.on("click", ".btnAddCont", function() {
            	$modalContato.fadeIn(250);
            });
            
            //Fecha modal usei closeModal pois já existe uma classe modal no bootstrap
            $mContatos.on("click", ".closeModalContato", function() {
            	$modalContato.fadeOut(250);
            });
            $create.on("click", ".btnRemove", function() {
            	$(this).parents(".addContato").remove();
            });
            
            $mContatos.on("submit", function() {
            	var contato     = $mContatos.find("input[name='NomeContato']").val(),
                    IdCargo     = $mContatos.find("select[name='IdCargo']").val(),
                    IDEMPRESA   = $mContatos.find("input[name='IDEMPRESA']").val(),
                    IdCargoDesc = $mContatos.find("input[name='IdCargoDesc']").val(),
                    DDDFax      = $mContatos.find("input[name='DDDFax']").val(),
                    Fax         = $mContatos.find("input[name='Fax']").val(),
                    
                    DDD         = $mContatos.find("input[name='DDD']").val(),
                    telefone    = $mContatos.find("input[name='Telefone']").val(),
   
                    DDD2        = $mContatos.find("input[name='DDD2']").val(),
                    TELEFONE2   = $mContatos.find("input[name='TELEFONE2']").val(),
                    DDD3        = $mContatos.find("input[name='DDD3']").val(),
                    TELEFONE3   = $mContatos.find("input[name='TELEFONE3']").val(),
                    
                    DDD4        = $mContatos.find("input[name='DDD4']").val(),
                    TELEFONE4   = $mContatos.find("input[name='TELEFONE4']").val(),
                    email       = $mContatos.find("input[name='EMail']").val();
                
                    //$contatos.append("<tr class='item'><td><i class='glyphicon glyphicon-ok'></i> " + NomeContato + "</td><td>" + IdCargo + " </td><td>" + Telefone + "</td><td>" + celular + "</td><td>" + EMail + "</td><td><a class='glyphicon glyphicon-remove danger del'></a></td></tr>");
                    $contatos.append("<tr class='addContato'><td><input type='hidden' name='NomeContato[]' class='form-control contato' value='" + contato + "' />"+ contato +"</td><td><input type='hidden' name='IdCargo[]' class='form-control contato' value='" + IdCargo + "' />" + IdCargoDesc + "</td><td><input type='hidden' name='IDEMPRESA[]' class='form-control contato' value='" + IDEMPRESA + "' />" + IDEMPRESA + "</td><td><input type='hidden' name='DDDFax[]' class='form-control contato' value='" + DDDFax + "' />(" + DDDFax + ")</td><td><input type='hidden' name='Fax[]' class='form-control contato num maskPhone' value='" + Fax + "' />" + Fax + "</td><td><input type='hidden' name='DDD[]' class='form-control contato' value='" + DDD + "' />(" + DDD + ")</td><td><input type='hidden' name='Telefone[]' class='form-control contato' value='" + telefone + "' />" + telefone + "</td><td><input type='hidden' name='DDD2[]' class='form-control contato' value='" + DDD2 + "' />(" + DDD2 + ")</td><td><input type='hidden' name='TELEFONE2[]' class='form-control contato' value='" + TELEFONE2 + "' />" + TELEFONE2 + "</td><td><input type='hidden' name='DDD3[]' class='form-control contato' value='" + DDD3 + "' />(" + DDD3 + ")</td><td><input type='hidden' name='TELEFONE3[]' class='form-control contato' value='" + TELEFONE3 + "' />" + TELEFONE3 + "</td><td><input type='hidden' name='DDD4[]' class='form-control contato' value='" + DDD4 + "' />(" + DDD4 + ")</td><td><input type='hidden' name='TELEFONE4[]' class='form-control contato' value='" + TELEFONE4 + "' />" + TELEFONE4 + "</td><td><input type='hidden' name='EMail[]' class='form-control contato' value='" + email + "' />" + email + "</td><td><a class='btn btn-danger btnRemove' title='Remover Contato'><i class='glyphicon glyphicon-remove'></i></a></td></tr>");
                    $modalContato.fadeOut(250);
                	$(this).trigger("reset");
                	return false;
            });

            
            //Config para o modal EMPRESA PARTICIPANTE
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
    
             //Adiciona as empresas paricipantes selecionadas
            $mEmpresas.on("submit", function() {
                $tbody.find("tr").not(".duplicate").each(function() {
                    var Codigo        = $(this).find("input[name='IdEmpresa[]']").val(),
                        Empresa       = $(this).find("input[name='Empresa[]']").val(),
                        IDMODALIDADE  = $(this).find("select[name='IDMODALIDADE[]']").val();
                    let txtModalidade = $(this).find('select#selectAddEmpresa option:selected').text();
    
                    $empresasAdd.append( 
                        "<tr class='addEmpresa'>" +
                            "<td><input type='hidden' name='IdEmpresa[]' class='form-control' value='" + Codigo + "' />" + Codigo + "</td>" + 
                            "<td><input type='hidden' name='Empresa[]' class='form-control' value='" + Empresa + "' />"+ Empresa +"</td>" + 
                            "<td><input type='hidden' name='IDMODALIDADE[]' class='form-control' value='" + IDMODALIDADE + "' /><span>"+txtModalidade+"</span></td>" +
                            "<td><a class='btn btn-danger btnRemove' title='Remover Contato'><i class='glyphicon glyphicon-remove'></i></a></td>" + 
                        "</tr>"
                    );
                });
    
                $modalEmpresa.fadeOut(250);
                $tbody.find("tr").not(".duplicate").remove();
                $(this).trigger("reset");
                return false;
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
            $(".create").on("submit", function(){
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
        });
        
        //Função Checkbox Area de lazer
        function somar(){
            var result = $("input:checked");
            var total = 0;
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