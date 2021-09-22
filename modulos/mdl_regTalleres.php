<?php
//******ALTA TALLER
	include_once '../clases/taller.php';
	//include_once '../clases/.php';
	if(!empty($_POST['codigo'])){
		echo "registrado";

		$dato = $_POST['codigo'];
		 //echo $dato;

		$taller = new Taller();
		$t = $taller->consultarCodigo($dato);
		$dato2 = $t['id'];
		//echo $dato2;

		if($dato == $dato2){

			echo '<script type="text/javascript">
								alert("Ya hay un taller registrado con este Id, intente registrarlo con otro Id");
								window.location.href="../regTalleres.php";
						</script>';
						echo"";

		}else{
		$taller->setCodigo($_POST['codigo']);
		$taller->setNombre($_POST['nombre']);
		$taller->setArea($_POST['area']);
		$taller->setHorario($_POST['horario']);
		$taller->setInstructor($_POST['instructor']);
		$taller->setSupervisor($_POST['supervisor']);
		$taller->setEstado($_POST['estado']);


		$taller->guardar();
		echo '<script type="text/javascript">
							alert("Taller registrado con éxito");
							window.location.href="../regTalleres.php";
					</script>';
		//header("Location:".$_SERVER['HTTP_REFERER']);//regresa al pagina que estaba
	}
}
?>
