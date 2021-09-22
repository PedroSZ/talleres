<?php
//******SUBIR CALIFICACION ORIGINAL COPIA
	include_once '../clases/estudiante_por_taller.php';

if(@$_POST['BtnEnviar'])
{
	if(!empty($_POST['seleccionados'])){
		$var = $_POST['mitaller'];
		//echo $var;

		array_map(function($v1, $v2, $v3){
		   /* echo $v1 ;
		    echo $v2 ;
				echo $v3 ;*/
				$calific = new EstudianteTaller();
					$calific->setId($v1);
					$calific->setAsistencia($v3);
					$calific->setCalificacion($v2);
					$calific->calificar();


		}, $_POST['seleccionados'], $_POST['calificacion'], $_POST['asistencia'] /* , Add more arrays if needed manually */);


	}else{
		echo"no ha seleccionado ninguna fila de la tabla";
	}

	echo "<form name='envia' method='POST' action='..\listCalificar.php'>
		<input name='taller' readonly = 'readonly' type='hidden' placeholder='' id='taller' value=$var>
	</form>
	<script language='JavaScript'>
	document.envia.submit();
	</script>";



}
	/*---if(!empty($_POST['micodigo'])){
	$var = $_POST['mitaller'];---*/
	//echo $var;
/*$codigo = $_POST['micodigo'];
$asistencia = $_POST['miasistencia'];
$calificacion = $_POST['micalificacion'];*/



	/*	$calific = new EstudianteTaller();
		$calific->setId($_POST['micodigo']);
		$calific->setAsistencia($_POST['miasistencia']);
		$calific->setCalificacion($_POST['micalificacion']);



$calific->calificar();
echo "<form name='envia' method='POST' action='..\listCalificar.php'>
	<input name='taller' readonly = 'readonly' type='hidden' placeholder='' id='taller' value=$var>
</form>
<script language='JavaScript'>
document.envia.submit();
</script>";

	//header('Location: ../listCalificar.php');//regresa al pagina que estaba
		//header('Location: ../clases/estudiante_por_taller.php');//regresa al pagina que estaba
	}
else{
	echo "post bacio";
}*/
?>

<?php
//******SUBIR CALIFICACION ORIGINAL
/*	include_once '../clases/estudiante_por_taller.php';

	if(!empty($_POST['codigo'])){
		$var = $_POST['taller'];
		echo $var;

		$calific = new EstudianteTaller();
		$calific->setId($_POST['codigo']);
		$calific->setAsistencia($_POST['asistencia']);
		$calific->setCalificacion($_POST['calificacion']);



	$calific->calificar();
	echo "<form name='envia' method='POST' action='..\listCalificar.php'>
	<input name='taller' readonly = 'readonly' type='hidden' placeholder='' id='taller' value=$var>
</form>
<script language='JavaScript'>
document.envia.submit();
</script>";

	//header('Location: ../listCalificar.php');//regresa al pagina que estaba
		//header('Location: ../clases/estudiante_por_taller.php');//regresa al pagina que estaba
	}*/

?>
