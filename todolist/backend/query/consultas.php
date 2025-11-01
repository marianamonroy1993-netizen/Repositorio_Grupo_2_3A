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
        try {
            $conn = dbconexion::conectar();
            $query = "DELETE FROM actividades WHERE id = ?";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(1, $id);
            $stmt->execute();
            
            // Verificar si se eliminó alguna fila
            if($stmt->rowCount() > 0) {
                return json_encode([
                    'success' => true, 
                    'message' => 'Actividad eliminada correctamente'
                ]);
            } else {
                return json_encode([
                    'success' => false, 
                    'message' => 'No se encontró la actividad para eliminar'
                ]);
            }
        } catch(PDOException $e) {
            return json_encode([
                'success' => false,
                'message' => 'Error al eliminar: ' . $e->getMessage()
            ]);
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
    
    //FUNCION DESCARGAR ACTIVIDAD EN PDF
    public static function descargarActividad($id){
        // Obtener actividad usando la función existente
        $actividadJson = self::obtenerActividad($id);
        $data = json_decode($actividadJson, true);

        if(!$data || !isset($data['success']) || $data['success'] !== true || !isset($data['actividad'])){
            return null;
        }

        $a = $data['actividad'];

        // Preparar líneas del documento
        $lines = [];
        $lines[] = "ID: " . ($a['id'] ?? '');
        $lines[] = "Actividad: " . ($a['actividad'] ?? '');
        $lines[] = "Descripción: " . ($a['descripcion'] ?? '');
        $lines[] = "Estado: " . ($a['estado'] ?? '');
        $lines[] = "Fecha de creación: " . ($a['fecha_de_creacion'] ?? '');
        $lines[] = "Fecha de actualización: " . ($a['fecha_de_actualizacion'] ?? '');

        // Escapar para literal strings en PDF
        $escape = function($s){
            return str_replace(["\\", "(", ")"], ["\\\\", "\\(", "\\)"], $s);
        };

        // Construir contenido simple para el stream del PDF
        $contentStream = "BT\n/F1 12 Tf\n14 TL\n50 780 Td\n";  // Added "14 TL" for leading
foreach($lines as $i => $ln){
    $ln = $escape($ln);
    if($i === 0){
        $contentStream .= "($ln) Tj\n";
    } else {
        $contentStream .= "T* ($ln) Tj\n";
    }
}
$contentStream .= "ET\n";


        // Objetos PDF básicos
        $obj1 = "1 0 obj\n<< /Type /Catalog /Pages 2 0 R >>\nendobj\n";
        $obj2 = "2 0 obj\n<< /Type /Pages /Kids [3 0 R] /Count 1 >>\nendobj\n";
        $obj4 = "4 0 obj\n<< /Type /Font /Subtype /Type1 /BaseFont /Helvetica /Encoding /WinAnsiEncoding >>\nendobj\n";
        $obj5 = "5 0 obj\n<< /Length " . strlen($contentStream) . " >>\nstream\n" . $contentStream . "\nendstream\nendobj\n";
        $obj3 = "3 0 obj\n<< /Type /Page /Parent 2 0 R /MediaBox [0 0 595 842] /Resources << /Font << /F1 4 0 R >> >> /Contents 5 0 R >>\nendobj\n";

        // Montar PDF
        $pdf = "%PDF-1.4\n";
        $offsets = [];

        $pieces = [$obj1, $obj2, $obj3, $obj4, $obj5];
        foreach($pieces as $p){
            $offsets[] = strlen($pdf);
            $pdf .= $p;
        }

        $xrefPos = strlen($pdf);
        $pdf .= "xref\n0 " . (count($offsets) + 1) . "\n";
        $pdf .= "0000000000 65535 f \n";
        foreach($offsets as $off){
            $pdf .= str_pad($off, 10, "0", STR_PAD_LEFT) . " 00000 n \n";
        }

        $pdf .= "trailer\n<< /Size " . (count($offsets) + 1) . " /Root 1 0 R >>\nstartxref\n$xrefPos\n%%EOF";

        $filename = 'actividad_' . ($a['id'] ?? $id) . '.pdf';

        return [
            'filename' => $filename,
            'content' => $pdf
        ];
    }
  }
?>
