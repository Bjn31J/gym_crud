<?php 
require('views/header/header_entrenador.php'); 
?>
<div class="container mt-5">
    <h1 class="text-center mb-4 "style="font-weight: bold;">Planes de Entrenamiento</h1>
    <?php if (isset($mensaje)) : ?>
        <?php $app->alert($tipo, $mensaje); ?>
    <?php endif; ?>
    <!-- Tabla de Planes de Entrenamiento -->
    <div>
        <table class="table table-hover table-bordered shadow-sm">
            <thead class="table-dark text-center">
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Cliente</th>
                    <th scope="col">Entrenador</th>
                    <th scope="col">Tipo de Plan</th>
                    <th scope="col">Costo</th>
                    <th scope="col">Descripción</th>
                    <th scope="col">Fecha de Inicio</th>
                    <th scope="col">Fecha de Fin</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($planes)): ?>
                    <?php foreach ($planes as $plan): ?>
                        <tr class="text-center align-middle">
                            <th scope="row"><?php echo $plan['id_plan']; ?></th>
                            <td><?php echo $plan['cliente']; ?></td>
                            <td><?php echo $plan['entrenador']; ?></td>
                            <td><?php echo ucfirst($plan['tipo_plan']); ?></td>
                            <td><?php echo '$' . number_format($plan['costo'], 2); ?></td>
                            <td><?php echo $plan['descripcion']; ?></td>
                            <td><?php echo date("d/m/Y", strtotime($plan['fecha_inicio'])); ?></td>
                            <td><?php echo date("d/m/Y", strtotime($plan['fecha_fin'])); ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="8" class="text-center">No hay planes de entrenamiento registrados.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
<?php 
require('views/footer.php');
?>