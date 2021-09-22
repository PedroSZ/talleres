<!-- *****ALTA USUARIO ESTUDIANTE (RF-07) -->
<?php
	/********************** VALIDAMOS QUE ESTA PAGINA SEA PARA LA SESION INICIADA ****************/
  include_once 'clases/usuario.php';
  include_once 'clases/sesion.php';
  $userSession = new Sesion();
$codigo = "";
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

$codigo = $_SESSION['user'];
//echo $codigo;
include_once 'clases/instructor.php';
$instructor = new Instructor();
$miprofe = $instructor->consultarCodigo($codigo);
//echo $miprofe["clave"];

include_once 'clases/taller.php';
$taller = new Taller();
$mitaller = $taller->ultimoRegistro();
//echo $mitaller['registro'] +1;

?>

<form method="post" style="width: 500px; height:auto;" onsubmit="return validarTaller()" action="modulos/mdl_solicitarTaller.php" id="frm_regTalleres" >
<input name="codigo" type="hidden" placeholder="Ingresar Id Taller" id ="id" value="<?php echo $mitaller['registro'] +1; ?>">
<input name="instructor" type="hidden" placeholder="Ingresar  instructor" id ="instructor" value="<?php echo $miprofe["clave"]; ?>">
<input name="area" type="hidden" placeholder="Ingresar area" id ="area" value="Sin Asignar">
<input name="estado" type="hidden" placeholder="Ingresar estado" id ="estado" value="Espera">
  <table border="0" style="color:#FFFFFF
  ; font-weight: 600; font-size: 17px;">

  <tr>
    <td style="text-align: right;">
      <p><label>Taller:</label></p>
    </td>
    <td>
      <p><input name="nombre" type="text" onKeyUp="document.getElementById(this.id).value=document.getElementById(this.id).value.toUpperCase()" placeholder="Nombre del Taller" id ="nombre" required></p>
    </td>
  </tr>
  <tr>
   <td style="text-align: right;">
     <p><label>Horario:</label></p>
   </td>
   <td>
     <p>
     <select name="horario" type="text" id ="horario" required>
       <option value="" disabled selected>Seleccione:</option>

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
    </td>
  </tr>
  <tr>
    <td colspan="2" style="text-align: center;">
      <BR>
      <input type="submit" value="Registrar">
      <input type="button" value="Cancelar" onclick="limpiar()">
      <input type="button" onclick="location='menuInstructor.php'" value="Regresar" />
    </td>
  </tr>
  </table>
</form>
