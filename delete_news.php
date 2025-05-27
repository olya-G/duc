<?php
include 'config.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);
    
    if (isset($data['id'])) {
        $id = $data['id'];

        $stmt = $conn->prepare("DELETE FROM news WHERE id = ?");
        $stmt->bind_param("i", $id);

        if ($stmt->execute()) {
            $response = ['success' => true];
        } else {
            $response = ['success' => false, 'error' => $stmt->error]; // Добавляем информацию об ошибке
        }

        $stmt->close();
    } else {
        $response = ['success' => false, 'error' => 'ID не передан'];
    }

    echo json_encode($response);
    exit();
}
?>


