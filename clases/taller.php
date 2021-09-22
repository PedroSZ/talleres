<?php
//******ALTA USUARIO ESTUDIANTE (RF-07)
include_once 'db.php';
class Taller extends DB {
	private $codigo;
	private $nombre;
	private $area;
	private $horario;
	private $instructor;
	private $supervisor;
	private $estado;


	//stters and getters ***********************************************
	public function setCodigo($codigo){ $this->codigo = $codigo; }
	public function setNombre($nombre){ $this->nombre = $nombre; }
	public function setArea($area){ $this->area = $area; }
	public function sethorario($horario){ $this->horario = $horario; }
	public function setInstructor($instructor){ $this->instructor = $instructor; }
	public function setSupervisor($supervisor){ $this->supervisor = $supervisor; }
	public function setEstado($estado){ $this->estado = $estado; }

	public function getCodigo(){return $this->codigo; }
	public function getNombre(){return $this->nombre; }
	public function getArea(){return $this->area; }
	public function gethorario(){return $this->horario; }
	public function getInstructor(){return $this->instructor; }
	public function getSupervisor(){return $this->supervisor; }
	public function getEstado(){return $this->estado; }

	//******************************************************************

	public function listar(){
		$query = $this->connect()->prepare('SELECT * FROM taller');
		$query->execute();
		return $query->fetchAll(PDO::FETCH_ASSOC);
	}


//consulta el ultimo registro en el taller
	public function ultimoRegistro(){
		$query = $this->connect()->prepare('SELECT MAX(id) as registro from taller');
		$query->execute();
		return $query->fetch();

	}

//obtener taller por instructo
	public function obtenerMiTaller($codigo){
		$query = $this->connect()->prepare('SELECT id from taller WHERE instructor = :user');
		$query->execute(['user' => $codigo]);
		return $query->fetch();

	}


	public function consulta($sql){
		$query = $this->connect()->prepare($sql);
		$query->execute();
		return $query->fetchAll(PDO::FETCH_ASSOC);
	}

	public function consultarCodigo($codigo){
		$query = $this->connect()->prepare('SELECT * FROM taller WHERE id = :user');
		$query->execute(['user' => $codigo]);
		return $query->fetch(PDO::FETCH_ASSOC);
	}

	public function consultarTaller($codigo){
		$sql='SELECT * FROM taller WHERE instructor = "'.$codigo.'"';
		//echo $sql;
		$query = $this->connect()->prepare($sql);
		$query->execute();
		return $query->fetch(PDO::FETCH_ASSOC);
	}

	public function consultarSupervisorPorInstructor($instructor){
		$query = $this->connect()->prepare('SELECT supervisor from taller
INNER JOIN estudiante_por_taller on taller.id = estudiante_por_taller.taller where estudiante = :user');
		$query->execute(['user' => $instructor]);
		return $query->fetch(PDO::FETCH_ASSOC);
	}

	public function consultarTallerActual($codigo){
		$query = $this->connect()->prepare('SELECT instructor.clave as claveInst, instructor.nombre as nombreInst, instructor.apellidos as apellidosInst, docente_supervisor.rfc as rfcSup, docente_supervisor.nombre as nombreSup, docente_supervisor.apellidos as apellidosSup  from taller INNER join instructor on instructor.clave = taller.instructor
INNER JOIN docente_supervisor on docente_supervisor.rfc = taller.supervisor
where id = :user');
		$query->execute(['user' => $codigo]);
		return $query->fetch(PDO::FETCH_ASSOC);
	}

//elimina taller por id del taller
	public function eliminar($codigo){
		$query = $this->connect()->prepare('DELETE FROM taller WHERE id = :user');
		$query->execute(['user' => $codigo]);
	}

//elimina taller por instructor
	public function eliminarPorInstructor($instructor){
		$query = $this->connect()->prepare('DELETE FROM taller WHERE instructor = :user');
		$query->execute(['user' => $instructor]);
	}

	public function actualizar(){
		$sql = "UPDATE taller SET nombre = :nombre, area = :area, horario = :horario, instructor = :instructor, supervisor = :supervisor, estado = :estado	WHERE id = :codigo";
		$query = $this->connect()->prepare($sql);
		$query->execute([
			'codigo' => $this->codigo,
			'nombre' => $this->nombre,
			'area' => $this->area,
			'horario' => $this->horario,
			'instructor' => $this->instructor,
			'supervisor' => $this->supervisor,
		  'estado' => $this->estado]);
	}

	public function guardar() {
		$sql = "INSERT INTO taller (id, nombre, area, horario, instructor, supervisor, estado) VALUES(:codigo, :nombre, :area, :horario, :instructor, :supervisor, :estado)";
		$query = $this->connect()->prepare($sql);
		$query->execute([
			'codigo' => $this->codigo,
			'nombre' => $this->nombre,
			'area' => $this->area,
			'horario' => $this->horario,
			'instructor' => $this->instructor,
			'supervisor' => $this->supervisor,
		   'estado' => $this->estado]);
	}

	public function guardarSolicitado() {
		$sql = "INSERT INTO taller (id, nombre, area, horario, instructor, estado) VALUES(:codigo, :nombre, :area :horario, :instructor, :estado)";
		//echo $sql;
		$query = $this->connect()->prepare($sql);
		$query->execute([
				'codigo' => $this->codigo,
			'nombre' => $this->nombre,
			'area' => $this->area,
			'horario' => $this->horario,
			'instructor' => $this->instructor,
			 'estado' => $this->estado]);
	}
}

?>
