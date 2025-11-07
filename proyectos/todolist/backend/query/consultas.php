<?php 

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
    public static function crearActividad($actividad, $descripcion, $estado, $categoria){
      $conn=dbconexion::conectar();
      $query="INSERT INTO actividades (actividad, descripcion, estado, tipo) VALUES (?, ?, ?, ?)";
      $stmt=$conn->prepare($query);
      $stmt->bindParam(1, $actividad);
      $stmt->bindParam(2, $descripcion);
      $stmt->bindParam(3, $estado);
      $stmt->bindParam(4, $categoria);
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
      if($stmt->rowCount() > 0){
        return json_encode(['success' => true, 'message' => 'Actividad eliminada correctamente']);
      }else{
        return json_encode(['success' => false, 'message' => 'Error al eliminar la actividad']);
      }
    }

    //FUNCION EDITAR ACTIVIDAD
    public static function editarActividad($id, $actividad, $descripcion, $estado, $categoria){
      $conn=dbconexion::conectar();
      $query="UPDATE actividades SET actividad=?, descripcion=?, estado=?, tipo=? WHERE id=?";
      $stmt=$conn->prepare($query);
      $stmt->bindParam(1, $actividad);
      $stmt->bindParam(2, $descripcion);
      $stmt->bindParam(3, $estado);
      $stmt->bindParam(4, $categoria);
      $stmt->bindParam(5, $id);
      $stmt->execute();
      if($stmt->rowCount() > 0){
        return json_encode(['success' => true, 'message' => 'Actividad actualizada correctamente']);
      }else{
        return json_encode(['success' => false, 'message' => 'No se realizaron cambios']);
      }
    }

    //FUNCION OBTENER ACTIVIDAD POR ID
    public static function obtenerActividadPorId($id){
      $conn=dbconexion::conectar();
      $query="SELECT * FROM actividades WHERE id=?";
      $stmt=$conn->prepare($query);
      $stmt->bindParam(1, $id);
      $stmt->execute();
      $actividad = $stmt->fetch(PDO::FETCH_ASSOC);
      if($actividad){
        return json_encode(['success' => true, 'data' => $actividad]);
      }else{
        return json_encode(['success' => false, 'message' => 'Actividad no encontrada']);
      }
    }
     }

?>