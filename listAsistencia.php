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

  error_reporting(0);//para que no me muestre errores
    $var = $_POST['taller'];
  //echo $var;



?>
</!DOCTYPE html>
<html>
    <head>
        <title>SIVRTEC63</title>
        <link rel="stylesheet" href="css/main.css"/>
        <link rel="stylesheet" href="css/tablaCalificar.css">
        <link rel="stylesheet" href="css/asistencia.css">
        <script language='javascript'>
        </script>
        <meta charset="UTF-8">

    </head>
    <body>
<center>

        <!-- Encabezado de la pagina-->
            <?php include_once 'modulos/mdl_header.php'; ?>
        <!-- contenido principal -->

<!--  <div id="centrado"> -->
                          <!-- FORM FILTRO -->


                          <form method="post" style="width: auto; height:auto;"  action="listAsistencia.php" name="frm_listAsistencia" id="frm_listAsistencia" >
                                <input type="hidden" id="micodigo" name="micodigo">
                          <tr>
                          <td style="text-align: right;">
                          <p><label>Taller:</label></p>
                          </td>
                          <td>
                          <p><select name="taller" type="text" id ="taller" onchange="document.frm_listAsistencia.submit();">
                          <?php

                          include_once 'clases/taller.php';
                          $taller = new Taller();
                          $talleres = $taller->listar();

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
                                  echo "No ha registrado Supervisores";
                                 }


                          ?>
                          </p>
                          </td>
                          </tr>
                          </form>


<!-- </div> -->

  <div id="contenedor">


       <section style="text-align: center; margin: 0 auto;">
           <article style="width: 900px; height: 350px;text-align: center; margin: 0 auto;">

         <input type="hidden" id="micodigo" name="micodigo">

           <?php

           ?>



              <?php
              include_once 'clases/taller.php';
              $tallerA = new Taller();
              $mitaller = $tallerA->consultarCodigo($var);


              //$TallerActual = $mitaller['id'];
              include_once 'clases/estudiante_por_taller.php';
              $doc = new EstudianteTaller();
              $estudiantes = $doc->listarEstudiantesTalleres();

              $mes = date('n');
              $anio = date('Y');
              $i = 1;
              $th   =   "";
              $td   =   "";
              while (checkdate($mes,$i,$anio)) {
                 $i<10?$n='0'.$i:$n=$i;
                 $th .= "<th class='dia'> </th>";
                 $td .= "<td class='dia'> </td>";
                 $i++;
              };?>

          <table border="0" cellspacing="0" cellpadding="0">
             <tr>
                  <th colspan="<?php echo $i+5; ?>" scope="col">  <?php echo $mitaller['nombre'];?></th>
          <h4>Lista de Asistencia</h4>
        </tr>
            <tr>
              <th colspan = "5"> Estudiantes </th>
              <?php echo $th; ?>
            </tr>
            <?php

            if($estudiantes){
                foreach ($estudiantes as $alumno) {
                  if($var == $alumno['taller'] ){
                    echo"
                    <tr style ='background = #12BCE1'>
                    <th colspan = '5' scope ='row' align='left' style = 'background = #12BCE1'>".$alumno['nombre']." ".$alumno['apellidos']."</th>
                    ";
                   echo $td;//imprime las celdas de la lista

              }
                }
              echo "</table>";
              }
            else{
              echo " <p>Aún no hay Estudiantes registrados en su taller</p>";
            }

            ?>
          </table>


                     </article>
                  </section>



          <input type="button" onClick="location='menuInstructor.php'" value="Regresar" />
          &nbsp;
          &nbsp;
          <input type="button" onclick="javascript:window.print()" value="Imprimir" />
    <!--      </form>  -->
    <div id="espaciador"></div>
    <div id="espaciador3"></div>
    <div id="espaciador3"></div>
      <div id="espaciador5"></div>


    </div>
    <!-- Pie de pagina-->
        <?php include_once 'modulos/mdl_footer.php'; ?>
<!--  </div> -->
</center>
    </body>
</html>
