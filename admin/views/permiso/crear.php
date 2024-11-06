<?php require('views/header/header_administrador.php'); ?>
<div class="container mt-5">
    <h1 class="text-center mb-4"><?php echo ($accion == "crear") ? "Nuevo " : "Modificar "; ?>Permiso</h1>

    <form action="permiso.php?accion=<?php echo ($accion == "crear") ? 'nuevo' : 'modificar&id=' . $id; ?>" method="post" class="bg-light p-5 rounded shadow-sm">
        
        <!-- Campo de Nombre del Permiso -->
        <div class="form-group row mb-4">
            <label for="permiso" class="col-sm-2 col-form-label font-weight-bold">Nombre del Permiso</label>
            <div class="col-sm-10">
                <input type="text" name="data[permiso]" placeholder="Escribe aquí el nombre del permiso" class="form-control" 
                       value="<?php echo isset($permiso['permiso']) ? $permiso['permiso'] : ''; ?>" required/>
            </div>
        </div>

        <!-- Botón Guardar -->
        <div class="text-center">
            <input type="submit" name="data[enviar]" value="Guardar" class="btn btn-success btn-lg px-5"/>
        </div>
    </form>
</div>
<?php require('views/footer.php'); ?>

