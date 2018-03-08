<?php

	require_once '../Class/Usuarios.php';	

	$method = $_SERVER['REQUEST_METHOD'];

	$usuarios = new Usuarios();
	
	if ($method == "POST"){
		$method = $_POST['_method'] == "POST" ? "POST" : "PUT";

		$usuarios->setNome($_POST['nome']);
		$usuarios->setEmail($_POST['email']);
		$usuarios->setSenha($_POST['senha']);
	}

	switch ($method) {
		case 'GET':
			if (isset($_GET['email'])){

				$status = $usuarios->existEmail($_GET['email']);
				if (isset($_GET['id'])){
					if (!$status){						
						$status = $usuarios->existEmailId($_GET['email'], $_GET['id']);
					}
				}
				echo json_encode(array(
					'valid' => $status
				));		
			}elseif (isset($_GET['id'])){
				echo json_encode($usuarios->selectId($_GET['id']));
			}			
			break;
		case 'POST':			
			$usuarios->insert();
			
	        header("Location: ../listarUsuarios.php");
			break;
		case 'PUT':			
			$usuarios->setId($_POST['id']);
			$usuarios->update();
			
			if (isset($_POST['perfil']))	header("Location: ../logout.php");
			else 							header("Location: ../listarUsuarios.php");
			break;
		case 'DELETE':						
			$usuarios->delete($_GET['id']);
			echo json_encode("success");
			break;
	}
?>