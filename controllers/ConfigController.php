<?php

require_once 'models/usuario.php';

class configController
{
    public function index()
    {
        if (!Utils::isLogged()) {
            header("Location:" . base_url . "user/index");
        }
        require_once 'views/perfil/config.php';
    }

    public function save()
    {
        if (!Utils::isLogged()) {
            header("Location:" . base_url . "user/index");
        }

        if (isset($_POST)) {
            $usuario = isset($_POST['usuario']) ? $_POST['usuario'] : false;
            $email = isset($_POST['email']) ? $_POST['email'] : false;
            $password = isset($_POST['password']) ? $_POST['password'] : false;

            $errores = array();

            if (!empty($usuario)) {
                $usuario_validado = true;
            } else {
                $errores['usuario'] = "El usuario no es valido";
                $usuario_validado = false;
            }

            if (!empty($email) && filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $email_validado = true;
            } else {
                $errores['email'] = "El email no es valido";
                $email_validado = false;
            }

            //convertir img
            if (isset($_FILES['img']['tmp_name']) && !empty($_FILES['img']['tmp_name'])) {
                $image = $_FILES['img']['tmp_name'];
                $imgContent = addslashes(file_get_contents($image));
                $newImage = true;
            } else {
                $newImage = false;
            }


            if (count($errores) == 0) {
                $usr = new Usuario();
                $usr->setId($_SESSION['identity']->id);
                $usr->setUsuario($usuario);
                $usr->setEmail($email);

                if ($password == $_SESSION['identity']->pass) {
                    $metodo = 1;
                    echo "Contraseña sin cambios";

                    $usr->setPasswordUpdate($password);
                    var_dump($usr->getPasswordUpdate());
                    
                } else {
                    echo "Contraseña con cambios";
                    $metodo = 2;

                    $usr->setPassword($password);
                    var_dump($usr->getPassword());
                    
                }
                if ($newImage) {
                    $usr->setImagen($imgContent);
                } else {
                    $imgContent = addslashes($_SESSION['identity']->img);
                    $usr->setImagen($imgContent);
                }
                $usr->update($metodo);
                $_SESSION['register'] = "complete";
            } else {
                $_SESSION['register'] = "failed";


                if (count($errores) >= 4) {
                    $_SESSION['errores'] = "general";
                } else {
                    $_SESSION['errores'] = $errores;
                }
            }

            if (isset($_SESSION['register']) && $_SESSION['register'] == 'complete') {

                $_SESSION['identity']->id = $usr->getId();
                $_SESSION['identity']->usuario = $usr->getUsuario();
                $_SESSION['identity']->email = $usr->getEmail();
                if ($metodo == 1) {

                    $_SESSION['identity']->$password = $usr->getPasswordUpdate();
                } else {
                    $_SESSION['identity']->$password = $usr->getPassword();
                }

                $_SESSION['identity']->img = stripslashes($usr->getImagen());
            }
        } else {
            $_SESSION['register'] = "failed";
        }

        header("Location:" . base_url . "config/index");
    }
}
