<?php
	/********************** VALIDAMOS QUE ESTA PAGINA SEA PARA LA SESION INICIADA ****************/
    include_once '../clases/usuario.php';
    include_once '../clases/sesion.php';
    $userSession = new Sesion();

    if(isset($_SESSION['user'])){
        $user = new Usuario();
        $user->establecerDatos($userSession->getCurrentUser());
        $tipo = $user->getTipo();
		$codigo = $user->getCodigo();
		//echo($codigo);
        if($tipo <> 3) header('location: index.php');
    }
    else{
        $userSession->closeSession();
    }
	/**********************************************************************************************/


  include_once '../clases/estudiante_por_taller.php';
  $taller = new EstudianteTaller();
  $estudiantesTaller = $taller->consultarTallerActual($codigo);
  $dato = $estudiantesTaller['taller'];
	echo ($dato);

	include_once '../clases/cambio.php';
	if(!empty($_POST['micodigo'])){
		//echo "registrado";
		$estudiantetaller = new Cambio();
		$estudiantetaller->setEstudiante($codigo);
		$estudiantetaller->setTallerActual($dato);
		$estudiantetaller->setTallerElegido($_POST['micodigo']);

		$estudiantetaller->guardar();
		//echo'Registro con exito';
		header('Location: ../mensage.php');//regresa al pagina que estaba
	}

?>
