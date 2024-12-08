function calculatePrice() {
    const weight = parseFloat(document.getElementById('weight').value);
    const distance = parseFloat(document.getElementById('distance').value);
    
    const deliveryTime = document.getElementById('deliveryTime').value;
    const urgency = document.getElementById('urgency').value;

    let basePrice = 10; // Базовая цена

    // Расчет цены на основе веса и расстояния
    const weightPrice = weight * 2; // Цена за кг
    const distancePrice = distance * 1; // Цена за км

    let totalPrice = basePrice + weightPrice + distancePrice;

    // Увеличение цены в зависимости от времени и срочности
    if (deliveryTime === 'evening') {
        totalPrice += 5; // Доплата за вечернюю доставку
    }

    if (urgency === 'urgent') {
        totalPrice += 10; // Доплата за срочную доставку
    }

    document.getElementById('result').innerText = 'Итоговая стоимость:' + totalPrice.toFixed(2) + 'руб.';
}
