<?php

require_once('_autoload.php');
require_once('modelos/Cnx.php');
require_once('modelos/Producto.php');
require_once('helpers/helper_input.php');

if (!Auth::isAdministrador()) {
    header('Location: login.php');
}

try {
    $cnx = new Cnx();
} catch (PDOException $e) {
    echo 'Error';
    exit;
}

$ide = test_input($_REQUEST['ide'] ?? null);

$producto = Producto::find($cnx, $ide);

//Si existe un producto con ese ID, lo elimina
if ($producto) {
    $producto->delete($cnx);
}

header('Location: productos.php?msj=delete');
