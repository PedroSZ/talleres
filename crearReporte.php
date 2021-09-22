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
<?php
	if(!empty($_POST['micodigo'])){
		include_once 'clases/estudiante.php';
		include_once 'clases/usuario.php';
		$codigo = $_POST['micodigo'];
		$est = new Estudiante();
		$usuario = new Usuario();
		$usuario->establecerDatos($codigo);
		$tipo = $usuario->getTipo();
		$miest = $est->consultarCodigo($codigo);
	}
	else{

	}
	//echo $codigo;
    include_once 'clases/taller.php';
    $taller = new Taller();
    $datosTaller = $taller->consultarSupervisorPorInstructor($codigo);
//  echo $datosTaller['supervisor'];
?>

</!DOCTYPE html>
<html>
    <head>
        <title>SIVRTEC63</title>
        <link rel="stylesheet" href="css/main.css"/>
        <link rel="stylesheet" href="css/forms.css">
        <!-- <script src="scripts/regDocentes.js" type="text/javascript"></script> onSubmit="return validar()" -->

        <script language='javascript'>
		function regresar(){
			location.href='reportarPorTaller.php'
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
            <article id="fondo" style="width: 600px; height: 350px; ">
                <P><BR></P>

               <form method="post" style="width: 500px;"  action="modulos/mdl_crearReporte.php" id="frm_crearReporte" >
 <!-- <input type="hidden" id="autor" name="micodigo"> -->
								<input type="hidden" id="autor" name="autor" value="<?php echo $datosTaller['supervisor'];?>">
  <table border="0" style="color:#FFFFFF; font-weight: 600; font-size: 17px;">
  <?php
echo '

  <tr>
    <td style="text-align: right;">
      <p><label>Titulo</label></p>

    </td>
    <td>
      <p><input name="titulo" type="text" placeholder="Ingresa el Titulo del Reporte" id ="titulo" ></p>
    </td>
  </tr>

	<tr>
    <td style="text-align: right;">
      <p><label>Descripción</label></p>

    </td>
    <td>
      <p>
      <textarea class=estilotextarea name="descripcion" cols="25" rows="3" maxlength="50" placeholder="Ingresa la descripción del Reporte máximo 50 caracteres" id ="descricion"></textarea> </p>

    </td>
  </tr>

  <tr>
    <td style="text-align: right;">
      <p><label>Estudiante Reportado:</label></p>
    </td>
    <td>
      <p><input name="reportado" type="hidden"  id ="reportado" value="'.$miest["curp"].'"></p>
			  <p><input name="nombre" type="text" readonly="readonly" id ="nombre" value="'.$miest["nombre"].' '.$miest["apellidos"].'"></p>

    </td>
  </tr>';?>

  <tr>
    <td colspan="2" style="text-align: center;">
      <BR>
      <input type="submit" value="Reportar">

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
