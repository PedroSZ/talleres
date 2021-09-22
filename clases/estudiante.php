<?php
//******ALTA USUARIO ESTUDIANTE (RF-07)
include_once 'db.php';
class Estudiante extends DB {
	private $codigo;
	private $nombre;
	private $apellidos;
	private $carrera;
	private $grado;
	private $grupo;
	private $estadotaller;


	//stters and getters ***********************************************
	public function setCodigo($codigo){ $this->codigo = $codigo; }
	public function setNombre($nombre){ $this->nombre = $nombre; }
	public function setApellidos($apellidos){ $this->apellidos = $apellidos; }
	public function setCarrera($carrera){ $this->carrera = $carrera; }
	public function setGrado($grado){ $this->grado = $grado; }
	public function setGrupo($grupo){ $this->grupo = $grupo; }
	//public function setEstadoTaller($estado){ $this->estadotaller = $estadotaller; }


	public function getCodigo(){ return $this->codigo; }
	public function getNombre(){ return $this->nombre; }
	public function getApellidos(){ return $this->apellidos; }

	public function getCarrera(){return $this->carrera; }
	public function getGrado(){return $this->grado; }
	public function getGrupo(){return $this->grupo; }
	//public function getEstadoTaller(){return $this->estadotaller; }

	//******************************************************************

	public function listar(){
		$query = $this->connect()->prepare('SELECT * FROM estudiante');
		$query->execute();
		return $query->fetchAll(PDO::FETCH_ASSOC);
	}

	public function listarConsultaCompleta(){
		$query = $this->connect()->prepare('SELECT estudiante.curp,
			estudiante.nombre as nomest,
			estudiante.apellidos,
			estudiante.carrera,
			estudiante.grado,
			estudiante.grupo,
			taller.nombre as tallnom,
			taller.area,
			taller.horario
			FROM estudiante
			LEFT join estudiante_por_taller on estudiante.curp = estudiante_por_taller.estudiante
			left join taller on estudiante_por_taller.taller = taller.id');
					$query->execute();
					return $query->fetchAll(PDO::FETCH_ASSOC);
				}



	public function consultarCodigo($codigo){
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







public function guardar() {
		try{
		$sql = "INSERT INTO estudiante (curp, nombre, apellidos, carrera, grado, grupo) VALUES(:codigo, :nombre, :apellidos, :carrera, :grado, :grupo)";
		$query = $this->connect()->prepare($sql);
		$query->execute([
			'codigo' => $this->codigo,
			'nombre' => $this->nombre,
			'apellidos' => $this->apellidos,
			'carrera' => $this->carrera,
			'grado' => $this->grado,
			'grupo' => $this->grupo]);
}catch (Exception $e){
	 echo 'el usuario que quieres registrar ya se encuentra registrado en la base de datos: '.$e->getMessage()."\n";
}
	}

	/*public function guardar() {
		$sql = "INSERT INTO estudiante (curp, nombre, apellidos, carrera, grado, grupo) VALUES(:codigo, :nombre, :apellidos, :carrera, :grado, :grupo)";
		$query = $this->connect()->prepare($sql);
		$query->execute([
			'codigo' => $this->codigo,
			'nombre' => $this->nombre,
			'apellidos' => $this->apellidos,
			'carrera' => $this->carrera,
			'grado' => $this->grado,
			'grupo' => $this->grupo]);
	}*/
}

?>
