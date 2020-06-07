<?php

/**
 * Класс функций что бы их каждый раз не переписывать
 * 
 */

class Functions
{
    static function CheckData($data, $param, $connect)
    {

        
        if(strlen($data) < 6){ //проверка длинны логина и пароля
            http_response_code(400);
            echo json_encode($result = [
                'Status' => false,
                'Message' => 'lenght data < 6',
            ]);
        }else //если все классно тогда проеряем есть ли уже такой логин в базе
        {
            $query = mysqli_query($connect,"SELECT * FROM `users` WHERE `Login`='$data'");
            $row = mysqli_num_rows($query);
            if($row > 0){
                http_response_code(400);
                echo json_encode ([
                    'Status' => false,
                    'Message' => 'login already exists'
                ]);
            }else{
               return true;
            }
        }
    } 
}