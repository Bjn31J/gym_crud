<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <title>Fitness Plus </title>
</head>
<body>
    <div class="container mt-5">
        <div class="alert alert-<?php echo $tipo; ?> text-center" role="alert">
            <?php echo $mensaje; ?>
        </div>
        <div class="text-center mt-4">
            <a href="javascript:history.back()" class="btn btn-primary">Volver</a>
        </div>
    </div>

</body>
</html>
