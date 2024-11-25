<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fitness Plus - Entrenador</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/fitnessplus/css/estilo.css">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Fitness Plus - Entrenador</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <!-- Link a Asistencias -->
                    <li class="nav-item">
                        <a class="nav-link" href="asistencia.php">Asistencias</a>
                    </li>
                    <!-- Link a Plan de Entrenamiento -->
                    <li class="nav-item">
                        <a class="nav-link" href="plan_entrenamiento.php">Plan de Entrenamiento</a>
                    </li>
                    <!-- Botón de Cerrar Sesión -->
                    <li class="nav-item">
                        <a class="nav-link text-danger" href="login.php?accion=logout">Salir</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- Contenido Principal -->
    <div class="container mt-4">
        <h1>Bienvenido, Entrenador</h1>
    </div>

    <!-- Bootstrap JS and Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
