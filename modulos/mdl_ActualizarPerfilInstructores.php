<?php
	include_once '../clases/usuario.php';
	include_once '../clases/instructor.php';
	$codigo = $_POST['codigo'];
	if(!empty($_POST['codigo'])){


		$usuario = new Usuario();
		$usuario->setCodigo($_POST['codigo']);
		$usuario->setPsw(md5($_POST['psw1']));
		$usuario->setTipo('2');
		$usuario-> actualizar($codigo);

		$est = new Instructor();
		$est->setCodigo($_POST['codigo']);
		$est->setNombre($_POST['nombre']);
		$est->setApellidos($_POST['apellidos']);
		$est->setEmail($_POST['email']);
		$est->setTelefono($_POST['telefono']);
		$est->actualizar($codigo);

		echo '<script type="text/javascript">
							alert("Datos actualizados con éxito");
							window.location.href="../actualizarPerfilInstructor.php";
					</script>';

		//header ("Location: ../actualizarPerfilInstructor.php");
	}
?>
