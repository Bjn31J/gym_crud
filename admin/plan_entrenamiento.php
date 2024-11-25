<?php
require_once('plan_entrenamiento.class.php');
$app = new Plan_Entrenamiento(); 
$rolUsuario = $app->checkRol('Administrador', 'Cliente');
$accion = (isset($_GET['accion'])) ? $_GET['accion'] : NULL;
$id = (isset($_GET['id'])) ? $_GET['id'] : null;

// Restricciones para rol "Cliente"
if ($rolUsuario == 'Cliente' && !in_array($accion, [NULL, 'imprimir'])) {
    $mensaje = "Acción no permitida para este rol.";
    $tipo = "danger";
    $planes = $app->readAll(); // Mostrar solo los planes
    include 'views/plan_entrenamiento/index.php'; 
    exit();
}

switch ($accion) {
    case 'crear': // Acceso solo para Administrador
        if ($rolUsuario != 'Administrador') {
            $mensaje = "Acción no permitida.";
            $tipo = "danger";
            $planes = $app->readAll();
            include 'views/plan_entrenamiento/index.php'; 
            exit();
        }
        $clientes = $app->getClientes();  
        $entrenadores = $app->getEntrenadores();  
        include 'views/plan_entrenamiento/crear.php'; 
        break;

    case 'nuevo': // Acceso solo para Administrador
        if ($rolUsuario != 'Administrador') {
            $mensaje = "Acción no permitida.";
            $tipo = "danger";
            $planes = $app->readAll();
            include 'views/plan_entrenamiento/index.php'; 
            exit();
        }
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

    case 'actualizar': // Acceso solo para Administrador
        if ($rolUsuario != 'Administrador') {
            $mensaje = "Acción no permitida.";
            $tipo = "danger";
            $planes = $app->readAll();
            include 'views/plan_entrenamiento/index.php'; 
            exit();
        }
        $plan = $app->readOne($id); 
        $clientes = $app->getClientes();  
        $entrenadores = $app->getEntrenadores();  
        include('views/plan_entrenamiento/crear.php'); 
        break;

    case 'modificar': // Acceso solo para Administrador
        if ($rolUsuario != 'Administrador') {
            $mensaje = "Acción no permitida.";
            $tipo = "danger";
            $planes = $app->readAll();
            include 'views/plan_entrenamiento/index.php'; 
            exit();
        }
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

    case 'eliminar': // Acceso solo para Administrador
        if ($rolUsuario != 'Administrador') {
            $mensaje = "Acción no permitida.";
            $tipo = "danger";
            $planes = $app->readAll();
            include 'views/plan_entrenamiento/index.php'; 
            exit();
        }
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

        default: // Mostrar planes
        if ($rolUsuario === 'Cliente') {
            $planes = $app->readAll('Cliente'); // Filtrar por cliente
            include 'views/plan_entrenamiento/index_cliente.php'; // Vista del cliente
        } else {
            $planes = $app->readAll('Administrador'); // Administrador ve todos los planes
            include 'views/plan_entrenamiento/index.php'; // Vista del administrador
        }
        break;
}
?>



