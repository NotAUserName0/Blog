<?php

require_once 'models/entrada.php';

class comentsController{
    public function index(){
        if(!Utils::isLogged()){
            header("Location:".base_url."user/index");
        }
        $thisPost = new Entrada();
        $thisPosts = $thisPost->thisPost($_GET['entrada']);
        $likedPosts = $thisPost->isLiked($_SESSION['identity']->id);
        $entradaId = array();
        $postId = mysqli_fetch_assoc($thisPost->thisPost($_GET['entrada']));
        $i = 0;
        if($likedPosts != null){
            while ($post = mysqli_fetch_assoc($likedPosts)) :
                $entradaId[$i] = $post['entrada_id'];
                $i++;
            endwhile;
        }
        $coments = $thisPost->getComents($_GET['entrada']);

        

        require_once 'views/principal/coments.php';
    }

    public function liked(){
        if(!Utils::isLogged()){
            header("Location:".base_url."user/index");
        }
        $principal = new Entrada();
        $principal->goingToLike($_GET['user'],$_GET['entrada']);
        header("Location:".base_url."coments/index&entrada=".$_GET['entrada']);
    }

    public function disliked(){
        if(!Utils::isLogged()){
            header("Location:".base_url."user/index");
        }
        $principal = new Entrada();
        $principal->dislike($_GET['user'],$_GET['entrada']);
        header("Location:".base_url."coments/index&entrada=".$_GET['entrada']);
    }

    public function deleteComents(){
        if(!Utils::isLogged()){
            header("Location:".base_url."user/index");
        }
        $principal = new Entrada();
        $principal->deleteComent($_GET['id']);
        header("Location:".base_url."coments/index&entrada=".$_GET['entrada']);
    }

    public function delete(){
        if(!Utils::isLogged()){
            header("Location:".base_url."user/index");
        }
        $principal = new Entrada();
        $principal->deleteEntrada($_GET['entrada']);
        $principal->deleteLikes($_GET['entrada']);
        $principal->deleteComents($_GET['entrada']);
        header("Location:".base_url."principal/index");
    }

    public function add(){
        if(!Utils::isLogged()){
            header("Location:".base_url."user/index");
        }
        
        if(isset($_POST)){
            $descripcion = isset($_POST['descripcion']) ? $_POST['descripcion'] : false;
            $post = new Entrada(); 
            $post->setUsuarioId($_SESSION['identity']->id);
            $post->setEntradaId($_GET['entrada_id']);
            $post->setDescripcion($descripcion);
            $post->saveComent();
            header("Location:".base_url."coments/index&entrada=".$_GET['entrada_id']);
    }
    header("Location:".base_url."coments/index&entrada=".$_GET['entrada_id']);
    
}
}