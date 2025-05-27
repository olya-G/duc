<?php
session_start();
include 'config.php';

// Проверяем, авторизован ли пользователь
$user_id = $_SESSION["user_id"] ?? null;

// Функция для получения данных пользователя
function getUserData($conn, $user_id) {
    if (!$user_id) {
        return false;
    }
    
    $sql = "SELECT name, email FROM users WHERE user_id = ?";
    $stmt = $conn->prepare($sql);

    if (!$stmt) {
        error_log("Ошибка подготовки запроса: " . $conn->error);
        return false;
    }

    $stmt->bind_param("i", $user_id);

    if ($stmt->execute()) {
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }
    
    error_log("Ошибка выполнения запроса: " . $stmt->error);
    return false;
}

// Получаем данные пользователя
$userData = getUserData($conn, $user_id);

if ($userData) {
    $username = htmlspecialchars($userData["name"]);
    $email = htmlspecialchars($userData["email"]);
} else {
    $username = "Пользователь не найден";
    $email = "Пользователь не найден";
}

// Обработка обновления данных пользователя
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['newUsername'], $_POST['newEmail'], $_POST['user_id'])) {
    $new_username = $_POST['newUsername'];
    $new_email = $_POST['newEmail'];
    $user_id = $_POST['user_id'];

    $update_sql = "UPDATE users SET name = ?, email = ? WHERE user_id = ?";
    $update_stmt = $conn->prepare($update_sql);

    if (!$update_stmt) {
        error_log("Ошибка подготовки запроса: " . $conn->error);
        echo json_encode(['status' => 'error', 'message' => 'Ошибка при подготовке запроса.']);
        exit;
    }

    $update_stmt->bind_param("ssi", $new_username, $new_email, $user_id);

    if ($update_stmt->execute()) {
        echo json_encode(['status' => 'success']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Не удалось обновить данные.']);
        error_log("Ошибка выполнения запроса: " . $update_stmt->error);
    }
    exit;
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Личный кабинет</title>
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


        h1, h2 {
            text-align: center;
            color:rgb(0, 0, 0); /* Яркий черный цвет */
            font-size: 28px;
            margin-bottom: 20px;
            position: relative;
            z-index: 1; /* Над фоном */
        }

        .user-info, .messages-section, .search-users {
            margin-bottom: 20px;
            padding: 15px;
            border: 1px solid rgb(157, 204, 255);
            border-radius: 8px;
            background-color: #f9f9f9;
        }

        button {
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            background-color 0.3s;
            margin-top: 10px;
        }

        button[type="submit"] {
            background-color: #28a745; /* Зеленый цвет для кнопки "Сохранить" */
            color: white;
        }

        button[type="button"] {
            background-color: #dc3545; /* Красный цвет для кнопки "Отмена" */
            color: white;
        }

        button:hover {
            opacity: 0.9; /* Эффект при наведении на кнопки */
        }

        .modal {
            display: none; /* Скрыто по умолчанию */
            position: fixed; /* Окно фиксируется на экране */
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%; /* Полная ширина */
            height: 100%; /* Полная высота */
            overflow: auto; /* Прокрутка при необходимости */
            background-color: rgba(0, 0, 0, 0.5); /* Полупрозрачный фон */
        }

        .modal-content {
            background-color: #fefefe;
            margin: 15% auto; /* Центрирование окна */
            padding: 20px;
            border: 1px solid #888;
            width: 80%; /* Ширина окна */
            max-width: 500px; /* Максимальная ширина */
            border-radius: 8px; /* Закругленные углы */
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.3); /* Тень */
        }

        .close-button {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
            cursor: pointer; /* Указатель на курсор */
        }

        .close-button:hover,
        .close-button:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }

        input[type="text"], input[type="email"], textarea {
            width: 100%;
            padding:5px;
            margin: 5px 0 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        textarea {
            height: 100px; /* Высота текстового поля для сообщений */
        }
    </style>
</head>
<body>
<div class="container">
    <h1>Личный кабинет</h1>
    <div class="user-info">
        <h2>Ваши данные</h2>
        <p><strong>Имя:</strong> <span id="name"><?php echo htmlspecialchars($username); ?></span></p>
        <p><strong>Email:</strong> <span id="email"><?php echo htmlspecialchars($email); ?></span></p>
        <button id="editButton">Изменить данные</button>

        <div id="editModal" class="modal">
            <div class="modal-content">
                <span class="close-button" id="closeModal">&times;</span>
                <h2>Редактирование данных</h2>
                <form id="updateForm" method="POST">
                    <label for="newUsername">Имя:</label>
                    <input type="text" id="newUsername" name="newUsername" value="<?php echo $username; ?>" required>
                    <label for="newEmail">Email:</label>
                    <input type="email" id="newEmail" name="newEmail" value="<?php echo $email; ?>" required>
                    <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
                    <button type="submit">Сохранить изменения</button>
                    <button type="button" id="cancelButton">Отмена</button>
                </form>
            </div>
        </div>
        <button id="loadMessagesButton" onclick="location.href='messages.php'">Сообщения</button>
        <button id="deleteProfileButton">Удалить профиль</button>
        <button id="logoutButton">Выйти</button>

        <script>

document.getElementById("logoutButton").onclick = function() {
    if (confirm("Вы уверены, что хотите выйти?")) {
        // Отправляем запрос на выход
        window.location.href = 'logout.php'; // Убедитесь, что этот файл существует
    }
};



    // Обработка удаления профиля
    document.getElementById("deleteProfileButton").onclick = function() {
        if (confirm("Вы уверены, что хотите удалить свой профиль? Это действие необратимо.")) {
            // Отправляем запрос на удаление профиля
            fetch('delete_profile.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({ user_id: '<?php echo $user_id; ?>' }) // Отправляем ID пользователя
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === 'success') {
                    alert('Профиль успешно удален.');
                    // Перенаправляем пользователя на главную страницу или страницу входа
                    window.location.href = 'index.php'; // Замените на нужный URL
                } else {
                    alert('Ошибка: ' + (data.message || 'Не удалось удалить профиль.'));
                }
            })
            .catch(error => {
                console.error('Ошибка:', error);
                alert('Произошла ошибка при удалении профиля.');
            });
        }
    };
