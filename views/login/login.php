
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" type="text/css" href="<?= base_url ?>assets/css/styles_login.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</head>

<body>

<?php if(isset($_SESSION['register']) && $_SESSION['register'] == 'failed'): ?>

<script>
    window.onload = function inicioRegister(){
    register();
}
</script> 
<?php endif; ?>

    <main>
        <div class="contenedor__todo">
            <div class="caja__trasera">
                <div class="caja__trasera-login">
                    <h3>¿Ya tienes una cuenta??</h3>
                    <p>Inicia sesión para entrar en la página</p>
                    <button id="btn__iniciar-sesion">Iniciar Sesión</button>
                </div>
                <div class="caja__trasera-register">
                    <h3>¿Aún no tienes una cuenta?</h3>
                    <p>Regístrate para que puedas iniciar sesión</p>
                    <button id="btn__registrarse">Regístrarse</button>
                </div>
            </div>

            <!--Formulario de Login y registro-->
            <div class="contenedor__login-register">
                <!--Login-->
                <form action="<?=base_url?>user/login" method="post" class="formulario__login">
                    <h2>Iniciar Sesión</h2>
                    <?php
                    if (isset($_SESSION['error_login']) && $_SESSION['error_login'] == 'No se encuentra el usuario') : ?>

                            <strong class="alert_red">Datos erroneos</strong>

                    <?php endif; ?>
                    <input type="text" placeholder="Correo Electronico" name="email">
                    <input type="password" placeholder="Contraseña" name="password">
                    <input type="submit" value="Iniciar" class="button-gen">
                </form>
                <?php Utils::deleteSession('error_login') ?>

                <!--Register-->
                <form action="<?=base_url?>user/save" method="post" class="formulario__register" >
                    <h2>Regístrarse</h2>
                    <?php
                    if (isset($_SESSION['register']) && $_SESSION['register'] == 'complete') : ?>

                        <strong class="alert_green">Registro completado correctamente</strong>

                    <?php elseif (isset($_SESSION['register']) && $_SESSION['register'] == 'failed') : ?>

                        <strong class="alert_red">Registro FALLIDO Datos erroneos o correo ya registrado</strong>
                        <?php if (isset($_SESSION['errores']) && $_SESSION['errores'] == 'general') : ?>
                            <strong class="alert_red">No hay ni un dato introducido</strong>
                        <?php endif; ?>


                    <?php endif; ?>
                    <input type="text" placeholder="Nombre completo" name="nombre">
                    <?php echo isset($_SESSION['errores']) ? Utils::errores($_SESSION['errores'], 'nombre') : '' ?>
                    <input type="text" placeholder="Correo Electronico" name="email">
                    <?php echo isset($_SESSION['errores']) ? Utils::errores($_SESSION['errores'], 'email') : '' ?>
                    <input type="text" placeholder="Usuario" name="usuario">
                    <?php echo isset($_SESSION['errores']) ? Utils::errores($_SESSION['errores'], 'usuario') : '' ?>
                    <input type="password" placeholder="Contraseña" name="password">
                    <?php echo isset($_SESSION['errores']) ? Utils::errores($_SESSION['errores'], 'password') : '' ?>
                    <input type="submit" value="Registrar" class="button-gen">
                </form>
                <?php Utils::deleteSession('register') ?>
                <?php Utils::deleteSession('errores') ?>
            </div>
        </div>
    </main>

    <script>
        //Ejecutando funciones
        document.getElementById("btn__iniciar-sesion").addEventListener("click", iniciarSesion);
        document.getElementById("btn__registrarse").addEventListener("click", register);
        window.addEventListener("resize", anchoPage);

        //Declarando variables
        var formulario_login = document.querySelector(".formulario__login");
        var formulario_register = document.querySelector(".formulario__register");
        var contenedor_login_register = document.querySelector(".contenedor__login-register");
        var caja_trasera_login = document.querySelector(".caja__trasera-login");
        var caja_trasera_register = document.querySelector(".caja__trasera-register");

        //FUNCIONES


        function anchoPage() {

            if (window.innerWidth > 850) {
                caja_trasera_register.style.display = "block";
                caja_trasera_login.style.display = "block";
            } else {
                caja_trasera_register.style.display = "block";
                caja_trasera_register.style.opacity = "1";
                caja_trasera_login.style.display = "none";
                formulario_login.style.display = "block";
                contenedor_login_register.style.left = "0px";
                formulario_register.style.display = "none";
            }
        }

        anchoPage();


        function iniciarSesion() {
            if (window.innerWidth > 850) {
                formulario_login.style.display = "block";
                contenedor_login_register.style.left = "10px";
                formulario_register.style.display = "none";
                caja_trasera_register.style.opacity = "1";
                caja_trasera_login.style.opacity = "0";
            } else {
                formulario_login.style.display = "block";
                contenedor_login_register.style.left = "0px";
                formulario_register.style.display = "none";
                caja_trasera_register.style.display = "block";
                caja_trasera_login.style.display = "none";
            }
        }

        function register() {
            if (window.innerWidth > 850) {
                formulario_register.style.display = "block";
                contenedor_login_register.style.left = "410px";
                formulario_login.style.display = "none";
                caja_trasera_register.style.opacity = "0";
                caja_trasera_login.style.opacity = "1";
            } else {
                formulario_register.style.display = "block";
                contenedor_login_register.style.left = "0px";
                formulario_login.style.display = "none";
                caja_trasera_register.style.display = "none";
                caja_trasera_login.style.display = "block";
                caja_trasera_login.style.opacity = "1";
            }
        }
    </script>

</body>

</html>