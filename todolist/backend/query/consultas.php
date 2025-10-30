<?php 
include '../dbconexion/dbconexion.php';
class consultas{

 //FUNCION MOSTRAR ACTIVIDADES
    public static function mostrarActividad(){
      $conn=dbconexion::conectar();
      $query="SELECT * FROM actividades";
      $stmt=$conn->prepare($query);
      $stmt->execute();
       return json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));
    }

    //FUNCION CREAR ACTIVIDAD
    public static function crearActividad($actividad, $descripcion, $estado){
      $conn=dbconexion::conectar();
      $query="INSERT INTO actividades (actividad, descripcion, estado) VALUES (?, ?, ?)";
      $stmt=$conn->prepare($query);
      $stmt->bindParam(1, $actividad);
      $stmt->bindParam(2, $descripcion);
      $stmt->bindParam(3, $estado);
      $stmt->execute();
      if($stmt->rowCount() > 0){
        return json_encode(['success' => true, 'message' => 'Actividad creada correctamente']);
      }else{
        return json_encode(['success' => false, 'message' => 'Error al crear la actividad']);
      }

    }
    //FUNCION ELIMINAR ACTIVIDAD
    public static function eliminarActividad($id){
      $conn=dbconexion::conectar();
      $query="DELETE FROM actividades WHERE id=?";
      $stmt=$conn->prepare($query);
      $stmt->bindParam(1, $id);
      $stmt->execute();
      return json_encode(['success' => true, 'message' => 'Actividad eliminada correctamente']);
    }
     }

?>