<?php
require_once('permiso.class.php');
$app = new Permiso();
$app->checkRol('Administrador');
$accion = (isset($_GET['accion'])) ? $_GET['accion'] : NULL;
$id = (isset($_GET['id'])) ? $_GET['id'] : null;

switch ($accion) {
    case 'crear':
        include 'views/permiso/crear.php';
        break;
    case 'nuevo':
        $data = $_POST['data'];
        $resultado = $app->create($data);
        $mensaje = $resultado ? "El permiso se agregó correctamente" : "Hubo un error al agregar el permiso";
        $tipo = $resultado ? "success" : "danger";
        $permisos = $app->readAll();
        include('views/permiso/index.php');
        break;
    case 'actualizar':
        $permiso = $app->readOne($id);
        include('views/permiso/crear.php');
        break;
    case 'modificar':
        $data = $_POST['data'];
        $resultado = $app->update($id, $data);
        $mensaje = $resultado ? "El permiso se actualizó correctamente" : "Hubo un error al actualizar el permiso";
        $tipo = $resultado ? "success" : "danger";
        $permisos = $app->readAll();
        include('views/permiso/index.php');
        break;
    case 'eliminar':
        $resultado = $app->delete($id);
        $mensaje = $resultado ? "El permiso se eliminó correctamente" : "Hubo un error al eliminar el permiso";
        $tipo = $resultado ? "success" : "danger";
        $permisos = $app->readAll();
        include("views/permiso/index.php");
        break;
    default:
        $permisos = $app->readAll();
        include 'views/permiso/index.php';
}
require_once('views/footer.php');
?>
