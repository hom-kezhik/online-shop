<?php
if(isset($_POST['username'])){
    $username = $_POST["username"];
    if(empty($username)) {
        echo "Username cannot be empty";
    }
} else {
    $username = false; // Обеспечиваем инициализацию переменной
}
if(isset($_POST['password'])){
    $password = $_POST["password"];
    if(empty($password)) {
        echo "Password cannot be empty";
    }
} else {
    $password = false; // Обеспечиваем инициализацию переменной
}
$pdo = new PDO('pgsql:host=db; port=5432; dbname=mydb1', 'user', 'pwd');
$stmt = $pdo->prepare("SELECT * FROM users WHERE email = :email");
$stmt->execute(['email' => $username]);
$user = $stmt->fetch();
$errors = [];
if ($user === false) {
    $errors ['username'] = 'username or password incorrect';
} else {
    $passwordDB = $user['password'];
    if (password_verify($password, $passwordDB)) {
        setcookie('user_id', $user['id']);
        header("Location: ./catalog.php");
    } else {
        $errors ['username'] = 'username or password';
    }
}
require_once './login_form.php';