
<form method="post" style="width: 500px; height:auto;"  onsubmit="return validar()" action="modulos/mdl_regEstudiantes.php" id="frm_regEstudiantes" >
  <table border="0" style="color:#FFFFFF; font-weight: 600; font-size: 17px;">
  <tr>
    <td width="50%" style="text-align: right;">
      <p><label>CURP:</label></p>
    </td>
    <td>
      <p><input name="codigo" type="text"  placeholder="Ingresar CURP" id ="codigo" onKeyUp="document.getElementById(this.id).value=document.getElementById(this.id).value.toUpperCase()"  pattern="([A-Z Ñ]{4}([0-9]{2})(0[1-9]|1[0-2])(0[1-9]|1[0-9]|2[0-9]|3[0-1])[HM](AS|BC|BS|CC|CL|CM|CS|CH|DF|DG|GT|GR|HG|JC|MC|MN|MS|NT|NL|OC|PL|QT|QR|SP|SL|SR|TC|TS|TL|VZ|YN|ZS|NE)[A-Z]{3}[0-9A-Z]\d)" title="Por favor ingresa solo un formato CURP por ejemplo
SAJG990112HJCLPD04" required></p>
    </td>
  </tr>
  <tr>
    <td style="text-align: right;">
      <p><label>Nombre:</label></p>
    </td>
    <td>
      <p><input name="nombre" type="text" onKeyUp="document.getElementById(this.id).value=document.getElementById(this.id).value.toUpperCase()" placeholder="Ingresar Nombre" id ="nombre" required pattern="[A-ZÑ ]+" title="Ingresa al menos un nombre por favor " required></p>
    </td>
  </tr>
  <tr>
    <td style="text-align: right;">
      <p><label>Apellidos:</label></p>
    </td>
    <td>
      <p><input name="apellidos" type="text" onKeyUp="document.getElementById(this.id).value=document.getElementById(this.id).value.toUpperCase()" placeholder="Ingresar Apellidos" id ="apellidos" required pattern="[A-ZÑ ]+" title="Ingresa al menos un apellido por favor " required></p>
    </td>
  </tr>
   <tr>
    <td style="text-align: right;">
      <p><label>Carrera:</label></p>
    </td>
    <td>
      <p>
      <select name="carrera" type="text" id ="carrera" required>
        <option value="" disabled selected>Seleccione:</option>

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
      <select name="grado" type="text" id ="grado" required>
        <option value="" disabled selected>Seleccione:</option>

        <option value="1">1ro.</option>

        <option value="2">2do.</option>

        <option value="3">3ro.</option>

        <option value="4">4to.</option>

        <option value="5">5to.</option>

        <option value="6">6to.</option>

        </select>
      </p>
    </td>
  </tr>

  <tr>
    <td style="text-align: right;">
      <p><label>Grupo:</label></p>
    </td>
    <td>

       <select name="grupo" type="text" id ="grupo" required>
        <option value="" disabled selected>Seleccione:</option>

        <option value="A">A</option>

        <option value="B">B</option>

        <option value="C">C</option>

        <option value="D">D</option>

        <option value="E">E</option>

        <option value="F">F</option>

        </select>


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
