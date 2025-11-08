<?php

class user{

    public static function loginUsuario($email, $password){
        $conn=dbconexion::conectar();
        $query="SELECT * FROM user WHERE email=?";
        $stmt=$conn->prepare($query);
        $stmt->bindParam(1, $email);
        $stmt->execute();
        if($stmt->rowCount() > 0){
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            if(password_verify($password, $row['password'])){
                session_start();
                $_SESSION['id'] = $row['id'];
                $_SESSION['nombre'] = $row['nombre'];
                $_SESSION['email'] = $row['email'];
                return json_encode(['success' => true, 'message' => 'Usuario logueado correctamente']);
            }else{
                return json_encode(['success' => false, 'message' => 'Contraseña incorrecta']);
            }
        }else{
            return json_encode(['success' => false, 'message' => 'Usuario no encontrado']);
        }

    }

    public static function registerUsuario($nombre, $apellido, $email, $usuario, $password){
        $conn=dbconexion::conectar();
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $query="INSERT INTO user (nombre, apellido, email, usuario, password) VALUES (?, ?, ?, ?, ?)";
        $stmt=$conn->prepare($query);
        $stmt->bindParam(1, $nombre);
        $stmt->bindParam(2, $apellido);
        $stmt->bindParam(3, $email);
        $stmt->bindParam(4, $usuario);
        $stmt->bindParam(5, $hashedPassword);
        if($stmt->execute()){
            return json_encode(['success' => true, 'message' => 'Usuario registrado correctamente']);
        }else{
            return json_encode(['success' => false, 'message' => 'Error al registrar el usuario']);
        }
    }
}


?>
