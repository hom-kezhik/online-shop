<?php
session_start();
if(!isset(  $_SESSION['user_id'])) {
    header("Location: ./handle_login.php");
    exit;
}
$pdo = new PDO('pgsql:host=db; port=5432; dbname=mydb1', 'user', 'pwd');
$stmt = $pdo->prepare("SELECT name, email FROM users WHERE id = :id");
$stmt->execute(['id' => $_SESSION['user_id']]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);
require_once "./profile_form.php";