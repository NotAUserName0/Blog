<?php

class Usuario
{
    private $id;
    private $nombre;
    private $usuario;
    private $email;
    private $password;
    private $rol;
    private $imagen;
    private $db;

    public function __construct()
    {
        $this->db = Database::connect();
    }

    function getId()
    {
        return $this->id;
    }

    function setId($id)
    {
        $this->id = $id;
    }

    function getNombre()
    {
        return $this->nombre;
    }

    function setNombre($nombre)
    {
        $this->nombre = $this->db->real_escape_string($nombre);
    }

    function getUsuario()
    {
        return $this->usuario;
    }

    function setUsuario($usuario)
    {
        $this->usuario = $this->db->real_escape_string($usuario);
    }

    function getEmail()
    {
        return $this->email;
    }

    function setEmail($email)
    {
        $this->email = $this->db->real_escape_string($email);
    }

    function getPassword()
    {
        return password_hash($this->db->real_escape_string($this->password), PASSWORD_BCRYPT, ['cost' => 4]);
    }

    function setPassword($password)
    {
        $this->password = $password;
    }

    public function getPasswordUpdate()
    {
        return $this->password;
    }


    public function setPasswordUpdate($password)
    {
        $this->password = $password;
    }

    function getRol()
    {
        return $this->rol;
    }

    function setRol($rol)
    {
        $this->rol = $rol;
    }

    function getImagen()
    {
        return $this->imagen;
    }

    function setImagen($imagen)
    {
        $this->imagen = $imagen;
    }

    public function save()
    {
        //Guarda el objecto en la db
        $sql = "INSERT INTO usuarios VALUES(NULL,'{$this->getNombre()}','{$this->getUsuario()}','{$this->getEmail()}','{$this->getPassword()}','user','{$this->getImagen()}',CURDATE());";
        $save = $this->db->query($sql);
        $result = false;

        if ($save) {
            $result = true;
        }
        return $result;
    }

    public function login()
    {
        $email = $this->email;
        $password = $this->password;
        $result = false;
        //comprobar usr
        $sql = "SELECT * FROM usuarios WHERE email = '$email'";
        $login = $this->db->query($sql);

        if ($login && $login->num_rows == 1) {
            $usuario = $login->fetch_object();
            $verify = password_verify($password, $usuario->pass);
            if ($verify) {
                $result = $usuario;
            }
        }

        return $result;
    }

    public function comprobar()
    {
        $email = $this->email;
        $result = false;
        $sql = "SELECT email FROM usuarios WHERE email = '$email'";
        $isset_email = $this->db->query($sql);
        $isset_user = mysqli_fetch_assoc($isset_email);
        if ($isset_user['email'] == $email) {
            $result = true;
        }
        return $result;
    }

    public function update($metodo)
    {
        $usuario = $this->getUsuario();
        $email = $this->getEmail();
        if ($metodo == 1) {
            $password = $this->getPasswordUpdate();
        } else {
            $password = $this->getPassword();
        }
        $userId = $this->getId();
        $img = $this->getImagen();

        $update = "UPDATE usuarios SET usuario = '$usuario', email = '$email', pass = '$password', img = '$img' WHERE id = $userId";
        $save = $this->db->query($update);

        /*var_dump($update);
        echo "<br>";
        var_dump(mysqli_error($this->db));
        echo "<br>";
        var_dump($save);
        echo "<br>";
        die();*/
        $result = false;


        if ($save) {
            $result = true;
        }
        return $result;
    }
}
