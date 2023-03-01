<?php

$archivo = $_GET['archivo'] ?? null;

// is file , verifico si un archivo existe
if( is_file("archivos_subidos/{$archivo}") )
{

    // unlink elimina
    unlink("archivos_subidos/{$archivo}");
    unlink("archivos_subidos_min/{$archivo}");
}

header('Location: subir_archivos.php?msj=archivo_eliminado_ok');