<?php
    include_once __DIR__.'/database.php';

    // SE OBTIENE LA INFORMACIÓN DEL PRODUCTO ENVIADA POR EL CLIENTE
    $producto = file_get_contents('php://input');
    
    if(!empty($producto)) {
        // SE TRANSFORMA EL STRING DEL JSON A OBJETO
        $jsonOBJ = json_decode($producto);
        
        // VALIDAR QUE EL JSON SEA VÁLIDO
        if(json_last_error() !== JSON_ERROR_NONE) {
            echo 'Error: JSON inválido';
            exit;
        }
        
        // VALIDAR QUE EXISTAN TODOS LOS CAMPOS REQUERIDOS
        if(!isset($jsonOBJ->nombre) || !isset($jsonOBJ->precio) || 
           !isset($jsonOBJ->unidades) || !isset($jsonOBJ->modelo) || 
           !isset($jsonOBJ->marca)) {
            echo 'Error: Faltan campos requeridos';
            exit;
        }
        
        // ESCAPAR DATOS PARA PREVENIR SQL INJECTION
        $nombre = mysqli_real_escape_string($conexion, $jsonOBJ->nombre);
        $marca = mysqli_real_escape_string($conexion, $jsonOBJ->marca);
        $modelo = mysqli_real_escape_string($conexion, $jsonOBJ->modelo);
        $precio = floatval($jsonOBJ->precio);
        $unidades = intval($jsonOBJ->unidades);
        $detalles = isset($jsonOBJ->detalles) ? mysqli_real_escape_string($conexion, $jsonOBJ->detalles) : '';
        $imagen = isset($jsonOBJ->imagen) ? mysqli_real_escape_string($conexion, $jsonOBJ->imagen) : 'img/default.png';
        
        // VERIFICAR SI EL PRODUCTO YA EXISTE (mismo nombre y eliminado = 0)
        $query_check = "SELECT * FROM productos WHERE nombre = '{$nombre}' AND eliminado = 0";
        $result_check = $conexion->query($query_check);
        
        if($result_check->num_rows > 0) {
            echo 'Error: Ya existe un producto con ese nombre';
            $result_check->free();
        } else {
            // EL PRODUCTO NO EXISTE, PROCEDER CON LA INSERCIÓN
            $query_insert = "INSERT INTO productos (nombre, marca, modelo, precio, unidades, detalles, imagen, eliminado) 
                            VALUES ('{$nombre}', '{$marca}', '{$modelo}', {$precio}, {$unidades}, '{$detalles}', '{$imagen}', 0)";
            
            if($conexion->query($query_insert)) {
                echo 'Producto agregado exitosamente';
            } else {
                echo 'Error: No se pudo insertar el producto - ' . mysqli_error($conexion);
            }
        }
        
        $conexion->close();
    } else {
        echo 'Error: No se recibieron datos';
    }
?>