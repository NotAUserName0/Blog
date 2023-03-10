<?php

function controller_autoload($clase_name){
    include 'controllers/'.$clase_name.'.php';
}

spl_autoload_register('controller_autoload');

?>