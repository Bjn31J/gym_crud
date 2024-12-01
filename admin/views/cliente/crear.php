<?php require('views/header.php') ?>
<div class="container mt-5">
    <h1 class="text-center mb-4">
        <?php if ($accion == "crear"): echo("Nuevo "); else: echo("Modificar "); endif; ?> Cliente
    </h1>
    <form action="cliente.php?accion=<?php if ($accion == "crear"): echo('nuevo'); else: echo('modificar&id=' . $id); endif; ?>" 
          method="post" 
          class="bg-light p-5 rounded shadow-sm">
        <div class="form-group row mb-4">
            <label for="nombre" class="col-sm-2 col-form-label font-weight-bold">Nombre del Cliente</label>
            <div class="col-sm-10">
                <input type="text" name="data[nombre]" placeholder="Escribe aquí el nombre" class="form-control" 
                       value="<?php if (isset($cliente['nombre'])): echo($cliente['nombre']); endif; ?>" 
                       required />
            </div>
        </div>
        <div class="form-group row mb-4">
            <label for="apellido" class="col-sm-2 col-form-label font-weight-bold">Apellidos del Cliente</label>
            <div class="col-sm-10">
                <input type="text" name="data[apellido]" placeholder="Escribe aquí los apellidos" class="form-control" 
                       value="<?php if (isset($cliente['apellido'])): echo($cliente['apellido']); endif; ?>" 
                       required />
            </div>
        </div>
        <div class="form-group row mb-4">
            <label for="email" class="col-sm-2 col-form-label font-weight-bold">Correo Electrónico</label>
            <div class="col-sm-10">
                <input type="email" name="data[email]" placeholder="Escribe aquí el correo electrónico" class="form-control" 
                       value="<?php if (isset($cliente['email'])): echo($cliente['email']); endif; ?>" 
                       required />
            </div>
        </div>
        <div class="form-group row mb-4">
            <label for="telefono" class="col-sm-2 col-form-label font-weight-bold">Teléfono</label>
            <div class="col-sm-10">
                <input type="tel" pattern="[0-9]+" maxlength="10" placeholder="Ingrese solo números" name="data[telefono]" 
                       class="form-control" 
                       value="<?php if (isset($cliente['telefono'])): echo($cliente['telefono']); endif; ?>" 
                       required />
            </div>
        </div>
        <div class="form-group row mb-4">
            <label for="fecha_registro" class="col-sm-2 col-form-label font-weight-bold">Fecha de Registro</label>
            <div class="col-sm-10">
                <input type="date" name="data[fecha_registro]" class="form-control" 
                       value="<?php echo isset($cliente['fecha_registro']) ? $cliente['fecha_registro'] : date('Y-m-d'); ?>" 
                       min="<?php echo date('Y-m-d'); ?>" 
                       required />
            </div>
        </div>
        <div class="text-center">
            <input type="submit" name="data[enviar]" value="Guardar" class="btn btn-success btn-lg px-5" />
        </div>
    </form>
</div>
<?php require('views/footer.php') ?>

