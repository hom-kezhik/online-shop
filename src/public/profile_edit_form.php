<?php

session_start();
if(isset($_SESSION['user_id'])){
    $user_id = $_SESSION['user_id'];
    $pdo = new PDO('pgsql:host=db; port=5432; dbname=mydb1', 'user', 'pwd');
    $stmt = $pdo->query("SELECT * FROM users WHERE id = '$user_id'");
    $user = $stmt->fetch();
}else{
    header("Location: /login");
}
?>
<form action="/profile_edit" method="POST">
    <section id="account">
        <fieldset>
            <legend>Account:</legend>

            <label>Username:</label>
            <?php if (isset($errors['username'])): ?>
            <label style="accent-color: #0a0a0a"> <?php echo $errors['name']?></label>
            <?php endif; ?>
            <input type="text" name="name" id = "name"  value="<?php echo $user['name'] ?>"required>
            <label>Email address:</label>
            <?php if (isset($errors['email'])): ?>
            <label style="accent-color: #0a0a0a"> <?php echo $errors['email']?></label>
            <?php endif; ?>
            <input type="text" name="email" id = "email" value="<?php echo $user['email'] ?>" required>
            <label>Password:</label>
            <?php if (isset($errors['psw'])): ?>
            <label style="accent-color: #0a0a0a"><?php echo $errors['psw']?></label>
            <?php endif; ?>
            <input type="password" name="psw" id = "psw" required>
            <label>Confirm password:</label>
            <?php if (isset($errors['psw-rep'])): ?>
            <label style="accent-color: #0a0a0a"><?php echo $errors['psw-rep']?></label>
            <?php endif; ?>
            <input type="password" name="psw-rep" id = "psw-rep" required>
        </fieldset>
    </section>
    <div id="go"><button type="submit">Изменить</button></div>
</form>

<style>
    body {
        font-size: 2vh;
        font-family: sans-serif;
    }

    nav {
        display: flex;
    }

    nav a {
        margin: 0.5rem 0.25rem;
        padding: 1rem;
        background: #CCC;
        color: black;
    }

    form {
        width: 60%;
    }

    fieldset {
        margin: 2rem;
        padding: 1rem;
        border: 0;
    }

    legend {
        font-size: 1.5rem;
    }

    label {
        display: block;
        margin-top: 1rem;
    }

    section {
        display: none;
    }

    section:first-of-type {
        display: block;
    }
</style>