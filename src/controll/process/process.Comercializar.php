<?php

	require("../../domain/connection.php");
	require("../../domain/Comercializar.php");

	class ComercializarProcess {
		var $Cd;

		function doGet($arr){
			$Cd = new ComercializarDAO();
			if($arr['id_com'] != 0){
				$sucess = $Cd->read($arr['id_com']);
			}else{// Igual a zero
				$sucess = $Cd->readAll();
			}
			
			http_response_code(200);
			echo json_encode($sucess);
		}


		function doPost($arr){
			$Cd = new ComercializarDAO();
			$Cd = new Comercializar();
			$Comercializar =new Comercializar();
			$Comercializar->setlocal($arr["local"]);
			$Comercializar->setResponsavel($arr["responsavel"]);
			$Comercializar->setTipo($arr["tipo"]);
			$sucess = $Cd->create($Comercializar);	
			http_response_code(200);
			echo json_encode($sucess);
		}


		function doPut($arr){
			$Cd = new ComercializarDAO();
			$Cd = new Comercializar();
			$Comercializar =new Comercializar();
			$Comercializar->setlocal($arr["local"]);
			$Comercializar->setResponsavel($arr["responsavel"]);
			$Comercializar->setTipo($arr["tipo"]);
			$sucess = $Cd->update($Comercializar);	
			http_response_code(200);
			echo json_encode($sucess);
		}


		function doDelete($arr){
			$PCdd = new ProdutosDAO();
		    $sucess = $Cd->delete($arr["id_com"]);
			http_response_code(200);
			echo json_encode($sucess);
		}
	}