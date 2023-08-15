<?php
    class AdminObras {
        private $Data;
        private $Obra;
        private $Error;
        private $Result;
    
    //Nome da tabela no banco de dados
    const EntityObra        = 'tb_obras_obr';
    //const EntityContato     = 'tb_contatoobras_cob';
    //const EntityEmpresaObra = 'tb_empresas_obras_emo';

    public function ExeCreate(array $Data) {
        $this->Data = $Data;
        //Fazendo a leitura e evitando o cadastro duplicado
        $read = new Read;
        //$read->FullRead("SELECT CodigoAntigo FROM tb_obras_obr", "WHERE CodigoAntigo = :CodigoAntigo", "CodigoAntigo={$this->Data['CodigoAntigo']}");
        $read->ExeRead(self::EntityObra, "WHERE CodigoAntigo = :CodigoAntigo", "CodigoAntigo={$this->Data['CodigoAntigo']}");
        if ($read->getResult()):
            $this->Result = $read->getResult();
            $this->Error = ["Desculpa já existe uma Obra cadastrada no Sistema com esse Codigo <b>{$this->Data['CodigoAntigo']}</b>!", WS_ERROR];
            $this->Result = false; 
        else:
              
        //Imagem
        if ($this->Data['obr_Foto_chr']):
            $uplaod = new Upload;
            $uplaod->Image($this->Data['obr_Foto_chr'], $this->Data['obr_Foto_chr']);
        endif;

        if (isset($uplaod) && $uplaod->getResult()):
            $this->Data['obr_Foto_chr'] = $uplaod->getResult();
            //$this->Create();
        else:
            $this->Data['obr_Foto_chr'] = null;
            //$this->Create();
        endif;
            
        $this->DataObra = array(
            'Codigo' => $Data['Codigo'],
            'CodigoAntigo' => strtoupper($Data['CodigoAntigo']),
            'Publicacao' => Check::Data($Data['Publicacao']),
            'Pesquisador' => $Data['Pesquisador'],
            'NrDaRevisao' => $Data['NrDaRevisao'],
            'Projeto' => strtoupper($Data['Projeto']),
            'Valor' => $Data['Valor'],
            'Cub' => $Data['Cub'],
            'Padrao' => $Data['Padrao'],
            'AreaConstruida' => $Data['AreaConstruida'],
            'Endereco' => $Data['Endereco'],
            'numero' => $Data['numero'],
            'Complemento' => $Data['Complemento'],
            'CEP' => $Data['CEP'],
            'Cidade' => $Data['Cidade'],
            'Inicio' => $Data['Inicio'],
            'Termino' => $Data['Termino'],
            'IdEstagio' => $Data['IdEstagio'],
            'IdTipo' => $Data['IdTipo'],
            'DescProj1' => $Data['DescProj1'],
            'IdEstado' => $Data['IdEstado'],
            'IdFase' => $Data['IdFase'],
            'DataCadastro' => Check::Data($Data['DataCadastro']),
            'InicioTermino' => $Data['InicioTermino'],
            'INDSTATUS' => $Data['INDSTATUS'],
            'OBR_REGIAO_IND' => $Data['OBR_REGIAO_IND'],
            'obr_IdSubTipo' => $Data['obr_IdSubTipo'],
            'obr_DescResidEdificio_chr' => $Data['obr_DescResidEdificio_chr'],
            'obr_DescResidResidenciais_chr' => $Data['obr_DescResidResidenciais_chr'],
            'obr_DescResidCondominios_chr' => $Data['obr_DescResidCondominios_chr'],
            'obr_DescResidPavimentos_chr' => $Data['obr_DescResidPavimentos_chr'],
            'obr_DescResidApartamentos_chr' => $Data['obr_DescResidApartamentos_chr'],
            'obr_DescResidDormitorios_chr' => $Data['obr_DescResidDormitorios_chr'],
            'obr_DescResidSuite_chr' => $Data['obr_DescResidSuite_chr'],
            'obr_DescResidBanheiro_chr' => $Data['obr_DescResidBanheiro_chr'],
            //'obr_DescResidBanheiro_chr' => $Data['obr_DescResidBanheiro_chr'],
            'obr_DescResidLavabo_chr' => $Data['obr_DescResidLavabo_chr'],
            'obr_DescResidSala_chr' => $Data['obr_DescResidSala_chr'],
            'obr_DescResidCopa_chr' => $Data['obr_DescResidCopa_chr'],
            'obr_DescResidATV_chr' => $Data['obr_DescResidATV_chr'],
            'obr_DescResidDepEmpreg_chr' => $Data['obr_DescResidDepEmpreg_chr'],
            'obr_AreaLazer_int'=> $Data['obr_AreaLazer_int'],
            'obr_OutrosAreaLazer_chr'=> $Data['obr_OutrosAreaLazer_chr'],
            'obr_DescInfoAdicTotalUnicades_chr' => $Data['obr_DescInfoAdicTotalUnicades_chr'],
            'obr_DescInfoAdicAreaUtil_chr' => $Data['obr_DescInfoAdicAreaUtil_chr'],
            'obr_DescInfoAdicAreaTerreno_chr' => $Data['obr_DescInfoAdicAreaTerreno_chr'],
            'obr_DescInfoAdicElevador_chr' => $Data['obr_DescInfoAdicElevador_chr'],
            'obr_DescInfoAdicVagas_chr' => $Data['obr_DescInfoAdicVagas_chr'],
            'obr_DescInfoAdicCobert_chr' => $Data['obr_DescInfoAdicCobert_chr'],
            'obr_DescInfoAdicArCondic_chr' => $Data['obr_DescInfoAdicArCondic_chr'],
            'obr_DescInfoAdicAquecimento_chr' => $Data['obr_DescInfoAdicAquecimento_chr'],
            'obr_DescInfoAdicFundacoes_chr' => $Data['obr_DescInfoAdicFundacoes_chr'],
            'obr_DescInfoAdicEstrutura_chr' => $Data['obr_DescInfoAdicEstrutura_chr'],
            'obr_DescInfoAdicAcabamento_chr' => $Data['obr_DescInfoAdicAcabamento_chr'],
            'obr_DescInfoAdicFachada_chr' => $Data['obr_DescInfoAdicFachada_chr'],
            'obr_Foto_chr' => $Data['obr_Foto_chr'] = $uplaod->getResult(),
            'obr_IdTipoCotacao_int' => 1,
            'obr_ValorDolar_chr' => 0.00,
            //'CapacidadeDeProducao' => $Data['CapacidadeDeProducao'],
            'usuario' => $Data['usuario']
        ); 
        
            $this->Create();
        endif;
    }
    public function ExeUpdate($Obra, array $Data) {
        $this->Obra = (int) $Obra;
        $this->Data = $Data;
             $this->DataUpdate = array(
            'Codigo' => $Data['Codigo'],
            'Atualizacao' => $Data['Atualizacao'],    
            'DataCadastro' => $Data['DataCadastro'],
            'CodigoAntigo' => strtoupper($Data['CodigoAntigo']),
            'Publicacao' => $Data['Publicacao'],
            'Pesquisador' => $Data['Pesquisador'],
            'NrDaRevisao' => $Data['NrDaRevisao'],
            'Projeto' => strtoupper($Data['Projeto']),
            'Valor' => $Data['Valor'],
            'Cub' => $Data['Cub'],
            'Padrao' => $Data['Padrao'],
            'AreaConstruida' => $Data['AreaConstruida'],
            'Endereco' => $Data['Endereco'],
            'numero' => $Data['numero'],
            'Complemento' => $Data['Complemento'],
            'CEP' => $Data['CEP'],
            'Cidade' => $Data['Cidade'],
            'IdEstado' => $Data['IdEstado'],
            //'OBR_REGIAO_IND' => $Data['OBR_REGIAO_IND'],
            'IdTipo' => $Data['IdTipo'],
            'DescProj1' => $Data['DescProj1'],
            'obr_IdSubTipo' => $Data['obr_IdSubTipo'],
            'IdFase' => $Data['IdFase'],
            'IdEstagio' => $Data['IdEstagio'],
            'Inicio' => $Data['Inicio'], 
            'Termino' => $Data['Termino'],
            'InicioTermino' => $Data['InicioTermino'],
            'INDSTATUS' => $Data['INDSTATUS'],
            //'obr_Foto_chr' => $Data['obr_Foto_chr'] = $uplaod->getResult(),
            //'CapacidadeDeProducao' => $Data['CapacidadeDeProducao'],
            'obr_DescResidEdificio_chr' => $Data['obr_DescResidEdificio_chr'],
            'obr_DescResidResidenciais_chr' => $Data['obr_DescResidResidenciais_chr'],
            'obr_DescResidCondominios_chr' => $Data['obr_DescResidCondominios_chr'],
            'obr_DescResidPavimentos_chr' => $Data['obr_DescResidPavimentos_chr'],
            'obr_DescResidApartamentos_chr' => $Data['obr_DescResidApartamentos_chr'],
            'obr_DescResidDormitorios_chr' => $Data['obr_DescResidDormitorios_chr'],
            'obr_DescResidSuite_chr' => $Data['obr_DescResidSuite_chr'],
            'obr_DescResidBanheiro_chr' => $Data['obr_DescResidBanheiro_chr'],
            //'obr_DescResidBanheiro_chr' => $Data['obr_DescResidBanheiro_chr'],
            'obr_DescResidLavabo_chr' => $Data['obr_DescResidLavabo_chr'],
            'obr_DescResidSala_chr' => $Data['obr_DescResidSala_chr'],
            'obr_DescResidCopa_chr' => $Data['obr_DescResidCopa_chr'],
            'obr_DescResidATV_chr' => $Data['obr_DescResidATV_chr'],
            'obr_DescResidDepEmpreg_chr' => $Data['obr_DescResidDepEmpreg_chr'],
            'obr_AreaLazer_int'=> $Data['obr_AreaLazer_int'],
            'obr_OutrosAreaLazer_chr'=> $Data['obr_OutrosAreaLazer_chr'],
            'obr_DescInfoAdicTotalUnicades_chr' => $Data['obr_DescInfoAdicTotalUnicades_chr'],
            'obr_DescInfoAdicAreaUtil_chr' => $Data['obr_DescInfoAdicAreaUtil_chr'],
            'obr_DescInfoAdicAreaTerreno_chr' => $Data['obr_DescInfoAdicAreaTerreno_chr'],
            'obr_DescInfoAdicElevador_chr' => $Data['obr_DescInfoAdicElevador_chr'],
            'obr_DescInfoAdicVagas_chr' => $Data['obr_DescInfoAdicVagas_chr'],
            'obr_DescInfoAdicCobert_chr' => $Data['obr_DescInfoAdicCobert_chr'],
            'obr_DescInfoAdicArCondic_chr' => $Data['obr_DescInfoAdicArCondic_chr'],
            'obr_DescInfoAdicAquecimento_chr' => $Data['obr_DescInfoAdicAquecimento_chr'],
            'obr_DescInfoAdicFundacoes_chr' => $Data['obr_DescInfoAdicFundacoes_chr'],
            'obr_DescInfoAdicEstrutura_chr' => $Data['obr_DescInfoAdicEstrutura_chr'],
            'obr_DescInfoAdicAcabamento_chr' => $Data['obr_DescInfoAdicAcabamento_chr'],
            'obr_DescInfoAdicFachada_chr' => $Data['obr_DescInfoAdicFachada_chr'],
            'obr_IdTipoCotacao_int' => 1,
            'obr_ValorDolar_chr' => 0.00
            //'usuario' => $Data['usuario']
        ); 
        $this->Update();
    }

    public function ExeDelete($Obra) {
        $this->Obra = (int) $Obra;
        $read = new Read;
        $read->ExeRead(self::EntityObra, "WHERE Codigo = :Codigo", "Codigo={$this->Obra}");
        if (!$read->getResult()):
            $this->Error = ["A Obra que você tentou deletar não existe no sistema!", WS_ERROR];
            $this->Result = false;
        else:
            $delete = $read->getResult()[0];
            $deleta = new Delete;
            $deleta->ExeDelete(self::EntityObra, "WHERE Codigo = :Codigo", "Codigo={$this->Obra}");
            $deleta->ExeDelete(self::EntityContato, "WHERE IdObra = :id", "id={$this->Obra}");
            $deleta->ExeDelete(self::EntityEmpresaObra, "WHERE IdObra = :id", "id={$this->Obra}");
            $this->Error = ["A Obra <b>{$delete['Projeto']}</b> foi removido com sucesso do sistema!", WS_ACCEPT];
            $this->Result = true;
        endif;
    }
    
    public function getResult() {
        return $this->Result;
    }

    public function getError() {
        return $this->Error;
    }

    /*
     * ***************************************
     * **********  PRIVATE METHODS  **********
     * ***************************************
     */
    
    //Cadastra no banco!
    private function Create() {
        $Create = new Create;
        $Create->ExeCreate(self::EntityObra, $this->DataObra);
        $this->Obra = (int)$Create->getResult();
        
//        $i = 0;
//        //Contato
//        foreach ($this->Data['NomeContato'] as $Contato) {
//            
//            $readC = new Read;
//            $readC->FullRead("SELECT Codigo FROM tb_empresas_emp WHERE RazaoSocial = 'Cyrela Brazil Realty S/A Empreendimentos e Participações'");
//            if($readC->getResult()){
//                foreach($readC->getResult() AS $res){
//                    extract($res);
//                }   
//            }
//        
//            $fieldsCont =  array(
//                'IdObra' => $this->DataObra['Codigo'],
//                'NomeContato' => $Contato, 
//                'IdCargo' => $this->Data['IdCargo'][$i],
//                'IDEMPRESA' => '1231'[$i],
//                'DDD' => $this->Data['DDD'][$i],
//                'Telefone' => $this->Data['Telefone'][$i],
//                'DDDFax' => $this->Data['DDDFax'][$i],
//                'Fax' => $this->Data['Fax'][$i],
//                'DDD2' => $this->Data['DDD2'][$i],
//                'TELEFONE2' => $this->Data['TELEFONE2'][$i],
//                'DDD3' => $this->Data['DDD3'][$i],
//                'TELEFONE3' => $this->Data['TELEFONE3'][$i],
//                'DDD4' => $this->Data['DDD4'][$i],
//                'TELEFONE4' => $this->Data['TELEFONE4'][$i],
//                'EMail' => $this->Data['EMail'][$i] 
//            );
//            $Create->ExeCreate(self::EntityContato, $fieldsCont);
//            $i++;
//        }
//        
//        $ie = 0;
//        //Empresas obras
//        foreach ($this->Data['IdEmpresa'] as $Empresa) {
//            $fieldsEmp =  array(
//                'IdObra' => $this->DataObra['Codigo'],
//                'IdEmpresa' => $Empresa, 
//                'IDMODALIDADE' => $this->Data['IDMODALIDADE'][$ie]
//            );
//            $Create->ExeCreate(self::EntityEmpresaObra, $fieldsEmp);
//            $ie++;
//        }
//        
        if ($Create->getResult()):
            header("Location:painel.php?exe=obras/update-obras&IdObra={$this->Data['Codigo']}");  
        endif; 
    }
    //Atualiza no banco!
    private function Update() {
        $Update = new Update;
        $Update->ExeUpdate(self::EntityObra, $this->DataUpdate, "WHERE Codigo = :Codigo", "Codigo={$this->Obra}");
        if ($Update->getRowCount() >= 1):
            header("Location:painel.php?exe=obras/update-obras&IdObra={$this->Obra}#updateObra");
            $this->Result = true;
        endif;
    }
}