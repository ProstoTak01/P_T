<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Лечебный Центр</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <header class="bg-primary text-white text-center p-4">
        <h1>Лечебный Центр</h1>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand" href="index.php">Главная</a>
            <div class="collapse navbar-collapse">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item"><a class="nav-link" href="about_us.php">О нас</a></li>
                    <li class="nav-item"><a class="nav-link" href="contacts.php">Контакты</a></li>
                    <li class="nav-item"><a class="nav-link" href="info.php">Информация</a></li>
                    <li class="nav-item"><a class="nav-link" href="news.php">Новости</a></li>
                    <li class="nav-item"><a class="nav-link" href="history.php">История</a></li>
                    <li class="nav-item"><a class="nav-link" href="for_clients.php">Для клиентов</a></li>
                </ul>
            </div>
        </nav>
    </header>
    <?php include 'header.php'; ?>
<div class="container mt-4">
    <h2>Контакты</h2>
    <p>Email: info@med-celitel.ru</p>
    <p>Телефон: +7 (4967) 76-03-33</p>
    <br>
    <h4>График работы:</h4>
    <h5>Пн-Пт: с 8:00 до 19:00. Сб: с 8:00 до 17:00. Вс: Выходной</h5>
    <br>
    <p>Наш адрес: Серпухов, ул. Водонапорная 36А</p>
    <div style="position:relative;overflow:hidden;"><a href="https://yandex.ru/maps/org/tselitel/1042999200/?utm_medium=mapframe&utm_source=maps" style="color:#eee;font-size:12px;position:absolute;top:0px;">Целитель</a><a href="https://yandex.ru/maps/10754/serpuhov/category/medical_center_clinic/184106108/?utm_medium=mapframe&utm_source=maps" style="color:#eee;font-size:12px;position:absolute;top:14px;">Медцентр, клиника в Серпухове</a><iframe src="https://yandex.ru/map-widget/v1/?ll=37.434841%2C54.917478&mode=poi&poi%5Bpoint%5D=37.434611%2C54.918426&poi%5Buri%5D=ymapsbm1%3A%2F%2Forg%3Foid%3D1042999200&z=17.74" width="560" height="400" frameborder="1" allowfullscreen="true" style="position:relative;"></iframe></div>
</div>
<?php include 'footer.php'; ?>
</body>
</html>
