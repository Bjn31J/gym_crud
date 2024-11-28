<?php
header("Content-type: application/json; charset=utf-8");
require_once('pagos.class.php');

$app = new Pagos();
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
                $data['message'] = $resultado ? 'Pago actualizado correctamente' : 'Error al actualizar el pago';
            } else {
                $resultado = $app->create($datos);
                $data['message'] = $resultado ? 'Pago creado correctamente' : 'Error al crear el pago';
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
                    $data['message'] = 'Pago no encontrado';
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
                $data['message'] = $resultado ? 'Pago eliminado correctamente' : 'Error al eliminar el pago';
                $data['success'] = $resultado ? true : false;
            } else {
                http_response_code(400);
                $data['message'] = 'ID inválido para eliminar';
            }
            break;

        case 'PATCH':
            // Exportar a PDF
            if (!is_null($id) && is_numeric($id)) {
                $app->imprimirTicket($id);
                $data['message'] = 'El ticket se está generando';
                $data['success'] = true;
            } else {
                http_response_code(400);
                $data['message'] = 'ID inválido para generar el ticket';
                $data['success'] = false;
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
