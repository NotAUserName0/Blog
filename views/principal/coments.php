<?php require_once 'views/layouts/head.php'; ?>

<div class="main_content">
    <h1 class="section_menu">Comentarios</h1>
    <?php
    if (!empty($thisPosts)) :
        while ($post = mysqli_fetch_assoc($thisPosts)) : ?>
            <div class="section_post">
                <div class="data_post">
                    <img src="data:image/jpg;base64,<?php echo base64_encode($post['img']) ?>" alt="user_img" class="img_post" />
                    <span>
                        <h4 class="user_name"><?= $post['nombre'] ?></h4>
                        <h5 style="font-size: small;"><?= $post['fecha'] ?></h5>
                    </span>
                    <?php if ($_SESSION['identity']->id == $post['usuario_id']) : ?>
                        <a href="<?=base_url?>coments/delete&entrada=<?=$postId['id']?>" style="
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
                            <a href="<?= base_url ?>coments/disliked&user=<?= $_SESSION['identity']->id ?>&entrada=<?= $post['id'] ?>"><i class="fas fa-heart"></i> Like</a>
                        </div>

                    <?php else : ?>

                        <div class="post_box">
                            <a href="<?= base_url ?>coments/liked&user=<?= $_SESSION['identity']->id ?>&entrada=<?= $post['id'] ?>"><i class="far fa-heart"></i> Like</a>
                        </div>

                    <?php endif; ?>
                </div>
            </div>
    <?php endwhile;
    endif; ?>

    <?php if (!empty($coments)) :
        while ($coment = mysqli_fetch_assoc($coments)) : ?>
            <div class="coments">
                <div class="data_post">
                    <img src="data:image/jpg;base64,<?php echo base64_encode($coment['img']) ?>" alt="user_img" class="img_post" />
                    <span>
                        <h4 class="user_name"><?= $coment['usuario'] ?></h4>
                        <h5 style="font-size: small"><?= $coment['fecha'] ?></h5>
                    </span>
                    <?php if ($_SESSION['identity']->id == $coment['usuario_id']) : ?>
                        <a href="<?=base_url?>coments/deleteComents&id=<?=$coment['id']?>&entrada=<?=$postId['id']?>" style="
                    position:absolute;
                    right:40px;        
                    "><i class="fas fa-trash"></i></a>
                    <?php endif; ?>
                </div>
                <p><?= $coment['descripcion'] ?></p>
            </div>

    <?php endwhile;
    endif; ?>

    <div class="cf">
        <form class="coments_form" action="<?=base_url?>coments/add&entrada_id=<?=$postId['id']?>" method="post">
            <img src="data:image/jpg;base64,<?php echo base64_encode($_SESSION['identity']->img) ?>" alt="user_img" class="img_post" />
            <input type="text" name="descripcion" id="coments_input" />
            <input type="submit" value="Comentar" />
        </form>
    </div>

    <?php require_once 'views/layouts/foot.php'; ?>