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
		function detalles(codigo) {
            document.frm_listReportes.micodigo.value = codigo;
		//	alert(codigo);
            document.frm_listReportes.submit();
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
        <!-- contenido principal -->
        <section style="text-align: center; margin: 0 auto; height: 60%">
            <article style="width:85%; height: 100%;text-align: center; margin: 0 auto;">
            <?php //include_once 'forms/frm_listEstudiantes.php'; ?>
                 <div class="datagrid">
                 <form method="post" action="DeallesReporte.php" name="frm_listReportes" id="frm_listReportes" style="width: auto; height: auto;">
					<input type="hidden" id="micodigo" name="micodigo">
                     <?php
  include_once 'clases/reporte.php';
  $rep = new Reporte();
  $reportes = $rep->listarDetalles();
  if($reportes){
    echo "
    <h4>Estudiantes reportados.</h4>
      <table border='1'><thead>
      <tr>
      <th colspan='3' style='text-align:center'>Estudiante</th>
      <th colspan='2'>Taller</th>
      <th colspan='2'>Reporte</th>
      <th>Acciones</th>
   </tr>

    <tr>
      <th>Curp</th>
      <th>Nombre</th>
      <th>Apellidos</th>

      <th>No.</th>
      <th>Taller</th>

      <th>Clave</th>
      <th>Titulo</th>

      <th>Ver Detalles</th>
    </tr>



	  </thead>";
    foreach ($reportes as $reporte) {
      echo "<tr>
      <td>".$reporte['curp']."</td>
      <td>".$reporte['nomest']."</td>
      <td>".$reporte['apellidos']."</td>

	  <td>".$reporte['id']."</td>
      <td>".$reporte['tallnom']."</td>
      <td>".$reporte['clave']."</td>
	  <td>".$reporte['titulo']."</td>

      <td style='text-align:center'><img width='30' height='30' src='imgs/elegir.png' onClick='detalles(\"".$reporte['clave']."\");'></td>
      </tr>";
    }
    echo "</table>";
  }
  else{
    echo " <p>No hay solicitudes de cambios por el momento.</p>";
  }
?>


           </article>
        </section>

        <div id="centrado">
          <input type="button" onClick="location='menuAdmin.php'" value="Regresar" />
        </div>
        <div id="espaciador">  </div>
        <!-- Pie de pagina-->
            <?php include_once 'modulos/mdl_footer.php'; ?>

    </div>
  </center>
    </body>
</html>
