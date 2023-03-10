<?php

class Utils{
    public static function deleteSession($name){
        if(isset($_SESSION[$name])){
            unset($_SESSION[$name]);
        }
        return $name;
    }

    public static function errores($errores, $campo){
        $alert = '';
        if(isset($errores[$campo]) && !empty($campo)){
            $alert = "<div style='color:red'>".$errores[$campo].'</div>';
        }
        return $alert;
    }

    public static function isLogged()
    {
        if(isset($_SESSION['identity'])){
           return true;
        }else{
            return false;
        }
    }
}