<?php

$pdo = new PDO('pgsql:host=db; port=5432; dbname=mydb1', 'user', 'pwd');

$stmt = $pdo->query("SELECT * FROM products");
$products = $stmt->fetchAll();
require_once './catalog_page.php';
?>



