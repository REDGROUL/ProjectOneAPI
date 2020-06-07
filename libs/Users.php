<?php
/**
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
        if(strlen($pass)>5 && $res = $this->Functions::CheckData($login,'', $db->Connect()) == true){
            $query = mysqli_query($db->Connect(),"INSERT INTO `users` (`Login`, `Password`) VALUES ('$login', '$pass')");
            http_response_code(201);
            echo json_encode($result = [
                'status'=>true,
                'Message'=>'user created'
            ]);
        }else{
            echo json_encode([
                'status'=>'false',
                'message'=>'lenght pass < 6'
            ]);
        }
    }

    /**
     * удаление пользователя. Параметры: id пользователя; временное решение
     */
    function DeleteUser($id)
    {
        $db = new DBConnect();
        $query = mysqli_query($db->Connect(),"SELECT * FROM `users` WHERE `Id`='$id'");
        if(mysqli_num_rows($query)>0)
        {
            mysqli_query($db->Connect(),"DELETE FROM `users` WHERE `Id` = '$id'");
            echo json_encode( [
                "status" => true,
                "message" => 'user deleted'
            ]);
        }else{
            echo json_encode([
                "status" => false,
                "message" => 'user nt found'
            ]);
        }
    }
}