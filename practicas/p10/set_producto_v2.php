<?php
// Recibir datos del formulario
$nombre = $_POST['nombre'];
$marca = $_POST['marca'];
$modelo = $_POST['modelo'];
$precio = $_POST['precio'];
$detalles = $_POST['detalles'];
$unidades = $_POST['unidades'];
$imagen = $_POST['imagen'];

/** SE CREA EL OBJETO DE CONEXION */
@$link = new mysqli('localhost', 'root', '12345678a', 'marketzone');

/** Comprobar la conexión */
if ($link->connect_errno) {
    die('Falló la conexión: '.$link->connect_error.'<br/>');
}

/** Validar que el producto no exista (nombre, marca y modelo) */
$sql_check = "SELECT * FROM productos WHERE nombre = '{$nombre}' AND marca = '{$marca}' AND modelo = '{$modelo}'";
$result = $link->query($sql_check);

if ($result->num_rows > 0) {
    echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">';
    echo '<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es">';
    echo '<head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8" /><title>Error</title></head>';
    echo '<body><h1>ERROR</h1>';
    echo '<p style="color: red;">El producto con ese nombre, marca y modelo ya existe en la base de datos.</p>';
    echo '<a href="formulario_productos.html">Regresar al formulario</a>';
    echo '</body></html>';
} else {
    /** Insertar el producto */
    //query original comentada 
    //$sql = "INSERT INTO productos VALUES (null, '{$nombre}', '{$marca}', '{$modelo}', {$precio}, '{$detalles}', {$unidades}, '{$imagen}',0)";
    
    //query nueva usando column names (sin especificar id ni eliminado)
    $sql = "INSERT INTO productos (nombre, marca, modelo, precio, detalles, unidades, imagen) 
        VALUES ('{$nombre}', '{$marca}', '{$modelo}', {$precio}, '{$detalles}', {$unidades}, '{$imagen}')";


    if ($link->query($sql)) {
        echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">';
        echo '<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es">';
        echo '<head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8" /><title>Producto Registrado</title></head>';
        echo '<body>';
        echo '<h1>Producto Insertado Exitosamente</h1>';
        echo '<h2>Resumen del producto registrado:</h2>';
        echo '<ul>';
        echo '<li><strong>ID:</strong> '.$link->insert_id.'</li>';
        echo '<li><strong>Nombre:</strong> '.$nombre.'</li>';
        echo '<li><strong>Marca:</strong> '.$marca.'</li>';
        echo '<li><strong>Modelo:</strong> '.$modelo.'</li>';
        echo '<li><strong>Precio:</strong> $'.$precio.'</li>';
        echo '<li><strong>Detalles:</strong> '.$detalles.'</li>';
        echo '<li><strong>Unidades:</strong> '.$unidades.'</li>';
        echo '<li><strong>Imagen:</strong> '.$imagen.'</li>';
        echo '</ul>';
        echo '<a href="formulario_productos.html">Registrar otro producto</a>';
        echo '</body></html>';
    } else {
        echo 'El Producto no pudo ser insertado: ' . $link->error;
    }
}

$link->close();
?>