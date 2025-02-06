<?php
// Функция для добавления сообщения
function add_message($name, $email, $message) {
    // Получаем текущую дату и время в формате "ГГГГ-ММ-ДД ЧЧ:ММ:СС"
    $timestamp = date("Y-m-d H:i:s");
    
    // Заменяем переносы строки на HTML-тэги <br>, чтобы корректно отображать сообщения в браузере
    $message = str_replace(PHP_EOL, '<br>', $message);
    
    // Форматируем сообщение, объединяя имя, email, временную метку и само сообщение через точку с запятой
    $formatted_message = "$name;$email;$timestamp;$message\n";
    
    // Сохраняем сообщение в файл 'data.txt', добавляя его в конец файла
    file_put_contents('data.txt', $formatted_message, FILE_APPEND | LOCK_EX);
}

// Функция для отображения сообщений
function display_messages() {
    // Проверяем, существует ли файл 'data.txt'
    if (file_exists('data.txt')) {
        // Читаем содержимое файла в массив строк, игнорируя пустые строки
        $messages = file('data.txt', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        
        // Выводим сообщения в обратном порядке (новые сообщения сверху)
        foreach (array_reverse($messages) as $line) {
            // Разбиваем строку на части: имя, email, временная метка и сообщение
            list($name, $email, $timestamp, $message) = explode(';', $line);
            // Выводим каждую часть сообщения с соответствующим форматированием
            echo "<strong>Имя:</strong> $name<br>";
            echo "<strong>Email:</strong> $email<br>";
            echo "<strong>Дата/Время:</strong> $timestamp<br>";
            echo "<strong>Сообщение:</strong> $message<br><br>";
        }
    } else {
        // Если файл не существует, выводим сообщение о том, что книга пуста
        echo "Гостевая книга пуста.";
    }
}

// Обработка формы
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Получаем значения из полей формы и удаляем лишние пробелы
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $message = trim($_POST['message']);

    // Проверяем, что все поля заполнены
    if (!empty($name) && !empty($email) && !empty($message)) {
        // Если поля заполнены, добавляем сообщение
        add_message($name, $email, $message);
        echo "Сообщение добавлено!<br><br>";
    } else {
        // Если хотя бы одно поле пустое, выводим сообщение об ошибке
        echo "Все поля обязательны для заполнения!<br><br>";
    }
}

// Перенаправление обратно на ту же страницу после обработки формы
if (!empty($_POST)) {
    header("Location: {$_SERVER['PHP_SELF']}");
    exit; // Завершаем выполнение скрипта после перенаправления
}

    ?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Гостевая книга</title>
</head>
<body>
    <h1>Гостевая книга</h1>

    <form method="post" action="">
        <label for="name">Имя:</label><br>
        <input type="text" id="name" name="name" required><br><br>
        
        <label for="email">Email:</label><br>
        <input type="email" id="email" name="email" required><br><br>
        
        <label for="message">Сообщение:</label><br>
        <textarea id="message" name="message" rows="4" required></textarea><br><br>
        
        <input type="submit" value="Добавить сообщение">

    </form>

    <h2>Сообщения:</h2>
    <?php display_messages(); ?>
</body>
</html>
