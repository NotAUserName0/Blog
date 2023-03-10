<?php

require_once 'models/myLikes.php';

class mylikesController{

    public function index(){
        if(!Utils::isLogged()){
            header("Location:".base_url."user/index");
        }
        $my_liked_post = new MyLikes();
        $my_liked_posts = $my_liked_post->myPost($_SESSION['identity']->id);

        $count = array();
        $i = 0;
        if (!empty($my_liked_posts)) {
            while ($post = mysqli_fetch_assoc($my_liked_posts)) {
                $count[$i] = $my_liked_post->countComents($post['id']);
                $i++;
            }
        }
        $j = 0;
        $my_liked_posts = $my_liked_post->myPost($_SESSION['identity']->id);

        require_once 'views/perfil/myLikes.php';
    }

    public function liked(){
        if(!Utils::isLogged()){
            header("Location:".base_url."user/index");
        }
        $principal = new MyLikes();
        $principal->goingToLike($_GET['user'],$_GET['entrada']);
        header("Location:".base_url."mylikes/index");
    }

    public function disliked(){
        if(!Utils::isLogged()){
            header("Location:".base_url."user/index");
        }
        $principal = new MyLikes();
        $principal->dislike($_GET['user'],$_GET['entrada']);
        header("Location:".base_url."mylikes/index");
    }

    public function delete(){
        if(!Utils::isLogged()){
            header("Location:".base_url."user/index");
        }
        $principal = new MyLikes();
        $principal->deleteEntrada($_GET['entrada_id']);
        $principal->deleteLikes($_GET['entrada_id']);
        header("Location:".base_url."mylikes/index");
    }

}