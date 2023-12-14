<?php

    class usuarios
    {
        public function entrar($nombre, $contrasena)
        {
            $db = new conexion();
            $query = "SELECT COUNT(`id`) FROM `usuarios` WHERE `nombre` = :nombre AND `contrasena` = :contrasena";
            $peticion =  $db->pdo->prepare($query);
            $peticion->bindParam(":nombre", $nombre);
            $peticion->bindParam(":contrasena", $contrasena);
            $peticion->execute();

            $verif = $peticion->fetch();

            if ($verif[0] == 1) 
            {

                session_start();

                $_SESSION['usuario'] = $nombre;
                header("Location: home.php");

            } 
            else 
            {
                return '<div class="alert alert-danger" role="alert">
                            Este usuario no esta registrado en el sistema
                        </div>';
            }
            
        }





        
    }








?>