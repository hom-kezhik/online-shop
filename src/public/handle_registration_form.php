<?php
print_r($_GET);
if (!empty($_GET)) {
    $name = (string)$_GET["name"];
    $email = (string)$_GET["email"];
    $password = $_GET["psw"];
    $passwordRep = $_GET["psw-repeat"];
    $errors = [];
    if (strlen($name) < 2) {
        $errors[] = "Имя должно иметь больше 2 символов <br>";
    }
    if (strlen($email) < 3) {
        $errors[] = "email должно иметь больше 3 символов <br>";
    }
    if (strlen($password) < 6) {
        $errors[] = "пароль должен иметь больше 6 символов <br>";
    }
    if ($password != $passwordRep) {
        $errors[] = "Пароли должны совпадать <br>";
    }
    if (empty($errors)) {
        try {
            $pdo = new PDO('pgsql:host=db; port=5432; dbname=mydb1', 'user', 'pwd');
            $pdo->exec("INSERT INTO users (name, email, password) VALUES ('$name', '$email', '$password')");
            echo "<br>";
            $stmt = $pdo->query("SELECT * FROM users WHERE email = '$email'");
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($user) {
                echo "Пользователь успешно зарегистрирован!<br>";
                echo "Имя: " . $user['name'] . "<br>";
                echo "Email: " . $user['email'];
            }
        } catch (PDOException $e) {
            echo "Ошибка базы данных: " . $e->getMessage();
        }
    } else {
        // Отображение ошибок
        foreach ($errors as $error) {
            echo "<p style='color:red;'>$error</p>";
        }
    }
}
