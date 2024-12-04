<?php
require_once('roles.class.php');
$app = new Roles();
$app -> checkRol('Administrador');
$accion = isset($_GET['accion']) ? $_GET['accion'] : null;
$id = isset($_GET['id']) ? $_GET['id'] : null;
switch ($accion) {
    case 'crear':
        require 'views/roles/crear.php';
        break;
    case 'nuevo':
        $data = $_POST['data'];
        $resultado = $app->create($data);
        $mensaje = $resultado ? "Rol creado correctamente." : "Error al crear el rol.";
        $tipo = $resultado ? "success" : "danger";
        $roles = $app->readAll();
        require 'views/roles/index.php';
        break;
    case 'actualizar':
        $rol = $app->readOne($id);
        require 'views/roles/crear.php';
        break;
    case 'modificar':
        $data = $_POST['data'];
        $resultado = $app->update($id, $data);
        $mensaje = $resultado ? "Rol actualizado correctamente." : "Error al actualizar el rol.";
        $tipo = $resultado ? "success" : "danger";
        $roles = $app->readAll();
        require 'views/roles/index.php';
        break;
    case 'eliminar':
        $resultado = $app->delete($id);
        $mensaje = $resultado ? "Rol eliminado correctamente." : "Error al eliminar el rol.";
        $tipo = $resultado ? "success" : "danger";
        $roles = $app->readAll();
        require 'views/roles/index.php';
        break;
    default:
        $roles = $app->readAll();
        require 'views/roles/index.php';
        break;
}
