<?php
	include_once '../clases/usuario.php';
	include_once '../clases/supervisor.php';
	include_once '../clases/reporte.php';

	if(!empty($_POST['micodigo'])){
		$codigo = $_POST['micodigo'];

		$supervisor = new Supervisor();
		$usuario = new Usuario();
		$reporte = new Reporte();


		//echo "Eliminado: ".$codigo;
		$reporte-> eliminarRep($codigo);
		$supervisor-> eliminar($codigo);
		$usuario-> eliminar($codigo);

		header("Location:".$_SERVER['HTTP_REFERER']);//regresa al pagina que estaba
	}
?>
