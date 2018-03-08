<?php

	require_once '../Class/Representantes.php';	

	$method = $_SERVER['REQUEST_METHOD'];

	$representantes = new Representantes();
	
	if ($method == "POST"){
		$method = $_POST['_method'] == "POST" ? "POST" : "PUT";
		
		$representantes->setNome($_POST['nome']);
		$representantes->setDocumento($_POST['documento']);
		$representantes->setTelefone($_POST['telefone']);
		$representantes->setCelular($_POST['celular']);		
		$representantes->setEmail($_POST['email']);
		$representantes->setObservacao($_POST['observacao']);
		//print_r($_POST);
	}

	switch ($method) {
		case 'GET':	
			if (isset($_GET['term']) && !empty($_GET['term'])){
				echo json_encode($representantes->selectNomeId($_GET['term']));
			} else{
				echo json_encode($representantes->selectId($_GET['id']));
			}
			break;
		case 'POST':	
			$representantes->insert();
			
			echo ("
			<script>
				history.back();
			</script>
			");
	        //header("Location: ../listarRepresentantes.php");				
			break;
		case 'PUT':			
			$representantes->setId($_POST['id']);
			$representantes->update();
			
			header("Location: ../listarRepresentantes.php");						
			break;
		case 'DELETE':		
			$representantes->delete($_GET['id']);
			echo json_encode("success");		
			break;
		case 'REATIVAR':		
			$representantes->reativar($_GET['id']);
			echo json_encode("success");	
			break;
	}
?>