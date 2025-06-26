<?php 
include_once __DIR__ . "/init.php";

$user = new User($RequestUnit, $sqlUser);
$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $user->login = trim($_POST['login'] ?? '');
    $user->password = $_POST['password'] ?? '';

    $validationFailed = $user->validateLogin();
    if ($validationFailed) {

        if (!empty($user->login_error)) {
            $errors['login'] = $user->login_error;
        }
        if (!empty($user->password_error)) {
            $errors['password'] = $user->password_error;
        }
    } else {

        if ($user->login()) {
            header("Location: /practic_php/index.php?token=" . urlencode($user->token));
            exit;
        } else {
            if (!empty($user->validation_login)) {
                $errors['login'] = $user->login_error;
            }
            if (!empty($user->validation_password)) {
                $errors['password'] = $user->password_error;
            }
            if (empty($errors)) {
                $errors['login'] = 'Неверный логин или пароль';
            }
        }
    }
}