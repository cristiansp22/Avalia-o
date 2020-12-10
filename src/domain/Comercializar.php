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

		function getReponsavel(){
			return $this->reponsavel;
		}
		function setReponsavel($reponsavel){
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
		function create($Comercializar) {
			$result = array();

			try {
				$query = "INSERT INTO Comercializar (default, '".$Comercializar->getLocal()."', '".$Comercializar->getResponsavel()."','".$Comercializar->getTipo()."')";

				$con = new Connection();

				if(Connection::getInstance()->exec($query) >= 1){
					$result["id_com"] = connection::getInstance()->lastInsertId();
					$result["local"] = $local->getLocal();
					$result["responsavel"] = $reponsavel->getReponsavel();
					$result["tipo"] = $tipo>getTipo();
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
					$Comercializar= new Comercializar();
					$Comercializar->setId_com($linha->id_com);
					$Comercializar->setLocal(utf8_encode($linha->local));//(utf8_encode() é para aceitar pontuação 
					$Comercializar->setReponsavel(utf8_encode($linha->responsavel));
					$Comercializar->setTipo($linha->tipo);
					$result[] = $Comercializar;

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
					$Comercializar= new Comercializar();
					$Comercializar->setId_com($linha->id_com);
					$Comercializar->setlocal(utf8_encode($linha->local));
					$Comercializar->setReponsavel(utf8_encode($linha->responsavel));
					$Comercializar->setTipo($linha->tipo);
					$result[] = $Comercializar;
				}

				$con = null;
			}catch(PDOException $e) {
				$result["err"] = $e->getMessage();
			}

			return $result;
		}

		function update($Comercializar) {
			$result = array();
			$id_com = $Comercializar-> getId_com();
			$local = $Comercializar-> getLocal();
			$reponsavel = $Comercializar-> getReponsavel();
			$tipo = $Comercializar-> getTipo();

			try {
				$query = "UPDATE Comercializar SET local = '$local', responsavel = '$responsavel', tipo = '$tipo'  WHERE id_com = $id_com";
				$con = new Connection();

				$status = Connection::getInstance()->prepare($query);

				if($status->execute()){
					$result = $Comercializar;
				}else{
					$result["erro"] = "Não foi possivel atualizar os dados";
				}

				$con = null;
			}catch(PDOException $e) {
				$result["err"] = $e->getMessage();
			}

			return $result;
		}

		function delete( $id_com) {
			$result = array();

			try {
				$query = "DELETE FROM Comercializar WHERE id_com = $id_com";

				$con = new Connection();

				if(Connection::getInstance()->exec($query) >= 1){
					$result["msg"] = "Produto excluido!!!";
				}else{
					$result["Erro"] = "Produto não excluido!!!";
				}

				$con = null;
			}catch(PDOException $e) {
				$result["err"] = $e->getMessage();
			}

			return $result;
		}
	
	}
