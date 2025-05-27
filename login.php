<?php
session_start();
ob_start(); // Начинаем буферизацию вывода
include 'config.php'; // Подключаем файл конфигурации

// Инициализируем переменные для сообщений об ошибках
$email_err = $password_err = "";
$email = ""; // Инициализируем переменную email

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Проверяем email
    if (empty(trim($_POST["email"]))) {
        $email_err = "Пожалуйста, введите email.";
    } else {
        $email = trim($_POST["email"]);
    }

    // Проверяем пароль
    if (empty(trim($_POST["password"]))) {
        $password_err = "Пожалуйста, введите пароль.";
    } else {
        $password = trim($_POST["password"]);
    }

    // Если ошибок нет, пытаемся авторизовать пользователя
    if (empty($email_err) && empty($password_err)) {
        // Готовим SQL-запрос
        $sql = "SELECT user_id, name, email, password, role FROM users WHERE email = ?";
        $stmt = $conn->prepare($sql);

        if ($stmt === false) {
            die("Ошибка подготовки запроса: " . htmlspecialchars($conn->error));
        }

        $stmt->bind_param("s", $email);

        if ($stmt->execute()) {
            $result = $stmt->get_result();

            if ($result->num_rows === 1) {
                // Получаем данные пользователя
                $row = $result->fetch_assoc();
                $id = $row["user_id"];
                $name = $row["name"];
                $hashed_password = $row["password"];
                $role = $row["role"]; // Получаем роль пользователя

                // Проверяем пароль
                if (password_verify($password, $hashed_password)) {
                    // Пароль верен, начинаем сессию
                    $_SESSION["loggedin"] = true;
                    $_SESSION["user_id"] = $id;
                    $_SESSION["name"] = $name;
                    $_SESSION["email"] = $email;
                    $_SESSION["role"] = $role; // Сохраняем роль пользователя

                    // Перенаправляем на главную страницу или профиль
                    header("Location: profil.php");
                    exit;
                } else {
                    // Неверный пароль
                    $password_err = "Неверный email или пароль.";
                }
            } else {
                // Пользователь не найден
                $email_err = "Неверный email или пароль.";
            }
        } else {
            die("Ошибка выполнения запроса: " . htmlspecialchars($stmt->error));
        }

        $stmt->close();
    }
}

$conn->close();
ob_end_flush(); // Отправляем накопленный вывод
?>




<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Вход</title>
    <link rel="stylesheet" href="css/style.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 400px;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            text-align: center;
            color: #333;
        }
        .form-group {
            margin-bottom: 15px;
        }
        label {
            display: block;
            margin-bottom: 5px;
            color: #555;
        }
        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            font-size: 16px;
        }
        input[type="email"].is-invalid,
        input[type="password"].is-invalid {
            border-color: #e74c3c; /* Красный цвет для ошибок */
        }
        .invalid-feedback {
            color: #e74c3c;
            font-size: 14px;
        }
        .btn {
            background-color: #007bff;
            color: white;
            border: none;
            padding: 10px 15px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            width: 100%;
            transition: background-color 0.3s;
        }
        .btn:hover {
            background-color: #0056b3; /* Темнее при наведении */
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Вход</h1>

        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" class="form-control <?php echo (!empty($email_err)) ? 'is-invalid' : ''; ?>" value="<?php echo htmlspecialchars($email); ?>">
                <span class="invalid-feedback"><?php echo htmlspecialchars($email_err); ?></span>
            </div>

            <div class="form-group">
                <label for="password">Пароль:</label>
                <input type="password" id="password" name="password" class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>">
                <span class="invalid-feedback"><?php echo htmlspecialchars($password_err); ?></span>
            </div>

            <button type="submit" class="btn">Войти</button>
        </form>

        <p style="text-align: center; margin-top: 20px;">
            Нет аккаунта? <a href="registr.php">Зарегистрируйтесь</a>
        </p>
    </div>
</body>
</html>

