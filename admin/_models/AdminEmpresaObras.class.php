<?php
    class AdminEmpresaObras {
        private $Data;
        private $Empresa;
        private $Modalidade;
        private $IdObra;
        private $Error;
        private $Result;
    
    //Nome da tabela no banco de dados
    const Entity = 'tb_empresas_obras_emo';
    
   public function ExeCreate(array $Data) {
        $this->Data = $Data;
        $this->Create();
    }

    public function ExeUpdate($EmpresaId, array $Data) {
        $this->Empresa = (int) $EmpresaId;
        $this->Data = $Data;
        $this->Update();
    }

    public function ExeDelete($EmpresaId, $ModalidadeId, $IdObraId) {
        $this->Empresa = (int) $EmpresaId;
        $this->Modalidade = (int) $ModalidadeId;
        $this->IdObra  = (int) $IdObraId;
        $deleta = new Delete;
        $deleta->ExeDelete(self::Entity, "WHERE IdEmpresa = :IdEmpresa AND IdObra = :IdObra AND IDMODALIDADE = :IDMODALIDADE", "IdEmpresa={$this->Empresa}&IdObra={$this->IdObra}&IDMODALIDADE={$this->Modalidade}");
        header("Location:painel.php?exe=obras/update-obras&IdObra={$this->IdObra}");
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
     
    //Cadastra no banco!
    private function Create() {
        $Create = new Create;
        $Create->ExeCreate(self::Entity, $this->Data);
        if ($Create->getResult()):
            header("Location:painel.php?exe=obras/update-obras&IdObra={$this->Data['IdObra']}#addEmp");   
            $this->Result = true;
            else:
                echo "Erro";
        endif;   
    } 
    //Atualiza no banco!
    private function Update() {
        $Update = new Update;
        $Update->ExeUpdate(self::Entity, $this->Data, "WHERE IdEmpresa = :IdEmpresa AND IdObra = :IdObra", "IdEmpresa={$this->Empresa}&IdObra={$this->Data['IdObra']}");
        //if ($Update->getRowCount() >= 1):
            header("Location:painel.php?exe=obras/update-obras&IdObra={$this->Data['IdObra']}#addEmp");
            $this->Result = true;
        //endif;
    }
}