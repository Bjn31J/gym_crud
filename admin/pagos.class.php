<?php
require_once('../sistema.class.php');

use Spipu\Html2Pdf\Html2Pdf;
use Spipu\Html2Pdf\Exception\Html2PdfException;
use Spipu\Html2Pdf\Exception\ExceptionFormatter;

class Pagos extends Sistema
{
    function getClientes()
    {
        $this->conexion();
        $result = [];
        $query = "SELECT id_cliente, CONCAT(nombre, ' ', apellido) AS nombre_completo FROM clientes;";
        $sql = $this->con->prepare($query);
        $sql->execute();
        $result = $sql->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
    function getPago($id_cliente)
    {
        $this->conexion();
        $query = "SELECT id_pago, tipo_plan, costo FROM pagos WHERE id_cliente = :id_cliente ORDER BY fecha_pago DESC LIMIT 1;";
        $sql = $this->con->prepare($query);
        $sql->bindParam(':id_cliente', $id_cliente, PDO::PARAM_INT);
        $sql->execute();
        $result = $sql->fetch(PDO::FETCH_ASSOC);
        return $result;
    }
    function create($data)
    {
        $this->conexion();
        if (empty($data['id_cliente']) || empty($data['costo']) || empty($data['tipo_plan']) || empty($data['fecha_pago'])) {
            return ['error' => 'Faltan datos requeridos para el pago'];
        }

        // Validar que la fecha de pago no sea anterior a hoy
        if ($data['fecha_pago'] < date('Y-m-d')) {
            return ['error' => 'La fecha de pago no puede ser anterior a la fecha actual'];
        }

        $sql = "INSERT INTO pagos (id_cliente, costo, tipo_plan, fecha_pago) 
            VALUES (:id_cliente, :costo, :tipo_plan, :fecha_pago);";
        $insertar = $this->con->prepare($sql);
        $insertar->bindParam(':id_cliente', $data['id_cliente'], PDO::PARAM_INT);
        $insertar->bindParam(':costo', $data['costo'], PDO::PARAM_STR);
        $insertar->bindParam(':tipo_plan', $data['tipo_plan'], PDO::PARAM_STR);
        $insertar->bindParam(':fecha_pago', $data['fecha_pago'], PDO::PARAM_STR);
        $insertar->execute();
        return $insertar->rowCount();
    }

    function update($id, $data)
    {
        $this->conexion();
        if (empty($data['id_cliente']) || empty($data['costo']) || empty($data['tipo_plan']) || empty($data['fecha_pago'])) {
            return ['error' => 'Faltan datos requeridos para actualizar el pago'];
        }

        // Validar que la fecha de pago no sea anterior a hoy
        if ($data['fecha_pago'] < date('Y-m-d')) {
            return ['error' => 'La fecha de pago no puede ser anterior a la fecha actual'];
        }

        $sql = "UPDATE pagos 
            SET id_cliente = :id_cliente, costo = :costo, tipo_plan = :tipo_plan, fecha_pago = :fecha_pago 
            WHERE id_pago = :id_pago;";
        $modificar = $this->con->prepare($sql);
        $modificar->bindParam(':id_pago', $id, PDO::PARAM_INT);
        $modificar->bindParam(':id_cliente', $data['id_cliente'], PDO::PARAM_INT);
        $modificar->bindParam(':costo', $data['costo'], PDO::PARAM_STR);
        $modificar->bindParam(':tipo_plan', $data['tipo_plan'], PDO::PARAM_STR);
        $modificar->bindParam(':fecha_pago', $data['fecha_pago'], PDO::PARAM_STR);
        $modificar->execute();
        return $modificar->rowCount();
    }

    function delete($id)
    {
        $this->conexion();
        $this->con->beginTransaction(); // Iniciar transacción
        try {
            // Eliminar registros relacionados en planes_entrenamiento
            $sqlPlanes = "DELETE FROM planes_entrenamiento WHERE id_pago = :id_pago;";
            $stmtPlanes = $this->con->prepare($sqlPlanes);
            $stmtPlanes->bindParam(':id_pago', $id, PDO::PARAM_INT);
            $stmtPlanes->execute();

            // Eliminar el pago
            $sqlPagos = "DELETE FROM pagos WHERE id_pago = :id_pago;";
            $stmtPagos = $this->con->prepare($sqlPagos);
            $stmtPagos->bindParam(':id_pago', $id, PDO::PARAM_INT);
            $stmtPagos->execute();

            $this->con->commit(); // Confirmar transacción
            return $stmtPagos->rowCount();
        } catch (Exception $e) {
            $this->con->rollBack(); // Revertir transacción en caso de error
            throw new Exception("Error al eliminar el pago: " . $e->getMessage());
        }
    }
    function readOne($id)
    {
        $this->conexion();
        $query = "SELECT * FROM pagos WHERE id_pago = :id_pago;";
        $sql = $this->con->prepare($query);
        $sql->bindParam(':id_pago', $id, PDO::PARAM_INT);
        $sql->execute();
        return $sql->fetch(PDO::FETCH_ASSOC);
    }
    function readAll($correo = null)
    {
        $this->conexion();
        if ($correo) {
            // Filtrar pagos por correo
            $query = "SELECT pa.*, CONCAT(c.nombre, ' ', c.apellido) AS cliente_completo, pa.tipo_plan, pa.costo
                  FROM pagos pa
                  INNER JOIN clientes c ON pa.id_cliente = c.id_cliente
                  WHERE c.email = :correo;";
            $sql = $this->con->prepare($query);
            $sql->bindParam(':correo', $correo, PDO::PARAM_STR);
        } else {
            // Mostrar todos los pagos
            $query = "SELECT pa.*, CONCAT(c.nombre, ' ', c.apellido) AS cliente_completo, pa.tipo_plan, pa.costo
                  FROM pagos pa
                  INNER JOIN clientes c ON pa.id_cliente = c.id_cliente;";
            $sql = $this->con->prepare($query);
        }
        $sql->execute();
        return $sql->fetchAll(PDO::FETCH_ASSOC);
    }

    function imprimirTicket($id_pago)
    {
        require_once '../vendor/autoload.php';
        $this->conexion();

        // Consulta para obtener detalles del pago
        $sql = "SELECT p.id_pago, p.costo, p.tipo_plan, p.fecha_pago, c.nombre AS cliente_nombre, c.apellido AS cliente_apellido
                FROM pagos p
                JOIN clientes c ON p.id_cliente = c.id_cliente
                WHERE p.id_pago = :id_pago";
        $consulta = $this->con->prepare($sql);
        $consulta->bindParam(':id_pago', $id_pago, PDO::PARAM_INT);
        $consulta->execute();
        $pago = $consulta->fetch(PDO::FETCH_ASSOC);

        if (!$pago) {
            echo "No se encontró el pago con ID: $id_pago";
            exit;
        }

        try {
            // Contenido del ticket
            ob_start();
            $content = ob_get_clean();
            $content = '
            <html>
            <body style="font-family: Arial, sans-serif; color: #333;">
                <div style="text-align: center; margin-bottom: 20px;">
                    <img src="../images/logo.png" alt="Logo Fitness Plus" style="width: 150px; height: auto;">
                </div>
                <h1 style="text-align: center; color: #ff1133;">Recibo de Pago</h1>
                <p style="text-align: center; font-size: 1.2rem; margin-bottom: 20px;">Gracias por tu pago, ' . $pago['cliente_nombre'] . ' ' . $pago['cliente_apellido'] . '.</p>
                <table border="1" cellpadding="10" cellspacing="0" style="width: 100%; border-collapse: collapse; margin-top: 20px;">
                    <tr>
                        <th style="background-color: #ff1133; color: white; padding: 10px;">Campo</th>
                        <th style="background-color: #ff1133; color: white; padding: 10px;">Valor</th>
                    </tr>
                    <tr>
                        <td style="padding: 10px; border: 1px solid #ddd;">Cliente</td>
                        <td style="padding: 10px; border: 1px solid #ddd;">' . $pago['cliente_nombre'] . ' ' . $pago['cliente_apellido'] . '</td>
                    </tr>
                    <tr>
                        <td style="padding: 10px; border: 1px solid #ddd;">Monto Pagado</td>
                        <td style="padding: 10px; border: 1px solid #ddd;">$' . number_format($pago['costo'], 2) . '</td>
                    </tr>
                    <tr>
                        <td style="padding: 10px; border: 1px solid #ddd;">Tipo de Plan</td>
                        <td style="padding: 10px; border: 1px solid #ddd;">' . $pago['tipo_plan'] . '</td>
                    </tr>
                    <tr>
                        <td style="padding: 10px; border: 1px solid #ddd;">Fecha de Pago</td>
                        <td style="padding: 10px; border: 1px solid #ddd;">' . date('d/m/Y', strtotime($pago['fecha_pago'])) . '</td>
                    </tr>
                </table>
            </body>
            </html>';
            // Generar PDF
            $html2pdf = new Html2Pdf('P', 'A4', 'es');
            $html2pdf->setDefaultFont('Arial');
            $html2pdf->writeHTML($content);
            $html2pdf->output('ticket_pago_' . $id_pago . '.pdf');
        } catch (Html2PdfException $e) {
            $html2pdf->clean();

            $formatter = new ExceptionFormatter($e);
            echo $formatter->getHtmlMessage();
        }
    }
}
