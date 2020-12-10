<?php

	require("../../domain/connection.php");
	require("../../domain/Realizada.php");

	class RealizadaProcess {
		var $Rd;

		function doGet($Rd){
			$Rd = new RealizadaDAO();
			$sucess = "use to result to DAO";
			http_response_code(200);
			echo json_encode($sucess);
		}


		function doPost($Rd){
			$Rd = new RealizadaDAO();
			$sucess = "use to result to DAO";
			http_response_code(200);
			echo json_encode($sucess);
		}


		function doPut($Rd){
			$Rd = new RealizadaDAO();
			$sucess = "use to result to DAO";
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