<?php
    error_reporting( ~E_NOTICE ); // avoid notice
	
	require_once '../database/conexion.php';

    $consulta=$DB_con->prepare('SELECT * FROM producto');
    $consulta->execute();
    $productos=$consulta->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Imagen</title>
</head>

<body>
    <h2>Agregar Imagen</h2>
    <form action="./agregarImagen.php" method="post" enctype="multipart/form-data">
        <select name="producto">
            <option selected>Elige un producto</option>
            <?php
            foreach ($productos as $key => $producto) {
        ?>
            <option value="<?php echo $producto['id_producto'] ?>"><?php echo $producto['producto'] ?></option>
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
        <div id="incrementa">

        </div>
        <br>
        <button type="submit" name="agregar">Agregar</button>
    </form>

    <script src="https://code.jquery.com/jquery-2.2.4.js"
        integrity="sha256-iT6Q9iMJYuQiMWNd9lDyBUStIq/8PuOW33aOqmvFpqI=" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.3/js/bootstrap-select.min.js"></script>

    <script>
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
            //console.log(button_id);
            $('.row-fluid' + button_id + '').remove();
        });


    });
    </script>
</body>

</html>