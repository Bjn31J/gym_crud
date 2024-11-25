<?php require('views/header/header_entrenador.php'); ?>
<div class="container mt-5">
    <h1 class="text-center mb-4" style="font-weight: bold;">Asistencias de Entrenadores</h1>

    <?php if (isset($mensaje)) : ?>
        <?php $app->alert($tipo, $mensaje); ?>
    <?php endif; ?>

    <!-- Botón Nueva Asistencia -->
    <div class="d-flex justify-content-end mb-3">
        <a href="asistencia.php?accion=crear" class="btn btn-success shadow">Nueva Asistencia</a>
    </div>

    <!-- Tabla de Asistencias -->
    <div>
        <table class="table table-hover table-bordered shadow-sm">
            <thead class="table-dark text-center">
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Entrenador</th>
                    <th scope="col">Fecha de Asistencia</th>
                    <th scope="col">Asistió</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($asistencias)) : ?>
                    <?php foreach ($asistencias as $asistencia) : ?>
                        <tr class="text-center align-middle">
                            <th scope="row"><?php echo ($asistencia['id_asistencia']); ?></th>
                            <td><?php echo ($asistencia['entrenador']); ?></td>
                            <td><?php echo date("d/m/Y", strtotime($asistencia['fecha_asistencia'])); ?></td>
                            <td><?php echo ucfirst(($asistencia['asistio'])); ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else : ?>
                    <tr>
                        <td colspan="4" class="text-center text-muted">No hay asistencias registradas.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
<?php require('views/footer.php'); ?>
