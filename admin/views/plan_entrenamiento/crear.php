<?php require('views/header.php'); ?>
<div class="container mt-5">
    <h1 class="text-center mb-4">
        <?php if ($accion == "crear"): echo ("Nuevo ");
        else: echo ("Modificar ");
        endif; ?> Plan de Entrenamiento
    </h1>
    <form action="plan_entrenamiento.php?accion=<?php if ($accion == "crear"): echo ('nuevo');
                                                else: echo ('modificar&id=' . $id);
                                                endif; ?>" method="post" class="bg-light p-5 rounded shadow-sm">

        <!-- Selección de Cliente -->
        <div class="form-group row mb-4">
            <label for="id_cliente" class="col-sm-2 col-form-label font-weight-bold">Cliente</label>
            <div class="col-sm-10">
                <select name="data[id_cliente]" id="id_cliente" class="form-control" required onchange="actualizarPagoYTipoPlan()">
                    <option value="">Seleccione un cliente</option>
                    <?php foreach ($clientes as $cliente): ?>
                        <option value="<?php echo $cliente['id_cliente']; ?>"
                            <?php if (isset($plan['id_cliente']) && $plan['id_cliente'] == $cliente['id_cliente']): echo 'selected';
                            endif; ?>>
                            <?php echo $cliente['nombre_completo']; ?> <!-- Mostrar nombre completo -->
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>

        <!-- Selección de Entrenador -->
        <div class="form-group row mb-4">
            <label for="id_entrenador" class="col-sm-2 col-form-label font-weight-bold">Entrenador</label>
            <div class="col-sm-10">
                <select name="data[id_entrenador]" class="form-control" required>
                    <option value="">Seleccione un entrenador</option>
                    <?php foreach ($entrenadores as $entrenador): ?>
                        <option value="<?php echo $entrenador['id_entrenador']; ?>"
                            <?php if (isset($plan['id_entrenador']) && $plan['id_entrenador'] == $entrenador['id_entrenador']): echo 'selected';
                            endif; ?>>
                            <?php echo $entrenador['nombre_completo']; ?> <!-- Mostrar nombre completo -->
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>

        <!-- Información del Pago y Tipo de Plan -->
        <div class="form-group row mb-4">
            <label for="tipo_plan" class="col-sm-2 col-form-label font-weight-bold">Tipo de Plan</label>
            <div class="col-sm-10">
                <input type="text" id="tipo_plan" class="form-control" disabled value="<?php if (isset($plan['tipo_plan'])): echo $plan['tipo_plan'];
                                                                                        else: echo 'No registrado';
                                                                                        endif; ?>" />
            </div>
        </div>

        <!-- Mostrar el Costo del Plan -->
        <div class="form-group row mb-4">
            <label for="costo" class="col-sm-2 col-form-label font-weight-bold">Costo del Plan</label>
            <div class="col-sm-10">
                <input type="text" id="costo" class="form-control" disabled value="<?php if (isset($plan['costo'])): echo '$' . $plan['costo'];
                                                                                    else: echo 'No disponible';
                                                                                    endif; ?>" />
            </div>
        </div>

        <!-- Descripción del Plan -->
        <div class="form-group row mb-4">
            <label for="descripcion" class="col-sm-2 col-form-label font-weight-bold">Descripción del Plan</label>
            <div class="col-sm-10">
                <textarea name="data[descripcion]" placeholder="Escribe la descripción del plan" class="form-control" required><?php if (isset($plan['descripcion'])): echo $plan['descripcion'];
                                                                                                                                endif; ?></textarea>
            </div>
        </div>

        <!-- Fecha de Inicio -->
        <div class="form-group row mb-4">
            <label for="fecha_inicio" class="col-sm-2 col-form-label font-weight-bold">Fecha de Inicio</label>
            <div class="col-sm-10">
                <input type="date" name="data[fecha_inicio]" class="form-control"
                    value="<?php if (isset($plan['fecha_inicio'])): echo $plan['fecha_inicio'];
                            endif; ?>"
                    min="<?php echo date('Y-m-d'); ?>" required />
            </div>
        </div>

        <!-- Fecha de Fin -->
        <div class="form-group row mb-4">
            <label for="fecha_fin" class="col-sm-2 col-form-label font-weight-bold">Fecha de Fin</label>
            <div class="col-sm-10">
                <input type="date" name="data[fecha_fin]" class="form-control"
                    value="<?php if (isset($plan['fecha_fin'])): echo $plan['fecha_fin'];
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