</script>

    </div>

    <div class="search-users">
        <h2>Поиск пользователей</h2>
        <form id="searchForm">
            <input type="text" id="searchInput" name="searchQuery" placeholder="Введите email" required>
            <button type="submit" id="searchButton">Поиск</button>
            <button onclick="window.location.href='index.php'">На главную</button>
        </form>
        <div id="results"></div> <!-- Здесь будут отображаться результаты -->

        <!-- Модальное окно для отправки сообщения -->
        <div id="messageModal" class="modal" style="display:none;">
            <div class="modal-content">
                <span class="close-button" id="closeMessageModal">&times;</span>
                <h2>Отправить сообщение</h2>
                <form id="messageForm">
                    <label for="recipientEmail">Email получателя:</label>
                    <input type="email" id="recipientEmail" name="recipient_email" required readonly>
                    <label for="message">Сообщение:</label>
                    <textarea id="message" name="message" required></textarea>
                    <button type="submit">Отправить</button>
                </form>
            </div>
        </div>
    </div>

   
<script>
   const searchForm = document.getElementById('searchForm');
const searchInput = document.getElementById('searchInput');
const resultsDiv = document.getElementById('results');
const messageModal = document.getElementById('messageModal');
const closeMessageModal = document.getElementById('closeMessageModal');
const messageForm = document.getElementById('messageForm');
const recipientEmailInput = document.getElementById('recipientEmail');
const messageTextarea = document.getElementById('message');

// Функция для открытия модального окна
function openModal(email) {
    recipientEmailInput.value = email; // Заполняем email получателя
    messageTextarea.value = ''; // Очищаем поле сообщения
    messageModal.style.display = "block"; // Открываем модальное окно
}

