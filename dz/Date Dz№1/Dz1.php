<?php
session_start(); // Запускает сессию, позволяя сохранять данные между запросами пользователя.

$daysDifference = ''; // Инициализирует переменную для хранения разницы в днях между двумя датами.
$minutesDifference = ''; // Инициализирует переменную для хранения разницы в минутах между двумя датами.

if ($_SERVER["REQUEST_METHOD"] == "POST") { // Проверяет, была ли форма отправлена методом POST.
    $date1 = $_POST['date1']; // Получает значение первой даты из формы и сохраняет его в переменной $date1.
    $date2 = $_POST['date2']; // Получает значение второй даты из формы и сохраняет его в переменной $date2.

    $datetime1 = new DateTime($date1); // Преобразует строку с первой датой в объект DateTime для удобного управления датами.
    $datetime2 = new DateTime($date2); // Преобразует строку со второй датой в объект DateTime.

    $interval = $datetime1->diff($datetime2); // Вычисляет разницу между двумя объектами DateTime и возвращает объект DateInterval.

    $daysDifference = $interval->days; // Извлекает количество полных дней из объекта DateInterval и сохраняет в переменной $daysDifference.

    $minutesDifference = $daysDifference * 24 * 60; // Переводит разницу в днях в минуты, умножая на 24 (часы в сутках) и на 60 (минуты в часе).

    $_SESSION["date1"] = $_POST["date1"]; // Сохраняет первую дату в сессии для дальнейшего использования.
    $_SESSION["date2"] = $_POST["date2"]; // Сохраняет вторую дату в сессии для дальнейшего использования.
}

?>

<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Разница между датами</title>
</head>

<body>
    <h1>Введите две даты</h1>
    <form method="POST" autocomplete="on">
        <label for="date1">Дата 1:</label>
        <input type="date" id="date1" name="date1" value="<?=$_SESSION['date1']?>" required><br><br>

        <label for="date2">Дата 2:</label>
        <input type="date" id="date2" name="date2" value="<?=$_SESSION['date2']?>" required><br><br>

        <input type="submit" value="Посчитать разницу">
    </form>

    <?php if ($daysDifference !== ''): ?>
    <h2>Результаты:</h2>
    <p>Количество дней между выбранными датами: <?php echo $daysDifference; ?></p>
    <p>Количество минут между выбранными датами: <?php echo $minutesDifference; ?></p>
    <?php endif; ?>
</body>

</html>
