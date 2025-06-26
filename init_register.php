<?php 
include_once __DIR__ . "/init.php";

$user = new User($RequestUnit, $sqlUser);
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $user->load($_POST);
    $haserror = $user->validateRegister();
    if (!$haserror) {
            if ($user->save()) {
                $response->redirect('practic_php/index.php');
            } else {
                // $errors[]= 'ошибка при сохранении пользователя в базе данных';
            }
    }
}