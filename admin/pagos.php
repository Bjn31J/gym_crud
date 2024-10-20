<?php
require_once('pagos.class.php'); 
$app = new Pagos(); 
$app -> checkRol('Administrador');
$accion = (isset($_GET['accion'])) ? $_GET['accion'] : NULL;
$id = (isset($_GET['id'])) ? $_GET['id'] : null;
switch ($accion) {
    case 'crear':
        $clientes = $app->getClientes();  
        include 'views/pagos/crear.php'; 
        break;
    case 'nuevo':
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
    case 'actualizar':
        $pago = $app->readOne($id); 
        $clientes = $app->getClientes();  
        include('views/pagos/crear.php'); 
        break;
    case 'modificar':
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
    case 'eliminar':
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
    default:
        $pagos = $app->readAll();
        include 'views/pagos/index.php'; 
}
?>
