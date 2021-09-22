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
?>


</!DOCTYPE html>
<html>
    <head>
        <title>SIVRTEC63</title>
        <link rel="stylesheet" href="css/main.css"/>
        <link rel="stylesheet" href="css/forms.css">
          <script src="scripts/regInstructores.js" type="text/javascript"></script>


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


               <form method="post" style="width: auto;" onsubmit="return validarInstructor()"  action="modulos/mdl_ActualizarPerfilInstructores.php" id="frm_ActualizarInstructores" >

  <table border="0" style="color:#FFFFFF; font-weight: 600; font-size: 17px;">
  <?php
  include_once 'clases/instructor.php';
  $doc = new Instructor();
  $instructores = $doc->consultarCodigo($codigo);

  echo '
    <tr>
      <td width="50%" style="text-align: right;">

        <p><label>Código:</label></p>
      </td>
      <td>
        <p><input name="ver_codigo" type="text" disabled="disabled" placeholder="Ingresa el Codigo" id ="ver_codigo" value="'.$instructores["clave"].'">
           <input name="codigo" type="hidden" id ="codigo" value="'.$instructores["clave"].'"></p>
      </td>
    </tr>
    <tr>
      <td style="text-align: right;">
        <p><label>Nombre</label></p>

      </td>
      <td>
        <p><input name="nombre" type="text" onKeyUp="document.getElementById(this.id).value=document.getElementById(this.id).value.toUpperCase()" placeholder="Ingresa el Nombre" id ="nombre" value="'.$instructores["nombre"].'"></p>
      </td>
    </tr>
    <tr>
      <td style="text-align: right;">
        <p><label>Apellidos:</label></p>
      </td>
      <td>
        <p><input name="apellidos" type="text" onKeyUp="document.getElementById(this.id).value=document.getElementById(this.id).value.toUpperCase()" placeholder="Ingresa los Apellidos" id ="apellidos" value="'.$instructores["apellidos"].'"></p>

  	   <tr>
      <td style="text-align: right;">
        <p><label>Email</label></p>

      </td>
      <td>
        <p><input name="email" type="text" placeholder="Ingresa el Nombre" id ="email" value="'.$instructores["email"].'"></p>
      </td>
    </tr>

  	  <tr>
      <td style="text-align: right;">
        <p><label>Telefono</label></p>

      </td>
      <td>
        <p><input name="telefono" type="text" placeholder="Ingresa el Telefono" id ="telefono" value="'.$instructores["telefono"].'"></p>
      </td>
    </tr>

      </td>
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
        <div id="espaciador"></div>
          <div id="espaciador5"></div>
              <div id="espaciador5"></div>
        <!-- Pie de pagina-->
            <?php include_once 'modulos/mdl_footer.php'; ?>

    </div>
    </body>
</html>
