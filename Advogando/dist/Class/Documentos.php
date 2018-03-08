<?php
	
	require_once 'connection.php';
	/**
	* Classe genérica de Documentos
	*/
	class Documentos
	{		
		protected $id;
		protected $processo_id;
		protected $local;
		protected $tipo;
		protected $observacao;
		protected $status;

		public function getId(){
			return $this->id;
		}

		public function setId($id){
			$this->id = addslashes($id);
		}

		public function getProcessoId(){
			return $this->processo_id;
		}

		public function setProcessoId($processo_id){
			$this->processo_id = addslashes($processo_id);
		}

		public function getLocal(){
			return $this->local;
		}

		public function setLocal($local){
			$this->local = addslashes($local);
		}

		public function getTipo(){
			return $this->tipo;
		}	

		public function setTipo($tipo){
			$this->tipo = addslashes($tipo);
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

			$consulta = $db->query("SELECT D.*, P.numero FROM DOCUMENTOS D LEFT JOIN PROCESSOS P ON D.processo_id = P.id
				WHERE D.status = 1");

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
			
			$consulta = $db->query("SELECT * FROM DOCUMENTOS WHERE id = ".$id);

			$dados = $consulta->fetch();

			$conn = null;
			$db = null;

			return $dados;
		}

		public function insert(){
			$conn = new Connection();
			$db = $conn->getDb();

			$dados = $db->prepare('INSERT INTO DOCUMENTOS (processo_id, local, tipo, observacao, status)
			VALUES (?, ?, ?, ?, 1)');

			$dados->execute( array($this->getProcessoId(), $this->getLocal(), $this->getTipo(), $this->getObservacao()));

			$conn = null;
			$db = null;
		}

		public function update(){
			$conn = new Connection();
			$db = $conn->getDb();

			$dados = $db->prepare('UPDATE DOCUMENTOS SET processo_id = ?, local = ?, tipo = ?, observacao = ? WHERE id = ?');

			$dados->execute( array($this->getProcessoId(), $this->getLocal(), $this->getTipo(), $this->getObservacao(), $this-> getId()));

			$conn = null;
			$db = null;
		}

		public function delete($id){
			$conn = new Connection();
			$db = $conn->getDb();

			$dados = $db->prepare('UPDATE DOCUMENTOS SET status = 0 WHERE id = ?');

			$dados->execute( array($id));

			$conn = null;
			$db = null;
		}

		public function finalizarTodos($id){
			$conn = new Connection();
			$db = $conn->getDb();

			$dados = $db->prepare('UPDATE DOCUMENTOS SET status = 0 WHERE processo_id = ?');

			$dados->execute( array($id));

			$conn = null;
			$db = null;
		}

		public function reativarTodos($id){
			$conn = new Connection();
			$db = $conn->getDb();

			$dados = $db->prepare('UPDATE Documentos SET status = 1 WHERE processo_id = ?');

			$dados->execute( array($id));
			
			$conn = null;
			$db = null;
		}

		
	}			

?>