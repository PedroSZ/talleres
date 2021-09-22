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
        <title>Taller</title>
        <link rel="stylesheet" href="css/main.css"/>
        <link rel="stylesheet" href="css/forms.css">
        <script language='javascript'>
            function regresar(){
            location.href='index.php'
            }
        </script>
        <meta charset="UTF-8">

    </head>
    <body>
        <center>
            <div id="contenedor">
      <!-- Encabezado de la pagina-->
          <?php include_once 'modulos/mdl_header.php'; ?>
      <!-- contenido principal -->

      <section style="text-align: center; margin: 0 auto; height: 65%">
          <article style="width:40%; height: 100%;text-align: center; margin: 0 auto;">
                 <div class="datagrid">
                   <h1>Lo sentimos por el momento usted no cuenta con la calificación suficiente para obtener su constancia o no ha aprobado el taller aún.</h1>

                 <img src="imgs/alto.jpg" border="1" alt="imagen no encontrada" width="80%" height="80%">

                </section>

<input type="button" onClick="location='menuEstudiante.php'" value="Regresar" />
        <!-- Pie de pagina-->
            <?php include_once 'modulos/mdl_footer.php'; ?>

    </div>
  </center>
  </div>
    </body>
</html>
