<?php
	
	require_once 'connection.php';
	/**
	* Classe genérica de Agenda
	*/
	class Agenda
	{		
		protected $id;
		protected $cliente_id;
		protected $processo_id;
		protected $evento;
		protected $data;
		protected $hora;
		protected $observacao;
		protected $status;
		
		public function getId(){
			return $this->id;
		}

		public function setId($id){
			$this->id = addslashes($id);
		}

		public function getClienteId(){
			return $this->cliente_id;
		}

		public function setClienteId($cliente_id){
			$this->cliente_id = addslashes($cliente_id);
		}

		public function getProcessoId(){
			return $this->processo_id;
		}

		public function setProcessoId($processo_id){
			$this->processo_id = addslashes($processo_id);
		}

		public function getEvento(){
			return $this->evento;
		}	

		public function setEvento($evento){
			$this->evento = addslashes($evento);
		}

		public function getData(){
			return $this->data;
		}	

		public function setData($data){
			$this->data = addslashes($data);
		}

		public function getHora(){
			return $this->hora;
		}	

		public function setHora($hora){
			$this->hora = addslashes($hora);
		}

		public function getObservacao(){
			return $this->observacao;
		}

		public function setObservacao($observacao){
			$this->observacao = addslashes($observacao);
		}

		public function getStatus(){
			return $this->status;
		}

		public function setStatus($status){
			$this->status = addslashes($status);
		}

		public function selectAll(){
			$conn = new Connection();
			$db = $conn->getDb();

			$consulta = $db->query("SELECT A.id, A.evento, C.nome AS c_nome, P.numero AS p_numero, P.situacao AS p_situacao, A.data, A.hora
				FROM AGENDA A 
				LEFT JOIN CLIENTES C ON A.cliente_id = C.id
				LEFT JOIN PROCESSOS P ON A.processo_id = P.id 
				WHERE A.status = 1
				ORDER BY A.data, A.hora");

			$customer = array();

			foreach ($consulta as $value) {
				$customer[] = $value;
			}

			$conn = null;
			$db = null;

			return $customer;
		}

		public function selectId($id){
			$conn = new Connection();
			$db = $conn->getDb();

			$consulta = $db->query("SELECT A.id, A.cliente_id, A.processo_id, A.evento, A.data, A.hora, A.observacao, C.nome AS c_nome, P.numero AS p_numero, P.nome AS p_nome, P.situacao AS p_situacao, C.repres_id AS r_id,
				(SELECT R.nome FROM REPRESENTANTES R WHERE C.repres_id = R.id) AS r_nome 
				FROM AGENDA A 
				LEFT JOIN CLIENTES C ON A.cliente_id = C.id 
				LEFT JOIN PROCESSOS P ON A.processo_id = P.id 
				WHERE A.id = ".$id);

			$dados = $consulta->fetch();

			$conn = null;
			$db = null;

			return $dados;
		}
		
		/*
		public function reportResume($data_inicio, $data_fim){
			$conn = new Connection();
			$db = $conn->getDb();

			$consulta = $db->prepare("SELECT P.procedimento, COUNT(procedimento) as qtd, A.observacao FROM AGENDA A 
				INNER JOIN PROCEDIMENTO P ON A.processo_id = P.id
				WHERE A.status = 1 AND A.data BETWEEN ? AND ? GROUP BY procedimento, A.observacao");
			$consulta->execute( array($data_inicio, $data_fim));			
			
			$dados = $consulta->fetchAll();

			$conn = null;
			$db = null;

			return $dados;
		}
		*/

		public function insert(){
			$conn = new Connection();
			$db = $conn->getDb();

			$dados = $db->prepare('INSERT INTO AGENDA (cliente_id, processo_id, evento, data, hora, observacao, status) VALUES (?, ?, ?, ?, ?, ?, 1)');

			if ($this->getClienteId() == "" && $this->getProcessoId() == "") {
				$dados->execute( array( null, null, $this->getEvento(), $this->getData(), $this->getHora(), $this->getObservacao()));
			} else if ($this->getClienteId() == "") {
				$dados->execute( array( null, $this->getProcessoId(), $this->getEvento(), $this->getData(), $this->getHora(), $this->getObservacao()));
			} else if ($this->getProcessoId() == "") {
				$dados->execute( array( $this->getClienteId(), null, $this->getEvento(), $this->getData(), $this->getHora(), $this->getObservacao()));
			} else {
				$dados->execute( array($this->getClienteId(), $this->getProcessoId(), $this->getEvento(), $this->getData(), $this->getHora(), $this->getObservacao()));
			}

			//$dados = $db->prepare('UPDATE AGENDA SET observacao = ? WHERE id = 2');

			//$dados->execute( array($this->getClienteId()));

			$conn = null;
			$db = null;
		}

		public function update(){
			$conn = new Connection();
			$db = $conn->getDb();

			$dados = $db->prepare('UPDATE AGENDA SET cliente_id = ?, processo_id = ?, evento = ?, data = ?, hora = ?, observacao = ? WHERE id = ?');

			if ($this->getClienteId() == "" && $this->getProcessoId() == "") {
				$dados->execute( array( null, null, $this->getEvento(), $this->getData(), $this->getHora(), $this->getObservacao(), $this-> getId()));
			} else if ($this->getClienteId() == "") {
				$dados->execute( array( null, $this->getProcessoId(), $this->getEvento(), $this->getData(), $this->getHora(), $this->getObservacao(), $this-> getId()));
			} else if ($this->getProcessoId() == "") {
				$dados->execute( array( $this->getClienteId(), null, $this->getEvento(), $this->getData(), $this->getHora(), $this->getObservacao(), $this-> getId()));
			} else {
				$dados->execute( array($this->getClienteId(), $this->getProcessoId(), $this->getEvento(), $this->getData(), $this->getHora(), $this->getObservacao(), $this-> getId()));
			}
			
			$conn = null;
			$db = null;
		}

		public function delete($id){
			$conn = new Connection();
			$db = $conn->getDb();

			$dados = $db->prepare('DELETE FROM AGENDA WHERE id = ?');

			$dados->execute( array($id));

			$conn = null;
			$db = null;
		}

		public function finalize($id){
			$conn = new Connection();
			$db = $conn->getDb();

			$dados = $db->prepare('UPDATE AGENDA SET status = 0 WHERE id = ?');

			$dados->execute( array($id));

			$conn = null;
			$db = null;
		}

		public function selectFinalizados(){
			$conn = new Connection();
			$db = $conn->getDb();

			$consulta = $db->query("SELECT A.id, A.evento, C.nome AS c_nome, P.numero AS p_numero, A.data, A.hora
				FROM AGENDA A 
				LEFT JOIN CLIENTES C ON A.cliente_id = C.id
				LEFT JOIN PROCESSOS P ON A.processo_id = P.id 
				WHERE A.status = 0
				ORDER BY A.data, A.hora");

			$customer = array();

			foreach ($consulta as $value) {
				$customer[] = $value;
			}

			$conn = null;
			$db = null;

			return $customer;
		}

		// FUNÇÕES PARA GERAR TABELAS - INDEX.PHP

		public function selectHoje(){
			$conn = new Connection();
			$db = $conn->getDb();

			$consulta = $db->query("SELECT id, evento, data, hora
				FROM AGENDA 
				WHERE status = 1 AND data = current_date");

			$customer = array();

			foreach ($consulta as $value) {
				$customer[] = $value;
			}

			$conn = null;
			$db = null;

			return $customer;
		}

		public function selectAtrasados(){
			$conn = new Connection();
			$db = $conn->getDb();

			$consulta = $db->query("SELECT id, evento, data, DATEDIFF(CURRENT_DATE(), data) as d_atrasado
				FROM AGENDA
				WHERE status = 1 AND DATEDIFF(CURRENT_DATE(), data) > 0");

			$customer = array();

			foreach ($consulta as $value) {
				$customer[] = $value;
			}

			$conn = null;
			$db = null;

			return $customer;
		}

		public function selectFuturos(){
			$conn = new Connection();
			$db = $conn->getDb();

			$consulta = $db->query("SELECT id, evento, data, DATEDIFF(data, CURRENT_DATE()) as d_adiantado
				FROM AGENDA
				WHERE status = 1 AND DATEDIFF(data, CURRENT_DATE()) BETWEEN 1 AND 10");

			$customer = array();

			foreach ($consulta as $value) {
				$customer[] = $value;
			}

			$conn = null;
			$db = null;

			return $customer;
		}

		// FUNÇÕES PARA GERAR GRAFICO - INDEX.PHP

		public function contarConcluidos(){
			$conn = new Connection();
			$db = $conn->getDb();

			$consulta = $db->query("SELECT COUNT(*) FROM AGENDA WHERE status = 0");

			$dados = $consulta->fetch();

			$conn = null;
			$db = null;

			return $dados;
		}

		public function contarAtrasados(){
			$conn = new Connection();
			$db = $conn->getDb();

			$consulta = $db->query("SELECT COUNT(*) FROM AGENDA WHERE status = 1 AND DATEDIFF(CURRENT_DATE(), data) > 0");

			$dados = $consulta->fetch();

			$conn = null;
			$db = null;

			return $dados;
		}
		
		public function contarHoje(){
			$conn = new Connection();
			$db = $conn->getDb();

			$consulta = $db->query("SELECT COUNT(*) FROM AGENDA WHERE status = 1 AND data = current_date");

			$dados = $consulta->fetch();

			$conn = null;
			$db = null;

			return $dados;
		}

		public function contarProximos(){
			$conn = new Connection();
			$db = $conn->getDb();

			$consulta = $db->query("SELECT COUNT(*) FROM AGENDA WHERE status = 1 AND DATEDIFF(data, CURRENT_DATE()) BETWEEN 1 AND 10");

			$dados = $consulta->fetch();

			$conn = null;
			$db = null;

			return $dados;
		}
		
		public function contarDistantes(){
			$conn = new Connection();
			$db = $conn->getDb();

			$consulta = $db->query("SELECT COUNT(*) FROM AGENDA WHERE status = 1 AND DATEDIFF(data, CURRENT_DATE()) > 10");

			$dados = $consulta->fetch();

			$conn = null;
			$db = null;

			return $dados;
		}

		
	}		

?>