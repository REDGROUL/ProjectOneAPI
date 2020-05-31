<?php
class Posts
{
    function GetPost($id)
    {
        $db = new DBConnect;
        

        $query = mysqli_query($db->Connect(), "SELECT * FROM `posts` WHERE `id` = '$id'");
        echo $result = json_encode(mysqli_fetch_assoc($query));

    }
}