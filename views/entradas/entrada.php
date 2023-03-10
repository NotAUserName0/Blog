<?php require_once 'views/layouts/head.php'; ?>

<div class="main_content">
    <h1 class="section_menu">Publicacion</h1>
    <?php if (isset($_SESSION['errores']) && $_SESSION['errores'] == 'general') : ?>
        <strong style="color:red">No hay ni un dato introducido</strong>
    <?php endif; ?>
    <div class="container-fluid">
        <form action="<?= base_url ?>entrada/save" method="post">
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Titulo:</label>
                <input type="text" class="form-control" id="exampleFormControlInput1" name="titulo" />
                <?php echo isset($_SESSION['errores']) ? Utils::errores($_SESSION['errores'], 'titulo') : '' ?>
            </div>
            <div class="mb-3">
                <label for="exampleFormControlTextarea1" class="form-label">Contenido: </label>
                <textarea class="form-control" id="exampleFormControlTextarea1" rows="4" name="descripcion"></textarea>
                <?php echo isset($_SESSION['errores']) ? Utils::errores($_SESSION['errores'], 'descripcion') : '' ?>
            </div>
            <button type="submit" class="btn btn-outline-primary">Publicar</button>
    </div>
    </form>
    <?php Utils::deleteSession('errores') ?>
</div>


<?php require_once 'views/layouts/foot.php'; ?>