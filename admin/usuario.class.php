<?php
require_once('../sistema.class.php');
class Usuario extends Sistema {
    function create($data) {
        $this->conexion();
        $roles = $data['rol'];
        $userData = $data['data'];
        $this->con->beginTransaction();
        try {
            $sql = "INSERT INTO usuario (correo, contrasena) VALUES (:correo, :contrasena)";
            $stmt = $this->con->prepare($sql);
            $userData['contrasena'] = md5($userData['contrasena']); 
            $stmt->bindParam(':correo', $userData['correo'], PDO::PARAM_STR);
            $stmt->bindParam(':contrasena', $userData['contrasena'], PDO::PARAM_STR);
            $stmt->execute();
            $sql = "SELECT id_usuario FROM usuario WHERE correo = :correo";
            $query = $this->con->prepare($sql);
            $query->bindParam(':correo', $userData['correo'], PDO::PARAM_STR);
            $query->execute();
            $userId = $query->fetch(PDO::FETCH_ASSOC)['id_usuario'];
            if ($userId) {
                foreach ($roles as $roleId => $checked) {
                    $sql = "INSERT INTO usuario_rol (id_usuario, id_rol) VALUES (:id_usuario, :id_rol)";
                    $insertRole = $this->con->prepare($sql);
                    $insertRole->bindParam(':id_usuario', $userId, PDO::PARAM_INT);
                    $insertRole->bindParam(':id_rol', $roleId, PDO::PARAM_INT);
                    $insertRole->execute();
                }
                $this->enviarEmail($userData['correo']);
                $this->con->commit();
                return $stmt->rowCount();
            }
        } catch (Exception $e) {
            $this->con->rollback();
            return false;
        }
    }
    function update($id, $data) {
        $this->conexion();
        $roles = $data['rol'];
        $userData = $data['data'];
        $this->con->beginTransaction();
        try {
            $sql = "UPDATE usuario SET correo = :correo, contrasena = :contrasena WHERE id_usuario = :id_usuario";
            $stmt = $this->con->prepare($sql);
            $userData['contrasena'] = md5($userData['contrasena']);
            $stmt->bindParam(':id_usuario', $id, PDO::PARAM_INT);
            $stmt->bindParam(':correo', $userData['correo'], PDO::PARAM_STR);
            $stmt->bindParam(':contrasena', $userData['contrasena'], PDO::PARAM_STR);
            $stmt->execute();
            $sql = "DELETE FROM usuario_rol WHERE id_usuario = :id_usuario";
            $deleteRole = $this->con->prepare($sql);
            $deleteRole->bindParam(':id_usuario', $id, PDO::PARAM_INT);
            $deleteRole->execute();
            foreach ($roles as $roleId => $checked) {
                $sql = "INSERT INTO usuario_rol (id_usuario, id_rol) VALUES (:id_usuario, :id_rol)";
                $insertRole = $this->con->prepare($sql);
                $insertRole->bindParam(':id_usuario', $id, PDO::PARAM_INT);
                $insertRole->bindParam(':id_rol', $roleId, PDO::PARAM_INT);
                $insertRole->execute();
            }
            $this->con->commit();
            return $stmt->rowCount();
        } catch (Exception $e) {
            $this->con->rollback();
            return false;
        }
    }
    function delete($id)
    {
        $this->conexion();
        try {
            $this->con->beginTransaction();
            $sql = "DELETE FROM usuario_rol WHERE id_usuario = :id_usuario";
            $stmt = $this->con->prepare($sql);
            $stmt->bindParam(':id_usuario', $id, PDO::PARAM_INT);
            $stmt->execute();
            $sql = "DELETE FROM usuario WHERE id_usuario = :id_usuario";
            $stmt = $this->con->prepare($sql);
            $stmt->bindParam(':id_usuario', $id, PDO::PARAM_INT);
            $stmt->execute();
            $this->con->commit();
            return true;
        } catch (PDOException $e) {
            $this->con->rollBack();
            throw new Exception("Error al eliminar el usuario: " . $e->getMessage());
        }
    }
    function readOne($id)
    {
        $this->conexion();
        $sql = "SELECT * FROM usuario WHERE id_usuario = :id_usuario";
        $stmt = $this->con->prepare($sql);
        $stmt->bindParam(':id_usuario', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC); 
    }
    function readAll() {
        $this->conexion();
        $sql = "SELECT * FROM usuario";
        $stmt = $this->con->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    function readAllRoles($id) {
        $this->conexion();
        $sql = "SELECT r.id_rol FROM usuario u 
                JOIN usuario_rol ur ON u.id_usuario = ur.id_usuario 
                JOIN rol r ON ur.id_rol = r.id_rol 
                WHERE u.id_usuario = :id_usuario";
        $stmt = $this->con->prepare($sql);
        $stmt->bindParam(':id_usuario', $id, PDO::PARAM_INT);
        $stmt->execute();
        $roles = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return array_column($roles, 'id_rol');
    }
    private function enviarEmail($email) {
        $asunto = "¡Bienvenido a Fitness Plus!";
        $mensaje = "
            <h1>¡Hola, bienvenido a Fitness Plus!</h1>
            <p>Tu cuenta ha sido creada exitosamente. Ahora puedes acceder a nuestros servicios utilizando el correo electrónico registrado: <strong>{$email}</strong>.</p>
            <p>Si tienes alguna pregunta, no dudes en contactarnos.</p>
            <p>Atentamente,<br>Equipo de Fitness Plus</p>
        ";

        // Enviar el correo
        $this->sendmail($email, $asunto, $mensaje);
    }
}
?>
