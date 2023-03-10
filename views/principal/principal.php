<?php require_once 'views/layouts/head.php'; ?>

<div class="main_content">
    <h1 class="section_menu">Post Recientes</h1>

    <?php
    if (!empty($lastPosts)) :
        while ($post = mysqli_fetch_assoc($lastPosts)) : ?>
            <div class="section_post" style="margin-bottom: 20px;">
                <div class="data_post">
                    <img src="data:image/jpg;base64,<?php echo base64_encode($post['img'])?>" alt="user_img" class="img_post" />
                    <span>
                        <h4 class="user_name"><?= $post['nombre'] ?></h4>
                        <h5 style="font-size: small;"><?= $post['fecha'] ?></h5>
                    </span>
                    <?php if($_SESSION['identity']->id == $post['usuario_id']): ?>
                    <a href="<?=base_url?>principal/delete&entrada_id=<?=$post['id']?>" style="
                    position:absolute;
                    right:40px;        
                    "><i class="fas fa-trash"></i></a>
                    <?php endif; ?>
                    

                </div>
                <div class="text_post">
                    <h2><?= $post['titulo'] ?></h2>
                    <p><?= $post['descripcion']; ?></p>
                </div>
                <div class="reactions_post">

                    <?php
                    $liked = false;
                    for ($i = 0; $i < sizeof($entradaId); $i++) :

                        if ($post['id'] == $entradaId[$i]) :
                            $liked = true;
                            break;
                        else :
                            $liked = false;
                        endif;
                    endfor; ?>

                    <?php if ($liked == true) : ?>

                        <div class="post_box">
                            <a href="<?=base_url?>principal/disliked&user=<?=$_SESSION['identity']->id?>&entrada=<?=$post['id']?>"><i class="fas fa-heart"></i> Like</a>
                        </div>

                    <?php else : ?>

                        <div class="post_box">
                            <a href="<?=base_url?>principal/liked&user=<?=$_SESSION['identity']->id?>&entrada=<?=$post['id']?>"><i class="far fa-heart"></i> Like</a>
                        </div>

                    <?php endif; ?>

                    <div class="post_box">
                        <a href="<?=base_url?>coments/index&entrada=<?=$post['id']?>"><i class="fas fa-comments"></i> Comments(<?=$count[$j]?>)</a>
                    </div>
                </div>
            </div>


        <?php
        $j++;
         endwhile;
    else : ?>
        <div>
            <h3>No hay entradas</h3>
        </div>
    <?php

    endif;
    ?>


</div>

<?php require_once 'views/layouts/foot.php'; ?>