<?php
require_once ('../sistema.class.php');
class Entrenador extends Sistema {
    function create($data) {
        $result = [];
        $this->conexion();
        $sql = "INSERT INTO entrenadores (nombre, apellido, especialidad, email, telefono) 
                VALUES (:nombre, :apellido, :especialidad, :email, :telefono);";
        $insertar = $this->con->prepare($sql);
        $insertar->bindParam(':nombre', $data['nombre'], PDO::PARAM_STR);
        $insertar->bindParam(':apellido', $data['apellido'], PDO::PARAM_STR);
        $insertar->bindParam(':especialidad', $data['especialidad'], PDO::PARAM_STR);
        $insertar->bindParam(':email', $data['email'], PDO::PARAM_STR);
        $insertar->bindParam(':telefono', $data['telefono'], PDO::PARAM_STR);
        $insertar->execute();
        $result = $insertar->rowCount();
        return $result;
    }
    function update($id, $data) {
        $this->conexion();
        $result = [];
        $sql = "UPDATE entrenadores SET nombre=:nombre, apellido=:apellido, especialidad=:especialidad, 
                email=:email, telefono=:telefono WHERE id_entrenador=:id_entrenador;";
        $modificar = $this->con->prepare($sql);
        $modificar->bindParam(':id_entrenador', $id, PDO::PARAM_INT);
        $modificar->bindParam(':nombre', $data['nombre'], PDO::PARAM_STR);
        $modificar->bindParam(':apellido', $data['apellido'], PDO::PARAM_STR);
        $modificar->bindParam(':especialidad', $data['especialidad'], PDO::PARAM_STR);
        $modificar->bindParam(':email', $data['email'], PDO::PARAM_STR);
        $modificar->bindParam(':telefono', $data['telefono'], PDO::PARAM_STR);
        $modificar->execute();
        $result = $modificar->rowCount();
        return $result;
    }
    function delete($id) {
        $result = [];
        $this->conexion();
        $sql = "DELETE FROM entrenadores WHERE id_entrenador = :id_entrenador;";
        $borrar = $this->con->prepare($sql);
        $borrar->bindParam(':id_entrenador', $id, PDO::PARAM_INT);
        $borrar->execute();
        $result = $borrar->rowCount();
        return $result;
    }
    function readOne($id) {
        $this->conexion();
        $result = [];
        $query = "SELECT * FROM entrenadores WHERE id_entrenador = :id_entrenador;";
        $sql = $this->con->prepare($query);
        $sql->bindParam(':id_entrenador', $id, PDO::PARAM_INT);
        $sql->execute();
        $result = $sql->fetch(PDO::FETCH_ASSOC);
        return $result;
    }
    function readAll() {
        $this->conexion();
        $result = [];
        $query = "SELECT * FROM entrenadores;";
        $sql = $this->con->prepare($query);
        $sql->execute();
        $result = $sql->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
}
?>

