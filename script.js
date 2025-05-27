document.addEventListener("DOMContentLoaded", function() {
    const editButton = document.getElementById("editButton");
    const editModal = new bootstrap.Modal(document.getElementById("editModal"));

    // Открытие модального окна
    editButton.onclick = function() {
        editModal.show();
    }

    // Обработка отправки формы с помощью AJAX
    document.getElementById("updateForm").onsubmit = function(event) {
        event.preventDefault(); // Предотвращаем стандартное поведение формы

        const formData = new FormData(this); // Получаем данные формы

        fetch('update_profile.php', { // Укажите путь к вашему PHP-скрипту
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.status === 'success') {
                alert('Данные успешно обновлены!');
                editModal.hide(); // Закрываем модальное окно
            } else {
                alert('Ошибка: ' + data.message);
            }
        })
        .catch(error => console.error('Ошибка:', error));
    }
});


document.getElementById("deleteProfileButton").onclick = function() {
    if (confirm("Вы уверены, что хотите удалить свой профиль? Это действие необратимо.")) {
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
                window.location.href = 'index.php'; // Перенаправление на главную страницу или страницу входа
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

const express = require('express');
const mongoose = require('mongoose');
const bodyParser = require('body-parser');
const cors = require('cors');

const app = express();
const PORT = 3000;

// Middleware
app.use(cors());
app.use(bodyParser.json());

// Подключение к базе данных MongoDB
mongoose.connect('mongodb://localhost:27017/userdb', { useNewUrlParser: true, useUnifiedTopology: true });

// Определение схемы пользователя
const userSchema = new mongoose.Schema({
    email: String,
});

const User = mongoose.model('User ', userSchema);

// API для поиска пользователей по email
app.post('/search', async (req, res) => {
    const { email } = req.body;

    try {
        const users = await User.find({ email: { $regex: email, $options: 'i' } }); // Регистронезависимый поиск
        res.json(users);
    } catch (error) {
        res.status(500).send('Ошибка при поиске пользователей');
    }
});

// Запуск сервера
app.listen(PORT, () => {
    console.log(`Сервер запущен на http://localhost:${PORT}`);
});

function displayResults(results) {
    const resultsDiv = document.getElementById('results');
    resultsDiv.innerHTML = ''; // Очищаем предыдущие результаты

    if (results.length > 0) {
        results.forEach(user => {
            const div = document.createElement('div');
            div.textContent = user.email; // Предполагаем, что user.email содержит email пользователя

            // Кнопка для отправки сообщения
            const messageButton = document.createElement('button');
            messageButton.textContent = 'Написать сообщение';
            messageButton.onclick = function() {
                document.getElementById('recipientEmail').value = user.email; // Устанавливаем email получателя
                document.getElementById('messageModal').style.display = 'block'; // Открываем модальное окно
            };

            div.appendChild(messageButton);
            resultsDiv.appendChild(div);
        });
    } else {
        resultsDiv.textContent = 'Пользователи не найдены.';
    }
}


// Обработка закрытия модального окна для сообщения
document.getElementById("closeMessageModal").onclick = function() {
    document.getElementById("messageModal").style.display = "none";
};

window.onclick = function(event) {
    if (event.target == document.getElementById("messageModal")) {
        document.getElementById("messageModal").style.display = "none";
    }
};

// Обработка отправки формы сообщения
document.getElementById("messageForm").onsubmit = function(event) {
    event.preventDefault(); // Предотвращаем стандартное поведение формы

    const formData = new FormData(this); // Собираем данные формы

    fetch('send_message.php', { // Убедитесь, что у вас есть обработчик для отправки сообщений
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.status === 'success') {
            alert('Сообщение успешно отправлено!');
            document.getElementById('messageModal').style.display = 'none'; // Закрываем модальное окно
            document.getElementById('messageForm').reset(); // Сбрасываем форму
        } else {
            alert('Ошибка: ' + (data.message || 'Не удалось отправить сообщение.'));
        }
    })
    .catch(error => {
        console.error('Ошибка:', error);
        alert('Произошла ошибка при отправке сообщения.');
    });
};

