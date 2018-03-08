<?php
	
	require_once 'connection.php';
	/**
	* Classe genérica de Representantes
	*/
	class Representantes
	{		
		protected $id;
		protected $nome;
		protected $documento;
		protected $telefone;
		protected $celular;
		protected $email;
		protected $observacao;
		protected $status;
		
		public function getId(){
			return $this->id;
		}

		public function setId($id){
			$this->id = addslashes($id);
		}

		public function getNome(){
			return $this->nome;
		}

		public function setNome($nome){
			$this->nome = addslashes($nome);
		}

		public function getDocumento(){
			return $this->documento;
		}

		public function setDocumento($documento){
			$this->documento = addslashes($documento);
		}

		public function getTelefone(){
			return $this->telefone;
		}	

		public function setTelefone($telefone){
			$this->telefone = addslashes($telefone);
		}
		public function getCelular(){
			return $this->celular;
		}	

		public function setCelular($celular){
			$this->celular = addslashes($celular);
		}

		public function getEmail(){
			return $this->email;
		}	

		public function setEmail($email){
			$this->email = addslashes($email);
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

			$consulta = $db->query("SELECT * FROM REPRESENTANTES WHERE status = 1");

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

			$consulta = $db->query("SELECT * FROM REPRESENTANTES WHERE id = ".$id);

			$dados = $consulta->fetch();

			$conn = null;
			$db = null;

			return $dados;
		}

		public function selectNomeId($term){
			$conn = new Connection();
			$db = $conn->getDb();

			$consulta = $db->query("SELECT id, nome FROM REPRESENTANTES WHERE nome LIKE '%".$term."%' AND status = 1 Order By nome LIMIT 5");

			$customer = array();

			foreach ($consulta as $value) {
				$customer[] = $value;
			}

			$conn = null;
			$db = null;

			return $customer;
		}

		public function insert(){
			$conn = new Connection();
			$db = $conn->getDb();

			$dados = $db->prepare('INSERT INTO REPRESENTANTES (nome, documento, telefone, celular, email, observacao, status)
			VALUES (?, ?, ?, ?, ?, ?, 1)');

			$dados->execute( array($this->getNome(), $this->getDocumento(), $this->getTelefone(), $this->getCelular(), $this->getEmail(), $this->getObservacao()));

			$conn = null;
			$db = null;
		}

		public function update(){
			$conn = new Connection();
			$db = $conn->getDb();

			$dados = $db->prepare('UPDATE REPRESENTANTES SET nome = ?, documento = ?, telefone = ?, celular = ?, email = ?, observacao = ? WHERE id = ?');

			$dados->execute( array($this->getNome(), $this->getDocumento(), $this->getTelefone(), $this->getCelular(), $this->getEmail(), $this->getObservacao(), $this->getId()));

			$conn = null;
			$db = null;
		}

		public function delete($id){
			$conn = new Connection();
			$db = $conn->getDb();

			$dados = $db->prepare('UPDATE REPRESENTANTES SET status = 0 WHERE id = ?');

			$dados->execute( array($id));

			$conn = null;
			$db = null;
		}

		public function selectFinalizados(){
			$conn = new Connection();
			$db = $conn->getDb();

			$consulta = $db->query("SELECT * FROM REPRESENTANTES WHERE status = 0");

			$customer = array();

			foreach ($consulta as $value) {
				$customer[] = $value;
			}

			$conn = null;
			$db = null;

			return $customer;
		}

		public function reativar($id){
			$conn = new Connection();
			$db = $conn->getDb();

			$dados = $db->prepare('UPDATE REPRESENTANTES SET status = 1 WHERE id = ?');

			$dados->execute( array($id));
			
			$conn = null;
			$db = null;
		}
		
		
	
	
	}		

?>