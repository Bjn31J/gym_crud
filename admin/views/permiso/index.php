<?php require('views/header/header_administrador.php'); ?>
<div class="container mt-5">
    <h1 class="text-center mb-4"style="font-weight: bold;">Permisos</h1>

    <?php if (isset($mensaje)) : $app->alert($tipo, $mensaje); endif; ?>

    <!-- Botón "Nuevo Permiso" alineado a la izquierda -->
    <div class="mb-3">
        <a href="permiso.php?accion=crear" class="btn btn-success btn-lg">Nuevo Permiso</a>
    </div>

    <!-- Tabla de Permisos -->
    <table class="table table-hover table-bordered shadow-sm">
        <thead class="thead-dark">
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Nombre del Permiso</th>
                <th scope="col">Opciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($permisos as $permiso) : ?>
                <tr>
                    <th scope="row"><?php echo $permiso['id_permiso']; ?></th>
                    <td><?php echo $permiso['permiso']; ?></td>
                    <td>
                        <a href="permiso.php?accion=actualizar&id=<?php echo $permiso['id_permiso']; ?>" class="btn btn-primary">Actualizar</a>
                        <a href="permiso.php?accion=eliminar&id=<?php echo $permiso['id_permiso']; ?>" class="btn btn-danger ml-2">Eliminar</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
<?php require('views/footer.php'); ?>



