<?php
session_start();
include 'config.php'; // Подключение к базе данных


if ($conn->query($sql) === TRUE) {
    echo "Запись добавлена успешно";
} else {
    echo "Ошибка: " . $sql . "<br>" . $conn->error;
}


// Проверяем, была ли отправлена форма
if ($_SERVER["REQUEST_METHOD"] == "POST") {
       // Получаем данные из формы и экранируем их
       $situation = htmlspecialchars(trim($_POST['situation']));
       $region = htmlspecialchars(trim($_POST['region']));
       $category = htmlspecialchars(trim($_POST['category']));
       $display_public = isset($_POST['display_public']) ? 1 : 0; // 1, если отмечено, иначе 0
   
       // Проверка на наличие пустых полей
       if (!empty($situation) && !empty($region) && !empty($category)) {
           // Подключаемся к базе данных
           $conn = new mysqli($servername, $username, $password, $dbname);
           
           // Проверяем подключение
           if ($conn->connect_error) {
               die("Ошибка подключения: " . $conn->connect_error);
           }
   
           // SQL-запрос для вставки данных
           $stmt = $conn->prepare("INSERT INTO user_submissions (situation, region, category, display_public) VALUES (?, ?, ?, ?)");
           $stmt->bind_param("sssi", $situation, $region, $category, $display_public);
   
           // Выполняем запрос и проверяем результат
           if ($stmt->execute()) {
               $_SESSION['user_submissions'] = "Сообщение успешно отправлено!";
           } else {
               $_SESSION['user_submissions'] = "Ошибка при отправке сообщения: " . $stmt->error;
           }
   
           // Закрываем соединение
           $stmt->close();
           $conn->close();
       } else {
           $_SESSION['user_submissions'] = "Пожалуйста, заполните все поля!";
       }
   
       // Перенаправляем обратно на страницу с формой
       header("Location: index.php"); // Замените на нужный вам файл
       exit();
   }
   ?>
   
