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

  /********* OBTENEMOS EL POST DEL FILTRO******************/
  error_reporting(0);//para que no me muestre errores porque en un principio FiltarCurp no tiene valor por o esta indefinida
  $filtro1 = $_POST['FiltrarId']; //para obtener el ID a buscar del fitro
  $filtro2 = $_POST['FiltrarNombre']; //para obtener Nombre  a buscar del fitro
  $filtro3 = $_POST['FiltrarEstado']; //para obtener Estado a buscar del fitro
  /********************************************************/
?>
</!DOCTYPE html>
<html>
    <head>
        <title>SIVRTEC63</title>
        <link rel="stylesheet" href="css/main.css"/>
        <link rel="stylesheet" href="css/forms.css">
        <script language='javascript'>
		function borrar(codigo) {

            var mensaje;
            var opcion = confirm("El usuario será eliminado de la base de datos, ¿seguro que desea continuar con esta acción?");
            if (opcion == true) {
              document.frm_listTalleres.micodigo.value = codigo;
  			//alert(codigo);

              document.frm_listTalleres.submit();
                mensaje = "Usuario eliminado con éxito.";
          } else {
              mensaje = "No se realizado ninguna acción.";
          }

		}
		function regresar(){
			location.href='index.php'
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
  <div id="centrado">
    
        <!--/*********************************FORMULARIO PARA EL FILTRO*****************************************************/ -->
                           <form method="post" action="listTalleres.php" name="form_filtro" id="form_filtro" style="align-items: center; background:rgba(0,0,0,0.0);">
                           <table border="0" style="color:#FFFFFF; font-weight: 600; font-size: 17px;">
                           <tr>
                             <td width="50%" style="text-align: right;">
                               <p>
                               <input name="FiltrarId" type="text" title="Busqueda por codigo de taller ejemplo: 1"  placeholder="Buscar por Codigo" id ="FiltrarId" >
                               <input name="FiltrarNombre" type="text" title="Busqueda por taller ejemplo: AJEDREZ"  placeholder="Buscar por Taller" id ="FiltrarNombre" onKeyUp="document.getElementById(this.id).value=document.getElementById(this.id).value.toUpperCase()" >
                               <select name="FiltrarEstado" type="text" id ="FiltrarEstado">
                                 <option value="" disabled selected title="Busqueda por Estado Elija una opcion ejemplo: Activo">Buscar por Estado:</option>
                                 <option value="Activo">Activo</option>
                                 <option value="Inactivo">Inactivo</option>
                                 <option value="Espera">Espera</option>
                              </select>
                               <input type="submit" value="Buscar">
                               </p>
                             </td>
                           </tr>
                         </table>
                       </form>
        <!--/*********************************FORMULARIO PARA EL LISTADO*****************************************************/ -->
    </div>



    <section style="text-align: center; margin: 0 auto; height: 60%">
        <article style="width:85%; height: 100%;text-align: center; margin: 0 auto;">

                 <div class="datagrid">

                 <form method="post" action="modulos/mdl_delTalleres.php" name="frm_listTalleres" id="frm_listTalleres" style="width: auto; height: auto;">
					<input type="hidden" id="micodigo" name="micodigo">
          <?php
          include_once 'clases/taller.php';
          $doc = new Taller();
          $talleres = $doc->listar();
          if($talleres){
            echo "
             <h4>Listado de Talleres</h4>
              <table border='1'><thead>
              <tr>
                <th style='text-align:center'>Id</th>
                <th style='text-align:center'>Nombre</th>
                <th style='text-align:center'>Horario</th>
                <th style='text-align:center'>Instructor</th>
        		<th style='text-align:center'>Supervisor</th>
            <th style='text-align:center'>Lugar</th>
            <th style='text-align:center'>Estado</th>
        		<th style='text-align:center'>Actualizar</th>
              </tr></thead>";
            if($filtro1 || $filtro2 || $filtro3){
            foreach ($talleres as $taller) {
            if($filtro1 == $taller['id'] || $filtro2 == $taller['nombre'] || $filtro3 == $taller['estado']){
              echo "<tr>
              <td>".$taller['id']."</td>
              <td>".$taller['nombre']."</td>
              <td>".$taller['horario']."</td>
        	  <td>".$taller['instructor']."</td>
        	  <td>".$taller['supervisor']."</td>
            <td>".$taller['area']."</td>
            <td>".$taller['estado']."</td>
              <td style='text-align:center'><img width='30' height='30' src='imgs/delete.png' onClick='borrar(\"".$taller['id']."\");'></td>
              </tr>";
            }
            }
            }else{
              foreach ($talleres as $taller) {
                echo "<tr>
                <td>".$taller['id']."</td>
                <td>".$taller['nombre']."</td>
                <td>".$taller['horario']."</td>
              <td>".$taller['instructor']."</td>
              <td>".$taller['supervisor']."</td>
              <td>".$taller['area']."</td>
              <td>".$taller['estado']."</td>
                <td style='text-align:center'><img width='30' height='30' src='imgs/delete.png' onClick='borrar(\"".$taller['id']."\");'></td>
                </tr>";
              }
            }
            echo "</table>";
          }
          else{
            echo " <p>No hay talleres registrados en la base de datos</p>";
          }


        ?>
</div>

           </article>
           </form>
        </section>
        <div id="centrado">
          <input type="button" onClick="location='menuAdmin.php'" value="Regresar" />
        </div>
        <div id="espaciador5"></div>
        <div id="espaciador5"></div>
        <!-- Pie de pagina-->
            <?php include_once 'modulos/mdl_footer.php'; ?>

    </div>
  </center>
    </body>
</html>
