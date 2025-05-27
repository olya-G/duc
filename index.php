<?php
session_start();
include 'config.php'; // Убедитесь, что в этом файле правильно настроено соединение с базой данных

// Проверяем, авторизован ли пользователь
if (isset($_SESSION["user_id"])) {
    // Пользователь авторизован
    $user_id = $_SESSION["user_id"];

    // Получаем информацию о пользователе из базы данных
    $sql = "SELECT name, email FROM users WHERE user_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $username = $row["name"];
        $email = $row["email"];
    } else {
        $username = "Пользователь не найден";
        $email = "Пользователь не найден";
    }
} else {
    // Пользователь не авторизован
    $user_id = null;
    $username = null;
    $email = null;
}


// Закрытие соединения




?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>МБОУДО "Ребрихинский ДЮЦ"</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        body {
            font-family: "Arial", sans-serif;
            margin: 0;
            background-color: #f0f8ff; /* Светлый фон */
        }
        
        header {
            background-color: #4a90e2;
            color: white;
            padding: 0;
        }
        .navbar-nav .nav-link {
            color: white;
        }
        .navbar-nav .nav-link:hover {
            color: #ffcc00;
        }
        .jumbotron {
            background-color: rgba(255, 255, 255, 0.4);
            border-radius: 0.5rem;
            padding: 30px;
            margin-bottom: 20px;
        }
        .sidebar {
            background-color: #ffffff;
            border-radius: 0.5rem;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        footer {
            background-color: #e9ecef;
            border-top: 1px solid #dee2e6;
            padding: 15px 0;
        }
        .card-title {
            font-weight: bold;
            color: #4a90e2;
        }
        .btn-primary {
            background-color: #4a90e2;
            border: none;
        }
        .btn-primary:hover {
            background-color: #007bff;
        }



        #news-container {
    text-align: center; /* Центрируем заголовок */
    max-width: 760px; /* Ограничьте максимальную ширину */
    padding: 20px; /* Добавьте отступы */
    background-color:rgb(255, 255, 255); /* Фоновый цвет контейнера */
    border-radius: 10px; /* Скругление углов */
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1); /* Тень для контейнера */
    word-wrap: break-word; /* Перенос слов, если они длинные */
    margin-left: -15px;

}

.news-header {
    font-size: 2em; /* Размер шрифта заголовка */
    margin-bottom: 20px; /* Отступ снизу */
    color: #333; /* Цвет заголовка */
}

.news-item {
    margin: 0 auto;
    max-width: 760px; /* Ограничьте максимальную ширину */
    padding: 20px; /* Добавьте отступы */
    word-wrap: break-word; /* Перенос слов, если они длинные */
    margin-bottom: 20px; /* Отступы между новостями */

    transition: transform 0.2s; /* Анимация при наведении */
}


.news-item:hover {
    transform: scale(1.02); /* Увеличение при наведении */
}

.news-title {
    font-size: 1.5em; /* Размер шрифта заголовка новости */
    margin-bottom: 10px; /* Отступ снизу */
}

.news-content {
    font-size: 1em; /* Размер шрифта для содержимого */
    margin-bottom: 10px; /* Отступ снизу */
}

.news-buttons {
    margin-top: 10px; /* Отступы между текстом и кнопками */
}

button {
    margin-right: 5px; /* Отступы между кнопками */
}


    </style>
</head>
<body>

<header>
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-4">
                <div class="d-flex align-items-center">
                    <img src="img/logo.png" alt="Логотип" class="mr-2" style="max-width: 50px;">
                    <div>
                        <h1 class="h4">МБОУДО "Ребрихинский ДЮЦ"</h1>
                        <small>с.Ребриха, ул.Ленина, 134</small>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <nav class="navbar navbar-expand-lg navbar-dark">
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarNav">
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <a class="nav-link" href="info.php">О нас</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="life.php">Наша жизнь</a>
                            </li>
                        </ul>
                    </div>
                </nav>
            </div>
            <div class="col-md-3 text-right">
                <div class="user-block">
                    <?php if (isset($_SESSION["user_id"])): ?>
                        <a href="profil.php"><img src="img/icon.png" class="img-fluid" width="50" alt="Icon"></a>
                    <?php else: ?>
                        <span>Присоединитесь к нам!</span><br>
                        <a class="text-light" href="registr.php">Авторизоваться</a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</header>

