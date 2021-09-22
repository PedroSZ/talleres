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
	if(!empty($_POST['micodigo'])){
		//echo "registrado";
		$estudiantetaller = new EstudianteTaller();
		$estudiantetaller->setEstudiante($codigo);
		$estudiantetaller->setTaller($_POST['micodigo']);
    $estudiantetaller->setAsistencia('0');
    $estudiantetaller->setCalificacion('No asignada');
		$estudiantetaller->guardar();
		//echo'Registro con exito';
		header('Location: ../PerfilEstudiante.php');//regresa al pagina que estaba
	}

?>
