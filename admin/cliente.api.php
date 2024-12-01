<?php
header("Content-type: application/json; charset=utf-8");
require_once('cliente.class.php');
$app = new Cliente();
$accion = $_SERVER['REQUEST_METHOD'];
$id = (isset($_GET['id'])) ? $_GET['id'] : null;
$data = [];
try {
    switch ($accion) {
        case 'POST':
            // Crear o actualizar
            $datos = json_decode(file_get_contents('php://input'), true);
            if (!is_null($id) && is_numeric($id)) {
                $resultado = $app->update($id, $datos);
                $data['message'] = $resultado ? 'Cliente actualizado correctamente' : 'Error al actualizar el Cliente';
            } else {
                $resultado = $app->create($datos);
                $data['message'] = $resultado ? 'Cliente creado correctamente' : 'Error al crear el Cliente';
            }
            $data['success'] = $resultado ? true : false;
            break;

        case 'GET':
            // Leer uno o todos
            if (!is_null($id) && is_numeric($id)) {
                $pago = $app->readOne($id);
                if ($pago) {
                    $data['data'] = $pago;
                    $data['success'] = true;
                } else {
                    http_response_code(404);
                    $data['message'] = 'Cliente no encontrado';
                    $data['success'] = false;
                }
            } else {
                $data['data'] = $app->readAll();
                $data['success'] = true;
            }
            break;
        case 'DELETE':
            // Eliminar
            if (!is_null($id) && is_numeric($id)) {
                $resultado = $app->delete($id);
                $data['message'] = $resultado ? 'Cliente eliminado correctamente' : 'Error al eliminar el Cliente';
                $data['success'] = $resultado ? true : false;
            } else {
                http_response_code(400);
                $data['message'] = 'ID inválido para eliminar';
            }
            break;
        default:
            http_response_code(405);
            $data['message'] = 'Método HTTP no permitido';
    }
} catch (Exception $e) {
    http_response_code(500);
    $data = [
        'success' => false,
        'message' => 'Error interno del servidor',
        'error' => $e->getMessage()
    ];
}
echo json_encode($data);
?>
