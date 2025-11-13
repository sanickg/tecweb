<?php
use TECWEB\MYAPI\Products;
require_once __DIR__ . '/myapi/Products.php';

$productos = new Products('marketzone');
$id = isset($_GET['id']) ? $_GET['id'] : null;
$productos->singleByName($_GET['nombre'], $id);
echo $productos->getData();
?>