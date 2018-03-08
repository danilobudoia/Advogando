<?php

	require_once '../Class/Clientes.php';
	require_once '../Class/ClienteProcesso.php';

	$method = $_SERVER['REQUEST_METHOD'];

	$clientes = new Clientes();
	$listaClienteProcesso = array();

	if ($method == "POST"){
		$method = $_POST['_method'] == "POST" ? "POST" : "PUT";
		
		$clientes->setRepresId($_POST['repres_id']);
		$clientes->setTipo($_POST['tipo']);
		$clientes->setNome($_POST['nome']);
		$clientes->setDocumento1($_POST['documento1']);	
		$clientes->setDocumento2($_POST['documento2']);	
		$clientes->setDataNasc($_POST['data_nasc']);
		$clientes->setSexo($_POST['sexo']);
		$clientes->setTelefone($_POST['telefone']);
		$clientes->setCelular($_POST['celular']);	
		$clientes->setEmail($_POST['email']);
		$clientes->setEndereco($_POST['endereco']);
		$clientes->setNumero($_POST['numero']);
		$clientes->setComplemento($_POST['complemento']);
		$clientes->setCidade($_POST['cidade']);
		$clientes->setEstado($_POST['estado']);
		$clientes->setCep($_POST['cep']);
		$clientes->setObservacao($_POST['observacao']);
		$clientes->setStatus($_POST['status']);

		foreach ($_POST['processo_id'] as $value) {
			$item = new ClienteProcesso();
			$item->setProcessoId($value);
			array_push($listaClienteProcesso, $item);
		}	
		//print_r($_POST);
	}

	switch ($method) {
		case 'GET':	
			if (isset($_GET['term']) && !empty($_GET['term'])){
				echo json_encode($clientes->selectNomeId($_GET['term']));
			} else{
				echo json_encode($clientes->selectId($_GET['id']));
			}
			break;
		case 'POST':	
			$clientes->insert();

			foreach ($listaClienteProcesso as $item) {
				$item->insertCliente();
			}
			
	        header("Location: ../listarClientes.php");				
			break;
		case 'PUT':			
			$clientes->setId($_POST['id']);
			$clientes->update();

			$clienteProcesso = new ClienteProcesso();
			$clienteProcesso->deleteCliente($_POST['id']);

			foreach ($listaClienteProcesso as $item) {
				$item->updateCliente($_POST['id']);
			}
			
			header("Location: ../listarClientes.php");						
			break;
		case 'DELETE':		
			$clientes->delete($_GET['id']);
			echo json_encode("success");		
			break;
		case 'REATIVAR':		
			$clientes->reativar($_GET['id']);
			echo json_encode("success");		
			break;
	}
?>