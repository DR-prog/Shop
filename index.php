<!DOCTYPE html>
<html>
<head>
    <title>Товары</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<?php
require_once 'DatabaseConnection.php';

// Создание объекта класса DatabaseConnection
$dbConnection = new DatabaseConnection("localhost", "root", "root", "shop");

// Подключение к базе данных
$dbConnection->connect();

// Получение товаров из базы данных
$query = "SELECT * FROM products";
$result = $dbConnection->query($query);

echo '<div class="product-list">';
while ($row = mysqli_fetch_assoc($result)) {
    echo '<div class="product-tile">';
    echo '<a href="product.php?id=' . $row['id'] . '">';
    echo '<img src="' . $row['image'] . '" alt="' . $row['name'] . '">';
    echo '<h3>' . $row['name'] . '</h3>';
    echo '<p>Цена: ' . $row['price'] . '</p>';
    echo '</a>';
    echo '</div>';
}
echo '</div>';

// Закрытие соединения с базой данных
$dbConnection->close();
?>
<script src="script.js"></script>
</body>
</html>