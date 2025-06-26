<?php
class MySql extends mysqli
{
    public $isConnected = false;
    public function __construct(array $primaluser) {
        $serverName = $primaluser["serverName"];
        $login = $primaluser["login"];
        $password = $primaluser["password"];
        $tableName = $primaluser["tableName"];
        $port = $primaluser["port"];
        $charset = $primaluser["charset"];

        parent::__construct($serverName, $login, $password, $tableName, $port, $charset);

        $this->isConnected = !$this->connect_error;
    }
    public function request(String $query)
    {
        if($this->isConnected){
            return $this->query($query)->fetch_assoc();
        }
    }
    public function unique(String $tableName, String $searchInput, $searchValue){
        return "SELECT * FROM $tableName WHERE $searchInput = $searchValue";
    }