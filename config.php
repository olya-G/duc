<?php
session_start();

$servername = "localhost";  // Обычно "localhost"
$username = "root"; // Имя пользователя базы данных
$password = "root"; // Пароль базы данных
$dbname = "d"; // Имя базы данных

// Создаем соединение
$conn = new mysqli($servername, $username, $password, $dbname);

// Проверяем соединение
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Устанавливаем кодировку (важно для правильного отображения кириллицы)
$conn->set_charset("utf8");
?>

