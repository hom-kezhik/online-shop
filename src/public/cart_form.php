<!DOCTYPE html>
<html lang="ru">
<h1>Моя корзина</h1>

<div id="product-list">
    <div class="product">
        <img src="https://via.placeholder.com/150" alt="Товар 1" />
        <p>Товар 1</p>
        <p>Цена: $5</p>
        <button data-name="Товар 1" data-price="5" class="add-btn">Добавить в корзину</button>
    </div>
    <div class="product">
        <img src="https://via.placeholder.com/150" alt="Товар 2" />
        <p>Товар 2</p>
        <p>Цена: $10</p>
        <button data-name="Товар 2" data-price="10" class="add-btn">Добавить в корзину</button>
    </div>
</div>

<h2>Корзина</h2>

<div id="cart"></div>
<div id="total">Общая сумма: $0</div>

</body>
</html>
<style>
    body {
        font-family: Arial, sans-serif;
        margin: 20px;
        background-color: #f8f8f8;
    }

    h1 {
        text-align: center;
        margin-bottom: 20px;
    }

    #product-list {
        display: flex;
        gap: 20px;
        justify-content: center;
        margin-bottom: 30px;
    }

    .product {
        border: 1px solid #ccc;
        padding: 10px;
        width: 150px;
        background-color: #fff;
        text-align: center;
        border-radius: 4px;
    }

    .product img {
        max-width: 100%;
        height: auto;
        margin-bottom: 10px;
    }

    button {
        margin-top: 10px;
        padding: 5px 10px;
        cursor: pointer;
        background-color: #007bff;
        border: none;
        color: white;
        border-radius: 3px;
    }

    button:hover {
        background-color: #0056b3;
    }

    #cart {
        max-width: 600px;
        margin: 0 auto;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 10px;
    }

    th, td {
        border: 1px solid #ccc;
        padding: 8px;
    }

    th {
        background-color: #f1f1f1;
        text-align: center;
    }

    #total {
        text-align: right;
        font-weight: bold;
        font-size: 1.1em;
        margin-right: 20px;
    }
</style>