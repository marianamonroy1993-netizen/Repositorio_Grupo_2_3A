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
        $method = $_SERVER['REQUEST_METHOD'];

        if($method == 'GET')
        {
            if(isset($_GET['mostar_actividades_getmethod'])){
               header('Content-Type: application/json');
               echo endpoint::mostrarActividades();
            } 
            else if(isset($_GET['obtener_actividad_getmethod'])){
                header('Content-Type: application/json');
                echo endpoint::obtenerActividad($_GET['id']);
            }
            else if(isset($_GET['descargar_actividad_getmethod'])){
                $id = $_GET['id'] ?? null;
                $result = consultas::descargarActividad($id);

                if(is_array($result) && isset($result['content'])){
                    $filename = $result['filename'] ?? 'actividad_' . $id . '.pdf';
                    $content = $result['content'];

                    // Enviar PDF
                    header('Content-Type: application/pdf');
                    header('Content-Disposition: attachment; filename="'.basename($filename).'"');
                    header('Content-Length: '.strlen($content));
                    echo $content;
                    exit;
                } elseif(is_string($result) && file_exists($result)){
                    $filename = basename($result);
                    header('Content-Type: application/pdf');
                    header('Content-Disposition: attachment; filename="'.$filename.'"');
                    header('Content-Length: '.filesize($result));
                    readfile($result);
                    exit;
                } else {
                    header('Content-Type: application/json');
                    echo json_encode(['error' => 'Archivo no encontrado']);
                }
            }
            else {
                header('Content-Type: application/json');
                echo json_encode(['error' => 'Parámetro no válido']);
            }
        } else if($method == 'POST')
        {
            if(isset($_POST['crear_actividad_postmethod'])){
                header('Content-Type: application/json');
                echo consultas::crearActividad($_POST['actividad'], $_POST['descripcion'], $_POST['estado']);
            } else {
                header('Content-Type: application/json');
                echo json_encode(['error' => 'Parámetro no válido']);
            }
        } 
        else if($method == 'DELETE')
        {
            parse_str(file_get_contents("php://input"), $deleteVars);
            if(isset($deleteVars['eliminar_actividad_postmethod'])){
                header('Content-Type: application/json');
                echo consultas::eliminarActividad($deleteVars['id']);
            } else {
                header('Content-Type: application/json');
                echo json_encode(['error' => 'Parámetro no válido']);
            }
        }
        else {
            header('Content-Type: application/json');
            echo json_encode(['error' => 'Método no permitido']);
        } 
    }
}

endpoint::EndpointController();


?>