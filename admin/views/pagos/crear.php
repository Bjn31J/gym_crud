<?php require('views/header.php'); ?>
<div class="container mt-5">
    <h1 class="text-center mb-4">
        <?php if ($accion == "crear"): echo ("Nuevo ");
        else: echo ("Modificar ");
        endif; ?> Pago
    </h1>
    <form action="pagos.php?accion=<?php if ($accion == "crear"): echo ('nuevo');
                                    else: echo ('modificar&id=' . $id);
                                    endif; ?>" method="post" class="bg-light p-5 rounded shadow-sm">
        <!-- Selección de Cliente -->
        <div class="form-group row mb-4">
            <label for="id_cliente" class="col-sm-2 col-form-label font-weight-bold">Cliente</label>
            <div class="col-sm-10">
                <select name="data[id_cliente]" id="id_cliente" class="form-control" required>
                    <option value="">Seleccione un cliente</option>
                    <?php foreach ($clientes as $cliente): ?>
                        <option value="<?php echo $cliente['id_cliente']; ?>"
                            <?php if (isset($pago['id_cliente']) && $pago['id_cliente'] == $cliente['id_cliente']): echo 'selected';
                            endif; ?>>
                            <?php echo $cliente['nombre_completo']; ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>
        <!-- costo del Pago -->
        <div class="form-group row mb-4">
            <label for="costo" class="col-sm-2 col-form-label font-weight-bold">Costo</label>
            <div class="col-sm-10">
                <input type="number" name="data[costo]" id="costo" class="form-control"
                    value="<?php if (isset($pago['costo'])): echo $pago['costo'];
                            endif; ?>" required />
            </div>
        </div>
        <!-- Selección de Tipo de Plan -->
        <div class="form-group row mb-4">
            <label for="tipo_plan" class="col-sm-2 col-form-label font-weight-bold">Tipo de Plan</label>
            <div class="col-sm-10">
                <select name="data[tipo_plan]" id="tipo_plan" class="form-control" required>
                    <option value="">Seleccione un tipo de plan</option>
                    <option value="estándar" <?php if (isset($pago['tipo_plan']) && $pago['tipo_plan'] == 'estándar'): echo 'selected';
                                                endif; ?>>Estándar</option>
                    <option value="personalizado" <?php if (isset($pago['tipo_plan']) && $pago['tipo_plan'] == 'personalizado'): echo 'selected';
                                                    endif; ?>>Personalizado</option>
                </select>
            </div>
        </div>
        <!-- Fecha del Pago -->
        <div class="form-group row mb-4">
            <label for="fecha_pago" class="col-sm-2 col-form-label font-weight-bold">Fecha de Pago</label>
            <div class="col-sm-10">
                <input type="date" name="data[fecha_pago]" id="fecha_pago" class="form-control"
                    value="<?php if (isset($pago['fecha_pago'])): echo $pago['fecha_pago'];
                            else: echo date('Y-m-d');
                            endif; ?>"
                    min="<?php echo date('Y-m-d'); ?>" required />
            </div>
        </div>
        <div class="text-center">
            <input type="submit" name="data[enviar]" value="Guardar" class="btn btn-success btn-lg px-5" />
        </div>
    </form>
</div>
<?php require('views/footer.php'); ?>