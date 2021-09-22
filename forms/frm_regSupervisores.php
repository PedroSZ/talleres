<!-- *****ALTA USUARIO ESTUDIANTE (RF-07) -->



<form method="post" style="width: 500px; height:auto;" onsubmit="return validarSupervisor()" action="modulos/mdl_regSupervisores.php" id="frm_regSupervisores" >
  <table border="0" style="color:#FFFFFF
  ; font-weight: 600; font-size: 17px;">
  <tr>
    <td width="50%" style="text-align: right;">
      <p><label>RFC:</label></p>
    </td>
    <td>
      <p><input name="codigo" type="text" onKeyUp="document.getElementById(this.id).value=document.getElementById(this.id).value.toUpperCase()" placeholder="Ingresar RFC" id ="codigo" required pattern="([A-Z]{4}([0-9]{2})(0[1-9]|1[0-2])(0[1-9]|1[0-9]|2[0-9]|3[0-1])([A-Z0-9]{3,3}))" required></p>
    </td>
  </tr>
  <tr>
    <td style="text-align: right;">
      <p><label>Nombre:</label></p>
    </td>
    <td>
      <p><input name="nombre" type="text" onKeyUp="document.getElementById(this.id).value=document.getElementById(this.id).value.toUpperCase()" placeholder="Ingresar Nombre" id ="nombre" required pattern="[A-ZÑÁÉÍÓÚ ]+" title="Ingresa al menos un nombre por favor " required></p>
    </td>
  </tr>
  <tr>
    <td style="text-align: right;">
      <p><label>Apellidos:</label></p>
    </td>
    <td>
      <p><input name="apellidos" type="text" onKeyUp="document.getElementById(this.id).value=document.getElementById(this.id).value.toUpperCase()" placeholder="Ingresar Apellidos" id ="apellidos" required pattern="[A-ZÑÁÉÍÓÚ ]+" title="Ingresa al menos un apellido por favor " required></p>
    </td>
  </tr>
   <tr>
    <td style="text-align: right;">
      <p><label>Email:</label></p>
    </td>
    <td>
      <p><input name="email" type="email" placeholder="Ingresar  Email" id ="email" required pattern="^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$" title="Por favor ingresa un correo con el formato nombre@sitio.dominio" required></p>
    </td>
  </tr>
  <tr>
    <td style="text-align: right;">
      <p><label>Telefono:</label></p>
    </td>
    <td>
      <p><input name="telefono" type="tel" pattern="[0-9]{10}" placeholder="Eje. 375456988" id ="telefono" required></p>
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
      <p><input name="psw2" type="password" placeholder="Vuelve a escribir la Contraseña"  id ="psw2" minlength="8" required></p>
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
