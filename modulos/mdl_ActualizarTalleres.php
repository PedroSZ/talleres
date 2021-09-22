<?php
	include_once '../clases/taller.php';
	$codigo = $_POST['codigo'];
	if(!empty($_POST['codigo'])){



		$taller = new Taller();
		$taller->setCodigo($_POST['codigo']);
		$taller->setNombre($_POST['nombre']);
		$taller->setArea($_POST['area']);
		$taller->setHorario($_POST['horario']);
		$taller->setInstructor($_POST['instructor']);
		$taller->setSupervisor($_POST['supervisor']);
		$taller->setEstado($_POST['estado']);

		$taller->actualizar($codigo);
		echo '<script type="text/javascript">
							alert("Datos actualizados con éxito");
							window.location.href="../listActualizarTaller.php";
					</script>';

		
	}
?>
