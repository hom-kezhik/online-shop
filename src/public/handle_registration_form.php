<?php
print_r($_GET);

$name = $_GET["name"];
$email = $_GET["email"];
$password = $_GET["psw"];
$passwordRep = $_GET["psw-repeat"];

$pdo = new PDO('pgsql:host=db; port=5432; dbname=mydb1', 'user', 'pwd');

$pdo->exec("INSERT INTO users (name, email, password) VALUES ($name, $email, $password)");

//Сделать обработку формы регистрации, т.е сохранять данные из формы в таблицу users
//Вывести только что сохраненного пользователя в бд на экран
//Сделать валидацию данных