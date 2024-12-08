
<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

header('Content-Type: application/json');
require_once '../../config/conexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $codMovimiento = isset($_POST['codMovimiento']) ? intval($_POST['codMovimiento']) : 0;

    if ($codMovimiento > 0) {
        try {
            $sql = "DELETE FROM movimientos WHERE codMovimiento = :codMovimiento";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':codMovimiento', $codMovimiento, PDO::PARAM_INT);
            $stmt->execute();

            echo json_encode([
                "code" => 200,
                "message" => "Movimiento eliminado exitosamente."
            ]);
        } catch (Exception $e) {
            echo json_encode([
                "code" => 500,
                "message" => "Error al eliminar el movimiento.",
                "info" => $e->getMessage()
            ]);
        }
    } else {
        echo json_encode([
            "code" => 400,
            "message" => "Código de movimiento no válido."
        ]);
    }
} else {
    echo json_encode([
        "code" => 405,
        "message" => "Método no permitido."
    ]);
}
try {
    header('Content-Type: application/json');
    // Código para eliminar el movimiento
} catch (Exception $e) {
    echo json_encode([
        "code" => 500,
        "message" => "Error interno del servidor.",
        "info" => $e->getMessage()
    ]);
}

?>
