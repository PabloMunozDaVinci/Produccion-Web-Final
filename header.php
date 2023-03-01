<header class="header bg-white">
    <?php require_once('C:\xampp\htdocs\librerias\Auth.php') ?>
    <div class="container px-lg-3">
        <nav class="navbar navbar-expand-lg navbar-light py-3 px-lg-0"><a class="navbar-brand" href="index.php"><span class="fw-bold text-uppercase text-dark">Tu shop</span></a>
            <button class="navbar-toggler navbar-toggler-end" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <!-- Link--><a class="nav-link" href="index.php">Home</a>
                        <?php
                        // var_dump($_SESSION['auth']);


                        if (Auth::isAdministrador()) : ?>

                            <a class="btn btn-danger" href="productos.php"> Ver Productos </a>
                        <?php endif ?>
                    </li>


                </ul>



                <?php if (Auth::validate()) :  ?>

                    <ul class="navbar-nav ms-auto">
                        <!-- <li class="nav-item"><a class="nav-link" href="cart.html"> <i class="fas fa-dolly-flatbed me-1 text-gray"></i>Cart<small class="text-gray fw-normal">(2)</small></a></li> -->
                        <!-- <li class="nav-item"><a class="nav-link" href="#!"> <i class="far fa-heart me-1"></i><small class="text-gray fw-normal"> (0)</small></a></li> -->
                        <li class="nav-item"><a class="nav-link" href="#"> <i class="fas fa-user me-1 text-gray fw-normal"></i><?php echo  ucfirst($_SESSION['auth']['nombre']) ?> |</a></li>
                        <li class="nav-item"><a class="nav-link" href="login.php">Logout</a></li>
                    </ul>

                <?php else : ?>

                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item"><a class="nav-link" href="cart.html"> <i class="fas fa-dolly-flatbed me-1 text-gray"></i>Cart<small class="text-gray fw-normal">(2)</small></a></li>
                        <li class="nav-item"><a class="nav-link" href="#!"> <i class="far fa-heart me-1"></i><small class="text-gray fw-normal"> (0)</small></a></li>
                        <li class="nav-item"><a class="nav-link" href="login.php"> <i class="fas fa-user me-1 text-gray fw-normal"></i>Login</a></li>
                    </ul>

                <?php endif ?>
            </div>
        </nav>
    </div>
</header>