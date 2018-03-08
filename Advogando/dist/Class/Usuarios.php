<?php
	
	require_once 'connection.php';
	/**
	* Classe genérica de clientes e fornecedores
	*/
	class Usuarios
	{		
		protected $id;
		protected $nome;
		protected $email;
		protected $senha;
		
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

		public function getEmail(){
			return $this->email;
		}

		public function setEmail($email){
			$this->email = addslashes($email);
		}

		public function getSenha(){
			return $this->senha;
		}	

		public function setSenha($senha){
			$this->senha = addslashes($senha);
		}

		public function login($email, $senha){
			$conn = new Connection();
			$db = $conn->getDb();

			$consulta = $db->prepare("SELECT * FROM USUARIOS WHERE email = ? AND senha = MD5(?)");
			
			$consulta->execute(array($email, $senha));

			return $consulta->fetch();
		}

		public function selectAll(){
			$conn = new Connection();
			$db = $conn->getDb();

			$consulta = $db->query("SELECT * FROM USUARIOS");

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

			$consulta = $db->query("SELECT * FROM USUARIOS WHERE id = ".$id);

			$dados = $consulta->fetch();

			$conn = null;
			$db = null;

			return $dados;
		}

		public function existEmail($email){
			$conn = new Connection();
			$db = $conn->getDb();

			$consulta = $db->prepare("SELECT * FROM USUARIOS WHERE email = ?");

			$consulta->execute(array($email));

			$conn = null;
			$db = null;

			return $consulta->rowCount() == 0;
		}

		public function existEmailId($email, $id){
			$conn = new Connection();
			$db = $conn->getDb();

			$consulta = $db->prepare("SELECT * FROM USUARIOS WHERE email = ? and id = ?");

			$consulta->execute(array($email, $id));

			$conn = null;
			$db = null;

			return $consulta->rowCount() > 0;
		}

		public function insert(){
			$conn = new Connection();
			$db = $conn->getDb();

			$dados = $db->prepare('INSERT INTO USUARIOS (nome, email, senha) VALUES (?, ?, MD5(?))');

			$dados->execute( array($this->getNome(), $this->getEmail(), $this->getSenha()));

			$conn = null;
			$db = null;
		}

		public function update(){
			$conn = new Connection();
			$db = $conn->getDb();

			$dados = $db->prepare('UPDATE USUARIOS SET nome = ?, email = ?, senha = MD5(?) WHERE id = ?');

			$dados->execute( array($this->getNome(), $this->getEmail(), $this->getSenha(), $this->getId()));

			$conn = null;
			$db = null;
		}

		public function delete($id){
			$conn = new Connection();
			$db = $conn->getDb();

			$dados = $db->prepare('DELETE FROM USUARIOS WHERE id = ?');

			$dados->execute( array($id));

			$conn = null;
			$db = null;
		}

		
	}		

?>