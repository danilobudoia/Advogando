<?php
	
	require_once 'connection.php';
	/**
	* Classe genérica de Clientes
	*/
	class Clientes
	{		
		protected $id;
		protected $repres_id;
		protected $tipo;
		protected $nome;
		protected $documento1;
		protected $documento2;
		protected $data_nasc;
		protected $sexo;
		protected $telefone;
		protected $celular;
		protected $email;
		protected $endereco;
		protected $numero;
		protected $complemento;
		protected $cidade;
		protected $estado;
		protected $cep;
		protected $observacao;
		protected $status;
		
		public function getId(){
			return $this->id;
		}

		public function setId($id){
			$this->id = addslashes($id);
		}

	    public function getRepresId(){
	        return $this->repres_id;
	    }

	    public function setRepresId($repres_id){
			$this->repres_id = addslashes($repres_id);
	    }

	    public function getTipo(){
	        return $this->tipo;
	    }

	    public function setTipo($tipo){
			$this->tipo = addslashes($tipo);
	    }

		public function getNome(){
			return $this->nome;
		}

		public function setNome($nome){
			$this->nome = addslashes($nome);
		}

		public function getDocumento1(){
			return $this->documento1;
		}

		public function setDocumento1($documento1){
			$this->documento1 = addslashes($documento1);
		}

		public function getDocumento2(){
			return $this->documento2;
		}

		public function setDocumento2($documento2){
			$this->documento2 = addslashes($documento2);
		}

		public function getDataNasc(){
			return $this->data_nasc;
		}	

		public function setDataNasc($data_nasc){
			$this->data_nasc = addslashes($data_nasc);
		}

	    public function getSexo(){
	        return $this->sexo;
	    }

	    public function setSexo($sexo){
			$this->sexo = addslashes($sexo);
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

		public function getEndereco(){
	        return $this->endereco;
	    }

	    public function setEndereco($endereco){
			$this->endereco = addslashes($endereco);
	    }

	    public function getNumero(){
	        return $this->numero;
	    }

	    public function setNumero($numero){
			$this->numero = addslashes($numero);
	    }

	    public function getComplemento(){
	        return $this->complemento;
	    }

	    public function setComplemento($complemento){
			$this->complemento = addslashes($complemento);
	    }

	    public function getCidade(){
	        return $this->cidade;
	    }

	    public function setCidade($cidade){
			$this->cidade = addslashes($cidade);
	    }

	    public function getEstado(){
	        return $this->estado;
	    }

	    public function setEstado($estado){
			$this->estado = addslashes($estado);
	    }

	    public function getCep(){
	        return $this->cep;
	    }

	    public function setCep($cep){
			$this->cep = addslashes($cep);
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

			$consulta = $db->query("SELECT * FROM CLIENTES WHERE status = 1 ORDER BY nome");

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

			//$consulta = $db->query("SELECT * FROM CLIENTES WHERE id = ".$id);
			$consulta = $db->query("SELECT C.id, C.repres_id, C.tipo, C.nome, C.documento1, C.documento2, C.data_nasc, C.sexo, C.telefone, C.celular, C.email, C.endereco, C.numero, C.complemento, C.cidade, C.estado, C.cep, C.observacao, C.status, R.id as r_id, R.nome as r_nome, R.documento as r_documento, R.telefone as r_telefone, R.celular as r_celular, R.email as r_email, R.observacao as r_observacao, 
				(SELECT GROUP_CONCAT(CP.processo_id) FROM CLIENTE_PROCESSO CP WHERE CP.cliente_id = ".$id.") as lista_processo,
				(SELECT GROUP_CONCAT(P.numero) FROM PROCESSOS P INNER JOIN CLIENTE_PROCESSO CP ON P.id = CP.processo_id INNER JOIN CLIENTES C ON CP.cliente_id = C.id WHERE C.id = ".$id.") as lista_numero
				FROM CLIENTES C 
				LEFT JOIN REPRESENTANTES R ON repres_id = r.id 
				WHERE C.id = ".$id);

			$dados = $consulta->fetch();

			$conn = null;
			$db = null;

			return $dados;
		}
		
		public function selectNomeId($term){
			$conn = new Connection();
			$db = $conn->getDb();

			$consulta = $db->query("SELECT id, nome FROM CLIENTES WHERE nome LIKE '%".$term."%' AND status = 1 Order By nome LIMIT 5");

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

			$dados = $db->prepare('INSERT INTO CLIENTES (repres_id, tipo, nome, documento1, documento2, data_nasc, sexo, telefone, celular, email, endereco, numero, complemento, cidade, estado, cep, observacao, status)
				VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, 1)');

			if ($this->getRepresId() == "") {
				$dados->execute( array( null, $this->getTipo(), $this->getNome(), $this->getDocumento1(), $this->getDocumento2(), $this->getDataNasc(),  $this->getSexo(), $this->getTelefone(), $this->getCelular(), $this->getEmail(), $this->getEndereco(), $this->getNumero(), $this->getComplemento(), $this->getCidade(), $this->getEstado(), $this->getCep(), $this->getObservacao()));
			} else {
				$dados->execute( array( $this->getRepresId(), $this->getTipo(), $this->getNome(), $this->getDocumento1(), $this->getDocumento2(), $this->getDataNasc(),  $this->getSexo(), $this->getTelefone(), $this->getCelular(), $this->getEmail(), $this->getEndereco(), $this->getNumero(), $this->getComplemento(), $this->getCidade(), $this->getEstado(), $this->getCep(), $this->getObservacao()));
			}

			$conn = null;
			$db = null;
		}

		public function update(){
			$conn = new Connection();
			$db = $conn->getDb();

			$dados = $db->prepare('UPDATE CLIENTES SET repres_id = ?, tipo = ?, nome = ?, documento1 = ?, documento2 = ?, data_nasc = ?, sexo = ?,  telefone = ?, celular = ?, email = ?,  endereco = ?, numero = ?, complemento = ?, cidade = ?, estado = ?, cep = ?, observacao = ? WHERE id = ?');

			if ($this->getRepresId() == "") {
				$dados->execute( array( null, $this->getTipo(), $this->getNome(), $this->getDocumento1(), $this->getDocumento2(), $this->getDataNasc(),  $this->getSexo(), $this->getTelefone(), $this->getCelular(), $this->getEmail(), $this->getEndereco(), $this->getNumero(), $this->getComplemento(), $this->getCidade(), $this->getEstado(), $this->getCep(), $this->getObservacao(), $this->getId()));
			} else {
				$dados->execute( array( $this->getRepresId(), $this->getTipo(), $this->getNome(), $this->getDocumento1(), $this->getDocumento2(), $this->getDataNasc(),  $this->getSexo(), $this->getTelefone(), $this->getCelular(), $this->getEmail(), $this->getEndereco(), $this->getNumero(), $this->getComplemento(), $this->getCidade(), $this->getEstado(), $this->getCep(), $this->getObservacao(), $this->getId()));
			}

			$conn = null;
			$db = null;
		}

		public function delete($id){
			$conn = new Connection();
			$db = $conn->getDb();

			$dados = $db->prepare('UPDATE CLIENTES SET status = 0 WHERE id = ?');

			$dados->execute( array($id));
			
			$conn = null;
			$db = null;
		}

		public function selectFinalizados(){
			$conn = new Connection();
			$db = $conn->getDb();

			$consulta = $db->query("SELECT * FROM CLIENTES WHERE status = 0");

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

			$dados = $db->prepare('UPDATE CLIENTES SET status = 1 WHERE id = ?');

			$dados->execute( array($id));
			
			$conn = null;
			$db = null;
		}
		
	
	}		

?>