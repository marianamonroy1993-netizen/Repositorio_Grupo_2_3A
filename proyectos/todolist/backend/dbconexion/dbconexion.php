<?php
class dbconexion{
    public static function conectar(){
        try{
            $host="localhost";
            $user="root";
            $password="";
            $database="dbactividades";
            $conn= new PDO("mysql:host=$host;dbname=$database", $user, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            return $conn;
        }catch(PDOException $e){
            echo json_encode(['error' => 'Error de conexión: ' . $e->getMessage()]);
            exit;
        }
    }
}
?>
