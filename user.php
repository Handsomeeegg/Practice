<?php
class User extends Request
{
    public $tableName = 'user';

    public $name = null;
    public $surName = null;
    public $patronymic = null;
    public $login = null;
    public $email = null;

    public $id = null;
    public $password = null;
    public $password_repeat = null;
    public $role = 'guest';
    public $token = null;

    public $login_admin = 'admin';
    public $password_admin = 123;

    public $isGuest = true;
    public $isAdmin = false;

    private $name_validate_error = null;
    private $surName_validate_error = null;
    private $patronymic_validate_error = null;
    private $login_validate_error = null;
    private $email_validate_error = null;
    private $password_validate_error = null;
    private $password_repeat_validate_error = null;


    public $request;
    public $mySql;
    public function __construct($request, $mySql)
    {
        $this->request = $request;
        $this->mySql = $mySql;
    }
    public function load($userData)
    {
        foreach ($userData as $key => $value) {
            if (property_exists($this, $key)) {
                $this->$key = $value;
            }
        }
        $this->isAdmin = $this->isAdmin();
    }
    public function validateRegister()
    {
        $result = false;
        foreach (get_object_vars($this) as $key => $value) {
            $this->tidyParam(($key));
            if (str_ends_with($key, '_error')) {
                return true;
            }
        }
        $touch = ['patronymic', 'id', 'token'];

        foreach ($filterGetVars as $key => $value) {
            $fieldName = str_replace("_error", "", $key);
            if (in_array($fieldName, $touch)) {
                continue;
            }
            if (property_exists($this, $fieldName) && empty($this->$fieldName)) {
                $this->$key = "поле (" . $fieldName . ") является пустым";
                $result = true;
            }
        }
        if ($this->password !== $this->password_repeat) {
            $this->password_repeat_error = "пароль повторен неправильно";
            $result = true;
        }
        if ( $this->mysql->checkUnique('user', 'login', $this->login)) {
            $this->login_error = "логин уже занят";
            $result = true;
        }

        if ($this->mysql->checkUnique('user', 'email', $this->email)) {
            $this->email_error = "email уже занят";
            $result = true;
        }

        return $result;
    }
    public function validateLogin()
    {
        $result = false;
        if (empty($this->login)) {
            $this->login_error = "логин не может быть пустым";
            $result = true;
        }
        if (empty($this->password)) {
            $this->password_error = "пароль не может быть пустым";
            $result = true;
        }
        return $result;
    }

    public function login()
    {
        if ($this->validatelogin()) {
            return false;
        }

        $sql = "SELECT * FROM {$this->tableUser} WHERE login = '{$this->login}' LIMIT 1";
        $result = $this->mysql->query($sql);

        if (!$result || $result->num_rows === 0) {
            $this->login_error = "Пользователь не найден";
            return false;
        }

        $user_data = $result->fetch_assoc();
        if (!password_verify($this->password, $user_data['password'])) {
            $this->password_error = "неверный пароль";
            return false;
        }

        $this->load($user_data);
        $this->isGuest = false;
        $this->token = bin2hex(random_bytes(16));
        $this->isAdmin = $this->isAdmin();
        if($this->isAdmin === false){
            $this->role = "user";
        }

        $sqlUpdate = "UPDATE {$this->tableUser} SET token = '{$this->token}' WHERE id = {$this->id}";
        $this->mysql->query($sqlUpdate);
        return true;
    }
    public function identity()
    {
        if (empty($this->token)) {
            $this->isGuest = true;
            return false;
        }

        $sql = "SELECT * FROM {$this->tableUser} WHERE token = '{$this->token}' LIMIT 1";
        $result = $this->mysql->query($sql);

        if (!$result || $result->num_rows === 0) {
            $this->isGuest = true;
            return false;
        }

        $userData = $result->fetch_assoc();
        $this->load($userData);
        $this->isGuest = false;
        return true;
    }

    public function isAdmin()
    {
        if($this->login == $this->login_admin){
             $this->role = 'admin';
            return true;
        }else{
            return false;
        }
    }

    public function logout()
    {
        if ($this->isGuest) {
            return;
        }

        $sqlUpdate = "UPDATE {$this->tableUser} SET token = NULL WHERE id = {$this->id}";
        $this->mysql->query($sqlUpdate);

        $Properties = ['request', 'mysql', 'isGuest', 'isAdmin'];
        foreach (get_object_vars($this) as $key => $value) {
            if (!in_array($key, $Properties)) {
                $this->$key = null;
            }
        }
        $this->isGuest = true;
        $this->isAdmin = false;
    }
    public function isBlocked(): bool
    {
        $sql = "SELECT date_block FROM bun WHERE id_user = {$this->id} LIMIT 1";
        $result = $this->mysql->query($sql);
        if (!$result || $result->num_rows === 0) {
            return false;
        }
        $row = $result->fetch_assoc();

        if (is_null($row['date_block'])) {
            return true;
        }

        $now = date('Y-m-d H:i:s');
        return $now <= $row['date_block'];

    }


    public function blockTemporarily(int $userId, string $dateBlock): bool
{
    $createdAt = date('Y-m-d H:i:s');

    $sql = "INSERT INTO bun (id_user, date_block, created_at) VALUES ($userId, '$dateBlock', '$createdAt')
            ON DUPLICATE KEY UPDATE date_block = '$dateBlock', created_at = '$createdAt'";
    $result = $this->mysql->query($sql);
    echo "Ошибка: " . $this->mysql->error;

    if (!$result) {
        echo "Ошибка: " . $this->mysql->error;

        error_log("SQL error: " . $this->mysql->error);
        return false;
    }
    return true;
}

    public function blockPermanently(int $userId): bool
    {
        $createdAt = date('Y-m-d H:i:s');

        $sql = "INSERT INTO bun (id_user, date_block, created_at)
                VALUES ($userId, NULL, '$createdAt')
                ON DUPLICATE KEY UPDATE
                    date_block = NULL,
                    created_at = '$createdAt'";

        $check = $this->mysql->query($sql);

        $postsResult = $this->mysql->query("SELECT id FROM posts WHERE user_id = $userId");

        if ($postsResult && $postsResult->num_rows > 0) {
            while ($row = $postsResult->fetch_assoc()) {
                $postId = (int) $row['id'];
                $this->mysql->query("DELETE FROM comment WHERE post_id = $postId");
                $this->mysql->query("DELETE FROM posts WHERE id = $postId");
            }
        }

        return $check;
    }









}
