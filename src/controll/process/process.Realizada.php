<?php

	require("../../domain/connection.php");
	require("../../domain/Realizada.php");

	class RealizadaProcess {
		var $Rd;

		function doGet($arr){
			$Rd = new RealizadaDAO();
			
			if(isset($arr['id_produto']) && $arr['id_produto'] != 0){
				$sucess = $Rd->read($arr['id_produto']);
			}else{// Igual a zero
				$sucess = $Rd->readAll();
			}
			http_response_code(200);
			echo json_encode($sucess);
		}


		function doPost($arr){
			$Rd = new RealizadaDAO();
			$realizada =new Realizada();
			$realizada->setId_produto($arr["id_produto"]);
			$realizada->setId_com($arr["id_com"]);
			$realizada->setPreco($arr["preco"]);
			$realizada->setQuantidade($arr["quantidade"]);
			$sucess = $Rd->create($realizada);
			http_response_code(200);
			echo json_encode($sucess);
		}


		function doPut($arr){
			$Rd = new RealizadaDAO();
			$realizada =new Realizada();
			$realizada->setId_produto($arr["id_produto"]);
			$realizada->setId_com($arr["id_com"]);
			$realizada->setPreco($arr["preco"]);
			$realizada->setQuantidade($arr["quantidade"]);
			$sucess = $Rd->update($realizada);
			http_response_code(200);
			echo json_encode($sucess);
		}


		function doDelete($arr){
			$Rd = new RealizadaDAO();
			$sucess = $Rd->delete($arr["id_produto"]);
			http_response_code(200);
			echo json_encode($sucess);
		}
	}