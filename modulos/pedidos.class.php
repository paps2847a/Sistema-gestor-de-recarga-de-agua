<?php

    class pedidos_class
    {
        public function registrar_pedido($cliente_id, $id_pago, $fecha, $n_botellones, $estado)
        {
            $db = new conexion();
            $query = "INSERT INTO `pedidos`(`id_pedido`, `id_cliente`, `id_pago`, `fecha`, `n_botellones`, `estado_pedido`) VALUES (:idPedido, :idCliente, :idPago, :fecha, :nBotellones, :estadoPedidos)";
            $peticion = $db->pdo->prepare($query);
            $idPedido = $this->generarIdUnico();

            $peticion->bindParam(":idPedido", $idPedido);
            $peticion->bindParam(":idCliente", $cliente_id);
            $peticion->bindParam(":idPago", $id_pago);
            $peticion->bindParam(":fecha", $fecha);
            $peticion->bindParam(":nBotellones", $n_botellones);
            $peticion->bindParam(":estadoPedidos", $estado);
            $peticion->execute();

            header("Location: ./clientes.php?mensaje=<div class='alert alert-success' role='alert'>Pedido Registrado con exito!.</div>");
            exit();
        }

        private function generarIdUnico() {
            // Genera un ID único utilizando openssl_random_pseudo_bytes y bin2hex
            $uniqueId = bin2hex(openssl_random_pseudo_bytes(16));
    
            return $uniqueId;
        }

        public function tablaPedidos()
        {
            $cliente = new Clientes();
            $db = new conexion();
            $query = "SELECT `id_pedido`, `id_cliente`, `fecha`, `n_botellones`, `estado_pedido` FROM `pedidos` WHERE `estado_pedido` = 'En Espera'";
            $peticion = $db->pdo->prepare($query);
            $peticion->execute();

            $datos = $peticion->fetchAll(PDO::FETCH_ASSOC);
            $contador = 1;
            

            foreach ($datos as $k) 
            {
                $datos = $cliente->traducirCodigo($k['id_cliente']);

                printf("
                    <tr>
                        <td><a href='#' data-toggle='modal' data-target='#logoutModal".$contador."'>".$datos['habitacion']."</a></td>
                        <td>".$k['fecha']."</td>
                        <td>".$k['n_botellones']."</td>
                        <td>".$k['estado_pedido']."</td>
                        <td><a href=".$_SERVER['PHP_SELF']."?id=".$k['id_pedido']." class='btn btn-success'>Pedido Entregado</a></td>
                    </tr>    
                ");

                printf('
                    <div class="modal fade" id="logoutModal'.$contador.'" tabindex="-1" role="dialog" aria-labelledby="logoutModal'.$contador.'Label"
                        aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="logoutModal'.$contador.'">Ubicacion del cliente</h5>
                                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">×</span>
                                    </button>
                                </div>
                                <div class="modal-body">'.$datos['habitacion']." ".$cliente->ubicacionCompletaCliente($datos['ubicacion']).'</div>
                                <div class="modal-footer">
                                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cerrar</button>
                                    <a class="btn btn-primary" href="./perfil.php?id='.$k['id_cliente'].'">Perfil del cliente</a>
                                </div>
                            </div>
                        </div>
                    </div>
                ');

                $contador++;
            }
        }

        public function actualizarEstado($id)
        {
            $db = new conexion();
            $query = "UPDATE `pedidos` SET `estado_pedido` = 'Atendido' WHERE `id_pedido` = :idpedido";
            $peticion = $db->pdo->prepare($query);
            $peticion->bindParam(":idpedido", $id);
            $peticion->execute();

            header("Location: ".$_SERVER['PHP_SELF']."");
            exit();
        }

        public function pedidosNoPagos($idCliente)
        {
            $db = new conexion();
            $query = "SELECT `id_pedido`, `fecha`, `n_botellones`, `estado_pedido` FROM `pedidos` WHERE `id_cliente` = :idCliente AND `id_pago` is NULL";
            $peticion = $db->pdo->prepare($query);
            $peticion->bindParam(":idCliente", $idCliente);
            $peticion->execute();

            $deudas = $peticion->fetchAll(PDO::FETCH_ASSOC);
            
            foreach ($deudas as $k) 
            {
                printf("
                    <tr>
                        <td>".$k['fecha']."</td>
                        <td>".$k['n_botellones']."</td>
                        <td>".$k['estado_pedido']."</td>
                        <td><a class='btn btn-warning' href='pago.php?idPedido=".$k['id_pedido']."'>Agregar Pago</a></td>
                    </tr>
                ");
            }
        }



    }


?>