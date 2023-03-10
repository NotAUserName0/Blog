<?php

class MyLikes{
    private $id;
    private $usuario_id;
    private $categoria_id;
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

    public function getCategoriaId()
    {
        return $this->categoria_id;
    }

    public function setCategoriaId($categoria_id)
    {
        $this->categoria_id = $categoria_id;
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

    public function myPost($user)
    {

        $sql = "SELECT u.nombre,u.img,e.id, e.usuario_id, e.titulo, e.descripcion, e.fecha FROM usuarios u, entradas e, likes l WHERE u.id = e.usuario_id && e.id = l.entrada_id && l.usuario_id = {$user};";
        $post = $this->db->query($sql);

        $result = array();
        if ($post && mysqli_num_rows($post) >= 1) {
            $result = $post;
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

public function countComents($entrada){
    $sql = "SELECT c.id, c.descripcion, c.fecha, u.usuario, u.img FROM usuarios u, comentarios c WHERE c.entrada_id = $entrada && u.id = c.usuario_id;";
    $post = $this->db->query($sql);
    $result = mysqli_num_rows($post);
    return $result;
}



}