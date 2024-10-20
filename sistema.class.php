<?php
session_start();
include('config.class.php');

class Sistema
{
    var $con;

    function conexion()
    {
        $this->con = new PDO(SGBD . ':host=' . DBHOST . ';dbname=' . DBNAME . ';port=' . DBPORT, DBUSER, DBPASS);
    }

    function alert($tipo, $mensaje)
    {
        include('views/alert.php');
    }

    function getRol($correo)
    {
        $this->conexion();
        $roles = [];
        if (filter_var($correo, FILTER_VALIDATE_EMAIL)) {
            $sql = "SELECT r.rol
                    FROM usuario u
                    JOIN usuario_rol ur ON u.id_usuario = ur.id_usuario
                    JOIN rol r ON ur.id_rol = r.id_rol
                    WHERE u.correo = :correo";
            $stmt = $this->con->prepare($sql);
            $stmt->bindParam(':correo', $correo, PDO::PARAM_STR);
            $stmt->execute();
            $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ($data as $rol) {
                $roles[] = $rol['rol'];
            }
        }
        return $roles;
    }

    function getPrivilegio($correo)
    {
        $this->conexion();
        $privilegios = [];
        if (filter_var($correo, FILTER_VALIDATE_EMAIL)) {
            $sql = "SELECT p.permiso
                    FROM usuario u
                    JOIN usuario_rol ur ON u.id_usuario = ur.id_usuario
                    JOIN rol r ON ur.id_rol = r.id_rol
                    JOIN rol_permiso rp ON r.id_rol = rp.id_rol
                    JOIN permiso p ON rp.id_permiso = p.id_permiso
                    WHERE u.correo = :correo";
            $stmt = $this->con->prepare($sql);
            $stmt->bindParam(':correo', $correo, PDO::PARAM_STR);
            $stmt->execute();
            $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ($data as $permiso) {
                $privilegios[] = $permiso['permiso'];
            }
        }
        return $privilegios;
    }

    function login($correo, $contrasena)
    {
        $contrasena = md5($contrasena); // Hashing de contraseña
        $acceso = false;
        if (filter_var($correo, FILTER_VALIDATE_EMAIL)) {
            $this->conexion();
            $sql = "SELECT * FROM usuario WHERE correo = :correo AND contrasena = :contrasena";
            $stmt = $this->con->prepare($sql);
            $stmt->bindParam(':correo', $correo, PDO::PARAM_STR);
            $stmt->bindParam(':contrasena', $contrasena, PDO::PARAM_STR);
            $stmt->execute();
            $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);

            if (!empty($resultado)) {
                $acceso = true;
                $_SESSION['correo'] = $correo;
                $_SESSION['validado'] = $acceso;
                $_SESSION['roles'] = $this->getRol($correo);
                $_SESSION['privilegios'] = $this->getPrivilegio($correo);
                return $acceso;
            }
        }
        $_SESSION['validado'] = false;
        return $acceso;
    }

    function logout()
    {
        session_unset();
        session_destroy();
        header("Location: login.php");
        exit();
    }

    function checkRol($rol)
    {
        if (isset($_SESSION['roles']) && in_array($rol, $_SESSION['roles'])) {
            return true;
        } else {
            $this->deniedAccess("ERROR: usted no tiene el rol adecuado.");
        }
    }

    function checkPrivilege($permiso)
    {
        if (isset($_SESSION['privilegios']) && in_array($permiso, $_SESSION['privilegios'])) {
            return true;
        } else {
            $this->deniedAccess("ERROR: usted no tiene el permiso adecuado.");
        }
    }

    private function deniedAccess($mensaje)
    {
        $tipo = "danger";
        require_once('views/header.php');
        $this->alert($tipo, $mensaje);
        require_once('views/footer.php');
        die();
    }
}
