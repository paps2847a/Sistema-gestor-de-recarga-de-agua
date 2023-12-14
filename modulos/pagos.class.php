<?php

    class pagos_class
    {
        public function registrar_pago($cliente_id, $metodo_pago, $monto, $fecha)
        {
            $db = new conexion();
            $query = "INSERT INTO `pagos`(`id_pago`, `id_cliente`, `metodo_pago`, `monto`, `fecha`) VALUES (:idPago, :idCliente, :metodoPago, :monto, :fecha)";
            $peticion = $db->pdo->prepare($query);
            $idPago = $this->generarIdUnico();

            $peticion->bindParam(":idPago", $idPago);
            $peticion->bindParam(":idCliente", $cliente_id);
            $peticion->bindParam(":metodoPago", $metodo_pago);
            $peticion->bindParam(":monto", $monto);
            $peticion->bindParam(":fecha", $fecha);
            $peticion->execute();

            return $idPago;
        }

        private function generarIdUnico() {
            $microtime = microtime();
            $randNum = mt_rand();
    
            // Genera un hash único basado en el tiempo actual en microsegundos y un número aleatorio
            $uniqueId = md5($microtime . $randNum);
    
            return $uniqueId;
        }

        public function HistorialPagos($idCliente)
        {
            $db = new conexion();
            $query = "SELECT `metodo_pago`, `monto`, `fecha` FROM `pagos` WHERE `id_cliente` = :idCliente";
            $peticion = $db->pdo->prepare($query);
            $peticion->bindParam(":idCliente", $idCliente);
            $peticion->execute();

            $datos = $peticion->fetchAll(PDO::FETCH_ASSOC);

            foreach ($datos as $k) 
            {
                printf("
                    <tr>
                        <td>".$k['metodo_pago']."</td>
                        <td>".$k['monto']."</td>
                        <td>".$k['fecha']."</td>
                        <td><button class='btn btn-primary' id='deudas'>Ver pedido relacionado</button></td>
                    </tr>
                ");
            }
        }


    }




?>