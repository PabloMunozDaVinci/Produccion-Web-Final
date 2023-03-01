<?php
require_once('shop-sidebar.php');
require_once('modelos/cnx.php');
require_once('modelos/Categoria.php');
?>



<?php
try {
    $cnx = new Cnx();
} catch (PDOException $e) {
    echo 'Error';
    exit;
}


$Categorias = Categoria::getCategorias($cnx);



?>


<div class="col-lg-3 order-2 order-lg-1">
    <h5 class="text-uppercase mb-4">Categories</h5>
    <div class="py-2 px-4 bg-dark text-white mb-3">
        <strong class="small text-uppercase fw-bold">Busqueda de categorias</strong>
    </div>
    <?php
    foreach ($Categorias as $cat) : ?>

        <ul class="list-unstyled small text-muted ps-lg-4 font-weight-normal">
            <li class="mb-2">
                <a class="reset-anchor" href="index.php?cat=<?php echo $cat->id ?>"><?php echo $cat->nombre ?></a>
            </li>

        </ul>

    <?php endforeach ?>





</div>