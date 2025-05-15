<?php 
include_once __DIR__ . "/autoloader.php";
include_once __DIR__ . "/config/configMenu.php";

$initMenu = new Menu($menuArray);
$initRequest = new Request();