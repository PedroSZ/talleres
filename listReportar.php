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
//echo $codigo;
error_reporting(0);//para que no me muestre errores
$var = $_POST['taller'];
//echo $var;
/********* OBTENEMOS EL POST DEL FILTRO******************/
$filtro1 = $_POST['FiltarCurp']; //para obtener la curp a buscar del fitro
$filtro2 = $_POST['FiltrarNombre']; //para obtener Nombre  a buscar del fitro
$filtro3 = $_POST['FiltrarApellidos']; //para obtener Estado a buscar del fitro
/*echo $filtro1;
echo $filtro2;
echo $filtro3;*/
/********************************************************/
?>

</!DOCTYPE html>
<html>
    <head>
        <title>Reportar Estudiante</title>
        <link rel="stylesheet" href="css/main.css"/>
        <link rel="stylesheet" href="css/forms.css">
        <script language='javascript'>
      		function reportar(codigo) {
                document.frm_listReportar.micodigo.value = codigo;
      			//alert(codigo);
                document.frm_listReportar.submit();
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
                             <form method="post" action="listReportar.php" name="form_filtro" id="form_filtro" style="align-items: center; background:rgba(0,0,0,0.0);">
                             <table border="0" style="color:#FFFFFF; font-weight: 600; font-size: 17px;">
                             <tr>
                               <td width="50%" style="text-align: right;">
                                 <p>

                                 <input style="height:30px;	width:200px; font-weight: 600; font-size: 14px; border-radius: 10px 10px 10px 10px;" name="FiltarCurp" type="search"  placeholder="Buscar por CURP" id ="FiltarCurp" onKeyUp="document.getElementById(this.id).value=document.getElementById(this.id).value.toUpperCase()" >
                                 <input style="height:30px;	width:200px; font-weight: 600; font-size: 14px; border-radius: 10px 10px 10px 10px;" name="FiltrarNombre" type="search" title="Busqueda por nombre ejemplo: Pedro"  placeholder="Buscar por Nombre" id ="FiltrarNombre" onKeyUp="document.getElementById(this.id).value=document.getElementById(this.id).value.toUpperCase()" >
                                 <input style="height:30px;	width:200px; font-weight: 600; font-size: 14px; border-radius: 10px 10px 10px 10px;" name="FiltrarApellidos" type="search" title="Busqueda por apellidos ejemplo: Solano Zepeda" placeholder="Buscar por apellidos" id ="FiltrarApellidos" onKeyUp="document.getElementById(this.id).value=document.getElementById(this.id).value.toUpperCase()">
                                 <input name="taller" type="hidden"  placeholder="idTaller" id ="taller" value="<?php echo $var; ?>"> <!-- para que regrese a la lista actual despues de filtrar -->
                                 <input type="submit" value="Buscar">
                                 </p>
                               </td>
                             </tr>
                           </table>
                         </form>
          <!--/*********************************FIN FORMULARIO PARA EL FILTRO*****************************************************/ -->
        </div>


        <section style="text-align: center; margin: 0 auto; height: 60%">
            <article style="width:65%; height: 100%;text-align: center; margin: 0 auto;">
                 <div class="datagrid">
                 <form method="post" action="crearReporte.php" name="frm_listReportar" id="frm_listReportar" style="width: auto; height: auto;">
					             <input type="hidden" id="micodigo" name="micodigo">

                                   <?php
                                   include_once 'clases/estudiante_por_taller.php';
                                   $doc = new EstudianteTaller();
                                   $alumnos = $doc->listarEstudiantesTalleres();
                                   if($alumnos){
                                    echo "
                                    <h4>Listado de Estudiantes</h4>
                                      <table border='1'><thead>
                                      <tr>
                                        <th style='text-align:center'>CURP</th>
                                        <th style='text-align:center'>Nombre</th>
                                        <th style='text-align:center'>Apellidos</th>
                                        <th style='text-align:center'>Reportar</th>
                                      </tr></thead>";

                                      if($filtro1 || $filtro2 || $filtro3){
                                      foreach ($alumnos as $alumno) {
                                        if($var == $alumno['taller'] ){
                                            if($filtro1 == $alumno['curp'] || $filtro2 == $alumno['nombre'] || $filtro3 == $alumno['apellidos']){
                                          echo "<tr>
                                          <td>".$alumno['curp']."</td>
                                          <td>".$alumno['nombre']."</td>
                                          <td>".$alumno['apellidos']."</td>

                                          <td style='text-align:center'><img width='30' height='30' src='imgs/mal.png' onClick='reportar(\"".$alumno['curp']."\");'></td>
                                          </tr>";
                                        }
                                    } /*cierre   if($var == $alumno['taller'] )*/
                                  }/*cierrre primer foreach*/
                            }/*cierre filtro 1*/
                            else{/*else filtro1*/
                              foreach ($alumnos as $alumno) {
                                if($var == $alumno['taller'] ){
                                  echo "<tr>
                                  <td>".$alumno['curp']."</td>
                                  <td>".$alumno['nombre']."</td>
                                  <td>".$alumno['apellidos']."</td>

                                  <td style='text-align:center'><img width='30' height='30' src='imgs/mal.png' onClick='reportar(\"".$alumno['curp']."\");'></td>
                                  </tr>";
                                } /*cierre   if($var == $alumno['taller'] )*/
                                }/*cierrre primer foreach*/


                                }/*cierre else filtro1*/

                                    echo "</table>";
                                   }
                                   else{
                                    echo " <p>No hay Estudiantes registrados en la base de datos</p>";
                                   }
                                   ?>
                       </form>


                   </article>
                </section>




<input type="button" onClick="location='reportarPorTaller.php'" value="Regresar" />

        <!-- Pie de pagina-->
            <?php include_once 'modulos/mdl_footer.php'; ?>

    </div>
  </div>
</center>
    </body>
</html>
