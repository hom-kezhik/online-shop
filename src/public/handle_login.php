<?php
function validate(array $data): array
{
    $errors = [];

    if (!isset($data["username"]))
    {
        $errors["username"] = "Поле username обязательно для заполнения!";
    }
    if (!isset($data["password"]))
    {
       $errors["password"] = "Поле password обязательно для заполнения!";
    }
    return $errors;
}

// Использование функции
$errors = validate($_POST);
if (empty($errors))
{
    $username = $_POST['username'];
    $password = $_POST['password'];
    $pdo = new PDO('pgsql:host=db; port=5432; dbname=mydb1', 'user', 'pwd');
    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = :email");
    $stmt->execute(['email' => $username]);
    $user = $stmt->fetch();
    $errors = [];
    if ($user === false)
    {
        $errors ['username'] = 'Логин или пароль указан неверно';
    } else
    {
        $passwordDB = $user['password'];
        if (password_verify($password, $passwordDB))
        {
            session_start();
            $_SESSION['user_id'] = $user['id'];
            header("Location: ./catalog.php");
        } else
        {
            $errors ['username'] = 'Логин или пароль указан неверно';
        }
    }
}

require_once './login_form.php';