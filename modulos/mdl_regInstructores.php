<?php
//******ALTA USUARIO INSTRUCTOR (RF-07)
	include_once '../clases/usuario.php';
	include_once '../clases/instructor.php';
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
								window.location.href="../regInstructores.php";
						</script>';
	        	echo"";

		}else{
		$usuario->setCodigo($_POST['codigo']);
		$usuario->setPsw(md5($_POST['psw1']));
		$usuario->setTipo('2');
		$usuario->guardar();

		$instructor = new Instructor();
		$instructor->setCodigo($_POST['codigo']);
		$instructor->setNombre($_POST['nombre']);
		$instructor->setApellidos($_POST['apellidos']);
		$instructor->setEmail($_POST['email']);
		$instructor->setTelefono($_POST['telefono']);


		$instructor->guardar();
		echo '<script type="text/javascript">
							alert("Instructor registrado con éxito");
							window.location.href="../regInstructores.php";
					</script>';
		//header("Location:".$_SERVER['HTTP_REFERER']);//regresa al pagina que estaba
	}
}
?>
