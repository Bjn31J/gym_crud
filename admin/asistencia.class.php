<?php
require_once('../sistema.class.php');
class Asistencia extends Sistema {
    function readAll() {
        $this->conexion();
        $query = "SELECT a.*, p.descripcion AS plan_descripcion, c.nombre AS cliente, e.nombre AS entrenador
                  FROM asistencias_entrenadores a
                  INNER JOIN planes_entrenamiento p ON a.id_plan = p.id_plan
                  INNER JOIN clientes c ON p.id_cliente = c.id_cliente
                  INNER JOIN entrenadores e ON p.id_entrenador = e.id_entrenador;";
        $sql = $this->con->prepare($query);
        $sql->execute();
        return $sql->fetchAll(PDO::FETCH_ASSOC);
    }
    function readOne($id_asistencia) {
        $this->conexion();
        $query = "SELECT * FROM asistencias_entrenadores WHERE id_asistencia = :id_asistencia";
        $sql = $this->con->prepare($query);
        $sql->bindParam(':id_asistencia', $id_asistencia, PDO::PARAM_INT);
        $sql->execute();
        return $sql->fetch(PDO::FETCH_ASSOC);
    }
    function create($data) {
        $this->conexion();
        $query = "INSERT INTO asistencias_entrenadores (id_plan, fecha_asistencia, asistio)
                  VALUES (:id_plan, :fecha_asistencia, :asistio)";
        $sql = $this->con->prepare($query);
        $sql->bindParam(':id_plan', $data['id_plan'], PDO::PARAM_INT);
        $sql->bindParam(':fecha_asistencia', $data['fecha_asistencia'], PDO::PARAM_STR);
        $sql->bindParam(':asistio', $data['asistio'], PDO::PARAM_STR);
        return $sql->execute();
    }
    function update($id_asistencia, $data) {
        $this->conexion();
        $query = "UPDATE asistencias_entrenadores 
                  SET id_plan = :id_plan, fecha_asistencia = :fecha_asistencia, asistio = :asistio 
                  WHERE id_asistencia = :id_asistencia";
        $sql = $this->con->prepare($query);
        $sql->bindParam(':id_asistencia', $id_asistencia, PDO::PARAM_INT);
        $sql->bindParam(':id_plan', $data['id_plan'], PDO::PARAM_INT);
        $sql->bindParam(':fecha_asistencia', $data['fecha_asistencia'], PDO::PARAM_STR);
        $sql->bindParam(':asistio', $data['asistio'], PDO::PARAM_STR);
        return $sql->execute();
    }
    function delete($id_asistencia) {
        $this->conexion();
        $query = "DELETE FROM asistencias_entrenadores WHERE id_asistencia = :id_asistencia";
        $sql = $this->con->prepare($query);
        $sql->bindParam(':id_asistencia', $id_asistencia, PDO::PARAM_INT);
        return $sql->execute();
    }
    function getPlanes() {
        $this->conexion();
        $query = "SELECT p.id_plan, pa.tipo_plan, CONCAT(e.nombre, ' ', e.apellido) AS entrenador_completo
                  FROM planes_entrenamiento p
                  INNER JOIN pagos pa ON p.id_pago = pa.id_pago
                  INNER JOIN entrenadores e ON p.id_entrenador = e.id_entrenador";
        $sql = $this->con->prepare($query);
        $sql->execute();
        return $sql->fetchAll(PDO::FETCH_ASSOC);
    }
    
}
?>
