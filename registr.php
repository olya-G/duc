<?php
session_start();

include 'config.php';

// Инициализируем переменные для сообщений об ошибках
$name_err = $email_err = $password_err = "";
$success_message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Проверяем имя
    if (empty(trim($_POST["name"]))) {
        $name_err = "Пожалуйста, введите имя.";
    } else {
        $name = trim($_POST["name"]);
    }

    // Проверяем email
    if (empty(trim($_POST["email"]))) {
        $email_err = "Пожалуйста, введите email.";
    } elseif (!filter_var(trim($_POST["email"]), FILTER_VALIDATE_EMAIL)) {
        $email_err = "Неверный формат email.";
    } else {
        // Проверяем, существует ли email в базе данных
        $sql = "SELECT user_id FROM users WHERE email = ?";
        $stmt = $conn->prepare($sql);

        if ($stmt === false) {
            die("Ошибка подготовки запроса: " . $conn->error);
        }

        $stmt->bind_param("s", trim($_POST["email"]));

        if ($stmt->execute()) {
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                $email_err = "Этот email уже зарегистрирован.";
            } else {
                $email = trim($_POST["email"]);
            }
        } else {
            die("Ошибка выполнения запроса: " . $stmt->error);
        }

        $stmt->close();
    }

// Проверяем пароль
if (empty(trim($_POST["password"]))) {
    $password_err = "Пожалуйста, введите пароль.";
} elseif (strlen(trim($_POST["password"])) < 6) {
    $password_err = "Пароль должен содержать не менее 6 символов.";
} elseif (!preg_match('/[A-Z]/', trim($_POST["password"]))) {
    $password_err = "Пароль должен содержать хотя бы одну заглавную букву.";
} elseif (!preg_match('/[a-z]/', trim($_POST["password"]))) {
    $password_err = "Пароль должен содержать хотя бы одну строчную букву.";
} elseif (!preg_match('/[0-9]/', trim($_POST["password"]))) {
    $password_err = "Пароль должен содержать хотя бы одну цифру.";
} else {
    $password = trim($_POST["password"]);
}

    // Если ошибок нет, регистрируем пользователя
    if (empty($name_err) && empty($email_err) && empty($password_err)) {
        // Хэшируем пароль
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Готовим SQL-запрос
        $sql = "INSERT INTO users (name, email, password) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);

        if ($stmt === false) {
            die("Ошибка подготовки запроса: " . $conn->error);
        }

        $stmt->bind_param("sss", $name, $email, $hashed_password);

        if ($stmt->execute()) {
            // Успешная регистрация
            $success_message = "Регистрация прошла успешно! Теперь вы можете <a href='login.php'>войти</a>.";
        } else {
            echo "Ошибка при регистрации: " . $stmt->error;
        }

        $stmt->close();
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Регистрация</title>
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
        input[type="text"],
        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
           
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            font-size: 16px;
        }
        input[type="text"].is-invalid,
        input[type="email"].is-invalid,
        input[type="password"].is-invalid {
            border-color: #e74c3c; /* Красный цвет для ошибок */
        }
        .invalid-feedback {
            color: #e74c3c;
            font-size: 14px;
        }
        .success-message {
            background-color: #d4edda;
            color: #155724;
            padding: 10px;
            border: 1px solid #c3e6cb;
            border-radius: 4px;
            margin-bottom: 15px;
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
        p {
            text-align: center;
            color: #555;
        }
        a {
            color: #007bff;
            text-decoration: none;
        }
        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Регистрация</h1>

        <?php if (!empty($success_message)): ?>
            <div class="success-message"><?php echo $success_message; ?></div>
        <?php endif; ?>

        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group">
                <label for="name">Имя:</label>
                <input type="text" id="name" name="name" class="form-control <?php echo (!empty($name_err)) ? 'is-invalid' : ''; ?>" value="<?php echo isset($name) ? $name : ''; ?>">
                <span class="invalid-feedback"><?php echo $name_err; ?></span>
            </div>

            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" class="form-control <?php echo (!empty($email_err)) ? 'is-invalid' : ''; ?>" value="<?php echo isset($email) ? $email : ''; ?>">
                <span class="invalid-feedback"><?php echo $email_err; ?></span>
            </div>

            <div class="form-group">
                <label for="password">Пароль:</label>
                <input type="password" id="password" name="password" class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>">
                <span class="invalid-feedback"><?php echo $password_err; ?></span>
            </div>

            <div class="form-group">
                <button type="submit" class="btn">Зарегистрироваться</button>
            </div>

            <p>Уже зарегистрированы? <a href="login.php">Войти</a>.</p>
        </form>
    </div>
</body>
</html>
