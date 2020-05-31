<?php
/**
 * Перенаправляет данные в нужные классы
 */
class Router
{
    static function start()
    {
        $method = $_SERVER['REQUEST_METHOD'];
        $usr = new Users();
        switch ($method)
        {
            case 'POST':
                
                $login = $_POST['login'];
                $pass = $_POST['pass'];
                $usr->RegUser($login,$pass);
                
            break;
            case 'GET':
                $param = $_GET['q'];
                $data = explode('/',$param);
                if($data[0] == 'user'){
                    
                    $usr->GetUser($data[1]);
                }
            break;
        }
    }
}
