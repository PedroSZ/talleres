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
          <script src="scripts/regEstudiantes.js" type="text/javascript"></script>
        <!-- <script src="scripts/regDocentes.js" type="text/javascript"></script> onSubmit="return validar()" -->

        <script language='javascript'>
		function regresar(){
			location.href='menuEstudiante.php'
		}
        </script>

         <meta charset="UTF-8">
    </head>
    <body>

    <div id="contenedor">
        <!-- Encabezado de la pagina-->
            <?php include_once 'modulos/mdl_header.php'; ?>
        <!-- contenido principal -->
        <section>
            <article id="fondo" style="width: 600px; height:auto; ">


               <form method="post" style="width: auto; height:auto;" onsubmit="return validar()" action="modulos/mdl_ActualizarPerfilEstudiantes.php" id="frm_ActualizarEstudiantes" >

  <table border="0" style="color:#FFFFFF; font-weight: 600; font-size: 17px;">
  <?php
   include_once 'clases/estudiante.php';
  $doc = new Estudiante();
  $alumnos = $doc->consultarCodigo($codigo);
echo '
  <tr>
    <td width="50%" style="text-align: right;">

      <p><label>CURP:</label></p>
    </td>
    <td>
      <p><input name="ver_codigo" type="text" disabled="disabled" id ="ver_codigo" value="'.$alumnos["curp"].'">
         <input name="codigo" type="hidden" id ="codigo" value="'.$alumnos["curp"].'"></p>
    </td>
  </tr>
  <tr>
    <td style="text-align: right;">
      <p><label>Nombre</label></p>

    </td>
    <td>
      <p><input name="nombre" type="text" placeholder="Ingresa el Nombre" id ="nombre" onKeyUp="document.getElementById(this.id).value=document.getElementById(this.id).value.toUpperCase()" value="'.$alumnos["nombre"].'"></p>
    </td>
  </tr>
  <tr>
    <td style="text-align: right;">
      <p><label>Apellidos:</label></p>
    </td>
    <td>
      <p><input name="apellidos" type="text" placeholder="Ingresa los Apellidos" id ="apellidos" onKeyUp="document.getElementById(this.id).value=document.getElementById(this.id).value.toUpperCase()" value="'.$alumnos["apellidos"].'"></p>
    </td>
  </tr>
  <tr>
    <td style="text-align: right;">
      <p><label>Carrera:</label></p>
    </td>
    <td>
      <p><input name="carrera" type="text" readonly="readonly" placeholder="Ingresa la carrera" id ="carrera" title="No tiene permiso para editar este campo" value="'.$alumnos["carrera"].'"></p>
    </td>
  </tr>
  <tr>
    <td style="text-align: right;">
      <p><label>grado:</label></p>
    </td>
    <td>
      <p><input name="grado" type="text" readonly="readonly" placeholder="Ingresa el grado" id ="grado" title="No tiene permiso para editar este campo" value="'.$alumnos["grado"].'"></p>
    </td>

	 <tr>
    <td style="text-align: right;">
      <p><label>Grupo:</label></p>
    </td>
    <td>
      <p><input name="grupo" type="text" readonly="readonly" placeholder="Ingresa el grupo" id ="grupo" title="No tiene permiso para editar este campo" value="'.$alumnos["grupo"].'"></p>
    </td>
  </tr>

  </tr>';?>
  <tr>
    <td style="text-align: right;">
      <p><label>Contraseña:</label></p>
    </td>
    <td>
      <p><input name="psw1" type="password" placeholder="Ingresa tu Contraseña"  id ="psw1" minlength="8" required pattern="[A-Za-z][A-Za-z0-9]*[0-9][A-Za-z0-9]*" title="Por favor ingresa una contraseña que inicie con una letra y tenga al menos 8 caracteres y un número como mínimo"></p>
    </td>
  </tr>
  <tr>
    <td style="text-align: right;">
      <p><label>Confirmar Contraseña:</label></p>
    </td>
    <td>
      <p><input name="psw2" type="password" placeholder="Vuelve a escribir tu Contraseña"  id ="psw2"></p>
    </td>
  </tr>



  <tr>
    <td colspan="2" style="text-align: center;">
      <BR>
      <input type="submit" value="Actualizar">
      <input type="button" value="Regresar" onClick="regresar()">
    </td>
  </tr>
  </table>
</form>
            </article>
        </section>
      
        <!-- Pie de pagina-->
            <?php include_once 'modulos/mdl_footer.php'; ?>

    </div>
    </body>
</html>
