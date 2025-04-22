<?php
$errors = [];
if (isset($_POST["name"])) {
    $name = $_POST["name"];
    if (strlen($name) < 2) {
        $errors['name'] = "Имя должно иметь больше 2 символов";
    }
}else{
        $errors['name'] = 'Имя должно быть заполнено';
    }
if (isset($_POST["email"])) {
    $email = $_POST["email"];
    if (strlen($email) < 3) {
        $errors['email'] = "email должно иметь больше 3 символов";
    } elseif (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
        $errors['email'] = "email некорректный";
    }
}else {
    $errors['email'] = 'email должно быть заполнено';
      }
if (isset($_POST["psw"])) {
    $password = $_POST["psw"];
    if (strlen($password) < 2) {
        $errors['psw'] = "Пароль должен иметь больше 2 символов";
    }
} else {
    $errors['psw'] = 'Пароль должен быть заполнен';
}
if (isset($_POST["psw-rep"])) {
    $passwordRep = $_POST["psw-rep"];
    if ($password != $passwordRep) {
        $errors['psw-rep'] = "Пароли должны совпадать";
    }
} else {
    $errors['psw-rep'] = "Повторный пароль должен быть заполнен";
}
if(empty($errors)) {
    $pdo = new PDO('pgsql:host=db; port=5432; dbname=mydb1', 'user', 'pwd');

    $password = password_hash($password, PASSWORD_DEFAULT);

    $stmt = $pdo->prepare("INSERT INTO users (name, email, password) VALUES (:name, :email, :password)");
    $stmt->execute(['name' => $name, 'email' => $email, 'password' => $password]);

    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = :email");
    $stmt->execute(['email' => $email]);
    $data = $stmt->fetch();
    print_r($data);
}
require_once './registration_form.php'
?>













