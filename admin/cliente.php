<?php
require_once('cliente.class.php');
$app = new Cliente(); 
$app -> checkRol('Administrador');
$accion = (isset($_GET['accion'])) ? $_GET['accion'] : NULL;
$id = (isset($_GET['id'])) ? $_GET['id'] : null;
switch ($accion) {
    case 'crear':
        include 'views/cliente/crear.php'; 
        break;
    case 'nuevo':
        $data = $_POST['data'];
        $resultado = $app->create($data);
        if ($resultado) {
            $mensaje = "El cliente se agregó correctamente";
            $tipo = "success";
        } else {
            $mensaje = "Hubo un error al agregar el cliente";
            $tipo = "danger";
        }
        $clientes = $app->readAll();
        include('views/cliente/index.php'); 
        break;
    case 'actualizar':
        $cliente = $app->readOne($id); 
        include('views/cliente/crear.php'); 
        break;
    case 'modificar':
        $data = $_POST['data'];
        $resultado = $app->update($id, $data);
        if ($resultado) {
            $mensaje = "El cliente se actualizó correctamente";
            $tipo = "success";
        } else {
            $mensaje = "Hubo un error al actualizar el cliente";
            $tipo = "danger";
        }
        $clientes = $app->readAll();
        include('views/cliente/index.php'); 
        break;
    case 'eliminar':
        if (!is_null($id)) {
            if (is_numeric($id)) {
                $resultado = $app->delete($id);
                if ($resultado) {
                    $mensaje = "El cliente se ha eliminado correctamente";
                    $tipo = "success";
                } else {
                    $mensaje = "Ocurrió un error al eliminar el cliente";
                    $tipo = "danger";
                }
            }
        }
        $clientes = $app->readAll();
        include("views/cliente/index.php"); 
        break;
    default:
        $clientes = $app->readAll();
        include 'views/cliente/index.php'; 
}
