<?php
session_start();
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Творческое Объединение "Рисование"</title>
    <style>
header {
    position: fixed; /* Делает элемент фиксированным */
    top: 0; /* Располагает элемент в верхней части страницы */
    left: 0; /* Располагает элемент слева */
    width: 100%; /* Задает ширину на всю ширину экрана */
    z-index: 1000; /* Обеспечивает, что элемент будет поверх других */
    padding: 10px; /* Отступы для удобства */
}

button {
    padding: 10px 20px; /* Отступы для кнопки */
    font-size: 16px; /* Размер шрифта */
    cursor: pointer; /* Указатель при наведении */
    background-color: #007bff; /* Цвет фона кнопки */
    color: white; /* Цвет текста кнопки */
    border: none; /* Убираем рамку */
    border-radius: 5px; /* Скругление углов */
    transition: background-color 0.3s, transform 0.2s; /* Плавные переходы */
}

button:hover {
    background-color: #0056b3; /* Цвет фона при наведении */
    transform: scale(1.05); /* Немного увеличиваем кнопку при наведении */
}

button:active {
    transform: scale(0.95); /* Уменьшаем кнопку при нажатии */
}

        body {
            font-family: 'Arial', sans-serif;
            margin: 20px;
            background-color: #f0f8ff; /* Светлый фон */
        }

        h1 {
            color: #4a4a4a;
            text-align: center;
            margin-bottom: 20px;
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.2);
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.2);
            transition: transform 0.3s;
        }

        .container:hover {
            transform: scale(1.02); /* Легкая анимация при наведении */
        }

        .section-title {
            color: #5a5a5a;
            border-bottom: 2px solid #007bff;
            padding-bottom: 5px;
            margin-bottom: 15px;
        }

        p {
            line-height: 1.6;
            color: #666;
        }

        img {
            max-width: 100%;
            height: auto;
            display: block;
            margin: 10px auto;
            border-radius: 5px;
            border: 2px solid #ddd; /* Обводка для изображений */
        }

        .contact-info {
            margin-top: 20px;
            text-align: center;
        }

        .contact-info a {
            color: #007bff;
            text-decoration: none;
            font-weight: bold;
        }

        .contact-info a:hover {
            text-decoration: underline;
        }

        .gallery {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-around;
        }

        .gallery img {
            width: 200px;
            height: 200px;
            object-fit: cover;
            margin: 10px;
            border-radius: 8px;
            transition: transform 0.3s;
        }

        .gallery img:hover {
            transform: scale(1.05); /* Увеличение изображения при наведении */
        }

        /* Кнопки */
        .button {
            display: inline-block;
            padding: 10px 20px;
            margin: 10px 0;
            background-color:rgb(128, 189, 255);
            color: white;
            border: none;
            border-radius: 5px;
            text-align: center;
            text-decoration: none;
            transition: background-color 0.3s;
        }

        .button:hover {
            background-color:rgb(174, 197, 220);
        }

        /* Стили для списка */
        ul {
            list-style-type: square;
            padding-left: 20px;
        }
    </style>
</head>


<header>
    <button onclick="window.location.href='life.php'">Обратно</button>
    </header>
<body>

    <div class="container">
        <h1>Творческое Объединение "Рисование"</h1>

        <section>
            <h2 class="section-title">О нас</h2>
            <p>
                Творческое объединение "Рисование" – это место, где каждый может научиться видеть мир глазами художника! Мы приглашаем всех, кто мечтает научиться рисовать, независимо от возраста и уровня подготовки.
            </p>
            <p>
                Наша цель – развить творческие способности, научить различным техникам рисования и помочь каждому участнику найти свой уникальный стиль. Мы верим, что рисовать может каждый!
            </p>
            <img src="img/ris1.jpg" alt="Фотография с занятий по рисованию"> <!-- Replace with your image path -->
        </section>

        <section>
            <h2 class="section-title">Что мы предлагаем</h2>
            <ul>
                <li>Обучение основам рисунка и живописи</li>
                <li>Знакомство с различными техниками: акварель, гуашь, масло, пастель</li>
                <li>Рисование с натуры (натюрморты, пейзажи, портреты)</li>
                <li>Изучение композиции и перспективы</li>
                <li>Участие в выставках и конкурсах</li>
            </ul>
        </section>

        <section>
            <h2 class="section-title">Галерея работ участников</h2>
            <div class="gallery">
                <img src="img/ris2.jpg" alt="Рисунок 1"> <!-- Replace with your image path -->
                <img src="img/ris3.jpg" alt="Рисунок 2"> <!-- Replace with your image path -->
                <img src="img/ris4.jpg" alt="Рисунок 3"> <!-- Replace with your image path -->
                <img src="img/ris5.jpg" alt="Рисунок 4"> <!-- Replace with your image path -->
            </div>
        </section>

        <section>
            <h2 class="section-title">Расписание занятий</h2>
            <p>
                Расписание занятий обновляется ежемесячно. Пожалуйста, следите за информацией на нашем сайте и в социальных сетях.
            </p>
        </section>

        <section>
            <h2 class="section-title">Как к нам записаться</h2>
            <p>Записаться на занятия очень просто! Вы можете:</p>
            <ol>
                <li>Позвонить нам по телефону: <a href="tel:+71234567890">8 (38582) 22-1-57</a></li>
                <li>Написать нам на электронную почту: <a href="mailto:reb_duc@mail.ru">reb_duc@mail.ru</a></li>
            </ol>
        </section>

        <div class="contact-info">
            <p>Следите за нами в социальных сетях:</p>
            <a href="https://t.me/s/reb_duc" class="button">Telegram</a>
            <a href="https://vk.com/rebduc" class="button">ВКонтакте</a>
        </div>
    </div>

</body>
</html>
