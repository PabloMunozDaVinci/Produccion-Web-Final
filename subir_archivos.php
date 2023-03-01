<!--  pregunto si esta seteado en la variable FILES ,la cual esta para el almacenamiento de archivos , si esta el value "archivo"
y a su vez si ese archivo no tiene el valor de error ,
todo esto para saber si el archivo se envio correctamente 
-->


<?php
$error = null;
$success=$_GET['success'] ?? null;

if (isset($_FILES['archivo']) and $_FILES['archivo']['error'] == 0) {
   

    require_once('helpers/achicar_imagen.php');
    //esta funcion me devuelve informacion sobre el archivo que subo para hacer validaciones de extensiones 

    $info = pathinfo($_FILES['archivo']['name']);
    $extension = $info['extension']; //extension del archivo
    $nombre_archivo = $info['filename']; //nombre del archivo sin extension


    //validacion para que el nombre de los archivos a usbir no contengan caracteres no permitidos 
    $nombre_archivo= preg_replace("/[^A-Za-z0-9]/",'',$nombre_archivo);

    $time = time();


    //extensiones permitidas
    $extensiones_permitidas = array('jpeg','jpg', 'png', 'gif');

    //valido la extension
    if (in_array($extension, $extensiones_permitidas)) {



        $origen = $_FILES['archivo']['tmp_name'];



        //Para evitar que las imagenes se pisen cuando alguien guarde una imagen con el mismo nombre varias veces agrego el factor Time que siempre se actualiza 

        $destino_min="archivos_subidos_min/{$nombre_archivo}_{$time}.{$extension}";
        $destino ="archivos_subidos/{$nombre_archivo}_{$time}.{$extension}";

        //funcion de php recibe el archivo y a donde lo quiero mover 
        //por defecto se guardan los archivos en la locacion temporal de tmp_name
       //guardamos la imagen original

        move_uploaded_file($origen, $destino);


        //guardamos la imagen reducida
        achicarImagen($destino,100,100,$destino_min);

    header('Location: subir_archivos.php?success=1');

    } else {
        $error = 'la extension es incorrecta';
    }
}


?>
<?php 

//escaneo directorio y con array slice le digo que me muestre los elementos del array a partir del indice que le paso por parametro
$archivos=array_slice( scandir('archivos_subidos'),2);


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Document</title>
</head>

<body>
    <div class="container">
        <h1> Subida de archivos </h1>

        <?php if ($error) : ?>
            <div class="alert alert-danger"> <?php echo $error ?> </div>
        <?php endif ?>


        <?php if ($success) : ?>
            <div class="alert alert-success"> El archivo se subio correctamente  </div>
        <?php endif ?>
        <!--  siempre agregar  "multipart/form-data" para que los ficheros se envien al servidor -->

        <form action="subir_archivos.php" method="post" enctype="multipart/form-data">
            <div class="form-group mb-3">
                <label for="archivo"> Archivo </label>
                <input type="file" class="form-control-file" name="archivo" id="archivo">
            </div>
            <button type="submit" class="btn btn-primary">Enviar</button>
        </form>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col"> Nombre archivo </th>
                    <th scope="col"> Acciones </th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($archivos as $a) : ?>
                    <tr>
                        <td>
                            <img style="max-width: 150px;" src="archivos_subidos_min/<?php echo $a ?>" alt="<?php echo $a ?>" />
                        </td>
                        <td>
                            <a class="text text-primary" href="#" onclick="mostrarImagen('archivos_subidos/<?php echo $a ?>')"> Ver </a>
                            |
                            <a class="text text-danger" href="#" onclick="eliminarImagen('eliminar_archivo.php?archivo=<?php echo $a ?>')"> Eliminar </a>
                        </td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
        
         <!-- Modal -->
         <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <img id="imagen_grande" style="max-width: 100%;" alt="Gato" src="" />
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"> Cerrar </button>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        var imagen_grande = document.getElementById("imagen_grande");

        var exampleModal = new bootstrap.Modal(
            document.getElementById("exampleModal")
        );

        function mostrarImagen(p_imagen) {
            imagen_grande.src = p_imagen;
            exampleModal.show();
        }

        function eliminarImagen(p_imagen) {

            Swal.fire({
                title: 'Está segura/o?',
                text: "Si elimina este archivo no se podrá recuperar!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                cancelButtonText: 'No, me arrepentí!',
                confirmButtonText: 'Sí, eliminar!'
            }).then((result) => {
                if (result.isConfirmed) {
                    //Lo que sucede cuando le da click al botón aceptar.
                    location.href = p_imagen;
                }
            });

        }

    </script>
    
</body>

</html>