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

<?php
	if(!empty($_POST['micodigo'])){
		include_once 'clases/supervisor.php';
		include_once 'clases/usuario.php';
		$codigo = $_POST['micodigo'];
		$sup = new Supervisor();
		$usuario = new Usuario();
		$usuario->establecerDatos($codigo);
		$misup = $sup->consultarCodigo($codigo);

	}
	else{

	}
?>
</!DOCTYPE html>
<html>
    <head>
        <title>SIVRTEC63</title>
        <link rel="stylesheet" href="css/main.css"/>
        <link rel="stylesheet" href="css/forms.css">
				<script src="scripts/regSupervisores.js" type="text/javascript"></script>
        <!-- <script src="scripts/regDocentes.js" type="text/javascript"></script> onSubmit="return validar()" -->

        <script language='javascript'>
		function regresar(){
			location.href='listActualizarSupervisor.php'
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
                <P><BR></P>

               <form method="post" style="width: 500px;" onsubmit="return validarSupervisor()" action="modulos/mdl_ActualizarSupervisores.php" id="frm_ActualizarSupervisores" >

  <table border="0" style="color:#FFFFFF; font-weight: 600; font-size: 17px;">
  <?php

echo '
  <tr>
    <td width="50%" style="text-align: right;">

      <p><label>RFC:</label></p>
    </td>
    <td>
      <p><input name="codigo" type="text" readonly="readonly" placeholder="Ingresa el RFC" id ="codigo" value="'.$misup["rfc"].'"></p>
    </td>
  </tr>
  <tr>
    <td style="text-align: right;">
      <p><label>Nombre</label></p>

    </td>
    <td>
      <p><input name="nombre" type="text" placeholder="Ingresa el Nombre" id ="nombre" onKeyUp="document.getElementById(this.id).value=document.getElementById(this.id).value.toUpperCase()" value="'.$misup["nombre"].'"></p>
    </td>
  </tr>
  <tr>
    <td style="text-align: right;">
      <p><label>Apellidos:</label></p>
    </td>
    <td>
      <p><input name="apellidos" type="text" placeholder="Ingresa los Apellidos" id ="apellidos" onKeyUp="document.getElementById(this.id).value=document.getElementById(this.id).value.toUpperCase()" value="'.$misup["apellidos"].'"></p>
    </td>
  </tr>
  <tr>
    <td style="text-align: right;">
      <p><label>Email:</label></p>
    </td>
    <td>
      <p><input name="email" type="text" placeholder="Ingresa el Email" id ="email" value="'.$misup["email"].'"></p>
    </td>
  </tr>
  <tr>
    <td style="text-align: right;">
      <p><label>Telefono:</label></p>
    </td>
    <td>
      <p><input name="telefono" type="text" placeholder="Ingresa el grado" id ="telefono" value="'.$misup["telefono"].'"></p>
    </td>


  </tr>';?>
  <tr>
    <td style="text-align: right;">
      <p><label>Contraseña:</label></p>
    </td>
    <td>
      <p><input name="psw1" type="password" placeholder="Ingresa tu Contraseña"  id ="psw1"></p>
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
