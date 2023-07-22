<?php
    ob_start();
    session_start();
    require('../_app/Config.inc.php');
?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="mit" content="0033867"/>
        <meta name="viewport" content="width=device-width, initial-scale=1"/>
        <link rel="profile" href="http://gmpg.org/xfn/11" />
        <link rel="shortcut icon" href="https://www.acessohost.com.br/favicon/favicon.png" />
        <link rel="stylesheet" href="css/reset.css?<?php echo rand(1, 1000);?>"/>
        <link rel="stylesheet" href="css/admin.css?<?php echo rand(1, 1000);?>"/>
        <link rel="stylesheet" href="css/bootstrap.css?<?php echo rand(1, 1000);?>"/>
        <title>INTECBRASIL - Informações Técnicas da Construção</title>
    </head>
     
    <body class="parallax1">
        <div class="container"> 
            <div class="col-md-4 top20 blo">
            </div> 
            <div class="col-md-4 top20 blo" style="padding-top:50px;">
                <img src="images/logomarca-fundo-banco.png" width="305" height="83" title="INTEC BRASIL - Informações Técnicas da Construção" alt="INTEC - Informações Técnicas da Construção" />
            </div>  
            <div class="col-md-4 top20 blo">
            </div> 
            
            <div style="margin-top:50px;" class="col-md-6 col-md-offset-3 col-sm-6 col-sm-offset-2">                    
                <?php
                   $login = new Login; 
                    $dataLogin = filter_input_array(INPUT_POST, FILTER_DEFAULT);
                    
                    if (!empty($dataLogin['AdminLogin'])):
    
                        $login->ExeLogin($dataLogin);
                        
                        if (!$login->getResult()):
                            WSErro($login->getError()[0], $login->getError()[1]);
                        endif;
                    endif;
                    
                    //Array dias da semana
                    $weekDay = ['Domingo', 'Segunda', 'Terça', 'Quarta', 'Quinta', 'Sexta', 'Sabado'];
                    $data = date('Y-m-d');
                    $weekValue = date('w', strtotime($data));
                    $weekDay[$weekValue];
                 
                    $get = filter_input(INPUT_GET, 'exe', FILTER_DEFAULT);
                    if (!empty($get)):
                        //RESTRITO
                        if ($get == 'restricted'):
                            WSErro('Acesso negado: Favor efetue login para acessar o painel!', WS_ALERT_LOGIN);
                        //LOGOFF
                        elseif ($get == 'logoff'):
                            WSErro('<b>Sucesso ao deslogar:</b> Sessão finalizada, volte sempre!', WS_ACCEPT);
                        //PERMISSÃO: horário
                        elseif ($get == 'noPermission'):
                            WSErro('<b>Sem permissão:</b> Você não pode acessar o Sistema nesse horário!', WS_ERROR);
                        //PERMISSÃO: dia da semana
                        elseif ($get == 'noPermissionWeek'):
                            WSErro("<b>Sem permissão:</b> Você não pode acessar o Sistema no <b>$weekDay[$weekValue]</b>", WS_ERROR);
                        //PERMISSAO: apenas um usuário
                        elseif ($get == 'otherUser'):
                           WSErro('<b>Outro usuário se Logou no Sistema com o seus dados de acesso!', WS_ERROR);
                        endif;
                    endif;
                ?>
                <div class="panel panel-itc">
                    <div class="">
                        <div class="panel-title text-center" style="padding-top:20px; font-size: 20px; color:#001043;"><strong>Login no Sistema</strong></div>
                    </div>
                    <?php
                        $dataUser = filter_input_array(INPUT_POST, FILTER_DEFAULT);
                        if(!empty($dataUser) && isset($dataUser['AdminLogin'])){
                            unset($dataUser['AdminLogin']);
                            require("_models/AdminUsuariolog.class.php");
                            $create = new AdminUsuariolog;
                            $create->ExeCreate($dataUser);  
                        }
                    ?>
                    <div style="padding-top:30px" class="panel-body" >
                        <form name="AdminLoginForm" action="" class="login" method="post">   
                            <!-- USER -->
                            <label style="color:#001043;">LOGIN DE USUÁRIO</label>
                            <div class="input-group bottom20">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                <input type="text" name="usu_Login_chr" class="form-control input-lg" id="login-username" value="" placeholder="Digite o login de usuário" required=""/>                                        
                            </div>
                            <!-- PASSWORD -->
                            <label style="color:#001043;">SENHA</label>
                            <div class="input-group bottom20">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                                <input type="password" name="usu_Senha_chr" class="form-control input-lg" id="login-password" value="" placeholder="Informe a Senha" required=""/>
                            </div>
                            <!-- RECAPTCHA -->
                            <div class="row form-group top10">
                                <div class="col-md-12 form-group">
                                    <div class="g-recaptcha" data-sitekey="6LdR_b4UAAAAAOw2axrZIoUhqqWEc2x9sFnEbwPV"></div>
                                 </div>
                            </div>
                            <!-- Button -->   
                            <div class="row form-group top10">
                                <div class="col-md-12 form-group">
                                   <input type="submit" name="AdminLogin" value="Faça Login no Sistema" class="btn btn-orange btn-lg btn-block submit"/>
                                </div>
                            </div>
                        </form>
                        <div class="row form-group top10">
                            <div class="col-md-12">
                                <p class="text-muted text-center">versão atualizada 1.0.2 - 2022</p>
                            </div>
                        </div>
                    </div>                     
                </div>  
            </div>
        </div>
        <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    </body>
    <script src="js/jquery.js"></script>
    <script>
        $(function(){
            $("form.login").on("submit", function(){
                // Window.setTimeout(function(){
                $(".submit").val("Analisando dados aguarde...");
                //}, 3000);
            });
        });
    </script>
</html>
<?php
ob_end_flush();