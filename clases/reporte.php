<?php
//******ALTA USUARIO ESTUDIANTE (RF-07)
include_once 'db.php';
class Reporte extends DB {
	private $clave;
	private $titulo;
	private $descripcion;
	private $autor;
	private $reportado;

	//stters and getters ***********************************************
	public function setClave($clave){ $this->clave = $clave; }
	public function setTitulo($titulo){ $this->titulo = $titulo; }
	public function setDescripcion($descripcion){ $this->descripcion = $descripcion; }
	public function setAutor($autor){ $this->autor = $autor; }
	public function setReportado($reportado){ $this->reportado = $reportado; }


	public function getClave(){ return $this->clave; }
	public function getTitulo(){ return $this->titulo; }
	public function getDescripcion(){ return $this->descripcion; }
	public function getAutor(){ return $this->autor; }
	public function getReportado(){ return $this->reportado; }


	//******************************************************************

	public function listar(){
		$query = $this->connect()->prepare('SELECT * FROM reporte');
		$query->execute();
		return $query->fetchAll(PDO::FETCH_ASSOC);
	}

	public function listarDetalles(){
		$query = $this->connect()->prepare(' select estudiante.curp, estudiante.nombre as nomest, estudiante.apellidos, taller.id, taller.nombre as tallnom, reporte.clave, reporte.titulo
  from estudiante
  inner join reporte on estudiante.curp = reporte.reportado
  inner join estudiante_por_taller on estudiante.curp = estudiante_por_taller.estudiante
  inner join taller on estudiante_por_taller.taller = taller.id');
		$query->execute();
		return $query->fetchAll(PDO::FETCH_ASSOC);
	}

/*	public function consultarEstudiante($codigo){
		$query = $this->connect()->prepare('select estudiante.curp, estudiante.nombre as estudiantenom, estudiante.apellidos as estudianteapell, estudiante.carrera, estudiante.grado, estudiante.grupo, taller.id, taller.nombre as tallernom, reporte.clave as reporteclave, reporte.titulo, reporte.descripcion, instructor.nombre as nombreinst, instructor.apellidos as apellidosinst, instructor.email as emailist, instructor.telefono as telefonoinst, docente_supervisor.nombre as supervisornom, docente_supervisor.apellidos as supervisorapell, docente_supervisor.email as supervisormail, docente_supervisor.telefono as supervisortel
  from estudiante
  inner join reporte on estudiante.curp = reporte.reportado
  inner join estudiante_por_taller on estudiante.curp = estudiante_por_taller.estudiante
  inner join taller on estudiante_por_taller.taller = taller.id
  inner join instructor on taller.instructor = instructor.clave
  inner join docente_supervisor on taller.supervisor = docente_supervisor.rfc where estudiante = :user');
		$query->execute(['user' => $codigo]);
		return $query->fetch(PDO::FETCH_ASSOC);
	}*/

/*	public function autor_reporte($codigo){
		$query = $this->connect()->prepare('SELECT * from reporte where reportado = :user');
		$query->execute(['user' => $codigo]);
		return $query->fetch(PDO::FETCH_ASSOC);
	}*/
//eliminar por estudiante
	public function eliminar($reportado){
		$query = $this->connect()->prepare('DELETE FROM reporte WHERE reportado = :user');
		$query->execute(['user' => $reportado]);
	}
//eliminar por supevisor
	public function eliminarRep($autor){
		$query = $this->connect()->prepare('DELETE FROM reporte WHERE autor = :user');
		$query->execute(['user' => $autor]);
	}

/*	public function consultarCodigo($codigo){
		$query = $this->connect()->prepare('SELECT * FROM estudiante WHERE curp = :user');
		$query->execute(['user' => $codigo]);
		return $query->fetch(PDO::FETCH_ASSOC);
	}

	public function eliminar($codigo){
		$query = $this->connect()->prepare('DELETE FROM estudiante WHERE curp = :user');
		$query->execute(['user' => $codigo]);
	}

	public function actualizar(){
		$sql = "UPDATE estudiante SET nombre = :nombre, apellidos = :apellidos, carrera = :carrera, grado = :grado, grupo = :grupo	WHERE curp = :codigo";
		$query = $this->connect()->prepare($sql);
		$query->execute([
			'codigo' => $this->codigo,
			'nombre' => $this->nombre,
			'apellidos' => $this->apellidos,
			'carrera' => $this->carrera,
			'grado' => $this->grado,
			'grupo' => $this->grupo]);
	}
*/
	public function guardar() {
		$sql = "INSERT INTO reporte (titulo, descripcion, autor, reportado) VALUES(:titulo, :descripcion, :autor, :reportado)";
		$query = $this->connect()->prepare($sql);
		$query->execute([
			'titulo' => $this->titulo,
			'descripcion' => $this->descripcion,
			'autor' => $this->autor,
			'reportado' => $this->reportado]);
	}
}

?>
