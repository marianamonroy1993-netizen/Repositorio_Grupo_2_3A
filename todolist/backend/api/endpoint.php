<?php 
include '../query/consultas.php';

// Asegurar que la respuesta sea JSON
header('Content-Type: application/json');

class endpoint{
    public static function mostrarActividades(){
        return consultas::mostrarActividad();
    }

    public static function EndpointController(){
        if($_SERVER['REQUEST_METHOD'] == 'GET')
        {
            if(isset($_GET['mostar_actividades_getmethod'])){
               echo endpoint::mostrarActividades();
            } else {
                echo json_encode(['error' => 'Parámetro no válido']);
            }
        } else if($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            if(isset($_POST['crear_actividad_postmethod'])){
                echo consultas::crearActividad($_POST['actividad'], $_POST['descripcion'], $_POST['estado']);
            } else {
                echo json_encode(['error' => 'Parámetro no válido']);
            }
        } 
        else if($_SERVER['REQUEST_METHOD'] == 'DELETE')
        {
            if(isset($_DELETE['eliminar_actividad_deletemethod'])){
                echo consultas::eliminarActividad($_DELETE['id']);
            } else {
                echo json_encode(['error' => 'Parámetro no válido']);
            }
        }
        else {
            echo json_encode(['error' => 'Método no permitido']);
        } 
    }
}

endpoint::EndpointController();







?>