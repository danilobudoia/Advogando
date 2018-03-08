<?php

	require_once '../Class/Agenda.php';	

	$method = $_SERVER['REQUEST_METHOD'];

	$agenda = new Agenda();	

	if ($method == "POST"){
		$method = $_POST['_method'] == "POST" ? "POST" : "PUT";
		
		$agenda->setClienteId($_POST['cliente_id']);
		$agenda->setProcessoId($_POST['processo_id']);
		$agenda->setEvento($_POST['evento']);
		$agenda->setData($_POST['data']);
		$agenda->setHora($_POST['hora']);
		$agenda->setObservacao($_POST['observacao']);
		//print_r($_POST);
	}	

	switch ($method) {
		case 'GET':
			if (isset($_GET['term']) && !empty($_GET['term'])){
				$dados = $agenda->selectId($_GET['id']);

				echo json_encode("success");
			}else{
				echo json_encode($agenda->selectId($_GET['id']));
			}			
			break;
		case 'POST':
			$agenda->insert();
			
	        header("Location: ../listarAgenda.php");
			break;
		case 'PUT':
			$agenda->setId($_POST['id']);
			$agenda->update();
						
			header("Location: ../listarAgenda.php");
			break;
		case 'DELETE':
			$agenda->delete($_GET['id']);
			echo json_encode("success");	
			break;
		case 'FINALIZE':		
			$agenda->finalize($_GET['id']);
			echo json_encode("success");		
			break;
	}
?>