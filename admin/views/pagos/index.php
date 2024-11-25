<?php require('views/header/header_administrador.php'); ?>
<div class="container mt-5">
    <h1 class="text-center mb-4">Pagos</h1>

    <?php if(isset($mensaje)): $app->alert($tipo, $mensaje); endif; ?>

    <div class="mb-3">
        <a href="pagos.php?accion=crear" class="btn btn-success btn-lg">Nuevo Pago</a>
    </div>

    <table class="table table-hover table-bordered shadow-sm">
        <thead class="thead-dark">
            <tr>
                <th scope="col">Id</th>
                <th scope="col">Cliente</th>
                <th scope="col">Costo</th> 
                <th scope="col">Tipo de Plan</th> 
                <th scope="col">Fecha de Pago</th> 
                <th scope="col">Opciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($pagos as $pago): ?>
            <tr>
                <th scope="row"><?php echo $pago['id_pago']; ?></th>
                <td><?php echo $pago['cliente_completo']; ?></td> 
                <td><?php echo '$'.number_format($pago['costo'], 2); ?></td> 
                <td><?php echo ucfirst($pago['tipo_plan']); ?></td> 
                <td><?php echo $pago['fecha_pago']; ?></td> 
                <td>
                    <a href="pagos.php?accion=actualizar&id=<?php echo $pago['id_pago']; ?>" class="btn btn-primary">Actualizar</a>
                    <a href="pagos.php?accion=eliminar&id=<?php echo $pago['id_pago']; ?>" class="btn btn-danger ml-2">Eliminar</a>
                    <a href="pagos.php?accion=imprimir&id=<?php echo $pago['id_pago']; ?>" class="btn btn-secondary ml-2">Imprimir</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
<?php require('views/footer.php'); ?>

