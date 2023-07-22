<?php
    if (!class_exists('Login')) :
        header('Location: ../../painel.php');
        die;
    endif;
?>
<div class="bg-info bottom20">
    <div class="col-md-12 bottom20 bg_blue">
        <p class="text-center"><i class="glyphicon glyphicon-check"></i> PESQUISA DE EMPRESA(s)</p>
    </div> 

    <form class="search create" name="empresaform" action="imp.php?exe=pesquisas/view-pesquisa-empresas" target="_blank" method="post">
        <!--LISTA-->
        <div class="table table-responsive">
            <table class="table table-bordered table-condensed">
                <?php
                    //VALIDAÇÃO
                    if(isset($_POST)){
                        unset($_POST['SendPostPesquisa']);
                        $allEmpty = true;
                        foreach ($_POST as $field) {
                            if(!empty($field)){
                                $allEmpty = false; 
                                break;
                            }
                        }
                        if($allEmpty && !isset($_GET['condition'])){
                            header("Location:painel.php?exe=pesquisas/empresas");
                        } 
                    }
                    
                    //LEITURA
                    $read = new Read;
                    $dataBd = date("Y-m-d");
                    
                    //PERIODO
                    $inicial     = filter_input(INPUT_POST, 'inicial', FILTER_DEFAULT);
                    $final       = filter_input(INPUT_POST, 'final', FILTER_DEFAULT);
                 
                    //FILTRO ESPECIFICO
                    $Fantasia    = filter_input(INPUT_POST, 'Fantasia', FILTER_DEFAULT);
                    $RazaoSocial = filter_input(INPUT_POST, 'RazaoSocial', FILTER_DEFAULT);
                    $Endereco    = filter_input(INPUT_POST, 'Endereco', FILTER_DEFAULT);
                    $Complemento = filter_input(INPUT_POST, 'Complemento', FILTER_DEFAULT);
                    $Cidade      = filter_input(INPUT_POST, 'Cidade', FILTER_DEFAULT);
                    $Estado      = filter_input(INPUT_POST, 'Estado', FILTER_DEFAULT);
                    $cepInicial  = filter_input(INPUT_POST, 'cepInicial', FILTER_DEFAULT);
                    $cepFinal    = filter_input(INPUT_POST, 'cepFinal', FILTER_DEFAULT);
                    $CNPJ        = filter_input(INPUT_POST, 'CNPJ', FILTER_DEFAULT);
                    $WebSite     = filter_input(INPUT_POST, 'WebSite', FILTER_DEFAULT);
                    $EMAIL       = filter_input(INPUT_POST, 'EMAIL', FILTER_DEFAULT);
                    $ordenar     = filter_input(INPUT_POST, 'ordenar', FILTER_DEFAULT);
                    
                    //Revisão
                    $NrDaRevisao = filter_input(INPUT_POST, 'NrDaRevisao', FILTER_DEFAULT);
                    $qr          = filter_input(INPUT_POST, 'qr', FILTER_DEFAULT);
                 
                    $IDPESQUISADOR = filter_input(INPUT_POST, 'IDPESQUISADOR', FILTER_VALIDATE_INT);
                    $IdStatusSIG = filter_input(INPUT_POST, 'IdStatusSIG', FILTER_VALIDATE_INT);
                    
                    if($IdStatusSIG){
                        header("Location:painel.php?exe=pesquisas/followupViewEmpresa&id={$IdStatusSIG}");  
                    }
                    
                    $condition = array();
                    if(!isset($_GET['condition'])){
                        
                    //Revisão
                    if(!empty($NrDaRevisao)) {	
                        $condition[] = "emp.NrDaRevisao ".$qr."= '" .$NrDaRevisao. "'";               
                    }
                    
                    //PERIODO           
                    if(!empty($inicial) && !empty($final)) {
                        $condition[] = "emp.Atualizacao  BETWEEN '".Check::JustData($inicial). "' AND '" .Check::JustData($final)."'";              
                    }
                    //Só Data Inicial
                    if(!empty($inicial) && empty($final)){
                        $condition[] = "emp.Atualizacao = '".Check::JustData($inicial)."'";
                    }
                    //Só Data Final
                    if(empty($inicial) && !empty($final)){
                        $condition[] = "emp.Atualizacao = '".Check::JustData($final)."'";
                    }
                    //ESTADO / ATIVIDADE
                    if(!empty($_POST['estado']) && is_array($_POST['estado'])) {
                        $condition[] = "emp.Estado IN ('" . implode("','", $_POST['estado']) . "')";               
                    }
                    if(!empty($_POST['atividade']) && is_array($_POST['atividade'])) {
                        $condition[] = "emp.IdAtividade IN ('" . implode("','", $_POST['atividade']) . "')";                
                    }
                    
                    //FILTRO ESPECIFICO
                    if(!empty($Fantasia)) {
                        $condition[] = "emp.Fantasia like '%" . $Fantasia . "%'";             
                    }
                    if(!empty($RazaoSocial)) {
                        $condition[] = "emp.RazaoSocial = '" . $RazaoSocial . "'";              
                    }
                    if(!empty($Endereco)) {
                        $condition[] = "emp.Endereco = '" . $Endereco . "'";              
                    }
                    if(!empty($Complemento)) {
                        $condition[] = "emp.Complemento = '" . $Complemento . "'";              
                    }
                    //ESTADO
                    if(!empty($Estado)) {
                        //select estado pelo id
                        $selectEstado = $read;
                        $selectEstado->ExeRead("tb_estados_est", "WHERE UF = '" . $Estado . "'");
                        $selectEstado = $selectEstado->getResult();
                        $IdEstado = $selectEstado[0]['IdEstado'];
                        $condition[] = "emp.Estado = '" . $IdEstado . "'";
                    }
                    
                    //Seleciona até 4 cidades
                    if(!empty($_POST['CidadeSelected']) && is_array($_POST['CidadeSelected'])) {
                        $condition[] = "emp.Cidade IN ('" . implode("','", $_POST['CidadeSelected']) . "')";    
                    }
                    
                    if(!empty($Cidade)) {
                            $tmp = [];
                            $ids = explode(", ", $Cidade);
                            foreach($ids as $key){
                              $tmp[] = "'{$key}'"; 
                            }
                          
                            //$condition[] = "obr.Cidade = '".$Cidade."'";              
                            $condition[] = "obr.Cidade IN (". implode(", ", $tmp) .")";
                        }
                    
                    //entre CEP
                    if(!empty($cepInicial) && !empty($cepFinal)) {
                        $condition[] = "emp.CEP  BETWEEN '".$cepInicial. "' AND '" .$cepFinal."'";              
                    }
                    //Só CEP inicial
                    if(!empty($cepInicial) && empty($cepFinal)){
                        $condition[] = "emp.CEP = '".$cepInicial."'";
                    }
                    //Só CEP final
                    if(empty($cepInicial) && !empty($cepFinal)){
                        $condition[] = "emp.CEP = '".$cepFinal."'";
                    }
                    if(!empty($CNPJ)) {
                        $condition[] = "emp.CNPJ = '" . $CNPJ . "'";            
                    }
                    if(!empty($WebSite)) {
                        $condition[] = "emp.WebSite = '" . $WebSite . "'";               
                    }
                    if(!empty($EMAIL)) {	
                        $condition[] = "emp.EMAIL = '" . $EMAIL . "'";               
                    }
                    if(!empty($ordenar)) {	
                        $ordenar = "emp.$ordenar";               
                    }else{
                        $ordenar = "emp.Atualizacao";  
                    }
                    
                    //pesquisador
                    if(!empty($IDPESQUISADOR)){
                        $condition[] = "emp.IdPesquisador = '".$IDPESQUISADOR."'";
                    }
                    //Followup
                    if(!empty($IdStatusSIG)){
                        $condition[] = "fup.INDTIPO = '".$IdStatusSIG."'";
                    }
                
                    //CONDITION
                    $condition = implode(' AND ', $condition);
                    } else {
                        $condition = $_GET['condition'];
                        $ordenar = "emp.$ordenar"; 
                        $ordenar = "emp.Atualizacao"; 
                    }
                    if($condition==""){
                     header("Location:painel.php?exe=pesquisas/empresas");   
                    }
                ?>
                <tr>
                    <td colspan="7"></td>
                    <td class="text-center"><a href="imp.php?exe=pesquisas/exportar-excel-empresa&condition=<?= $condition;?>" title="Exportar Pesquisa de Empresas(s) para Excel"><img src="images/excel.png" border="0" /></a></td>
                    </tr>
                <tr>
                    <td colspan="8"><p class="text-danger"><b> <i class="glyphicon glyphicon-search"></i> PESQUISA DE EMPRESA(s)</b></p></td>
                </tr>
                <tr>
                    <th><input type="checkbox" name="" class="viewGeral" value="" /></th>
                    <th><b>RAZÃO SOCIAL</b></th>
                    <th><b>FANTASIA</b></th>
                    <th><b>ENDEREÇO</b></th>
                    <th><b>UF</b></th>
                    <th><b>ATUALIZAÇÃO</b></th>
                    <th class="text-center" style="width:11%;"><b>Status SIG</b></th>
                    <th><b>SIG</b></th>
                </tr>
                
                <?php
                    //QUERY SQL
                    $querySql ="SELECT emp.Codigo, 
                                    emp.RazaoSocial, 
                                    emp.Fantasia, 
                                    emp.Endereco, 
                                    emp.Estado,
                                    emp.Atualizacao,
                                    est.UF,
                                    sts.DescricaoStatusSIG
                                    FROM tb_empresas_emp AS emp
                                        INNER JOIN tb_estados_est AS est 
                                    ON est.IdEstado = emp.Estado
                                        LEFT JOIN tb_followup_fup AS fup 
                                    ON fup.IDEMPRESA_OBRA = emp.Codigo
                                    AND fup.IDASSOCIADO = " .$userlogin['emp_IdEmpresa_int_FK']. "
                                        LEFT JOIN tb_statussig_sts AS sts
                                    ON sts.IdStatusSIG = fup.IDSTATUSSIG 
                                    WHERE {$condition}
                                    AND emp.INDSTATUS = 1
                                    AND emp.Cidade != ''
                                    GROUP BY emp.Codigo";                 
                                    
                    //PAGINACAO
                    $pagi = 0;
                    $getPage = filter_input(INPUT_GET, 'page', FILTER_VALIDATE_INT);
                    $Pager = new Pager('painel.php?exe=pesquisas/pesquisa-empresa&condition='.$condition.'&ordenar='.$ordenar.'&page=');
                    $Pager->ExePager($getPage, 50);
            
                    //PAGINACAO TOPO
                    echo "<div class='col-md-12 text-center'>";
                        $Pager->ExeFullPaginator($querySql);
                        echo $Pager->getPaginator();
                    echo "</div>";
                    
                    //LEITURA 
                    $readEmp = $read;
                    $readEmp->FullRead("{$querySql} ORDER BY $ordenar DESC, 
                                        $ordenar DESC LIMIT :limit OFFSET :offset", "limit={$Pager->getLimit()}&offset={$Pager->getOffset()}
                                        ");
                    if(!$readEmp->getResult()):
                        WSErro("Sua Pesquisa não encontrou informações de Empresa(s), faça nova pesquisa!!", WS_INFOR);
                        else:
                            $count = $readEmp->getRowCount();
                            //echo "<div class='col-md-12'><p><i class='glyphicon glyphicon-ok'></i> FORAM LOCALIZADAS <span class='badge badge-primary'><b>{$countF}</b></span> OBRA(s)</p></div>";
                            echo "<div class='col-md-12'><p><i class='glyphicon glyphicon-ok'></i> Exibindo <span class='badge badge-primary'>" . $count . '</span> registro(s) de <span class="badge badge-primary">' . $Pager->getRowCount(). '</span> encontrado(s)</p></div>'; 
                            foreach($readEmp->getResult() as $emp):
                                extract($emp); 
                ?>
                <tr>
                    <?php
                        $pagina = isset($_GET['page']) ? $_GET['page'] : 1;
                        $shouldCheck = '';
                        if(isset($_SESSION['empresas_checked'][$pagina])){
                           if(in_array($Codigo, $_SESSION['empresas_checked'][$pagina])){
                               $shouldCheck = 'checked';
                           } 
                        }
                    ?>
                    <td><input type="checkbox" name="empresas_checked[]" class="view" value="<?= $Codigo;?>" <?=$shouldCheck;?> /></td>
                    <td><?= $RazaoSocial;?></td>
                    <td><?= $Fantasia;?></td>
                    <td><?= $Endereco;?></td>
                    <td><span class="badge badge-primary"><?= $UF;?></span></td>
                    <td><span class="badge badge-primary"><?= date("d/m/Y", strtotime($Atualizacao));?></span></td>
                    <?php
                        $readSta = $read;
                        $readSta->FullRead("SELECT fup.IDEMPRESA_OBRA,
                                                    sts.DescricaoStatusSIG 
                                                    FROM tb_followup_fup as fup
                                                        LEFT JOIN tb_statussig_sts AS sts
                                                    ON sts.IdStatusSIG = fup.IDSTATUSSIG 
                                                    WHERE fup.IDEMPRESA_OBRA = $Codigo
                                                    AND fup.IDASSOCIADO = " .$userlogin['emp_IdEmpresa_int_FK']. " 
                                                    ORDER BY fup.IDFOLLOWUP DESC LIMIT 1");  
                    ?>
                    <td class="text-primary text-center">
                        <b><?php 
                                if($readSta->getResult()){
                                foreach($readSta->getResult() AS $rest){
                                    extract ($rest); 
                                    echo $DescricaoStatusSIG;
                                }}
                            ?>
                        </b>
                    </td>

                    <td><a class="btn btn-default" title="Cadastrar SIG" onclick="window.open('imp.php?exe=pesquisas/createSigEmp&Codigo=<?= $Codigo;?>&RazaoSocial=<?= $RazaoSocial; ?>', 'Pagina', 'STATUS=NO, TOOLBAR=NO, LOCATION=NO, DIRECTORIES=NO, RESISABLE=NO, SCROLLBARS=YES, TOP=10, LEFT=10, WIDTH=800, HEIGHT=455');"><i class="glyphicon glyphicon-align-left"></i></a></td>
                </tr>
                <?php
                    endforeach;
                    endif; 
                ?>
            </table>
        </div>
        
        <!--PAGINACAO FOOTER-->
        <div class="col-md-12 text-center">
            <?php
                $Pager->ExeFullPaginator($querySql);
                echo $Pager->getPaginator();
            ?>
        </div>
        
        <div class="col-md-12">
            <p><code>* Para visualizar os dados selecione uma empresa ou mais</code></p>
        </div>
        
        <!--BOTÕES-->
        <div class="modal-footer">
            <div class="col-md-12">
                <a href="painel.php?exe=pesquisas/empresas" class="btn btn-primary" title="Nova Pesquisa"><i class="glyphicon glyphicon-ok"></i> Nova Pesquisa</a>
                <button type="submit" title="Visualizar Dados da Empresa para isso selecione uma ou mais" class="btn btn-success search" id="viewSearch"><i class="glyphicon glyphicon-ok"></i> Visualizar Pesquisa</button> 
                <a title="Enviar link de Empresa(s), para isso selecione uma ou mais" class="btn btn-default search" data-toggle="modal" data-target="#email" ><i class="glyphicon glyphicon-envelope"></i> Enviar Link</a>   
            </div>
        </div>
    </form>
    
    <!--FOLLOWUP-->
    <div class="modal fade" id="followup" tabindex="-1" role="dialog" aria-labelledby="formUpdate">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="formUpdate"><i class="glyphicon glyphicon-align-left"></i> <b>SIG Obra</b></h4>
                </div>
                <div class="modal-body">
                    <?php
                        $dataBd = date("Y-m-d");
                        $data = filter_input_array(INPUT_POST, FILTER_DEFAULT);
                        
                        if (isset($data) && isset($data['SendPostForm'])):
                            $tmp = explode("/",$data['DataAgenda']);
                            $data['DataAgenda'] = $tmp[2] . "-" . $tmp[1] . "-" . $tmp[0];
                            unset($data['SendPostForm']);
                            require('_models/AdminSigEmpresa.class.php');
                            $cadastra = new AdminSigEmpresa;
                            $cadastra->ExeCreate($data);
                        endif;
                    ?>
                    <form class="create" name="PostForm" action="" method="post">
                        <input type="hidden" name="IDUSUARIO" value="<?= $userlogin['usu_Usuario_int_PK'];?>"/>
                        <input type="hidden" name="IDEMPRESA_OBRA" id="id" value="" />
                        <input type="hidden" name="IDASSOCIADO" id="associado" value="" />
                        <input type="hidden" name="DATA" value="<?= $dataBd;?>" />
                        <input type="hidden" name="INDTIPO" id="tipo" value="" />
            
                        <div class="col-lg-12">
                            <p><b>EMPRESA:</b> <span id="nomeEmpresa"></span></p>
                            <p><b>DATA:</b> <?= $dataBd = date("d/m/Y", strtotime($dataBd));?></p>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-4">
                                <label class="control-label"> Agendar Para</label>
                                <input type="text" name="DataAgenda" class="form-control datepicker" value="" placeholder="Digite a Data..." required>
                                <div class="help-block with-errors"></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-4">
                                <label class="control-label"> Prioridade</label>
                                <select name="PRIORIDADE" class="form-control">
                                    <option value="0">SELECIONE</option>
                                    <option value="1">Baixa</option>
                                    <option value="2">Média</option>
                                    <option value="3">Alta</option>
                                </select>
                                <div class="help-block with-errors"></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-4">
                                <label class="control-label"> Status</label>
                                <select name="IDSTATUSSIG" class="form-control">
                                    <?php
                                        $readEst = $read;
                                        $readEst->ExeRead("tb_statussig_sts","ORDER BY DescricaoStatusSIG");
                                        if($readEst->getResult()):
                                        foreach($readEst->getResult() AS $sts):
                                            extract($sts);
                                            echo "<option value='$IdStatusSIG'>{$DescricaoStatusSIG}</option>";
                                        endforeach;
                                        endif;
                                    ?>
                                </select>
                                <div class="help-block with-errors"></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-12">
                                <label class="control-label">Descrição</label>
                                <textarea name="DESCRICAO" class="form-control" rows="5"></textarea>
                                <div class="help-block with-errors"></div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <div class="col-sm-12">
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Fechar</button>
                                <input type="submit" class="btn btn-primary" value="Cadastrar" name="SendPostForm" />
                           </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
    <!--ENVIAR LINK-->
    <div class="modal fade" id="email" tabindex="-1" role="dialog" aria-labelledby="formUpdate">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="formUpdate"><i class="glyphicon glyphicon-envelope"></i> <b>ENVIAR LINK DE Empresa(s) POR E-MAIL</b></h4>
                </div>
                <div class="modal-body">
                    <div class="col-md-12 alert-info" id="resposta" style="display: none;">
                        <p class="tex-center"><i class="glyphicon glyphicon-hand-right"></i> Ok, Link com Emperesa(s) selecionada(s) foi enviada com sucesso!!</p>
                    </div>
                    <div class="row"></div>
                    <form class="emailLink" name="PostForm" action="" method="post">
                        <input type="hidden" name="Assunto" value="IntecBrasil - Relatório de Empresa(s)" />
                        <div class="form-group">
                            <div class="col-sm-2">
                                <label class="control-label"><i class="glyphicon glyphicon-user"></i> ID</label>
                                <input type="text" name="id" class="form-control" value="<?= $userlogin['usu_Usuario_int_PK'];?>" readonly=""/>
                                <div class="help-block with-errors"></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-10">
                                <label class="control-label"><i class="glyphicon glyphicon-user"></i> Usuário Origem</label>
                                <input type="text" name="RemetenteNome" class="form-control" id="nomeOrigem" value="<?= $userlogin['usu_Usuario_chr'];?>" readonly=""/>
                                <div class="help-block with-errors"></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-12">
                                <label class="control-label"><i class="glyphicon glyphicon-envelope"></i> E-mail</label>
                                <input type="email" name="RemetenteEmail" class="form-control" id="emailOrigem" value="<?= $userlogin['usu_Email_chr'];?>" readonly=""/>
                                <div class="help-block with-errors"></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-12">
                                <label class="control-label"><i class="glyphicon glyphicon-envelope"></i> Lista de E-Mail's (separar cada-mail por vírgula)</label>
                                <input type="email" name="DestinoEmail" id="emailDestino" class="form-control" value="" required=""/>
                                <div class="help-block with-errors"></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-12">
                                <label class="control-label"><i class="glyphicon glyphicon-ok"></i> Memo</label>
                                <textarea name="Mensagem" class="form-control" rows="5" id="mensagemDestino"></textarea>
                                <div class="help-block with-errors"></div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <div class="col-sm-12">
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Fechar</button>
                                <input type="submit" class="btn btn-primary" id="btnSendEmail" value="Enviar" />
                           </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div> 
</div>
<script>
    $('#followup').on('show.bs.modal', function (event) {
      var button    = $(event.relatedTarget)
      var id        = button.data('id') 
      var associado = button.data('associado')
      var empresa   = button.data('empresa')
      var tipo      = button.data('tipo')

      var modal = $(this)
      modal.find('.modal-title').text('SIG Empresa - ' + empresa)
      //modal.find('.modal-body input').val(id)
      modal.find('#id').val(id)
      modal.find('#associado').val(associado)
      modal.find('#empresa').val(empresa)
      modal.find('#nomeEmpresa').text(empresa)
      modal.find('#tipo').val(tipo)
    })
    
    $(function(){
        /*Empresas*/
        var $marcarViewGeral = $(".viewGeral"),
            $checkboxView    = $(".view");
            
        //Marcando todas as Empresas
        $marcarViewGeral.on("change", function(){
            if($(this).is(":checked")){
                $checkboxView.each(function(){
                    this.checked = true;              
                });
            }else{
                $checkboxView.each(function(){
                    this.checked = false;    
                });         
            }
            saveChecked();
        });  
    });
    
    $.urlParam = function(name){
        var results = new RegExp('[\?&]' + name + '=([^&#]*)').exec(window.location.href);
        if (results==null) {
           return null;
        }
        return decodeURI(results[1]) || 0;
    }
    
    function saveChecked(){
        let pageParam = $.urlParam('page');
        let page = pageParam === null ? 1 : pageParam; 
        let params = $('.view:checked').serialize()+'&pagina='+page;
        
        $.ajax({
            url: "request.php?exe=pesquisas/saveCheckedEmpresas",
            type: "POST",
            data: params,
            success: function(data) {          
                if(data != 'ok'){
                    //Aqui vc pode tratar o erro como quiser/se quiser
                    console.log(data);//So mostrando o erro msm
                }
            }
        });
    }
    
    $('.view').click(saveChecked);
    
    $('#btnUnsetChecked').on('click', function(event){
        event.preventDefault();
        
        $.ajax({
            url: "request.php?exe=pesquisas/unsetCheckedEmperesas",
            type: "POST",
            success: function(){
                unsetChecked();
            }
        });
    })
    
    //Deleta a sessão ao clicar no botão visualizar viewSearch
    function unsetChecked(){
        document.querySelectorAll('.view:checked').forEach((elem) => {
                $(elem).prop('checked', false);
         });
    }
    
    $('#viewSearch').click(unsetChecked);
    
    //Enviando email e checks
    $("#btnSendEmail").on("click", function(event){
        event.preventDefault();
       
        let nomeOrigem   = $('#nomeOrigem').val();
        let emailOrigem  = $('#emailOrigem').val();
        let emailDestino = $('#emailDestino').val();
        let msgDestino   = $('#mensagemDestino').val();
        
        let params = $(".view:checked").serialize();
        params += `&RemetenteNome=${nomeOrigem}&RemetenteEmail=${emailOrigem}&DestinoEmail=${emailDestino}&Mensagem=${msgDestino}`;
        
        $.ajax({
            url: "request.php?exe=pesquisas/send_emailEmpresa",
            type: "POST",
            data: params,
            success: function(data) {
                if(data == "sucesso"){
                   $("#resposta").fadeIn(),
                   document.querySelectorAll('.view:checked').forEach((elem) => {
                       $(elem).prop('checked', false);
                   });
                } else {
                    //Deu erro ao enviar o email
                }
                console.log(data);//ISSO AQUI TAMBEM N PRECISA, ERA SO PRA GENTE TESTAR
            }
        });
    });
</script> 