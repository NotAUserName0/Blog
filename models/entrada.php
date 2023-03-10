<?php

class Entrada{

    private $id;
    private $usuario_id;
    private $entrada_id;
    private $titulo;
    private $descripcion;
    private $fecha;

    public function __construct()
    {
        $this->db = Database::connect();
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getUsuarioId()
    {
        return $this->usuario_id;
    }

    public function setUsuarioId($usuario_id)
    {
        $this->usuario_id = $usuario_id;
    }

    public function getEntradaId()
    {
        return $this->entrada_id;
    }

    public function setEntradaId($entrada_id)
    {
        $this->entrada_id = $entrada_id;

    }

    public function getTitulo()
    {
        return $this->titulo;
    }

    public function setTitulo($titulo)
    {
        $this->titulo = $this->db->real_escape_string($titulo);
    }

    public function getDescripcion()
    {
        return $this->descripcion;
    }

    public function setDescripcion($descripcion)
    {
        $this->descripcion = $this->db->real_escape_string($descripcion);
    }

    public function getFecha()
    {
        return $this->fecha;
    }

    public function setFecha($fecha)
    {
        $this->fecha = $this->db->real_escape_string($fecha);
    }

    public function save(){
        $date = date('Y-m-d H:i:s');
        $userId = $this->getUsuarioId();
        $titulo = $this->getTitulo();
        $descripcion = $this->getDescripcion();
        $sql = "INSERT INTO entradas(id,usuario_id,titulo,descripcion,fecha) VALUES (NULL,$userId,'$titulo','$descripcion','$date');";
        $save = $this->db->query($sql);

        $result = false;

        if ($save) {
            $result = true;
        }
        return $result;
    }

    public function thisPost($entrada_id)
    {

        $sql = "SELECT u.nombre,u.img,e.id, e.usuario_id, e.titulo, e.descripcion, e.fecha FROM usuarios u, entradas e WHERE u.id = e.usuario_id && e.id = $entrada_id;";
        $post = $this->db->query($sql);
        $result = array();
        if ($post && mysqli_num_rows($post) >= 1) {
            $result = $post;
        }
        
        return $result;
    }

    public function isLiked($user_active){
        $sql = "SELECT usuario_id, entrada_id from likes WHERE usuario_id = $user_active;";
        $liked = $this->db->query($sql);
        $result = array();
        if ($liked && mysqli_num_rows($liked) >= 1) {
            $result = $liked;
        }
        return $result;
    }

    public function goingToLike($user, $entrada){
         $sql = "INSERT INTO `likes`(`id`, `usuario_id`, `entrada_id`) VALUES (NULL,'{$user}','{$entrada}')";
         $save = $this->db->query($sql);

         $result = false;

        if ($save) {
            $result = true;
        }
        return $result;
    }

    public function dislike($user, $entrada){
        $sql = "DELETE FROM `likes` WHERE usuario_id = {$user} && entrada_id = {$entrada};";
        $save = $this->db->query($sql);

        $result = false;

       if ($save) {
           $result = true;
       }
       return $result;
    }

    public function deleteEntrada($entrada){
          $sql = "DELETE FROM `entradas` WHERE id = {$entrada};";
          $save = $this->db->query($sql);

        $result = false;

       if ($save) {
           $result = true;
       }
       return $result;
    }
    
    public function deleteLikes($entrada){
        $sql = "DELETE FROM `likes` WHERE entrada_id = {$entrada};";
        $save = $this->db->query($sql);

      $result = false;

     if ($save) {
         $result = true;
     }
     return $result;
    }

    public function getComents($entrada){
        $sql = "SELECT c.id, c.descripcion, c.fecha, c.usuario_id , u.usuario, u.img FROM usuarios u, comentarios c WHERE c.entrada_id = $entrada && u.id = c.usuario_id ORDER BY c.fecha DESC;";
        $post = $this->db->query($sql);
        $result = array();
        if ($post && mysqli_num_rows($post) >= 1) {
            $result = $post;
        }
        
        return $result;
    }

    public function deleteComent($id){
        $sql = "DELETE FROM comentarios WHERE id = {$id};";
        $save = $this->db->query($sql);

      $result = false;

     if ($save) {
         $result = true;
     }
     return $result;
    }

    public function deleteComents($id){
        $sql = "DELETE FROM comentarios WHERE entrada_id = {$id};";
        $save = $this->db->query($sql);

      $result = false;

     if ($save) {
         $result = true;
     }
     return $result;
    }

    public function saveComent(){
        $date = date('Y-m-d H:i:s');
        $userId = $this->getUsuarioId();
        $entradaId = $this->getEntradaId();
        $descripcion = $this->getDescripcion();

        $sql = "INSERT INTO comentarios(id,usuario_id,entrada_id,descripcion,fecha) VALUES (NULL,$userId,$entradaId,'$descripcion','$date');";
        $save = $this->db->query($sql);

        $result = false;

        if ($save) {
            $result = true;
        }
        return $result;

    }


    
}