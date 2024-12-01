<?php
session_start();
require_once('pagos.class.php');
$app = new Pagos();

// Obtener el correo del usuario desde la sesión
$correoUsuario = isset($_SESSION['correo']) ? $_SESSION['correo'] : null;

// Verificar el rol del usuario
$rolUsuario = $app->checkRol('Administrador', 'Cliente');

// Obtener acción e ID
$accion = isset($_GET['accion']) ? $_GET['accion'] : null;
$id = isset($_GET['id']) ? $_GET['id'] : null;

switch ($accion) {
    case 'crear': // Acceso solo para Administrador
        if ($rolUsuario != 'Administrador') {
            $mensaje = "Acción no permitida.";
            $tipo = "danger";
            $pagos = $app->readAll($correoUsuario); // Mostrar solo los pagos del cliente logueado
            include 'views/pagos/index_cliente.php';
            exit();
        }
        $clientes = $app->getClientes();
        include 'views/pagos/crear.php';
        break;

    case 'nuevo': // Acceso solo para Administrador
        if ($rolUsuario != 'Administrador') {
            $mensaje = "Acción no permitida.";
            $tipo = "danger";
            $pagos = $app->readAll($correoUsuario);
            include 'views/pagos/index_cliente.php';
            exit();
        }
        $data = $_POST['data'];
        $resultado = $app->create($data);
        if (is_array($resultado) && isset($resultado['error'])) {
            $mensaje = $resultado['error'];
            $tipo = "danger";
        } else if ($resultado) {
            $mensaje = "El pago se agregó correctamente";
            $tipo = "success";
        } else {
            $mensaje = "Hubo un error al agregar el pago";
            $tipo = "danger";
        }
        $pagos = $app->readAll();
        include('views/pagos/index.php');
        break;

    case 'actualizar': // Acceso solo para Administrador
        if ($rolUsuario != 'Administrador') {
            $mensaje = "Acción no permitida.";
            $tipo = "danger";
            $pagos = $app->readAll($correoUsuario);
            include 'views/pagos/index_cliente.php';
            exit();
        }
        $pago = $app->readOne($id);
        $clientes = $app->getClientes();
        include('views/pagos/crear.php');
        break;

    case 'modificar': // Acceso solo para Administrador
        if ($rolUsuario != 'Administrador') {
            $mensaje = "Acción no permitida.";
            $tipo = "danger";
            $pagos = $app->readAll($correoUsuario);
            include 'views/pagos/index_cliente.php';
            exit();
        }
        $data = $_POST['data'];
        $resultado = $app->update($id, $data);

        if ($resultado) {
            $mensaje = "El pago se actualizó correctamente";
            $tipo = "success";
        } else {
            $mensaje = "Hubo un error al actualizar el pago";
            $tipo = "danger";
        }
        $pagos = $app->readAll();
        include('views/pagos/index.php');
        break;

    case 'eliminar': // Acceso solo para Administrador
        if ($rolUsuario != 'Administrador') {
            $mensaje = "Acción no permitida.";
            $tipo = "danger";
            $pagos = $app->readAll($correoUsuario);
            include 'views/pagos/index_cliente.php';
            exit();
        }
        if (!is_null($id) && is_numeric($id)) {
            $resultado = $app->delete($id);
            if ($resultado) {
                $mensaje = "El pago se ha eliminado correctamente";
                $tipo = "success";
            } else {
                $mensaje = "Ocurrió un error al eliminar el pago";
                $tipo = "danger";
            }
        }
        $pagos = $app->readAll();
        include("views/pagos/index.php");
        break;

    case 'imprimir': // Permitido para Cliente y Administrador
        $app->imprimirTicket($id);
        die();

    default: // Mostrar pagos
        if ($rolUsuario === 'Cliente') {
            // Mostrar pagos solo del cliente logueado
            $pagos = $app->readAll($correoUsuario);
            include 'views/pagos/index_cliente.php';
        } else {
            // Mostrar todos los pagos para el administrador
            $pagos = $app->readAll();
            include 'views/pagos/index.php';
        }
        break;
}
?>

