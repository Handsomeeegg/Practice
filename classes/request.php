<?php
class Request
{
    public $isGet;
    public $isPost;

    
    public function __construct()
    {
        if ($requestMethod = $_SERVER["REQUEST_METHOD"] == 'POST') {
            $this->isPost = $requestMethod;
        } else {
            $this->isGet = $requestMethod;
        }
    }


    public function tidyParam($param)
    {
        return strip_tags(trim($param));
    }


    public function tidyArray(array $param)
    {
        $cleaned = [];
        foreach ($param as $key => $value) {
            if($cleaned[$key] = is_array($value)){
                $this->tidyArray($value);
            } else {
                $this->tidyParam($value);
            }
        }
        return $cleaned;
    }
    public function post($param){
        if(isset($param)){
            if(isset($_POST[$param])){
                return $this->tidyParam($param);
            } else {
                return null;
            }
        } else {
            return $this->tidyArray($_POST);
        }
    }
    public function get($param){
        if(isset($param)){
            if(isset($_GET[$param])){
                return $this->tidyParam($param);
            } else {
                return null;
            }
        } else {
            return $this->tidyArray($_GET);
        }
    }
    public function host(){
        return $this->$_SERVER['SERVER_NAME'];
    }
    public function token(){
        return $this->get('token');
    }
};
