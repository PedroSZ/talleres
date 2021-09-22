  <div class="datagrid">
  <?php /*
  include_once 'clases/estudiante.php';
  $doc = new Estudiante();
  $alumnos = $doc->listar();
  if($alumnos){
    echo "
    <h4>Listado de Estudiantes</h4>
      <table border='1'><thead>
      <tr>
        <th style='text-align:center'>Código</th>
        <th style='text-align:center'>Nombre</th>
        <th style='text-align:center'>Apellidos</th>
        <th style='text-align:center'>Acciones</th>
      </tr></thead>";
    foreach ($alumnos as $alumno) {
      echo "<tr>
      <td>".$alumno['codigo']."</td>
      <td>".$alumno['nombre']."</td>
      <td>".$alumno['apellidos']."</td>
      <td style='text-align:center'> <img width='30' height='30' src='imgs/delete.png' onclic='borrar('".$alumno['codigo']."')'></td>
      </tr>";
    }
    echo "</table>";
  }
  else{
    echo " <p>No hay estudiantes registrados en la base de datos</p>";
  }
?>
</div>
<br>
<form method="post" action="modulos/mdl_delEstudiantes.php" id="frm_listEstudiantes.php" >
<input type="hidden" id="codigo" name="codigo">
<input type="button" value="Regresar" onclick="regresar()">
</form>*/
