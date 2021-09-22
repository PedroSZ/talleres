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
            /* Aquí redireccionas a la url especifica */
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
</!DOCTYPE html>
<html>
    <head>
        <title>SIVRTEC63</title>
        <link rel="stylesheet" href="css/main.css"/>
        <link rel="stylesheet" href="css/forms.css">
        <meta charset="UTF-8">

    </head>
    <body>
      <center>
    <div id="contenedor">
        <!-- Encabezado de la pagina-->
            <?php include_once 'modulos/mdl_header.php'; ?>
        <!-- contenido principal -->
        <section style="text-align: center; margin: 0 auto;">
            <article style="width: 35%px; height: auto;text-align: center; margin: 0 auto;">
    <div class="datagrid">
       <form method="post" action="" name="estiloForm" id="estiloForm" style="width: auto; height: auto;">
            <?php
		 include_once 'clases/instructor.php';
  $doc = new Instructor();
  $instructores = $doc->consultarCodigo($codigo);

    echo "
    <h4>Perfil del Instructor</h4>
      <table border='1'><thead>
      <tr>
        <th style='text-align:center'>Clave</th>
        <th style='text-align:center'>Nombre</th>
        <th style='text-align:center'>Apellidos</th>
		<th style='text-align:center'>Email</th>
		<th style='text-align:center'>Telefono</th>
      </tr></thead>";
      echo "<tr>
      <td>".$instructores['clave']."</td>
      <td>".$instructores['nombre']."</td>
      <td>".$instructores['apellidos']."</td>
	  <td>".$instructores['email']."</td>
	  <td>".$instructores['telefono']."</td>
      </tr>";
    echo "</table>";
  ?>
  <?php
include_once 'clases/taller.php';
$doc = new Taller();
$talleres = $doc->listar();
if($talleres){

  foreach ($talleres as $taller) {
    if($codigo == $taller['instructor'] ){

      echo "
       <h4>Mi taller ".$taller['nombre']."</h4>
         <table border='1'><thead>

       <tr>
           <th style='text-align:center'>No. de Taller</th>
       <td>".$taller['id']."</td>
       </tr>
       <tr>
           <th style='text-align:center'>Lugar</th>
        <td>".$taller['area']."</td>
        </tr>
       <tr>
           <th style='text-align:center'>Horario</th>
       <td>".$taller['horario']."</td>
       </tr>
       <tr>
           <th style='text-align:center'>Estado</th>
       <td>".$taller['estado']."</td>
       </tr>
       <tr></thead>";
              /*supertvisro inicio*/
              $dato3 = $taller['supervisor'];
              include_once 'clases/supervisor.php';
              $sup = new Supervisor();
              $supervisores = $sup->listar();
              if($supervisores){
                foreach ($supervisores as $supervisor) {
                    if($dato3 == $supervisor['rfc'] ){
                      echo "

                       <thead>

                       <th colspan = '2' style='text-align:center'>Supervisor</th>
                       <tr>
                           <th style='text-align:center'>Nombre</th>
                       <td>".$supervisor['nombre']."</td>
                       </tr>
                       <tr>
                           <th style='text-align:center'>Apellidos</th>
                        <td>".$supervisor['apellidos']."</td>
                        </tr>
                       <tr>
                           <th style='text-align:center'>Email</th>
                       <td>".$supervisor['email']."</td>
                       </tr>
                       <tr>
                           <th style='text-align:center'>Telefono</th>
                       <td>".$supervisor['telefono']."</td>
                       </tr>

                       <tr> </thead>";
                    }
                  }
            }else{
              echo " <p>No hay Supervisores en la base de datos</p>";
            }
              /*supertvisro fin*/
                }
  echo "</table>";
}
}
else{
  echo " <p>No hay Talleres registrados en la base de datos</p>";
}

  ?>
</form>
            </div>
           </article>

        </section>
<!-- SECCION PARA QUE EL BOTON QUEDE FUERA DEL LISTADO  -->


          <input type="button" onClick="location='menuInstructor.php'" value="Regresar" />
        </form>


        <!-- Pie de pagina-->
            <?php include_once 'modulos/mdl_footer.php'; ?>

    </div>
  </center>
    </body>
</html>
