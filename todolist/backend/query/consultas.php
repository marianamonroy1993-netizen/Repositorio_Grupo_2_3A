<?php 
include '../dbconexion/dbconexion.php';
class consultas{

 //FUNCION MOSTRAR ACTIVIDADES
  public static function mostrarActividad(){
    $conn = dbconexion::conectar();
    $query = "SELECT * FROM actividades";
    $stmt = $conn->prepare($query);
    $stmt->execute();
    return json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));
}


    //FUNCION CREAR ACTIVIDAD
    public static function crearActividad($actividad, $descripcion, $estado){
      $conn=dbconexion::conectar();
      $fecha_creacion = date('Y-m-d H:i:s');
      $fecha_actualizacion = date('Y-m-d H:i:s');
      
      $query="INSERT INTO actividades (actividad, descripcion, estado, fecha_de_creacion, fecha_de_actualizacion) VALUES (?, ?, ?, ?, ?)";
      $stmt=$conn->prepare($query);
      $stmt->bindParam(1, $actividad);
      $stmt->bindParam(2, $descripcion);
      $stmt->bindParam(3, $estado);
      $stmt->bindParam(4, $fecha_creacion);
      $stmt->bindParam(5, $fecha_actualizacion);
      
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

    //FUNCION EDITAR ACTIVIDAD
    public static function editarActividad($id, $actividad, $descripcion, $estado){
      $conn=dbconexion::conectar();
      $query="UPDATE actividades SET actividad=?, descripcion=?, estado=? WHERE id=?";
      $stmt=$conn->prepare($query);
      $stmt->bindParam(1, $actividad);
      $stmt->bindParam(2, $descripcion);
      $stmt->bindParam(3, $estado);
      $stmt->bindParam(4, $id);
      $stmt->execute();
      if($stmt->rowCount() > 0){
        return json_encode(['success' => true, 'message' => 'Actividad actualizada correctamente']);
      }else{
        return json_encode(['success' => false, 'message' => 'No se pudo actualizar la actividad']);
      }
    }

    //FUNCION OBTENER ACTIVIDAD POR ID
    public static function obtenerActividad($id){
      $conn=dbconexion::conectar();
      $query="SELECT * FROM actividades WHERE id=?";
      $stmt=$conn->prepare($query);
      $stmt->bindParam(1, $id);
      $stmt->execute();
      $actividad = $stmt->fetch(PDO::FETCH_ASSOC);
      if($actividad){
        return json_encode(['success' => true, 'actividad' => $actividad]);
      }else{
        return json_encode(['success' => false, 'message' => 'Actividad no encontrada']);
      }
    }
}

?>