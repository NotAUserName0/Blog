<?php

require_once 'models/principal.php';

class principalController{
    
    public function index()
    {
        if(!Utils::isLogged()){
            header("Location:".base_url."user/index");
        }
        $lastPost = new Principal();
        $lastPosts = $lastPost->lastPost();
        $likedPosts = $lastPost->isLiked($_SESSION['identity']->id);
        $entradaId = array();
        $i = 0;
        if($likedPosts != null){
            while ($post = mysqli_fetch_assoc($likedPosts)) :
                $entradaId[$i] = $post['entrada_id'];
                $i++;
            endwhile;
        }
        $count = array();
        $i = 0;
        if (!empty($lastPosts)) {
            while ($post = mysqli_fetch_assoc($lastPosts)) {
                $count[$i] = $lastPost->countComents($post['id']);
                $i++;
            }
        }
        $j = 0;
        $lastPosts = $lastPost->lastPost();
        require_once 'views/principal/principal.php';
        
    }

    public function liked(){
        if(!Utils::isLogged()){
            header("Location:".base_url."user/index");
        }
        $principal = new Principal();
        $principal->goingToLike($_GET['user'],$_GET['entrada']);
        header("Location:".base_url."principal/index");
    }

    public function disliked(){
        if(!Utils::isLogged()){
            header("Location:".base_url."user/index");
        }
        $principal = new Principal();
        $principal->dislike($_GET['user'],$_GET['entrada']);
        header("Location:".base_url."principal/index");
    }

    public function delete(){
        if(!Utils::isLogged()){
            header("Location:".base_url."user/index");
        }
        $principal = new Principal();
        $principal->deleteEntrada($_GET['entrada_id']);
        $principal->deleteLikes($_GET['entrada_id']);
        $principal->deleteComents($_GET['entrada_id']);
        header("Location:".base_url."principal/index");
    }


}