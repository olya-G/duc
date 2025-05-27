<?php
error_reporting(E_ALL); // Включаем отчет об ошибках
ini_set('display_errors', 1); // Включаем отображение ошибок

include 'config.php'; // Подключаем файл конфигурации

// Получаем email из POST-запроса
$email = isset($_POST['email']) ? $_POST['email'] : '';

// Подготавливаем и выполняем запрос
if ($email) {
    $stmt = $conn->prepare("SELECT email FROM users WHERE email LIKE ?");
    $searchEmail = "%" . $conn->real_escape_string($email) . "%";
    $stmt->bind_param("s", $searchEmail);
    $stmt->execute();
    $result = $stmt->get_result();

    // Формируем массив с результатами
    $users = [];
    while ($row = $result->fetch_assoc()) {
        $users[] = $row['email'];
    }

    // Возвращаем результаты в формате JSON
    echo json_encode($users);

    $stmt->close();
}

$conn->close();
?>




