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

        $currentYear = date("Y");
        for ($year = 2020; $year <= $currentYear; $year++) {
            echo "<option value='$year'>$year</option>";
        }
        ?>
    </select>

    <label for="month">Месяц:</label>
    <select name="month" id="month">
        <?php
    
        for ($month = 1; $month <= 12; $month++) {
            echo "<option value='$month'>" . date("F", mktime(0, 0, 0, $month, 1)) . "</option>";
        }
        ?>
    </select>

    <input type="submit" value="Выбрать">
</form>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $year = intval($_POST['year']);
    $month = intval($_POST['month']);

    $daysInMonth = cal_days_in_month(CAL_GREGORIAN, $month, $year);
    
    $firstDayOfMonth = strtotime("$year-$month-01");
    $firstWeekday = date('w', $firstDayOfMonth); 

    $weekdays = ['Вс', 'Пн', 'Вт', 'Ср', 'Чт', 'Пт', 'Сб'];

    echo "<table>";
    echo "<tr>";

    foreach ($weekdays as $day) {
        echo "<th>$day</th>";
    }
    echo "</tr><tr>";

    for ($i = 0; $i < $firstWeekday; $i++) {
        echo "<td></td>";
    }

    for ($day = 1; $day <= $daysInMonth; $day++) {
        echo "<td>$day</td>";
        if (($day + $firstWeekday) % 7 == 0) {
            echo "</tr><tr>";
        }
    }

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
