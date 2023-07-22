<?php
    session_start();
	ob_start();
	require('../../_app/Config.inc.php');
        $Estado = filter_input(INPUT_POST, 'Estado', FILTER_DEFAULT);
	$itens = array();
	$sql = new Read;
	$sql->FullRead("SELECT *FROM tb_cidades_cid
                    			WHERE uf = '$Estado'
                                ORDER BY cidade");
	if (!$sql->getResult()):
			WSErro("Desculpe, nenhuma Cidade encontrada para esse Estado", WS_INFOR);
		else:
			foreach ($sql->getResult() as $rs):
				$idcidade = +$rs['idcidade'];
				$itens[] =  array(
					'idcidade' => $idcidade,
					'cidade' => $rs['cidade'],
				);
			endforeach;
		endif;
		if (count($itens))
			$json['cidade'] = $itens;
		else
			$json['error'] = 'Nenhuma Cidade encontrada para esse Estado.';
	header('Content-Type: application/json');
	echo json_encode($json);
	ob_end_flush();