<main class="container mt-4">
    <div class="row">
        <section class="col-md-8 main-content" style="background-image: url('img/woomen.png'); background-size: cover; background-position: center; border-radius: 0.5rem; overflow: hidden;">
            <div class="jumbotron">
                <h1 class="display-4">Есть вопросы?</h1>
                <p class="lead">Напишите нам!</p>
                <!-- Кнопка для открытия модального окна -->
                <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#contactModal">
                    Написать о проблеме
                </button>
            </div>
        </section>
        <aside class="col-md-4 sidebar p-3">
            <div class="card mb-3">
                <img src="img/wor.png" class="card-img-top" alt="Другое Дело">
                <div class="card-body">
                    <h5 class="card-title">Наша работа</h5>
                    <p class="card-text">Мы занимаемся образовательными программами и мероприятиями для детей.</p>
                </div>
            </div>
        </aside>
    </div>





    <?php
    // Массив для хранения новостей
    $news = [
        [
            "title" => "Пешеход! Двигайся безопасно!", 
            "content" => "27 марта волонтеры отряда Синяя птица Ребрихинского ДЮЦ приняли участие в совместной акции с сотрудниками Ребрихинской Госавтоинспекции под названием Пешеход! Двигайся безопасно! Акция была направлена на профилактику ДТП с участием пешеходов. Волонтеры распространяли среди пешеходов информационные буклеты с полезными рекомендациями. Светоотражающие браслеты раздавались не только детям и подросткам, но и пожилым людям. Мы верим, что наше село станет более безопасным местом.", 
            "created_at" => "29.03.2025", 
            "image" => "img/gpdd.jpg"
        ],
        [
            "title" => "Турнир по шахматам", 
            "content" => "Согласно плану работы на весенних каникулах и с целью занятости детей в каникулярное время, в нашем детско-юношеском центре 27 марта прошел районный турнир по шахматам Весенняя капель! В турнире приняли участие шахматисты из села Ребриха и Станции-Ребриха. По итогам соревнований среди мальчиков: 1 место занял Мигулев Алексей (МБОУ ДО Ребрихинский ДЮЦ) 2 место- Лидер Александр (Станция-Ребриха) 3 место- Хлопов Вячеслав (МБОУ ДО Ребрихинский ДЮЦ) Среди девочек призовое 1 место получила Кондратьева Злата! Все ребята были награждены грамотами и сладкими подарками!", 
            "created_at" => "28.03.2025",
            "image" => "img/sh.jpg" // Зададим пустое значение для изображения
        ],
    ];
    ?>


<div class="container mt-4">
    <h2 class="news-header text-center mb-4">Последние новости</h2>
    <div class="row">
        <div class="col-md-8">
            <div id="news-container">
                <div class="row">
                    <?php foreach ($news as $news_item): ?>
                        <div class="col-md-6 mb-4">
                            <div class="news-item border rounded p-3 bg-light">
                                <?php if (!empty($news_item['image'])): ?>
                                    <img src="<?php echo htmlspecialchars($news_item['image']); ?>" alt="Изображение новости" class="img-fluid mb-3">
                                <?php endif; ?>
                                <h5><?php echo htmlspecialchars($news_item['title']); ?></h5>
                                <p><?php echo nl2br(htmlspecialchars($news_item['content'])); ?></p>
                                <p class="text-muted"><small>Опубликовано: <?php echo htmlspecialchars($news_item['created_at']); ?></small></p>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
        <aside class="col-md-4 sidebar p-3">
            <div class="card mb-3">
                <img src="img/wor.png" class="card-img-top" alt="Другое Дело">
                <img src="img/w.jpg" class="card-img-top" alt="Другое Дело">
                <img src="img/q.jpg" class="card-img-top" alt="Другое Дело">
                <img src="img/e.jpg" class="card-img-top" alt="Другое Дело">
                <div class="card-body">
                </div>
            </div>
        </aside>
    </div>
</div>


<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>





