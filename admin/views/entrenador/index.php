<?php require('views/header/header_administrador.php'); ?>
<div class="container mt-5">
    <h1 class="text-center mb-4 "style="font-weight: bold;">Entrenadores Fitness Plus</h1>

    <!-- Botón "Nuevo Entrenador" -->
    <div class="mb-3">
        <a href="entrenador.php?accion=crear" class="btn btn-success btn-lg">Nuevo Entrenador</a>
    </div>

    <!-- Tabla de Entrenadores -->
    <table class="table table-hover table-bordered shadow-sm">
        <thead class="thead-dark">
            <tr>
                <th scope="col">Id</th>
                <th scope="col">Fotografía</th>
                <th scope="col">Nombre</th>
                <th scope="col">Apellidos</th>
                <th scope="col">Especialidad</th>
                <th scope="col">Email</th>
                <th scope="col">Teléfono</th>
                <th scope="col">Opciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($entrenadores as $entrenador): ?>
                <tr>
                    <th scope="row"><?php echo $entrenador['id_entrenador']; ?></th>
                    <td>
                        <div class="d-flex justify-content-center">
                            <img class="rounded shadow-sm"
                                src="<?php
                                        $rutaImagen = $_SERVER['DOCUMENT_ROOT'] . "/fitnessplus/uploads/" . $entrenador['fotografia'];
                                        if (!empty($entrenador['fotografia']) && file_exists($rutaImagen)) {
                                            echo "/fitnessplus/uploads/" . $entrenador['fotografia'];
                                        } else {
                                            echo '/fitnessplus/uploads/default.png';
                                        }
                                        ?>"
                                alt="Foto de <?php echo htmlspecialchars($entrenador['nombre']); ?>"
                                style="width: 100px; height: auto; max-height: 100px;">
                        </div>
                    </td>

                    <td><?php echo $entrenador['nombre']; ?></td>
                    <td><?php echo $entrenador['apellido']; ?></td>
                    <td><?php echo $entrenador['especialidad']; ?></td>
                    <td><?php echo $entrenador['email']; ?></td>
                    <td><?php echo $entrenador['telefono']; ?></td>
                    <td>
                        <!-- Botones separados para actualizar y eliminar -->
                        <a href="entrenador.php?accion=actualizar&id=<?php echo $entrenador['id_entrenador']; ?>" class="btn btn-primary">Actualizar</a>
                        <a href="entrenador.php?accion=eliminar&id=<?php echo $entrenador['id_entrenador']; ?>" class="btn btn-danger ml-2">Eliminar</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
<?php require('views/footer.php'); ?>