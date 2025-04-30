<?php
session_start();
function getUserCredentials() {
    if(isset($_POST['username'])) {
        $username = $_POST["username"];
        if (empty($username)) {
            echo "Username cannot be empty";
            exit; // остановка выполнения при ошибке
        }
    } else {
        $username = false;
    }

    if(isset($_POST['password'])) {
        $password = $_POST["password"];
        if (empty($password)) {
            echo "Password cannot be empty";
            exit;
        }
    } else {
        $password = false;
    }

    return ['username' => $username, 'password' => $password];
}

// Вызов функции для получения данных
$credentials = getUserCredentials();
$username = $credentials['username'];
$password = $credentials['password'];
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

        $_SESSION['user_id'] = $user['id'];
        header("Location: ./catalog.php");
    } else {
        $errors ['username'] = 'username or password';
    }
}
require_once './login_form.php';