</script>
    <!-- Модальное окно для связи -->
    <div class="modal fade" id="contactModal" tabindex="-1" role="dialog" aria-labelledby="contactModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="contactModalLabel">Связаться с нами</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Закрыть">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="index.php" id="contactForm">
                        <div class="form-group">
                            <label for="situation">Опишите ситуацию</label>
                            <textarea class="form-control" id="situation" name="situation" rows="3" placeholder="Суть проблемы или предложения" required></textarea>
                        </div>
                        
                        <div class="form-group">
                            <label for="region">Ваш регион</label>
                            <select class="form-control" id="region" name="region" required>
                                <option value="">Выберите регион</option>
                                <option value="Алтайский край">Алтайский край</option>
                                <option value="Другой регион">Другой регион</option>
                            </select>
                        </div>
                        
                        <div class="form-group">
                            <label for="category">Категория</label>
                            <select class="form-control" id="category" name="category" required>
                                <option value="">Выберите категорию</option>
                                <option value="Спам">Спам</option>
                                <option value="Предложение">Предложение</option>
                            </select>
                        </div>

                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="displayPublic" name="display_public" required>
                            <label class="form-check-label" for="displayPublic">
                                <a href="#" data-toggle="modal" data-target="#rulesModal" style="text-decoration: underline; cursor: pointer;">Согласен на публичное отображение</a>
                            </label>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
                    <button type="submit" class="btn btn-primary" form="contactForm">Отправить сообщение</button>
                </div>
            </div>
        </div>
    </div>
</main>

<?php
// Проверяем, была ли отправлена форма
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Получаем данные из формы и экранируем их
    $situation = htmlspecialchars(trim($_POST['situation']));
    $region = htmlspecialchars(trim($_POST['region']));
    $category = htmlspecialchars(trim($_POST['category']));
    $created_at = isset($_POST['created_at']) ? 1 : 0; // 1, если отмечено, иначе 0
    $user_id = $_SESSION['user_id']; // Убедитесь, что user_id установлен в сессии

    // Проверка на наличие пустых полей
    if (!empty($situation) && !empty($region) && !empty($category)) {
        // SQL-запрос для вставки данных
        $stmt = $conn->prepare("INSERT INTO user_submissions (situation, region, category, user_id, created_at) VALUES (?, ?, ?, ?, ?)");
        if ($stmt === false) {
            die("Ошибка подготовки запроса: " . $conn->error);
        }

        $stmt->bind_param("ssssi", $situation, $region, $category, $user_id, $created_at);

        // Выполняем запрос и проверяем результат
        if ($stmt->execute()) {
            $_SESSION['user_submissions'] = "Сообщение отправлено!";
        } else {
            $_SESSION['user_submissions'] = "Ошибка при отправке сообщения: " . $stmt->error;
            error_log("SQL Error: " . $stmt->error); // Логирование ошибки
        }

        // Закрываем соединение
        $stmt->close();
        $conn->close();
    } else {
        $_SESSION['user_submissions'] = "Пожалуйста, заполните все поля!";
    }
    exit();
}
?>

   

