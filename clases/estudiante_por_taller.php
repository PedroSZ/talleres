<?php
//******ALTA USUARIO ESTUDIANTE (RF-07)
include_once 'db.php';
class EstudianteTaller extends DB {

	private $id;
	private $estudiante;
	private $taller;
	private $asistencia;
	private $calificacion;



	//stters and getters ***********************************************

	public function setId($id){ $this->id = $id; echo $id;}
	public function setEstudiante($estudiante){ $this->estudiante = $estudiante; }
	public function setTaller($taller){ $this->taller = $taller; }
//	public function setAsistencia($asistencia){ $this->asistencia = $asistencia; echo $asistencia;} //para imprimirel set
	public function setAsistencia($asistencia){ $this->asistencia = $asistencia; echo $asistencia;}
	public function setCalificacion($calificacion){ $this->calificacion = $calificacion; echo $calificacion;}



	public function getId(){return $this->id; }
	public function getEstudiante(){return $this->estudiante; }
	public function getTaller(){return $this->taller; }
	public function getAsistencia(){return $this->asistencia; }
	public function getCalificacion(){return $this->calificacion; }


	//******************************************************************

	public function listar(){
		$query = $this->connect()->prepare('SELECT * FROM estudiante_por_taller');
		$query->execute();
		return $query->fetchAll(PDO::FETCH_ASSOC);
	}
//consultar estudiante inscrito en un taller
	public function consultarEstudiante($codigo){
		$query = $this->connect()->prepare('SELECT * FROM estudiante_por_taller INNER JOIN estudiante ON (estudiante.curp = estudiante_por_taller.estudiante) WHERE estudiante = :user');
		$query->execute(['user' => $codigo]);
		return $query->fetch(PDO::FETCH_ASSOC);
	}

//consultar los estudiantes de un taller
	public function consultarTaller($idTaller){
		$query = $this->connect()->prepare('SELECT * FROM estudiante_por_taller INNER JOIN taller ON (taller.id = estudiante_por_taller.taller) WHERE taller = :taller');
		$query->execute(['taller' => $codigo]);
		return $query->fetch(PDO::FETCH_ASSOC);
	}




	public function listarEstudiantesTalleres(){
		$query = $this->connect()->prepare('SELECT * from estudiante INNER JOIN estudiante_por_taller ON estudiante.curp = estudiante_por_taller.estudiante');
		$query->execute();
		return $query->fetchAll(PDO::FETCH_ASSOC);
	}


	public function consultarTallerActual($codigo){
		$sql='SELECT taller FROM estudiante_por_taller  WHERE estudiante = "'.$codigo.'"';
		//echo $sql;
		$query = $this->connect()->prepare($sql);
		$query->execute();
		return $query->fetch(PDO::FETCH_ASSOC);
	}

//eliminar por estudiante
	public function eliminar($estudiante){
		$query = $this->connect()->prepare('DELETE FROM estudiante_por_taller WHERE estudiante = :user');
		$query->execute(['user' => $estudiante]);
	}

//eliminar todos estudiantes de un taller
	public function eliminarPorTaller($taller){
		$query = $this->connect()->prepare('DELETE FROM estudiante_por_taller WHERE taller = :user');
		$query->execute(['user' => $taller]);
	}

	//elimina todos los estudiantes_por_taller de todos los talleres que da un instructor
		public function eliminarPorInstructor($taller){
			$query = $this->connect()->prepare('DELETE  estudiante_por_taller from estudiante_por_taller
 inner join taller
 on taller.id = estudiante_por_taller.taller
 inner join instructor
 on taller.instructor = instructor.clave
 inner join usuario
 on instructor.clave = usuario.user_name
  WHERE taller.instructor = :user');
			$query->execute(['user' => $taller]);
		}


	public function actualizar(){
		$sql = "UPDATE estudiante_por_taller SET estudiante = :estudiante, taller = :taller	WHERE id = :id";
		$query = $this->connect()->prepare($sql);
		$query->execute([
			'estudiante' => $this->estudiante,
			'taller' => $this->taller]);
	}
	public function actualizarElegido(){
		$sql = "UPDATE estudiante_por_taller SET taller = :taller	WHERE estudiante = :estudiante";
		$query = $this->connect()->prepare($sql);
		$query->execute([
			'estudiante' => $this->estudiante,
			'taller' => $this->taller]);
	}

	public function calificar(){
		$sql = "UPDATE estudiante_por_taller SET total_asistencias = :asistencia, evaluacion = :calificacion	WHERE id = :id";
		$query = $this->connect()->prepare($sql);
		$query->execute([
			'id' => $this->id,
			'asistencia' => $this->asistencia,
			'calificacion' => $this->calificacion]);
	}


	public function guardar() {
		$sql = "INSERT INTO estudiante_por_taller (estudiante, taller, total_asistencias, evaluacion) VALUES(:estudiante, :taller, :asistencia, :calificacion)";
	//	echo $sql;
		$query = $this->connect()->prepare($sql);
		$query->execute([
			'estudiante' => $this->estudiante,
			'taller' => $this->taller,
			'asistencia' => $this->asistencia,
			'calificacion' => $this->calificacion]);
	}



}

?>
