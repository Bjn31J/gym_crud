<?php require('views/header.php'); ?>
<div class="container mt-5">
    <h1 class="text-center mb-4">Clientes Fitness Plus</h1>

    <?php if(isset($mensaje)): $app->alerta($tipo, $mensaje); endif; ?>

    
    <div class="mb-3">
        <a href="cliente.php?accion=crear" class="btn btn-success btn-lg">Nuevo Cliente</a>
    </div>


    <table class="table table-hover table-bordered shadow-sm">
        <thead class="thead-dark">
            <tr>
                <th scope="col">Id</th>
                <th scope="col">Nombre</th>
                <th scope="col">Apellidos</th>
                <th scope="col">Email</th>
                <th scope="col">Teléfono</th>
                <th scope="col">Fecha de Registro</th>
                <th scope="col">Opciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($clientes as $cliente): ?>
            <tr>
                <th scope="row"><?php echo $cliente['id_cliente']; ?></th>
                <td><?php echo $cliente['nombre']; ?></td>
                <td><?php echo $cliente['apellido']; ?></td>
                <td><?php echo $cliente['email']; ?></td>
                <td><?php echo $cliente['telefono']; ?></td>
                <td><?php echo $cliente['fecha_registro']; ?></td>
                <td>
                    
                    <a href="cliente.php?accion=actualizar&id=<?php echo $cliente['id_cliente']; ?>" class="btn btn-primary">Actualizar</a>
                    <a href="cliente.php?accion=eliminar&id=<?php echo $cliente['id_cliente']; ?>" class="btn btn-danger ml-2">Eliminar</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
<?php require('views/footer.php'); ?>