<!-- Модальное окно для правил -->
<div class="modal fade" id="rulesModal" tabindex="-1" role="dialog" aria-labelledby="rulesModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="rulesModalLabel">Правила подачи сообщений и обращений</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Закрыть">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" style="max-height: 400px; overflow-y: auto;">
                <p>С помощью Федеральной государственной информационной системы «Единый портал государственных и муниципальных услуг (функций)» (далее – Единый портал) Вы вправе направить в государственные органы, органы местного самоуправления, государственные и муниципальные учреждения, иные организации, осуществляющие публично значимые функции, и их должностным лицам (далее соответственно – органы, организации) обращение или сообщение, касающееся проблемы (предложения), решение которой (реализацию которого) могут обеспечить в соответствии со своей компетенцией органы или организации, на сайте которых Вы перешли на электронную форму Единого портала.</p>

                <p>Пожалуйста, прежде чем направить обращение или сообщение, внимательно ознакомьтесь с информацией:</p>
                
                <ol>
                    <li>Обращением является предложение, заявление, жалоба, направляемые в соответствии с Федеральным законом «О порядке рассмотрения обращений граждан Российской Федерации» в форме электронного документа.</li>
                    <li>Сообщением является информация о необходимости решения актуальных для физических или юридических лиц проблем, направляемая в форме электронного документа, для рассмотрения и направления ответов по которой федеральными, региональными, ведомственными правовыми актами, решениями Правительства Российской Федерации установлены ускоренные сроки рассмотрения, не превышающие 10 календарных дней, если иное не предусмотрено решением Правительства Российской Федерации.</li>
                    <li>Для подачи обращения или сообщения гражданин должен иметь подтверждённую учётную запись на Едином портале.</li>
                    <li>Для направления обращения или сообщения необходимо корректно заполнить поля электронной формы. Обязательные для заполнения поля отмечены звездочкой (*).</li>
                    <li>При направлении обращения (сообщения) рекомендуется указывать информацию только об одной проблеме (одном предложении) по одной тематике для обеспечения возможности его автоматической рубрикации и маршрутизации в уполномоченный орган или организацию. Если Вам необходимо обратиться по нескольким вопросам, лучше направить обращение или сообщение по каждому из них.</li>
                    <li>В случае необходимости Вы можете приложить к обращению или сообщению документы и материалы в электронной форме. Подтверждением прикрепления файла(ов) вложения является появление строки с наименованием(ями) выбранного(ых) файла(ов). Гарантированная передача файла(ов) вложения зависит от пропускной способности используемой Вами сети «Интернет», а получение – от ограничений на размер передаваемых файлов Вашей электронной почты.</li>
                    <li>При поступлении на Единый портал обращению (сообщению) присваивается регистрационный номер. Регистрация подтверждается присваиваемым Единым порталом регистрационным номером, который отображается в Вашем личном кабинете на Едином портале. Регистрация обращений, направляемых в избирательные комиссии, комиссии референдума, устанавливаются в порядке, определяемом Центральной избирательной комиссией Российской Федерации.</li>
                    <li>Рассмотрение обращения осуществляется уполномоченными исполнителями органов и организаций в течение 30 календарных дней, а сообщения – в течение 10 календарных дней, если иное не предусмотрено решением Правительства Российской Федерации. В исключительных случаях, а также в случае направления запроса, предусмотренного частью 2 статьи 10 Федерального закона от 2 мая 2006 г. № 59-ФЗ «О порядке рассмотрения обращений граждан Российской Федерации», срок рассмотрения обращения может быть продлен с указанием новой даты решения и причин переноса срока; в случае с обращением продление срока может быть произведено только один раз.</li>
                    <li>Если обращение или сообщение содержит информацию о проблеме (предлож
                    <li>Если обращение или сообщение содержит информацию о проблеме (предложении), решение которой (реализация которого) не входит в компетенцию органа или организации, в которую оно поступило, оно будет перенаправлено в орган или организацию, в компетенцию которых входит решение обозначенной в обращении или сообщении проблемы (реализация обозначенного в обращении или сообщении предложения), о чем Вам будет направлено уведомление на указанный Вами в профиле Единого портала адрес электронной почты и в Ваш личный кабинет на Едином портале.</li>
                    <li>Ответы на обращения и сообщения, уведомления о регистрации, переадресации, ходе рассмотрения обращения или сообщения будут направляться на указанный Вами в профиле Единого портала адрес электронной почты и в Ваш личный кабинет на Едином портале.</li>
                    <li>Ваше обращение или сообщение может быть не рассмотрено по существу в следующих случаях:
                        <ul>
                            <li>В обращении или сообщении содержатся нецензурные либо оскорбительные выражения, угрозы жизни, здоровью и имуществу должностного лица, а также членов его семьи, текст письменного обращения не поддается прочтению, в том числе в связи с употребляемыми неясными сокращениями.</li>
                            <li>Обращение или сообщение содержит информацию, направленную на пропаганду или агитацию, возбуждающих социальную, расовую, национальную или религиозную ненависть и вражду или языковое превосходство.</li>
                            <li>Обращение или сообщение содержит персональные данные третьих лиц, распространяемые в отсутствие законных оснований.</li>
                            <li>Обращение или сообщение содержит информацию, распространяемую в коммерческих целях либо в любых других целях, не связанных с решением проблемы (реализацией предложения) (спам, реклама, ссылки на другие ресурсы информационно-телекоммуникационной сети «Интернет», размещенные на них документы, изображения, видеофайлы).</li>
                            <li>В обращении или сообщении не указана информация о месте нахождения (об адресе) проблемы (предложения).</li>
                            <li>Текст обращения или сообщения не позволяет определить суть проблемы (предложения).</li>
                        </ul>
                    </li>
                </ol>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
            </div>
        </div>
    </div>
</div>


 </main>
    


<!-- jQuery и Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>


