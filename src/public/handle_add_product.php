<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: /login");
    exit;
}

function validateAddProduct(array $data): array {
    $errors = [];
    if (isset($data['amount'])) {
        $amount = $data['amount'];
        if(strlen($amount) < 0) {
        $errors['amount'] = 'Количество должно быть положительным';
        }
    }else{
    $errors['amount'] = 'Количество должно быть заполнено';
    }
    if (isset($data['products_id'])) {
        $product_id = $data['products_id'];
        if(strlen($product_id) < 0) {
            $errors['products_id'] = 'id продукта должно быть положительным';
        }
    }else{
        $errors['products_id'] = 'id продукта должно быть заполнено';
    }
    return $errors;
}
$validateAddProduct = validateAddProduct($_POST);
if(empty($validateAddProduct)) {
    $products_id = $_POST['products_id'];
    $amount = $_POST['amount'];
    $user_id = $_SESSION['user_id'];

    $pdo = new PDO('pgsql:host=db; port=5432; dbname=mydb1', 'user', 'pwd');
    $stmt = $pdo->prepare("SELECT amount FROM users_products WHERE products_id = :product_id AND user_id = :user_id");
    $stmt->execute([':products_id' => $products_id, ':user_id' => $user_id]);
    $existingAmount = $stmt->fetchColumn();

    if($existingAmount !== false) {
        $newAmount = $amount + $existingAmount;
        $stmtUpdate = $pdo->prepare("UPDATE users_products SET amount = :amount WHERE products_id = :products_id");
        $stmtUpdate->execute([':amount' => $newAmount, ':product_id' => $products_id, 'user_id' => $user_id]);
    }else{
        $stmtInsert = $pdo->prepare("INSERT INTO users_products (products_id, amount, users_id) VALUES (:products_id, :amount, :users_id)");
        $stmtInsert->execute([':product_id' => $products_id, ':amount' => $amount, ':users_id' => $user_id]);
    }
}
require_once "./add_product_form.php";