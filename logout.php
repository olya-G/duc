<?php
session_start();
session_unset(); // Удаляем все переменные сессии
session_destroy(); // Уничтожаем сессию

// Перенаправляем на главную страницу или страницу входа
header("Location: index.php"); // Замените на нужный URL
exit();
?>