<?php
	/********************** VALIDAMOS QUE ESTA PAGINA SEA PARA LA SESION INICIADA ****************/
    include_once 'clases/usuario.php';
    include_once 'clases/sesion.php';
    $userSession = new Sesion();

    if(isset($_SESSION['user'])){
        $user = new Usuario();
        $user->establecerDatos($userSession->getCurrentUser());
        $tipo = $user->getTipo();
		$codigo = $user->getCodigo();
		//echo($codigo);
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
        <title>SIVRTEC63</title>
        <link rel="stylesheet" href="css/main.css"/>
        <link rel="stylesheet" href="css/forms.css">
        <meta charset="UTF-8">

    </head>
    <body>
<center>
    <div id="contenedor">
        <!-- Encabezado de la pagina-->
            <?php include_once 'modulos/mdl_header.php'; ?>
        <!-- contenido principal -->
        <section style="text-align: center; margin: 0 auto;">
            <article style="width: 600px; height: auto;text-align: center; margin: 0 auto;">


                <?php
                //generar Codigo
                function generarCodigo($longitud) {
                $key = '';
                $pattern = '1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZ';
                $max = strlen($pattern)-1;
                for($i=0;$i < $longitud;$i++) $key .= $pattern{mt_rand(0,$max)};
                return $key;
                }
                //obtener fecha actual
                $hoy = getdate();
                //print_r($hoy);
                //echo $hoy['mday']."/".$hoy['mon']."/".$hoy['year'];
                //obtener datos del estudiante
                include_once 'clases/estudiante.php';
                $doc = new Estudiante();
                $alumnos = $doc->consultarCodigo($codigo);
                //saber taller inscrito
                include_once 'clases/estudiante_por_taller.php';
                $taller = new EstudianteTaller();
                $estudiantesTaller = $taller->consultarEstudiante($codigo);
                $dato = $estudiantesTaller['taller'];
                $estado = $estudiantesTaller['evaluacion'];
                /*echo($dato); solo pruebas*/
                //obtener datos del taller inscrito
                include_once 'clases/taller.php';
                $taller = new Taller();
                $datosTaller = $taller->consultarCodigo($dato);
                /*$algo = $datosTaller['area'];
                echo($algo); solo pruebas*/
                $dato2 = $datosTaller['instructor'];
                /*echo($dato2);*/
                //obtener datos del instructor
                include_once 'clases/instructor.php';
                $instructor = new Instructor();
                $datosInstructor = $instructor->consultarCodigo($dato2);
                if($estado == 'Aprobado'){
                  echo"
                  <br>
                  <br>
                  <p align='left'>A quien corresponda.</p>
                  <p align='justify'>Por medio del presente, hago constar que el estudiante
                  <b>".$alumnos['nombre']." ".$alumnos['apellidos']."</b> ha aprobado satisfactoriamente
                  el taller de <b>".$datosTaller['nombre']."</b> por lo que se le otorga la presente constancia
                  con numero de Código <b>";?> <?php echo generarCodigo(6); echo"</b> para ser utilizada en la asignatura que al
                  interesado convenga.</p>

                  <p align='left'>Sin mas de momento me despido agradeciendo su atención.</p>
                  <br>
                  <p align='center'><b>Ameca, Jalisco a"; ?> <?php echo $hoy['mday']."/".$hoy['mon']."/".$hoy['year']; ?>
                  <?php echo"</b></p>
                  <br>
                  <p align='center'><b> ".$datosInstructor['nombre']."  ".$datosInstructor['apellidos']."</b></p>

                  ";

                }else{
                  header ("Location: mensajeNoAprovado.php");


                }
              ?>


           </article>



        </section>

        <div id="centrado">
          <input type="button" onClick="location='menuEstudiante.php'" value="Regresar" />
&nbsp; &nbsp;
          <input type="button"  onclick="javascript:window.print()" value="Imprimir" />
        </div>


        <!-- Pie de pagina-->
            <?php include_once 'modulos/mdl_footer.php'; ?>

    </div>
  </center>
    </body>
</html>
