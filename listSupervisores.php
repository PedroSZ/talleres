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
  $filtro1 = $_POST['FiltarRFC']; //para obtener la curp a buscar del fitro
  $filtro2 = $_POST['FiltarNombre'];
  $filtro3 = $_POST['FiltarApellidos'];
  //echo $filtro;
  /********************************************************/
?>
</!DOCTYPE html>
<html>
    <head>
        <title>SIVRTEC63</title>
        <link rel="stylesheet" href="css/main.css"/>
        <link rel="stylesheet" href="css/forms.css">
        <script language='javascript'>
		function borrar(codigo) {

            var mensaje;
            var opcion = confirm("El usuario será eliminado de la base de datos, ¿seguro que desea continuar con esta acción?");
            if (opcion == true) {
              document.frm_listSupervisores.micodigo.value = codigo;
  			//alert(codigo);
              document.frm_listSupervisores.submit();
                mensaje = "Usuario eliminado con éxito.";
          } else {
              mensaje = "No se realizado ninguna acción.";
          }

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
      <div id="centrado">
        <!--/*********************************FORMULARIO PARA EL FILTRO*****************************************************/ -->
                           <form method="post" action="listSupervisores.php" name="form_filtro" id="form_filtro" style="align-items: center; background:rgba(0,0,0,0.0);">
                           <table border="0" style="color:#FFFFFF; font-weight: 600; font-size: 17px;">
                           <tr>
                             <td width="50%" style="text-align: right;">
                               <p>

                               <input name="FiltarRFC" type="text"  placeholder="Buscar por RFC" id ="FiltarRFC" onKeyUp="document.getElementById(this.id).value=document.getElementById(this.id).value.toUpperCase()" >
                               <input name="FiltarNombre" type="text" title="Busqueda por nombre ejemplo: Pedro"  placeholder="Buscar por Nombre" id ="FiltrarNombre" onKeyUp="document.getElementById(this.id).value=document.getElementById(this.id).value.toUpperCase()" >
                               <input name="FiltarApellidos" type="text" title="Busqueda por apellidos ejemplo: Solano Zepeda" placeholder="Buscar por apellidos" id ="FiltrarApellidos" onKeyUp="document.getElementById(this.id).value=document.getElementById(this.id).value.toUpperCase()">

                               <input type="submit" value="Buscar">
                               </p>
                             </td>
                           </tr>
                         </table>
                       </form>
        <!--/*********************************FORMULARIO PARA EL LISTADO*****************************************************/ -->
    </div>


    <section style="text-align: center; margin: 0 auto; height: 60%">
        <article style="width:60%; height: 100%;text-align: center; margin: 0 auto;">

                 <div class="datagrid">

                 <form method="post" action="modulos/mdl_delSupervisores.php" name="frm_listSupervisores" id="frm_listSupervisores" style="width: auto; height: auto;">
					<input type="hidden" id="micodigo" name="micodigo">
                     <?php
  include_once 'clases/supervisor.php';
  $doc = new Supervisor();
  $supervisores = $doc->listar();
  if($supervisores){
    echo "
    <h4>Listado de Instructores</h4>
      <table border='1'><thead>
      <tr>
        <th style='text-align:center'>RFC</th>
        <th style='text-align:center'>Nombre</th>
        <th style='text-align:center'>Apellidos</th>
        <th style='text-align:center'>Acciones</th>
      </tr></thead>";
          if($filtro1 || $filtro2 || $filtro3){
    foreach ($supervisores as $supervisor) {
      if($filtro1 == $supervisor['rfc'] || $filtro2 == $supervisor['nombre'] || $filtro3 == $supervisor['apellidos']){
      echo "<tr>
      <td>".$supervisor['rfc']."</td>
      <td>".$supervisor['nombre']."</td>
      <td>".$supervisor['apellidos']."</td>
      <td style='text-align:center'><img width='30' height='30' src='imgs/delete.png' onClick='borrar(\"".$supervisor['rfc']."\");'></td>
      </tr>";
    }
  }
}else{
  foreach ($supervisores as $supervisor) {
    echo "<tr>
    <td>".$supervisor['rfc']."</td>
    <td>".$supervisor['nombre']."</td>
    <td>".$supervisor['apellidos']."</td>
    <td style='text-align:center'><img width='30' height='30' src='imgs/delete.png' onClick='borrar(\"".$supervisor['rfc']."\");'></td>
    </tr>";
}

  }
  echo "</table>";
}
  else{
    echo " <p>No hay Supervisores registrados en la base de datos</p>";
  }
?>

</div>
           </article>
         </form>
        </section>

        <div id="centrado">
          <input type="button" onClick="location='menuAdmin.php'" value="Regresar" />
        </div>
        <div id="espaciador5"></div>
        <div id="espaciador5"></div>
        <!-- Pie de pagina-->
            <?php include_once 'modulos/mdl_footer.php'; ?>

    </div>
  </center>
    </body>
</html>
