<?php

    require("..\modulos\ubicaciones.class.php");
    require("..\database\conexion.class.php");
    $ubicaciones = new ubicaciones();

    $data = $ubicaciones->ubicacionesDinamicas($_GET['id']);
    echo json_encode($data);



?>