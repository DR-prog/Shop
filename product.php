<!DOCTYPE html>
<html>
<head>
    <title>Товар</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<?php
require_once 'DatabaseConnection.php';

// Создание объекта класса DatabaseConnection
$dbConnection = new DatabaseConnection("localhost", "root", "root", "shop");

// Подключение к базе данных
$dbConnection->connect();

// Получение id товара из URL-параметра
$product_id = $_GET['id'];

// Получение информации о товаре из базы данных
$query = "SELECT * FROM products WHERE id = $product_id";
$result = $dbConnection->query($query);
$row = mysqli_fetch_assoc($result);

// Вывод информации о товаре
echo '<div class="product-container">';
echo '<img src="' . $row['image'] . '" alt="' . $row['name'] . '" class="product-image">';
echo '<h2 class="product-title">' . $row['name'] . '</h2>';
echo '<p class="product-price">Цена: ' . $row['price'] . '</p>';

// Форма для оставления отзыва
echo '<div class="reviews-container">';
echo '<h3>Отзывы:</h3>';
echo '<form class="review-form" method="POST" action="submit_review.php">';
echo '<label>Ваше имя:</label>';
echo '<input type="text" name="name">';
echo '<label>Рейтинг:</label>';
echo '<input type="number" name="rating" min="1" max="5">';
echo '<label>Отзыв:</label>';
echo '<textarea name="comment"></textarea>';
echo '<input type="hidden" name="product_id" value="' . $product_id . '">';
echo '<input type="submit" value="Оставить отзыв">';
echo '</form>';

// Вывод списка отзывов
$query_reviews = "SELECT * FROM reviews WHERE product_id = $product_id";
$result_reviews = $dbConnection->query($query_reviews);
while ($row_review = mysqli_fetch_assoc($result_reviews)) {
    echo '<div class="review">';
    echo '<p class="author">' . $row_review['name'] . '</p>';
    echo '<p class="date">' . $row_review['date'] . '</p>';
    echo '<p class="rating">Рейтинг: ' . $row_review['rating'] . '</p>';
    echo '<p>' . $row_review['comment'] . '</p>';
    echo '</div>';
}

echo '</div>'; // Закрытие контейнера отзывов
echo '</div>'; // Закрытие контейнера товара

// Закрытие соединения с базой данных
$dbConnection->close();
?>
<script src="script.js"></script>
</body>
</html>