<?php

class user{

    // Login de usuario
    public static function loginUsuario($email, $password){
        try {
            $conn = dbconexion::conectar();
            $query = "SELECT * FROM user WHERE email = ?";
            $stmt = $conn->prepare($query);
            $stmt->execute([$email]);
            if($stmt->rowCount() > 0){
                $row = $stmt->fetch();
                if(password_verify($password, $row['password'])){
                    session_start();
                    $_SESSION['id'] = $row['id'];
                    $_SESSION['nombre'] = $row['nombre'];
                    $_SESSION['email'] = $row['email'];
                    return json_encode(['success' => true, 'message' => 'Usuario logueado correctamente']);
                } else {
                    return json_encode(['success' => false, 'message' => 'Contraseña incorrecta']);
                }
            } else {
                return json_encode(['success' => false, 'message' => 'Usuario no encontrado']);
            }
        } catch (PDOException $e) {
            return json_encode(['success' => false, 'message' => 'Error en login: ' . $e->getMessage()]);
        }
    }

    // Registro de usuario
    public static function registerUsuario($nombre, $apellido, $email, $usuario, $password){
        try {
            $conn = dbconexion::conectar();
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            $query = "INSERT INTO user (nombre, apellido, email, usuario, password) VALUES (?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($query);
            $stmt->execute([$nombre, $apellido, $email, $usuario, $hashedPassword]);
            if($stmt->rowCount() > 0){
                return json_encode(['success' => true, 'message' => 'Usuario registrado correctamente']);
            } else {
                return json_encode(['success' => false, 'message' => 'Error al registrar el usuario']);
            }
        } catch (PDOException $e) {
            if($e->getCode() == 23000){ // Duplicate entry
                return json_encode(['success' => false, 'message' => 'El email o usuario ya existe']);
            }
            return json_encode(['success' => false, 'message' => 'Error al registrar usuario: ' . $e->getMessage()]);
        }
    }
}
?>
