<?php
	
	require_once 'connection.php';
	/**
	* Classe genérica de clientes e fornecedores
	*/
	class ClienteProcesso
	{	
		protected $cliente_id;
		protected $processo_id;
		
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

		public function insertCliente(){	
			$conn = new Connection();
			$db = $conn->getDb();

			$dados = $db->prepare('INSERT INTO CLIENTE_PROCESSO (cliente_id, processo_id) 
				VALUES ((SELECT MAX(ID) FROM CLIENTES), ?)');

			$dados->execute( array($this->getProcessoId()));

			$conn = null;
			$db = null;
		}

		public function insertProcesso(){	
			$conn = new Connection();
			$db = $conn->getDb();

			$dados = $db->prepare('INSERT INTO CLIENTE_PROCESSO (cliente_id, processo_id) 
				VALUES (?, (SELECT MAX(ID) FROM PROCESSOS))');

			$dados->execute( array($this->getClienteId()));

			$conn = null;
			$db = null;
		}

		public function updateCliente($id){
			$conn = new Connection();
			$db = $conn->getDb();

			$dados = $db->prepare('INSERT INTO CLIENTE_PROCESSO (cliente_id, processo_id) 
				VALUES (?, ?)');

			$dados->execute( array($id, $this->getProcessoId()));

			$conn = null;
			$db = null;
		}

		public function updateProcesso($id){
			$conn = new Connection();
			$db = $conn->getDb();

			$dados = $db->prepare('INSERT INTO CLIENTE_PROCESSO (cliente_id, processo_id) 
				VALUES (?, ?)');

			$dados->execute( array($this->getClienteId(), $id));

			$conn = null;
			$db = null;
		}

		public function deleteCliente($id){
			$conn = new Connection();
			$db = $conn->getDb();

			$dados = $db->prepare('DELETE FROM CLIENTE_PROCESSO WHERE cliente_id = ?');

			$dados->execute( array($id));

			$conn = null;
			$db = null;
		}
		
		public function deleteProcesso($id){
			$conn = new Connection();
			$db = $conn->getDb();

			$dados = $db->prepare('DELETE FROM CLIENTE_PROCESSO WHERE processo_id = ?');

			$dados->execute( array($id));

			$conn = null;
			$db = null;
		}


		
	}		

?>