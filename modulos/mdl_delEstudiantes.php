<?php
	include_once '../clases/usuario.php';
	include_once '../clases/estudiante.php';
	include_once '../clases/estudiante_por_taller.php';
	include_once '../clases/reporte.php';

	if(!empty($_POST['micodigo'])){
		$codigo = $_POST['micodigo'];

		$reporte = new Reporte();
		$estudiante = new EstudianteTaller();
		$alumno = new Estudiante();
		$usuario = new Usuario();

		$reporte-> eliminar($codigo);
	  $estudiante-> eliminar($codigo);
		$alumno-> eliminar($codigo);
		$usuario-> eliminar($codigo);



		header("Location:".$_SERVER['HTTP_REFERER']);//regresa al pagina que estaba
	}
?>
