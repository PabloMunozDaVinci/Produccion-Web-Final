<?php


require_once($_SERVER['DOCUMENT_ROOT'] . '/_autoload.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/Modelos/Cnx.php');
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

$ide = test_input($_GET['ide'] ?? null);

$producto = Producto::find($cnx, $ide);

$archivo = $_GET['archivo'] ?? null;

//Verifica si existe el archivo y el fichero.
if ($producto and $producto->path_original) {

    unlink($producto->path_original);
    unlink($producto->path_editado);

    $producto->path_original = null;
    $producto->path_editado = null;

    $producto->save($cnx);

    header("Location: img_productos.php?ide={$producto->id}");
} else {
    header('Location: productos.php');
}
