<?php
require_once('../sistema.class.php'); 
$app = new Sistema;
$accion = (isset($_GET['accion'])) ? $_GET['accion'] : NULL;

switch ($accion) {
    case 'login':
        $correo = $_POST['data']['correo'];
        $contrasena = $_POST['data']['contrasena'];
        
        if ($app->login($correo, $contrasena)) {
            $mensaje = "Bienvenido al sistema";
            $tipo = "success";

            // Obtener el rol del usuario
            $rol = $app->getCurrentRol(); // Llama a un método para obtener el rol actual del usuario

            if ($rol === 'Administrador') {
                $app->checkRol('Administrador'); // Verifica el rol
                require_once('views/header/header_administrador.php');
            } elseif ($rol === 'Cliente') {
                $app->checkRol('Cliente'); // Verifica el rol
                require_once('views/header/header_cliente.php');
            } elseif ($rol === 'Entrenador') {
                $app->checkRol('Entrenador'); // Verifica el rol
                require_once('views/header/header_entrenador.php');
            } else {
                // Si el rol no es permitido
                $mensaje = "No tienes permisos para acceder a esta sección.";
                $tipo = "danger";
                $app->logout(); // Cierra sesión automáticamente
            }

            $app->alert($tipo, $mensaje);
        } else {
            // Si el correo o contraseña son incorrectos
            $mensaje = "Correo o contraseña incorrectos <a href='login.php'>[Presione aquí para volver a intentar]</a>";
            $tipo = "danger";
            require_once('views/header.php');
            $app->alert($tipo, $mensaje);
        }
        break;

    case 'logout':
        $app->logout();
        break;

    default:
        require_once('views/login/index.php');
        break;
}

require_once('views/footer.php');
?>

