<?php 

class user{
    
    public static function loginUsuario($email, $password){
        $conn=dbconexion::conectar();
        $query="SELECT * FROM user WHERE email=? AND password=?";
        $stmt=$conn->prepare($query);
        $stmt->bindParam(1, $email);
        $stmt->bindParam(2, $password);
        $stmt->execute();
        if($stmt->rowCount() > 0){
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            session_start();
            $_SESSION['id'] = $row['id'];
            $_SESSION['nombre'] = $row['nombre'];
            $_SESSION['email'] = $row['email'];
            if($_SESSION['id'] > 0){
                return json_encode(['success' => true, 'message' => 'Usuario logueado correctamente']);
            }else{
                return json_encode(['success' => false, 'message' => 'Error al iniciar sesión']);
            }
            
        }else{
            return json_encode(['success' => false, 'message' => 'Error al iniciar sesión']);
        }
     
    }
}


?>