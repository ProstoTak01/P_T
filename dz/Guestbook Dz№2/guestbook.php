<?php
// Функция для добавления сообщения
function add_message($name, $email, $message) {
    // Получаем текущую дату и время
    $timestamp = date('Y-m-d H:i:s');
    
    // Заменяем переносы строки на HTML-тэги
    $message = nl2br($message);
    
    // Форматируем сообщение
    $formatted_message = "$name;$email;$timestamp;$message\n";
    
    // Сохраняем сообщение в файл
    file_put_contents('data.txt', $formatted_message, FILE_APPEND | LOCK_EX);
}

// Функция для отображения сообщений
function display_messages() {
    if (file_exists('data.txt')) {
        $messages = file('data.txt', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        
        // Выводим сообщения в обратном порядке
        foreach (array_reverse($messages) as $line) {
            list($name, $email, $timestamp, $message) = explode(';', $line);
            echo "<strong>Имя:</strong> $name<br>";
            echo "<strong>Email:</strong> $email<br>";
            echo "<strong>Дата/Время:</strong> $timestamp<br>";
            echo "<strong>Сообщение:</strong> $message<br><br>";
        }
    } else {
        echo "Гостевая книга пуста.";
    }
}

// Обработка формы
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $message = trim($_POST['message']);

    if (!empty($name) && !empty($email) && !empty($message)) {
        add_message($name, $email, $message);
        echo "Сообщение добавлено!<br><br>";
    } else {
        echo "Все поля обязательны для заполнения!<br><br>";
    }
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
