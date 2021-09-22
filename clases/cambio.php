<?php
//******ALTA USUARIO ESTUDIANTE (RF-07)
include_once 'db.php';
class Cambio extends DB {
	private $codigo;
	private $tallerActual;
	private $tallerElegido;
	private $estudiante;
	private $estado;




	//stters and getters ***********************************************
	public function setCodigo($codigo){ $this->codigo = $codigo; }
	public function setTallerActual($tallerActual){ $this->tallerActual = $tallerActual; }
	public function setTallerElegido($tallerElegido){ $this->tallerElegido = $tallerElegido; }
	public function setEstudiante($estudiante){ $this->estudiante = $estudiante; }
	public function setEstado($estado){ $this->estado = $estado; }

	public function getCodigo(){ return $this->codigo; }
	public function getTallerActual(){return $this->tallerActual; }
	public function getTallerElegido(){return $this->tallerElegido; }
	public function getEstudiante(){return $this->estudiante; }
	public function getEstado(){return $this->estado; }


	//******************************************************************
/*consulta el taller a cambiar*/
	public function listar(){
		$query = $this->connect()->prepare('SELECT
	  estudiante.curp, estudiante.nombre, estudiante.apellidos,
	  tabla1.id as id1, tabla1.nombre as actual,
	  tabla2.id as id2, tabla2.nombre as elegido
  from estudiante
  inner join cambio on estudiante.curp = cambio.estudiante
  inner join taller as tabla1 on tabla1.id = cambio.taller_actual
  inner join taller as tabla2 on tabla2.id = cambio.taller_elegido WHERE cambio.estado = "Pendiente"');
		$query->execute();
		return $query->fetchAll(PDO::FETCH_ASSOC);
	}

/*consulta estudiante, taller instructor y supervisor actual y taller instructor y supervisor del taller a cambiar*/
	public function consultarEstudiante($codigo){
		$query = $this->connect()->prepare('SELECT
	  cambio.No as solicitud, estudiante.curp, estudiante.nombre, estudiante.apellidos, estudiante.carrera, estudiante.grado, estudiante.grupo,
	  tabla1.id as id1, tabla1.nombre as actual, tabla1.area as Area1, tabla1.horario as Horario1, tabla1.instructor as Instructor1, tabla1A.nombre as NomIns1, tabla1A.apellidos as ApInst1, tabla1A.email as mailIns1, tabla1A.telefono as telIns1, tabla1.supervisor as Supervisor1, tabla2A.nombre as NomSup1, tabla2A.apellidos as ApSup1, tabla2A.email as maiSup1, tabla2A.telefono as telSup1,

	  tabla2.id as id2, tabla2.nombre as elegido, tabla2.area as Area2, tabla2.horario as Horario2, tabla2.instructor as Instructor2, tabla1B.nombre as NomIns2, tabla1B.apellidos as ApInst2, tabla1B.email as mailIns2, tabla1B.telefono as telIns2, tabla2.supervisor as Supervisor2, tabla2B.nombre as NomSup2, tabla2B.apellidos as ApSup2, tabla2B.email as maiSup2, tabla2B.telefono as telSup2

  from estudiante
  inner join cambio on estudiante.curp = cambio.estudiante
  inner join taller as tabla1 on tabla1.id = cambio.taller_actual
  inner join taller as tabla2 on tabla2.id = cambio.taller_elegido
  inner join instructor as tabla1A on tabla1.instructor = tabla1A.clave
  inner join instructor as tabla1B on tabla2.instructor = tabla1B.clave
  inner join docente_supervisor as tabla2A on tabla1.supervisor = tabla2A.rfc
  inner join docente_supervisor as tabla2B on tabla2.supervisor = tabla2B.rfc  WHERE estudiante = :user');
		$query->execute(['user' => $codigo]);
		return $query->fetch(PDO::FETCH_ASSOC);
	}
/*Consultar solicitud de cambio actual*/
	public function consultarSolicitudes($codigo){
		$query = $this->connect()->prepare('SELECT cambio.No as SolicitudId, estado FROM cambio  WHERE estudiante = :user');
		$query->execute(['user' => $codigo]);
		return $query->fetch(PDO::FETCH_ASSOC);
	}
/*obtener datos de cambio*/
public function consultarSolicitudActual($codigo){
	$query = $this->connect()->prepare('SELECT * FROM cambio WHERE No = :user');
	$query->execute(['user' => $codigo]);
	return $query->fetch(PDO::FETCH_ASSOC);
}
/*Guarda las solicitudes de cambios de taller*/
	public function guardar() {
		$sql = "INSERT INTO cambio (taller_actual, taller_elegido, estudiante, estado) VALUES(:tallerActual, :tallerElegido, :estudiante, :estado)";
		//echo $sql;
		$query = $this->connect()->prepare($sql);
		$query->execute([
			'tallerActual' => $this->tallerActual,
			'tallerElegido' => $this->tallerElegido,
			'estudiante' => $this->estudiante,
		  'estado' => "Pendiente",]);
	}

	/*public function actualizar(){
		$sql = "UPDATE cambio SET estado = :estado	WHERE No = :codigo";
		$query = $this->connect()->prepare($sql);
		$query->execute([
		'codigo' => $this->codigo,
		'estado' => $this->estado]);
	}*/

	public function actualizar(){
		$sql = "UPDATE cambio SET taller_actual = :tallerActual, estado = :estado	WHERE No = :codigo";
		$query = $this->connect()->prepare($sql);
		$query->execute([
			'codigo' => $this->codigo,
			'tallerActual' => $this->tallerActual,
			'estado' => $this->estado]);
	}


}

?>
