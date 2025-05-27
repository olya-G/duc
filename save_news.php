<?php
session_start();
include 'config.php'; // Подключение к базе данных


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);
    
    if (isset($data['title']) && isset($data['content'])) {
        $title = $data['title'];
        $content = $data['content'];
        $id = isset($data['id']) ? $data['id'] : null;

        if ($id) {
            // Обновление существующей новости
            $stmt = $conn->prepare("UPDATE news SET title = ?, content = ? WHERE id = ?");
            $stmt->bind_param("ssi", $title, $content, $id);
        } else {
            // Добавление новой новости
            $stmt = $conn->prepare("INSERT INTO news (title, content) VALUES (?, ?)");
            $stmt->bind_param("ss", $title, $content);
        }

        if ($stmt->execute()) {
            $response = ['success' => true];
        } else {
            $response = ['success' => false];
        }

        $stmt->close();
    } else {
        $response = ['success' => false];
    }

    echo json_encode($response);
    exit();
}

?>
