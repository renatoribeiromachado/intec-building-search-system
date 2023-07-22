<?php
    ob_start();
    session_id();
    session_start();
    require('../_app/Config.inc.php');
 
    $login   = new Login;
    $logoff  = filter_input(INPUT_GET, 'logoff', FILTER_VALIDATE_BOOLEAN);
    $getexe  = filter_input(INPUT_GET, 'exe', FILTER_DEFAULT);
      
    if (!$login->CheckLogin()){
        unset($_SESSION['userlogin']);
        header('Location: index.php?exe=restricted');
    }else{
        $userlogin = $_SESSION['userlogin'];
        $login->permissionHour();
        $login->permissionWeekend(); 
        
        //Verifica se o user_hash foi alterado (se teve outra conexão)
        //se user_login_hash atual for diferente da que esta na tb ele se 
        //desloga automaticamente destruindo a sessão
        if($login->isLogged() != $login->getHash()){
            unset($_SESSION['userlogin']);
            header('Location: index.php?exe=otherUser');
            exit;
        }
        //Ao deslogar através da variavel $logoff dentro do sistema no painel.php, utiliza a função atzHashUser
        //enviando como parametro o id do usuário gravado na sessão $userlogin e tb true para $logoff
        //matando a sessão do usuario, a função atzHashUser atualiza como null a varivel user_login_hash na tb tb_usuario_usu
        if ($logoff){
            //remove user_hash
            $login->atzHashUser($userlogin['usu_Usuario_int_PK'], true);
            unset($_SESSION['userlogin']);
            header('Location: index.php?exe=logoff');
            exit;
        }
    }
