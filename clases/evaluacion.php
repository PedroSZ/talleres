<?php
include_once 'db.php';
class Evaluacion extends DB {
	private $clave;
	private $titulo;
	private $fech_ini;
	private $fech_fin;
	private $hora_ini;
	private $hora_fin;
	private $psw;
	private $tipo;
	//stters and getters ***********************************************

	//******************************************************************
	public function listar(){
		$query = $this->connect()->prepare('SELECT * FROM evaluacion');
		$query->execute();
		return $query->fetchAll(PDO::FETCH_ASSOC);
	}

	public function consultarClave($clave){
		$query = $this->connect()->prepare('SELECT * FROM evaluacion WHERE clave = :clave');
		$query->execute(['clave' => $clave]);
		return $query->fetch(PDO::FETCH_OBJ);
	}
	
	public function eliminar($clave){
		$query = $this->connect()->prepare('DELETE FROM evaluacion WHERE clave = :clave');
		$query->execute(['clave' => $clave]);
	}

	public function actualizar(){
		$sql = "UPDATE evaluacion SET nombre = :nombre, apellidos = :apellidos	WHERE codigo = :codigo"; 
		$query = $this->connect()->prepare($sql);
		$query->execute([
			'nombre' => $this->nombre, 
			'apellidos' => $this->apellidos,
			'codigo' => $this->codigo]);
	}

	public function guardar() {
		$sql = "INSERT INTO evaluacion (codigo, nombre, apellidos) VALUES(:codigo, :nombre, :apellidos)"; 
		$query = $this->connect()->prepare($sql);
		$query->execute([
			'codigo' => $this->codigo,
			'nombre' => $this->nombre, 
			'apellidos' => $this->apellidos]);
	}
