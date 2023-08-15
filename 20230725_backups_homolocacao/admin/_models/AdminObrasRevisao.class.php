<?php
    class AdminObrasRevisao {
        private $Data;
        private $Error;
        private $Result;
    
    //Nome da tabela no banco de dados
    const Entity = 'tb_obras_obr_revisao_rev';

    public function ExeCreate(array $Data) {
        //$this->Data = $Data; 
        $this->Data = array(
            'Codigo' => $Data['Codigo'],
            //'DataCadastro' => Check::Data($Data['DataCadastro']),
            'CodigoAntigo' => strtoupper($Data['CodigoAntigo']),
            'Publicacao' => $Data['Publicacao'],
            'Pesquisador' => $Data['Pesquisador'],
            'NrDaRevisao' => $Data['NrDaRevisao'],
            'Projeto' => strtoupper($Data['Projeto']),
            'CEP' => $Data['CEP'],
            'Endereco' => $Data['Endereco'],
            'numero' => $Data['numero'],
            'Complemento' => $Data['Complemento'],
            'Cidade' => $Data['Cidade'],
            'IdEstado' => $Data['IdEstado'],
            //'OBR_REGIAO_IND' => $Data['OBR_REGIAO_IND'],
            'IdTipo' => $Data['IdTipo'],
            'obr_IdSubTipo' => $Data['obr_IdSubTipo'],
            'IdFase' => $Data['IdFase'],
            'IdEstagio' => $Data['IdEstagio'],
            'Inicio' => $Data['Inicio'],
            'Termino' => $Data['Termino'],
            'InicioTermino' => $Data['InicioTermino'],
            'Valor' => $Data['Valor'],
            //'Padrao' => $Data['Padrao'],
            'AreaConstruida' => $Data['AreaConstruida'],
            'obr_ValorDolar_chr' => 0.00,
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
            'obr_DescResidBanheiro_chr' => $Data['obr_DescResidBanheiro_chr'],
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
            'DescProj1' => $Data['DescProj1'],
            'INDSTATUS' => $Data['INDSTATUS'],
            //'usuario' => $Data['usuario']
        ); 
        $this->Create();
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
        $create = new Create;
        $create->ExeCreate(self::Entity, $this->Data);
    }
}

