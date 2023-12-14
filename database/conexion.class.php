<?php

  class conexion
  {
   public $pdo;
    public function __construct()
    {
        try
        {
            $this->pdo = new PDO('mysql:dbname=gesTOR;host=localhost;charset=UTF8','root','');
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } 
        catch (PDOException $e) 
        {
            echo 'Error de conexion debido a: '.$e->getMessage();
        }
    }

    public function close_conection()
    {
        $this->pdo = null;
    }

  }

?>