<?php 
include '../query/consultas.php';

// Asegurar que la respuesta sea JSON
header('Content-Type: application/json');

class endpoint{
    public static function mostrarActividades(){
    return consultas::mostrarActividad();
}

    public static function obtenerActividad($id){
    return consultas::obtenerActividad($id);
}

    public static function EndpointController(){
        if($_SERVER['REQUEST_METHOD'] == 'GET')

        {
            if(isset($_GET['mostrar_actividades_getmethod'])){
    echo endpoint::mostrarActividades();
            }

            else if(isset($_GET['obtener_actividad_getmethod'])){
                echo endpoint::obtenerActividad($_GET['id']);
            }
            else {
                echo json_encode(['error' => 'Parámetro no válido']);
            }
        } else if($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            if(isset($_POST['crear_actividad_postmethod'])){
                consultas::crearActividad($_POST['actividad'], $_POST['descripcion'], $_POST['estado']);

            } else {
                echo json_encode(['error' => 'Parámetro no válido']);
            }
        } 
        else if($_SERVER['REQUEST_METHOD'] == 'DELETE')

        {
            if(isset($_GET['eliminar_actividad_deletemethod'])){
                echo consultas::eliminarActividad($_GET['id']);
            } else {
                echo json_encode(['error' => 'Parámetro no válido']);
            }
        }
        else if($_SERVER['REQUEST_METHOD'] == 'PUT')

        {
            parse_str(file_get_contents("php://input"), $_PUT);
            if(isset($_PUT['editar_actividad_putmethod'])){
                echo consultas::editarActividad($_PUT['id'], $_PUT['actividad'], $_PUT['descripcion'], $_PUT['estado']);
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