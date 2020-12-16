<?php

	class Realizada {
		var $preco;
		var $quantidade;
		var $id_produto;
		var $id_com;


		function getPreco(){
			return $this->preco;
		}
		function setPreco($preco){
			$this->preco = $preco;
		}

		function getQuantidade(){
			return $this->quantidade;
		}
		function setQuantidade($quantidade){
			$this->quantidade = $quantidade;
		}
		function getId_produto(){
			return $this->id_produto;
		}
		function setId_produto($id_produto){
			$this->id_produto = $id_produto;
		}
		function getId_com(){
			return $this->id_com;
		}
		function setId_com($id_com){
			$this->id_com = $id_com;
		}
	}

	class RealizadaDAO {
		function create($realizada) {
			$result = array();

			try {
				$query = "INSERT INTO Realizada VALUES (".$realizada->getId_produto().", ".$realizada->getId_com().", ".$realizada->getPreco().",".$realizada->setQuantidade().")";
				echo $query;
				$con = new Connection();

				if(Connection::getInstance()->exec($query) >= 1){
					$result["id_produto"] = connection::getInstance()->last000InsertId();
					$result["id_com"] = connection::getInstance()->lastInsertId();
					$result["preco"] = $realizada->getPreco();
					$result["quantidade"] = $realizada->getQuantidade();
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
				$query = "SELECT * FROM Realizada ";

				$con = new Connection();

				$resultSet = Connection::getInstance()->query($query);

				while($linha = $resultSet->fetchObject()){
					$realizada= new Realizada();
					$realizada->setId_produto($linha->id_produto);
					$realizada->setId_com($linha->id_com);
					$realizada->setPreco($linha->preco);
					$realizada->setQuantidade($linha->quantidade);
					$result[] = $realizada;
				}

				$con = null;
			}catch(PDOException $e) {
				$result["err"] = $e->getMessage();
			}

			return $result;
		}

		function read($id_produto) {
			$result = array();

			try {
				$query = "SELECT * FROM Realizada WHERE id_produto=$id_produto ";

				$con = new Connection();

				$resultSet = Connection::getInstance()->query($query);

				while($linha = $resultSet->fetchObject()){
					$realizada= new Realizada();
					$realizada->setId_produto($linha->id_produto);
					$realizada->setId_com($linha->id_com);
					$realizada->setPreco($linha->preco);
					$realizada->setQuantidade($linha->quantidade);
					$result[] = $realizada;
				}

				$con = null;
			}catch(PDOException $e) {
				$result["err"] = $e->getMessage();
			}

			return $result;
		}


		function update($realizada) {
			$result = array();
			$id_produto = $realizada-> getId_produto();
			$id_com = $realizada-> getId_com();
			$preco = $realizada-> getPreco();
			$quantidade = $realizada-> getQuantidade();

			try {
				$query = "UPDATE Realizada SET id_produto = '$id_produto', id_com = '$id_com',  quantidade = '$quantidade ', preco = '$preco'";

				$con = new Connection();

				$status = Connection::getInstance()->prepare($query);

				if($status->execute()){
					$result = $realizada;
				}else{
					$result["erro"] = "Não foi possivel atualizar os dados";
				}

				$con = null;
			}catch(PDOException $e) {
				$result["err"] = $e->getMessage();
			}

			return $result;
		}

		function delete($id_produto) {
			$result = array();

			try {
				$query = "DELETE FROM Realizada WHERE id_produto = $id_produto";

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
