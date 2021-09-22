<?php

class DB {
   private $server;
   private $host;
   private $db;
   private $user;
   private $psw;
   private $charset;

   public function __construct() {
      $this-> server  = 'mysql';
      $this-> host   = 'localhost';
      $this-> db     = 'taller';
      $this-> user   = 'root';
      $this-> psw    = '';
      $this-> charset= 'utf8mb4';
   }

   function connect() {
      try{
         $conexion = $this->server.':host='.$this->host.'; dbname='.$this->db.'; chartset='.$this->charset;
         $options = [
            PDO::ATTR_ERRMODE          => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_EMULATE_PREPARES => false,

         ];
         $pdo = new PDO($conexion, $this->user, $this->psw, $options);
         //echo "PDO OK";
         return $pdo;
      }catch(PDOException $e){
         print_r('Error de conexion: ' . $e->getMessage());
      }
   }
 }

?>
