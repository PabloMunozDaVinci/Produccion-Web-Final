<?php

require_once('_autoload.php');
require_once('modelos/Cnx.php');
require_once('modelos/Usuario.php');
require_once('helpers/helper_input.php');

if (Auth::validate()) {
    Auth::destroy();
}

try {
    $cnx = new Cnx();
} catch (PDOException $e) {
    echo 'Error';
    exit;
}


require_once('iniciar_sesion2.php');

unset($cnx);
