<?php
use TECWEB\MYAPI\Products;
require_once __DIR__ . '/myapi/Products.php';

$producto = file_get_contents('php://input');
$jsonOBJ = json_decode($producto);

$productos = new Products('marketzone');
$productos->edit($jsonOBJ);
echo $productos->getData();
?>