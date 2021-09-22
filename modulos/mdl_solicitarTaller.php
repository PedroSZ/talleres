<?php
//******ALTA TALLER
	include_once '../clases/taller.php';
	//include_once '../clases/.php';
	if(!empty($_POST['codigo'])){
		//echo "registrado";

		$taller = new Taller();
		$taller->setCodigo($_POST['codigo']);
		$taller->setNombre($_POST['nombre']);
		$taller->setArea($_POST['area']);
		$taller->setHorario($_POST['horario']);
		$taller->setInstructor($_POST['instructor']);
	//	$taller->setSupervisor($_POST['supervisor']);
		$taller->setEstado($_POST['estado']);


		$taller->guardar();
		header("Location:".$_SERVER['HTTP_REFERER']);//regresa al pagina que estaba
	}
?>
