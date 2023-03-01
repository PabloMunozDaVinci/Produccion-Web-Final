<?php

require_once('_autoload.php');
require_once('modelos/Cnx.php');
require_once('modelos/Usuario.php');
require_once('helpers/helper_input.php');
require_once('conf/config.php');


if (Auth::validate()) {
    Auth::destroy();
}

try {
    $cnx = new Cnx();
} catch (PDOException $e) {
    echo 'Error';
    exit;
}

$error = null;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $email = test_input($_POST['email'] ?? null);
    $contrasena = test_input($_POST['contrasena'] ?? null);
    $nombre = test_input($_POST['nombre'] ?? null);

    $usuario = new Usuario();
    /* $usuario->nombre = 'pablo'; */
    $usuario->email = $email;
    $usuario->nombre = $nombre;
    $usuario->hashContrasena($contrasena);


    // verifico si hay errores 
    $errores = $usuario->validate($cnx);


    if (count($errores) == 0) {
        $usuario->save($cnx);
        echo '<script>alert("Usuario Creado");</script>';
    } else {
        echo '<pre' >
            var_dump($errores);
    }
}







unset($cnx);
?>
<!-- 
<!DOCTYPE html>
<html lang="en">

<head>
    <title> Registrarse </title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">



</head>

<body>



    <div class="container">

        <h1 class="text-center"> Registrar usuario </h1>


        <div class="alert alert-danger"> </div>


        <form action="registrar.php" method="post">
            <div class="form-group mb-3">
                <label for="nombre"> Ingrese Nombre</label>
                <input type="text" class="form-control" name="nombre" id="nombre" placeholder="Ingrese su nombre">

                <label for="email"> Crear Email </label>
                <input type="email" class="form-control" name="email" id="email" placeholder="Ingrese su correo electrónico">
            </div>

            <div class="form-group mb-3">
                <label for="contrasena"> Crear Contraseña </label>
                <input type="password" class="form-control" name="contrasena" id="contrasena">
            </div>
            <button type="submit" class="btn btn-success mb-3"> Enviar </button>
        </form>

    </div>


</body>

 -->


</html>

<!DOCTYPE html>
<html lang="en" style="background-color:#13191c;">

<head>
    <link rel="stylesheet" href="css.css" />

</head>

<body>
    <a class="nav-link" href="index.php">Home</a>
    <div class="wrapper fadeInDown">
        <div id="formContent">
            <!-- Tabs Titles -->
            <h2 class="active"> Registrarse </h2>



            <div class="alert alert-danger"> </div>


            <!-- Icon -->
            <div class="fadeIn first">
                <br>
            </div>

            <!-- Login Form -->
            <form action="registrar.php" method="post">

                <input name="nombre" type="text" id="nombre" class="fadeIn second" placeholder="Nombre">
                <input name="email" type="text" id="email" class="fadeIn second" placeholder="Email">
                <input name="contrasena" type="text" id="contrasena" class="fadeIn third" placeholder="password">
                <input type="submit" class="fadeIn fourth" value="Registrar">

            </form>


            <div id="formFooter">
                <a class="underlineHover" href="registrar.php">Crear Usuario</a>
            </div>

        </div>
    </div>
</body>

</html>