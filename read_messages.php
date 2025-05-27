<?php
include 'config.php';

session_start(); // Не забудьте запустить сессию

// Получаем user_id из сессии
$user_id = $_SESSION['user_id']; // Предполагается, что user_id хранится в сессии

// Запрос для получения сообщений с именем отправителя
$sql = "
    SELECT m.*, u.name AS recipient_email
    FROM messages m 
    JOIN users u ON m.user_id = u.user_id 
    WHERE m.recipient_email = (SELECT email FROM users WHERE user_id = ?)
";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id); // Используем "i" для указания типа данных (integer)

$stmt->execute();
$result = $stmt->get_result();

$messages = [];
while ($row = $result->fetch_assoc()) {
    $messages[] = $row; // Добавляем каждое сообщение в массив
}

// Возвращаем результат в формате JSON
header('Content-Type: application/json');
echo json_encode($messages);

$stmt->close();
$conn->close();
?>
