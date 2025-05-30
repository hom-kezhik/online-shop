<?php
session_start();
$user_id = $_SESSION['user_id'];

// Получение текущих данных пользователя
$pdo = new PDO('pgsql:host=db; port=5432; dbname=mydb1', 'user', 'pwd');
$stmt = $pdo->prepare("SELECT name, email FROM users WHERE id = :id");
$stmt->execute([':id' => $user_id]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if (isset($_POST['name'], $_POST['email'], $_POST['psw'], $_POST['psw-rep'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['psw'];
    $passwordRe = $_POST['psw-rep'];

    $errors = [];

    // Проверка имени
    if (strlen($name) < 2) {
    $errors['name'] = "Имя должно иметь больше 2 символов";
}

// Проверка email
if (strlen($email) < 3) {
$errors['email'] = "email должно иметь больше 3 символов";
} elseif (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
$errors['email'] = "Некорректный email";
} else {
    // Проверка уникальности email
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM users WHERE email = :email AND id != :id");
    $stmt->execute([':email' => $email, ':id' => $user_id]);
    if ($stmt->fetchColumn() > 0) {
        $errors['email'] = "Этот Email уже зарегистрирован!";
    }
}

// Проверка пароля
if (strlen($password) < 2) {
    $errors['psw'] = "Пароль должен иметь больше 2 символов";
}

// Проверка совпадения паролей
if ($password !== $passwordRe) {
    $errors['psw-rep'] = "Пароли должны совпадать";
}

if (empty($errors)) {
    // Обновление имени и email
    $stmt = $pdo->prepare("UPDATE users SET name = :name, email = :email WHERE id = :id");
    $stmt->execute([':name' => $name, ':email' => $email, ':id' => $user_id]);

    // Обновление пароля, если он предоставлен
    if (!empty($password)) {
    $hashed = password_hash($password, PASSWORD_DEFAULT);
    $stmt = $pdo->prepare("UPDATE users SET password = :password WHERE id = :id");
    $stmt->execute([':password' => $hashed, ':id' => $user_id]);
}

// После успешного обновления делайте редирект
header('Location: /profile');
exit();
} else {
    foreach ($errors as $msg) {
        echo "<p>$msg</p>";
    }
}
}
require_once './profile_edit_form.php';
?>