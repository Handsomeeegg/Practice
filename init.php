<?php 
include_once __DIR__ . "../../autoloader.php";
include_once __DIR__ . "../../config/configMenu.php";
include_once __DIR__ . "../../config/configSql.php";

$initMenu = new Menu($menuArray);
$initRequest = new Request();
$initSql = new MySql($primalUser);
$initUser = new User($initRequest, $initSql);
$initUser->load($_POST);
$initUser->validateRegister();
// $initUser->save($menuArray, $primalUser);
$initResponse = new Response($initUser);


$menuArray = array_filter($menuArray, function ($item) use ($initUser) {
    if ($initUser->isGuest) {
        // return $item['link'] !== 'logout.php' && $item['link'] !== 'users.php';
    } else {
        if (!$initUser->isAdmin) {
            return !in_array($item['link'], ['login.php', 'register.php', 'users.php']);
        }
        return !in_array($item['link'], ['login.php', 'register.php']);
    }
});
$menuArray = array_values($menuArray);
$me = new Menu($menuArray, $initResponse);
$post = new Post($initUser);