<?php
/***
 * Класс для работы с пользователями
 * 
 * 
 */
class Users
{
    /**
     *функция получения пользователя или пользователей в зависимости от праметра.
     * Принимает только id пользователя.
     * 
     */
    function GetUser($id)
    {
        $db = new DBConnect; //создаем экземпляр класса
        /**
         * проверяем наличие id
         */
        if($id == ''){
            $query = mysqli_query($db->Connect(),"SELECT * FROM `users`");
            while($result = mysqli_fetch_assoc($query))
            {
                $datausers[] = $result;
            }
        }
        else//если есть id
        {
            $query = mysqli_query($db->Connect(),"SELECT * FROM `users` WHERE `id`='$id'");
            $datausers[] = mysqli_fetch_assoc($query);
            if($datausers[0] == null)
            {
                http_response_code(404);//указываем http код
                $datausers[0] = [
                    "status"=>false,
                    "message"=> 'not found'
                ];
            }
        }
        echo json_encode($datausers);//выводим результат
    }

    /**
     * функция регистрация пользователя принимает Логин и пароль
     */
    function RegUser($login, $pass)
    {
        $db = new DBConnect;        
        if($res = $this->CheckData($login,$pass, $db->Connect()) == true){
            $query = mysqli_query($db->Connect(),"INSERT INTO `users` (`Login`, `Password`) VALUES ('$login', '$pass')");
            http_response_code(201);
            echo json_encode($result = [
                'status'=>true,
                'Message'=>'user created'
            ]);
        }
    }

    /**
     * Проверяет введенный логин;
     * парамертры login, password, connect;
     * возвращаемые данные bool true;
     */
    function CheckData($login, $pass, $connect)
    {
        if(strlen($login) < 6 || strlen($pass) < 6){ //проверка длинны логина и пароля
            http_response_code(400);
            echo json_encode($result = [
                'Status' => false,
                'Message' => 'lenght login or pass < 6',
            ]);
        }else //если все классно тогда проеряем есть ли уже такой логин в базе
        {
            $query = mysqli_query($connect,"SELECT * FROM `users` WHERE `Login`='$login'");
            $row = mysqli_num_rows($query);
            if($row > 0){
                http_response_code(400);
                echo json_encode ($result = [
                    'Status' => false,
                    'Message' => 'login already exists'
                ]);
            }else{
               return true;
            }
        }
    }
}