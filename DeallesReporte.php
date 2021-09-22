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
</!DOCTYPE html>
<html>
    <head>
        <title>SIVRTEC63</title>
        <link rel="stylesheet" href="css/main.css"/>
        <link rel="stylesheet" href="css/forms.css">

        <script language='javascript'>
		     function registrar(codigo) {
            document.frm_Sancionar.micodigo.value = codigo;
			         alert(codigo);
            document.frm_Sancionar.submit();
		        }
        </script>
        <meta charset="UTF-8">

    </head>
    <body>
<center>
    <div id="contenedor">
        <!-- Encabezado de la pagina-->
            <?php include_once 'modulos/mdl_header.php'; ?>
        <!-- contenido principal -->
        <section style="text-align: center; margin: 0 auto; height: 100%">
            <article style="width:60%; height: 100%;text-align: center; margin: 0 auto;">
<div class="datagrid">
     <form method="post" action="modulos/mdl_sancionar.php" name="frm_Sancionar" id="frm_Sancionar" style="width: auto; height: auto;">

       <input name="micodigo" style="visibility:hidden" type="text" id ="codigo" value="<?php echo"$dato"; ?>">
            <?php
            /*Reporte*/
            if(!empty($_POST['micodigo'])){
              $codigo = $_POST['micodigo'];
            include_once 'clases/reporte.php';
            $rep = new Reporte();
            $reportes = $rep->listar();
            if($reportes){

              foreach ($reportes as $reporte) {
                if($codigo == $reporte['clave'] ){

                  echo "
                   <h4> </h4>
                     <table border='1'><thead>
                      <th colspan = '2' style='text-align:center'>Destalles</th>
                   <tr>
                       <th style='text-align:center'>No. Reporte</th>
                   <td>".$reporte['clave']."</td>
                   </tr>
                   <tr>
                       <th style='text-align:center'>Titulo</th>
                    <td>".$reporte['titulo']."</td>
                    </tr>
                   <tr>
                       <th style='text-align:center'>Descripcion</th>
                   <td>".$reporte['descripcion']."</td>
                   </tr>

                   <tr></thead>";
                      /*fin reporte*/

                          /*Reportado */
                          $dato3 = $reporte['reportado'];
                          include_once 'clases/estudiante.php';
                          $est = new Estudiante();
                          $estudiantes = $est->listar();
                          if($estudiantes){
                            foreach ($estudiantes as $estudiante) {
                                if($dato3 == $estudiante['curp'] ){
                                  echo "
                                   <thead>

                                   <th colspan = '2' style='text-align:center'>Reportado</th>
                                   <tr>
                                       <th style='text-align:center'>Nombre</th>
                                   <td>".$estudiante['nombre']."</td>
                                   </tr>
                                   <tr>
                                       <th style='text-align:center'>Apellidos</th>
                                    <td>".$estudiante['apellidos']."</td>
                                    </tr>
                                   <tr>
                                       <th style='text-align:center'>Carrera</th>
                                   <td>".$estudiante['carrera']."</td>
                                   </tr>
                                   <tr>
                                       <th style='text-align:center'>Grado</th>
                                   <td>".$estudiante['grado']."</td>
                                   </tr>
                                   <tr>
                                       <th style='text-align:center'>Grupo</th>
                                   <td>".$estudiante['grupo']."</td>
                                   </tr>

                                   <tr> </thead>";
                                }
                              }
                        }else{
                          echo " <p>No hay Estudiantes Reportados</p>";
                        }
                          /*reportado fin*/

                          /*Taller */
                          $dato4 = $reporte['reportado'];
                          include_once 'clases/estudiante_por_taller.php';
                          $estTall = new EstudianteTaller();
                          $estudiantesTall = $estTall->listar();
                          if($estudiantesTall){
                            foreach ($estudiantesTall as $estTal) {
                                if($dato4 == $estTal['estudiante'] ){
                                  echo "
                                   <thead>
                                   <th colspan = '2' style='text-align:center'>Taller</th>
                                   <tr>
                                       <th style='text-align:center'>Id</th>
                                    <td>".$estTal['taller']."</td>
                                    </tr>
                                   <tr>
                                   <tr> </thead>";
                                   /*datos taller*/
                                   $dato5 = $estTal['taller'];
                                   include_once 'clases/taller.php';
                                   $tall = new Taller();
                                   $talleres = $tall->listar();
                                   if($talleres){
                                     foreach ($talleres as $taller) {
                                         if($dato5 == $taller['id'] ){
                                           echo "

                                            <thead>
                                            <tr>
                                                <th style='text-align:center'>Nombre</th>
                                            <td>".$taller['nombre']."</td>
                                            </tr>
                                            <tr>
                                                <th style='text-align:center'>Lugar</th>
                                             <td>".$taller['area']."</td>
                                             </tr>
                                            <tr>
                                            <tr>
                                                <th style='text-align:center'>Horario</th>
                                             <td>".$taller['horario']."</td>
                                             </tr>
                                            <tr>
                                            <tr> </thead>";
                                         }
                                       }
                                   }else{
                                   echo " <p>No hay Estudiantes Reportados</p>";
                                   }
                                   /*fin datos taller*/
                                }
                              }


                        }else{
                          echo " <p>No hay Estudiantes Reportados</p>";
                        }
                          /*taller fin*/

                          /*Instructor */
                          $dato6 = $taller['instructor'];
                          include_once 'clases/instructor.php';
                          $inst = new Instructor();
                          $instructores = $inst->listar();
                          if($instructores){
                            foreach ($instructores as $instructor) {
                                if($dato6 == $instructor['clave'] ){
                                  echo "
                                   <thead>
                                   <th colspan = '2' style='text-align:center'>Instructor</th>
                                   <tr>
                                       <th style='text-align:center'>Nombre</th>
                                   <td>".$instructor['nombre']."</td>
                                   </tr>
                                   <tr>
                                       <th style='text-align:center'>Apellidos</th>
                                    <td>".$instructor['apellidos']."</td>
                                    </tr>
                                   <tr>
                                       <th style='text-align:center'>Carrera</th>
                                   <td>".$instructor['email']."</td>
                                   </tr>
                                   <tr>
                                       <th style='text-align:center'>Grado</th>
                                   <td>".$instructor['telefono']."</td>
                                   </tr>
                                   <tr> </thead>";
                                }
                              }
                          }else{
                          echo " <p>No hay Estudiantes Reportados</p>";
                          }
                          /*Instructor fin*/
                          /*Supervisor */
                          $dato7 = $taller['supervisor'];
                          include_once 'clases/supervisor.php';
                          $sup = new Supervisor();
                          $supervisores = $sup->listar();
                          if($supervisores){
                            foreach ($supervisores as $supervisor) {
                                if($dato7 == $supervisor['rfc'] ){
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
                                       <th style='text-align:center'>Carrera</th>
                                   <td>".$supervisor['email']."</td>
                                   </tr>
                                   <tr>
                                       <th style='text-align:center'>Grado</th>
                                   <td>".$supervisor['telefono']."</td>
                                   </tr>
                                   <tr> </thead>";
                                }
                              }
                          }else{
                          echo " <p>No hay Estudiantes Reportados</p>";
                          }
                          /*Supervisor fin*/

                            }
              echo "</table>";
            }
            }
            else{
              echo " <p>No hay Reportes registrados</p>";
            }
}
else{
  echo " <p>No hay Reportes registrados en la base de datos</p>";
}
  ?>


           </div>
           <input type="button" onClick="location='listReportes.php'" value="Regresar" />
           <input type="button"  value="Imprimir Reporte" onclick="javascript:window.print()"/>
          </form>
           </article>



        </section>

</center>

        <!-- Pie de pagina-->
            <?php include_once 'modulos/mdl_footer.php'; ?>

    </div>
    </body>
</html>
