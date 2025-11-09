<?php
// Asegurar que la respuesta sea JSON
header('Content-Type: application/json');

include '../dbconexion/dbconexion.php';
include '../query/consultas.php';
include '../query/user.php';

// Verificar autenticación para métodos que la requieren
function requireAuth() {
    session_start();
    if (!isset($_SESSION['id'])) {
        echo json_encode(['error' => 'Usuario no autenticado']);
        exit;
    }
}

class endpoint{
    public static function mostrarActividades(){
        requireAuth();
        return consultas::mostrarActividad();
    }

    public static function EndpointController(){
        if($_SERVER['REQUEST_METHOD'] == 'GET'){
            if(isset($_GET['mostrar_actividades_getmethod'])){
                echo endpoint::mostrarActividades();
            } elseif(isset($_GET['obtener_actividad_por_id'])){
                requireAuth();
                echo consultas::obtenerActividadPorId($_GET['id']);
            } else {
                echo json_encode(['error' => 'Parámetro GET no válido']);
            }
        } elseif($_SERVER['REQUEST_METHOD'] == 'POST'){
            if(isset($_POST['crear_actividad_postmethod'])){
                requireAuth();
                echo consultas::crearActividad($_POST['actividad'], $_POST['descripcion'], $_POST['estado'], $_POST['tipo']);
            } elseif(isset($_POST['editar_actividad_postmethod'])){
                requireAuth();
                echo consultas::editarActividad($_POST['id'], $_POST['actividad'], $_POST['descripcion'], $_POST['estado'], $_POST['tipo']);
            } elseif(isset($_POST['login_usuario_postmethod'])){
                echo user::loginUsuario($_POST['email'], $_POST['password']);
            } elseif(isset($_POST['registrar_usuario_postmethod'])){
                echo user::registerUsuario($_POST['nombre'], $_POST['apellido'], $_POST['email'], $_POST['usuario'], $_POST['password']);
            } else {
                echo json_encode(['error' => 'Parámetro POST no válido']);
            }
        } elseif($_SERVER['REQUEST_METHOD'] == 'DELETE'){
            // Para DELETE, los datos vienen en el cuerpo de la petición
            parse_str(file_get_contents("php://input"), $_DELETE);
            if(isset($_DELETE['eliminar_actividad_deletemethod'])){
                requireAuth();
                echo consultas::eliminarActividad($_DELETE['id']);
            } else {
                echo json_encode(['error' => 'Parámetro DELETE no válido']);
            }
        } else {
            echo json_encode(['error' => 'Método HTTP no permitido']);
        }
    }
}

endpoint::EndpointController();
?>
