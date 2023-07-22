<?php
    if (!class_exists('Login')) :
        header('Location: ../../painel.php');
        die;
    endif;
    
    $read = new Read;
?>
<div class="bg-info bottom20">
    <div class="col-md-12 bottom20 bg_green">
        <p class="text-center"><i class="glyphicon glyphicon-check"></i> Pesquisa de Obras - <code>Filtro</code></p>
    </div>

    <div class="container-fluid">
        <div id="form_lista">
            <form class="search" action="./" id="formulario" method="POST">  
                <!--PERIODOS-->
                <div class="col-md-12 jumbotronBox">
                    <div class="col-md-12">
                        <p class="text-warning text-uppercase boxtitle"><i class="glyphicon glyphicon-search"></i> <b>Busca por Período</b> <code>* entre Datas</code></p>
                    </div>
                    <div class="col-md-6">
                        <label class="control-label">Data Inicial</label>
                        <div class="input-group">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                            <input type="text" name="inicial" class="form-control datepicker" value="" placeholder="Data Inicial..."/>
                            <div class="help-block with-errors"></div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="control-label">Data Final</label>
                        <div class="input-group">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                            <input type="text" name="final" class="form-control datepicker" value="" placeholder="Data Final..."/>
                            <div class="help-block with-errors"></div>
                        </div>
                    </div>
                </div>

                <!--FASES-->
                <div class="col-md-12">
                    <label class="control-label text-uppercase"><i class="glyphicon glyphicon-check"></i> Selecione as Fases</label>
                </div>

                <!--FASE 1-->
                <div>
                    <div class="col-md-12 jumbotronBox">
                        <p class="text-warning text-uppercase boxtitle"><input type="checkbox" class="fase1" /> <b>Fase 1</b> <i class="glyphicon glyphicon-ok"></i> <code>* Selecione Todos</code></p>
                        <?php   
                            $readF1 = $read;
                            $readF1->FullRead("SELECT fas.IdFase,
                                                    fas.DescricaoFase,
                                                    est.IdEstagio,
                                                    est.DescricaoEstagio	
                                                    FROM tb_fases_fas as fas
                                                    INNER JOIN tb_estagio_est AS est
                                                        ON fas.IdFase = est.IDFASE
                                                    AND fas.IdFase = 1
                                                    ORDER BY est.DescricaoEstagio");
                            if(!$readF1->getResult()):
                                echo "Não encontrado";
                                else:
                                    foreach($readF1->getResult() as $fas1):
                                        extract($fas1);
                        ?>
                        <div class="col-md-4">
                            <p class="text-right"><b><?= $DescricaoEstagio;?></b> <input type="checkbox" name="estagio[]" class="F1" value="<?= $IdEstagio;?>" /></p>
                        </div>
                        <?php
                            endforeach;
                            endif;
                        ?>
                    </div>
                </div>

                <!--FASE 2-->
                <div>
                    <div class="col-md-12 jumbotronBox">
                        <p class="text-warning text-uppercase boxtitle"><input type="checkbox" class="fase2" /> <b>Fase 2</b> <i class="glyphicon glyphicon-ok"></i> <code>* Selecione Todos</code></p>
                        <?php   
                            $readF2 = $read;
                            $readF2->FullRead("SELECT fas.IdFase,
                                                    fas.DescricaoFase,
                                                    est.IdEstagio,
                                                    est.DescricaoEstagio	
                                                    FROM tb_fases_fas as fas
                                                    INNER JOIN tb_estagio_est AS est
                                                        ON fas.IdFase = est.IDFASE
                                                    AND fas.IdFase = 2
                                                    ORDER BY est.DescricaoEstagio");
                            if(!$readF2->getResult()):
                                echo "Não encontrado";
                                else:
                                    foreach($readF2->getResult() as $fas2):
                                        extract($fas2);
                        ?>
                        <div class="col-md-4">
                            <p class="text-right"><b><?= $DescricaoEstagio;?></b> <input type="checkbox" name="estagio[]" class="F2" value="<?= $IdEstagio;?>" /></p>
                        </div>
                        <?php
                            endforeach;
                            endif;
                        ?>
                    </div>
                </div>

                <!--FASE 3-->
                <div>
                    <div class="col-md-12 jumbotronBox">
                        <p class="text-warning text-uppercase boxtitle"><input type="checkbox" class="fase3" /> <b>Fase 3</b> <i class="glyphicon glyphicon-ok"></i> <code>* Selecione Todos</code></p>
                        <?php   
                            $readF3 = $read;
                            $readF3->FullRead("SELECT fas.IdFase,
                                                        fas.DescricaoFase,
                                                        est.IdEstagio,
                                                        est.DescricaoEstagio	
                                                        FROM tb_fases_fas as fas
                                                        INNER JOIN tb_estagio_est AS est
                                                            ON fas.IdFase = est.IDFASE
                                                        AND fas.IdFase = 3
                                                        ORDER BY est.DescricaoEstagio");
                            if(!$readF3->getResult()):
                                echo "Não encontrado";
                                else:
                                    foreach($readF3->getResult() as $fas3):
                                        extract($fas3);
                        ?>
                        <div class="col-md-4">
                            <p class="text-right"><b><?= $DescricaoEstagio;?></b> <input type="checkbox" name="estagio[]" class="F3" value="<?= $IdEstagio;?>" /></p>
                        </div>
                        <?php
                            endforeach;
                            endif;
                        ?>
                    </div>
                </div>

                <!--SEGMENTO E ATUAÇÕES-->
                <div class="col-md-12">
                    <label class="control-label text-uppercase"><i class="glyphicon glyphicon-check"></i> Segmentos de Atuação</label>
                </div>

                <!--INDUSTRIAL-->
                <div>
                    <div class="col-md-12 jumbotronBox">
                        <p class="text-warning text-uppercase boxtitle"><input type="checkbox" class="Industrial" /> <b>Industrial</b> <i class="glyphicon glyphicon-ok"></i> <code>* Selecione Todos</code></p>
                        <?php   
                            $readS1 = $read;
                            $readS1->FullRead("SELECT seg.seg_Segmento_int_PK,
                                                    seg.seg_Segmento_chr,
                                                    tip.IdTipo,
                                                    tip.DescricaoTipo	
                                                    FROM tb_segmento_seg as seg
                                                    INNER JOIN tb_tipos_tip AS tip
                                                        ON tip.seg_Segmento_int_FK = seg.seg_Segmento_int_PK
                                                    AND seg.seg_Segmento_int_PK = 1
                                                    ORDER BY tip.DescricaoTipo");
                            if(!$readS1->getResult()):
                                echo "Não encontrado";
                                else:
                                    foreach($readS1->getResult() as $seg1):
                                        extract($seg1);
                        ?>
                        <div class="col-md-4">
                            <p class="text-right"><b><?= $DescricaoTipo;?></b> <input type="checkbox" name="tipo[]" class="Ind" value="<?= $IdTipo;?>" /></p>
                        </div>
                        <?php
                            endforeach;
                            endif;
                        ?>
                    </div>
                </div>

                <!--COMERCIAL-->
                <div>
                    <div class="col-md-12 jumbotronBox">
                        <p class="text-warning text-uppercase boxtitle"><input type="checkbox" class="Comercial" /> <b>Comercial</b> <i class="glyphicon glyphicon-ok"></i> <code>* Selecione Todos</code></p>
                        <?php   
                            $readS2 = $read;
                            $readS2->FullRead("SELECT seg.seg_Segmento_int_PK,
                                                    seg.seg_Segmento_chr,
                                                    tip.IdTipo,
                                                    tip.DescricaoTipo	
                                                    FROM tb_segmento_seg as seg
                                                    INNER JOIN tb_tipos_tip AS tip
                                                        ON tip.seg_Segmento_int_FK = seg.seg_Segmento_int_PK
                                                    AND seg.seg_Segmento_int_PK = 2
                                                    ORDER BY tip.DescricaoTipo");
                            if(!$readS2->getResult()):
                                echo "Não encontrado";
                                else:
                                    foreach($readS2->getResult() as $seg2):
                                        extract($seg2);
                        ?>
                        <div class="col-md-4">
                            <p class="text-right"><b><?= $DescricaoTipo;?></b> <input type="checkbox" name="tipo[]" class="Com" value="<?= $IdTipo;?>" /></p>
                        </div>
                        <?php
                            endforeach;
                            endif;
                        ?>
                    </div>
                </div>

                <!--RESIDENCIAL-->
                <div>
                    <div class="col-md-12 jumbotronBox">
                        <p class="text-warning text-uppercase boxtitle"><input type="checkbox" class="Residencial" /> <b>Residencial</b> <i class="glyphicon glyphicon-ok"></i> <code>* Selecione Todos</code></p>
                        <?php   
                            $readS3 = $read;
                            $readS3->FullRead("SELECT seg.seg_Segmento_int_PK,
                                                    seg.seg_Segmento_chr,
                                                    tip.IdTipo,
                                                    tip.DescricaoTipo	
                                                    FROM tb_segmento_seg as seg
                                                    INNER JOIN tb_tipos_tip AS tip
                                                        ON tip.seg_Segmento_int_FK = seg.seg_Segmento_int_PK
                                                    AND seg.seg_Segmento_int_PK = 3
                                                    ORDER BY tip.DescricaoTipo");
                            if(!$readS3->getResult()):
                                echo "Não encontrado";
                                else:
                                    foreach($readS3->getResult() as $seg3):
                                        extract($seg3);
                        ?>
                        <div class="col-md-4">
                            <p class="text-right"><b><?= $DescricaoTipo;?></b> <input type="checkbox" name="tipo[]" class="Res" value="<?= $IdTipo;?>" /></p>
                        </div>
                        <?php
                            endforeach;
                            endif;
                        ?>
                    </div>
                </div>

                <!--MARCAR TODAS AS REGIÕES-->
                <div class="col-md-12">
                    <label class="control-label text-uppercase"><i class="glyphicon glyphicon-check"></i> Regiões do Brasil <input type="checkbox" class="regiaoGeral" /> <code>* Selecione Todas as Regiões</code></label>
                </div>

                <!--NORDESTE-->
                <div>
                    <div class="col-md-12 jumbotronBox">
                        <p class="text-warning text-uppercase boxtitle"><input type="checkbox" class="Nordeste" /> <b>Nordeste</b> <i class="glyphicon glyphicon-ok"></i> <code>* Selecione Todos</code></p>
                        <?php   
                            $readNd = $read;
                            $readNd->FullRead("SELECT esr.IdEstado,
                                                    esr.IdRegiao,
                                                    est.DescricaoEstado	
                                                    FROM tb_estados_regioes_esr as esr
                                                    INNER JOIN tb_estados_est AS est
                                                        ON est.IdEstado = esr.IdEstado
                                                    AND esr.IdRegiao = 35
                                                    ORDER BY DescricaoEstado");
                            if(!$readNd->getResult()):
                                echo "Não encontrado";
                                else:
                                    foreach($readNd->getResult() as $nd):
                                        extract($nd);
                        ?>
                        <div class="col-md-4">
                            <p class="text-right"><b><?= $DescricaoEstado;?></b> <input type="checkbox" name="estado[]" class="checkRegiaoGeral checkNordeste" value="<?= $IdEstado;?>" /></p>
                        </div>
                        <?php
                            endforeach;
                            endif;
                        ?>
                    </div>
                </div>

                <!--SUDESTE-->
                <div>
                    <div class="col-md-12 jumbotronBox">
                        <p class="text-warning text-uppercase boxtitle"><input type="checkbox" class="Sudeste" /> <b>Sudeste</b> <i class="glyphicon glyphicon-ok"></i></p>
                        <?php   
                            $readSd = $read;
                            $readSd->FullRead("SELECT esr.IdEstado,
                                                    esr.IdRegiao,
                                                    est.DescricaoEstado	
                                                    FROM tb_estados_regioes_esr as esr
                                                    INNER JOIN tb_estados_est AS est
                                                        ON est.IdEstado = esr.IdEstado
                                                    AND esr.IdRegiao = 5
                                                    ORDER BY DescricaoEstado");
                            if(!$readSd->getResult()):
                                echo "Não encontrado";
                                else:
                                    foreach($readSd->getResult() as $sd):
                                        extract($sd);
                        ?>
                        <div class="col-md-4">
                            <p class="text-right"><b><?= $DescricaoEstado; ?></b> <input type="checkbox" name="estado[]" class="checkRegiaoGeral checkSudeste" value="<?= $IdEstado; ?>" /></p>
                        </div>
                        <?php
                            endforeach;
                            endif;
                        ?>
                    </div>
                </div>

                <!--SUL-->
                <div>
                    <div class="col-md-12 jumbotronBox">
                        <p class="text-warning text-uppercase boxtitle"><input type="checkbox" class="Sul" /> <b>Sul</b> <i class="glyphicon glyphicon-ok"></i> <code>* Selecione Todos</code></p>
                        <?php   
                            $readSu = $read;
                            $readSu->FullRead("SELECT esr.IdEstado,
                                                    esr.IdRegiao,
                                                    est.DescricaoEstado	
                                                    FROM tb_estados_regioes_esr as esr
                                                    INNER JOIN tb_estados_est AS est
                                                        ON est.IdEstado = esr.IdEstado
                                                    AND esr.IdRegiao = 4
                                                    ORDER BY DescricaoEstado");
                            if(!$readSu->getResult()):
                                echo "Não encontrado";
                                else:
                                    foreach($readSu->getResult() as $su):
                                        extract($su);
                        ?>
                        <div class="col-md-4">
                            <p class="text-right"><b><?= $DescricaoEstado;?></b> <input type="checkbox" name="estado[]" class="checkRegiaoGeral checkSul" value="<?= $IdEstado;?>" /></p>
                        </div>
                        <?php
                            endforeach;
                            endif;
                        ?>
                    </div>
                </div>

                <!--NORTE-->
                <div>
                    <div class="col-md-12 jumbotronBox">
                        <p class="text-warning text-uppercase boxtitle"><input type="checkbox" class="Norte" /> <b>Norte</b> <i class="glyphicon glyphicon-ok"></i> <code>* Selecione Todos</code></p>
                        <?php   
                            $readNt = $read;
                            $readNt->FullRead("SELECT esr.IdEstado,
                                                    esr.IdRegiao,
                                                    est.DescricaoEstado	
                                                    FROM tb_estados_regioes_esr as esr
                                                    INNER JOIN tb_estados_est AS est
                                                        ON est.IdEstado = esr.IdEstado
                                                    AND esr.IdRegiao = 34
                                                    ORDER BY DescricaoEstado");
                            if(!$readNt->getResult()):
                                echo "Não encontrado";
                                else:
                                    foreach($readNt->getResult() as $nt):
                                        extract($nt);
                        ?>
                        <div class="col-md-4">
                            <p class="text-right"><b><?= $DescricaoEstado;?></b> <input type="checkbox" name="estado[]" class="checkRegiaoGeral checkNorte" value="<?= $IdEstado;?>" /></p>
                        </div>
                        <?php
                            endforeach;
                            endif;
                        ?>
                    </div>
                </div>

                <!--CENTRO-OESTE-->
                <div>
                    <div class="col-md-12 jumbotronBox">
                        <p class="text-warning text-uppercase boxtitle"><input type="checkbox" class="Centro-Oeste" /> <b>Centro-Oeste</b> <i class="glyphicon glyphicon-ok"></i> <code>* Selecione Todos</code></p>
                        <?php   
                            $readCo = $read;
                            $readCo->FullRead("SELECT esr.IdEstado,
                                                    esr.IdRegiao,
                                                    est.DescricaoEstado	
                                                    FROM tb_estados_regioes_esr as esr
                                                    INNER JOIN tb_estados_est AS est
                                                        ON est.IdEstado = esr.IdEstado
                                                    AND esr.IdRegiao = 6
                                                    ORDER BY DescricaoEstado");
                            if(!$readCo->getResult()):
                                echo "Não encontrado";
                                else:
                                    foreach($readCo->getResult() as $co):
                                        extract($co);
                        ?>
                        <div class="col-md-4">
                            <p class="text-right"><b><?= $DescricaoEstado;?></b> <input type="checkbox" name="estado[]" class="checkRegiaoGeral checkCentro-Oeste" value="<?= $IdEstado;?>" /></p>
                        </div>
                        <?php
                            endforeach;
                            endif;
                        ?>
                    </div>
                </div>

                <!--FILTRO ESPECIFICO-->
                <div>
                    <div class="col-md-12 jumbotronBox">
                        <p class="text-warning boxtitle"><i class="glyphicon glyphicon-check"></i> <b>FILTRO ESPECÍFICO</b></p>
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-3">
                                    <label class="control-label"><i class="glyphicon glyphicon-ok"></i> PADRÃO</label>
                                    <select name="Padrao" class="form-control">
                                        <option value="0">SELECIONE</option>
                                        <option value="Alto">Alto</option>
                                        <option value="Baixo">Baixo</option>
                                        <option value="Medio">Médio</option>  
                                    </select>
                                    <div class="help-block with-errors"></div>
                                </div>
                                <div class="col-md-9">
                                    <label class="control-label"><i class="glyphicon glyphicon-ok"></i> Nome da Obra</label>
                                    <input type="text" name="Projeto" class="form-control" id="busca-obra" value="" />
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>
                            <label class="control-label"><i class="glyphicon glyphicon-ok"></i> Endereço</label>
                            <input type="text" name="Endereco" class="form-control" id="busca-adress" value="" />
                            <div class="help-block with-errors"></div>
                            <!--Estado-->
                            <div class="row">
                                <div class="col-md-2">
                                    <label class="control-label"><i class="glyphicon glyphicon-map-marker"></i> Estado</label>
                                    <select name="Estado" class="form-control">
                                        <option value="">SEL..</option>
                                        <?php
                                            $readEst = $read;
                                            $readEst->ExeRead("tb_estados_est", "ORDER BY IdEstado");
                                            if($readEst->getResult()):
                                                foreach($readEst->getResult() AS $est):
                                                    extract($est);
                                                    echo "<option value='$UF'>$UF</option>";
                                                endforeach;
                                            endif;
                                        ?>
                                    </select>
                                </div>
                                <!--Cidades-->
                                <div class="col-md-10">
                                    <label class="control-label"><i class="glyphicon glyphicon-map-marker"></i> <code>*Selecione até 4 cidade(s) para busca</code></label>
                                    <select name="Nome" class="form-control cidade" id="selected"><!--IMPORTANTE O id="selected"-->
                                        <option value="0"> - SELECIONE PRIMEIRO O ESTADO</option>
                                    </select>
                                    <div style="display: none;">
                                        <div class="selected"><!--importante a classe selected-->
                                            <?php
                                            for($i = 1; $i<=4; $i++){
                                                echo "<p><input type='checkbox' name='CidadeSelected[]' value='' ></p>";
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <label class="control-label"><i class="glyphicon glyphicon-ok"></i> CEP Inicial</label>
                            <input type="text" name="CepInicial" class="form-control cep" value="" />
                            <div class="help-block with-errors"></div>

                            <label class="control-label"><i class="glyphicon glyphicon-ok"></i> Área Construída(m²)</label>
                            <div class="row">
                                <div class="col-md-6">
                                    <select name="qa" class="form-control">
                                        <option value="0">SELECIONE</option>
                                        <option value=">">Maior que</option>
                                        <option value="<">Menor que</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <input type="text" name="area" class="form-control" value=""/>
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>
                            <div class="row"></div>

                            <label class="control-label"><i class="glyphicon glyphicon-ok"></i> Empresa Participante</label>
                            <input type="text" name="empresa" class="form-control" id="busca-fantasia" value="" />

                            <div class="help-block with-errors"></div>
                            <label class="control-label"><i class="glyphicon glyphicon-ok"></i> Descrição</label>
                            <input type="text" name="DescProj1" class="form-control" id="busca-descricao" value="" />
                            <div class="help-block with-errors"></div>

                            <div class="row">
                                <div class="col-md-6">
                                    <label class="control-label"><i class="glyphicon glyphicon-ok"></i> Pesquisador</label>
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
                                                        echo "<option value='$IdPesquisador'>$SiglaPesquisador</option>";
                                                    endforeach;
                                            endif;
                                        ?>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label class="control-label"><i class="glyphicon glyphicon-ok"></i> Status atual do SIG</label>
                                        <select name="IdStatusSIG" class="form-control">
                                            <option value="0">SELECIONE</option>
                                            <?php
                                                $readSIG = $read;
                                                $readSIG->ExeRead("tb_statussig_sts", "ORDER BY DescricaoStatusSIG");
                                                if($readSIG->getResult()):
                                                    foreach($readSIG->getResult() AS $sig):
                                                        extract($sig);
                                                        echo "<option value='$IdStatusSIG'>$DescricaoStatusSIG</option>";
                                                    endforeach;
                                                endif;
                                            ?>
                                        </select>
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <label class="control-label"><i class="glyphicon glyphicon-ok"></i> Código da Obra <code>para selecionar mais de uma Obra, separe por virgula</code></label>
                            <input type="text" name="Codigo" class="form-control" value="" placeholder="Mais de uma obra, ex: RE00145,CO04785" />
                            <div class="help-block with-errors"></div>
                            <label class="control-label"><i class="glyphicon glyphicon-ok"></i> Bairro</label>
                            <input type="text" name="Complemento" class="form-control"  id="busca-bairro" value="" />
                            
                            <div class="help-block with-errors"></div>
                            
                            <!--Cidades selecioandas-->
                            <label class="control-label"><i class="glyphicon glyphicon-map-marker"></i> Cidades Selecionadas - <a class="clear">Limpar selecionada(s)</a></label>
                            <input type="text" name="Cidades" class="form-control viewSelect" style="color:blue;" placeholder="Selecione independente do Estado, mas será consultado até 4 Cidade(s) ..." readonly="">
                            <div class="help-block with-errors"></div>
                            
                            <label class="control-label"><i class="glyphicon glyphicon-ok"></i> CEP final</label>
                            <input type="text" name="CepFinal" class="form-control cep" value="" />
                            <div class="help-block with-errors"></div>
                            <label class="control-label"><i class="glyphicon glyphicon-ok"></i> Valor do Investimento</label>
                            <div class="row">
                                <div class="col-md-6">
                                    <select name="qi" class="form-control">
                                        <option value="0">SELECIONE</option>
                                        <option value=">">Maior que</option>
                                        <option value="<">Menor que</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <input type="text" name="Valor" class="form-control dinheiro" value=""/>
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-6">
                                    <label class="control-label"><i class="glyphicon glyphicon-ok"></i> Modalidade</label>
                                        <select name="modalidade" class="form-control modalidade">
                                            <option value="">SELECIONE</option>
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
                                
                                <div class="col-md-6">
                                    <label class="control-label"><i class="glyphicon glyphicon-ok"></i> Pavimentos</label>
                                    <input type="text" name="obr_DescResidPavimentos_chr" class="form-control" value=""/>
                                    <div class="help-block with-errors"></div>
                                </div>
                                
                            </div> 

                            <label class="control-label"><i class="glyphicon glyphicon-ok"></i> Número de Revisão</label>
                            <div class="row">
                                <div class="col-md-6">
                                    <select name="qr" class="form-control">
                                        <option value="0">SELECIONE</option>
                                        <option value=">">Maior que</option>
                                        <option value="<">Menor que</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <input type="text" name="NrDaRevisao" class="form-control num" value=""/>
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <label class="control-label"><i class="glyphicon glyphicon-ok"></i> Início das Obras</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                                        <input type="text" name="InicioInicial" class="form-control datepicker" value="" placeholder="Data incial do mês desejado para Inicio"/>
                                        <input type="text" name="InicioFinal" class="form-control datepicker" value="" placeholder="Data final do mês desejado para Inicio"/> 
                                    </div>
                                    <div class="help-block with-errors"></div>
                                </div>
                                <div class="col-md-6">
                                    <label class="control-label"><i class="glyphicon glyphicon-ok"></i> Término das Obras</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                                        <input type="text" name="TerminoInicial" class="form-control datepicker" value="" placeholder="Data incial do mês desejado para Término"/>
                                        <input type="text" name="TerminoFinal" class="form-control datepicker" value="" placeholder="Data final do mês desejado para Término"/> 
                                    </div>
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>   
                        </div>
                        
                    </div>
                </div>

                <!--PESQUISAS SALVAS-->
                <div class="col-md-3">
                    <label class="control-label"><i class="glyphicon glyphicon-check"></i> Pesquisa(s) Salva(s)</label>
                    <select name="" id="selecao" class="form-control">
                        <option value="0">SELECIONE</option>
                        <?php
                            $readPes = new $read;
                            $readPes->ExeRead("tb_pesquisa_save_svp", "WHERE user = {$userlogin['usu_Usuario_int_PK']}");
                            if(!$readPes->getResult()):
                            echo "<option>Não encontrado</option>";
                            else:
                                foreach($readPes->getResult() AS $pes):
                                    extract($pes);
                                    echo "<option value='$id'>$nome</option>";
                                endforeach;
                            endif;
                        ?>
                    </select>
                </div>
                
                <!--PESQUISAS DELETAR-->
                <div class="col-md-3">
                    <label class="control-label text-danger"><i class="glyphicon glyphicon-check"></i> Deletar Pesquisa(s)</label>
                    <select name="" id="delete" class="form-control">
                        <option value="0">SELECIONE - Delete automatico</option>
                        <?php
                            $readPes = new $read;
                            $readPes->ExeRead("tb_pesquisa_save_svp", "WHERE user = {$userlogin['usu_Usuario_int_PK']}");
                            if(!$readPes->getResult()):
                            echo "<option>Não encontrado</option>";
                            else:
                                foreach($readPes->getResult() AS $pes):
                                    extract($pes);
                                    echo "<option value='$id'>$nome</option>";
                                endforeach;
                            endif;
                        ?>
                    </select>
                </div>

                <!--ORDENAÇÃO-->
                <div class="col-md-3">
                    <label class="control-label"><i class="glyphicon glyphicon-check"></i> Ordenar por</label>
                    <select name="ordenar" class="form-control">
                        <option value="Projeto">Nome da obra</option>
                        <option value="CodigoAntigo">Codigo INTEC</option>
                        <option value="Endereco">Endereço</option>
                        <option value="Fantasia">Nome Fantasia da Empresa</option>
                        <option value="Cidade">Cidade</option>
                    </select>
                </div>

                <!--BOTÕES-->
                <div class="col-md-3">
                    <label class="control-label"><i class="glyphicon glyphicon-check"></i> Ação</label>
                    <br>
                    <button type="submit" class="btn btn-primary create" title="Salvar Pesquisa" name="SendPostSave" value="1" onclick="Acao('painel.php?exe=pesquisas/pesquisa-save');"><i class="glyphicon glyphicon-ok"></i> Salvar Pesquisa</button>
                    <button type="submit" class="btn btn-success submit" title="Pesquisar" name="SendPostPesquisa" value="1" onclick="Acao('painel.php?exe=pesquisas/pesquisa-obra');"><i class="glyphicon glyphicon-search"></i> Pesquisar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function Acao(act){
       frm = document.getElementById('formulario');
       frm.action = act; 
       frm.submit();
    }
    //Função Checkbox Fase 1
    function somarF1(){
        var resultF1 = $("input[class='F1']:checked");
        var totalF1 = 0;
        for(var i = 0; i < resultF1.length; i++){
            totalF1 = totalF1 + parseFloat(resultF1[i].value);
        }
        $("input[name='fase1Save']").val(totalF1);
    }
    somarF1();
    $(".F1").click(somarF1);
    
    //Função Checkbox Fase 2
    function somarF2(){
        var resultF2 = $("input[class='F2']:checked");
        var totalF2 = 0;
        for(var i = 0; i < resultF2.length; i++){
            totalF2 = totalF2 + parseFloat(resultF2[i].value);
        }
        $("input[name='fase2Save']").val(totalF2);
    }
    somarF2();
    $(".F2").click(somarF2);
    
    //Função Checkbox Fase 3
    function somarF3(){
        var resultF3 = $("input[class='F3']:checked");
        var totalF3 = 0;
        for(var i = 0; i < resultF3.length; i++){
            totalF3 = totalF3 + parseFloat(resultF3[i].value);
        }
        $("input[name='fase3Save']").val(totalF3);
    }
    somarF3();
    $(".F3").click(somarF3);
    
    $(function(){
        //Colocando nos input hidden CidadeSelected[], vindo Da seleçao de cidades por Nome usando cidade-array.php
        var select = $("select[name='Nome']"),
            ids = {'selected': new Array()};
            select.change(function(){
            var nameId = this.id,
                    id     = this.value, // pega o valor do id selecionado
                    text   = $(this).find('option[value="' + id + '"]').text(), // esconde valor do option e pega o nome do selecionado
                    nome   = $('#form_lista .' + nameId + ' p'),//pega o nome da lista
                    len    = nome.length,
                    idx    = $.inArray(id, ids[nameId]),
                    index  = len - 1;
                       
                // nome.find('input').each(function(){
                nome.find('input').prop('checked', true);
                //});

                //se não estiver no array adiciona na lista
                if (id > 0 && idx == -1){
                    nome.find('input').each(function(i){
                    //console.log(i);
                    if (!this.value && i < index)
                        index = i;
                });
                //remove o ultimo item
                if (index == len - 1)
                nome.eq(len - 1).click();
                nome.eq(index).find('input').val(text).parent('p');
                ids[nameId].push(id);
            }
        });
        
        $(".cidade").on("change",function() {
            $(".viewSelect").val($(".viewSelect").val()+" "+$(".cidade option:selected").text()+ ", ");    
        });
        $(".clear").on ("click", function(){
            $(".viewSelect").val("");    
        });
                
        //FASES - F1
        var $marcarF1   = $(".fase1"),
            $checkboxF1 = $(".F1"),
            //F2
            $marcarF2   = $(".fase2"),
            $checkboxF2 = $(".F2"),
            //F3
            $marcarF3   = $(".fase3"),
            $checkboxF3 = $(".F3"),
            
            //SEGMENTOS - S1
            $marcarS1   = $(".Industrial"),
            $checkboxS1 = $(".Ind"),
            //S2
            $marcarS2   = $(".Comercial"),
            $checkboxS2 = $(".Com"),
            //S3
            $marcarS3   = $(".Residencial"),
            $checkboxS3 = $(".Res"),
            
            /*Região Geral*/
            $marcarRegiao     = $(".regiaoGeral"),
            $checkboxRegiao   = $(".checkRegiaoGeral"),
            /*Nordeste*/
            $marcarNordeste   = $(".Nordeste"),
            $checkboxNordeste = $(".checkNordeste"),
            /*Sudeste*/
            $marcarSudeste   = $(".Sudeste"),
            $checkboxSudeste = $(".checkSudeste"),
            /*Sul*/
            $marcarSul        = $(".Sul"),
            $checkboxSul      = $(".checkSul"),
            /*Norte*/
            $marcarNorte      = $(".Norte"),
            $checkboxNorte    = $(".checkNorte"),
            /*Centro-Oeste*/
            $marcarOeste      = $(".Centro-Oeste"),
            $checkboxOeste    = $(".checkCentro-Oeste");
            
        //Marcando Todos os checkbox Regioes todo Brasil
        $marcarRegiao.on("change", function(){
            if($(this).is(":checked")){
                $checkboxRegiao.each(function(){
                    this.checked = true;              
                });
            }else{
                $checkboxRegiao.each(function(){
                    this.checked = false;    
                });         
            }
        }); 
        
        //Marcando Todos os checkbox Regioes Nordeste
        $marcarNordeste.on("change", function(){
            if($(this).is(":checked")){
                $checkboxNordeste.each(function(){
                    this.checked = true;              
                });
            }else{
                $checkboxNordeste.each(function(){
                    this.checked = false;    
                });         
            }
        });
        
        //Marcando Todos os checkbox Regioes Sudeste
        $marcarSudeste.on("change", function(){
            if($(this).is(":checked")){
                $checkboxSudeste.each(function(){
                    this.checked = true;              
                });
            }else{
                $checkboxSudeste.each(function(){
                    this.checked = false;    
                });         
            }
        });  
    
        //Marcando Todos os checkbox Regioes Sul
        $marcarSul.on("change", function(){
            if($(this).is(":checked")){
                $checkboxSul.each(function(){
                    this.checked = true;              
                });
            }else{
                $checkboxSul.each(function(){
                    this.checked = false;    
                });         
            }
        });  
        
        //Marcando Todos os checkbox Regioes Norte
        $marcarNorte.on("change", function(){
            if($(this).is(":checked")){
                $checkboxNorte.each(function(){
                    this.checked = true;              
                });
            }else{
                $checkboxNorte.each(function(){
                    this.checked = false;    
                });         
            }
        });  
        
        //Marcando Todos os checkbox Regioes Centro-Oeste
        $marcarOeste.on("change", function(){
            if($(this).is(":checked")){
                $checkboxOeste.each(function(){
                    this.checked = true;              
                });
            }else{
                $checkboxOeste.each(function(){
                    this.checked = false;    
                });         
            }
        });
        
        //**************************FASES*******************    
        //Marcando Todos os checkbox F1
        $marcarF1.on("change", function(){
            if($(this).is(":checked")){
                $checkboxF1.each(function(){
                    this.checked = true;              
                });
            }else{
                $checkboxF1.each(function(){
                    this.checked = false;    
                });         
            }
        });
        
        //Marcando Todos os checkbox F2
        $marcarF2.on("change", function(){
            if($(this).is(":checked")){
                $checkboxF2.each(function(){
                    this.checked = true;              
                });
            }else{
                $checkboxF2.each(function(){
                    this.checked = false;    
                });         
            }
        });
        
        //Marcando Todos os checkbox F3
        $marcarF3.on("change", function(){
            if($(this).is(":checked")){
                $checkboxF3.each(function(){
                    this.checked = true;              
                });
            }else{
                $checkboxF3.each(function(){
                    this.checked = false;    
                });         
            }
        });
        
        //****************SEGUIMENTOS***************
        
        //Marcando Todos os checkbox S1
        $marcarS1.on("change", function(){
            if($(this).is(":checked")){
                $checkboxS1.each(function(){
                    this.checked = true;              
                });
            }else{
                $checkboxS1.each(function(){
                    this.checked = false;    
                });         
            }
        });
        
        //Marcando Todos os checkbox S2
        $marcarS2.on("change", function(){
            if($(this).is(":checked")){
                $checkboxS2.each(function(){
                    this.checked = true;              
                });
            }else{
                $checkboxS2.each(function(){
                    this.checked = false;    
                });         
            }
        });
        
        //Marcando Todos os checkbox S3
        $marcarS3.on("change", function(){
            if($(this).is(":checked")){
                $checkboxS3.each(function(){
                    this.checked = true;              
                });
            }else{
                $checkboxS3.each(function(){
                    this.checked = false;    
                });         
            }
        });
        
        $('#selecao').change(function(){
            var parametro = $(this).find(':selected').val()
            location.href = 'painel.php?exe=pesquisas/pesquisa-save-view&id=' + parametro;
        });
        
        $('#delete').change(function(){
            var parametro = $(this).find(':selected').val()
            location.href = 'painel.php?exe=pesquisas/pesquisa-delete-view&id=' + parametro;
        });
    });
</script>