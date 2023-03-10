<?php

require_once 'models/perfil.php';

class perfilController{

    public function index(){
        if(!Utils::isLogged()){
            header("Location:".base_url."user/index");
        }
        $myPost = new Perfil();
        $myPosts = $myPost->myPost($_SESSION['identity']->id);
        $likedPosts = $myPost->isLiked($_SESSION['identity']->id);
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
        if (!empty($myPosts)) {
            while ($post = mysqli_fetch_assoc($myPosts)) {
                $count[$i] = $myPost->countComents($post['id']);
                $i++;
            }
        }
        $j = 0;
        $myPosts = $myPost->myPost($_SESSION['identity']->id);
        require_once 'views/perfil/perfil.php';
    }

    public function liked(){
        if(!Utils::isLogged()){
            header("Location:".base_url."user/index");
        }
        $myPost = new Perfil();
        $myPost->goingToLike($_GET['user'],$_GET['entrada']);
        header("Location:".base_url."perfil/index");
    }

    public function disliked(){
        if(!Utils::isLogged()){
            header("Location:".base_url."user/index");
        }
        $myPost = new Perfil();
        $myPost->dislike($_GET['user'],$_GET['entrada']);
        header("Location:".base_url."perfil/index");
    }

    public function delete(){
        if(!Utils::isLogged()){
            header("Location:".base_url."user/index");
        }
        $myPost = new Perfil();
        $myPost->deleteEntrada($_GET['entrada_id']);
        $myPost->deleteLikes($_GET['entrada_id']);
        header("Location:".base_url."perfil/index");
    }

}