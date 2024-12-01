<?php
require_once('../sistema.class.php');

class Cliente extends Sistema {
    function create($data) {
        $result = [];
        $this->conexion();
        $sql = "INSERT INTO clientes (nombre, apellido, email, telefono, fecha_registro) 
                VALUES (:nombre, :apellido, :email, :telefono, :fecha_registro);";
        $insertar = $this->con->prepare($sql);
        $insertar->bindParam(':nombre', $data['nombre'], PDO::PARAM_STR);
        $insertar->bindParam(':apellido', $data['apellido'], PDO::PARAM_STR);
        $insertar->bindParam(':email', $data['email'], PDO::PARAM_STR);
        $insertar->bindParam(':telefono', $data['telefono'], PDO::PARAM_STR);
        $insertar->bindParam(':fecha_registro', $data['fecha_registro'], PDO::PARAM_STR);
        $insertar->execute();
        $result = $insertar->rowCount();
        return $result;
    }

    function update($id, $data) {
        $this->conexion();
        $result = [];
        $sql = "UPDATE clientes SET nombre=:nombre, apellido=:apellido, email=:email, telefono=:telefono, 
                fecha_registro=:fecha_registro WHERE id_cliente=:id_cliente;";
        $modificar = $this->con->prepare($sql);
        $modificar->bindParam(':id_cliente', $id, PDO::PARAM_INT);
        $modificar->bindParam(':nombre', $data['nombre'], PDO::PARAM_STR);
        $modificar->bindParam(':apellido', $data['apellido'], PDO::PARAM_STR);
        $modificar->bindParam(':email', $data['email'], PDO::PARAM_STR);
        $modificar->bindParam(':telefono', $data['telefono'], PDO::PARAM_STR);
        $modificar->bindParam(':fecha_registro', $data['fecha_registro'], PDO::PARAM_STR);
        $modificar->execute();
        $result = $modificar->rowCount();
        return $result;
    }

    function delete($id) {
        $this->conexion();
        $this->con->beginTransaction(); // Iniciar la transacción
        try {
            // Eliminar registros relacionados en la tabla `planes_entrenamiento`
            $sqlPlanes = "DELETE FROM planes_entrenamiento WHERE id_pago IN (SELECT id_pago FROM pagos WHERE id_cliente = :id_cliente);";
            $borrarPlanes = $this->con->prepare($sqlPlanes);
            $borrarPlanes->bindParam(':id_cliente', $id, PDO::PARAM_INT);
            $borrarPlanes->execute();

            // Eliminar registros relacionados en la tabla `pagos`
            $sqlPagos = "DELETE FROM pagos WHERE id_cliente = :id_cliente;";
            $borrarPagos = $this->con->prepare($sqlPagos);
            $borrarPagos->bindParam(':id_cliente', $id, PDO::PARAM_INT);
            $borrarPagos->execute();

            // Eliminar el cliente
            $sqlCliente = "DELETE FROM clientes WHERE id_cliente = :id_cliente;";
            $borrarCliente = $this->con->prepare($sqlCliente);
            $borrarCliente->bindParam(':id_cliente', $id, PDO::PARAM_INT);
            $borrarCliente->execute();

            $this->con->commit(); // Confirmar la transacción
            return true;
        } catch (Exception $e) {
            $this->con->rollBack(); // Revertir la transacción en caso de error
            throw new Exception("Error al eliminar el cliente: " . $e->getMessage());
        }
    }

    function readOne($id) {
        $this->conexion();
        $result = [];
        $query = "SELECT * FROM clientes WHERE id_cliente = :id_cliente;";
        $sql = $this->con->prepare($query);
        $sql->bindParam(':id_cliente', $id, PDO::PARAM_INT);
        $sql->execute();
        $result = $sql->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    function readAll() {
        $this->conexion();
        $result = [];
        $query = "SELECT * FROM clientes;";
        $sql = $this->con->prepare($query);
        $sql->execute();
        $result = $sql->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
}
?>


