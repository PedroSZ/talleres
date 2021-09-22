<?php
	include_once '../clases/taller.php';
	include_once '../clases/estudiante_por_taller.php';

	if(!empty($_POST['micodigo'])){
		$codigo = $_POST['micodigo'];
	//	echo $codigo;
		//echo "----";
		$taller = new Taller();
		$estudiante = new EstudianteTaller();


		$estudiante-> eliminarPorTaller($codigo);
		$taller-> eliminar($codigo);


		header("Location:".$_SERVER['HTTP_REFERER']);//regresa al pagina que estaba
	}
?>
