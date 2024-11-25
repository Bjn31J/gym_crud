<?php
session_start();
include('config.class.php');
class Sistema
{
    var $con;
    function conexion()
    {
        try {
            $this->con = new PDO(SGBD . ':host=' . DBHOST . ';dbname=' . DBNAME . ';port=' . DBPORT, DBUSER, DBPASS);
            $this->con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Error de conexión: " . $e->getMessage());
        }
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
        $this->conexion();
        $contrasena = md5($contrasena); // Asegúrate de que el hash coincida con tu BD
        $acceso = false;
    
        if (filter_var($correo, FILTER_VALIDATE_EMAIL)) {
            $sql = "SELECT * FROM usuario WHERE correo = :correo AND contrasena = :contrasena";
            $stmt = $this->con->prepare($sql);
            $stmt->bindParam(':correo', $correo, PDO::PARAM_STR);
            $stmt->bindParam(':contrasena', $contrasena, PDO::PARAM_STR);
            $stmt->execute();
            $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
    
            if ($resultado) {
                $acceso = true;
                $_SESSION['correo'] = $correo;
                $_SESSION['validado'] = $acceso;
                $_SESSION['roles'] = $this->getRol($correo); // Cargar roles en la sesión
                $_SESSION['privilegios'] = $this->getPrivilegio($correo); // Cargar permisos
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
    function checkRol(...$rol)
{
    if (isset($_SESSION['roles'])) {
        // Verificar si el usuario tiene al menos uno de los roles permitidos
        foreach ($_SESSION['roles'] as $rolUsuario) {
            if (in_array($rolUsuario, $rol)) {
                return $rolUsuario; // Retorna el rol del usuario si está permitido
            }
        }
    }
    // Si no tiene ninguno de los roles permitidos, denegar acceso
    $this->deniedAccess("ERROR: No tienes el rol adecuado para acceder a esta sección.");
}

    function checkPrivilege($permiso)
    {
        if (isset($_SESSION['privilegios']) && in_array($permiso, $_SESSION['privilegios'])) {
            return true;
        } else {
            $this->deniedAccess("ERROR: No tienes el permiso adecuado para acceder a esta sección.");
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
    function getCurrentRol()
    {
        return $_SESSION['roles'][0] ?? 'Invitado';
    }
}

