<?php require_once 'views/layouts/head.php'; ?>

<div class="main_content">
    <h1 class="section_menu">Liked Post</h1>

    <?php
    if (!empty($my_liked_posts)) :
        while ($post = mysqli_fetch_assoc($my_liked_posts)) : ?>
            <div class="section_post">
                <div class="data_post">
                    <img src="data:image/jpg;base64,<?php echo base64_encode($post['img'])?>" alt="user_img" class="img_post" />
                    <span>
                        <h4 class="user_name"><?= $post['nombre'] ?></h4>
                        <h5 style="font-size: small;"><?= $post['fecha'] ?></h5>
                    </span>
                    <?php if($_SESSION['identity']->id == $post['usuario_id']): ?>
                    <a href="<?=base_url?>mylikes/delete&entrada_id=<?=$post['id']?>" style="
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

                        <div class="post_box">
                            <a href="<?=base_url?>mylikes/disliked&user=<?=$_SESSION['identity']->id?>&entrada=<?=$post['id']?>"><i class="fas fa-heart"></i> Like</a>
                        </div>

                        <div class="post_box">
                        <a href="<?=base_url?>coments/index&entrada=<?=$post['id']?>"><i class="fas fa-comments"></i> Comments(<?=$count[$j]?>)</a>
                    </div>
                </div>
            </div>


        <?php endwhile;
    else : ?>
        <div>
            <h3>No hay entradas</h3>
        </div>
    <?php

    endif;
    ?>



<?php require_once 'views/layouts/foot.php'; ?>