<?php


class Response{

    public $user;
    public function __construct($user){
        $this->user = $user;
         if (isset($_GET['token'])) {
            $this->user->token = $_GET['token'];
            $this->user->identity();
            
            if ($this->user->isGuest) {
                $this->redirect('index.php');
            }
        }
    }

    public function getLink($url, $params = []){
        if (!$this->user->isGuest && !isset($params['token'])) {
            $params['token'] = $this->user->token;
        }
        $query = http_build_query($params);
        if ($query) {
            $str_split = strpos($url, '?') === false ? '?' : '&';
            $url .= $str_split . $query;
        }

        return $url;

    }

    public function redirect(string $url, array $params = []): void
{
  
    $fullUrl = $this->getLink($url, $params);
    
    $host = $_SERVER['HTTP_HOST'];
    $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https' : 'http';

    header("Location: $protocol://$host/$fullUrl");
    exit;
}

}