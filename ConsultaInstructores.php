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
  $filtro1 = $_POST['FiltarCodigo']; //para obtener la curp a buscar del fitro
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
		function consultar(codigo) {
            document.frm_ConsultarInstructores.micodigo.value = codigo;
			//alert(codigo);
            document.frm_ConsultarInstructores.submit();
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
                           <form method="post" action="listActualizarInstructor.php" name="form_filtro" id="form_filtro" style="align-items: center; background:rgba(0,0,0,0.0);">
                           <table border="0" style="color:#FFFFFF; font-weight: 600; font-size: 17px;">
                           <tr>
                             <td width="50%" style="text-align: right;">
                               <p>

                               <input name="FiltarCodigo" type="text"  placeholder="Buscar por Codigo" id ="FiltarCodigo" onKeyUp="document.getElementById(this.id).value=document.getElementById(this.id).value.toUpperCase()" >
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
        <article style="width:85%; height: 100%;text-align: center; margin: 0 auto;">
             <div class="datagrid">

                 <form method="post" action="PerfilInstructorAdmin.php" name="frm_ConsultarInstructores" id="frm_ConsultarInstructores" style="width: auto; height: auto;">
					<input type="hidden" id="micodigo" name="micodigo">
  <?php
  include_once 'clases/instructor.php';
  $ins = new Instructor();
  $instructores = $ins->listar();
  if($instructores){
    echo "
    <h4>Listado de Instructores</h4>
      <table border='1'><thead>
      <tr>
        <th style='text-align:center'>Clave</th>
        <th style='text-align:center'>Nombre</th>
        <th style='text-align:center'>Apellidos</th>
		<th style='text-align:center'>Email</th>
		<th style='text-align:center'>Telefono</th>
		<th style='text-align:center'>Editar</th>
      </tr></thead>";
      if($filtro1 || $filtro2 || $filtro3){
    foreach ($instructores as $instructor) {
        if($filtro1 == $instructor['clave'] || $filtro2 == $instructor['nombre'] || $filtro3 == $instructor['apellidos']){
      echo "<tr>
      <td>".$instructor['clave']."</td>
      <td>".$instructor['nombre']."</td>
      <td>".$instructor['apellidos']."</td>
	  <td>".$instructor['email']."</td>
	  <td>".$instructor['telefono']."</td>

      <td style='text-align:center'><img width='30' height='30' src='imgs/usuarios.png' onClick='consultar(\"".$instructor['clave']."\");'></td>
      </tr>";
      }
    }


}else{
  foreach ($instructores as $instructor) {
    echo "<tr>
    <td>".$instructor['clave']."</td>
    <td>".$instructor['nombre']."</td>
    <td>".$instructor['apellidos']."</td>
  <td>".$instructor['email']."</td>
  <td>".$instructor['telefono']."</td>

    <td style='text-align:center'><img width='30' height='30' src='imgs/usuarios.png' onClick='consultar(\"".$instructor['clave']."\");'></td>
    </tr>";
  }
}
    echo "</table>";
}
  else{
    echo " <p>No hay instructores registrados en la base de datos</p>";
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
