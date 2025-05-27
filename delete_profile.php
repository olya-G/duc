<?php
session_start();
include 'config.php';


// Проверяем, пришел ли запрос методом POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Получаем данные из запроса
    $data = json_decode(file_get_contents('php://input'), true);
    $user_id = $data['user_id'];

    // Выполняем запрос на удаление профиля
    $stmt = $conn->prepare("DELETE FROM users WHERE user_id = ?");
    $stmt->bind_param("i", $user_id);

    if ($stmt->execute()) {
        // Успешное удаление, очищаем сессию
        session_unset(); // Удаляем все переменные сессии
        session_destroy(); // Уничтожаем сессию

        echo json_encode(['status' => 'success']);
    } else {
        // Ошибка при удалении
        echo json_encode(['status' => 'error', 'message' => 'Не удалось удалить профиль.']);
    }

    $stmt->close();
    $conn->close();
}
?>


