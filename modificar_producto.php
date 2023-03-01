<?php

require_once($_SERVER['DOCUMENT_ROOT'] . '/_autoload.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/Modelos/Cnx.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/Modelos/Categoria.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/Modelos/Producto.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/helpers/helper_input.php');

if (!Auth::isAdministrador()) {
    header('Location: login.php');
}

try {
    $cnx = new Cnx();
} catch (PDOException $e) {
    echo 'Error';
    exit;
}
// con metodo REQUEST capturo no importa si es post o get 
$ide = test_input($_REQUEST['ide'] ?? null);

$producto = Producto::find($cnx, $ide);

$errores = array();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $producto->nombre = test_input($_POST['nombre'] ?? null);
    $producto->descripcion =  test_input($_POST['descripcion'] ?? null);
    $producto->precio = test_input($_POST['precio'] ?? null);
    $producto->categoria_id = test_input($_POST['categoria_id'] ?? null);

    $producto->save($cnx);

    header('Location: productos.php?msj=update');
}

$action = "modificar_producto.php";

$categorias = Categoria::all($cnx);

require_once($_SERVER['DOCUMENT_ROOT'] . '/vistas/guardar_producto.php');

unset($cnx);
