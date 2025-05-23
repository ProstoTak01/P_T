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
    <?php include 'header.php'; ?> //Конструкция для включения и выполнения кода из другого файла.
<div class="container mt-4">
    <h2>О нас</h2>
    <p>Наш лечебный центр предоставляет широкий спектр услуг для пациентов с проблемами опорно-двигательного аппарата.</p>
    <img src="img/1.jpg" alt="История центра" class="img-fluid">
</div>
<?php include 'footer.php'; ?>//Конструкция для включения и выполнения кода из другого файла.

</body>
</html>
