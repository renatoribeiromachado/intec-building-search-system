<?php
    class AdminUsuarioClientes {
        private $Data;
        private $Contato;
        private $Codigo;
        private $Error;
        private $Result;
    
    //Nome da tabela no banco de dados
    const EntityUsuario = 'tb_usuario_usu';
    const EntityPermissaoRegiao = 'tb_permissaousuario_regiao';
    const EntityPermissaoEstado = 'tb_permissaousuarioestados_pue';
    const EntityFollowUp = 'tb_followup_fup';

    public function ExeCreate(array $Data) {
        $this->Data = $Data;
        //fazendo a leitura e evitando o cadastro com o mesmo CNPJ
        $read = new Read;
        $read->ExeRead(self::EntityUsuario, "WHERE usu_Login_chr = :usu_Login_chr", "usu_Login_chr={$this->Data['usu_Login_chr']}");
        if ($read->getResult()):
            $this->Error = ["O Login <b>{$this->Data['usu_Login_chr']}</b>, com o nome <b>{$this->Data['usu_Login_chr']}</b>, que você tentou cadastrar já existe no sistema!", WS_ERROR];
            else:
            header("Location:painel.php?exe=associados/update&Codigo={$this->Data['emp_IdEmpresa_int_FK']}");
            $this->Create();
        endif;
    }

    public function ExeUpdate($ContatoId, array $Data) {
        $this->Contato = (int) $ContatoId;
        $this->Data = $Data;
        $this->Update();
    }

    public function ExeDelete($ContatoId, $CodigoId) {
        $this->Contato = (int) $ContatoId;
        $this->Codigo  = (int) $CodigoId;
        $deleta = new Delete;
        $deleta->ExeDelete(self::EntityUsuario, "WHERE usu_Usuario_int_PK = :usu_Usuario_int_PK", "usu_Usuario_int_PK={$this->Contato}");
        $deleta->ExeDelete(self::EntityPermissaoRegiao, "WHERE IdUsuario = :IdUsuario", "IdUsuario={$this->Contato}");
        $deleta->ExeDelete(self::EntityPermissaoEstado, "WHERE IdUsuario = :IdUsuario", "IdUsuario={$this->Contato}");
        $deleta->ExeDelete(self::EntityFollowUp, "WHERE IDUSUARIO = :IDUSUARIO", "IDUSUARIO={$this->Contato}");
        header("Location:painel.php?exe=associados/update&Codigo={$this->Codigo}");
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
        $this->Data['usu_Senha_chr'] = md5($this->Data['usu_Senha_chr']);
        $Create->ExeCreate(self::EntityUsuario, $this->Data);
        if ($Create->getResult()):
            header("Location:painel.php?exe=associados/update&Codigo={$this->Data['emp_IdEmpresa_int_FK']}#usuarioAdd");   
            $this->Result = true;
        endif;   
    } 
    //Atualiza no banco!
    private function Update() {
        $Update = new Update;
        $Update->ExeUpdate(self::EntityUsuario, $this->Data, "WHERE usu_Usuario_int_PK = :usu_Usuario_int_PK", "usu_Usuario_int_PK={$this->Data['usu_Usuario_int_PK']}");
        if ($Update->getRowCount() >= 1):
            header("Location:painel.php?exe=associados/update&Codigo={$this->Data['emp_IdEmpresa_int_FK']}");
            $this->Result = true;
        endif;
    }
}