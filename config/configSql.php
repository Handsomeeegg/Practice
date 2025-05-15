<?php
$primalUser =
[
    'serverName' => '127.0.0.0.1:3308',
    'login' => 'user101',
    'password' => 'pass',
    'dbName' => 'hostName',
];

$db = new MySql($primalUser);