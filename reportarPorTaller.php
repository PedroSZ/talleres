<?php
	/********************** VALIDAMOS QUE ESTA PAGINA SEA PARA LA SESION INICIADA ****************/
    include_once 'clases/usuario.php';
    include_once 'clases/sesion.php';
    $userSession = new Sesion();
	$codigo = "";
    if(isset($_SESSION['user'])){
        $user = new Usuario();
        $user->establecerDatos($userSession->getCurrentUser());
        $tipo = $user->getTipo();
		$codigo = $user->getCodigo();
		//echo($codigo);
		//mensaje de que no tiene privilegios
        if($tipo <> 2) header('location: index.php');
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
//echo $codigo;

//echo $var;
?>

</!DOCTYPE html>
<html>
    <head>
        <title>SIVRTEC63</title>
        <link rel="stylesheet" href="css/main.css"/>
        <link rel="stylesheet" href="css/forms.css">
        <script language='javascript'>
      		function regresar(){
      			location.href='menuInstructor.php'
      		}
        </script>
        <meta charset="UTF-8">

    </head>
    <body>

    <div id="contenedor">
        <!-- Encabezado de la pagina-->
            <?php include_once 'modulos/mdl_header.php'; ?>
        <!-- contenido principal -->
        <section style="text-align: center; margin: 0 auto; height: 60%">
            <article style="width:85%; height:auto;text-align: center; margin: 0 auto;">
                 <div class="datagrid">

                 <form method="post" action="listReportar.php" name="frm_listTalleres" id="frm_listTalleres" style="width: auto; height: 15%;">
                       <b>Taller</b><br>
					         <!-- <input type="hidden" id="micodigo" name="micodigo"> -->
        <tr>
          <td style="text-align: right;">


          </td>
          <td>
             <p><select name="taller" type="text" id ="taller">
               <?php

                include_once 'clases/taller.php';
                $taller = new Taller();
                $talleres = $taller->listar();
                $datosTaller = $taller->consultarTaller($codigo);
                $mitaller = $taller->obtenerMiTaller($codigo);
                $TallerActual = $mitaller['id'];

                if($talleres){
                echo "<option value='' disabled selected>Seleccione:</option>";
                  foreach ($talleres as $taller) {
                    if($codigo == $taller['instructor'] ){
                          if($taller['estado'] == 'Activo'){
                              echo "<option value='".$taller['id']."'>".$taller['nombre']."</option>";
                                    }
                                }
                              }
                            }
                     else{
                         echo "No ha registrado Talleres";
                        }
                ?>
          </p>
          </td>
          </tr>
            </form>
                   </article>
                </section>




              <section>
                <input type="submit" value="Listar" />
                <input type="button" onClick="location='menuInstructor.php'" value="Regresar" />

              </section>
              <div id="espaciador"></div>
                <div id="espaciador5"></div>
                <div id="espaciador5"></div>

        <!-- Pie de pagina-->
            <?php include_once 'modulos/mdl_footer.php'; ?>

    </div>
  </div>
    </body>
</html>
