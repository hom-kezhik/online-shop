<?php
session_start();
function validateUserData(array $postData): array {
    $errors = [];

    if (isset($postData["username"])) {
        $username = $postData["username"];
        if (empty($username)) {
            $errors['username'] = 'Username cannot be empty';
        }
    } else {
        $errors['username'] = 'Username must be provided';
    }

    if (isset($postData["password"])) {
        $password = $postData["password"];
        if (empty($password)) {
            $errors['password'] = 'Password cannot be empty';
        }
    } else {
        $errors['password'] = 'Password must be provided';
    }

    return $errors;
}

// Использование функции
$errors = validateUserData($_POST);
if (empty($errors)) {
    $pdo = new PDO('pgsql:host=db; port=5432; dbname=mydb1', 'user', 'pwd');
    $username = $_POST['username'];
    $password = $_POST['password'];
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
}

require_once './login_form.php';