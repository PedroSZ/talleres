<?php
//******ALTA USUARIO SUPERVISOR (RF-07)
	include_once '../clases/usuario.php';
	include_once '../clases/supervisor.php';
	if(!empty($_POST['codigo'])){
		//echo "registrado";

		$dato = $_POST['codigo'];
		//echo $dato;

		$usuario = new Usuario();
		$use = $usuario->consultarCodigo($dato);
		$dato2 = $use['user_name'];
		//echo $dato2;

		if($dato == $dato2){

			echo '<script type="text/javascript">
								alert("Este usuario no puede ser registrado en la base de datos porque ya se encuentra registrado");
								window.location.href="../regSupervisores.php";
						</script>';
						echo"";

		}else{

		$usuario->setCodigo($_POST['codigo']);
		$usuario->setPsw(md5($_POST['psw1']));
		$usuario->setTipo('1');
		$usuario->guardar();

		$supervisor = new Supervisor();
		$supervisor->setCodigo($_POST['codigo']);
		$supervisor->setNombre($_POST['nombre']);
		$supervisor->setApellidos($_POST['apellidos']);
		$supervisor->setEmail($_POST['email']);
		$supervisor->setTelefono($_POST['telefono']);


		$supervisor->guardar();
		echo '<script type="text/javascript">
							alert("Supervisor registrado con éxito");
							window.location.href="../regSupervisores.php";
					</script>';
		//header("Location:".$_SERVER['HTTP_REFERER']);//regresa al pagina que estaba
	}
	}
?>
