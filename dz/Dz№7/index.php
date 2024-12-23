<?php
$directory = 'C:\MAMP\htdocs\dz\Dz№7\img'; 
$allowed_extensions = ['jpg']; 
$max_file_size = 300 * 1024; 


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['fileToUpload'])) {
    $file = $_FILES['fileToUpload'];
    $file_name = basename($file['name']);
    $file_extension = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
    
    
    if (!in_array($file_extension, $allowed_extensions)) {
        echo "Ошибка: только файлы JPG разрешены.";
    } elseif ($file['size'] > $max_file_size) {
        echo "Ошибка: размер файла не должен превышать 300 Кб.";
    } else {
        
        if (move_uploaded_file($file['tmp_name'], "$directory/$file_name")) {
            echo "Файл загружен успешно.";
        } else {
            echo "Ошибка при загрузке файла.";
        }
    }
}


if (isset($_GET['delete'])) {
    $file_to_delete = $_GET['delete'];
    if (file_exists("$directory/$file_to_delete")) {
        unlink("$directory/$file_to_delete");
        echo "Файл $file_to_delete удален.";
    } else {
        echo "Файл не найден.";
    }
}


if (isset($_POST['rename']) && isset($_POST['old_name']) && isset($_POST['new_name'])) {
    $old_name = $_POST['old_name'];
    $new_name = $_POST['new_name'];

    if (file_exists("$directory/$old_name")) {
        rename("$directory/$old_name", "$directory/$new_name");
        echo "Файл переименован в $new_name.";
    } else {
        echo "Файл не найден.";
    }
}


$files = array_diff(scandir($directory), array('..', '.')); 

?>

<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Управление изображениями</title>
</head>

<body>
    <h1>Содержимое папки: <?php echo $directory; ?></h1>

    <h2>Загрузка нового файла</h2>
    <form action="" method="post" enctype="multipart/form-data">
        <input type="file" name="fileToUpload" accept=".jpg" required>
        <input type="submit" value="Загрузить">
    </form>

    <h2>Список файлов</h2>
    <table border="1">
        <tr>
            <th>Имя файла</th>
            <th>Действия</th>
        </tr>
        <?php foreach ($files as $file): ?>
        <?php if (is_file("$directory/$file")): ?>
        <tr>
            <td><?php echo htmlspecialchars($file); ?></td>
            <td>
                <form action="" method="post" style="display:inline;">
                    <input type="hidden" name="old_name" value="<?php echo htmlspecialchars($file); ?>">
                    <input type="text" name="new_name" placeholder="Новое имя" required>
                    <input type="submit" name="rename" value="Переименовать">
                </form>
                <a href="?delete=<?php echo urlencode($file); ?>"
                    onclick="return confirm('Вы уверены, что хотите удалить файл?');">Удалить</a>
            </td>
        </tr>
        <?php endif; ?>
        <?php endforeach; ?>
    </table>
</body>

</html>