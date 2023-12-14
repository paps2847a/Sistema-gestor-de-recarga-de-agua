<?php

    class ubicaciones
    {

        public function insertarUbicacion($ubicacion, $pertenencia)
        {
            $db = new conexion();
            $id = $this->generarIdUnico();

            $query = "INSERT INTO `ubicaciones`(`id`, esDe, `ubicacion`) VALUES (:id,:esde,:ubicacion)";
            $peticion = $db->pdo->prepare($query);
            $peticion->bindParam(":id", $id);
            $peticion->bindParam(":ubicacion", $ubicacion);
            $peticion->bindParam(":esde", $pertenencia);
            $peticion->execute();

            header("Location: " . $_SERVER["PHP_SELF"]);
            exit;
        }

        private function generarIdUnico() {
            // Generar un prefijo aleatorio
            $prefijo = mt_rand(100, 999);
            
            // Generar un ID único
            $idUnico = uniqid($prefijo);
            
            // Asegurarse de que el ID no sea más largo de 12 caracteres
            $idUnico = substr($idUnico, 0, 12);
            
            return $idUnico;
        }

        public function ubicaciones()
        {
            $db = new conexion();
            $query = "SELECT * FROM `ubicaciones`";
            $peticion = $db->pdo->prepare($query);
            $peticion->execute();

            $urbanizacion = new Urbanizacion();

            $datos =  $peticion->fetchAll();
            $cuenta = 1;

            foreach ($datos as $k) 
            {
                printf("
                    <tr>
                        <td>".$k['ubicacion']."</td>
                        <td>".$this->traducirCodigo($k['esDe'])."</td>
                        <td><button type='button' class='btn btn-warning' data-toggle='modal' data-target='#formulario".$cuenta."'>Editar</button></td>
                    </tr>
                ");
                
                printf('
                    <!-- Modal -->
                    <div class="modal fade" id="formulario'.$cuenta.'" tabindex="-1" role="dialog" aria-labelledby="formulario'.$cuenta.'ModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="formulario'.$cuenta.'ModalLabel">Editar Datos de Ubicacion</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form method="post">
                                    <label for="ubi" class="form-label">Nombre de la ubicacion</label>
                                    <input type="text" id="ubi" name="ubicacionNew" class="form-control" value="'.$k['ubicacion'].'" required>
                                    <input type="hidden" id="ubi" name="estado" class="form-control" value="editar">
                                    <br>
                                    <div class="form-group">
                                        <label for="select1">Urbanizacion a la que pertenece</label>
                                        <select class="form-control" name="urbanizacion" id="select1" required>
                                                ');

                                            $urbanizacion->urbanizacionOpciones($k['esDe']);
                                            
                printf('
                                        </select>
                                    </div>
                                    <input type="hidden" name="idUbi" value="'.$k['id'].'">

                                    <br>
                                    <button type="submit" class="btn btn-primary">Modificar</button>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                            </div>
                            </div>
                        </div>
                    </div>
                ');

                $cuenta++;
            }
        }

        private function traducirCodigo($codigo)
        {
            $db = new conexion();
            $query = "SELECT `urbanizacion` FROM `urbanizacion` WHERE `id` = :codigo";
            $peticion = $db->pdo->prepare($query);
            $peticion->bindParam(":codigo", $codigo);
            $peticion->execute();

            $datos = $peticion->fetch();

            return $datos[0];
        }

        public function traducirCodigoUbicacion($codigo)
        {
            $db = new conexion();
            $query = "SELECT `ubicacion` FROM `ubicaciones` WHERE `id` = :codigo";
            $peticion = $db->pdo->prepare($query);
            $peticion->bindParam(":codigo", $codigo);
            $peticion->execute();

            $datos = $peticion->fetch();

            return $datos[0];
        }

        public function editar($id,$data,$nuevaPertenencia)
        {
            $db = new conexion();
            $query = "UPDATE `ubicaciones` SET `ubicacion` = :datos, esDe = :esde WHERE `id`= :id";
            $peticion = $db->pdo->prepare($query);
            $peticion->bindParam(":datos", $data);
            $peticion->bindParam(":esde", $nuevaPertenencia);
            $peticion->bindParam(":id", $id);
            $peticion->execute();

            header("Location: " . $_SERVER["PHP_SELF"]);
            exit;
        }

        public function ubicacionesDinamicas($id)
        {
            $db = new conexion();
            $query = "SELECT id, ubicacion FROM ubicaciones WHERE esDe = :urba";
            $peticion = $db->pdo->prepare($query);
            $peticion->bindParam(":urba",$id);
            $peticion->execute();

            $data = $peticion->fetchAll(PDO::FETCH_ASSOC);
            return $data;
        }

        public function ubicacionesGENERAL($id)
        {
            $db = new conexion();
            $query = "SELECT id FROM ubicaciones WHERE esDe = :id";
            $peticion = $db->pdo->prepare($query);
            $peticion->bindParam(":id", $id);
            $peticion->execute();

            $data = $peticion->fetchAll(PDO::FETCH_ASSOC);
            return $data;
        }
        


    }


?>