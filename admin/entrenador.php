<?php
require_once('entrenador.class.php');
$app = new Entrenador(); 
$accion = (isset($_GET['accion'])) ? $_GET['accion'] : NULL;
$id = (isset($_GET['id'])) ? $_GET['id'] : null;
switch ($accion) {
    case 'crear':
        include 'views/entrenador/crear.php'; 
        break;
    case 'nuevo':
        $data = $_POST['data'];
        $resultado = $app->create($data);
        if ($resultado) {
            $mensaje = "El entrenador se agregó correctamente";
            $tipo = "success";
        } else {
            $mensaje = "Hubo un error al agregar el entrenador";
            $tipo = "danger";
        }
        $entrenadores = $app->readAll();
        include('views/entrenador/index.php'); 
        break;
    case 'actualizar':
        $entrenador = $app->readOne($id); 
        include('views/entrenador/crear.php'); 
        break;
    case 'modificar':
        $data = $_POST['data'];
        $resultado = $app->update($id, $data);
        if ($resultado) {
            $mensaje = "El entrenador se actualizó correctamente";
            $tipo = "success";
        } else {
            $mensaje = "Hubo un error al actualizar el entrenador";
            $tipo = "danger";
        }
        $entrenadores = $app->readAll();
        include('views/entrenador/index.php'); 
        break;
    case 'eliminar':
        if (!is_null($id)) {
            if (is_numeric($id)) {
                $resultado = $app->delete($id);
                if ($resultado) {
                    $mensaje = "El entrenador se ha eliminado correctamente";
                    $tipo = "success";
                } else {
                    $mensaje = "Ocurrió un error al eliminar el entrenador";
                    $tipo = "danger";
                }
            }
        }
        $entrenadores = $app->readAll();
        include("views/entrenador/index.php"); 
        break;
    default:
        $entrenadores = $app->readAll();
        include 'views/entrenador/index.php'; 
}
?>