<?php

	require_once '../Class/Processos.php';
	require_once '../Class/ClienteProcesso.php';
	require_once '../Class/Documentos.php';

	$method = $_SERVER['REQUEST_METHOD'];

	$processos = new Processos();
	$listaClienteProcesso = array();
	
	if ($method == "POST"){
		$method = $_POST['_method'] == "POST" ? "POST" : "PUT";
		
		$processos->setNumero($_POST['numero']);
		$processos->setNome($_POST['nome']);
		$processos->setNatureza($_POST['natureza']);
		$processos->setDataInicio($_POST['data_inicio']);
		$processos->setSituacao($_POST['situacao']);
		$processos->setObservacao($_POST['observacao']);

		foreach ($_POST['cliente_id'] as $value) {
			$item = new ClienteProcesso();
			$item->setClienteId($value);
			array_push($listaClienteProcesso, $item);
		}
		//print_r($_POST);
	}

	switch ($method) {
		case 'GET':	
			if (isset($_GET['term']) && !empty($_GET['term'])){
				echo json_encode($processos->selectNumeroId($_GET['term']));
			} else{
				echo json_encode($processos->selectId($_GET['id']));
			}
			break;
		case 'POST':
			$processos->insert();

			foreach ($listaClienteProcesso as $item) {
				$item->insertProcesso();
			}
			
	        header("Location: ../listarProcessos.php");
			break;
		case 'PUT':		
			$processos->setId($_POST['id']);
			$processos->update();

			$clienteProcesso = new ClienteProcesso();
			$clienteProcesso->deleteProcesso($_POST['id']);

			foreach ($listaClienteProcesso as $item) {
				$item->updateProcesso($_POST['id']);
			}
			
			header("Location: ../listarProcessos.php");				
			break;
		case 'DELETE':		
			$processos->delete($_GET['id']);

			$documentos = new Documentos();
			$documentos->finalizarTodos($_GET['id']);

			echo json_encode("success");	
			break;
		case 'REATIVAR':		
			$processos->reativar($_GET['id']);
			
			$documentos = new Documentos();
			$documentos->reativarTodos($_GET['id']);

			echo json_encode("success");	
			break;
	}
?>