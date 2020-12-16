<?php

	require("../../domain/connection.php");
	require("../../domain/Comercializar.php");

	class ComercializarProcess {
		var $Cd;

		function doGet($arr){
			$Cd = new ComercializarDAO();
			if(isset($arr['id_com']) && $arr['id_com'] != 0){
				$sucess = $Cd->read($arr['id_com']);
			}else{// Igual a zero
				$sucess = $Cd->readAll();
			}
			
			http_response_code(200);
			echo json_encode($sucess);
		}


		function doPost($arr){
			$Cd = new ComercializarDAO();
			$comercializar =new Comercializar();
			$comercializar->setLocal($arr["local"]);
			$comercializar->setResponsavel($arr["responsavel"]);
			$comercializar->setTipo($arr["tipo"]);
			$sucess = $Cd->create($comercializar);	
			http_response_code(200);
			echo json_encode($sucess);
		}


		function doPut($arr){
			$Cd = new ComercializarDAO();
			$comercializar =new Comercializar();
			$comercializar->setId_com($arr['id_com']);
			$comercializar->setLocal($arr["local"]);
			$comercializar->setResponsavel($arr["responsavel"]);
			$comercializar->setTipo($arr["tipo"]);
			$sucess = $Cd->update($comercializar);	
			http_response_code(200);
			echo json_encode($sucess);
		}


		function doDelete($arr){
			$Cd = new ComercializarDAO();
		    $sucess = $Cd->delete($arr["id_com"]);
			http_response_code(200);
			echo json_encode($sucess);
		}
	}