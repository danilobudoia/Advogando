<?php
	require_once "Class/Documentos.php";

	$documentos = new Documentos();
	$documento = $documentos->selectId($_GET['id']);

	pclose(popen('start /B "" "../'.$documento['local'].'"', "r")); 
  	header("Location: listarPeticoes.php");
?>