// Функция для закрытия модального окна
function closeModal() {
    messageModal.style.display = "none"; // Закрываем модальное окно
}

// Закрытие модального окна по клику на крестик
closeMessageModal.addEventListener('click', closeModal);

// Закрытие модального окна по клику вне окна
window.addEventListener('click', function(event) {
    if (event.target === messageModal) {
        closeModal();
    }
});

// Обработка отправки формы поиска
searchForm.addEventListener('submit', async function(event) {
    event.preventDefault(); // Предотвращаем отправку формы

    const query = searchInput.value;

    try {
        const response = await fetch('search_users.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: new URLSearchParams({ email: query }),
        });

        if (!response.ok) {
            throw new Error('Ошибка сети');
        }

        const results = await response.json();
        displayResults(results);
    } catch (error) {
        console.error('Ошибка:', error);
        resultsDiv.textContent = 'Произошла ошибка при поиске.';
    }
});

// Функция для отображения результатов поиска
function displayResults(results) {
    resultsDiv.innerHTML = ''; // Очищаем предыдущие результаты

    if (results.length > 0) {
        results.forEach(email => {
            const div = document.createElement('div');
            div.classList.add('user-item');
            div.textContent = email;

            const messageButton = document.createElement('button');
            messageButton.textContent = 'Написать';
            messageButton.addEventListener('click', function() {
                openModal(email); // Открываем модальное окно с email пользователя
            });

            div.appendChild(messageButton);
            resultsDiv.appendChild(div);
        });
    } else {
        resultsDiv.textContent = 'Пользователи не найдены.';
    }
}

// Обработка отправки формы сообщения
messageForm.addEventListener('submit', async function(event) {
    event.preventDefault(); // Предотвращаем отправку формы

    const recipientEmail = recipientEmailInput.value.trim(); // Удаляем лишние пробелы
    const message = messageTextarea.value.trim(); // Удаляем лишние пробелы

    if (!recipientEmail || !message) { // Проверка на пустые поля
        alert('Пожалуйста, заполните все поля.');
        return;
    }

    try {
        const response = await fetch('send_message.php', {
    method: 'POST',
    headers: {
        'Content-Type': 'application/x-www-form-urlencoded',
    },
    body: new URLSearchParams({
        recipient_email: recipientEmail,
        message: message
    }),
});

if (!response.ok) {
    throw new Error('Ошибка отправки сообщения');
}

const result = await response.json();
alert(result.message); // Показываем сообщение об успехе или ошибке

        closeModal(); // Закрываем модальное окно после отправки
    } catch (error) {
        console.error('Ошибка:', error);
        alert('Сообщение отпрвалено!');
    }
});

</script>


<script>
    // Обработка открытия и закрытия модального окна
    document.getElementById("editButton").onclick = function() {
        document.getElementById("editModal").style.display = "block";
    };

    document.getElementById("closeModal").onclick = function() {
        document.getElementById("editModal").style.display = "none";
    };

    document.getElementById("cancelButton").onclick = function() {
        document.getElementById("editModal").style.display = "none";
    };

    window.onclick = function(event) {
        if (event.target == document.getElementById("editModal")) {
            document.getElementById("editModal").style.display = "none";
        }
    };

    // Обработка отправки формы
    document.getElementById("updateForm").onsubmit = function(event) {
        event.preventDefault(); // Предотвращаем стандартное поведение формы

        const formData = new FormData(this); // Собираем данные формы

        fetch('', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.status === 'success') {
                alert('Данные успешно обновлены!');
                document.getElementById("name").textContent = document.getElementById("newUsername").value;
                document.getElementById("email").textContent = document.getElementById("newEmail").value;
                document.getElementById("editModal").style.display = "none"; // Закрываем модальное окно
            } else {
                alert('Ошибка: ' + (data.message || 'Не удалось обновить данные.'));
            }
        })
        .catch(error => {
            console.error('Ошибка:', error);
            alert('Произошла ошибка при обновлении данных.');
        });
    };

</script>
</div>
</body>
</html>


