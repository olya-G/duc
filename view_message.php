<?php
include 'config.php';

session_start(); // Не забудьте запустить сессию

// Получаем user_id из сессии
$user_id = $_SESSION['user_id']; // Предполагается, что user_id хранится в сессии

// Получаем ID сообщения из URL
$message_id = $_GET['id'];

// Запрос для получения текста сообщения
$sql = "
    SELECT m.*, u.name AS sender_name 
    FROM messages m 
    JOIN users u ON m.user_id = u.user_id 
    WHERE m.id = ? AND m.recipient_email = (SELECT email FROM users WHERE user_id = ?)
";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ii", $message_id, $user_id); // Используем "ii" для указания типа данных (integer)

$stmt->execute();
$result = $stmt->get_result();
$message = $result->fetch_assoc();

$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Чтение сообщения</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet"> <!-- Подключаем шрифт Roboto -->
    <style>
        body {
            font-family: 'Roboto', sans-serif; /* Используем Roboto для современного вида */
            background: linear-gradient(to right, #f0f4f8, #e9ecef); /* Градиент фона */
            margin: 0;
            padding: 20px;
        }
        .container {
            max-width: 600px;
            margin: auto;
            background: #ffffff;
            padding: 30px;
            border-radius: 15px;
            position: relative; /* Для псевдоэлементов */
            overflow: hidden; /* Скрыть переполнение */
        }
        .container::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgb(255, 255, 255); /* Полупрозрачный синий фон */
            border-radius: 15px;
            z-index: 0; /* Позади содержимого */
        }
        h1 {
            font-size: 24px;
            color:rgb(0, 0, 0); /* Темный цвет заголовка */
            margin-bottom: 20px;
            position: relative;
            z-index: 1; /* Над фоном */
        }


        .message-item {

            border-radius: 10px;
            padding: 15px;
            margin: 10px 0;
            position: relative;
            transition: transform 0.3s; /* Плавный переход */
        }


        .message-content {
            max-height: 400px; /* Максимальная высота блока с сообщением */
            overflow-y: auto; /* Прокрутка по вертикали */
            word-wrap: break-word; /* Перенос слов, если они длинные */
            font-size: 19px;
            line-height: 1.7;
            color:rgb(0, 0, 0);
            padding: 20px; /* Отступы внутри блока */
    
            border-radius: 10px; /* Закругленные углы */
            background:rgb(228, 224, 255); /* Светло-голубой фон */
            margin-bottom: 20px; /* Отступ снизу */
            position: relative;
            z-index: 1; /* Над фоном */
        }
        button {
            position: relative;
            background-color: #007bff; /* Цвет фона */
            color: white; /* Цвет текста */
            border: none; /* Без границы */
            padding: 10px 20px; /* Отступы */
            border-radius: 5px; /* Закругленные углы */
            cursor: pointer; /* Указатель при наведении */
            font-size: 16px; /* Размер шрифта */
            transition: background-color 0.3s; /* Плавный переход цвета */
            margin-top: 20px;
        }

        button:hover {
            background-color:rgb(3, 82, 167); /* Цвет фона при наведении */
        }
        footer {
            text-align: center;
            margin-top: 20px;
            font-size: 14px;
            color: #6c757d; /* Серый цвет для текста внизу */
        }
        .footer-link {
            color: #007bff; /* Синий цвет для ссылки внизу */
            text-decoration: none;
        }
        .footer-link:hover {
            text-decoration: underline; /* Подчеркивание при наведении */
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Сообщение от: <?php echo htmlspecialchars($message['sender_name']); ?></h1>
        <div class="message-content">
            <p><?php echo nl2br(htmlspecialchars($message['message'])); ?></p>
        </div>
        <button onclick="window.location.href='messages.php'">На главную</button> <!-- Кнопка для возврата на главную -->
    </div>
    <footer>
    </footer>
</body>
</html>

