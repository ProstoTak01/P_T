<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Стоимость услуг</title>
    <link rel="stylesheet" href="style.css">
    <script src="calculator.js" defer></script> <!-- Подключаем JavaScript -->
</head>
<body>
    <header>
        <h1>Стоимость услуг</h1>
        <nav>
            <ul>
            <li><a href="index.php">Главная</a></li>
                <li><a href="partners.php">Партнеры</a></li>
                <li><a href="guarantees.php">Гарантии</a></li>
                <li><a href="pricing.php">Стоимость услуг</a></li>
                <li><a href="contact.php">Контакты</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <h2>Калькулятор стоимости доставки</h2>

        <form id="priceCalculator">
            <label for="weight">Вес посылки (кг):</label><br/>
            <input type="number" id="weight" name="weight" required value="<?php echo isset($_POST['weight']) ? htmlspecialchars($_POST['weight']) : ''; ?>"><br/><br/>

            <label for="deliveryTime">Время доставки:</label><br/>
            <select id="deliveryTime" name="deliveryTime">
                <option value="day">Дневное</option>
                <option value="evening">Вечернее</option>
            </select><br/><br/>

            <label for="distance">Расстояние (км):</label><br/>
            <input type="number" id="distance" name="distance" required value="<?php echo isset($_POST['distance']) ? htmlspecialchars($_POST['distance']) : ''; ?>"><br/><br/>

            <label for="urgency">Срочность:</label><br/>
            <select id="urgency" name="urgency">
                <option value="normal">Обычная</option>
                <option value="urgent">Срочная</option>
            </select><br/><br/>

            <button type="button" onclick="calculatePrice()">Рассчитать стоимость</button>

            <!-- Поле для отображения результата -->
            <h3 id="result"></h3>

            <!-- Скрытое поле для передачи данных при отправке формы -->
            <?php if ($_SERVER['REQUEST_METHOD'] === 'POST') : ?>
                <?php foreach ($_POST as $key => $value): ?>
                    <input type="hidden" name="<?php echo htmlspecialchars($key); ?>" value="<?php echo htmlspecialchars($value); ?>">
                <?php endforeach; ?>
            <?php endif; ?>
        </form>

        <!-- Подсказка по расчету -->
        <p>* Для расчета используйте вес, расстояние и выберите время и срочность доставки.</p>

    </main>

    <footer>
        <p>&copy; 2024 Служба курьерской доставки</p>
    </footer>

</body>
</html>
