<?php require('views/header/header_administrador.php'); ?>
<div class="container mt-5">
    <h1 class="text-center mb-4"style="font-weight: bold;">Asistencias de Entrenadores</h1>
    <?php if (isset($mensaje)) : $app->alert($tipo, $mensaje); endif; ?>
    <div class="mb-3">
        <a href="asistencia.php?accion=crear" class="btn btn-success btn-lg">Nueva Asistencia</a>
    </div>
    <table class="table table-hover table-bordered shadow-sm">
        <thead class="thead-dark">
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Entrenador</th>
                <th scope="col">Fecha de Asistencia</th>
                <th scope="col">Asistió</th>
                <th scope="col">Opciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($asistencias as $asistencia) : ?>
                <tr>
                    <th scope="row"><?php echo ($asistencia['id_asistencia']); ?></th>
                    <td><?php echo ($asistencia['entrenador']); ?></td>
                    <td><?php echo ($asistencia['fecha_asistencia']); ?></td>
                    <td><?php echo (ucfirst($asistencia['asistio'])); ?></td>
                    <td>
                        <a href="asistencia.php?accion=actualizar&id=<?php echo($asistencia['id_asistencia']); ?>" class="btn btn-primary">Actualizar</a>
                        <a href="asistencia.php?accion=eliminar&id=<?php echo($asistencia['id_asistencia']); ?>" class="btn btn-danger ml-2" 
                           onclick="return confirm('¿Está seguro de eliminar esta asistencia?');">Eliminar</a>
                    </td>
                </tr>
            <?php endforeach; ?>
            <?php if (empty($asistencias)) : ?>
                <tr>
                    <td colspan="5" class="text-center">No hay asistencias registradas.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>
<?php require('views/footer.php'); ?>


