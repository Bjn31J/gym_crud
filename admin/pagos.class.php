<?php
require_once ('../sistema.class.php');
class Pagos extends Sistema {
    function getClientes() {
        $this->conexion();
        $result = [];
        $query = "SELECT id_cliente, CONCAT(nombre, ' ', apellido) AS nombre_completo FROM clientes;";
        $sql = $this->con->prepare($query);
        $sql->execute();
        $result = $sql->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
    function getPago($id_cliente) {
        $this->conexion();
        $query = "SELECT id_pago, tipo_plan, costo FROM pagos WHERE id_cliente = :id_cliente ORDER BY fecha_pago DESC LIMIT 1;";
        $sql = $this->con->prepare($query);
        $sql->bindParam(':id_cliente', $id_cliente, PDO::PARAM_INT);
        $sql->execute();
        $result = $sql->fetch(PDO::FETCH_ASSOC);
        return $result;
    }
    function create($data) {
        $this->conexion();
        if (empty($data['id_cliente']) || empty($data['costo']) || empty($data['tipo_plan'])) {
            return ['error' => 'Faltan datos requeridos para el pago'];
        }
        $sql = "INSERT INTO pagos (id_cliente, costo, tipo_plan, fecha_pago) 
                VALUES (:id_cliente, :costo, :tipo_plan, NOW());";
        $insertar = $this->con->prepare($sql);
        $insertar->bindParam(':id_cliente', $data['id_cliente'], PDO::PARAM_INT);
        $insertar->bindParam(':costo', $data['costo'], PDO::PARAM_STR);
        $insertar->bindParam(':tipo_plan', $data['tipo_plan'], PDO::PARAM_STR);
        $insertar->execute();
        return $insertar->rowCount();
    }
    function update($id, $data) {
        $this->conexion();
        $sql = "UPDATE pagos 
                SET id_cliente = :id_cliente, costo = :costo, tipo_plan = :tipo_plan, fecha_pago = NOW() 
                WHERE id_pago = :id_pago;";
        $modificar = $this->con->prepare($sql);
        $modificar->bindParam(':id_pago', $id, PDO::PARAM_INT);
        $modificar->bindParam(':id_cliente', $data['id_cliente'], PDO::PARAM_INT);
        $modificar->bindParam(':costo', $data['costo'], PDO::PARAM_STR);
        $modificar->bindParam(':tipo_plan', $data['tipo_plan'], PDO::PARAM_STR);
        $modificar->execute();
        return $modificar->rowCount();
    }
    function delete($id) {
        $this->conexion();
        $sql = "DELETE FROM pagos WHERE id_pago = :id_pago;";
        $borrar = $this->con->prepare($sql);
        $borrar->bindParam(':id_pago', $id, PDO::PARAM_INT);
        $borrar->execute();
        return $borrar->rowCount();
    }
    function readOne($id) {
        $this->conexion();
        $query = "SELECT * FROM pagos WHERE id_pago = :id_pago;";
        $sql = $this->con->prepare($query);
        $sql->bindParam(':id_pago', $id, PDO::PARAM_INT);
        $sql->execute();
        return $sql->fetch(PDO::FETCH_ASSOC);
    }
    function readAll() {
        $this->conexion();
        $query = "SELECT pa.*, CONCAT(c.nombre, ' ', c.apellido) AS cliente_completo, pa.tipo_plan, pa.costo
                  FROM pagos pa
                  INNER JOIN clientes c ON pa.id_cliente = c.id_cliente;";
        $sql = $this->con->prepare($query);
        $sql->execute();
        return $sql->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
