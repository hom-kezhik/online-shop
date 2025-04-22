<?php
//$name = $_GET["name"];
//$email = $_GET["email"];
//$password = $_GET["psw"];
//$passwordRep = $_GET["psw-repeat"];

$errors = [];
if (isset($_GET["name"])) {
    $name = $_GET["name"];
    if (strlen($name) < 2) {
        $errors['name'] = "Имя должно иметь больше 2 символов";
    }
}else{
        $errors['name'] = 'Имя должно быть заполнено';
    }
if (isset($_GET["email"])) {
    $email = $_GET["email"];
    if (strlen($email) < 3) {
        $errors['email'] = "email должно иметь больше 3 символов";
    } elseif (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
        $errors['email'] = "email некорректный";
    }
}else {
    $errors['email'] = 'email должно быть заполнено';
      }
if (isset($_GET["psw"])) {
    $password = $_GET["psw"];
    if (strlen($password) < 2) {
        $errors['psw'] = "Пароль должен иметь больше 2 символов";
    }
} else {
    $errors['psw'] = 'Пароль должен быть заполнен';
}
if (isset($_GET["psw-rep"])) {
    $passwordRep = $_GET["psw-rep"];
    if ($password != $passwordRep) {
        $errors['psw-rep'] = "Пароли должны совпадать";
    }
} else {
    $errors['psw-rep'] = "Повторный пароль должен быть заполнен";
}
if(empty($errors)) {
    $pdo = new PDO('pgsql:host=db; port=5432; dbname=mydb1', 'user', 'pwd');

    $pdo->exec("INSERT INTO users (name, email, password) VALUES ('$name', '$email', '$password')");
    $stmt = $pdo->query("SELECT * FROM users ORDER BY id DESC LIMIT 1");
    $data = $stmt->fetch();
    print_r($data);
}
require_once './registration_form.php'
?>













