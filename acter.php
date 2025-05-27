<?php
session_start();
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Творческое Объединение "Актерское Мастерство"</title>
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
            background-color: rgb(128, 189, 255);
            color: white;
            border: none;
            border-radius: 5px;
            text-align: center;
            text-decoration: none;
            transition: background-color 0.3s;
        }

        .button:hover {
            background-color: rgb(174, 197, 220);
        }

        /* Стили для списка */
        ul {
            list-style-type: square;
            padding-left: 20px;
        }

        .video-container {
            position: relative;
            padding-bottom: 56.25%; /* 16:9 aspect ratio */
            height: 0;
            overflow: hidden;
            margin: 20px 0;
        }

        .video-container iframe {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            border: none;
            border-radius: 10px;
        }

    </style>
</head>
<header>
<button onclick="window.location.href='life.php'">Обратно</button>
    </header>


<body>

    <div class="container">
        <h1>Творческое Объединение "Актерское Мастерство"</h1>

        <section>
            <h2 class="section-title">О нас</h2>
            <p>
                Творческое объединение "Актерское Мастерство" – это пространство для развития и реализации творческого потенциала в области театрального искусства! Мы объединяем начинающих и опытных актеров, режиссеров и всех, кто увлечен миром театра.
            </p>
            <p>
                Наша миссия – обучать актерскому мастерству, развивать сценическую речь, учить работать в команде и создавать яркие и запоминающиеся спектакли. Мы стремимся раскрыть талант каждого участника и помочь ему найти свой уникальный голос на сцене.
            </p>
            <img src="img/acter5.jpg" alt="Фотография с репетиции">
        </section>

        <section>
            <h2 class="section-title">Что мы делаем</h2>
            <ul>
                <li>Регулярные занятия по актерскому мастерству</li>
                <li>Тренировки по сценической речи и движению</li>
                <li>Участие в театральных фестивалях и конкурсах</li>
                <li>Мастер-классы от профессиональных актеров и режиссеров</li>
            </ul>
        </section>

        <section>
            <h2 class="section-title">Галерея выступлений и репетиций</h2>
            <div class="gallery">
                <img src="img/acter1.png" alt="Фото с выступления 1">
                <img src="img/acter2.jpg" alt="Фото с репетиции 1">
                <img src="img/acter3.jpg" alt="Фото с выступления 2">
                <img src="img/acter4.jpg" alt="Фото с репетиции 2">
            </div>
        </section>

        <section>
            <h2 class="section-title">Видео</h2>
            <div class="video-container">
                <iframe src="https://vk.com/video_ext.php?oid=-198369143&id=456239272&hd=2&autoplay=1"  allow="autoplay; encrypted-media; fullscreen; picture-in-picture;" frameborder="0" allowfullscreen ></iframe>
            </div>
            <p>Фрагмент из нашего последнего спектакля.</p>
        </section>

        <section>
            <h2 class="section-title">Расписание занятий</h2>
            <p>Расписание занятий регулярно обновляется. Пожалуйста, свяжитесь с нами для получения актуальной информации.</p>
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

