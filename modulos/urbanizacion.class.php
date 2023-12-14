<?php

    class Urbanizacion
    {

        public function insertarUbicacion($ubicacion)
        {
            $db = new conexion();
            $id = $this->generarIdUnico();

            $query = "INSERT INTO `urbanizacion`(`id`, `urbanizacion`) VALUES (:id,:urbanizaciones)";
            $peticion = $db->pdo->prepare($query);
            $peticion->bindParam(":id", $id);
            $peticion->bindParam(":urbanizaciones", $ubicacion);
            $peticion->execute();

        }

        private function generarIdUnico() {
            $caracteres = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $longitudCaracteres = strlen($caracteres);
            $idUnico = '';
            for ($i = 0; $i < 7; $i++) {
                $idUnico .= $caracteres[rand(0, $longitudCaracteres - 1)];
            }
            return $idUnico;
        }
        
        public function urbanizaciones()
        {
            $db = new conexion();
            $query = "SELECT * FROM `urbanizacion`";
            $peticion = $db->pdo->prepare($query);
            $peticion->execute();

            $datos =  $peticion->fetchAll();
            $cuenta = 1;

            foreach ($datos as $k) 
            {
                printf("
                    <tr>
                        <td>".$k['urbanizacion']."</td>
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
                                    <input type="text" id="ubi" name="ubicacionNew" class="form-control" value="'.$k['urbanizacion'].'" required>
                                    <input type="hidden" id="ubi" name="estado" class="form-control" value="editar">
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

        public function editar($id,$data)
        {
            $db = new conexion();
            $query = "UPDATE `urbanizacion` SET `urbanizacion`= :datos WHERE `id`= :id";
            $peticion = $db->pdo->prepare($query);
            $peticion->bindParam(":datos", $data);
            $peticion->bindParam(":id", $id);
            $peticion->execute();

            header("Location: " . $_SERVER["PHP_SELF"]);
            exit;
        }

        public function urbanizacionOpciones($id = null)
        {
            $db = new conexion();
            $query = "SELECT * FROM urbanizacion";
            $peticion = $db->pdo->prepare($query);
            $peticion->execute();

            $datos = $peticion->fetchAll(PDO::FETCH_ASSOC);

            foreach ($datos as $k) 
            {
                if ($id == $k['id']) 
                {
                    printf("
                        <option value='".$k['id']."' selected>".$k['urbanizacion']."</option>
                    ");
                }
                else 
                {
                    printf("
                        <option value='".$k['id']."'>".$k['urbanizacion']."</option>
                    "); 
                }
                
            }
        }

    }

?>