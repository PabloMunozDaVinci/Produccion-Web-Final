<?php




?>
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
            <h2 class="active"> Sign In </h2>



            <div class="alert alert-danger"> </div>


            <!-- Icon -->
            <div class="fadeIn first">
                <br>
            </div>

            <!-- Login Form -->
            <form action="login.php" method="post">

                <input name="email" type="text" id="usuario" class="fadeIn second" placeholder="usuario">
                <input name="contrasena" type="text" id="contrasena" class="fadeIn third" placeholder="password">
                <input type="submit" class="fadeIn fourth" value="Log In">

            </form>


            <div id="formFooter">
                <a class="underlineHover" href="registrar.php">Crear Usuario</a>
            </div>

        </div>
    </div>
</body>

</html>