<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Календарь</title>
</head>
<body>

<h1>Выберите год и месяц</h1>
<form method="post" action="">
    <label for="year">Год:</label>
    <select name="year" id="year">
        <?php
        // Генерация списка годов от 1900 до текущего года
        $currentYear = date("Y");
        for ($year = 2020; $year <= $currentYear; $year++) {
            echo "<option value='$year'>$year</option>";
        }
        ?>
    </select>

    <label for="month">Месяц:</label>
    <select name="month" id="month">
        <?php
        // Генерация списка месяцев
        for ($month = 1; $month <= 12; $month++) {
            echo "<option value='$month'>" . date("F", mktime(0, 0, 0, $month, 1)) . "</option>";
        }
        ?>
    </select>

    <input type="submit" value="Выбрать">
</form>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Получаем выбранные год и месяц
    $year = intval($_POST['year']);
    $month = intval($_POST['month']);

    // Получаем количество дней в месяце
    $daysInMonth = cal_days_in_month(CAL_GREGORIAN, $month, $year);
    
    // Получаем день недели первого дня месяца
    $firstDayOfMonth = strtotime("$year-$month-01");
    $firstWeekday = date('w', $firstDayOfMonth); // 0 (воскресенье) - 6 (суббота)

    // Массив с названиями дней недели
    $weekdays = ['Вс', 'Пн', 'Вт', 'Ср', 'Чт', 'Пт', 'Сб'];

    // Начало таблицы
    echo "<table>";
    echo "<tr>";
    
    // Заголовок с днями недели
    foreach ($weekdays as $day) {
        echo "<th>$day</th>";
    }
    echo "</tr><tr>";

    // Печатаем пустые ячейки до первого дня месяца
    for ($i = 0; $i < $firstWeekday; $i++) {
        echo "<td></td>";
    }

    // Печатаем дни месяца
    for ($day = 1; $day <= $daysInMonth; $day++) {
        echo "<td>$day</td>";
        // Если это суббота, начинаем новую строку
        if (($day + $firstWeekday) % 7 == 0) {
            echo "</tr><tr>";
        }
    }

    // Закрываем оставшиеся пустые ячейки
    while (($daysInMonth + $firstWeekday) % 7 != 0) {
        echo "<td></td>";
        $daysInMonth++;
    }

    echo "</tr>";
    echo "</table>";
}
?>

</body>
</html>
