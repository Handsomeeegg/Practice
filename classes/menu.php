<?php
class Menu
{
    private $menu;
    public function __construct($menuArray)
    {$this->menu = $menuArray;}

    public function htmlMenu(){
        $html = '<ul>';
        foreach($this->menu as $key => $value){
            $html .= "<li><a href=" . $key . ">" . $value . "</a></li>";
        }
        $html .= '</ul>';
        return $html;
    }
}








