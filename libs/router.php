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

        $url = $_SERVER['REQUEST_URI'];
        $url_data = explode('/',$url);
        $DataOfQuery = $url_data[2];
        /**
         * Получаем данные из url
         */
        switch($DataOfQuery)
        {
            case 'user':
                switch($method)
                {
                    /**
                     * описание методов get, post, delete и patch для параметра user
                     */
                    case 'GET':
                        $param = $_GET['q'];
                        $data = explode('/',$param);
                        if($data[0] == 'user');
                        $usr->GetUser($data[1]);
                    
                    break;

                    case 'POST':
                        $login = $_POST['login'];
                        $pass = $_POST['pass'];
                        $usr->RegUser($login,$pass);
                    break;

                    case 'DELETE':
                        $id = $url_data[3];
                        $usr->DeleteUser($id);
                    break;

                    case 'PATCH':
                        echo 'PATH->UPDATE';
                    break;
                }
            break;

            case 'post':
                switch($method)
                {
                    /**
                     * описание методов get, post, delete и patch для параметра post
                     */
                    case 'GET':
                        echo 'GET';
                    break;

                    case 'POST':
                        echo 'POST';
                    break;

                    case 'DELETE':
                        echo 'DELETE';
                    break;

                    case 'PATCH':
                        echo 'PATH->UPDATE';
                    break;
                }
            break;
        } 
    }
}
