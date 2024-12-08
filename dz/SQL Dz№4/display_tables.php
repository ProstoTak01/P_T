<?php
$host = 'localhost'; // Хост, обычно localhost
$db = 'my_database'; // Имя базы данных
$user = 'P_T'; // Имя пользователя MySQL
$pass = '123123'; // Пароль пользователя MySQL

// Подключение к базе данных
$mysqli = new mysqli($host, $user, $pass, $db);

// Проверка подключения
if ($mysqli->connect_error) {
    die("Ошибка подключения: " . $mysqli->connect_error);
}

// Получение списка таблиц
$result = $mysqli->query("SHOW TABLES");
if ($result->num_rows > 0) {
    while ($row = $result->fetch_array()) {
        $tableName = $row[0];
        echo "<h2>Таблица: $tableName</h2>";

        // Получение структуры таблицы
        $structureResult = $mysqli->query("DESCRIBE $tableName");
        if ($structureResult->num_rows > 0) {
            echo "<h3>Структура:</h3><ul>";
            while ($structureRow = $structureResult->fetch_assoc()) {
                echo "<li>{$structureRow['Field']} - {$structureRow['Type']}</li>";
            }
            echo "</ul>";
        }

        // Получение содержимого таблицы
        $dataResult = $mysqli->query("SELECT * FROM $tableName");
        if ($dataResult->num_rows > 0) {
            echo "<h3>Содержимое:</h3><table border='1'><tr>";
            // Заголовки таблицы
            while ($fieldInfo = $dataResult->fetch_field()) {
                echo "<th>{$fieldInfo->name}</th>";
            }
            echo "</tr>";

            // Данные таблицы
            while ($dataRow = $dataResult->fetch_assoc()) {
                echo "<tr>";
                foreach ($dataRow as $value) {
                    echo "<td>$value</td>";
                }
                echo "</tr>";
            }
            echo "</table>";
        } else {
            echo "<p>Таблица пустая.</p>";
        }
    }
} else {
    echo "Нет таблиц в базе данных.";
}

// Закрытие соединения
$mysqli->close();
?>
