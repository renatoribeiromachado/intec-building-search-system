<?php
    class AdminFollowupObra{
    private $Data;
    private $Id;
    private $Error;
    private $Result;
    
    //Nome da tabela no banco de dados
    const Entity = 'tb_followup_fup';

    public function ExeCreate(array $Data) {
        $this->Data = $Data;
        $this->DataAssoc = array(
            'IDASSOCIADO' => $Data['IDASSOCIADO'],
            'INDTIPO' => $Data['INDTIPO'],
            'token' => $Data['token'],
            'IDUSUARIO' => $Data['IDUSUARIO'],
            'IDEMPRESA_OBRA' => $Data['Codigo'],
            'DATA' => $Data['DATA'],
            'DataAgenda' => $Data['DataAgenda'],
            'PRIORIDADE' => $Data['PRIORIDADE'],
            'IDSTATUSSIG' => $Data['IDSTATUSSIG'],
            'DESCRICAO' => $Data['DESCRICAO']
        );
        $this->Create();   
    }
     public function ExeDelete($Id) {
        $this->Id = (int) $Id;
        $deleta = new Delete;
        $deleta->ExeDelete(self::Entity, "WHERE IDFOLLOWUP = :id", "id={$this->Id}");
       // $this->Error = ["O Cliente <b>{$delete['Fantasia']}</b> foi removido com sucesso do sistema!", WS_ACCEPT];
        $this->Result = true;
      
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
        $cadastra->ExeCreate(self::Entity, $this->DataAssoc);
        if ($cadastra->getResult()):
            header("Location:painel.php?exe=sig/followuplistObr&Codigo={$this->Data['Codigo']}");
            $this->Result = $cadastra->getResult();
        endif;
    }
}