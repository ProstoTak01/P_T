<?php
session_start();


// Инициализация переменных
$daysDifference = '';
$minutesDifference = '';

// Проверяем, была ли отправлена форма
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Получаем даты из формы
    $date1 = $_POST['date1'];
    $date2 = $_POST['date2'];

    // Преобразуем строки в объекты DateTime
    $datetime1 = new DateTime($date1);
    $datetime2 = new DateTime($date2);

    // Вычисляем разницу
    $interval = $datetime1->diff($datetime2);
    $daysDifference = $interval->days;
    $minutesDifference = $daysDifference * 24 * 60; // Переводим дни в минуты
}
$_SESSION["date1"] = $_POST["date1"];
$_SESSION["date2"] = $_POST["date2"];
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