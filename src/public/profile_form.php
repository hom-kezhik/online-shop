 <!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8" />
    <title>Профиль пользователя</title>
</head>
<body>
<form action="/profile" method="POST">
    <div class="profile-container">
        <div class="profile-item" >
            <div class="label">Имя</div>
            <div class="value" id="name"><?php  echo $user['name']; ?></div>
        </div>
        <div class="profile-item">
            <div class="label">Эл. почта</div>
            <div class="value" id="email"><?php echo $user['email']; ?></div>
        </div>
        <button class="edit-button" onclick="window.location.href='/profile_edit'; return false;">Редактировать профиль</button>
    </div>
    <style>
        .profile-container {
            max-width: 400px;
            margin: 50px auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 8px;
            font-family: Arial, sans-serif;
        }
        .profile-item {
            margin-bottom: 15px;
        }
        .label {
            font-weight: bold;
            display: block;
            margin-bottom: 5px;
        }
        .value {
            margin-bottom: 10px;
        }
        .edit-button {
            padding: 8px 16px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        .edit-button:hover {
            background-color: #0056b3;
        }
    </style>
</form>
</body>
</html>