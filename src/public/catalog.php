<?php
session_start();
if(!isset(  $_SESSION['user_id'])) {
    header("Location: ./handle_login.php");
}

$pdo = new PDO('pgsql:host=db; port=5432; dbname=mydb1', 'user', 'pwd');

$stmt = $pdo->query("SELECT * FROM products");
$products = $stmt->fetchAll();
require_once './catalog_page.php';
?>



