<?php

$requestUri = $_SERVER['REQUEST_URI'];
$requestMethod = $_SERVER['REQUEST_METHOD'];

if($requestUri === '/registration') {
    if ($requestMethod === 'GET') {
        require_once './registration_form.php';
    } elseif ($requestMethod === 'POST') {
        require_once './handle_registration.php';
    }else{
        echo "$requestMethod для адреса $requestUri не поддерживается";
    }
}elseif ($requestUri === '/login') {
    if ($requestMethod === 'GET') {
        require_once './login_form.php';
    }elseif ($requestMethod === 'POST') {
        require_once './handle_login.php';
    }else{
        echo "$requestMethod для адреса $requestUri не поддерживается";
    }
}elseif ($requestUri === '/catalog') {
    if ($requestMethod === 'GET') {
        require_once './catalog.php';
    }elseif ($requestMethod === 'POST') {
        require_once './catalog_page.php';
    }else{
        echo "$requestMethod для адреса $requestUri не поддерживается";
    }
}elseif ($requestUri === '/profile') {
    if ($requestMethod === 'GET') {
        require_once './handle_profile.php';
    }elseif ($requestMethod === 'POST') {
        require_once './profile_form.php';
    }else{
        echo "$requestMethod для адреса $requestUri не поддерживается";
    }
}elseif ($requestUri === '/profile_edit') {
    if ($requestMethod === 'GET') {
        require_once './profile_edit_form.php';
    }elseif ($requestMethod === 'POST') {
        require_once './handle_profile_edit.php';
    }else{
        echo "$requestMethod для адреса $requestUri не поддерживается";
    }
}elseif ($requestUri === '/add-product') {
    if ($requestMethod === 'GET') {
        require_once './add_product_form.php';
    }elseif ($requestMethod === 'POST') {
        require_once './handle_add_product.php';
    }
}elseif ($requestUri === '/cart') {
    if ($requestMethod === 'GET') {
        require_once './cart_form.php';
    }
}
else{
    http_response_code(404);
    require_once './404.php';
}