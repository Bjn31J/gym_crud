<?php require('views/header.php'); ?>
<div class="container mt-5">
    <h1 class="text-center mb-4">
        <?php if ($accion == "crear"): ?>
            Nuevo
        <?php else: ?>
            Modificar
        <?php endif; ?> Entrenador
    </h1>

    <!-- El atributo enctype es obligatorio para subir archivos -->
    <form action="entrenador.php?accion=<?php echo ($accion == "crear") ? 'nuevo' : 'modificar&id=' . $id; ?>" 
          method="post" 
          class="bg-light p-5 rounded shadow-sm" 
          enctype="multipart/form-data"> <!-- ¡AQUÍ AGREGA enctype! -->

        <!-- Nombre del Entrenador -->
        <div class="form-group row mb-4">
            <label for="nombre" class="col-sm-2 col-form-label font-weight-bold">Nombre del Entrenador</label>
            <div class="col-sm-10">
                <input type="text" name="data[nombre]" placeholder="Escribe el nombre" class="form-control" 
                       value="<?php echo isset($entrenador['nombre']) ? $entrenador['nombre'] : ''; ?>" required />
            </div>
        </div>

        <!-- Apellido del Entrenador -->
        <div class="form-group row mb-4">
            <label for="apellido" class="col-sm-2 col-form-label font-weight-bold">Apellidos del Entrenador</label>
            <div class="col-sm-10">
                <input type="text" name="data[apellido]" placeholder="Escribe los apellidos" class="form-control" 
                       value="<?php echo isset($entrenador['apellido']) ? $entrenador['apellido'] : ''; ?>" required />
            </div>
        </div>

        <!-- Especialidad -->
        <div class="form-group row mb-4">
            <label for="especialidad" class="col-sm-2 col-form-label font-weight-bold">Especialidad</label>
            <div class="col-sm-10">
                <input type="text" name="data[especialidad]" placeholder="Escribe la especialidad" class="form-control" 
                       value="<?php echo isset($entrenador['especialidad']) ? $entrenador['especialidad'] : ''; ?>" required />
            </div>
        </div>

        <!-- Teléfono del Entrenador -->
        <div class="form-group row mb-4">
            <label for="telefono" class="col-sm-2 col-form-label font-weight-bold">Teléfono</label>
            <div class="col-sm-10">
                <input type="tel" name="data[telefono]" placeholder="Escribe el teléfono" class="form-control" 
                       value="<?php echo isset($entrenador['telefono']) ? $entrenador['telefono'] : ''; ?>" required />
            </div>
        </div>

        <!-- Correo Electrónico -->
        <div class="form-group row mb-4">
            <label for="email" class="col-sm-2 col-form-label font-weight-bold">Correo Electrónico</label>
            <div class="col-sm-10">
                <input type="email" name="data[email]" placeholder="Escribe el correo" class="form-control" 
                       value="<?php echo isset($entrenador['email']) ? $entrenador['email'] : ''; ?>" required />
            </div>
        </div>

        <!-- Fotografía del Entrenador -->
        <div class="form-group row mb-4">
            <label for="fotografia" class="col-sm-2 col-form-label font-weight-bold">Fotografía</label>
            <div class="col-sm-10">
                <input type="file" name="fotografia" class="form-control" />
            </div>
        </div>

        <!-- Botón de Guardar -->
        <div class="text-center">
            <button type="submit" class="btn btn-success btn-lg">Guardar</button>
        </div>
    </form>
</div>
<?php require('views/footer.php'); ?>
