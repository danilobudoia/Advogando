<?php
	
	require_once 'connection.php';
	/**
	* Classe genérica de Processos
	*/
	class Processos
	{		
		protected $id;
		protected $numero;
		protected $nome;
		protected $natureza;
		protected $data_inicio;
		protected $situacao;
		protected $observacao;
		protected $status;

		public function getId(){
			return $this->id;
		}

		public function setId($id){
			$this->id = addslashes($id);
		}

		public function getNumero(){
			return $this->numero;
		}

		public function setNumero($numero){
			$this->numero = addslashes($numero);
		}

		public function getNome(){
			return $this->nome;
		}

		public function setNome($nome){
			$this->nome = addslashes($nome);
		}

		public function getNatureza(){
			return $this->natureza;
		}

		public function setNatureza($natureza){
			$this->natureza = addslashes($natureza);
		}

		public function getDataInicio(){
			return $this->data_inicio;
		}	

		public function setDataInicio($data_inicio){
			$this->data_inicio = addslashes($data_inicio);
		}

		public function getSituacao(){
			return $this->situacao;
		}

		public function setSituacao($situacao){
			$this->situacao = addslashes($situacao);
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

			$consulta = $db->query("SELECT * FROM PROCESSOS WHERE status = 1");

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

			$consulta = $db->query("SELECT *, 
				(SELECT GROUP_CONCAT(CP.cliente_id) FROM CLIENTE_PROCESSO CP WHERE CP.processo_id = ".$id.") AS lista_cliente, 
				(SELECT GROUP_CONCAT(C.nome) FROM CLIENTES C INNER JOIN CLIENTE_PROCESSO CP ON C.id = CP.cliente_id INNER JOIN PROCESSOS P ON CP.processo_id = P.id WHERE P.id = ".$id.") AS lista_nome,
				(SELECT GROUP_CONCAT(D.id) FROM DOCUMENTOS D WHERE D.processo_id = ".$id.") AS lista_documento, 
				(SELECT GROUP_CONCAT(D.observacao) FROM DOCUMENTOS D WHERE D.processo_id = ".$id.") AS lista_doc_obs 
				FROM PROCESSOS WHERE id = ".$id);

			$dados = $consulta->fetch();

			$conn = null;
			$db = null;

			return $dados;
		}

		public function selectNumeroId($term){
			$conn = new Connection();
			$db = $conn->getDb();

			$consulta = $db->query("SELECT id, numero FROM PROCESSOS WHERE numero LIKE '%".$term."%' AND status = 1 Order By numero LIMIT 5");

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

			$dados = $db->prepare('INSERT INTO PROCESSOS (numero, nome, natureza, data_inicio, situacao, observacao, status)
			VALUES (?, ?, ?, ?, ?, ?, 1)');

			$dados->execute( array($this->getNumero(), $this->getNome(), $this->getNatureza(), $this->getDataInicio(), $this->getSituacao(), $this->getObservacao()));

			$conn = null;
			$db = null;
		}

		public function update(){
			$conn = new Connection();
			$db = $conn->getDb();

			$dados = $db->prepare('UPDATE PROCESSOS SET numero = ?, nome = ?, natureza = ?, data_inicio = ?, situacao = ?, observacao = ? WHERE id = ?');

			$dados->execute( array($this->getNumero(), $this->getNome(), $this->getNatureza(), $this->getDataInicio(), $this->getSituacao(), $this->getObservacao(), $this-> getId()));

			$conn = null;
			$db = null;
		}

		public function delete($id){
			$conn = new Connection();
			$db = $conn->getDb();

			$dados = $db->prepare('UPDATE PROCESSOS SET status = 0, situacao = CURRENT_DATE WHERE id = ?');

			$dados->execute( array($id));

			$conn = null;
			$db = null;
		}
		
		public function selectFinalizados(){
			$conn = new Connection();
			$db = $conn->getDb();

			$consulta = $db->query("SELECT * FROM PROCESSOS WHERE status = 0");

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

			$dados = $db->prepare('UPDATE PROCESSOS SET status = 1, situacao = "Reaberto" WHERE id = ?');

			$dados->execute( array($id));
			
			$conn = null;
			$db = null;
		}

		// FUNÇÕES PARA GERAR GRAFICO - INDEX.PHP

		public function contarConcluidos(){
			$conn = new Connection();
			$db = $conn->getDb();
			$consulta = $db->query("SELECT COUNT(*) FROM PROCESSOS WHERE status = 0");
			$dados = $consulta->fetch();
			$conn = null;
			$db = null;
			return $dados;
		}
		
		public function contarEmAndamento(){
			$conn = new Connection();
			$db = $conn->getDb();
			$consulta = $db->query("SELECT COUNT(*) FROM PROCESSOS WHERE status = 1");
			$dados = $consulta->fetch();
			$conn = null;
			$db = null;
			return $dados;
		}
		
	}			

?>