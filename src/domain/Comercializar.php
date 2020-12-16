<?php

	class Comercializar {
		var $id_com;
		var $local;
		var $reponsavel;
		var $tipo;

		function getId_com(){
			return $this->id_com;
		}
		function setId_com($id_com){
			$this->id_com = $id_com;
		}

		function getLocal(){
			return $this->local;
		}
		function setLocal($local){
			$this->local = $local;
		}

		function getResponsavel(){
			return $this->reponsavel;
		}
		function setResponsavel($reponsavel){
			$this->reponsavel = $reponsavel;
		}

		function getTipo(){
			return $this->tipo;
		}
		function setTipo($tipo){
			$this->tipo = $tipo;
		}
	}

	class ComercializarDAO {
		function create($comercializar) {
			$result = array();

			try {
				$query = "INSERT INTO Comercializar  VALUES (default, '".$comercializar->getLocal()."', '".$comercializar->getResponsavel()."','".$comercializar->getTipo()."')";

				$con = new Connection();

				if(Connection::getInstance()->exec($query) >= 1){
					$result["id_com"] = connection::getInstance()->lastInsertId();
					$result["local"] = $comercializar->getLocal();
					$result["responsavel"] = $comercializar->getResponsavel();
					$result["tipo"] = $comercializar->getTipo();
				}

				$con = null;
			}catch(PDOException $e) {
				$result["err"] = $e->getMessage();
			}

			return $result;
		}

		function readAll() {
			$result = array();

			try {
				$query = "SELECT * FROM Comercializar ";

				$con = new Connection();

				$resultSet = Connection::getInstance()->query($query);

				while($linha = $resultSet->fetchObject()){
					$comercializar= new Comercializar();
					$comercializar->setId_com($linha->id_com);
					$comercializar->setLocal(utf8_encode($linha->local));//(utf8_encode() é para aceitar pontuação 
					$comercializar->setResponsavel(utf8_encode($linha->responsavel));
					$comercializar->setTipo($linha->tipo);
					$result[] = $comercializar;

				}

				$con = null;
			}catch(PDOException $e) {
				$result["err"] = $e->getMessage();
			}

			return $result;
		}

		function read($id_com) {
			$result = array();

			try {
				$query = "SELECT * FROM Comercializar WHERE id_com = $id_com ";

				$con = new Connection();

				$resultSet = Connection::getInstance()->query($query);

				while($linha = $resultSet->fetchObject()){
					$comercializar= new Comercializar();
					$comercializar->setId_com($linha->id_com);
					$comercializar->setlocal(utf8_encode($linha->local));
					$comercializar->setResponsavel(utf8_encode($linha->responsavel));
					$comercializar->setTipo($linha->tipo);
					$result[] = $comercializar;
				}

				$con = null;
			}catch(PDOException $e) {
				$result["err"] = $e->getMessage();
			}

			return $result;
		}

		function update($comercializar) {
			$result = array();
			$id_com = $comercializar-> getId_com();
			$local = $comercializar-> getLocal();
			$responsavel = $comercializar-> getResponsavel();
			$tipo = $comercializar-> getTipo();

			try {
				$query = "UPDATE Comercializar SET local = '$local', responsavel = '$responsavel', tipo = '$tipo'  WHERE id_com = $id_com";
				$con = new Connection();

				$status = Connection::getInstance()->prepare($query);

				if($status->execute()){
					$result = $comercializar;
				}else{
					$result["erro"] = "Não foi possivel atualizar os dados";
					echo $query;
				}

				$con = null;
			}catch(PDOException $e) {
				$result["err"] = $e->getMessage();
			}

			return $result;
		}

		function delete($id_com) {
			$result = array();

			try {
				$query = "DELETE FROM Comercializar WHERE id_com = $id_com";

				$con = new Connection();

				if(Connection::getInstance()->exec($query) >= 1){
					$result["msg"] = "Produto excluido!!!";
				}else{
					$result["Erro"] = "Produto não excluido!!!";
					echo $query;
				}

				$con = null;
			}catch(PDOException $e) {
				$result["err"] = $e->getMessage();
			}

			return $result;
		}
	
	}
