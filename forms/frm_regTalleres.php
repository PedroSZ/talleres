<!-- *****ALTA USUARIO ESTUDIANTE (RF-07) -->
<?php
include_once 'clases/taller.php';
$taller = new Taller();
$mitaller = $taller->ultimoRegistro();
//echo $mitaller['registro'] +1;
 ?>
<form method="post" style="width: 500px; height:auto;" onsubmit="return validarTaller()" action="modulos/mdl_regTalleres.php" id="frm_regTalleres" required>
  <table border="0" style="color:#FFFFFF; font-weight: 600; font-size: 17px;">
  <tr>
    <td width="50%" style="text-align: right;">
      <p><label>Id:</label></p>
    </td>
    <td>
      <p><input name="codigo" type="text" readonly="readonly" value="<?php echo $mitaller['registro'] +1; ?>" placeholder="Ingresar Id Taller" id ="id" required></p>
    </td>
  </tr>
  <tr>
    <td style="text-align: right;">
      <p><label>Nombre:</label></p>
    </td>
    <td>
      <p><input name="nombre" type="text" onKeyUp="document.getElementById(this.id).value=document.getElementById(this.id).value.toUpperCase()" placeholder="Ingresar Taller" id ="nombre" required></p>
    </td>
  </tr>
  <tr>
    <td style="text-align: right;">
      <p><label>Area:</label></p>
    </td>
    <td>
      <p><input name="area" type="text" onKeyUp="document.getElementById(this.id).value=document.getElementById(this.id).value.toUpperCase()" placeholder="Ingresr lugar" id ="area" required></p>
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





  <tr>
    <td style="text-align: right;">
      <p><label>Instructor:</label></p>
    </td>
    <td>
       <p><select name="instructor" type="text" id ="instructor" required>

     <?php
  include_once 'clases/instructor.php';
  $doc = new Instructor();
  $instructores = $doc->listar();
  if($instructores){
  echo "<option value='' disabled selected>Seleccione:</option>";
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

      <p><select name="supervisor" type="text" id ="supervisor" required>
    <!-- <option value="listarSupervisor()">Seleccione:</option> -->


      <?php
  include_once 'clases/supervisor.php';
  $doc = new Supervisor();
  $supervisores = $doc->listar();
  if($supervisores){
  echo "<option value='' disabled selected>Seleccione:</option>";
    foreach ($supervisores as $supervisor) {
      echo "<option value='".$supervisor['rfc']."'>".$supervisor['nombre']." ".$supervisor['apellidos']."</option>";

    }
  	}
 	 else{
   		 echo "No ha registrado Supervisores";
  		}
	?>




     </p>

     <tr>
      <td style="text-align: right;">
        <p><label>Estado:</label></p>
      </td>
      <td>
        <p>
        <select name="estado" type="text" id ="estado" required>
          <option value="" disabled selected>Seleccione:</option>

          <option value="Activo">ACTIVO</option>

          <option value="Inactivo">INACTIVO</option>

          <option value="Espera">ESPERA</option>

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
      <input type="button" onclick="location='menuAdmin.php'" value="Regresar" />
    </td>
  </tr>
  </table>
</form>
