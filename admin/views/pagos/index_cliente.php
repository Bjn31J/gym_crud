<?php require('views/header/header_cliente.php'); ?>
<div class="container mt-5">
    <h1 class="text-center mb-4" style="font-weight: bold;">Pagos</h1>
    
    <?php if(isset($mensaje)): $app->alert($tipo, $mensaje); endif; ?>

    <!-- Tabla de Pagos -->
    <div class="table-responsive">
        <table class="table table-hover table-bordered shadow-sm">
            <thead class="table-dark text-center align-middle">
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Cliente</th>
                    <th scope="col">Costo</th>
                    <th scope="col">Tipo de Plan</th>
                    <th scope="col">Fecha de Pago</th>
                    <th scope="col">Opciones</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($pagos)): ?>
                    <?php foreach ($pagos as $pago): ?>
                        <tr class="text-center align-middle">
                            <th scope="row"><?php echo $pago['id_pago']; ?></th>
                            <td><?php echo $pago['cliente_completo']; ?></td>
                            <td><?php echo '$' . number_format($pago['costo'], 2); ?></td>
                            <td><?php echo ucfirst($pago['tipo_plan']); ?></td>
                            <td><?php echo date("d/m/Y", strtotime($pago['fecha_pago'])); ?></td>
                            <td>
                                <a href="pagos.php?accion=imprimir&id=<?php echo $pago['id_pago']; ?>" 
                                   class="btn btn-success btn-sm">Imprimir</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="6" class="text-center">No hay pagos registrados.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
<?php require('views/footer.php'); ?>

