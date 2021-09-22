<?php
//******ALTA USUARIO ESTUDIANTE (RF-07)
	include_once '../clases/usuario.php';
	include_once '../clases/estudiante.php';


	if(!empty($_POST['codigo'])){
		//echo "registrado";
		$dato = $_POST['codigo'];
	//	echo $dato;

		$usuario = new Usuario();
		$use = $usuario->consultarCodigo($dato);
		$dato2 = $use['user_name'];
		//echo $dato2;

		if($dato == $dato2){

			echo '<script type="text/javascript">
								alert("Este usuario no puede ser registrado en la base de datos porque ya se encuentra registrado");
								window.location.href="../regEstudiantes.php";
						</script>';


		}else{



			$usuario->setCodigo($_POST['codigo']);
			$usuario->setPsw(md5($_POST['psw1']));
			$usuario->setTipo('3');
			$usuario->guardar();


			$alumno = new Estudiante();
			$alumno->setCodigo($_POST['codigo']);
			$alumno->setNombre($_POST['nombre']);
			$alumno->setApellidos($_POST['apellidos']);
			$alumno->setCarrera($_POST['carrera']);
			$alumno->setGrado($_POST['grado']);
			$alumno->setGrupo($_POST['grupo']);


			$alumno->guardar();
			echo '<script type="text/javascript">
								alert("Estudiante registrado con éxito");
								window.location.href="../regEstudiantes.php";
						</script>';

			//header("Location:".$_SERVER['HTTP_REFERER']);//regresa al pagina que estaba
		}
//header("Location:".$_SERVER['HTTP_REFERER']);//regresa al pagina que estaba


	}
?>
