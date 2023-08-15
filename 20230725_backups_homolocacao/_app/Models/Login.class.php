<?php
class Login {
    private $Captacha;
    private $User;
    private $Senha;
    private $Error;
    private $Result;

    public function ExeLogin(array $UserData) {
        $this->Captacha = $UserData['g-recaptcha-response'];
        $this->User     = (string) strip_tags(trim($UserData['usu_Login_chr']));
        $this->Senha    = (string) strip_tags(trim($UserData['usu_Senha_chr']));
        $this->setLogin();
    }

    public function getResult() {
        return $this->Result;
    }

    public function getError() {
        return $this->Error;
    }

    public function CheckLogin() {
        if (empty($_SESSION['userlogin'])):
            unset($_SESSION['userlogin']);
            return false;
        else:
            return true;
        endif;
    }
    
    //Função: Pega o ID da Sessão atual
    public function getHash(){
        $idSession = session_id();
        return $idSession;
    }
    
    //Testes
    public function getLogin(){
        $userLogin = $_SESSION['userlogin']['usu_Login_chr']; 
        return $userLogin; 
    }
    //Testes
    public function getUserid(){
        $userId = $_SESSION['userlogin']['usu_Usuario_int_PK']; 
        return $userId; 
    }
    
    //Função: Sem permissão por horário (Renato)
    public function permissionHour(){
        $horaAtual   = date("H:i:s");
        $horaInicial = $_SESSION['userlogin']['user_time_inicial']; 
        if(strtotime($horaAtual) < strtotime($horaInicial)) {
            unset($_SESSION['userlogin']);
            header('Location: index.php?exe=noPermission');
        }  
        //Sem permissão apos o horario definido
        $horaFinal = $_SESSION['userlogin']['user_time_final'];
        if (strtotime($horaAtual) > strtotime($horaFinal)){
            unset($_SESSION['userlogin']);
            header('Location: index.php?exe=noPermission');  
        }
    }
    
    //Função: Sem permissão final de semana (Renato)
    public function permissionWeekend(){
        $weekDay = ['Domingo', 'Segunda', 'Terça', 'Quarta', 'Quinta', 'Sexta', 'Sabado'];
        $data = date('Y-m-d');
        $weekValue = date('w', strtotime($data));
        if($_SESSION['userlogin']['user_week_full'] == 0){
            if ($weekDay[$weekValue] == 'Sabado' || $weekDay[$weekValue] == 'Domingo'):
                unset($_SESSION['userlogin']);
                header("Location: index.php?exe=noPermissionWeek&{$weekValue}");
            endif;  
        }
    }
    
    //Função: Mostra o periodo segunda a sexta ou semana toda (Renato)
    public function getFullweek(){
        switch($_SESSION['userlogin']['user_week_full']){
            case 0:
                $acesso = "Segunda a Sexta";
                return $acesso;
                break;
            case 1:
                $acesso = "Semana toda";
                return $acesso; 
                break;
        }    
    }
    
    //Função: que verifica se esta logado através do Login
    public function isLogged(){
        $userLogin = $_SESSION['userlogin']['usu_Login_chr'];    
        $read = new Read;
        $read->FullRead("SELECT user_login_hash FROM tb_usuario_usu WHERE usu_Login_chr = :u", "u={$userLogin}");
        if($read->getResult()){
            return $this->Result = $read->getResult()[0]['user_login_hash'];
        }
        return null;
    }
    
    //Função: Atualiza usuário qdo loga utilizando a função getUser() ou qdo se desloga, mudando o valor atual user_login_hash
    public function atzHashUser($id, $logoff = null){
        $data = [ 
            'user_lastupdate' => date('Y-m-d H:i:s'), 
            'user_login_hash' => ($logoff ? null : $this->getHash()) 
        ];
        $update = new Update;
        $update->ExeUpdate('tb_usuario_usu', $data, "WHERE usu_Usuario_int_PK = :uid", "uid={$id}");
    }

    /*
     * ***************************************
     * **********  PRIVATE METHODS  **********
     * ***************************************
     */

    //Valida os dados e armazena os erros caso existam. Executa o login!
    private function setLogin() {
        //Verificação do captcha
        $url = 'https://www.google.com/recaptcha/api/siteverify?secret=6LdR_b4UAAAAAJcdoljyZ4W2Fw-MfvvW4IVsLC_w&response=' . $this->Captacha;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $validateCaptcha = json_decode(curl_exec($ch));
        curl_close($ch);
        
        if (!$this->Captacha):
            $this->Error = ['Por questão de segurança é preciso validar o Captcha :(', WS_ERROR];
            $this->Result = false;
        elseif (!$this->User || !$this->Senha):
            $this->Error = ['Informe seu usuário e senha para efetuar o login!', WS_INFOR];
            $this->Result = false;
        elseif (!$this->getUser()):
            $this->Error = ['Os dados informados não são compatíveis ou você não tem acesso ao Sistema, procure o Suporte INTECBRASIL', WS_ALERT_LOGIN];
            $this->Result = false;
        else:
            $this->Execute();
        endif;
    }

    //Função: Verifica usuário e senha no banco de dados e atualiza o hash!
    private function getUser() {
        $this->Senha = md5($this->Senha);
        $read = new Read;
 
        $read->ExeRead("tb_usuario_usu", "WHERE usu_Login_chr = :e AND usu_Senha_chr = :p AND USU_INDATIVO_IND = :u", "e={$this->User}&p={$this->Senha}&u=1");
        if(!$read->getResult()){
            return false;     
        }else{
            $this->Result = $read->getResult()[0];
        }
        
        //O usuario somente se loga se for admin(1) e o status ativo(1)
        if($this->Result['user_level'] == '1'){
            header("Location:painel.php"); 
        }if($this->Result['usu_Ativo_ind'] == '1'){
            header("Location:painel.php"); 
        }
        
        //Atualiza a hash através do Id do usuário utilizando a função atzHashUser () com id do usuário
        $this->atzHashUser($this->Result['usu_Usuario_int_PK']);
        //Lê todos os dados do usuario para usar na sessão no painel
        //$read->ExeRead("tb_usuario_usu", "WHERE usu_Usuario_int_PK = :uid", "uid={$uid}");
        //extract($read->getResult()[0]);
           
        if ($read->getResult()):
            $this->Result = $read->getResult()[0];
            return true;
        else:
            return false;
        endif;  
    }
    
    //Executa o login armazenando a sessão!
    private function Execute() {
        if (!session_id()):
            session_start();
        endif;

        $_SESSION['userlogin'] = $this->Result;

        $this->Error = ["Olá {$this->Result['usu_Usuario_chr']}, seja bem vindo(a). Aguarde redirecionamento!", WS_ACCEPT];
        $this->Result = true;
    }
}