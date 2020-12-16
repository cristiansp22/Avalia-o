<?php

	require("../../domain/connection.php");
	require("../../domain/Produtos.php");

	class ProdutosProcess {
		var $Pd;

		function doGet($arr){
			$Pd = new ProdutosDAO();
			if(isset($arr['id_produto']) && $arr['id_produto'] != 0){
				$sucess = $Pd->read($arr['id_produto']);
			}else{// Igual a zero
				$sucess = $Pd->readAll();
			}
			
			http_response_code(200);
			echo json_encode($sucess);
		}


		function doPost($arr){
			$Pd = new ProdutosDAO();
			$produto =new Produto();
			$produto->setNome($arr["nome"]);
			$produto->setDescricao($arr["descricao"]);
			$produto->setMarca($arr["marca"]);
			$sucess = $Pd->create($produto);
			http_response_code(200);
			echo json_encode($sucess);
		}


		function doPut($arr){
			$Pd = new ProdutosDAO();
			$produto = new Produto();
			$produto->setId_produto($arr['id_produto']);
			$produto->setNome($arr['nome']);
			$produto->setDescricao($arr['descricao']);
			$produto->setMarca($arr['marca']);
			$sucess = $Pd->update($produto);
			http_response_code(200);
			echo json_encode($sucess);
		}


		function doDelete($arr){
			$Pd = new ProdutosDAO();
		    $sucess = $Pd->delete($arr["id_produto"]);			
			http_response_code(200);
			echo json_encode($sucess);
		}
	}