?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1"/>
        <link rel="profile" href="http://gmpg.org/xfn/11" />
        <link rel="shortcut icon" href="https://www.intecbrasil.com.br/favicon/favicon.png" />
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
        <link href="css/bootstrap.css" rel="stylesheet" type="text/css"/>
        <link href="css/ui-lightness/jquery-ui-1.10.1.custom.min.css" rel="stylesheet" type="text/css"/>
        <link href="css/reset.css" rel="stylesheet"/>
        <link href="css/admin.css?<?php echo rand(1, 1000);?>" rel="stylesheet"/>
        <link href="css/editor.css" rel="stylesheet"/><!--EDITOR - WYSIWYG-->
        
        <script src="js/jquery.js"></script>
        <script src="js/jquery-ui-1.10.1.custom.min.js"></script>
        <script src="js/bootstrap.min.js"></script> 
        <script src="js/jquery.mask.min.js"></script> 
        <script src="js/jquery.maskMoney.min.js"></script>
        <script src="js/shortcut.js"></script>
        <script src="js/charts.js"></script><!-- GRAFICO - WYSIWYG --> 
        <script src="js/chart.bundle.js"></script><!-- GRAFICO - WYSIWYG --> 
        <script src="js/editor.js"></script><!-- EDITOR - WYSIWYG --> 
        <script src="__jsc/tiny_mce/tiny_mce.js"></script>
        <script src="__jsc/tiny_mce/plugins/tinybrowser/tb_tinymce.js.php"></script>
        <script src="__jsc/admin.js"></script>
        <script src="__jsc/tiny_mce/plugins/media/js/media.js"></script>
    
        <title>INTECBRASIL - Informações Técnicas da Construção</title>  
        <!--[if lt IE 9]>
            <script src="../_cdn/html5.js"></script> 
         <![endif]-->
        <!--<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,600,800' rel='stylesheet' type='text/css'>-->
    </head>
    <body>
        <style>
            .ui-autocomplete-loading { background:url(http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.2/themes/smoothness/images/ui-anim_basic_16x16.gif) no-repeat right center }
            
            @media(max-width: 800px) {
                .img-mobile {
                    max-width: 100%;
                    max-height: 100%;
                    width: auto;
                    height: auto;
                }
            }
        </style>
        
        <!--HEADER
        <div class="container">
            <div class="row">
            <div class="col-md-12">
                <img src="https://www.intecbrasil.com.br/Intec-interna/admin/images/parallax/header-intec.jpg" class="img-mobile" width="1140" title="INTECBRASIL - A INTELIGÊNCIA EMPRESARIAL DA CONSTRUÇÃO" alt="INTECBRASIL - A INTELIGÊNCIA EMPRESARIAL DA CONSTRUÇÃO" />
                <?php //include "inc/header.php";?>
            </div>
                </div>
        </div>
        -->
        <!--HEADER--> 
        <div class="container-fluid parallax5">           
            <div class="row" style="height: 150px;">
                <div class="col-md-4 top20"> 
                    <a href="painel.php?logoff=true" title="Sair do Sistema">
                        <img src="images/logomarcaNova.png" width="305" height="83" title="INTECBRASIL - A INTELIGÊNCIA EMPRESARIAL DA CONSTRUÇÃO" alt="INTECBRASIL - A INTELIGÊNCIA EMPRESARIAL DA CONSTRUÇÃO" />
                    </a>
                </div>    
            </div>
        </div>
        
        <!--MENU BRAND-->   
        <div class="container-fluid">
            <?php include "inc/menu.php";?>
        </div>

        <div class="container-fluid"> 
            <div class="col-md-7">  
                <?php
                //echo md5("a0e81ff7f3f6caaa56230c459c0f0d02");
                    echo "<p>São Paulo - ",getdate()['weekday'], ', ', getdate()['mday'], ' ', getdate()['month'], ' ', getdate()['year'], " - <b>Acesso:</b> " .$login->getFullweek(). ", das " .$userlogin['user_time_inicial']. " as " . $userlogin['user_time_final']. "</p>";
                ?> 
            </div>
            <div class="col-md-5">
                <p class="text-right"><b>User:</b> <i class="glyphicon glyphicon-user"></i> <a href="painel.php?exe=usuarios/update-password&id=<?= $userlogin['usu_Usuario_int_PK'];?>" title="Alterar senha de Usuário"><?= $userlogin['usu_Usuario_chr']; ?></a> <code>Alterar a senha clique no usuário</code></p>
            </div>
        </div>
        
        <!--DADOS HASH-->
        <div class="col-md-6">
            <?php
                //echo "<p class='text-danger'><b>BDhs</b> = " .$login->isLogged(). "</br>";
                //echo "<b>Hash</b> = " .$login->getHash(). "</p>";
                //echo "Session Id = " .session_id();
            ?>
        </div>
                    
        <!--DASHBORD-->
        <div class="container-fluid">
            <?php
            //QUERY STRING
            if (!empty($getexe)):
                $includepatch = __DIR__ . DIRECTORY_SEPARATOR . 'system' . DIRECTORY_SEPARATOR . strip_tags(trim($getexe) . '.php');
            else:
                $includepatch = __DIR__ . DIRECTORY_SEPARATOR . 'system' . DIRECTORY_SEPARATOR . 'dashboard.php';
            endif;
    
            if (file_exists($includepatch)):
                require_once($includepatch);
            else:
                echo "<div class=\"content notfound\">";
                WSErro("<b>Erro ao incluir tela:</b> Erro ao incluir o controller /{$getexe}.php!", WS_ERROR);
                echo "</div>";
            endif;
            ?>
        </div>
        
        <!--FOOTER-->
        <?php include "inc/footer.html";?>
       
        <script>
            $(function(){
                $("#cep").on("keyup",function(){
                    $.ajax({
                        url: 'https://viacep.com.br/ws/'+ $(this).val() +'/json/',
                        dataType: 'json',
                        success: function(resposta){
                            $("#rua").val(resposta.logradouro);
                            $("#complemento").val(resposta.complemento);
                            $("#bairro").val(resposta.bairro);
                            //$("#cidade").val(resposta.localidade);
                            $("#cidade option").filter(function() {
                                return this.text == resposta.localidade; 
                            }).attr('selected', true);
                            $("#uf option").filter(function() {
                                return this.text == resposta.uf; 
                            }).attr('selected', true);
                            $("#numero").focus();
                        }
                    });
		});
                 
               //CEP INPUT
                $("#cepInput").on("keyup",function(){
                    $.ajax({
                        url: 'https://viacep.com.br/ws/'+ $(this).val() +'/json/',
                        dataType: 'json',
                        success: function(resposta){
                            $("#rua").val(resposta.logradouro);
                            $("#complemento").val(resposta.complemento);
                            $("#bairro").val(resposta.bairro);
                            $("#cidade").val(resposta.localidade);
                            $("#uf option").filter(function() {
                                return this.text == resposta.uf; 
                            }).attr('selected', true);
                            $("#numero").focus();
                        }
                    });
		});
               
                //CEP Cobranca
                $("#cep_cobranca").on("keyup",function(){
                    $.ajax({
                        url: 'https://viacep.com.br/ws/'+ $(this).val() +'/json/',
                        dataType: 'json',
                        success: function(resposta){
                            $("#rua_cobranca").val(resposta.logradouro);
                            $("#complemento_cobranca").val(resposta.complemento);
                            $("#bairro_cobranca").val(resposta.bairro);
                            $("#cidade_cobranca").val(resposta.localidade);
                            $("#uf_cobranca option").filter(function() {
                                return this.text == resposta.uf; 
                            }).attr('selected', true);
                            $("#numero_cobranca").focus();
                        }
                    });
		});
                
                //MASCARAS PRECISA DO maskedinput.js
                $("input.cnpj").mask("99.999.999/9999-99")
                $("input.ie").mask("999.999.999.999")
                $("input.celular").mask("00000-0000")
                $("input.celularCp").mask("(00)00000-0000")
                $("input.telefoneCp").mask("(00)0000-0000")
                $("input.telefone").mask("0000-0000")
                $("input.cpf").mask("999.999.999-99")
                $("input.rg").mask("99.999.999-9")
                $("input.nascimento").mask("99/99/9999")
                $("input.cep").mask("00000-000")
                $("input.hora").mask("99:99:99" ); 
                  
                //Desabilita o auto-complete nos sistema
                $('input').attr('autocomplete','off');
                
                $(".contato-show").hide(); 
                $(".contato").on("click", function(){
                    $(".contato-show").slideToggle("slow");   
                });  
                
                //DATAPICKER - ATUALIZANDO DIA
                var nomesMes = ['Janeiro','Fevereiro','Mar&ccedil;o','Abril','Maio','Junho', 'Julho','Agosto','Setembro','Outubro','Novembro','Dezembro'],
                    nomesMesCurto = ['Jan','Fev','Mar','Abr','Mai','Jun', 'Jul','Ago','Set','Out','Nov','Dez'],
                    nomesDia = ['Domingo','Segunda-feira','Ter&ccedil;a-feira','Quarta-feira','Quinta-feira','Sexta-feira','Sabado'],
                    nomesDiaCurto = ['Dom','Seg','Ter','Qua','Qui','Sex','Sab'];
                
                 //DATAPICKER
                $.datepicker.regional['pt-BR'] = {
                closeText: 'Fechar',
                prevText: '&#x3c;Anterior',
                nextText: 'Pr&oacute;ximo&#x3e;',
                currentText: 'Hoje',
                monthNames: ['Janeiro','Fevereiro','Mar&ccedil;o','Abril','Maio','Junho',
                'Julho','Agosto','Setembro','Outubro','Novembro','Dezembro'],
                monthNamesShort: ['Jan','Fev','Mar','Abr','Mai','Jun',
                'Jul','Ago','Set','Out','Nov','Dez'],
                dayNames: ['Domingo','Segunda-feira','Ter&ccedil;a-feira','Quarta-feira','Quinta-feira','Sexta-feira','Sabado'],
                dayNamesShort: ['Dom','Seg','Ter','Qua','Qui','Sex','Sab'],
                dayNamesMin: ['Dom','Seg','Ter','Qua','Qui','Sex','Sab'],  
                weekHeader: 'Sm',
                dateFormat: 'dd/mm/yy', 
                firstDay: 0,
                isRTL: false,
                showMonthAfterYear: false,
                yearSuffix: ''};
                $.datepicker.setDefaults($.datepicker.regional['pt-BR']);
                $(".datepicker").datepicker({dateFormat: 'dd/mm/yy'});
                
                //CEP
                
                
                //Buscas autocomplete
                $("#busca-associado").autocomplete({
                    minLength: 1,
                    source: "json/associado.php",
                });
                
                $("#busca-associadoFantasia").autocomplete({
                    minLength: 1,
                    source: "json/associado-fantasia.php",
                });
                $("#busca-empresa").autocomplete({
                    minLength: 1,
                    source: "json/empresa.php",
                });
                
                //Com modal
                $("#busca-empresa").autocomplete({
                    minLength: 1,
                    source: "json/empresa.php",
                    appendTo: "#modal-Contato",
                });
                
                //Com modal Create
                $("#busca-empresaCr").autocomplete({
                    minLength: 1,
                    source: "json/empresa-fantasia.php",
                    appendTo: "#modal-Contato",
                });
                
                //Com modal Up
                $("#busca-empresaUp").autocomplete({
                    minLength: 1,
                    source: "json/empresa-fantasia.php",
                    appendTo: "#updateContato",
                });
                
                $("#busca-fantasia").autocomplete({
                    minLength: 1,
                    source: "json/empresa-fantasia.php",
                });
                 //Razao Social
                $("#busca-razao").autocomplete({
                    minLength: 1,
                    source: "json/empresa-razao.php",
                });
                
                $("#busca-usuario").autocomplete({
                    minLength: 1,
                    source: "json/usuario.php",
                });
                
                $("#busca-usuarioChr").autocomplete({
                    minLength: 1,
                    source: "json/usuarioChr.php",
                });
                
                $("#busca-vendedor").autocomplete({
                    minLength: 1,
                    source: "json/vendedor.php",
                });
                
                $("#busca-obra").autocomplete({
                    minLength: 1,
                    source: "json/obra.php",
                });
                
                //Endereço obra
                $("#busca-adress").autocomplete({
                    minLength: 1,
                    source: "json/obra-adress.php",
                });
                
                //Descrição obra
                $("#busca-descricao").autocomplete({
                    minLength: 1,
                    source: "json/obra-descricao.php",
                });
                
                //Bairro obra
                $("#busca-bairro").autocomplete({
                    minLength: 1,
                    source: "json/obra-bairro.php",
                });
                
                //Bairro codigo
                $("#busca-codigo").autocomplete({
                    minLength: 1,
                    source: "json/obra-codigo.php",
                });
            
                //Permite arrastar Modal
                $(".draggable").draggable();
                
                //Validando form
                $("form.search").on("submit", function(){
                    //Window.setTimeout(function(){
                    $(".submit").html("<img src='images/load.gif'/>");
                    //}, 3000); 
                });
                
                //Validando form
                $("form.search").on("submit", function(){
                    //Window.setTimeout(function(){
                    $(".submit2").html("<img src='images/load.gif'/>");
                    //}, 3000); 
                }); 
                
                //Botões create
                $(".createF").on("click", function(){
                    $(".createF").html("<img src='images/load.gif'/>");    
                });
                
                //Botões update
                $(".updateF").on("click", function(){
                    $(".updateF").html("<img src='images/load.gif'/>");    
                });
                
                //Botões back
                $(".back").on("click", function(){
                    $(".back").html("<img src='images/load.gif'/>");    
                });
                      
                //Populando Cidades por estado UF
                $("select[name='Estado']").on("change", function(){
                    var Estado = $(this).val();
                    $("select[name='Cidade']").html("");
                    //alert(Estado); 
                    $.ajax({
                        url: "json/cidade.php",
                        type: "POST",
                        data: {Estado: Estado},
                        dataType: "JSON",
                        success: function(data){
                            $("select[name='Cidade']").append("<option value='0'>-- AGORA, SELECIONE A CIDADE --</option>");
                            $.each(data.cidade,function(i,e){
                                $("select[name='Cidade']").append("<option value='"+ e.cidade +"'>"+ e.cidade +"</option>");
                            });
                        },
                        error: function(data){
                            $("select[name='Cidade']").append('<option value="0">-- Cidade não encontrada --</option>');
                        }
                    }); 
                });
                
                //Populando cidades por Id do Estado usado no cadastro de obras
                $("select[name='IdEstado']").on("change", function(){
                    var IdEstado = $(this).val();
                    $("select[name='Cidade']").html("");
                    //alert(IdEstado); 
                    $.ajax({
                        url: "json/cidadeId.php",
                        type: "POST",
                        data: {IdEstado: IdEstado},
                        dataType: "JSON",
                        success: function(data){
                            $("select[name='Cidade']").append("<option value='0'>-- AGORA, SELECIONE A CIDADE --</option>");
                            $.each(data.cidade,function(i,e){
                                $("select[name='Cidade']").append("<option value='"+ e.cidade +"'>"+ e.cidade +"</option>");
                            });
                        },
                        error: function(data){
                            $("select[name='Cidade']").append('<option value="0">-- Cidade não encontrada --</option>');
                        }
                    }); 
                });
                
                //Populando Cidades[] por estado UF, a pedido do Cliente usado em pesquisa (Obras)
                $("select[name='Estado']").on("change", function(){
                    var Estado = $(this).val();
                    $("select[name='Nome']").html("");
                    //alert(Estado); 
                    $.ajax({
                        url: "json/cidade-array.php",
                        type: "POST",
                        data: {Estado: Estado}, 
                        dataType: "JSON",
                        success: function(data){
                            $("select[name='Nome']").append("<option value='0'>-- AGORA, SELECIONE A CIDADE --</option>");
                            $.each(data.cidade,function(i,e){
                                $("select[name='Nome']").append("<option value='"+ e.idcidade +"'>"+ e.cidade +"</option>");
                            });    
                        },
                        error: function(data){
                            $("select[name='Nome']").append('<option value="0">-- Cidade não encontrada --</option>');
                        }
                    }); 
                });
                
                //Populando Cargo pelo id
                $("select[name='IdCargo']").on("change", function(){
                    var IdCargo = $(this).val();
                    $("input[name='IdCargoDesc']").html("");
                    $.ajax({
                        url: "json/cargo.php",
                        type: "POST",
                        data: {IdCargo: IdCargo},
                        dataType: "JSON",
                        success: function(data){
                            $.each(data.DescricaoCargo,function(i,e){
                                $("input[name='IdCargoDesc']").val(e.DescricaoCargo);
                            });
                        },
                        error: function(data){
                            $("input[name='IdCargoDesc']").val('Não encontrado');
                         }
                    }); 
                });

    //            $("select[name='IdCargo']").on("change", function(){
    //              var Cargo = $(this).text();
    //              $("input[name='IdCargoDesc']").val(Cargo);  
    //            });
   
                //Função só numeros no imput
                function soNums(e){
                    //teclas adicionais permitidas (tab,delete,backspace,setas direita e esquerda)
                    keyCodesPermitidos = new Array(8,9,37,39,46);
                    //numeros e 0 a 9 do teclado alfanumerico
                    for(x=48;x<=57;x++){
                        keyCodesPermitidos.push(x);
                    }
                    //numeros e 0 a 9 do teclado numerico
                    for(x=96;x<=105;x++){
                        keyCodesPermitidos.push(x);
                    }
                    //Pega a tecla digitada
                    keyCode = e.which; 
                    //Verifica se a tecla digitada é permitida
                    if ($.inArray(keyCode,keyCodesPermitidos) != -1){
                        return true;
                    }    
                    return false;
                }
                $('input.num').bind('keydown',soNums); // o "#input" é o input que vc quer aplicar a funcionalidade

                //MASCARAS dinheiro e decimal PRECISA DO maskMoney.min.js
                $("input.dinheiro").maskMoney({showSymbol:true, symbol:"R$", decimal:",", thousands:"."});

                //DECIMAL
                $('input.decimal').maskMoney({
                        symbol:'$',
                        symbolStay:true,
                        precision: 3,
                        allowZero:true,
                        keepZeroOnFocus: true,
                        autoLoad: true
                }); 
                
                //Mascara para fixo e Celular
                var SPMaskBehavior = function (val) {
                    return val.replace(/\D/g, '').length === 11 ? '(00) 00000-0000' : '(00) 0000-00009';
                  },
                  spOptions = {
                    onKeyPress: function(val, e, field, options) {
                        field.mask(SPMaskBehavior.apply({}, arguments), options);
                      }
                  };
                  $('#telEntrega').mask(SPMaskBehavior, spOptions);
                  $('#telCobranca').mask(SPMaskBehavior, spOptions); 
                  
                  
                //GRAFICO CHARTS (PARA ALTERAR O GRAFICO COLOCQUE SEMPRE EM PRIMEIRO LUGAR O MODELO SELECIONADO)
                var charLine = $('.chartLine');
                new Chart(charLine, {
                    type: 'line',
                    data: {
                        labels: charLine.data('chart-dates').split('|'),
                        datasets: [{
                            label: 'Pedido(s) Mês',
                            backgroundColor: charLine.data('chart-background-color'),
                            borderColor: charLine.data('chart-border-color'),
                            data: charLine.data('chart-values').split('|'),
                        }]
                    },
                    options: {
                        responsive: true,
                        title: {
                            display: true,
                            text: 'Pedido(s) IntecBrasil'
                        },
                        tooltips: {
                            mode: 'index',
                            intersect: false,
                        },
                        hover: {
                            mode: 'nearest',
                            intersect: true
                        },
                        scales: {
                            xAxes: [{
                                display: true,
                                scaleLabel: {
                                    display: true,
                                    labelString: 'Datas'
                                }
                            }],
                            yAxes: [{
                                display: true,
                                scaleLabel: {
                                    display: true,
                                    labelString: 'Valor'
                                },
                                ticks: {
                                    beginAtZero: true
                                }
                            }]
                        }
                    }
                });

//                var chartBar = $('.chartBar');
//                new Chart(chartBar, {
//                    type: 'bar',
//                    data: {
//                        labels: chartBar.data('chart-labels').split('|'),
//                        datasets: [{
//                            label: 'Dataset 1',
//                            backgroundColor: chartBar.data('chart-background-color').split('|'),
//                            borderColor: chartBar.data('chart-border-color').split('|'),
//                            borderWidth: 1,
//                            data: chartBar.data('chart-values').split('|')
//                        }]
//
//                    },
//                    options: {
//                        responsive: true,
//                        legend: {
//                            position: 'top',
//                        },
//                        title: {
//                            display: true,
//                            text: 'Chart.js Bar Chart'
//                        },
//                        scales: {
//                            yAxes: [{
//                                ticks: {
//                                    beginAtZero: true
//                                }
//                            }]
//                        }
//                    }
//                });
//
//                var chartPie = $('.chartPie');
//                new Chart(chartPie, {
//                    type: 'pie',
//                    data: {
//                        datasets: [{
//                            data: chartPie.data('chart-values').split('|'),
//                            backgroundColor: chartPie.data('chart-background-color').split('|'),
//                            label: 'Dataset 1'
//                        }],
//                        labels: chartPie.data('chart-labels').split('|')
//                    },
//                    options: {
//                        responsive: true
//                    }
//                });
//
//                var chartDoughnut = $('.chartDoughnut');
//                new Chart(chartDoughnut, {
//                    type: 'doughnut',
//                    data: {
//                        datasets: [{
//                            data: chartDoughnut.data('chart-values').split('|'),
//                            backgroundColor: chartDoughnut.data('chart-background-color').split('|'),
//                            label: 'Dataset 1'
//                        }],
//                        labels: chartDoughnut.data('chart-labels').split('|')
//                    },
//                    options: {
//                        responsive: true,
//                        legend: {
//                            position: 'top',
//                        },
//                        title: {
//                            display: true,
//                            text: 'Chart.js Doughnut Chart'
//                        },
//                        animation: {
//                            animateScale: true,
//                            animateRotate: true
//                        }
//                    }
//                });
            });//Seletor Jquery
            
            let telefoneEmp = document.querySelector(".maskPhoneEmp");
            telefoneEmp.addEventListener('blur', function(){
                if(telefoneEmp.value.length === 8){
                  const parteEmp1 = telefoneEmp.value.slice(0,4);
                  const parteEmp2 = telefoneEmp.value.slice(4,8);
                  telefoneEmp.value = `${parte1}-${parte2}`  
                }if(telefoneEmp.value.length === 11){
                  const parteEmp3 = telefoneEmp.value.slice(0,4);
                  const parteEmp4 = telefoneEmp.value.slice(4,7);
                  const parteEmp5 = telefoneEmp.value.slice(7,11);
                  telefoneEmp.value = `${parteEmp3}-${parteEmp4}-${parteEmp5}`; 
                }
             })
             
            let telefone = document.querySelector(".maskPhone");
            telefone.addEventListener('blur', function(){
                if(telefone.value.length === 8){
                  const parte1 = telefone.value.slice(0,4);
                  const parte2 = telefone.value.slice(4,8);
                  telefone.value = `${parte1}-${parte2}`  
                }if(telefone.value.length === 11){
                  const parte3 = telefone.value.slice(0,4);
                  const parte4 = telefone.value.slice(4,7);
                  const parte5 = telefone.value.slice(7,11);
                  telefone.value = `${parte3}-${parte4}-${parte5}`; 
                }
             })
             
             let telefoneUp = document.querySelector(".maskPhoneUp");
                telefoneUp.addEventListener('blur', function(){
                if(telefoneUp.value.length === 8){
                  const parteUp1 = telefoneUp.value.slice(0,4);
                  const parteUp2 = telefoneUp.value.slice(4,8);
                  telefoneUp.value = `${parteUp1}-${parteUp2}`  
                }if(telefoneUp.value.length === 11){
                  const parteUp3 = telefoneUp.value.slice(0,4);
                  const parteUp4 = telefoneUp.value.slice(4,7);
                  const parteUp5 = telefoneUp.value.slice(7,11);
                  telefoneUp.value = `${parteUp3}-${parteUp4}-${parteUp5}`; 
                }
             })
        </script>
        
        <script id="cookieinfo" src="js/cookieinfo.js" data-bg="#ff3b00" data-fg="#fff" data-link="#fff;" data-message="Utilizamos cookies para melhorar a sua experiência. Ao continuar a visitar esta plataforma, você concorda com o uso de cookies." data-linkmsg="Mais informações" data-close-text="Permitir Cookies!" onclick="this.target='_blank';"></script>
       
        
        <script src="https://www.intecbrasil.com.br/site/lib/isotope/isotope.pkgd.min.js"></script>
    </body>
</html>
<?php
ob_end_flush();