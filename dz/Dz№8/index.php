<?php
// Устанавливаем параметры подключения к базе данных
$host = 'localhost'; // Адрес сервера базы данных
$db = 'geo_db'; // Имя базы данных
$user = 'root'; // Имя пользователя для подключения к базе данных
$pass = 'root'; // Пароль пользователя для подключения к базе данных

// Создаем новое соединение с базой данных MySQL
$conn = new mysqli($host, $user, $pass, $db);

// Проверяем, удалось ли установить соединение с базой данных
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error); // Если ошибка, выводим сообщение и завершаем выполнение скрипта
}

// Проверяем, был ли отправлен POST-запрос с параметром 'region_id'
if (isset($_POST['region_id'])) {
    // Преобразуем 'region_id' в целое число для предотвращения SQL-инъекций
    $region_id = intval($_POST['region_id']);
    
    // Подготавливаем SQL-запрос для получения городов по идентификатору региона
    $stmt = $conn->prepare("SELECT * FROM cities WHERE region_id = ?");
    
    // Связываем параметр с подготовленным запросом; "i" означает, что ожидается целое число
    $stmt->bind_param("i", $region_id); 
    
    // Выполняем подготовленный запрос
    $stmt->execute();
    
    // Получаем результат выполнения запроса
    $result = $stmt->get_result();
    
    // Инициализируем массив для хранения городов
    $cities = [];
    
    // Извлекаем ассоциативные массивы из результата запроса и добавляем их в массив $cities
    while ($row = $result->fetch_assoc()) {
        $cities[] = $row; // Добавляем каждую строку результата в массив $cities
    }

    // Преобразуем массив городов в формат JSON и выводим его
    echo json_encode($cities);
    exit; // Завершаем выполнение скрипта после отправки ответа
}

// Выполняем запрос для получения всех регионов из таблицы 'regions'
$regions = $conn->query("SELECT * FROM regions");

// Проверяем, успешно ли выполнен запрос на получение регионов
if (!$regions) {
    die("Error fetching regions: " . $conn->error); // Если произошла ошибка, выводим сообщение об ошибке и завершаем выполнение скрипта
}

// Закрываем соединение с базой данных
$conn->close();

?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Зависимые выпадающие списки</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>

    <h1>Выберите регион и город</h1>
    
    <label for="region">Регион:</label>
    <select id="region">
        <option value="0">-выберите регион-</option>
        <?php while ($row = $regions->fetch_assoc()): ?>
            <option value="<?= $row['id'] ?>"><?= $row['name'] ?></option>
        <?php endwhile; ?>
    </select>

    <label for="city">Город:</label>
    <select id="city" style="display:none;">
        <option value="0">-выберите город-</option>
    </select>

    <script>
        $(document).ready(function() {
            $('#region').change(function() {
                var regionId = $(this).val();
                if (regionId > 0) {
                    $.ajax({
                        url: '', 
                        type: 'POST',
                        data: { region_id: regionId },
                        dataType: 'json',
                        success: function(data) {
                            $('#city').empty().append('<option value="0">-выберите город-</option>');
                            $.each(data, function(index, city) {
                                $('#city').append('<option value="' + city.id + '">' + city.name + '</option>');
                            });
                            $('#city').show();
                        }
                    });
                } else {
                    $('#city').hide();
                }
            });
        });
    </script>

</body>
</html>

<?php
$conn->close();
?>
