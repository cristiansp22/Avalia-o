<?php

	require("../process/process.Realizada.php");

	include("configs.php");

	$Rp = new RealizadaProcess();

	switch($_SERVER['REQUEST_METHOD']) {
		case "GET":
			$Rp->doGet($_GET);
			break;

		case "POST":
			$Rp->doPost($_POST);
			break;

		case "PUT":
			$Rp->doPut($_PUT);
			break;

		case "DELETE":
			$Rp->doDelete($_DELETE);
			break;
	}