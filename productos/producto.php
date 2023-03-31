<?php
    error_reporting( ~E_NOTICE ); // avoid notice
	
	require_once '../database/conexion.php';

    //Consultamos para obtener las categorias
    $consulta1=$DB_con->prepare('SELECT * FROM categoria');
    $consulta1->execute();
    $categorias=$consulta1->fetchAll(PDO::FETCH_ASSOC);

    //consultamos para obtener las marcas
    $consulta2=$DB_con->prepare('SELECT * FROM marca');
    $consulta2->execute();
    $marcas=$consulta2->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Producto</title>
</head>
<body>
    <h1>Agregar Producto</h1>
    <form action="./agregarProducto.php" method="post" enctype="multipart/form-data">
        <input type="text" name="serial" placeholder="Ingrese el serial">
        <br>
        <br>
        <input type="text" name="producto" placeholder="Ingrese el producto">
        <br>
        <br>
        <textarea name="descripcion" cols="30" rows="10" placeholder="Ingrese descripción"></textarea>
        <br>
        <br>
        <input type="number" name="cantidad" placeholder="Ingrese cantidad">
        <br>
        <br>
        <input type="number" name="precio" placeholder="Ingrese el precio">
        <br>
        <br>
        <select name="categoria">
            <option selected>Elige una categoria</option>
        <?php
            foreach ($categorias as $key => $categoria) { //Agregamos las categorias a la lista desplegable
        ?>
            <option value="<?php echo $categoria["id_categoria"] ?>"><?php echo $categoria["categoria"] ?></option>
        <?php
            }
        ?>
        </select>
        <br>
        <br>
        <select name="marca">
            <option selected>Elige una marca</option>
        <?php 
            foreach ($marcas as $key => $marca) {  //Agregamos las marcas a la lista desplegable
        ?>
            <option value="<?php echo $marca["id_marca"] ?>"><?php echo $marca["marca"] ?></option>
        <?php
            }
        ?>
        </select>
        <br>
        <br>
        <input type="file" name="imagen[]" accept="image/*" multiple="multiple">
        <button type="button" id="agregar_mas">+</button>
        <br>
        <br>
        <div id="incrementa"> <!-- Aquí agregamos los campos de archivos extra -->

        </div>
        <br>
        <br>
        <button type="submit">Crear</button>
    </form>


    <script src="https://code.jquery.com/jquery-2.2.4.js"
        integrity="sha256-iT6Q9iMJYuQiMWNd9lDyBUStIq/8PuOW33aOqmvFpqI=" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.3/js/bootstrap-select.min.js"></script>

    <script> //Función para agregar mas botones
    $(function() {
        var i = 1;
        $('#agregar_mas').click(function() {
            var div = '<div>';
            var inputCode = '<input type="file" name="imagen[]" multiple="multiple"> </div>';
            i++;
            //Importante esta variable debe ir debajo del autoincrementable
            var btnDelete = '<button type="button" name="remove" id="' + i +
                '" class="btn btn-danger btn_remove">X</button>';
            $('#incrementa').append('<div class="row-fluid' + i + '">' + div + inputCode + btnDelete +
                ' </div><br>');
        });


        $(document).on('click', '.btn_remove', function() {
            var button_id = $(this).attr("id");
            console.log(button_id);
            $('.row-fluid' + button_id + '').remove();
        });


    });
    </script>
</body>
</html>