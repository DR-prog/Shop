<?php
require_once 'DatabaseConnection.php';

// Создание объекта класса DatabaseConnection
$dbConnection = new DatabaseConnection("localhost", "root", "root", "shop");

// Подключение к базе данных
$dbConnection->connect();

// Получение данных из POST-запроса
$product_id = $_POST['product_id'];
$rating = $_POST['rating'];
$comment = $_POST['comment'];

// Вставка отзыва в базу данных
$query = "INSERT INTO reviews (product_id, rating, comment) VALUES ($product_id, '$rating', '$comment')";
$dbConnection->query($query);

// Закрытие соединения с базой данных
$dbConnection->close();

// Перенаправление на страницу товара
header("Location: product.php?id=$product_id");
?>
