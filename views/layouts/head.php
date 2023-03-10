<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="utf-8" />
  <title>Feed</title>
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
            <a class="nav-link" href="<?= base_url ?>">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Acerca del creador</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <div class="feed">
    <div class="sidebar">
      <img src="data:image/jpg;base64,<?php echo base64_encode($_SESSION['identity']->img) ?>" alt="user_img" class="img_user" />
      <p><a href="<?= base_url ?>perfil/index"> <?= $_SESSION['identity']->usuario ?></a></p>
      <ul class="user-menu">
        <li>
          <a href="<?= base_url ?>entrada/index"><i class="fas fa-edit"></i>Crear Post</a>
        </li>
        <li>
          <a href="<?= base_url ?>mylikes/index"><i class="fas fa-heart"></i> Ver mis likes</a>
        </li>
        <li>
          <a href="<?= base_url ?>config/index"><i class="fas fa-cog"></i> Configuracion</a>
        </li>
        <?php if ($_SESSION['identity']->rol == 'admin') : ?>
          <li>
            <a href="#"><i class="fas fa-address-card"></i> Acerca de mi</a>
          </li>
        <?php endif; ?>
        <li>
          <a href="<?= base_url ?>user/logout"><i class="fas fa-sign-out-alt"></i> Cerrar Sesion</a>
        </li>
        <li></li>
      </ul>
    </div>