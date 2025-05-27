<?php
session_start();
include 'config.php';

// Проверка на наличие данных в POST-запросе
if (!isset($_POST['recipient_email'], $_POST['message'])) {
    http_response_code(400); // Неверный запрос
    echo json_encode(['message' => 'Недостаточно данных.']);
    exit;
}

$recipient_email = trim($_POST['recipient_email']); // Удаляем лишние пробелы
$message = trim($_POST['message']); // Удаляем лишние пробелы
$user_id = $_SESSION['user_id'] ?? null; // Получаем user_id отправителя из сессии

if (!$user_id) {
    http_response_code(403); // Доступ запрещен
    echo json_encode(['message' => 'Необходима авторизация.']);
    exit;
}

// Подготовка и выполнение запроса
$stmt = $conn->prepare("INSERT INTO messages (user_id, recipient_email, message, sent_at) VALUES (?, ?, ?, NOW())");
$stmt->bind_param("iss", $user_id, $recipient_email, $message); // Используем "iss" для указания типов данных

if ($stmt->execute()) {
    $response = ['message' => 'Сообщение успешно отправлено.'];
    http_response_code(200); // Успешный ответ
} else {
    $response = ['message' => 'Ошибка отправки сообщения.'];
    http_response_code(500); // Ошибка сервера
}



// Возвращаем результат в формате JSON
header('Content-Type: application/json');
echo json_encode($response);

$stmt->close();
$conn->close();
?>
