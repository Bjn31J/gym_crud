<?php require('views/header/header_administrador.php'); ?>
<div class="container mt-5">
    <h1 class="text-center mb-4"style="font-weight: bold;">Usuarios</h1>
    
    <?php if (isset($mensaje)) : $app->alert($tipo, $mensaje); endif; ?>
    <div class="mb-3">
        <a href="usuario.php?accion=crear" class="btn btn-success btn-lg">Nuevo Usuario</a>
    </div>
    <table class="table table-hover table-bordered shadow-sm">
        <thead class="thead-dark">
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Correo</th>
                <th scope="col">Opciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($usuarios as $usuario) : ?>
                <tr>
                    <th scope="row"><?php echo $usuario['id_usuario']; ?></th>
                    <td><?php echo $usuario['correo']; ?></td>
                    <td>
                        <div class="btn-group" role="group" aria-label="Acciones de usuario">
                            <a href="usuario.php?accion=actualizar&id=<?php echo $usuario['id_usuario']; ?>" class="btn btn-primary">Actualizar</a>
                            <a href="usuario.php?accion=eliminar&id=<?php echo $usuario['id_usuario']; ?>" class="btn btn-danger ml-2">Eliminar</a>
                        </div>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
<?php require('views/footer.php'); ?>
