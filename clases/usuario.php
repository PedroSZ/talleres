<?php
include_once 'db.php';
class Usuario extends DB{
    private $codigo;
    private $psw;
    private $tipo;
    //stters and getters ***********************************************
    public function setCodigo($codigo){ $this->codigo = $codigo; }
    public function setPsw($psw){ $this->psw = $psw; }
    public function setTipo($tipo){ $this->tipo = $tipo; }
    public function getCodigo(){ return $this->codigo; }
    public function getPsw(){ return $this->psw; }
    public function getTipo(){ return $this->tipo; }
    //******************************************************************


    public function verificarPsw($user, $pass){
        $md5pass = md5($pass);
        $query = $this->connect()->prepare('SELECT * FROM usuario WHERE user_name = :user AND Pasword = :pass');
        $query->execute(['user' => $user, 'pass' => $md5pass]);
        if($query->rowCount()){
            return true;
        }else{
            return false;
        }
    }

    public function consultarCodigo($codigo){
  		$query = $this->connect()->prepare('SELECT * FROM usuario WHERE user_name = :user');
  		$query->execute(['user' => $codigo]);
  		return $query->fetch(PDO::FETCH_ASSOC);
  	}

    public function establecerDatos($user){
        $query = $this->connect()->prepare('SELECT * FROM usuario WHERE user_name = :user');
        $query->execute(['user' => $user]);
        foreach ($query as $currentUser) {
            $this->codigo = $currentUser['user_name'];
            $this->psw = $currentUser['pasword'];
            $this->tipo = $currentUser['tipo'];

        }
    }

    public function eliminar($codigo){
        $query = $this->connect()->prepare('DELETE FROM usuario WHERE user_name = :user');
        $query->execute(['user' => $codigo]);
    }

    public function guardar(){
        $sql = "INSERT INTO usuario (user_name, pasword, tipo) VALUES(:codigo, :psw, :tipo)";
        $query = $this->connect()->prepare($sql);
        $query->execute([
            'codigo' => $this->codigo,
            'psw' => $this->psw,
            'tipo' => $this->tipo]);
    }

	public function actualizar(){
		$sql = "UPDATE usuario SET pasword = :psw, tipo = :tipo	WHERE user_name = :codigo";
		$query = $this->connect()->prepare($sql);
		$query->execute([
			'codigo' => $this->codigo,
            'psw' => $this->psw,
            'tipo' => $this->tipo]);
	}

}
?>
