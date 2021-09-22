<?php
	/********************** VALIDAMOS QUE ESTA PAGINA SEA PARA LA SESION INICIADA ****************/
    include_once 'clases/usuario.php';
    include_once 'clases/sesion.php';
	include_once 'clases/estudiante_por_taller.php';
    $userSession = new Sesion();

    if(isset($_SESSION['user'])){
        $user = new Usuario();
        $user->establecerDatos($userSession->getCurrentUser());
        $tipo = $user->getTipo();
		$codigo = $user->getCodigo();
		if($tipo <> 3) header('location: index.php');
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
		 /************************** VALIDAMOS QUE NO ESTE EN UN TALLER *********************/
		$taller = new EstudianteTaller();
		$est = $taller->consultarEstudiante($codigo);
		if($est) {
			echo '<script type="text/javascript">
    alert("Usted ya cuenta con un registro de taller. Si lo requiere solicite el cambio.");
    window.location.href="PerfilEstudiante.php";
    </script>';
		}

    }
    else{
        $userSession->closeSession();
    };




/************************** OBTENER ID DE ESTUDIANTE ************************/
  include_once 'clases/estudiante.php';
  $doc = new Estudiante();
  $alumnos = $doc->consultarCodigo($codigo);
  $dato = $alumnos['curp'];


?>
</!DOCTYPE html>
<html>
    <head>
        <title>SIVRTEC63</title>
        <link rel="stylesheet" href="css/main.css"/>
        <link rel="stylesheet" href="css/forms.css">

		<script language='javascript'>
		function registrar(codigo) {
            document.frm_AltaEnTaller.micodigo.value = codigo;
			//alert(codigo);
            document.frm_AltaEnTaller.submit();
		}
		function regresar(){
			location.href='index.php'
		}
        </script>

        <!--var datos = '<?php /*echo $alumnos['curp']; */?>';
		alert(datos); -->



        <meta charset="UTF-8">

    </head>
    <body>
<center>
    <div id="contenedor">
        <!-- Encabezado de la pagina-->
            <?php include_once 'modulos/mdl_header.php'; ?>
        <!-- contenido principal -->
        <section style="text-align: center; margin: 0 auto; height: 65%">
            <article style="width:60%; height: 100%;text-align: center; margin: 0 auto;">

                 <div class="datagrid">
                 <form method="post" action="modulos/mdl_AltaEnTaller.php" name="frm_AltaEnTaller" id="frm_AltaEnTaller" style="width: auto; height: auto;">
					<input type="hidden" id="micodigo" name="micodigo">
  <?php
  /************************LISTAR TALLERES*****************************/


  include_once 'clases/taller.php';
  include_once 'clases/instructor.php';
  $doc = new Taller();
  $sql = 'SELECT taller.id, taller.nombre AS taller, taller.horario, instructor.nombre, instructor.apellidos FROM `taller` INNER JOIN instructor ON instructor.clave = taller.instructor where estado = "ACTIVO"';
  $talleres = $doc->consulta($sql);

  if($talleres){
    echo "
     <h4>Listado de Talleres</h4>
      <table border='1'><thead>
      <tr>
        <th style='text-align:center'>Id</th>
        <th style='text-align:center'>Nombre</th>
        <th style='text-align:center'>Horario</th>
        <th style='text-align:center'>Instructor</th>
		<th style='text-align:center'>Elegir</th>
      </tr></thead>";
    foreach ($talleres as $taller) {
      echo "<tr>
      <td>".$taller['id']."</td>
      <td>".$taller['taller']."</td>
      <td>".$taller['horario']."</td>
	  <td>".$taller['nombre']." ".$taller['apellidos']."</td>
      <td style='text-align:center'><img width='30' height='30' src='imgs/elegir.png' onClick='registrar(\"".$taller['id']."\");'></td>
      </tr>";
    }
    echo "</table>";
  }
  else{
    echo " <p>No hay talleres para darse de alta</p>";
  }


?>

</div>

           </article>
           </form>
        </section>

<input type="button" onClick="location='menuEstudiante.php'" value="Regresar" />


        <!-- Pie de pagina-->
            <?php include_once 'modulos/mdl_footer.php'; ?>

    </div>
  </center>
    </body>

</html>
