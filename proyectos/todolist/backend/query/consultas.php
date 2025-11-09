<?php

class consultas{

    // Mostrar actividades del usuario autenticado
    public static function mostrarActividad(){
        if(!isset($_SESSION['id'])){
            return json_encode(['error' => 'Usuario no autenticado']);
        }
        try {
            $conn = dbconexion::conectar();
            $query = "SELECT * FROM actividades WHERE user_id = ? ORDER BY fecha_de_creacion DESC";
            $stmt = $conn->prepare($query);
            $stmt->execute([$_SESSION['id']]);
            $actividades = $stmt->fetchAll();
            return json_encode($actividades);
        } catch (PDOException $e) {
            return json_encode(['error' => 'Error al obtener actividades: ' . $e->getMessage()]);
        }
    }

    // Crear nueva actividad
    public static function crearActividad($actividad, $descripcion, $estado, $tipo){
        if(!isset($_SESSION['id'])){
            return json_encode(['success' => false, 'message' => 'Usuario no autenticado']);
        }
        try {
            $conn = dbconexion::conectar();
            $query = "INSERT INTO actividades (user_id, actividad, descripcion, estado, tipo) VALUES (?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($query);
            $stmt->execute([$_SESSION['id'], $actividad, $descripcion, $estado, $tipo]);
            if($stmt->rowCount() > 0){
                return json_encode(['success' => true, 'message' => 'Actividad creada correctamente']);
            } else {
                return json_encode(['success' => false, 'message' => 'Error al crear la actividad']);
            }
        } catch (PDOException $e) {
            return json_encode(['success' => false, 'message' => 'Error al crear actividad: ' . $e->getMessage()]);
        }
    }

    // Eliminar actividad
    public static function eliminarActividad($id){
        if(!isset($_SESSION['id'])){
            return json_encode(['success' => false, 'message' => 'Usuario no autenticado']);
        }
        try {
            $conn = dbconexion::conectar();
            $query = "DELETE FROM actividades WHERE id = ? AND user_id = ?";
            $stmt = $conn->prepare($query);
            $stmt->execute([$id, $_SESSION['id']]);
            if($stmt->rowCount() > 0){
                return json_encode(['success' => true, 'message' => 'Actividad eliminada correctamente']);
            } else {
                return json_encode(['success' => false, 'message' => 'Error al eliminar la actividad o actividad no encontrada']);
            }
        } catch (PDOException $e) {
            return json_encode(['success' => false, 'message' => 'Error al eliminar actividad: ' . $e->getMessage()]);
        }
    }

    // Editar actividad
    public static function editarActividad($id, $actividad, $descripcion, $estado, $tipo){
        if(!isset($_SESSION['id'])){
            return json_encode(['success' => false, 'message' => 'Usuario no autenticado']);
        }
        try {
            $conn = dbconexion::conectar();
            $query = "UPDATE actividades SET actividad = ?, descripcion = ?, estado = ?, tipo = ? WHERE id = ? AND user_id = ?";
            $stmt = $conn->prepare($query);
            $stmt->execute([$actividad, $descripcion, $estado, $tipo, $id, $_SESSION['id']]);
            if($stmt->rowCount() > 0){
                return json_encode(['success' => true, 'message' => 'Actividad actualizada correctamente']);
            } else {
                return json_encode(['success' => false, 'message' => 'No se realizaron cambios o actividad no encontrada']);
            }
        } catch (PDOException $e) {
            return json_encode(['success' => false, 'message' => 'Error al actualizar actividad: ' . $e->getMessage()]);
        }
    }

    // Obtener actividad por ID
    public static function obtenerActividadPorId($id){
        if(!isset($_SESSION['id'])){
            return json_encode(['success' => false, 'message' => 'Usuario no autenticado']);
        }
        try {
            $conn = dbconexion::conectar();
            $query = "SELECT * FROM actividades WHERE id = ? AND user_id = ?";
            $stmt = $conn->prepare($query);
            $stmt->execute([$id, $_SESSION['id']]);
            $actividad = $stmt->fetch();
            if($actividad){
                return json_encode(['success' => true, 'data' => $actividad]);
            } else {
                return json_encode(['success' => false, 'message' => 'Actividad no encontrada']);
            }
        } catch (PDOException $e) {
            return json_encode(['success' => false, 'message' => 'Error al obtener actividad: ' . $e->getMessage()]);
        }
    }
}
?>
