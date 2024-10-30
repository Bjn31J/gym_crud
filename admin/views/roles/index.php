<?php require('views/header/header_administrador.php'); ?>
<div class="container mt-5">
    <h1 class="text-center mb-4">Gestión de Roles</h1>

    <?php if (isset($mensaje)): $app->alert($tipo, $mensaje); endif; ?>

    <div class="mb-3">
        <a href="roles.php?accion=crear" class="btn btn-success btn-lg">Nuevo Rol</a>
    </div>

    <table class="table table-hover table-bordered shadow-sm">
        <thead class="thead-dark">
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Rol</th>
                <th scope="col">Opciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($roles as $rol): ?>
                <tr>
                    <th scope="row"><?php echo $rol['id_rol']; ?></th>
                    <td><?php echo $rol['rol']; ?></td>
                    <td>
                        <a href="roles.php?accion=actualizar&id=<?php echo $rol['id_rol']; ?>" class="btn btn-primary">Actualizar</a>
                        <a href="roles.php?accion=eliminar&id=<?php echo $rol['id_rol']; ?>" class="btn btn-danger ml-2">Eliminar</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
<?php require_once('views/footer.php'); ?>
