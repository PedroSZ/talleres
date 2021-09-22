<?php
include_once 'clases/usuario.php';
include_once 'clases/sesion.php';
$userSession = new Sesion(); //INICIA EL SESION START

if(isset($_SESSION['user'])){
    $user = new Usuario();//******AUTENTICAR USUARIOS (RF-01) (RF-02) (RF-03)
   	$user->establecerDatos($userSession->getCurrentUser());
    switch ($user->getTipo()) {
    	case '1': header('location: menuAdmin.php');		break;
    	case '2': header('location: menuInstructor.php');	break;
    	case '3': header('location: menuEstudiante.php');	break;
		
		
	}
}else if(isset($_POST['codigo']) && isset($_POST['password'])){
    $userForm = $_POST['codigo'];
    $passForm = $_POST['password'];
    $user = new Usuario();
    if($user->verificarPsw($userForm, $passForm)){
        //echo "Existe el usuario";
        $userSession->setCurrentUser($userForm);
        $user->establecerDatos($userForm);
    switch ($user->getTipo()) {
    	case '1': header('location: menuAdmin.php');		break;
    	case '2': header('location: menuInstructor.php');	break;
    	case '3': header('location: menuEstudiante.php');	break;
	
    	
    	//default:header('location: ../index.php');				break;
    }
    }else{
        //echo "No existe el usuario";
        $alert = "Nombre de usuario y/o password incorrecto";
    }
}else{
    	$alert = "";
}
?>