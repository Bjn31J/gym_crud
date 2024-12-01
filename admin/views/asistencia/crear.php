<?php require('views/header.php'); ?>
<div class="container mt-5">
    <h1 class="text-center mb-4">
        <?php if ($accion == "crear"): echo "Nueva "; else: echo "Modificar "; endif; ?>
        Asistencia de Entrenador
    </h1>
    <form action="asistencia.php?accion=<?php if ($accion == "crear"): echo ('nuevo'); else: echo ('modificar&id=' . $id); endif; ?>" 
          method="post" 
          class="bg-light p-5 rounded shadow-sm">
        <!-- Selección del Plan de Entrenamiento -->
        <div class="form-group">
            <label for="id_plan" class="font-weight-bold">Tipo de Plan y Entrenador</label>
            <select name="data[id_plan]" id="id_plan" class="form-control" required>
                <?php foreach ($planes as $plan): ?>
                    <option value="<?php echo ($plan['id_plan']); ?>"
                        <?php if (isset($asistencia['id_plan']) && $asistencia['id_plan'] == $plan['id_plan']): echo 'selected'; endif; ?>>
                        <!-- Mostrar tipo de plan y nombre completo del entrenador (nombre + apellido) -->
                        <?php echo (ucfirst($plan['tipo_plan']) . " - " . $plan['entrenador_completo']); ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        <!-- Fecha de Asistencia -->
        <div class="form-group">
            <label for="fecha_asistencia" class="font-weight-bold">Fecha de Asistencia</label>
            <input type="date" 
                   name="data[fecha_asistencia]" 
                   id="fecha_asistencia" 
                   class="form-control" 
                   value="<?php echo isset($asistencia['fecha_asistencia']) ? $asistencia['fecha_asistencia'] : date('Y-m-d'); ?>" 
                   min="<?php echo date('Y-m-d'); ?>" 
                   required />
        </div>
        <!-- Asistió (Sí o No) -->
        <div class="form-group">
            <label for="asistio" class="font-weight-bold">¿Asistió?</label>
            <select name="data[asistio]" id="asistio" class="form-control" required>
                <option value="Sí" <?php if (isset($asistencia['asistio']) && $asistencia['asistio'] == 'Sí'): echo 'selected'; endif; ?>>Sí</option>
                <option value="No" <?php if (isset($asistencia['asistio']) && $asistencia['asistio'] == 'No'): echo 'selected'; endif; ?>>No</option>
            </select>
        </div>
        <!-- Botón de Guardar -->
        <div class="text-center">
            <button type="submit" class="btn btn-success btn-lg">Guardar</button>
        </div>
    </form>
</div>
<?php require('views/footer.php'); ?>
