<?php
session_start();
include 'config.php'; // Подключение к базе данных

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = $_POST['user_id'];
    $new_username = $_POST['name'];
    $new_email = $_POST['email'];

    // Проверяем, что пользователь существует
    $stmt = $pdo->prepare("SELECT user_id FROM users WHERE user_id = ?");
    $stmt->execute([$user_id]);
    if ($stmt->rowCount() === 0) {
        echo json_encode(['status' => 'error', 'message' => 'Пользователь не найден.']);
        exit;
    }

    // Обновляем данные пользователя
    $stmt = $pdo->prepare("UPDATE users SET name = ?, email = ? WHERE user_id = ?");
    if ($stmt->execute([$new_username, $new_email, $user_id])) {
        echo json_encode(['status' => 'success']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Не удалось обновить данные.']);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Неверный метод запроса.']);
}



try {
    $pdo = new PDO('mysql:host=localhost;dbname=d', 'name', 'password');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo json_encode(['status' => 'error', 'message' => 'Ошибка подключения к базе данных: ' . $e->getMessage()]);
    exit;
}
?>
