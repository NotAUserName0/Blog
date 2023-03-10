<?php

require_once 'models/usuario.php';

class userController
{

    public function index()
    {

        if (Utils::isLogged()) {
            header("Location:" . base_url . "principal/index");
        }
        require_once 'views/login/login.php';
    }

    public function save()
    {
        if (Utils::isLogged()) {
            header("Location:" . base_url . "principal/index");
        }

        if (isset($_POST)) {
            $nombre = isset($_POST['nombre']) ? $_POST['nombre'] : false;
            $usuario = isset($_POST['usuario']) ? $_POST['usuario'] : false;
            $email = isset($_POST['email']) ? $_POST['email'] : false;
            $password = isset($_POST['password']) ? $_POST['password'] : false;

            $errores = array();

            if (!empty($nombre) && !is_numeric($nombre) && !preg_match("/[0-9]/", $nombre)) {
                $nombre_validado = true;
            } else {
                $errores['nombre'] = "El nombre no es valido";
                $nombre_validado = false;
            }
            //APELLIDO
            if (!empty($usuario)) {
                $usuario_validado = true;
            } else {
                $errores['usuario'] = "El usuario no es valido";
                $usuario_validado = false;
            }
            //EMAIL
            if (!empty($email) && filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $email_validado = true;
            } else {
                $errores['email'] = "El email no es valido";
                $email_validado = false;
            }

            //PASWORD
            if (!empty($password)) {
                $password_validado = true;
            } else {
                $errores['password'] = "El password no es valido";
                $password_validado = false;
            }

            $image =  addslashes(file_get_contents("./assets/img/perfil.png",FILE_USE_INCLUDE_PATH));



            if (count($errores) == 0) {
                $usr = new Usuario();
                $usr->setNombre($nombre);
                $usr->setUsuario($usuario);
                $usr->setEmail($email);
                $usr->setPassword($password);
                $usr->setImagen($image);
                if ($usr->comprobar()) {
                    $_SESSION['register'] = "failed";
                } else {
                    $usr->save();
                    $_SESSION['register'] = "complete";
                }
            } else {
                $_SESSION['register'] = "failed";


                if (count($errores) >= 4) {
                    $_SESSION['errores'] = "general";
                } else {
                    $_SESSION['errores'] = $errores;
                }
            }
        } else {
            $_SESSION['register'] = "failed";
        }


        if (isset($_SESSION['register']) && $_SESSION['register'] == 'complete') {
            $identity = $usr->login();
            if ($identity && is_object($identity)) {
                $_SESSION['identity'] = $identity;
            }
            header("Location:" . base_url . "principal/index");
        } else {
            header("Location:" . base_url);
        }
    }

    public function login()
    {
        if (Utils::isLogged()) {
            header("Location:" . base_url . "principal/index");
        }

        if (isset($_POST)) {
            //id usr
            //consulta bd
            $usr = new Usuario();
            $usr->setEmail($_POST['email']);
            $usr->setPassword($_POST['password']);
            $identity = $usr->login();
            if ($identity && is_object($identity)) {
                $_SESSION['identity'] = $identity;

                if ($identity->rol == 'admin') {
                    $_SESSION['admin'] = true;
                }
            } else {
                $_SESSION['error_login'] = 'No se encuentra el usuario';
            }
        }
        if (isset($_SESSION['identity'])) {
            header("Location:" . base_url . "principal/index");
        } else {
            header("Location:" . base_url);
        }
    }

    public function logout()
    {
        if (isset($_SESSION['identity'])) {
            unset($_SESSION['identity']);
        }
        if (isset($_SESSION['admin'])) {
            unset($_SESSION['admin']);
        }
        header("Location:" . base_url);
    }
}
