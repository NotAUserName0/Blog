<?php

class Database{
    public static function connect(){
        $db = new mysqli('localhost','root','1234','blog');
        //$db->query("SET NAMES utf8'");
        return $db;
    }
}

?>