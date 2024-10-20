<?php
require_once('../sistema.class.php');
class Plan_Entrenamiento extends Sistema
{
    function getClientes()
    {
        $this->conexion();
        $query = "SELECT id_cliente, CONCAT(nombre, ' ', apellido) AS nombre_completo FROM clientes;";
        $sql = $this->con->prepare($query);
        $sql->execute();
        return $sql->fetchAll(PDO::FETCH_ASSOC);
    }
    function getEntrenadores()
    {
        $this->conexion();
        $query = "SELECT id_entrenador, CONCAT(nombre, ' ', apellido) AS nombre_completo FROM entrenadores;";
        $sql = $this->con->prepare($query);
        $sql->execute();
        return $sql->fetchAll(PDO::FETCH_ASSOC);
    }
    function getUltimoPago($id_cliente)
    {
        $this->conexion();
        $query = "SELECT id_pago, tipo_plan, costo FROM pagos WHERE id_cliente = :id_cliente ORDER BY fecha_pago DESC LIMIT 1;";
        $sql = $this->con->prepare($query);
        $sql->bindParam(':id_cliente', $id_cliente, PDO::PARAM_INT);
        $sql->execute();
        return $sql->fetch(PDO::FETCH_ASSOC);
    }
    function create($data)
    {
        $this->conexion();
        $pago = $this->getUltimoPago($data['id_cliente']);
        if (!$pago) {
            return ['error' => 'El cliente no tiene un pago registrado'];
        }
        $sql = "INSERT INTO planes_entrenamiento (id_cliente, id_entrenador, descripcion, fecha_inicio, fecha_fin, id_pago, costo) 
                VALUES (:id_cliente, :id_entrenador, :descripcion, :fecha_inicio, :fecha_fin, :id_pago, :costo);";
        $insertar = $this->con->prepare($sql);
        $insertar->bindParam(':id_cliente', $data['id_cliente'], PDO::PARAM_INT);
        $insertar->bindParam(':id_entrenador', $data['id_entrenador'], PDO::PARAM_INT);
        $insertar->bindParam(':descripcion', $data['descripcion'], PDO::PARAM_STR);
        $insertar->bindParam(':fecha_inicio', $data['fecha_inicio'], PDO::PARAM_STR);
        $insertar->bindParam(':fecha_fin', $data['fecha_fin'], PDO::PARAM_STR);
        $insertar->bindParam(':id_pago', $pago['id_pago'], PDO::PARAM_INT);
        $insertar->bindParam(':costo', $pago['costo'], PDO::PARAM_INT);
        $insertar->execute();
        return $insertar->rowCount();
    }
    function update($id, $data)
    {
        $this->conexion();
        $sql = "UPDATE planes_entrenamiento 
                SET id_cliente=:id_cliente, id_entrenador=:id_entrenador, descripcion=:descripcion, 
                    fecha_inicio=:fecha_inicio, fecha_fin=:fecha_fin 
                WHERE id_plan=:id_plan;";
        $modificar = $this->con->prepare($sql);
        $modificar->bindParam(':id_plan', $id, PDO::PARAM_INT);
        $modificar->bindParam(':id_cliente', $data['id_cliente'], PDO::PARAM_INT);
        $modificar->bindParam(':id_entrenador', $data['id_entrenador'], PDO::PARAM_INT);
        $modificar->bindParam(':descripcion', $data['descripcion'], PDO::PARAM_STR);
        $modificar->bindParam(':fecha_inicio', $data['fecha_inicio'], PDO::PARAM_STR);
        $modificar->bindParam(':fecha_fin', $data['fecha_fin'], PDO::PARAM_STR);
        $modificar->execute();
        return $modificar->rowCount();
    }
    function delete($id)
    {
        $this->conexion();
        $sql = "DELETE FROM planes_entrenamiento WHERE id_plan = :id_plan;";
        $borrar = $this->con->prepare($sql);
        $borrar->bindParam(':id_plan', $id, PDO::PARAM_INT);
        $borrar->execute();
        return $borrar->rowCount();
    }
    function readOne($id)
    {
        $this->conexion();
        $query = "SELECT p.*, pa.tipo_plan
              FROM planes_entrenamiento p
              INNER JOIN pagos pa ON p.id_pago = pa.id_pago
              WHERE p.id_plan = :id_plan;";
        $sql = $this->con->prepare($query);
        $sql->bindParam(':id_plan', $id, PDO::PARAM_INT);
        $sql->execute();
        return $sql->fetch(PDO::FETCH_ASSOC) ?: false;
    }
    function readAll()
    {
        $this->conexion();
        $query = "SELECT p.*, c.nombre AS cliente, e.nombre AS entrenador, pa.tipo_plan, pa.costo
                  FROM planes_entrenamiento p
                  INNER JOIN clientes c ON p.id_cliente = c.id_cliente
                  INNER JOIN entrenadores e ON p.id_entrenador = e.id_entrenador
                  INNER JOIN pagos pa ON p.id_pago = pa.id_pago;";
        $sql = $this->con->prepare($query);
        $sql->execute();
        return $sql->fetchAll(PDO::FETCH_ASSOC);
    }
}
