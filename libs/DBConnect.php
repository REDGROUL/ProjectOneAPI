<?php
/**
 * Класс подключения к базе данных
 * 
 */
class DBConnect {   
    
    /**
     * функция подключения, позволяет подключиться и после выполнения
     * разорвать подключение
     */
    public static function Connect()
    {   
        $host = 'localhost';
        $db = 'projectone';
        $usr = 'root';
        $pass = '';
        $connection = @mysqli_connect($host,$usr,$pass,$db);
        return $connection;

        connect_close($connection);
    }
}