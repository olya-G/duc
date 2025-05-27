<?php
session_start();
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Наша жизнь - Кружки и объединения - МБОУДО "Ребрихинский ДЮЦ"</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="style.css">
    <style>
        header {
            position: fixed; 
            top: 0; 
            left: 0; 
            width: 100%; 
            z-index: 1000; 
            padding: 10px; 
        }

        button {
            padding: 10px 20px; 
            font-size: 16px; 
            cursor: pointer; 
            background-color: #007bff; 
            color: white; 
            border: none; 
            border-radius: 5px; 
            transition: background-color 0.3s, transform 0.2s; 
        }

        button:hover {
            background-color: #0056b3; 
            transform: scale(1.05); 
        }

        button:active {
            transform: scale(0.95); 
        }

        .circle-card {
            margin: 20px;
    text-align: center;
    border: 3px solid #ccc; /* Обводка карточки */
    border-radius: 10px; /* Закругленные углы */
    padding: 15px; /* Отступ внутри карточки */
    box-shadow: 0 4px 8px rgba(32, 40, 182, 0.29); /* Тень для эффекта глубины */
    background-color: #fff; /* Цвет фона карточки */
    width: 250px; /* Ширина карточки */
    height: 450px; /* Установите желаемую высоту */
            overflow: hidden;
            display: table-header-group;
            flex-direction: column; /* Изменено для вертикального расположения */
            justify-content: center;
            align-items: center;
            color: #333;
            font-size: 1.2em;
            transition: all 0.3s ease;
        }

        .circle-card img {
            width: 170px; /* Установите желаемую ширину */
    height: 170px; /* Установите желаемую высоту */
    border-radius: 50%; /* Делает изображение круглым */
    object-fit: cover; /* Обрезает изображение, чтобы оно вписывалось в круг */
            transition: transform 0.3s ease; 
        }

        .circle-card:hover {
            transform: scale(1.05);

        }

        .circle-card:hover img {
            transform: scale(1.2); 
        }

        .circle-card p {
            margin-bottom: 0;
        }


.caption {
    text-align: center;
    margin-top: 10px; /* Отступ сверху для подписи */
    font-weight: bold; /* Жирный шрифт для подписи */
}



    </style>
</head>
<body>

<header>
    <button onclick="window.location.href='index.php'">На главную</button>
</header>

<main class="mt-4">
    <h1 class="text-center mb-4">Наша жизнь - Кружки и объединения</h1>

    <section class="mb-4">
    <div class="text-center py-4 lead">В МБОУДО "Ребрихинский ДЮЦ" каждый ребенок может найти себе занятие по душе! Мы предлагаем широкий выбор кружков и объединений различной направленности:</p>

        <div class="d-flex flex-wrap justify-content-center">
    <!-- Кружок 1 -->
    <div class="circle-card">
        <a href="rucoelie.php">
            <img src="img/ru.jpeg"  class="circle-image">
        </a>
        <p class="caption">Рукоделие</p>
        <p class="text-center py-4 lead">Погружение в мир творчества с уроками по вышивке и вязанию.</p>
    </div>

    <!-- Кружок 2 -->
    <div class="circle-card">
        <a href="acter.php">
            <img src="img/teatr.jpg"  class="circle-image">
        </a>
        <p class="caption">Актерское Мастерство</p>
        <p class="text-center py-4 lead">Уроки по актерскому мастерству.</p>
    </div>

    <!-- Кружок 3 -->
    <div class="circle-card">
        <a href="shax.php">
            <img src="img/shax.jpeg"  class="circle-image">
        </a>
        <p class="caption">Шахматы</p>
        <p class="text-center py-4 lead">Занятия шахматыми развивают критическое мышление.</p>
    </div>

    <!-- Кружок 4 -->
    <div class="circle-card">
        <a href="risovanie.php">
            <img src="img/palitra.jpg" alt="Рисование" class="circle-image">
        </a>
        <p class="caption">Рисование</p>
        <p class="text-center py-4 lead">Развитие художественных навыков и креативности.</p>
    </div>
</div>

    </section>
</main>

<footer>
    <!-- Тут код футера (как на главной странице) -->
    <div class="text-center py-4 lead">
        <p>&copy; Подробную информацию о каждом кружке, расписании занятий и педагогах можно узнать по телефону</p>
        <p>Телефон: 8 (38582) 22157</p>
    </div>
</footer>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
