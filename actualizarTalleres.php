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
		include_once 'clases/taller.php';

		$codigo = $_POST['micodigo'];
		 $doc = new Taller();

		//$taller->establecerDatos($codigo);
		$mitaller = $doc->consultarCodigo($codigo);
	//	echo $mitaller["estado"];
//echo $codigo;
	}
	else{
	}
/*/////////////////////////////////CONSULTAMOS INSTRUCTOR ACTUAL PARA EL FORMUARIO///////////////////////////////////////////////////////*/
	include_once 'clases/instructor.php';
	$doc = new Instructor();
	$instructores = $doc->listar();
	$var = $mitaller['instructor'];
	//echo $var;

	if($instructores){

		 foreach ($instructores as $instructor) {
			 if($var == $instructor['clave'] ){

				$claveInstructor = $instructor['clave'];
				 $cadena = $instructor['nombre']." ".$instructor['apellidos'];
				// echo $cadena;
	 }
		 }

	}
	else{
	//$cadena = "NO ASIGNADO";
	// echo " <p>NO ASIGNADO</p>";
	}
/*////////////////////////////////////FINALIZA CONSULTA INSTRUCTOR ACTUAL///////////////////////////////////////////////////*/


?>
</!DOCTYPE html>
<html>
    <head>
        <title>SIVRTEC63</title>
        <link rel="stylesheet" href="css/main.css"/>
        <link rel="stylesheet" href="css/forms.css">
        <!-- <script src="scripts/regDocentes.js" type="text/javascript"></script> onSubmit="return validar()" -->
<script src="scripts/actualizarTalleres.js" type="text/javascript"></script>
        <script language='javascript'>
		function regresar(){
			location.href='listActualizarTaller.php'
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


               <form method="post" onsubmit="return validarTaller()" style="width: auto; height:auto;"  action="modulos/mdl_ActualizarTalleres.php" id="frm_ActualizarTalleres" >

  <table border="0" style="color:#FFFFFF; font-weight: 600; font-size: 17px;">
  <?php

  include_once 'clases/taller.php';


/*////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////*/


	/*////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////*/

	$doc2 = new Taller();
	$instructores2 = $doc2->consultarTallerActual($codigo);
  $rfc_supervisor = $instructores2["rfcSup"];
//	echo $instructores2["rfcSup"];

echo '
  <tr>
    <td width="50%" style="text-align: right;">

      <p><label>Id:</label></p>
    </td>
    <td>
      <p><input name="codigo" type="text" readonly="readonly" placeholder="Ingresa el Id" id ="id" value="'.$mitaller["id"].'"></p>
    </td>
  </tr>
  <tr>
    <td style="text-align: right;">
      <p><label>Nombre</label></p>

    </td>
    <td>
      <p><input name="nombre" type="text" onKeyUp="document.getElementById(this.id).value=document.getElementById(this.id).value.toUpperCase()" placeholder="Ingresa el Nombre" id ="nombre" value="'.$mitaller["nombre"].'"></p>
    </td>
  </tr>
  <tr>
    <td style="text-align: right;">
      <p><label>Area:</label></p>
    </td>
    <td>
      <p><input name="area" id ="area" style="color:#FC6D04;" type="text" onKeyUp="document.getElementById(this.id).value=document.getElementById(this.id).value.toUpperCase()" placeholder="Ingresa el Lugar"  value="'.$mitaller["area"].'"></p>
    </td>
  </tr>

	<tr>
	 <td style="text-align: right;">
		 <p><label>Horario:</label></p>
	 </td>
	 <td>
		 <p>
		 <select name="horario" type="text" id ="horario">
			 <option value="'.$mitaller["horario"].'"  selected>'.$mitaller["horario"].'</option>

			 <option value="07:AM-09:AM">07:AM-09:AM</option>

			 <option value="09:AM-12:PM">09:AM-12:PM</option>

			 <option value="12:PM-14:PM">12:PM-14:PM</option>

			 <option value="14:PM-16:PM">14:PM-16:PM</option>

			 <option value="16:PM-18:PM">16:PM-18:PM</option>

			 <option value="18:PM-20:PM">18:PM-20:PM</option>

			 </select>
		 </p>

	 </td>
 </tr>





  </tr>';?>

  <tr>
    <td style="text-align: right;">
      <p><label>Instructor:</label></p>
    </td>
    <td>
       <p><select name="instructor" type="text" id ="instructor">
     <option value="<?php echo $claveInstructor; ?>"><?php echo $cadena; ?></option>


     <?php

  if($instructores){
    foreach ($instructores as $instructor) {
      echo "<option value='".$instructor['clave']."'>".$instructor['nombre']." ".$instructor['apellidos']."</option>";

    }
  	}
 	 else{
   		 echo "No ha registrado Supervisores";
  		}
	?>
     </p>
    </td>
  </tr>

	<tr>
	 <td style="text-align: right;">
		 <p><label>Supervisor:</label></p>
	 </td>
	 <td>

		 <p><select name="supervisor" type="text" id ="supervisor">
		<option value="<?php echo $rfc_supervisor; ?>"><?php echo $instructores2["nombreSup"]; echo" ";echo $instructores2["apellidosSup"]; ?></option>


		 <?php
 include_once 'clases/supervisor.php';
 $doc = new Supervisor();
 $supervisores = $doc->listar();
 if($supervisores){
	 foreach ($supervisores as $supervisor) {
		 echo "<option value='".$supervisor['rfc']."'>".$supervisor['nombre']." ".$supervisor['apellidos']."</option>";

	 }
	 }
	else{
			echo "No ha registrado Supervisores";
		 }
 ?>
		</p>

<?php
echo'
<tr>
 <td style="text-align: right;">
	 <p><label>Estado:</label></p>
 </td>
 <td>

		<select name="estado" type="text" id ="estado">
		 <option value="'.$mitaller["estado"].'"  selected>'.$mitaller["estado"].'</option>

		 <option value="Activo">Activo</option>
		 <option value="Inactivo">Inactivo</option>
		 <option value="Espera">Espera</option>

		 </select>


 </td>
</tr>
'
/*CAMBIAR FONDO DE CAMPO TEXTO DEPENDIENDO EL VALOR REFERENCIA
https://www.lawebdelprogramador.com/foros/PHP/1615416-cambiar-el-color-de-texto-input-dependiendo-el-valor-ingresado.html*/
?>


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
