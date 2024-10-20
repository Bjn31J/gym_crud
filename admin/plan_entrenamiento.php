<?php
require_once('plan_entrenamiento.class.php');
$app = new Plan_Entrenamiento(); 
$app -> checkRol('Administrador');
$accion = (isset($_GET['accion'])) ? $_GET['accion'] : NULL;
$id = (isset($_GET['id'])) ? $_GET['id'] : null;
switch ($accion) {
    case 'crear':
        $clientes = $app->getClientes();  
        $entrenadores = $app->getEntrenadores();  
        include 'views/plan_entrenamiento/crear.php'; 
        break;
    case 'nuevo':
        $data = $_POST['data'];
        $resultado = $app->create($data);
        if (is_array($resultado) && isset($resultado['error'])) {
            $mensaje = $resultado['error'];
            $tipo = "danger";
        } else if ($resultado) {
            $mensaje = "El plan de entrenamiento se agregó correctamente";
            $tipo = "success";
        } else {
            $mensaje = "Hubo un error al agregar el plan de entrenamiento";
            $tipo = "danger";
        }
        $planes = $app->readAll();
        include('views/plan_entrenamiento/index.php'); 
        break;
    case 'actualizar':
        $plan = $app->readOne($id); 
        $clientes = $app->getClientes();  
        $entrenadores = $app->getEntrenadores();  
        include('views/plan_entrenamiento/crear.php'); 
        break;
    case 'modificar':
        $data = $_POST['data'];
        $resultado = $app->update($id, $data);
        if ($resultado) {
            $mensaje = "El plan de entrenamiento se actualizó correctamente";
            $tipo = "success";
        } else {
            $mensaje = "Hubo un error al actualizar el plan de entrenamiento";
            $tipo = "danger";
        }
        $planes = $app->readAll();
        include('views/plan_entrenamiento/index.php'); 
        break;
    case 'eliminar':
        if (!is_null($id) && is_numeric($id)) {
            $resultado = $app->delete($id);
            if ($resultado) {
                $mensaje = "El plan de entrenamiento se ha eliminado correctamente";
                $tipo = "success";
            } else {
                $mensaje = "Ocurrió un error al eliminar el plan de entrenamiento";
                $tipo = "danger";
            }
        }
        $planes = $app->readAll();
        include("views/plan_entrenamiento/index.php"); 
        break;
    default:
        $planes = $app->readAll();
        include 'views/plan_entrenamiento/index.php'; 
}
?>



