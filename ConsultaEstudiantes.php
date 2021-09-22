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
        if($tipo <> 1) header('location: index.php');
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
//echo $codigo;
error_reporting(0);//para que no me muestre errores

//echo $var;
/********* OBTENEMOS EL POST DEL FILTRO******************/
$filtro1 = $_POST['FiltrarCurp']; //para obtener la curp a buscar del fitro
$filtro2 = $_POST['FiltrarNombre'];
$filtro3 = $_POST['FiltrarApellidos'];
$filtro4 = $_POST['FiltrarCarrera'];
$filtro5 = $_POST['FiltrarGrado'];
$filtro6 = $_POST['FiltrarGrupo'];
$filtro7 = $_POST['FiltrarTaller'];

/********************************************************/
?>

</!DOCTYPE html>
<html>
    <head>
        <title>SIVRTEC63</title>
        <link rel="stylesheet" href="css/main.css"/>
        <link rel="stylesheet" href="css/forms.css">
        <script language='javascript'>
      		function enviar(codigo) {
                document.frm_listPerfiles.micodigo.value = codigo;
      			//alert(codigo);
                document.frm_listPerfiles.submit();
      		}
      		function regresar(){
      			location.href='menuInstructor.php'
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
      <div id="centrado">
          <!--/*********************************FORMULARIO PARA EL FILTRO*****************************************************/ -->
                             <form method="post" action="ConsultaEstudiantes.php" name="form_filtro" id="form_filtro" style="align-items: center; background:rgba(0,0,0,0.0);">
                             <table border="0" style="color:#FFFFFF; font-weight: 600; font-size: 17px;">
                             <tr>
                               <td width="50%" style="text-align: right;">
                                 <p>

                                 <input style="height:30px;	width:200px; font-weight: 600; font-size: 14px; border-radius: 10px 10px 10px 10px; color:#FFFFFF; background:#D0D4D8;" name="FiltrarCurp" type="search"   placeholder="Buscar por CURP" id ="FiltrarCurp" onKeyUp="document.getElementById(this.id).value=document.getElementById(this.id).value.toUpperCase()" >
                                 <input style="height:30px;	width:200px; font-weight: 600; font-size: 14px; border-radius: 10px 10px 10px 10px; color:#FFFFFF; background:#D0D4D8;" name="FiltrarNombre" type="search" title="Busqueda por nombre ejemplo: Pedro"  placeholder="Buscar por Nombre" id ="FiltrarNombre" onKeyUp="document.getElementById(this.id).value=document.getElementById(this.id).value.toUpperCase()" >
                                 <input style="height:30px;	width:200px; font-weight: 600; font-size: 14px; border-radius: 10px 10px 10px 10px; color:#FFFFFF; background:#D0D4D8;" name="FiltrarApellidos" type="search" title="Busqueda por apellidos ejemplo: Solano Zepeda" placeholder="Buscar por apellidos" id ="FiltrarApellidos" onKeyUp="document.getElementById(this.id).value=document.getElementById(this.id).value.toUpperCase()">


                                  <select name="FiltrarTaller" type="text" id ="taller" style="height:30px;	width:100px; font-weight: 600; font-size: 14px; border-radius: 10px 10px 10px 10px;">
                                    <?php
                                     include_once 'clases/taller.php';
                                     $taller = new Taller();
                                     $talleres = $taller->listar();

                                     if($talleres){
                                     echo "<option value='' disabled selected>TALLER</option>";
                                       foreach ($talleres as $taller) {

                                               if($taller['estado'] == 'Activo'){
                                                   echo "<option value='".$taller['nombre']."'>".$taller['nombre']."</option>";
                                                 }else  if($taller['estado'] == 'Inactivo'){
                                                       echo "<option value='".$taller['nombre']."' disabled>".$taller['nombre']."</option>";
                                                     }else  if($taller['estado'] == 'Espera'){
                                                                   echo "<option value='".$taller['nombre']."' disabled>".$taller['nombre']."</option>";
                                                                         }

                                                   }
                                                 }
                                          else{
                                              echo "No ha registrado Talleres";
                                             }
                                     ?>
</select>
                                 <select name="FiltrarCarrera" type="text" id ="carrera" style="height:30px;	width:100px; font-weight: 600; font-size: 14px; border-radius: 10px 10px 10px 10px;">
                                  <option value=""  selected>CARRERA</option>
                                  <option value="CONTABILIDAD">CONTABILIDAD</option>
                                  <option value="PROGRAMACIÓN">PROGRAMACIÓN</option>
                                  <option value="OFIMÁTICA">OFIMÁTICA</option>
                                  <option value="ELECTRÓNICA">ELECTRÓNICA</option>
                                  <option value="MECÁNICA INDUSTRIAL">MECÁNICA INDUSTRIAL</option>
                                   <option value="COMPONENTE BASICO Y PROPEDEUTICO">COMPONENTE BASICO Y PROPEDEUTICO</option>
                                  </select>
                                 <select name="FiltrarGrado" type="text" id ="grado" style="height:30px;	width:80px; font-weight: 600; font-size: 14px; border-radius: 10px 10px 10px 10px;">
                                   <option value=""  selected>GRADO</option>
                                   <option value="1">1ro.</option>
                                   <option value="2">2do.</option>
                                   <option value="3">3ro.</option>
                                   <option value="4">4to.</option>
                                   <option value="5">5to.</option>
                                   <option value="6">6to.</option>
                                   </select>

                                   <select name="FiltrarGrupo" type="text" id ="grupo" style="height:30px;	width:80px; font-weight: 600; font-size: 14px; border-radius: 10px 10px 10px 10px;">
                                    <option value="" selected>GRUPO</option>
                                    <option value="A">A</option>
                                    <option value="B">B</option>
                                    <option value="C">C</option>
                                    <option value="D">D</option>
                                    <option value="E">E</option>
                                    <option value="F">F</option>
                                    </select>
                                   <br>
                                     <input type="submit" value="Buscar">
                                 </p>
                               </td>
                             </tr>
                           </table>
                         </form>
          <!--/*********************************FIN FORMULARIO PARA EL FILTRO*****************************************************/ -->


       </div>


        <section style="text-align: center; margin: 0 auto; height: 60%">
            <article style="width:85%; height: 100%;text-align: center; margin: 0 auto;">
                 <div class="datagrid">
                 <form method="post" action="PerfilEstudianteAdmin.php" name="frm_listPerfiles" id="frm_listPerfiles" style="width: auto; height: auto;">
					             <input type="hidden" id="micodigo" name="micodigo">

                                   <?php
                                   include_once 'clases/estudiante.php';
                                   $doc = new Estudiante();
                                   $alumnos = $doc->listarConsultaCompleta();
                                   if($alumnos){
                                    echo "
                                    <h4>Listado de Estudiantes</h4>
                                      <table border='1'><thead>
                                      <tr>
                                        <th style='text-align:center'>CURP</th>
                                        <th style='text-align:center'>Nombre</th>
                                        <th style='text-align:center'>Apellidos</th>
                                        <th style='text-align:center'>Carrera</th>
                                        <th style='text-align:center'>Grado</th>
                                        <th style='text-align:center'>Grupo</th>
                                        <th style='text-align:center'>Taller</th>

                                        <th style='text-align:center'>Ver Perfil</th>
                                      </tr></thead>";

                                      if($filtro1 || $filtro2 || $filtro3 || $filtro4 || $filtro5 || $filtro6){/* primer si filtro*/
                                      foreach ($alumnos as $alumno) {

                                            if($filtro1 == $alumno['curp'] || $filtro2 == $alumno['nomest'] || $filtro3 == $alumno['apellidos'] || $filtro4 == $alumno['carrera'] || $filtro5 == $alumno['grado'] || $filtro6 == $alumno['grupo']){ /*compara filtro con registro*/
                                          echo "<tr>
                                          <td>".$alumno['curp']."</td>
                                          <td>".$alumno['nomest']."</td>
                                          <td>".$alumno['apellidos']."</td>
                                          <td>".$alumno['carrera']."</td>
                                          <td>".$alumno['grado']."</td>
                                          <td>".$alumno['grupo']."</td>
                                          <td>".$alumno['tallnom']."</td>


                                          <td style='text-align:center'><img width='30' height='30' src='imgs/usuarios.png' onClick='enviar(\"".$alumno['curp']."\");'></td>
                                          </tr>";
                                        }/*cierre compara filtro con registro*/

                                  }/*cierrre primer foreach*/
                            }/*cierre primer si filtro*/

else if($filtro7){
  foreach ($alumnos as $alumno) {

        if($filtro7 == $alumno['tallnom'])
        {
          echo "<tr>
          <td>".$alumno['curp']."</td>
          <td>".$alumno['nomest']."</td>
          <td>".$alumno['apellidos']."</td>
          <td>".$alumno['carrera']."</td>
          <td>".$alumno['grado']."</td>
          <td>".$alumno['grupo']."</td>
          <td>".$alumno['tallnom']."</td>


          <td style='text-align:center'><img width='30' height='30' src='imgs/usuarios.png' onClick='enviar(\"".$alumno['curp']."\");'></td>
          </tr>";
        }

      }

}

                            else{/*else primer si filtro*/
                              foreach ($alumnos as $alumno) {/*foreach sin filtrar*/

                                  echo "<tr>
                                  <td>".$alumno['curp']."</td>
                                  <td>".$alumno['nomest']."</td>
                                  <td>".$alumno['apellidos']."</td>
                                  <td>".$alumno['carrera']."</td>
                                  <td>".$alumno['grado']."</td>
                                  <td>".$alumno['grupo']."</td>
                                  <td>".$alumno['tallnom']."</td>


                                  <td style='text-align:center'><img width='30' height='30' src='imgs/usuarios.png' onClick='enviar(\"".$alumno['curp']."\");'></td>
                                  </tr>";

                                }/*cierrre foreach sin filtrar*/


                              }/*cierre else primer si filtro*/



                                    echo "</table>";
                                  }/*cierre if(taller)*/
                                   else{/*else if(taller)*/
                                    echo " <p>No hay Estudiantes registrados en la base de datos</p>";
                                  }/*cierre del else if(taller)*/
                                   ?>
                       </form>


                   </article>
                </section>




<input type="button" onClick="location='menuAdmin.php'" value="Regresar" />



        <!-- Pie de pagina-->
            <?php include_once 'modulos/mdl_footer.php'; ?>

    </div>
  </div>
</center>
    </body>
</html>
