<?php
//******ALTA USUARIO ESTUDIANTE (RF-07)
	include_once '../clases/reporte.php';
	include_once '../clases/estudiante_por_taller.php';//new

if(!empty($_POST['autor'])){
		//echo "registrado";
	   $dato = $_POST['reportado'];
			//echo $dato;

			$estTaller = new EstudianteTaller();
			$tallerEst = $estTaller->consultarEstudiante($dato);
			$dato2 = $tallerEst['taller'];
			//echo $dato2;

		$reporte = new Reporte();
		//$reporte->setClave($_POST['clave']);
		$reporte->setTitulo($_POST['titulo']);
		$reporte->setDescripcion($_POST['descripcion']);
		$reporte->setAutor($_POST['autor']);
		$reporte->setReportado($_POST['reportado']);


		$reporte->guardar();
		echo "<form name='envia' method='POST' action='../listReportar.php'>
		<input name='taller' readonly = 'readonly' type='hidden' placeholder='' id='taller' value=$dato2>
	</form>
	<script language='JavaScript'>
	document.envia.submit();
	</script>";
	//	header('Location: ../listReportar.php');//regresa al pagina que estaba
	}
?>
