<?php  require('views/header/header_administrador.php');?>
<div class="container mt-5">
    <h1 class="text-center mb-4">Asistencias de Entrenadores</h1>

    <?php if(isset($mensaje)): ?>
        <div class="alert alert-<?php echo $tipo; ?>" role="alert">
            <?php echo $mensaje; ?>
        </div>
    <?php endif; ?>

    <!-- Botón "Nueva Asistencia" -->
    <div class="mb-3">
        <a href="asistencia.php?accion=crear" class="btn btn-success">Nueva Asistencia</a>
    </div>

    <!-- Tabla de Asistencias -->
    <table class="table table-bordered">
        <thead class="thead-dark">
            <tr>
                <th>ID</th>
                <th>Plan</th>
                <th>Cliente</th>
                <th>Entrenador</th>
                <th>Fecha</th>
                <th>Asistió</th>
                <th>Opciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($asistencias as $asistencia): ?>
            <tr>
                <td><?php echo $asistencia['id_asistencia']; ?></td>
                <td><?php echo $asistencia['plan_descripcion']; ?></td>
                <td><?php echo $asistencia['cliente']; ?></td>
                <td><?php echo $asistencia['entrenador']; ?></td>
                <td><?php echo $asistencia['fecha_asistencia']; ?></td>
                <td><?php echo $asistencia['asistio']; ?></td>
                <td>
                    <a href="asistencia.php?accion=actualizar&id=<?php echo $asistencia['id_asistencia']; ?>" class="btn btn-primary">Actualizar</a>
                    <a href="asistencia.php?accion=eliminar&id=<?php echo $asistencia['id_asistencia']; ?>" class="btn btn-danger">Eliminar</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
<?php require('views/footer.php'); ?>
