<?php require('views/header/header_administrador.php'); ?>
<div class="container mt-5">
    <h1 class="text-center mb-4"style="font-weight: bold;">Planes Entrenamiento</h1>

    <?php if (isset($mensaje)) : $app->alert($tipo, $mensaje); endif; ?>

    <!-- Botón "Nuevo Plan de Entrenamiento" alineado a la izquierda -->
    <div class="d-flex justify-content-start mb-4">
        <a href="plan_entrenamiento.php?accion=crear" class="btn btn-success btn-lg">
            <i class="fas fa-plus-circle"></i> Nuevo Plan de Entrenamiento
        </a>
    </div>

    <!-- Tabla de Planes de Entrenamiento -->
    <div >
        <table class="table table-hover table-bordered shadow-sm">
            <thead class="table-dark text-center">
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Cliente</th>
                    <th scope="col">Entrenador</th>
                    <th scope="col">Tipo de Plan</th>
                    <th scope="col">Costo</th>
                    <th scope="col">Descripción</th>
                    <th scope="col">Fecha Inicio</th>
                    <th scope="col">Fecha Fin</th>
                    <th scope="col">Opciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($planes as $plan): ?>
                <tr class="text-center align-middle">
                    <th scope="row"><?php echo $plan['id_plan']; ?></th>
                    <td><?php echo $plan['cliente']; ?></td>
                    <td><?php echo $plan['entrenador']; ?></td>
                    <td><?php echo ucfirst($plan['tipo_plan']); ?></td>
                    <td><?php echo '$'.number_format($plan['costo'], 2); ?></td>
                    <td><?php echo $plan['descripcion']; ?></td>
                    <td><?php echo date("d/m/Y", strtotime($plan['fecha_inicio'])); ?></td>
                    <td><?php echo date("d/m/Y", strtotime($plan['fecha_fin'])); ?></td>
                    <td>
                        <div class="btn-group" role="group">
                            <a href="plan_entrenamiento.php?accion=actualizar&id=<?php echo $plan['id_plan']; ?>" class="btn btn-primary btn-sm">
                                <i class="fas fa-edit"></i> Actualizar
                            </a>
                            <a href="plan_entrenamiento.php?accion=eliminar&id=<?php echo $plan['id_plan']; ?>" class="btn btn-danger btn-sm ml-2">
                                <i class="fas fa-trash-alt"></i> Eliminar
                            </a>
                        </div>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
<?php require('views/footer.php');?>



