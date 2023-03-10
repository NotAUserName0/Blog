<?php

require_once 'models/entrada.php';

class entradaController
{

    public function index()
    {
        require_once 'views/entradas/entrada.php';
    }

    public function save()
    {
        
        if (isset($_POST)) {
            $titulo = isset($_POST['titulo']) ? $_POST['titulo'] : false;
            $descripcion = isset($_POST['descripcion']) ? $_POST['descripcion'] : false;

            $errores = array();

            if (!empty($titulo) && !is_numeric($titulo) && !preg_match("/[0-9]/", $titulo)) {
                $titulo_validado = true;
            } else {
                $errores['titulo'] = "El titulo es incorrecto";
                $titulo_validado = false;
            }

            if (!empty($descripcion)) {
                $descripcion_validado = true;
            } else {
                $errores['descripcion'] = "La descripcion esta incorrecta";
                $descripcion_validado = false;
            }

            if(count($errores) == 0){
                $post = new Entrada();
                $post->setUsuarioId($_SESSION['identity']->id);
                $post->setTitulo($titulo);
                $post->setDescripcion($descripcion);
                $post->save();
                $_SESSION['entrada'] = "complete";
            }else{
                $_SESSION['entrada'] = "failed";
                if(count($errores) >= 4){
                    $_SESSION['errores'] = "general";
                }else{
                    $_SESSION['errores'] = $errores;   
                }
            }
        }else{
            $_SESSION['entrada'] = "failed";
        }
        
        if(isset($_SESSION['entrada']) && $_SESSION['entrada'] == "complete"){
            header("Location:".base_url."principal/index");
        }else{
            header("Location:".base_url."entrada/index");
        }
    }
}
