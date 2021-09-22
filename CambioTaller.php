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

        <script language='javascript'>
		function registrar(codigo) {
            document.frm_CambioTaller.micodigo.value = codigo;
			//alert(codigo);
            document.frm_CambioTaller.submit();
		}
		function regresar(){
			location.href='index.php'
		}
        </script>

        <meta charset="UTF-8">

    </head>
    <body>

    <div id="contenedor">
        <!-- Encabezado de la pagina-->
            <?php include_once 'modulos/mdl_header.php'; ?>
        <!-- contenido principal -->
        <section style="text-align: center; margin: 0 auto; height: 55%">
            <article style="width:60%; height: 100%;text-align: center; margin: 0 auto;">
    <div class="datagrid">
       <form  action="" name="estiloform" id="estiloform" style="width: auto; height: auto;">
            <?php

		 include_once 'clases/estudiante.php';
  $doc = new Estudiante();
  $alumnos = $doc->consultarCodigo($codigo);
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
  include_once 'clases/cambio.php';
  //echo $codigo;
  $cam = new Cambio();
  $micam = $cam->consultarSolicitudes($codigo);
if($micam){
 echo '<script type="text/javascript">
  alert("Usted ya cuenta con una solicitud de cambio.");
  window.location.href="PerfilEstudiante.php";
  </script>';
   //echo $micam['SolicitudId'];
}
else{

}

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

  ?>
</form>
            </div>

             <div class="datagrid">
                 <form method="post" action="modulos/mdl_CambioTaller.php" name="frm_CambioTaller" id="frm_CambioTaller" style="width: auto; height: auto;">
					<input type="hidden" id="micodigo" name="micodigo">
  <?php
  /************************LISTAR TALLERES*****************************/


  include_once 'clases/taller.php';
  include_once 'clases/instructor.php';
  $doc = new Taller();
  $sql = 'SELECT taller.id, taller.nombre AS taller, taller.horario, instructor.nombre, instructor.apellidos FROM `taller` INNER JOIN instructor ON instructor.clave = taller.instructor where estado = "ACTIVO"';
  $talleres = $doc->consulta($sql);

  if($talleres){
    echo "
     <h4>Solicitar Cambio a taller:</h4>
      <table border='1'><thead>
      <tr>
        <th style='text-align:center'>Id</th>
        <th style='text-align:center'>Nombre</th>
        <th style='text-align:center'>Horario</th>
        <th style='text-align:center'>Instructor</th>
		<th style='text-align:center'>Elegir</th>
      </tr></thead>";
    foreach ($talleres as $taller) {
      echo "<tr>
      <td>".$taller['id']."</td>
      <td>".$taller['taller']."</td>
      <td>".$taller['horario']."</td>
	  <td>".$taller['nombre']." ".$taller['apellidos']."</td>
      <td style='text-align:center'><img width='30' height='30' src='imgs/elegir.png' onClick='registrar(\"".$taller['id']."\");'></td>
      </tr>";
    }
    echo "</table>";
  }
  else{
    echo " <p>No hay talleres para darse de alta</p>";
  }


?>

</div>

           </article>
           </section>
           <div align="center">
           <br>

<input type="button" onClick="location='menuEstudiante.php'" value="Regresar" />
</form>
          
           </div>


        <!-- Pie de pagina-->
            <?php include_once 'modulos/mdl_footer.php'; ?>

    </div>
    </body>
</html>
