<?php
//******ALTA USUARIO DOCENTE SUPERVISOR (RF-07)
include_once 'db.php';
class Supervisor extends DB {
	private $codigo;
	private $nombre;
	private $apellidos;
	private $email;
	private $telefono;

	

	//stters and getters ***********************************************
	public function setCodigo($codigo){ $this->codigo = $codigo; }
	public function setNombre($nombre){ $this->nombre = $nombre; }
	public function setApellidos($apellidos){ $this->apellidos = $apellidos; }
	public function setEmail($email){ $this->email = $email; }
	public function setTelefono($telefono){ $this->telefono = $telefono; }
	
	
	public function getCodigo(){ return $this->codigo; }
	public function getNombre(){ return $this->nombre; }
	public function getApellidos(){ return $this->apellidos; }
	
	public function getEmail(){return $this->email; }
	public function getTelefono(){return $this->telefono; }
	

	//******************************************************************

	public function listar(){
		$query = $this->connect()->prepare('SELECT * FROM docente_supervisor');
		$query->execute();
		return $query->fetchAll(PDO::FETCH_ASSOC);
	}

	public function consultarCodigo($codigo){
		$query = $this->connect()->prepare('SELECT * FROM docente_supervisor WHERE rfc = :user');
		$query->execute(['user' => $codigo]);
		return $query->fetch(PDO::FETCH_ASSOC);
	}
	
	public function eliminar($codigo){
		$query = $this->connect()->prepare('DELETE FROM docente_supervisor WHERE rfc = :user');
		$query->execute(['user' => $codigo]);
	}

	public function actualizar(){
		$sql = "UPDATE docente_supervisor SET nombre = :nombre, apellidos = :apellidos, email = :email, telefono = :telefono	WHERE rfc = :codigo"; 
		$query = $this->connect()->prepare($sql);
		$query->execute([
			'codigo' => $this->codigo,
			'nombre' => $this->nombre, 
			'apellidos' => $this->apellidos,
			'email' => $this->email,
			'telefono' => $this->telefono]);
	}

	public function guardar() {
		$sql = "INSERT INTO docente_supervisor (rfc, nombre, apellidos, email, telefono) VALUES(:codigo, :nombre, :apellidos, :email, :telefono)"; 
		$query = $this->connect()->prepare($sql);
		$query->execute([
			'codigo' => $this->codigo,
			'nombre' => $this->nombre, 
			'apellidos' => $this->apellidos,
			'email' => $this->email,
			'telefono' => $this->telefono]);
	}
}

?>