<?php
class Create extends Conn {
    private $Tabela;
    private $Dados;
    private $Result;

    /** @var PDOStatement */
    private $Create;

    /** @var PDO */
    private $Conn;

    /**
     * <b>ExeCreate:</b> Executa um cadastro simplificado no banco de dados utilizando prepared statements.
     * Basta informar o nome da tabela e um array atribuitivo com nome da coluna e valor!
     * 
     * @param STRING $Tabela = Informe o nome da tabela no banco!
     * @param ARRAY $Dados = Informe um array atribuitivo. ( Nome Da Coluna => Valor ).
     */
    public function ExeCreate($Tabela, array $Dados) {
        $this->Tabela = (string) $Tabela;
        $this->Dados = $Dados;
        $this->getSyntax();
        $this->Execute();
    }
    
    public function ExeCreateCrm($Tabela, array $Dados) {
        $this->TabelaCrm = (string) $Tabela;
        $this->DadosCrm = $Dados;
        $this->getSyntaxCrm();
        $this->ExecuteCrm();
    }

    /**
     * <b>Obter resultado:</b> Retorna o ID do registro inserido ou FALSE caso nem um registro seja inserido! 
     * @return INT $Variavel = lastInsertId OR FALSE
     */
    public function getResult() {
        return $this->Result;
    }

    /**
     * ****************************************
     * *********** PRIVATE METHODS ************
     * ****************************************
     */
    //Obtém o PDO e Prepara a query
    private function Connect() {
        $this->Conn = parent::getConn();
        $this->Create = $this->Conn->prepare($this->Create);
    }
    
     //Obtém o PDO e Prepara a query
    private function ConnectCrm() {
        $this->ConnCrm = parent::getConnCrm();
        $this->CreateCrm = $this->ConnCrm->prepare($this->CreateCrm);
    }

    //Cria a sintaxe da query para Prepared Statements
    private function getSyntax() {
        $Fileds = implode(', ', array_keys($this->Dados));
        $Places = ':' . implode(', :', array_keys($this->Dados));
        $this->Create = "INSERT INTO {$this->Tabela} ({$Fileds}) VALUES ({$Places})";
    }
    
    //Cria a sintaxe da query para Prepared Statements
    private function getSyntaxCrm() {
        $Fileds = implode(', ', array_keys($this->DadosCrm));
        $Places = ':' . implode(', :', array_keys($this->DadosCrm));
        $this->CreateCrm = "INSERT INTO {$this->TabelaCrm} ({$Fileds}) VALUES ({$Places})";
    }

    //Obtém a Conexão e a Syntax, executa a query!
    private function Execute() {
        $this->Connect();
        try {
            $this->Create->execute($this->Dados);
            $this->Result = $this->Conn->lastInsertId();
        } catch (PDOException $e) {
            $this->Result = null;
            WSErro("<b>Erro ao cadastrar1:</b> {$e->getMessage()}", $e->getCode());
        }
    }
    
    //Obtém a Conexão e a Syntax, executa a query!
    private function ExecuteCrm() {
        $this->ConnectCrm();
        try {
            $this->CreateCrm->execute($this->DadosCrm);
            $this->ResultCrm = $this->ConnCrm->lastInsertId();
        } catch (PDOException $e) {
            $this->ResultCrm = null;
            //WSErro("Para atualização do status do funil utilize o CRM", $e->getCode());
        }
    }
}