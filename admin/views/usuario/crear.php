<?php require('views/header/header_administrador.php'); ?>
<div class="container mt-5">
    <h1 class="text-center mb-4"><?php echo ($accion == "crear") ? "Nuevo " : "Modificar "; ?>Usuario</h1>
    
    <form action="usuario.php?accion=<?php echo ($accion == "crear") ? 'nuevo' : 'modificar&id=' . $id; ?>" method="post" class="bg-light p-5 rounded shadow-sm">
        <div class="form-group row mb-4">
            <label for="correo" class="col-sm-2 col-form-label font-weight-bold">Correo electrónico</label>
            <div class="col-sm-10">
                <input type="email" name="data[correo]" placeholder="Escribe aquí el correo" class="form-control"
                    value="<?php echo isset($usuario['correo']) ? $usuario['correo'] : ''; ?>" required />
            </div>
        </div>
        <div class="form-group row mb-4">
            <label for="contrasena" class="col-sm-2 col-form-label font-weight-bold">Contraseña</label>
            <div class="col-sm-10">
                <input type="password" name="data[contrasena]" placeholder="Escribe aquí la contraseña" class="form-control" required />
            </div>
        </div>
        <h5 class="mb-3">Asignación de Roles</h5>
        <?php foreach($roles as $rol): ?>
            <div class="form-check form-switch mb-2">
                <input class="form-check-input" type="checkbox" 
                       <?php echo (in_array($rol['id_rol'], $misroles)) ? 'checked' : ''; ?> 
                       role="switch" id="rol_<?php echo $rol['id_rol']; ?>" 
                       name="rol[<?php echo $rol['id_rol']; ?>]">
                <label class="form-check-label" for="rol_<?php echo $rol['id_rol']; ?>">
                    <?php echo $rol['rol']; ?>
                </label>
            </div>
        <?php endforeach; ?>
        <div class="text-center">
            <button type="submit" name="data[enviar]" class="btn btn-success btn-lg px-5">Guardar</button>
        </div>
    </form>
</div>

<?php require('views/footer.php'); ?>
