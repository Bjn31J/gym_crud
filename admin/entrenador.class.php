<?php
require_once('../sistema.class.php');
class Entrenador extends Sistema {
    function create($data) {
        $result = [];
        $this->conexion();
        $sql = "INSERT INTO entrenadores (nombre, apellido, especialidad, email, telefono, fotografia) 
                VALUES (:nombre, :apellido, :especialidad, :email, :telefono, :fotografia);";
        $insertar = $this->con->prepare($sql);
        $fotografia = $this->uploadFoto();
        $insertar->bindParam(':nombre', $data['nombre'], PDO::PARAM_STR);
        $insertar->bindParam(':apellido', $data['apellido'], PDO::PARAM_STR);
        $insertar->bindParam(':especialidad', $data['especialidad'], PDO::PARAM_STR);
        $insertar->bindParam(':email', $data['email'], PDO::PARAM_STR);
        $insertar->bindParam(':telefono', $data['telefono'], PDO::PARAM_STR);
        $insertar->bindParam(':fotografia', $fotografia, PDO::PARAM_STR);
        $insertar->execute();
        return $insertar->rowCount();
    }
    function update($id, $data) {
        $this->conexion();
        $result = [];
        $tmp = "";
        // Verificar si se subió una nueva fotografía
        if ($_FILES['fotografia']['error'] != 4) {
            $fotografia = $this->uploadFoto(); // Subir la foto
            $tmp = "fotografia=:fotografia,"; // Añadir al SQL la parte de la foto
        }
        // Construir el SQL dinámico
        $sql = "UPDATE entrenadores SET 
                    nombre=:nombre, 
                    apellido=:apellido, 
                    especialidad=:especialidad, 
                    email=:email, 
                    telefono=:telefono, 
                    $tmp
                    id_entrenador=:id_entrenador
                WHERE id_entrenador=:id_entrenador;";
    
        // Preparar la consulta
        $modificar = $this->con->prepare($sql);
        // Asociar los valores básicos
        $modificar->bindParam(':nombre', $data['nombre'], PDO::PARAM_STR);
        $modificar->bindParam(':apellido', $data['apellido'], PDO::PARAM_STR);
        $modificar->bindParam(':especialidad', $data['especialidad'], PDO::PARAM_STR);
        $modificar->bindParam(':email', $data['email'], PDO::PARAM_STR);
        $modificar->bindParam(':telefono', $data['telefono'], PDO::PARAM_STR);
        // Asociar el valor de la fotografía solo si existe
        if ($_FILES['fotografia']['error'] != 4) {
            $modificar->bindParam(':fotografia', $fotografia, PDO::PARAM_STR);
        }
        // Asociar el ID del entrenador
        $modificar->bindParam(':id_entrenador', $id, PDO::PARAM_INT);
        // Ejecutar la consulta
        $modificar->execute();
        // Devolver el número de filas afectadas
        $result = $modificar->rowCount();
        return $result;
    }
    function delete($id) {
        $this->conexion();
        $sql = "DELETE FROM entrenadores WHERE id_entrenador = :id_entrenador;";
        $borrar = $this->con->prepare($sql);
        $borrar->bindParam(':id_entrenador', $id, PDO::PARAM_INT);
        $borrar->execute();
        return $borrar->rowCount();
    }

    function readOne($id) {
        $this->conexion();
        $sql = "SELECT * FROM entrenadores WHERE id_entrenador = :id_entrenador;";
        $query = $this->con->prepare($sql);
        $query->bindParam(':id_entrenador', $id, PDO::PARAM_INT);
        $query->execute();
        return $query->fetch(PDO::FETCH_ASSOC);
    }

    function readAll() {
        $this->conexion();
        $sql = "SELECT * FROM entrenadores;";
        $query = $this->con->prepare($sql);
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    function uploadFoto(){
        $tipos = array("image/jpeg","image/png","image/gif");
        $data = $_FILES['fotografia'];
        $default = "default.png";
        if($data['error'] == 0){
            if($data['size'] <= 1048576){
                if(in_array($data['type'],$tipos)){
                    $n = rand(1,1000000);
                    $nombre = explode('.',$data['name']);
                    $imagen = md5($n.$nombre[0]).".".$nombre[sizeof($nombre)-1];
                    $origen = $data['tmp_name'];
                    $destino = "C:\\xampp\\htdocs\\fitnessplus\\uploads\\".$imagen;
                    if(move_uploaded_file($origen,$destino)){
                        return $imagen;
                    }return $default;
                }
            }
        }
    }
}
?>


