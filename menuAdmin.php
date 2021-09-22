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
        if($tipo <> 1) header('location: index.php');
        /*////////////////////////SIERRE POR INACTIVIDAD/////////////////////////*/
        if (!isset($_SESSION['tiempo'])) {
            $_SESSION['tiempo']=time();
        }
        else if (time() - $_SESSION['tiempo'] > 300) {
            session_destroy();
            /* Aquí redireccionas a la url especifica */
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
      <link rel="stylesheet" href="css/menu.css">
      <script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>
              <script src="scripts/menu.js" type="text/javascript"></script>



    </head>
    <body>
    <div id="contenedor">
        <!-- Encabezado de la pagina-->
            <?php include_once 'modulos/mdl_header.php'; ?>
        <!-- Menu para moviles
        <nav></nav>-->

        <!-- Menu lateral-->
        <aside id='cssmenu'>


    <ul>
        <li class="has-sub"><a title="" href="">Inicio</a>
        <li class="has-sub"><a title="" href="">Estudiantes</a>
        	 <ul>

                        <li><a title="" href="regEstudiantes.php">Registrar</a></li>
                        <li><a title="" href="ConsultaEstudiantes.php">Consultar</a></li>
                        <li><a title="" href="listActualizarEstudiante.php">Actualizar</a></li>
                        <li><a title="" href="listEstudiantes.php">Eliminar</a></li>
                        <li><a title="" href="listSolicitudes.php">Aprobar Cambio</a></li>
                        <li><a title="" href="listReportes.php">Revisar Reportes</a></li>


        	 </ul>

        </li>
        <li class="has-sub"><a title="" href="">Instructores</a>
        	<ul>

                        <li><a title="" href="regInstructores.php">Registrar</a></li>
                        <li><a title="" href="ConsultaInstructores.php">Consultar</a></li>
                        <li><a title="" href="listActualizarInstructor.php">Actualizar</a></li>
                        <li><a title="" href="listInstructores.php">Eliminar</a></li>

        	 </ul>

        </li>

         <li class="has-sub"><a title="" href="">Supervisores</a>
        		<ul>

                        <li><a title="" href="regSupervisores.php">Registrar</a></li>
                        <li><a title="" href="listActualizarSupervisor.php">Actualizar</a></li>
                        <li><a title="" href="listSupervisores.php">Eliminar</a></li>

        	 </ul>

        </li>

        <li class="has-sub"><a title="" href="">Talleres</a>
        		<ul>

                        <li><a title="" href="regTalleres.php">Registrar</a></li>
                        <li><a title="" href="listActualizarTaller.php">Actualizar</a></li>
                        <li><a title="" href="listTalleres.php">Eliminar</a></li>

        	 </ul>

        </li>
        <li><a title="" href="modulos/mdl_logout.php">Cerrar Sesión</a>
          <ul>
          </ul>
        </li>
    </ul>








        </aside>

        <!-- contenido principal -->
        <section>
            <article><?php if(isset($message)) echo $message; ?></article>
        </section>


        <!-- Pie de pagina-->
            <?php include_once 'modulos/mdl_footer.php'; ?>
    </div>


    </body>
</html>
