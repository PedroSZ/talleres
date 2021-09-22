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
        if($tipo <> 1) header('location: index.php');
    }
    else{
        $userSession->closeSession();
    }
	/**********************************************************************************************/



  include_once '../clases/cambio.php';
  include_once '../clases/estudiante_por_taller.php';

  $codigo = $_POST['micodigo'];
  if(!empty($_POST['micodigo'])){

    $autorizar = new Cambio();
    $autorizar->setCodigo($_POST['micodigo']);
    $autorizar->consultarSolicitudActual($codigo);
    $modificar = $autorizar->consultarSolicitudActual($codigo);
    $dato1 = $modificar['estudiante'];
    $dato2 = $modificar['taller_actual'];
    $dato3 = $modificar['taller_elegido'];


  $autorizar->setTallerActual($dato3 );
  $autorizar->setTallerElegido($dato2 );
  $autorizar->setEstado('Autorizado');
 $autorizar-> actualizar($codigo);


  $est = new EstudianteTaller();
  echo"$dato1";
  $est->setEstudiante($dato1);
  $est->setTaller($dato3);
  $est->actualizarElegido($codigo);


  header ("Location: ../listSolicitudes.php");
  }
?>
