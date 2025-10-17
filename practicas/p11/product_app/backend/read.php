<?php
    include_once __DIR__.'/database.php';

    // SE CREA EL ARREGLO QUE SE VA A DEVOLVER EN FORMA DE JSON
    $data = array();
    
    // SE VERIFICA HABER RECIBIDO EL TÉRMINO DE BÚSQUEDA
    if( isset($_POST['search']) ) {
        $search = $_POST['search'];
        
        // SE REALIZA LA QUERY DE BÚSQUEDA CON LIKE PARA NOMBRE, MARCA Y DETALLES
        $query = "SELECT * FROM productos WHERE (nombre LIKE '%{$search}%' OR marca LIKE '%{$search}%' OR detalles LIKE '%{$search}%') AND eliminado = 0";
        
        if ( $result = $conexion->query($query) ) {
            // SE OBTIENEN LOS RESULTADOS
            while($row = $result->fetch_array(MYSQLI_ASSOC)) {
                // SE CODIFICAN A UTF-8 LOS DATOS Y SE AGREGAN AL ARREGLO DE RESPUESTA
                $producto = array();
                foreach($row as $key => $value) {
                    $producto[$key] = utf8_encode($value);
                }
                // SE AGREGA CADA PRODUCTO AL ARREGLO DE DATOS
                $data[] = $producto;
            }
            $result->free();
        } else {
            die('Query Error: '.mysqli_error($conexion));
        }
        $conexion->close();
    } 
    
    // SE HACE LA CONVERSIÓN DE ARRAY A JSON
    echo json_encode($data, JSON_PRETTY_PRINT);
?>