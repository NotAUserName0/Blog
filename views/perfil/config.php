<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8" />
    <title>Configuracion de Perfil</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="<?= base_url ?>assets/css/styles.css" />
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="<?= base_url ?>">BLOG</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="<?=base_url?>">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Acerca del creador</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="feed_perfil">
        <div class="contenedor">
            <img src="data:image/jpg;base64,<?php echo base64_encode($_SESSION['identity']->img) ?>" alt="user_img" class="img_user" />
            <p>Modificar Perfil</p>

            <?php if (isset($_SESSION['register']) && $_SESSION['register'] == 'complete') : ?>
                <strong class="alert_green">Registro completado correctamente</strong>
            <?php elseif (isset($_SESSION['register']) && $_SESSION['register'] == 'failed') : ?>
                <strong class="alert_red">Registro FALLIDO Datos erroneos o correo ya registrado</strong>
                <?php if (isset($_SESSION['errores']) && $_SESSION['errores'] == 'general') : ?>
                    <strong class="alert_red">No hay ni un dato introducido</strong>
                <?php endif; ?>
            <?php endif; ?>

            <form action="<?=base_url?>config/save" method="post" enctype="multipart/form-data">
                <div class="form-floating mb-3">
                    <input type="email" class="form-control" id="floatingInput" placeholder="name@example.com" name="email" value="<?=$_SESSION['identity']->email?>"/>
                    <label for="floatingInput">Modificar Correo</label>
                    <?php echo isset($_SESSION['errores']) ? Utils::errores($_SESSION['errores'], 'email') : '' ?>
                </div>
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="floatingInput" placeholder="name@example.com" name="usuario" value="<?=$_SESSION['identity']->usuario?>"/>
                    <label for="floatingInput">Modificar Usuario</label>
                    <?php echo isset($_SESSION['errores']) ? Utils::errores($_SESSION['errores'], 'usuario') : '' ?>
                </div>
                <div class="form-group mb-3">
                    <label for="formFile" class="form-label">Cambiar imagen de perfil</label>
                    <input class="form-control" type="file" id="formFile" accept=".jpg,.png" name="img"/>
                    <?php echo isset($_SESSION['errores']) ? Utils::errores($_SESSION['errores'], 'img') : '' ?>
                </div>
                <div class="form-floating mb-3">
                    <input type="password" class="form-control" id="floatingPassword" placeholder="Password" name="password" value="<?=$_SESSION['identity']->pass?>"/>
                    <label for="floatingPassword">Password</label>
                    <?php echo isset($_SESSION['errores']) ? Utils::errores($_SESSION['errores'], 'password') : '' ?>
                </div>
                <button type="submit" class="btn btn-outline-primary">Modificar</button>
            </form>
            <?php Utils::deleteSession('register') ?>
            <?php Utils::deleteSession('errores') ?>
        </div>
    </div>

    <footer>
        <div class="foot_section" style="position:fixed">
            <h5>Made by FAJG</h5>
        </div>
    </footer>
</body>

</html>