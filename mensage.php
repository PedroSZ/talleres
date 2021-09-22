<?php
	/********************** VALIDAMOS QUE ESTA PAGINA SEA PARA LA SESION INICIADA ****************/
    include_once 'clases/usuario.php';
    include_once 'clases/sesion.php';
    $userSession = new Sesion();

    if(isset($_SESSION['user'])){
        $user = new Usuario();
        $user->establecerDatos($userSession->getCurrentUser());
        $tipo = $user->getTipo();
		//mensaje de que no tiene privilegios
        if($tipo <> 3) header('location: index.php');
        /*////////////////////////SIERRE POR INACTIVIDAD/////////////////////////*/
        if (!isset($_SESSION['tiempo'])) {
            $_SESSION['tiempo']=time();
        }
        else if (time() - $_SESSION['tiempo'] > 300) {
            session_destroy();
            header("location: index.php");
            die();
        }
        $_SESSION['tiempo']=time(); //Si hay actividad seteamos el valor al tiempo actual
        /*////////////////////FIN SIERRE POR INACTIVIDAD/////////////////////////*/
    }
    else{
        $userSession->closeSession();
    }
	/**********************************************************************************************/
?>

</!DOCTYPE html>
<html>
    <head>
        <title>Talleres</title>
        <link rel="stylesheet" href="css/main.css" />
        <link rel="stylesheet" href="css/forms.css">

    </head>
    <body>

    <div id="contenedor">
        <!-- Encabezado de la pagina-->
            <?php include_once 'modulos/mdl_header.php'; ?>


        <!-- contenido principal -->
        <section style="text-align: center; margin: 0 auto;">
            <article style="width: 600px; height: 300px; text-align: center; margin: 0 auto;">
            <br>
            <br>
            <br>
      <table border='0'>
      <thead>
      <tr>
      <th style='text-align:center'><h4>Tu petición ha sido enviada, en breve un administrador la validará y podrás ver los cambios reflejados en tu perfil.</h4></th>

      </tr>
      </thead>
      </table>



        <input type="button" onClick="location='menuEstudiante.php'" value="Regresar" />

         </article>
           </section>

        <!-- Pie de pagina-->
            <?php include_once 'modulos/mdl_footer.php'; ?>
    </div>


    </body>
</html>
