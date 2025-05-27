<?php
include 'config.php';

session_start(); // Не забудьте запустить сессию

// Получаем user_id из сессии
$user_id = $_SESSION['user_id']; // Предполагается, что user_id хранится в сессии

// Запрос для получения сообщений с именем отправителя
$sql = "
    SELECT m.*, u.name AS sender_name 
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

$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Сообщения</title>
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
            text-align: center;
            color:rgb(0, 0, 0); /* Яркий черный цвет */
            font-size: 32px;
            margin-bottom: 20px;
            position: relative;
            z-index: 1; /* Над фоном */
        }

        .message-item {
            background:rgb(228, 224, 255); /* Светло-голубой фон */
            border-radius: 10px;
            padding: 15px;
            margin: 10px 0;
            position: relative;
            transition: transform 0.3s; /* Плавный переход */
        }

        .message-item:hover {
            transform: scale(1.05); /* Увеличение при наведении */
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
        }

        .message-item strong {
            color:rgb(0, 0, 0); /* Цвет имени отправителя */
            font-size: 18px;
        }

        a {
            display: inline-block;
            margin-top: 10px;
            padding: 10px 15px;
            background-color:rgb(43, 20, 255); /* Ярко-розовый цвет */
            color: white;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        a:hover {
            background-color:rgba(0, 0, 255, 0.53); /* Темно-розовый цвет при наведении */
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
    </style>
</head>
<body>
    <div class="container">
        <h1>Ваши сообщения</h1>
        <?php foreach ($messages as $message): ?>
            <div class="message-item">
                <strong><?php echo htmlspecialchars($message['sender_name']); ?></strong>
                <a href="view_message.php?id=<?php echo $message['id']; ?>">Прочитать сообщение</a>
            </div>
            <?php endforeach; ?>
        <button onclick="window.location.href='profil.php'">В профиль</button> <!-- Кнопка для возврата на главную -->
    </div>
</body>
</html>
