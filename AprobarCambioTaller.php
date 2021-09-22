<?php
	/********************** VALIDAMOS QUE ESTA PAGINA SEA PARA LA SESION INICIADA ****************/
    include_once 'clases/usuario.php';
    include_once 'clases/sesion.php';
    $userSession = new Sesion();

    if(isset($_SESSION['user'])){
        $user = new Usuario();
        $user->establecerDatos($userSession->getCurrentUser());
        $tipo = $user->getTipo();
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
?>
</!DOCTYPE html>
<html>
    <head>
        <title>SIVRTEC63</title>
        <link rel="stylesheet" href="css/main.css"/>
        <link rel="stylesheet" href="css/forms.css">

        <script language='javascript'>
		      function registrar(codigo) {
            document.frm_aprobarCambio.micodigo.value = codigo;
			         //alert(codigo);a
               alert("Cambio aprobado con éxito.");
            document.frm_aprobarCambio.submit();
		        }
        </script>
        <meta charset="UTF-8">

    </head>
    <body>

    <div id="contenedor">
        <!-- Encabezado de la pagina-->
            <?php include_once 'modulos/mdl_header.php'; ?>
        <!-- contenido principal -->
        <section style="text-align: center; margin: 0 auto;">
            <article style="width: 60%; height: auto;text-align: center; margin: 0 auto;">
    <div class="datagrid">
     <form method="post" action="modulos/mdl_AprobarCambio.php" name="frm_aprobarCambio" id="frm_aprobarCambio" >
       <input name="micodigo" style="visibility:hidden" type="text" id ="codigo" value="<?php echo"$dato"; ?>">
            <?php


            if(!empty($_POST['micodigo'])){
              include_once 'clases/cambio.php';
              $codigo = $_POST['micodigo'];
              $cam = new Cambio();
              $micam = $cam->consultarEstudiante($codigo);

            }
            else{

            }
  $dato = $micam['solicitud'];

  // echo($dato);
    echo "
    <h4>Estudiantes</h4>
      <table border='1'><thead>
      <tr>
        <th style='text-align:center'>CURP</th>
        <th style='text-align:center'>Nombre</th>
        <th style='text-align:center'>Apellidos</th>
		<th style='text-align:center'>Carrera</th>
		<th style='text-align:center'>Grago</th>
        <th style='text-align:center'>Grupo</th>

      </tr></thead>";

      echo "<tr>
      <td>".$micam['curp']."</td>
      <td>".$micam['nombre']."</td>
      <td>".$micam['apellidos']."</td>
	  <td>".$micam['carrera']."</td>
	  <td>".$micam['grado']."</td>
	  <td>".$micam['grupo']."</td>

      </tr>";
    echo "</table>";
  ?>

  <?php


   echo "
    <h4>Taller Inscrito:</h4>
      <table border='1'><thead>

    <tr>
        <th style='text-align:center'>No. de Taller</th>
		<td>".$micam['id1']."</td>
		</tr>
      <tr>
        <th style='text-align:center'>Taller</th>
		<td>".$micam['actual']."</td>
		</tr>
		<tr>
        <th style='text-align:center'>Lugar</th>
		 <td>".$micam['Area1']."</td>
		 </tr>
		<tr>
        <th style='text-align:center'>Horario</th>
		<td>".$micam['Horario1']."</td>
		</tr>

    <th id='subcabecera' colspan='2' style='text-align:center' >Instructor Actual</th>
       <tr>
           <th style='text-align:center'>Nombre</th>
       <td>".$micam['NomIns1']."</td>
       </tr>
       <tr>
           <th style='text-align:center'>Apellidos</th>
       <td>".$micam['ApInst1']."</td>
       </tr>
       <tr>
           <th style='text-align:center'>Email</th>
       <td>".$micam['mailIns1']."</td>
       </tr>
       <tr>
           <th style='text-align:center'>Telefono</th>
       <td>".$micam['telIns1']."</td>
       </tr>


		<tr></thead>";
    echo "</table>";



  echo "
   <h4>Taller Elegido:</h4>
     <table border='1'><thead>
      <th colspan='2' style='text-align:center'> Solicitud de Cambio: ".$micam['solicitud']." </th>
     <tr>

     <td colspan = '2'></td>
     </tr>
   <tr>
       <th style='text-align:center'>No. de Taller</th>
   <td>".$micam['id2']."</td>
   </tr>
     <tr>
       <th style='text-align:center'>Taller</th>
   <td>".$micam['elegido']."</td>
   </tr>
   <tr>
       <th style='text-align:center'>Lugar</th>
    <td>".$micam['Area2']."</td>
    </tr>
   <tr>
       <th style='text-align:center'>Horario</th>
   <td>".$micam['Horario2']."</td>
   </tr>

<th id='subcabecera' colspan='2' style='text-align:center' >Instructor del nuevo taller</th>
   <tr>
       <th style='text-align:center'>Nombre</th>
   <td>".$micam['NomIns2']."</td>
   </tr>
   <tr>
       <th style='text-align:center'>Apellidos</th>
   <td>".$micam['ApInst2']."</td>
   </tr>
   <tr>
       <th style='text-align:center'>Email</th>
   <td>".$micam['mailIns2']."</td>
   </tr>
   <tr>
       <th style='text-align:center'>Telefono</th>
   <td>".$micam['telIns2']."</td>
   </tr>
   <tr></thead>";
   echo "</table>";
//style="visibility:hidden"
  ?>






<!--<input type="button"  value="Aprobar" onClick="registrar(<?php// echo"'".$dato."'"; ?>)"/> -->

            </div>
           </article>

        </section>
        <div id="centrado">
          <input type="button" onClick="location='listSolicitudes.php'" value="Regresar" />
          &nbsp; &nbsp;
          <input type="button"  value="Aprobar" onClick="registrar(<?php echo"'$dato'"; ?>)"/>
        </div>
</form>


        <!-- Pie de pagina-->
            <?php include_once 'modulos/mdl_footer.php'; ?>

    </div>
    </body>
</html>
