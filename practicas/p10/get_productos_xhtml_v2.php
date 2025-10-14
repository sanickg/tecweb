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
    <script>
        function editar(id) {
            // se obtiene el id de la fila donde está el botón presionado
            var rowId = 'row-' + id;
            
            // se obtienen los datos de la fila
            var data = document.getElementById(rowId).querySelectorAll(".row-data");
            
            var idProducto = data[0].innerHTML;
            var nombre = data[1].innerHTML;
            var marca = data[2].innerHTML;
            var modelo = data[3].innerHTML;
            var precio = data[4].innerHTML;
            var unidades = data[5].innerHTML;
            var detalles = data[6].innerHTML;
            var imagen = data[7].querySelector('img').src;
            
            enviarDatos(idProducto, nombre, marca, modelo, precio, unidades, detalles, imagen);
        }
        
        function enviarDatos(id, nombre, marca, modelo, precio, unidades, detalles, imagen) {
            var form = document.createElement("form");

            var idIn = document.createElement("input");
            idIn.type = 'hidden';
            idIn.name = 'id';
            idIn.value = id;
            form.appendChild(idIn);

            var nombreIn = document.createElement("input");
            nombreIn.type = 'hidden';
            nombreIn.name = 'nombre';
            nombreIn.value = nombre;
            form.appendChild(nombreIn);

            var marcaIn = document.createElement("input");
            marcaIn.type = 'hidden';
            marcaIn.name = 'marca';
            marcaIn.value = marca;
            form.appendChild(marcaIn);

            var modeloIn = document.createElement("input");
            modeloIn.type = 'hidden';
            modeloIn.name = 'modelo';
            modeloIn.value = modelo;
            form.appendChild(modeloIn);

            var precioIn = document.createElement("input");
            precioIn.type = 'hidden';
            precioIn.name = 'precio';
            precioIn.value = precio;
            form.appendChild(precioIn);

            var unidadesIn = document.createElement("input");
            unidadesIn.type = 'hidden';
            unidadesIn.name = 'unidades';
            unidadesIn.value = unidades;
            form.appendChild(unidadesIn);

            var detallesIn = document.createElement("input");
            detallesIn.type = 'hidden';
            detallesIn.name = 'detalles';
            detallesIn.value = detalles;
            form.appendChild(detallesIn);

            var imagenIn = document.createElement("input");
            imagenIn.type = 'hidden';
            imagenIn.name = 'imagen';
            imagenIn.value = imagen;
            form.appendChild(imagenIn);

            form.method = 'POST';
            form.action = 'formulario_productos_v2.php';  

            document.body.appendChild(form);
            form.submit();
        }
    </script>
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
                    <th scope="col">Editar</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($productos as $producto) : ?>
                <tr id="row-<?= $producto['id'] ?>">
                    <th scope="row" class="row-data"><?= $producto['id'] ?></th>
                    <td class="row-data"><?= $producto['nombre'] ?></td>
                    <td class="row-data"><?= $producto['marca'] ?></td>
                    <td class="row-data"><?= $producto['modelo'] ?></td>
                    <td class="row-data"><?= $producto['precio'] ?></td>
                    <td class="row-data"><?= $producto['unidades'] ?></td>
                    <td class="row-data"><?= utf8_encode($producto['detalles']) ?></td>
                    <td class="row-data"><img src="<?= $producto['imagen'] ?>" alt="<?= $producto['nombre'] ?>" style="width: 50px;"/></td>
                    <td><input type="button" value="Editar" class="btn btn-primary" onclick="editar(<?= $producto['id'] ?>)" /></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else : ?>
        <p>No se encontraron productos con unidades menores o iguales a <?= $tope ?></p>
    <?php endif; ?>
</body>
</html>