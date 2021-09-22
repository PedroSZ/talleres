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
?>
</!DOCTYPE html>
<html>
    <head>
        <title>SIVRTEC63</title>
        <link rel="stylesheet" href="css/main.css"/>
        <link rel="stylesheet" href="css/forms.css">
        <!-- <script src="scripts/regDocentes.js" type="text/javascript"></script> onSubmit="return validar()" -->
  <script src="scripts/regEstudiantes.js" type="text/javascript"></script>
        <script language='javascript'>
		function regresar(){
			location.href='listActualizarEstudiante.php'
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
            <article id="fondo"  style="width: 30%; height:auto" >


               <form method="post" style="width: auto; height:auto;" onsubmit="return validar()" action="modulos/mdl_ActualizarEstudiantes.php" id="frm_ActualizarEstudiantes" >

  <table border="0" style="color:#FFFFFF; font-weight: 600; font-size: 17px;">
  <?php
echo '
  <tr>
    <td width="50%" style="text-align: right;">

      <p><label>Código:</label></p>
    </td>
    <td>
      <p><input name="codigo" type="text" readonly="readonly" placeholder="Ingresa el Codigo" id ="codigo" value="'.$miest["curp"].'"></p>
    </td>
  </tr>
  <tr>
    <td style="text-align: right;">
      <p><label>Nombre</label></p>

    </td>
    <td>
      <p><input name="nombre" type="text" placeholder="Ingresa el Nombre" id ="nombre" onKeyUp="document.getElementById(this.id).value=document.getElementById(this.id).value.toUpperCase()" value="'.$miest["nombre"].'"></p>
    </td>
  </tr>
  <tr>
    <td style="text-align: right;">
      <p><label>Apellidos:</label></p>
    </td>
    <td>
      <p><input name="apellidos" type="text" placeholder="Ingresa los Apellidos" id ="apellidos" onKeyUp="document.getElementById(this.id).value=document.getElementById(this.id).value.toUpperCase()" value="'.$miest["apellidos"].'"></p>

			<tr>
	     <td style="text-align: right;">
	       <p><label>Carrera:</label></p>
	     </td>
	     <td>
	       <p>
	       <select name="carrera" type="text" id ="carrera">
	         <option value="'.$miest["carrera"].'"  selected>'.$miest["carrera"].'</option>

	         <option value="CONTABILIDAD">CONTABILIDAD</option>

	         <option value="PROGRAMACIÓN">PROGRAMACIÓN</option>

	         <option value="OFIMÁTICA">OFIMÁTICA</option>

	         <option value="ELECTRÓNICA">ELECTRÓNICA</option>

	         <option value="MECÁNICA INDUSTRIAL">MECÁNICA INDUSTRIAL</option>

					  <option value="COMPONENTE BASICO Y PROPEDEUTICO">COMPONENTE BASICO Y PROPEDEUTICO</option>

	         </select>
	       </p>

	     </td>
	   </tr>

		 <tr>
	     <td style="text-align: right;">
	       <p><label>Grado:</label></p>
	     </td>
	     <td>
	        <p>
	       <select name="grado" type="text" id ="grado">
	         <option value="'.$miest["grado"].'"  selected>'.$miest["grado"].'</option>

	         <option value="1.">1ro.</option>

	         <option value="2.">2do.</option>

	         <option value="3.">3ro.</option>

	         <option value="4.">4to.</option>

	         <option value="5.">5to.</option>

	         <option value="6.">6to.</option>

	         </select>
	       </p>
	     </td>
	   </tr>

		 <tr>
	     <td style="text-align: right;">
	       <p><label>Grupo:</label></p>
	     </td>
	     <td>

	        <select name="grupo" type="text" id ="grupo">
	         <option value="'.$miest["grupo"].'" selected>'.$miest["grupo"].'</option>

	         <option value="A">A</option>

	         <option value="B">B</option>

	         <option value="C">C</option>

	         <option value="D">D</option>

					 <option value="E">E</option>

					 <option value="F">F</option>

	         </select>


	     </td>
	   </tr>

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
<br>
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
