
<?php
if (isset($_POST['enviar'])) {
   if (comprobar_email($_POST['email']))
      echo 'El email introducido es correcto!';
   else
      echo 'El email introducido NO es correcto!';
}
?>
<!-- *****ALTA USUARIO ESTUDIANTE (RF-07) -->
<form method="post" style="width: 500px; height:auto;" onsubmit="return validarInstructor()" action="modulos/mdl_regInstructores.php" id="frm_regInstructores" >
  <table border="0" style="color:#FFFFFF; font-weight: 600; font-size: 17px;">
  <tr>
    <td width="50%" style="text-align: right;">
      <p><label>Clave:</label></p>
    </td>
    <td>
      <p><input name="codigo" type="text" onKeyUp="document.getElementById(this.id).value=document.getElementById(this.id).value.toUpperCase()" placeholder="Ingresar Clave" id ="codigo"  minlength="6" required pattern="[A-Za-z][A-Za-z0-9]*[0-9][A-Za-z0-9]*" title="La clave debe iniciar con una letra, debe haber al menos un número y mínimo 6 caracteres" required></p>
    </td>
  </tr>
  <tr>
    <td style="text-align: right;">
      <p><label>Nombre:</label></p>
    </td>
    <td>
      <p><input name="nombre" type="text" onKeyUp="document.getElementById(this.id).value=document.getElementById(this.id).value.toUpperCase()" placeholder="Ingresar Nombre" id ="nombre"  title="Ingresa al menos un nombre por favor" required></p>
    </td>
  </tr>
  <tr>
    <td style="text-align: right;">
      <p><label>Apellidos:</label></p>
    </td>
    <td>
      <p><input name="apellidos" type="text" onKeyUp="document.getElementById(this.id).value=document.getElementById(this.id).value.toUpperCase()" placeholder="Ingresr Apellidos" id ="apellidos"  title="Ingresa al menos un apellido por favor " required></p>
    </td>
  </tr>
   <tr>
    <td style="text-align: right;">
      <p><label>Email:</label></p>
    </td>
    <td>
      <p><input name="email"  type="email" placeholder="Ingresar Email" id ="email" required pattern="^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$" title="Por favor ingresa un correo con el formato nombre@sitio.dominio" required></p>
    </td>
  </tr>
  <tr>
    <td style="text-align: right;">
      <p><label>Telefono:</label></p>
    </td>
    <td>
      <p><input name="telefono" type="tel" placeholder="Eje. 375456988" required pattern="[0-9]{10}" id ="telefono" title="Por favor ingresa un número de 10 dígitos sin espacios si no tienes un número solo ingresa 10 números al azar" required></p>
    </td>
  </tr>
  <tr>
    <td style="text-align: right;">
      <p><label>Contraseña:</label></p>
    </td>
    <td>
      <p><input name="psw1" type="password" placeholder="Ingresar Contraseña"  id ="psw1" minlength="8" required pattern="[A-Za-z][A-Za-z0-9]*[0-9][A-Za-z0-9]*" title="Por favor ingresa una contraseña que inicie con una letra y tenga al menos 8 caracteres y un número como mínimo" required></p>
    </td>
  </tr>
  <tr>
    <td style="text-align: right;">
      <p><label>Confirmar Contraseña:</label></p>
    </td>
    <td>
      <p><input name="psw2" type="password" placeholder="Vuelve a escribir la Contraseña"  id ="psw2"minlength="8" required></p>
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
