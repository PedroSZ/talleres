<?php
	include_once '../clases/usuario.php';
	include_once '../clases/instructor.php';
	include_once '../clases/taller.php';
	include_once '../clases/estudiante_por_taller.php';

	if(!empty($_POST['micodigo'])){
		$codigo = $_POST['micodigo'];

    $estudiante = new EstudianteTaller();
		$instructor = new Instructor();
		$usuario = new Usuario();
		$taller = new Taller();
  $idTaller = $taller->consultarTaller($codigo);
  //echo $idTaller['instructor'];
  //echo "Eliminado: ".$codigo;
	$estudiante-> eliminarPorInstructor($idTaller['instructor']);
	$taller-> eliminarPorInstructor($codigo);
	$instructor-> eliminar($codigo);
	$usuario-> eliminar($codigo);


  header("Location:".$_SERVER['HTTP_REFERER']);//regresa al pagina que estaba
	}
?>
