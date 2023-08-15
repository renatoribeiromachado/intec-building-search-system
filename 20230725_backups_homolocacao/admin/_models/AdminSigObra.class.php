<?php
    class AdminSigObra {
    private $Data;
    private $Post;
    private $Error;
    private $Result;
    
    //Nome da tabela no banco de dados
    const Entity = 'tb_followup_fup';
    const EntityCrm = 'opportunitys';

    public function ExeCreate(array $Data) {
        
        $this->Data = array(
            'IDUSUARIO' =>  $Data['IDUSUARIO'],
            'IDASSOCIADO' => $Data['IDASSOCIADO'],
            'token' => $Data['token'],
            'IDEMPRESA_OBRA' => $Data['Codigo'],
            'INDTIPO' => $Data['INDTIPO'],
            'DATA' => $Data['DATA'],
            'DESCRICAO' => $Data['DESCRICAO'],
            'DataAgenda' => $Data['DataAgenda'],
            'PRIORIDADE' => $Data['PRIORIDADE'],
            'IDSTATUSSIG' => $Data['IDSTATUSSIG'],
        );

        // Gerar um UUID
        $uuid = uniqid();

        // Transformar o nome do projeto em uma URL amigável
        $urlAmigavel = strtolower($Data['Projeto']);
        $urlAmigavelR = preg_replace('/[^a-z0-9]+/', '-', $urlAmigavel);
        $urlAmigavelT = trim($urlAmigavelR, '-');

        $this->DataCrmOpportunity = array(
            'uuid' => $uuid,
            'code' => $Data['Codigo'],
            'user_id' =>  $Data['IDUSUARIO'],
            'tenant_id' => $Data['IDASSOCIADO'],
            'name' => $Data['Projeto'],
            'contact_id' => 0,
            'funnel_id' => $Data['IDSTATUSSIG'],
            'lead_id' => 12,
            'organization_id' => $Data['IDEMPRESA_OBRA'],
            'sale' => "Em andamento",
            'price' => "0.00",
            'url' => $urlAmigavelT,
            'created_at' => $Data['DataAgenda'],
            'updated_at' => date('Y-m-d')
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

    //Cadastra o post no banco!
    private function Create() {
        $cadastra = new Create;
        $cadastra2 = new Create;
        $cadastra->ExeCreate(self::Entity, $this->Data);
        $cadastra2->ExeCreateCrm(self::EntityCrm, $this->DataCrmOpportunity);
        
        if ($cadastra->getResult()):
            $this->Error = ["SIG Cadastrado com Sucesso!!", WS_ACCEPT];
            $this->Result = $cadastra->getResult(); 
        endif;
        
        if ($cadastra2->getResult()):
            $this->Error = ["SIG Cadastrado com Sucesso!!", WS_ACCEPT];
            $this->Result = $cadastra2->getResult(); 
        endif;
    }
    
}