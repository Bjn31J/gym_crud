<?php
require_once('../sistema.class.php');

class Permiso extends Sistema
{
    /**
     * Obtiene todos los permisos.
     */
    function readAll()
    {
        $this->conexion();
        $sql = "SELECT * FROM permiso";
        $stmt = $this->con->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Obtiene un permiso específico.
     */
    function readOne($id)
    {
        $this->conexion();
        $sql = "SELECT * FROM permiso WHERE id_permiso = :id_permiso";
        $stmt = $this->con->prepare($sql);
        $stmt->bindParam(':id_permiso', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * Crea un nuevo permiso.
     */
    function create($data)
    {
        $this->conexion();
        $sql = "INSERT INTO permiso (permiso) VALUES (:permiso)";
        $stmt = $this->con->prepare($sql);
        $stmt->bindParam(':permiso', $data['permiso'], PDO::PARAM_STR);
        return $stmt->execute();
    }

    /**
     * Actualiza un permiso existente.
     */
    function update($id, $data)
    {
        $this->conexion();
        $sql = "UPDATE permiso SET permiso = :permiso WHERE id_permiso = :id_permiso";
        $stmt = $this->con->prepare($sql);
        $stmt->bindParam(':permiso', $data['permiso'], PDO::PARAM_STR);
        $stmt->bindParam(':id_permiso', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    /**
     * Elimina un permiso.
     */
    function delete($id)
    {
        $this->conexion();
        $sql = "DELETE FROM permiso WHERE id_permiso = :id_permiso";
        $stmt = $this->con->prepare($sql);
        $stmt->bindParam(':id_permiso', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }
}
?>
