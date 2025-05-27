<?php
session_start();
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>О нас - МБОУДО "Ребрихинский ДЮЦ"</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="style.css"> <!-- Убедитесь, что этот файл существует -->
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


        .container {
            max-width: 1000px;
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

        main {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1, h2 {
            color: #007bff;
        }

        ul {
            list-style: none;
            padding-left: 0;
        }

        li::before {
            content: "\f0da"; /* Font Awesome arrow */
            font-family: FontAwesome;
            display: inline-block;
            margin-left: -1.3em;
            width: 1.3em;
            color: #007bff;
        }

        .section-image {
            max-width: 100%;
            height: auto;
            border-radius: 5px;
            margin-bottom: 15px;
        }
    </style>
</head>
<body>

    <header>
    <button onclick="window.location.href='index.php'">На главную</button>
    </header>

    <main class="container mt-4">
        <h1 class="text-center mb-4">О нас - МБОУДО "Ребрихинский ДЮЦ"</h1>

        <section class="mb-4">
    <h2><i class="fas fa-info-circle mr-2"></i> Общая информация</h2>
    <img src="img/dus.jpg" alt="Фото ДЮЦ" class="section-image" style="max-width: 50%; height: auto;">
    <p>Муниципальное бюджетное образовательное учреждение дополнительного образования "Ребрихинский Дом детского творчества" (МБОУДО "Ребрихинский ДЮЦ")</p>
    <p><i class="fas fa-calendar-alt mr-2"></i> <b>Дата создания:</b> 1 сентября 1992 года</p>
    <p><i class="fas fa-university mr-2"></i> <b>Учредитель:</b> Комитет по образованию администрации Ребрихинского района.</p>
    <p><i class="fas fa-map-marker-alt mr-2"></i> <b>Местонахождение:</b> 658540, Алтайский край, Ребрихинский район, с. Ребриха, ул. Ленина, д. 134</p>
    <p><i class="fas fa-phone-alt mr-2"></i> <b>Контактный телефон:</b> 8  (38582) 22-1-57</p>
    <p><i class="fas fa-envelope mr-2"></i> <b>Адрес электронной почты:</b> reb_duc@mail.ru</p>
    <p><i class="fas fa-clock mr-2"></i> <b>Режим работы:</b> Пн - Вс с 9:00 до 18:00 <br>Выходной: суббота. (возможны изменения в зависимости от расписания занятий)</p>
</section>

        <section class="mb-4">
            <h2><i class="fas fa-bullseye mr-2"></i> Цели и задачи</h2>
            <img src="img/vopros.png" alt="Цели и задачи" class="section-image" style="max-width: 20%; height: auto;">
            <p>Основной целью деятельности МБОУДО "Ребрихинский ДЮЦ" является обеспечение реализации прав граждан на дополнительное образование, создание условий для развития творческих способностей и интересов детей и подростков.</p>
            <p><b>Задачи:</b></p>
            <ul>
                <li>Развитие мотивации личности к познанию и творчеству.</li>
                <li>Реализация дополнительных образовательных программ различной направленности.</li>
                <li>Обеспечение необходимых условий для личностного развития, укрепления здоровья и профессионального самоопределения обучающихся.</li>
                <li>Формирование общей культуры обучающихся.</li>
                <li>Организация содержательного досуга.</li>
            </ul>
        </section>

        <section class="mb-4">
            <h2><i class="fas fa-sitemap mr-2"></i> Структура и органы управления</h2>
            <img src="img/ped.jpg" alt="Структура ДЮЦ" class="section-image" style="max-width: 20%; height: auto;">
            <p><b>Директор:</b>Беззадина Наталья Анатольевна</p>
            <p><b>Заместитель директора по учебно-воспитательной работе:</b> Денисова Елена Алексеевна</p>
            <p><b>Органы управления:</b></p>
            <ul>
                <li>Педагогический совет</li>
                <li>Родительский комитет</li>
                <li>Общее собрание трудового коллектива</li>
            </ul>
        </section>

        <section class="mb-4">
            <h2><i class="fas fa-tools mr-2"></i> Материально-техническое обеспечение</h2>
            <img src="img/pol.png" alt="Материально-техническое обеспечение ДЮЦ" class="section-image" style="max-width: 20%; height: auto;">
            <p>МБОУДО "Ребрихинский ДЮЦ" располагает учебными кабинетами, оснащенными необходимым оборудованием для проведения занятий по различным направлениям.</p>
            <p>В учреждении имеются: актовый зал, бальный зал, мастерские, служебные помещения, комнаты досуга и медицинский кабинет.</p>
        </section>

        <section class="mb-4">
    <h2><i class="fas fa-folder-open mr-2"></i> Документы</h2>
    <ul>
        <li><a href="programma_orlenok.zip" download="programma_orlenok.zip">Программа организации детского отдыха в ООЦ "Орленок"</a></li>
        <li><a href="kak_zabronirovat_putevku.docx" download="kak_zabronirovat_putevku.docx">Как забронировать путевку</a></li>
        <li><a href="vozrastnaja_kategorija_detej.docx" download="vozrastnaja_kategorija_detej.docx">Возрастная категория детей, даты проведения смен и стоимость путевки</a></li>
        <li><a href="pamjatka_roditeljam.docx" download="pamjatka_roditeljam.docx">Памятка родителям, отправляющим детей в лагерь</a></li>
        <li><a href="soglasija-dogovor_dlja_roditelej.zip" download="soglasija-dogovor_dlja_roditelej.zip">Документы для родителей</a></li>
        <li><a href="oficialno.docx" download="oficialno.docx">Официальная информация</a></li>
    </ul>
</section>

    </main>

    <footer>
        <!--  Тут код футера (как на главной странице) -->
    </footer>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>