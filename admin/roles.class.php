<?php
require_once('../sistema.class.php');

class Roles extends Sistema
{
    function create($data)
    {
        $this->conexion();
        $sql = "INSERT INTO rol (rol) VALUES (:rol)";
        $stmt = $this->con->prepare($sql);
        $stmt->bindParam(':rol', $data['rol'], PDO::PARAM_STR);
        return $stmt->execute();
    }
    function readAll()
    {
        $this->conexion();
        $sql = "SELECT * FROM rol";
        $stmt = $this->con->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    function readOne($id)
    {
        $this->conexion();
        $sql = "SELECT * FROM rol WHERE id_rol = :id_rol";
        $stmt = $this->con->prepare($sql);
        $stmt->bindParam(':id_rol', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    function update($id, $data)
    {
        $this->conexion();
        $sql = "UPDATE rol SET rol = :rol WHERE id_rol = :id_rol";
        $stmt = $this->con->prepare($sql);
        $stmt->bindParam(':id_rol', $id, PDO::PARAM_INT);
        $stmt->bindParam(':rol', $data['rol'], PDO::PARAM_STR);
        return $stmt->execute();
    }
    function delete($id)
    {
        $this->conexion();
        $sql = "DELETE FROM rol WHERE id_rol = :id_rol";
        $stmt = $this->con->prepare($sql);
        $stmt->bindParam(':id_rol', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }
}
