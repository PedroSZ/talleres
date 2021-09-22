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
		function solicitar(codigo) {
            document.frm_listEstudiantes.micodigo.value = codigo;
		//	alert(codigo);
            document.frm_listEstudiantes.submit();
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
                 <form method="post" action="AprobarCambioTaller.php" name="frm_listEstudiantes" id="frm_listEstudiantes">
					<input type="hidden" id="micodigo" name="micodigo">
                     <?php
  include_once 'clases/cambio.php';
  $cam = new Cambio();
  $cambios = $cam->listar();
  if($cambios){
    echo "
    <h4>Solicitudes para cambio de taller.</h4>
      <table border='1'><thead>
      <tr>
      <th colspan='3' style='text-align:center'>Estudiante</th>
      <th colspan='2'>Taller Actual</th>
      <th colspan='2'>Taller Solicitado</th>
      <th colspan='2'>Acciones</th>
   </tr>

    <tr>
      <th>CURP</th>
      <th>Nombre</th>
      <th>Apellidos</th>
      <th>No.</th>
      <th>Taller</th>
      <th>No.</th>
      <th>Taller</th>
      <th>Seleccionar</th>
    </tr>



	  </thead>";
    foreach ($cambios as $cambio) {
      echo "<tr>
      <td>".$cambio['curp']."</td>
      <td>".$cambio['nombre']."</td>
      <td>".$cambio['apellidos']."</td>

	  <td>".$cambio['id1']."</td>
      <td>".$cambio['actual']."</td>
      <td>".$cambio['id2']."</td>
	  <td>".$cambio['elegido']."</td>

      <td style='text-align:center'><img width='30' height='30' src='imgs/elegir.png' onClick='solicitar(\"".$cambio['curp']."\");'></td>
      </tr>";
    }
    echo "</table>";
  }
  else{
    echo " <p>No hay solicitudes de cambios por el momento.</p>";
  }
?>
</div>

           </article>

           </form>
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
