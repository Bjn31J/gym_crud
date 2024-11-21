<?php require_once('views/header.php') ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fitness Plus - Administrador</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="./header_cliente.php">Fitness Plus</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <!-- Dropdown for Catalog -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownCatalogo" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Gestión de Entrenamiento
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdownCatalogo">
                        <li><a class="dropdown-item" href="plan_entrenamiento.php">Planes de Entrenamiento</a></li>
                        <li><a class="dropdown-item" href="asistencia.php">Asistencias</a></li>
                        <li><a class="dropdown-item" href="pagos.php">Pagos</a></li>
                    </ul>
                </li>
                <!-- Dropdown for User Management -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownUsuario" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Administración de Usuarios
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdownUsuario">
                        <li><a class="dropdown-item" href="cliente.php">Clientes</a></li>
                        <li><a class="dropdown-item" href="entrenador.php">Entrenadores</a></li>
                        <li><a class="dropdown-item" href="usuario.php">Usuarios</a></li>
                        <li><a class="dropdown-item" href="roles.php">Roles</a></li>
                        <li><a class="dropdown-item" href="permiso.php">Permisos</a></li>
                    </ul>
                </li>
                <!-- Logout Link -->
                <li class="nav-item">
                    <a class="nav-link" href="login.php?accion=logout">Salir</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<!-- Bootstrap JS and Popper.js -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
