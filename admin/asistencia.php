<?php
require_once('asistencia.class.php');
$app = new Asistencia();

// Verificar roles
$rolUsuario = $app->checkRol('Administrador', 'Entrenador');
$accion = (isset($_GET['accion'])) ? $_GET['accion'] : null;
$id = (isset($_GET['id'])) ? $_GET['id'] : null;

// Restricción para Entrenador: Solo permitir 'crear' y 'nuevo'
if ($rolUsuario === 'Entrenador' && !in_array($accion, [null, 'crear', 'nuevo'])) {
    $mensaje = "Acción no permitida para este rol.";
    $tipo = "danger";
    $asistencias = $app->readAll();
    include 'views/asistencia/index_entrenador.php'; // Mostrar solo las opciones del entrenador
    exit();
}

switch ($accion) {
    case 'crear': // Permitir a Administrador y Entrenador
        $planes = $app->getPlanes(); 
        include 'views/asistencia/crear.php';
        break;

    case 'nuevo': // Permitir a Administrador y Entrenador
        $data = $_POST['data'];
        $resultado = $app->create($data);
        if ($resultado) {
            $mensaje = "La asistencia fue registrada correctamente.";
            $tipo = "success";
        } else {
            $mensaje = "Hubo un error al registrar la asistencia.";
            $tipo = "danger";
        }
        $asistencias = $app->readAll();
        if ($rolUsuario === 'Entrenador') {
            include('views/asistencia/index_entrenador.php'); // Usar la vista específica del entrenador
        } else {
            include('views/asistencia/index.php'); // Vista completa para el administrador
        }
        break;

    case 'actualizar': // Solo para Administrador
        if ($rolUsuario !== 'Administrador') {
            $mensaje = "Acción no permitida.";
            $tipo = "danger";
            $asistencias = $app->readAll();
            include('views/asistencia/index_entrenador.php');
            exit();
        }
        $asistencia = $app->readOne($id); 
        $planes = $app->getPlanes(); 
        include('views/asistencia/crear.php'); 
        break;

    case 'modificar': // Solo para Administrador
        if ($rolUsuario !== 'Administrador') {
            $mensaje = "Acción no permitida.";
            $tipo = "danger";
            $asistencias = $app->readAll();
            include('views/asistencia/index_entrenador.php');
            exit();
        }
        $data = $_POST['data'];
        $resultado = $app->update($id, $data);
        if ($resultado) {
            $mensaje = "La asistencia fue actualizada correctamente.";
            $tipo = "success";
        } else {
            $mensaje = "Hubo un error al actualizar la asistencia.";
            $tipo = "danger";
        }
        $asistencias = $app->readAll();
        include('views/asistencia/index.php'); // Correcto para administrador
        break;

    case 'eliminar': // Solo para Administrador
        if ($rolUsuario !== 'Administrador') {
            $mensaje = "Acción no permitida.";
            $tipo = "danger";
            $asistencias = $app->readAll();
            include('views/asistencia/index_entrenador.php');
            exit();
        }
        if (!is_null($id)) {
            $resultado = $app->delete($id);
            if ($resultado) {
                $mensaje = "La asistencia fue eliminada correctamente.";
                $tipo = "success";
            } else {
                $mensaje = "Hubo un error al eliminar la asistencia.";
                $tipo = "danger";
            }
        }
        $asistencias = $app->readAll();
        include("views/asistencia/index.php"); // Correcto para administrador
        break;

    default:
        $asistencias = $app->readAll();
        if ($rolUsuario === 'Entrenador') {
            include 'views/asistencia/index_entrenador.php'; // Vista específica para el entrenador
        } else {
            include 'views/asistencia/index.php'; // Vista completa para el administrador
        }
}
?>
