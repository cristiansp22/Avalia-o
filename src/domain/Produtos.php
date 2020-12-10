<?php

	class Produto {
		var $id_produto;
		var $nome;
		var $descricao;
		var $marca;

		function getId_produto(){
			return $this->id_produto;
		}
		function setId_produto($id_produto){
			$this->id_produto = $id_produto;
		}

		function getNome(){
			return $this->nome;
		}
		function setNome($nome){
			$this->nome = $nome;
		}

		function getDescricao(){
			return $this->descricao;
		}
		function setDescricao($descricao){
			$this->descricao = $descricao;
		}

		function getMarca(){
			return $this->marca;
		}
		function setMarca($marca){
			$this->marca = $marca;
		}
	}

	class ProdutosDAO {
		function create($produto) {
			$result = array();

			try {
				$query = "INSERT INTO Produtos VALUES (default, '".$produto->getNome()."', '".$produto->getDescricao()."','".$produto->getMarca()."')";

				$con = new Connection();

				if(Connection::getInstance()->exec($query) >= 1){
					$result["id_produto"] = connection::getInstance()->lastInsertId();
					$result["nome"] = $produto->getNome();
					$result["descricao"] = $produto->getDescricao();
					$result["marca"] = $produto->getMarca();
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
				$query = "SELECT * FROM Produtos ";

				$con = new Connection();

				$resultSet = Connection::getInstance()->query($query);

				while($linha = $resultSet->fetchObject()){
					$produto= new Produto();
					$produto->setId_produto($linha->id_produto);
					$produto->setNome($linha->nome);
					$produto->setDescricao($linha->descricao);
					$produto->setMarca($linha->marca);
					$result[] = $produto;
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
				$query = "SELECT * FROM Produtos WHERE id_produto=$id_produto";

				$con = new Connection();

				$resultSet = Connection::getInstance()->query($query);

				while($linha = $resultSet->fetchObject()){
					$produto= new Produto();
					$produto->setId_produto($linha->id_produto);
					$produto->setNome($linha->nome);
					$produto->setDescricao($linha->descricao);
					$produto->setMarca($linha->marca);
					$result[] = $produto;
				}

				$con = null;
			}catch(PDOException $e) {
				$result["err"] = $e->getMessage();
			}

			return $result;
		}

		function update($produto) {
			$result = array();
			$id_produto = $produto-> getId_produto();
			$nome = $produto-> getNome();
			$descricao = $produto-> getDescricao();
			$marca = $produto-> getMarca();

			try {
				$query = "UPDATE Produtos SET nome = '$nome', descricao = '$descricao', marca = '$marca'  WHERE id_produto = $id_produto";

				$con = new Connection();

				$status = Connection::getInstance()->prepare($query);

				if($status->execute()){
					$result = $produto;
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
				$query = "DELETE FROM produtos WHERE id_produto = $id_produto";

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
