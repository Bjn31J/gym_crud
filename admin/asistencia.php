<?php
require_once('asistencia.class.php');
$app = new Asistencia();
$accion = (isset($_GET['accion'])) ? $_GET['accion'] : null;
$id = (isset($_GET['id'])) ? $_GET['id'] : null;
switch ($accion) {
    case 'crear':
        $planes = $app->getPlanes(); 
        include 'views/asistencia/crear.php';
        break;
    case 'nuevo':
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
        include('views/asistencia/index.php');
        break;
    case 'actualizar':
        $asistencia = $app->readOne($id); 
        $planes = $app->getPlanes(); 
        include('views/asistencia/crear.php'); 
        break;
    case 'modificar':
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
        include('views/asistencia/index.php');
        break;
    case 'eliminar':
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
        include("views/asistencia/index.php");
        break;
    default:
        $asistencias = $app->readAll();
        include 'views/asistencia/index.php';
}
?>
