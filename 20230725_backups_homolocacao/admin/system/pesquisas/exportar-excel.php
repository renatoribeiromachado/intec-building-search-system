<?php
    if (!class_exists('Login')) :
        header('Location: ../../imp.php');
        die;
    endif; 
    
    //DATA ATUAL
    $data  = date("d/m/Y");
    //CONDITION
    $condition = filter_input(INPUT_GET, 'condition', FILTER_DEFAULT);

   // echo $condition;
    //NOME QUE SERA SALVO
    $arquivo = 'Pesquisa de Obra(s) -'.$data.''.'.xls';

    //INICIO TB
    $tabela  = '<table width="100%" border="1">';
        $tabela .= '<tr>';
            $tabela .= '<td colspan="52"><b style="font-size: 70px;color: orange;">INTEC</b> <b style="font-size: 40px;"> - PLANILHA DE OBRAS - </b>  <span style="font-size: 40px;">'.$data.'</span></td>';
        $tabela .= '</tr>';
        
        $tabela .= '<tr>';
            $tabela .= '<th style="background-color: #1F487D; width:200px; height:50px; color:white; font-size: 20px; padding:10px 10px 10px 10px;"><b>Código INTEC</b></th>';
            $tabela .= '<th style="background-color: #1F487D; width:200px; height:50px; color:white; font-size: 20px; padding:10px 10px 10px 10px;"><b>Data Atualização</b></th>';
            $tabela .= '<th style="background-color: #1F487D; width:200px; height:50px; color:white; font-size: 20px; padding:10px 10px 10px 10px;"><b>Nº Revisão</b></th>';
            $tabela .= '<th style="background-color: #1F487D; width:1000px; height:50px; color:white; font-size: 20px; padding:10px 10px 10px 10px;"><b>Nome da Obra</b></th>';
            $tabela .= '<th style="background-color: #1F487D; width:200px; height:50px; color:white; font-size: 20px; padding:10px 10px 10px 10px;"><b>Valor do Investimento</b></th>';
            /*$tabela .= '<th style="background-color: #1F487D; height:50px; color:white; font-size: 20px; padding:10px 10px 10px 10px;"><b>Cub</b></th>';*/
            $tabela .= '<th style="background-color: #1F487D; width:400px; height:50px; color:white; font-size: 20px; padding:10px 10px 10px 10px;"><b>Padrão do Investimento</b></th>';

            $tabela .= '<th style="background-color: #1F487D; width:200px; height:50px; color:white; font-size: 20px; padding:10px 10px 10px 10px;"><b>Área Total do Projeto</b></th>';
            $tabela .= '<th style="background-color: #1F487D; width:700px; height:50px; color:white; font-size: 20px; padding:10px 10px 10px 10px;"><b>Endereço</b></th>';
            $tabela .= '<th style="background-color: #1F487D; width:400px; height:50px; color:white; font-size: 20px; padding:10px 10px 10px 10px;"><b>Bairro</b></th>';                  
            $tabela .= '<th style="background-color: #1F487D; width:200px; height:50px; color:white; font-size: 20px; padding:10px 10px 10px 10px;"><b>Cep</b></th>';            
            $tabela .= '<th style="background-color: #1F487D; width:400px; height:50px; color:white; font-size: 20px; padding:10px 10px 10px 10px;"><b>Cidade</b></th>';
            $tabela .= '<th style="background-color: #1F487D; width:100px; height:50px; color:white; font-size: 20px; padding:10px 10px 10px 10px;"><b>Estado</b></th>';
            $tabela .= '<th style="background-color: #1F487D; width:200px; height:50px; color:white; font-size: 20px; padding:10px 10px 10px 10px;"><b>Início da Obra</b></th>';
            $tabela .= '<th style="background-color: #1F487D; width:200px; height:50px; color:white; font-size: 20px; padding:10px 10px 10px 10px;"><b>Término da Obra</b></th>';
            $tabela .= '<th style="background-color: #1F487D; width:400px; height:50px; color:white; font-size: 20px; padding:10px 10px 10px 10px;"><b>Início / Término</b></th>';
            $tabela .= '<th style="background-color: #1F487D; width:400px; height:50px; color:white; font-size: 20px; padding:10px 10px 10px 10px;"><b>Estágio Atual</b></th>';
            $tabela .= '<th style="background-color: #1F487D; width:200px; height:50px; color:white; font-size: 20px; padding:10px 10px 10px 10px;"><b>Fase</b></th>';
            $tabela .= '<th style="background-color: #1F487D; width:400px; height:50px; color:white; font-size: 20px; padding:10px 10px 10px 10px;"><b>Segmento de Atuação</b></th>';
            $tabela .= '<th style="background-color: #1F487D; width:400px; height:50px; color:white; font-size: 20px; padding:10px 10px 10px 10px;"><b>Subtipo</b></th>';
            $tabela .= '<th style="background-color: #1F487D; width:400px; height:50px; color:white; font-size: 20px; padding:10px 10px 10px 10px;"><b>Nº de Edifícios</b></th>';
            $tabela .= '<th style="background-color: #1F487D; width:400px; height:50px; color:white; font-size: 20px; padding:10px 10px 10px 10px;"><b>Casas</b></th>';
            $tabela .= '<th style="background-color: #1F487D; width:400px; height:50px; color:white; font-size: 20px; padding:10px 10px 10px 10px;"><b>Cond. de Casas</b></th>';
            $tabela .= '<th style="background-color: #1F487D; width:400px; height:50px; color:white; font-size: 20px; padding:10px 10px 10px 10px;"><b>Nº de Pavimentos</b></th>';
            $tabela .= '<th style="background-color: #1F487D; width:400px; height:50px; color:white; font-size: 20px; padding:10px 10px 10px 10px;"><b>Apart./Salas por Andar</b></th>';

            $tabela .= '<th style="background-color: #1F487D; width:400px; height:50px; color:white; font-size: 20px; padding:10px 10px 10px 10px;"><b>Dormitórios</b></th>';
            $tabela .= '<th style="background-color: #1F487D; width:400px; height:50px; color:white; font-size: 20px; padding:10px 10px 10px 10px;"><b>Suítes</b></th>';
            $tabela .= '<th style="background-color: #1F487D; width:400px; height:50px; color:white; font-size: 20px; padding:10px 10px 10px 10px;"><b>Banheiros</b></th>';
            $tabela .= '<th style="background-color: #1F487D; width:400px; height:50px; color:white; font-size: 20px; padding:10px 10px 10px 10px;"><b>Lavabos</b></th>'; 
            $tabela .= '<th style="background-color: #1F487D; width:400px; height:50px; color:white; font-size: 20px; padding:10px 10px 10px 10px;"><b>Sala de Jantar/Estar</b></th>';       
            $tabela .= '<th style="background-color: #1F487D; width:400px; height:50px; color:white; font-size: 20px; padding:10px 10px 10px 10px;"><b>Área de Serviço/Terraço/Varanda</b></th>';
            $tabela .= '<th style="background-color: #1F487D; width:400px; height:50px; color:white; font-size: 20px; padding:10px 10px 10px 10px;"><b>Copas/Cozinhas</b></th>';
            $tabela .= '<th style="background-color: #1F487D; width:400px; height:50px; color:white; font-size: 20px; padding:10px 10px 10px 10px;"><b>Dependência de Empregada</b></th>';
            $tabela .= '<th style="background-color: #1F487D; width:700px; height:50px; color:white; font-size: 20px; padding:10px 10px 10px 10px;"><b>Outros</b></th>';
            $tabela .= '<th style="background-color: #1F487D; width:400px; height:50px; color:white; font-size: 20px; padding:10px 10px 10px 10px;"><b>Total de Unidades</b></th>';
            $tabela .= '<th style="background-color: #1F487D; width:700px; height:50px; color:white; font-size: 20px; padding:10px 10px 10px 10px;"><b>Área Útil (m²)</b></th>';
            $tabela .= '<th style="background-color: #1F487D; width:400px; height:50px; color:white; font-size: 20px; padding:10px 10px 10px 10px;"><b>Área do Terreno (m²)</b></th>';
            $tabela .= '<th style="background-color: #1F487D; width:400px; height:50px; color:white; font-size: 20px; padding:10px 10px 10px 10px;"><b>Elevador</b></th>';
            $tabela .= '<th style="background-color: #1F487D; width:400px; height:50px; color:white; font-size: 20px; padding:10px 10px 10px 10px;"><b>Vagas</b></th>';
            $tabela .= '<th style="background-color: #1F487D; width:400px; height:50px; color:white; font-size: 20px; padding:10px 10px 10px 10px;"><b>Cobertura (m²)</b></th>';
            $tabela .= '<th style="background-color: #1F487D; width:400px; height:50px; color:white; font-size: 20px; padding:10px 10px 10px 10px;"><b>Ar Condicionado</b></th>';
            $tabela .= '<th style="background-color: #1F487D; width:400px; height:50px; color:white; font-size: 20px; padding:10px 10px 10px 10px;"><b>Aquecimento</b></th>';
            $tabela .= '<th style="background-color: #1F487D; width:500px; height:50px; color:white; font-size: 20px; padding:10px 10px 10px 10px;"><b>Fundações</b></th>';
            $tabela .= '<th style="background-color: #1F487D; width:400px; height:50px; color:white; font-size: 20px; padding:10px 10px 10px 10px;"><b>Estrutura</b></th>';
            $tabela .= '<th style="background-color: #1F487D; width:1000px; height:50px; color:white; font-size: 20px; padding:10px 10px 10px 10px;"><b>Acabamento</b></th>';
            $tabela .= '<th style="background-color: #1F487D; width:700px; height:50px; color:white; font-size: 20px; padding:10px 10px 10px 10px;"><b>Fachada</b></th>';
            $tabela .= '<th style="background-color: #1F487D; width:1000px; height:50px; color:white; font-size: 20px; padding:10px 10px 10px 10px;"><b>Área de lazer</b></th>';
            $tabela .= '<th style="background-color: #1F487D; width:1500px; height:50px; color:white; font-size: 20px; padding:10px 10px 10px 10px;"><b>Outros Lazer</b></th>';
            $tabela .= '<th style="background-color: #1F487D; width:40500px; height:50px; color:white; font-size: 20px; padding:10px 10px 10px 10px;"><b>Detalhes</b></th>';

            //Contato
            $tabela .= '<th style="background-color: #1F487D; width:2500px; height:50px; color:white; font-size: 20px;"><b>Nome do Contato(s)</b></th>';
            $tabela .= '<th style="background-color: #1F487D; width:2500px; height:50px; color:white; font-size: 20px;"><b>E-mail(s)</b></th>';
            $tabela .= '<th style="background-color: #1F487D; width:2500px; height:50px; color:white; font-size: 20px;"><b>Telefone(s)</b></th>';
            
            //Empresa Participante
            $tabela .= '<th style="background-color: #1F487D; width:45500px; height:50px; color:white; font-size: 20px; padding:10px 10px 10px 10px;"><b>Nome Fantasia da Empresa Participante</b></th>';
            //$tabela .= '<th style="background-color: #1F487D; height:50px; color:white; font-size: 20px; padding:10px 10px 10px 10px;"><b>Obra</b></th>';
            //$tabela .= '<th style="background-color: #1F487D; height:50px; color:white; font-size: 20px; padding:10px 10px 10px 10px;"><b>Endereço</b></th>';
            //$tabela .= '<th style="background-color: #1F487D; height:50px; color:white; font-size: 20px; padding:10px 10px 10px 10px;"><b>Estágio</b></th>';
            //$tabela .= '<th style="background-color: #1F487D; height:50px; color:white; font-size: 20px; padding:10px 10px 10px 10px;"><b>Tipo</b></th>';

        $tabela .= '</tr>';
        
        $tabela .= '<tr>';
        //Leitura   
        $read = new Read;
        
        $read->FullRead("SELECT emp.Fantasia,
                                emp.RazaoSocial,
                                emp.CNPJ,
                                obr.Codigo,
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
                                obr.EstagioAtual,
                                obr.DescProj1,
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
                                est.UF, 
                                tip.DescricaoTipo,
                                estg.DescricaoEstagio,
                                seg.seg_Segmento_chr AS segmento,
                                seg.seg_CorSegmento_chr,
                                fas.DescricaoFase AS DescFase
                                FROM tb_empresas_emp AS emp
                                    LEFT JOIN tb_empresas_obras_emo AS emo
                                ON emo.IdEmpresa = emp.Codigo
                                    LEFT JOIN tb_obras_obr AS obr
                                ON obr.Codigo = emo.IdObra
                                    LEFT JOIN tb_estados_regioes_esr AS esr 
                                ON obr.IdEstado = esr.IdEstado 
                                    LEFT JOIN tb_estados_est AS est 
                                ON est.IdEstado = obr.IdEstado 
                                    LEFT JOIN tb_tipos_tip AS tip 
                                ON tip.IdTipo = obr.IdTipo 
                                    LEFT JOIN tb_estagio_est AS estg 
                                ON estg.IdEstagio = obr.IdEstagio
                                    LEFT JOIN tb_segmento_seg AS seg 
                                ON seg.seg_Segmento_int_PK = seg_Segmento_int_FK 
                                    LEFT JOIN tb_fases_fas As fas
                                ON fas.IdFase = obr.IdFase
                                WHERE {$condition}
                                AND obr.IdEstado = esr.IdEstado
                                AND obr.INDSTATUS = 1
                                GROUP BY obr.Codigo,obr.IdTipo,obr.IdEstagio
                                ORDER BY obr.Projeto ASC LIMIT 500");
        if (!$read->getResult()):
            WSErro("Não existe Obras cadastradas no sistema!", WS_INFOR);
            else:
            foreach ($read->getResult() as $res):
                extract($res);
                //$Valor = number_format($Valor, 2,",",".");
                
                $tabela .= '<td style="padding-right: 10px;">'.$CodigoAntigo.'</td>';
                $tabela .= '<td style="padding-right: 10px;">'.date("d/m/Y", strtotime($Atualizacao)).'</td>';
                $tabela .= '<td style="padding-right: 10px;">'.$NrDaRevisao.'</td>';
                $tabela .= '<td style="padding-right: 10px;">'.$Projeto.'</td>';
                if($Valor == null){
                   $tabela .= '<td style="padding-right: 10px;">0.00</td>'; 
                }else{
                    $tabela .= '<td style="padding-right: 10px;">'.number_format($Valor,2,",",".").'</td>';
                }
                /*$tabela .= '<td style="padding-right: 10px;">'.$Cub.'</td>';*/
                $tabela .= '<td style="padding-right: 10px;">'.$Padrao.'</td>';
                $tabela .= '<td style="padding-right: 10px;">'.json_encode($AreaConstruida).'</td>';
                $tabela .= '<td style="padding-right: 10px;">'.$Endereco.', '.$numero.'</td>';
                $tabela .= '<td style="padding-right: 10px;">'.$Complemento.'</td>';
                $tabela .= '<td style="padding-right: 10px;">'.$CEP.'</td>';
                $tabela .= '<td style="padding-right: 10px;">'.$Cidade.'</td>';
                $tabela .= '<td style="padding-right: 10px;">'.$UF.'</td>';
                $tabela .= '<td style="padding-right: 10px;">'.$Inicio.'</td>';
                $tabela .= '<td style="padding-right: 10px;">'.$Termino.'</td>';
                $tabela .= '<td style="padding-right: 10px;">'.$InicioTermino.'</td>';
                $tabela .= '<td style="padding-right: 10px;">'.$DescricaoEstagio.'</td>';
                $tabela .= '<td style="padding-right: 10px;">'.$DescFase.'</td>';
                $tabela .= '<td style="padding-right: 10px;">'.$segmento.'</td>';
                $tabela .= '<td style="padding-right: 10px;">'.$DescricaoTipo.'</td>';
                $tabela .= '<td style="padding-right: 10px;">'.$obr_DescResidEdificio_chr.'</td>';
                $tabela .= '<td style="padding-right: 10px;">'.$obr_DescResidResidenciais_chr.'</td>'; 
                $tabela .= '<td style="padding-right: 10px;">'.$obr_DescResidCondominios_chr.'</td>';
                $tabela .= '<td style="padding-right: 10px;">'.$obr_DescResidPavimentos_chr.'</td>';
                $tabela .= '<td style="padding-right: 10px;">'.$obr_DescResidApartamentos_chr.'</td>';
                $tabela .= '<td style="padding-right: 10px;">'.$obr_DescResidDormitorios_chr.'</td>';
                $tabela .= '<td style="padding-right: 10px;">'.$obr_DescResidSuite_chr.'</td>';
                $tabela .= '<td style="padding-right: 10px;">'.$obr_DescResidBanheiro_chr.'</td>';
                $tabela .= '<td style="padding-right: 10px;">'.$obr_DescResidLavabo_chr.'</td>';
                $tabela .= '<td style="padding-right: 10px;">'.$obr_DescResidSala_chr.'</td>';
                $tabela .= '<td style="padding-right: 10px;">'.$obr_DescInfoAdicAreaUtil_chr.'</td>';
                $tabela .= '<td style="padding-right: 10px;">'.$obr_DescResidCopa_chr.'</td>';
                $tabela .= '<td style="padding-right: 10px;">'.$obr_DescResidDepEmpreg_chr.'</td>';
                $tabela .= '<td style="padding-right: 10px;">'.$obr_DescResidOutros_chr.'</td>';
                $tabela .= '<td style="padding-right: 10px;">'.$obr_DescInfoAdicTotalUnicades_chr.'</td>';
                $tabela .= '<td style="padding-right: 10px;">'.$obr_DescInfoAdicAreaUtil_chr.'</td>';
                $tabela .= '<td style="padding-right: 10px;">'.$obr_DescInfoAdicAreaTerreno_chr.'</td>';
                $tabela .= '<td style="padding-right: 10px;">'.$obr_DescInfoAdicElevador_chr.'</td>';
                $tabela .= '<td style="padding-right: 10px;">'.$obr_DescInfoAdicVagas_chr.'</td>';
                $tabela .= '<td style="padding-right: 10px;">'.$obr_DescInfoAdicCobert_chr.'</td>';
                $tabela .= '<td style="padding-right: 10px;">'.$obr_DescInfoAdicArCondic_chr.'</td>';
                $tabela .= '<td style="padding-right: 10px;">'.$obr_DescInfoAdicAquecimento_chr.'</td>';
                $tabela .= '<td style="padding-right: 10px;">'.$obr_DescInfoAdicFundacoes_chr.'</td>';
                $tabela .= '<td style="padding-right: 10px;">'.$obr_DescInfoAdicEstrutura_chr.'</td>';
                $tabela .= '<td style="padding-right: 10px;">'.$obr_DescInfoAdicAcabamento_chr.'</td>';
                $tabela .= '<td style="padding-right: 10px;">'.$obr_DescInfoAdicFachada_chr.'</td>';
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
                $tabela .= '<td style="padding-right: 10px;">';
                    $tabela .= in_array("1", $key) ? "Salão de festas," : "";   
                    $tabela .= in_array("2", $key) ? "Salão de jogos," : ""; 
                    $tabela .= in_array("3", $key) ? "Piscina," : ""; 
                    $tabela .= in_array("4", $key) ? "Sauna," : "";  
                    $tabela .= in_array("5", $key) ? "Churrasqueira," : ""; 
                    $tabela .= in_array("6", $key) ? "Quadra," : ""; 
                    $tabela .= in_array("7", $key) ? "Fitness," : ""; 
                    $tabela .= in_array("8", $key) ? "Gourmet," : ""; 
                    $tabela .= in_array("9", $key) ? "Playground," : ""; 
                    $tabela .= in_array("10", $key) ? "Spa," : ""; 
                    $tabela .= in_array("11", $key) ? "Brinquedoteca," : "";
                $tabela .= '</td>'; 
                $tabela .= '<td style="padding-right: 10px;">'.$obr_OutrosAreaLazer_chr.'</td>';
                $tabela .= '<td style="padding-right: 10px;">'.$DescProj1.'</td>';
                
                //CONTATOS
                $tabela .= '<td style="padding-right: 10px;">';
                    $readCont = $read;
                    $readCont->FullRead("SELECT 
                                            cob.id,
                                            cob.NomeContato,
                                            car.DescricaoCargo AS cargo
                                            FROM tb_contatoobras_cob AS cob
                                                LEFT JOIN tb_cargos_car AS car
                                            ON car.IdCargo = cob.IdCargo
                                            WHERE cob.IdObra = $Codigo 
                                            ORDER BY cob.NomeContato
                                        ");
                    if ($readCont->getResult()){
                        foreach ($readCont->getResult() as $resCont){
                            extract($resCont);
                            $tabela .= $NomeContato. ' - ' .$cargo. ' - ';
                            $tabela = rtrim($tabela, ' - ');
                        }
                    }
                $tabela .= '</td>';
                
                //Email
                $tabela .= '<td style="padding-right: 10px;">';
                    $readEm = $read;
                    $readEm->FullRead("SELECT 
                                            cob.EMail
                                            FROM tb_contatoobras_cob AS cob  
                                            WHERE cob.IdObra = $Codigo 
                                            ORDER BY cob.EMail
                                        ");
                    if ($readEm->getResult()){
                        foreach ($readEm->getResult() as $resEm){
                            extract($resEm);
                            $tabela .= ''.$EMail. ' ; ';
                            $tabela = ltrim($tabela, ' ; ');
                        
                        }
                    }
                $tabela .= '</td>';
                
                //Telefones
                $tabela .= '<td style="padding-right: 10px;">';
                    $readTe = $read;
                    $readTe->FullRead("SELECT 
                                            cob.DDDFax,
                                            cob.Fax,
                                            cob.DDD,
                                            cob.Telefone,
                                            cob.DDD2,
                                            cob.TELEFONE2,
                                            cob.DDD3,
                                            cob.TELEFONE3,
                                            cob.DDD4,
                                            cob.TELEFONE4
                                            FROM tb_contatoobras_cob AS cob
                                            WHERE cob.IdObra = $Codigo 
                                            ORDER BY cob.NomeContato
                                        ");
                    if ($readTe->getResult()){
                        foreach ($readTe->getResult() as $resTe){
                            extract($resTe);
                            //$tabela .= '(' .$DDD. ')'.$Telefone. ' - (' .$DDD2. ')'.$TELEFONE2. ' - (' .$DDD3. ')'.$TELEFONE3. ' - (' .$DDD4. ')'.$TELEFONE4. ' - ';
                            
                            $telefones = array();

                            // Verifica se o primeiro número de telefone existe e não está repetido
                            if (!empty($DDD) && !empty($Telefone) && !in_array($Telefone, $telefones)) {
                                $tabela .= '(' . $DDD . ')' . $Telefone . ' - ';
                                $telefones[] = ' - '.$Telefone. ' - ';
                            }

                            // Verifica se o segundo número de telefone existe e não está repetido
                            if (!empty($DDD2) && !empty($TELEFONE2) && !in_array($TELEFONE2, $telefones)) {
                                $tabela .= '(' . $DDD2 . ')' . $TELEFONE2 . ' - ';
                                $telefones[] = $TELEFONE2. ' - ';
                            }

                            // Verifica se o terceiro número de telefone existe e não está repetido
                            if (!empty($DDD3) && !empty($TELEFONE3) && !in_array($TELEFONE3, $telefones)) {
                                $tabela .= '(' . $DDD3 . ')' . $TELEFONE3 . ' - ';
                                $telefones[] = $TELEFONE3. ' - ';
                            }

                            // Verifica se o quarto número de telefone existe e não está repetido
                            if (!empty($DDD4) && !empty($TELEFONE4) && !in_array($TELEFONE4, $telefones)) {
                                $tabela .= '(' . $DDD4 . ')' . $TELEFONE4 . ' - ';
                                $telefones[] = $TELEFONE4. ' - ';
                            }

                            // Remove o último hífen e espaço em branco, se existirem
                            //$tabela = rtrim($tabela, ' - ');
                            
                        }
                    }
                $tabela .= '</td>';
                
                //EMPRESAS PARTICIPANTES
                $tabela .= '<td style=" width:4700px;;padding-right: 10px;">';
                    $readEmp = $read;
                    $readEmp->FullRead("SELECT emo.IdEmpresa,
                                                emo.IDMODALIDADE,
                                                obr.Codigo,
                                                obr.CodigoAntigo,
                                                obr.Projeto,
                                                obr.Endereco,
                                                emp.Fantasia,
                                                emp.RazaoSocial,
                                                emp.CNPJ,
                                                md.DescricaoModalidade
                                                FROM tb_empresas_obras_emo AS emo
                                                    INNER JOIN tb_obras_obr AS obr
                                                ON obr.Codigo = emo.IdObra
                                                    INNER JOIN tb_empresas_emp AS emp
                                                ON emp.Codigo = emo.IdEmpresa
                                                    INNER JOIN tb_modalidades_mod AS md
                                                ON md.IdModalidade = emo.IDMODALIDADE
                                                WHERE emo.IdObra = $Codigo");

                        if(!$readEmp->getResult()):
                            WSErro("Empresa(s) não encontrada(s) ou ainda não cadastrada(s)", WS_INFOR);
                            else:
                            foreach($readEmp->getResult() AS $emp):
                                extract($emp);
                        
                            $tabela .= '<b>Empresa:</b> ' .$Fantasia.' - ';
                            $tabela .= '<b>Modalidade:</b> ' .$DescricaoModalidade.' - ';
                            $tabela .= '<b>CNPJ:</b> ' .$CNPJ.' / ';
                             // Remove o último hífen e espaço em branco, se existirem
                            $tabela = rtrim($tabela, ' / ');
                
                    endforeach;
                endif;
                $tabela .= '</td>';

            $tabela .= '</tr>';
            
            endforeach;
        endif;
    $tabela .= '</table>';
        //header do excel
        header ('Cache-Control: no-cache, must-revalidate');
        header ('Pragma: no-cache');
        header ('Content-Type: application/x-msexcel');
        header ("Content-Disposition: attachment; filename=\"{$arquivo}\"");
    echo $tabela;