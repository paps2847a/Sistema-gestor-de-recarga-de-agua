<?php

    class Clientes
    {
        public function clientesMuestra()
        {
            $db = new conexion();
            $nombre = new ubicaciones();
            $query = "SELECT `id_cliente`, `habitacion`, `ubicacion` FROM `clientes` WHERE 1";
            $peticion = $db->pdo->prepare($query);
            $peticion->execute();

            $data = $peticion->fetchAll(PDO::FETCH_ASSOC);
            foreach ($data as $key => $value) 
            {
                $data[$key]['ubicacionName'] = $nombre->traducirCodigoUbicacion($data[$key]['ubicacion']); 
                $data[$key]['opcion'] = '<a href=perfil.php?id='.$data[$key]['id_cliente'].' class="btn btn-warning">Perfil</a>';
                $data[$key]['opcion2'] = '<a href=procesar_pedido.php?id='.$data[$key]['id_cliente'].' class="btn btn-success">Registrar Pedido</a>';
            }

            return json_encode($data);
        }

        public function insertarCliente($habitacion, $ubicacion,  $telefono)
        {
            $db = new conexion();
            $id = uniqid("",true);

            $query = "INSERT INTO `clientes`(`id_cliente`, `habitacion`, `ubicacion`, `telefono`) VALUES (:id, :habitacion, :ubicacion, :telefono)";
            $peticiones = $db->pdo->prepare($query);
            $peticiones->bindParam(":id", $id);            
            $peticiones->bindParam(":habitacion", $habitacion);            
            $peticiones->bindParam(":ubicacion", $ubicacion);            
            $peticiones->bindParam(":telefono", $telefono);
            
            $peticiones->execute();
            header("Location: ".$_SERVER['PHP_SELF']."");
            exit();
        }

        public function traducirCodigo($id)
        {
            $db = new conexion();
            $query = "SELECT `habitacion`, ubicacion FROM `clientes` WHERE `id_cliente` = :id";
            $peticion = $db->pdo->prepare($query);
            $peticion->bindParam(":id", $id);
            $peticion->execute();

            $dato = $peticion->fetch(PDO::FETCH_ASSOC);
            return $dato;
        }

        public function ubicacionCompletaCliente($id)
        {
            $db = new conexion();
            $query2 = "SELECT ubicaciones.ubicacion,  urbanizacion.urbanizacion FROM ubicaciones INNER JOIN urbanizacion ON ubicaciones.esDe = urbanizacion.id WHERE ubicaciones.id = :idUbi";

            $peticion2 = $db->pdo->prepare($query2);
            $peticion2->bindParam(":idUbi", $id);
            $peticion2->execute();

            $UbicacionCompleta = $peticion2->fetch(PDO::FETCH_ASSOC);

            $elemento = $UbicacionCompleta['ubicacion']." ".$UbicacionCompleta['urbanizacion'];
            return $elemento;
        }

        public function fullClienteInformacion($idCliente)
        {
            $db = new conexion();
            $query = "SELECT `habitacion`, `ubicacion`, `telefono` FROM `clientes` WHERE `id_cliente` = :idCliente";
            $peticion = $db->pdo->prepare($query);
            $peticion->bindParam(":idCliente", $idCliente);
            $peticion->execute();

            $datos = $peticion->fetchAll(PDO::FETCH_ASSOC);

            foreach ($datos as $k) 
            {
                printf("
                    <p><strong>Habitación:</strong> ".$k['habitacion']."</p>
                    <p><strong>Ubicación:</strong> ".$k['ubicacion']."</p>
                    <p><strong>Teléfono:</strong> ".$k['telefono']."</p>
                ");
            }

        }

    }


?>