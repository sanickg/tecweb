<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es">
<?php
if(isset($_GET['tope'])) {
    $tope = $_GET['tope'];
} else {
    die('Parámetro "tope" no detectado...');
}

$productos = array();

if (!empty($tope)) {
    @$link = new mysqli('localhost', 'root', '12345678a', 'marketzone');
    
    if ($link->connect_errno) {
        die('Falló la conexión: '.$link->connect_error.'<br/>');
    }

    if ($result = $link->query("SELECT * FROM productos WHERE unidades <= $tope")) {
        $productos = $result->fetch_all(MYSQLI_ASSOC);
        $result->free();
    }

    $link->close();
}
?>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>PRODUCTO</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
    <h3>PRODUCTO</h3>
    <br/>
    
    <?php if (!empty($productos)) : ?>
        <table class="table">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Marca</th>
                    <th scope="col">Modelo</th>
                    <th scope="col">Precio</th>
                    <th scope="col">Unidades</th>
                    <th scope="col">Detalles</th>
                    <th scope="col">Imagen</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($productos as $producto) : ?>
                <tr>
                    <th scope="row"><?= $producto['id'] ?></th>
                    <td><?= $producto['nombre'] ?></td>
                    <td><?= $producto['marca'] ?></td>
                    <td><?= $producto['modelo'] ?></td>
                    <td><?= $producto['precio'] ?></td>
                    <td><?= $producto['unidades'] ?></td>
                    <td><?= utf8_encode($producto['detalles']) ?></td>
                    <td><img src="<?= $producto['imagen'] ?>" alt="<?= $producto['nombre'] ?>"/></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else : ?>
        <p>No se encontraron productos con unidades menores o iguales a <?= $tope ?></p>
    <?php endif; ?>
</body>
</html>