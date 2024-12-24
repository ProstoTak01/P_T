<?php
$host = 'localhost';
$db = 'geo_db';
$user = 'root'; 
$pass = 'root'; 


$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


if (isset($_POST['region_id'])) {
    $region_id = intval($_POST['region_id']);
    $cities = $conn->query("SELECT * FROM cities WHERE region_id = $region_id");

    $result = [];
    while ($row = $cities->fetch_assoc()) {
        $result[] = $row;
    }

    echo json_encode($result);
    exit; 
}


$regions = $conn->query("SELECT * FROM regions");
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
