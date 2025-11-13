<?php
    include_once __DIR__.'/database.php';

    $data = array(
        'exists' => false,
        'message' => 'Nombre disponible'
    );

    if(isset($_GET['nombre'])) {
        $nombre = $_GET['nombre'];
        $id = isset($_GET['id']) ? $_GET['id'] : 0;
        
        if($id > 0) {
            $sql = "SELECT * FROM productos WHERE nombre = '{$nombre}' AND id != {$id} AND eliminado = 0";
        } else {
            $sql = "SELECT * FROM productos WHERE nombre = '{$nombre}' AND eliminado = 0";
        }
        
        $result = $conexion->query($sql);
        
        if($result->num_rows > 0) {
            $data['exists'] = true;
            $data['message'] = 'Este nombre ya existe en la base de datos';
        }
        
        $result->free();
        $conexion->close();
    }

    echo json_encode($data, JSON_PRETTY_PRINT);
?>