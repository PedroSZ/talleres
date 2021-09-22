<?php
	include_once '../clases/usuario.php';
	include_once '../clases/estudiante.php';
	$codigo = $_POST['codigo'];
	if(!empty($_POST['codigo'])){


		$usuario = new Usuario();
		$usuario->setCodigo($_POST['codigo']);
		$usuario->setPsw(md5($_POST['psw1']));
		$usuario->setTipo('3');
		$usuario-> actualizar($codigo);

		$est = new Estudiante();
		$est->setCodigo($_POST['codigo']);
		$est->setNombre($_POST['nombre']);
		$est->setApellidos($_POST['apellidos']);
		$est->setCarrera($_POST['carrera']);
		$est->setGrado($_POST['grado']);
		$est->setGrupo($_POST['grupo']);
		$est->actualizar($codigo);
		echo '<script type="text/javascript">
							alert("Datos actualizados con éxito");
							window.location.href="../listActualizarEstudiante.php";
					</script>';

	}
?>
