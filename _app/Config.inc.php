<?php
    // CONFIGRAÇÕES DO BANCO ####################
    define('HOST', 'localhost');
    define('USER', 'intecbrasil_intec'); 
    define('PASS', '010211admin123$#@!');
    define('DBSA', 'intecbrasil_intec_bkp');
    
    define('HOSTCrm', 'localhost');
    define('USERCrm', 'intecbrasil_crm'); 
    define('PASSCrm', '010211admin123$#@!crm');
    define('DBSACrm', 'intecbrasil_crm');
    
    // DEFINE SERVIDOR DE E-MAIL ################
    define('MAILUSER', 'suporte@intecbrasil.com.br');
    define('MAILPASS', '.s9gseEQ}rGS'); 
    define('MAILPORT', '587');
    define('MAILHOST', 'mail.intecbrasil.com.br');
     
    
    //CONFIGURAÇÃO DO SITE 
    define('HOME', 'https://www.intecbrasil.com.br/Intec-interna');
    
    // AUTO LOAD DE CLASSES ####################
    function __autoload($Class) {
    
        $cDir = ['Conn', 'Helpers', 'Models'];
        $iDir = null;
    
        foreach ($cDir as $dirName):
            if (!$iDir && file_exists(__DIR__ . DIRECTORY_SEPARATOR . $dirName . DIRECTORY_SEPARATOR . $Class . '.class.php') && !is_dir(__DIR__ . DIRECTORY_SEPARATOR . $dirName . DIRECTORY_SEPARATOR . $Class . '.class.php')):
                include_once (__DIR__ . DIRECTORY_SEPARATOR . $dirName . DIRECTORY_SEPARATOR . $Class . '.class.php');
                $iDir = true;
            endif;
        endforeach;
    
        if (!$iDir):
            trigger_error("Não foi possível incluir {$Class}.class.php", E_USER_ERROR);
            die;
        endif;
    }
    
    // TRATAMENTO DE ERROS #####################
    //CSS constantes :: Mensagens de Erro
    define('WS_ACCEPT', 'accept');
    define('WS_INFOR', 'infor');
    define('WS_ALERT', 'alert');
    define('WS_ALERT_LOGIN', 'alert-login');
    define('WS_ERROR', 'error'); 
    
    //WSErro :: Exibe erros lançados :: Front
    function WSErro($ErrMsg, $ErrNo, $ErrDie = null) {
        $CssClass = ($ErrNo == E_USER_NOTICE ? WS_INFOR : ($ErrNo == E_USER_WARNING ? WS_ALERT : ($ErrNo == E_USER_ERROR ? WS_ERROR : $ErrNo)));
        echo "<p class=\"trigger {$CssClass}\">{$ErrMsg}<span class=\"ajax_close\"></span></p>";
    
        if ($ErrDie):
            die;
        endif;
    }
    
    //PHPErro :: personaliza o gatilho do PHP
    function PHPErro($ErrNo, $ErrMsg, $ErrFile, $ErrLine) {
        $CssClass = ($ErrNo == E_USER_NOTICE ? WS_INFOR : ($ErrNo == E_USER_WARNING ? WS_ALERT : ($ErrNo == E_USER_ERROR ? WS_ERROR : $ErrNo)));
        echo "<p class=\"trigger {$CssClass}\">";
        echo "<b>Erro na Linha: #{$ErrLine} ::</b> {$ErrMsg}</br>";
        echo "<small>{$ErrFile}</small>";
        echo "<span class=\"ajax_close\"></span></p>";
    
        if ($ErrNo == E_USER_ERROR):
            die;
        endif;
    }
    set_error_handler('PHPErro');