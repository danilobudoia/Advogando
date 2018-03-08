<?php

  require_once "../Class/Processos.php";
  $processos = new Processos();

  require_once "../Class/Clientes.php";
  $clientes = new Clientes();

  require_once '../Class/Documentos.php'; 
  $documentos = new Documentos();

  /******************** MANIPULANDO AS VARIÁVEIS ********************/
  //Cria variáveis com textos dinâmicos (externos)
  $nomePeticao = $_POST['nomePeticao'];
  $tipoPeticao = $_POST['tipoPeticao'];
  $processo_id = $_POST['processo_id'];
  $cliente_id = $_POST['cliente_id'];
  $conteudo_pt1 = nl2br($_POST['conteudo_pt1']);
  $conteudo_pt2 = nl2br($_POST['conteudo_pt2']);

	//Cria as variáveis com informações do banco de dados
  $processo = $processos->selectId($processo_id);
  $p_nome = $processo['nome'];
  $p_numero = $processo['numero'];
  $p_natureza = $processo['natureza'];
  $p_data_inicio = $processo['data_inicio'];

  $cliente = $clientes->selectId($cliente_id);
	$c_nome = $cliente['nome'];
  $c_documento1 = $cliente['documento1'];
  $c_documento2 = $cliente['documento1'];
  $c_data_nasc = $cliente['data_nasc'];
  $c_endereco = $cliente['endereco'];
  $c_numero = $cliente['numero'];
  $c_cidade = $cliente['cidade'];
  $c_estado = $cliente['estado'];
  $c_cep = $cliente['cep'];

  $r_nome = $cliente['r_nome'];
  $r_documento = $cliente['r_documento'];

	//Verifica as variáveis
  if ($conteudo_pt1 == "")   $conteudo_pt1 = "CONTEÚDO (Leis, causas e/ou pedidos)";
  else  $conteudo_pt1 = str_replace("<br />", "\\par", $conteudo_pt1);

  if ($conteudo_pt2 == "")   $conteudo_pt2 = "CONTEÚDO (Leis, causas e/ou pedidos)";
  else  $conteudo_pt2 = str_replace("<br />", "\\par", $conteudo_pt2);

  if ($c_documento1 == "")   $c_documento1 = "CPF/CNPJ";
  if ($c_documento2 == "")   $c_documento2 = "RG/INSCRIÇÃO";
  if ($c_data_nasc == "")   $c_data_nasc = "DATA NASCIMENTO";
  if ($c_endereco == "")   $c_endereco = "ENDEREÇO";
  if ($c_numero == "")   $c_numero = "NUMERO";
  if ($c_cidade == "")   $c_cidade = "CIDADE";
  if ($c_estado == "")   $c_estado = "ESTADO";
  if ($c_cep == "")   $c_cep = "CEP";

  if ($r_nome == "")   $r_nome = "REPRESENTANTE";
  if ($r_documento == "")   $r_documento = "DOCUMENTO";

  /******************** MANIPULANDO O ARQUIVO ********************/
  //Seleciona o arquivo
  $arquivo = "../../Petições/Templates/".$tipoPeticao.".rtf";
  $f = fopen($arquivo, 'r');
  $texto = fread($f, filesize($arquivo));
  fclose($f); 
  
  // //Altera os campos do arquivo
  $texto = str_replace('p_nome', utf8_decode($p_nome), $texto);
  $texto = str_replace('p_numero', utf8_decode($p_numero), $texto);
  $texto = str_replace('p_natureza', utf8_decode($p_natureza), $texto);
  $texto = str_replace('p_data_inicio', utf8_decode($p_data_inicio), $texto);

  $texto = str_replace('c_nome', utf8_decode($c_nome), $texto);
  $texto = str_replace('c_tipo', utf8_decode($c_tipo), $texto);
  $texto = str_replace('c_documento1', utf8_decode($c_documento1), $texto);
  $texto = str_replace('c_documento2', utf8_decode($c_documento2), $texto);
  $texto = str_replace('c_data_nasc', utf8_decode($c_data_nasc), $texto);
  $texto = str_replace('c_endereco', utf8_decode($c_endereco), $texto);
  $texto = str_replace('c_numero', utf8_decode($c_numero), $texto);
  $texto = str_replace('c_cidade', utf8_decode($c_cidade), $texto);
  $texto = str_replace('c_estado', utf8_decode($c_estado), $texto);
  $texto = str_replace('c_cep', utf8_decode($c_cep), $texto);

  $texto = str_replace('r_nome', utf8_decode($r_nome), $texto);
  $texto = str_replace('r_documento', utf8_decode($r_documento), $texto);

  $texto = str_replace('conteudo_pt1', utf8_decode($conteudo_pt1), $texto);
  $texto = str_replace('conteudo_pt2', utf8_decode($conteudo_pt2), $texto);

	//Salva o arquivo
  if(!is_dir("../../Petições/".$processo_id)) mkdir("../../Petições/".$processo_id, 0700);
  $arquivo = "../../Petições/".$processo_id."/".$nomePeticao.".doc";
  $f = fopen($arquivo, 'w');
  fwrite($f, $texto);
  fclose($f);

  /******************** SALVANDO NOS DOCUMENTOS ********************/
  //Salva no Documentos (banco de dados)
  $documentos->setProcessoId($processo_id);
  $documentos->setLocal("Petições/".$processo_id."/".$nomePeticao.".doc");
  $documentos->setTipo($tipoPeticao);
  $documentos->setObservacao("Petição: ".$nomePeticao." | Tipo: ".$tipoPeticao." | Cliente: ".$c_nome." | Data: ".date('d-m-Y'));

  $documentos->insert();

  //Abre o arquivo e redireciona para lista dos Documentos
  pclose(popen('start /B "" "'.$arquivo.'"', "r")); 
  header("Location: ../listarPeticoes.php");
?>