<?php  require('views/header/header_administrador.php');?>
<div class="container mt-5">
    <h1 class="text-center mb-4">Planes de Entrenamiento</h1>

    <?php if(isset($mensaje)): $app->alert($tipo, $mensaje); endif; ?>

    <!-- Botón "Nuevo Plan de Entrenamiento" -->
    <div class="mb-3">
        <a href="plan_entrenamiento.php?accion=crear" class="btn btn-success btn-lg">Nuevo Plan de Entrenamiento</a>
    </div>

    <!-- Tabla de Planes de Entrenamiento -->
    <table class="table table-hover table-bordered shadow-sm">
        <thead class="thead-dark">
            <tr>
                <th scope="col">Id</th>
                <th scope="col">Cliente</th>
                <th scope="col">Entrenador</th>
                <th scope="col">Tipo de Plan</th> <!-- Nueva columna -->
                <th scope="col">Costo</th> <!-- Nueva columna -->
                <th scope="col">Descripción</th>
                <th scope="col">Fecha Inicio</th>
                <th scope="col">Fecha Fin</th>
                <th scope="col">Opciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($planes as $plan): ?>
            <tr>
                <th scope="row"><?php echo $plan['id_plan']; ?></th>
                <td><?php echo $plan['cliente']; ?></td>
                <td><?php echo $plan['entrenador']; ?></td>
                <td><?php echo ucfirst($plan['tipo_plan']); ?></td> <!-- Mostrar tipo de plan -->
                <td><?php echo '$'.number_format($plan['costo'], 2); ?></td> <!-- Mostrar costo formateado -->
                <td><?php echo $plan['descripcion']; ?></td>
                <td><?php echo $plan['fecha_inicio']; ?></td>
                <td><?php echo $plan['fecha_fin']; ?></td>
                <td>
                    <a href="plan_entrenamiento.php?accion=actualizar&id=<?php echo $plan['id_plan']; ?>" class="btn btn-primary">Actualizar</a>
                    <a href="plan_entrenamiento.php?accion=eliminar&id=<?php echo $plan['id_plan']; ?>" class="btn btn-danger ml-2">Eliminar</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
<?php require('views/footer.php'); ?>
