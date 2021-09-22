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

  /********* OBTENEMOS EL POST DEL FILTRO******************/
  error_reporting(0);//para que no me muestre errores porque en un principio FiltarCurp no tiene valor por o esta indefinida
  $filtro1 = $_POST['FiltarCurp']; //para obtener la curp a buscar del fitro
  $filtro2 = $_POST['FiltarNombre'];
  $filtro3 = $_POST['FiltarApellidos'];
  $filtro4 = $_POST['FiltarCarrera'];
  $filtro5 = $_POST['FiltarGrado'];
  $filtro6 = $_POST['FiltarGrupo'];


  /********************************************************/
?>
</!DOCTYPE html>
<html>
    <head>
        <title>SIVRTEC63</title>
        <link rel="stylesheet" href="css/main.css"/>
        <link rel="stylesheet" href="css/forms.css">
		<script language='javascript'>
		function consultar(codigo) {
            document.frm_ActualizarEstudiantes.micodigo.value = codigo;
			//alert(codigo);
            document.frm_ActualizarEstudiantes.submit();
		}
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
      <!--fin Encabezado de la pagina-->

  <!--/*********************************FORMULARIO PARA EL FILTRO*****************************************************/ -->
                     <form method="post" action="listActualizarEstudiante.php" name="form_filtro" id="form_filtro" style="align-items: center; background:rgba(0,0,0,0.0);">
                     <table border="0" style="color:#FFFFFF; font-weight: 600; font-size: 17px;">
                     <tr>
                       <td width="50%" style="text-align: right;">
                         <p>

                         <input name="FiltarCurp" type="text" title="Busqueda por CURP"  placeholder="Buscar por CURP" id ="FiltarCurp" onKeyUp="document.getElementById(this.id).value=document.getElementById(this.id).value.toUpperCase()" >
                         <input name="FiltarNombre" type="text" title="Busqueda por nombre ejemplo: Pedro"  placeholder="Buscar por Nombre" id ="FiltrarNombre" onKeyUp="document.getElementById(this.id).value=document.getElementById(this.id).value.toUpperCase()" >
                         <input name="FiltarApellidos" type="text" title="Busqueda por apellidos ejemplo: Solano Zepeda" placeholder="Buscar por apellidos" id ="FiltrarApellidos" onKeyUp="document.getElementById(this.id).value=document.getElementById(this.id).value.toUpperCase()">

                         <select name="FiltarCarrera" type="text" id ="carrera" style="height:30px;	width:100px; font-weight: 600; font-size: 14px; border-radius: 10px 10px 10px 10px;">
                          <option value=""  selected>CARRERA</option>
                          <option value="CONTABILIDAD">CONTABILIDAD</option>
                          <option value="PROGRAMACIÓN">PROGRAMACIÓN</option>
                          <option value="OFIMÁTICA">OFIMÁTICA</option>
                          <option value="ELECTRÓNICA">ELECTRÓNICA</option>
                          <option value="MECÁNICA INDUSTRIAL">MECÁNICA INDUSTRIAL</option>
                           <option value="COMPONENTE BASICO Y PROPEDEUTICO">COMPONENTE BASICO Y PROPEDEUTICO</option>
                          </select>
                         <select name="FiltarGrado" type="text" id ="grado" style="height:30px;	width:80px; font-weight: 600; font-size: 14px; border-radius: 10px 10px 10px 10px;">
                           <option value=""  selected>GRADO</option>
                           <option value="1">1ro.</option>
                           <option value="2">2do.</option>
                           <option value="3">3ro.</option>
                           <option value="4">4to.</option>
                           <option value="5">5to.</option>
                           <option value="6">6to.</option>
                           </select>

                           <select name="FiltarGrupo" type="text" id ="grupo" style="height:30px;	width:80px; font-weight: 600; font-size: 14px; border-radius: 10px 10px 10px 10px;">
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






        <!-- contenido principal -->
        <section style="text-align: center; margin: 0 auto; height: 60%">
            <article style="width:85%; height: 100%;text-align: center; margin: 0 auto;">

                 <div class="datagrid">


<!--/*********************************FORMULARIO PARA EL LISTADO*****************************************************/ -->
                 <form method="post" action="actualizarEstudiantes.php" name="frm_ActualizarEstudiantes" id="frm_ActualizarEstudiantes" style="width: auto; height: auto;">
					<input type="hidden" id="micodigo" name="micodigo">
  <?php
  include_once 'clases/estudiante.php';
  $est = new Estudiante();
  $alumnos = $est->listar();
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
        <th style='text-align:center'>Acciones</th>
      </tr></thead>";
      if($filtro1 || $filtro2 || $filtro3 || $filtro4 || $filtro5 || $filtro6){
        foreach ($alumnos as $alumno) {
        //  if($filtro1 == $alumno['curp'] || $filtro2 == $alumno['nombre'] || $filtro3 == $alumno['apellidos']){

          if($filtro1 == $alumno['curp'] || $filtro2 == $alumno['nombre'] || $filtro3 == $alumno['apellidos'] || $filtro4 == $alumno['carrera'] || $filtro5 == $alumno['grado'] || $filtro6 == $alumno['grupo']){
            echo "<tr>
            <td>".$alumno['curp']."</td>
            <td>".$alumno['nombre']."</td>
            <td>".$alumno['apellidos']."</td>
            <td>".$alumno['carrera']."</td>
            <td>".$alumno['grado']."</td>
            <td>".$alumno['grupo']."</td>
            <td style='text-align:center'><img width='30' height='30' src='imgs/Actualizar.png' onClick='consultar(\"".$alumno['curp']."\");'></td>
            </tr>";
          }

        }


      }else{
        foreach ($alumnos as $alumno) {
          echo "<tr>
          <td>".$alumno['curp']."</td>
          <td>".$alumno['nombre']."</td>
          <td>".$alumno['apellidos']."</td>
          <td>".$alumno['carrera']."</td>
          <td>".$alumno['grado']."</td>
          <td>".$alumno['grupo']."</td>
          <td style='text-align:center'><img width='30' height='30' src='imgs/Actualizar.png' onClick='consultar(\"".$alumno['curp']."\");'></td>
          </tr>";
        }
      }

    echo "</table>";
  }
  else{
    echo " <p>No hay Estudiantes registrados en la base de datos</p>";
  }


?>
</div>
<!--<td style='text-align:center'><img width='30' height='30' src='imgs/delete.png' onClick='borrar(\"".$alumno['curp']."\");'></td> -->
           </article>
           </form>
        </section>

          <input type="button" onClick="location='menuAdmin.php'" value="Regresar" />

        <!-- Pie de pagina-->
            <?php include_once 'modulos/mdl_footer.php'; ?>

    </div>

    </body>
    <center>
</html>
