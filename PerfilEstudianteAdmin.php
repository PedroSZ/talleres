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
    <div class="datagrid">
         <form method="post" action="" name="estiloForm" id="frm_aprobarCambio" >
            <?php

          $codigo = $_POST['micodigo'];

		 include_once 'clases/estudiante.php';
  $doc = new Estudiante();
  $alumnos = $doc->consultarCodigo($codigo);

    echo "
    <h4>Perfil del Estudiante</h4>
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
      <td>".$alumnos['curp']."</td>
      <td>".$alumnos['nombre']."</td>
      <td>".$alumnos['apellidos']."</td>
	  <td>".$alumnos['carrera']."</td>
	  <td>".$alumnos['grado']."</td>
	  <td>".$alumnos['grupo']."</td>
      </tr>";
    echo "</table>";
  ?>

  <?php

  include_once 'clases/estudiante_por_taller.php';
  $taller = new EstudianteTaller();
  $estudiantesTaller = $taller->consultarEstudiante($codigo);
  $dato = $estudiantesTaller['taller'];
  /*echo($dato); solo pruebas*/

  include_once 'clases/taller.php';
  $taller = new Taller();
  $datosTaller = $taller->consultarCodigo($dato);
  /*$algo = $datosTaller['area'];
  echo($algo); solo pruebas*/

   echo "
    <h4>Taller Inscrito:</h4>
      <table border='1'><thead>
      <tr>
        <th style='text-align:center'>Control de Registro</th>
		<td>".$estudiantesTaller['id']."</td>
		</tr>
		<tr>
        <th style='text-align:center'>No. de Taller</th>
		<td>".$estudiantesTaller['taller']."</td>
		</tr>
      <tr>
        <th style='text-align:center'>Taller</th>
		<td>".$datosTaller['nombre']."</td>
		</tr>
		<tr>
        <th style='text-align:center'>Lugar</th>
		 <td>".$datosTaller['area']."</td>
		 </tr>
		<tr>
        <th style='text-align:center'>Horario</th>
		<td>".$datosTaller['horario']."</td>
		</tr>



		<tr></thead>";
    echo "</table>";

  $dato2 = $datosTaller['instructor'];
  /*echo($dato2);*/
  include_once 'clases/instructor.php';
  $instructor = new Instructor();
  $datosInstructor = $instructor->consultarCodigo($dato2);

  echo "
   <h4>Instructor:</h4>
      <table border='1'><thead>
      <tr>
        <th style='text-align:center'>Instructor</th>
		<td>".$datosInstructor['nombre']."  ".$datosInstructor['apellidos']."</td>
		</tr>
		<tr>
        <th style='text-align:center'>Email</th>
		<td>".$datosInstructor['email']."</td>
		</tr>

		<tr>
        <th style='text-align:center'>Telefono</th>
		<td>".$datosInstructor['telefono']."</td>
		</tr>



		<tr></thead>";
    echo "</table>";

  $dato3 = $datosTaller['supervisor'];
  /*echo($dato3);*/
  include_once 'clases/supervisor.php';
  $supervisor = new Supervisor();
  $datosSupervisor = $supervisor->consultarCodigo($dato3);

   echo "
   <h4>Supervisor:</h4>
      <table border='1'><thead>
      <tr>
        <th style='text-align:center'>Supervisor</th>
		<td>".$datosSupervisor['nombre']."  ".$datosSupervisor['apellidos']."</td>
		</tr>
		<tr>
        <th style='text-align:center'>Email</th>
		<td>".$datosSupervisor['email']."</td>
		</tr>
		<tr>
        <th style='text-align:center'>Telefono</th>
		<td>".$datosSupervisor['telefono']."</td>
		</tr>



		<tr></thead>";
    echo "</table>";

  ?>

  <?php
include_once 'clases/cambio.php';
$cam = new Cambio();
$cambios = $cam->consultarSolicitudes($codigo);
if($cambios){
echo "
<h4></h4>
<table border='1'><thead>
<tr>
<th colspan='2' style='text-align:center'>Solicitud para cambio de taller:</th>
</tr>

<tr>
<th>Codigo de Solicitud</th>
<th>Estatus</th>
</tr>

</thead>";
//foreach ($cambios as $cambio) {
echo "<tr>
<td>".$cambios['SolicitudId']."</td>
<td>".$cambios['estado']."</td>
</tr>";
//}
echo "</table>";
}
else{
echo "<p>No hay solicitudes de cambios de taller</a> por el moemento </p>";
}
?>


            </div>


           </article>

        </section>
        <div id="centrado">
         <input type="button" onClick="location='ConsultaEstudiantes.php'" value="Regresar" />
       </div>

       </form>
        <!-- Pie de pagina-->
            <?php include_once 'modulos/mdl_footer.php'; ?>

    </div>
  </center>
    </body>
</html>
