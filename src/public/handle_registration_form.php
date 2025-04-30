<?php
function validateUserData(array $postData): array {
    $errors = [];

    if (isset($postData["name"])) {
        $name = $postData["name"];
        if (strlen($name) < 2) {
            $errors['name'] = "Имя должно иметь больше 2 символов";
        }
    } else {
        $errors['name'] = 'Имя должно быть заполнено';
    }

    if (isset($postData["email"])) {
        $email = $postData["email"];
        if (strlen($email) < 3) {
            $errors['email'] = "email должно иметь больше 3 символов";
        } elseif (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
            $errors['email'] = "email некорректный";
        }
    } else {
        $errors['email'] = 'email должно быть заполнено';
    }

    if (isset($postData["psw"])) {
        $password = $postData["psw"];
        if (strlen($password) < 2) {
            $errors['psw'] = "Пароль должен иметь больше 2 символов";
        }
    } else {
        $errors['psw'] = 'Пароль должен быть заполнен';
    }

    if (isset($postData["psw-rep"])) {
        $passwordRep = $postData["psw-rep"];
        if ($password != $passwordRep) {
            $errors['psw-rep'] = "Пароли должны совпадать";
        }
    } else {
        $errors['psw-rep'] = "Повторный пароль должен быть заполнен";
    }

    return $errors;
}

// Использование функции
$errors = validateUserData($_POST);
if (empty($errors)) {
    $pdo = new PDO('pgsql:host=db; port=5432; dbname=mydb1', 'user', 'pwd');
    $name = $_POST["name"];
    $email = $_POST["email"];
    $password = $_POST["psw"];
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
?>













