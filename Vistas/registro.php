<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="../Assets/css/FontAwesome/css/fontawesome.css" rel="stylesheet">
    <link href="../Assets/css/FontAwesome/css/brands.css" rel="stylesheet">
    <link href="../Assets/css/FontAwesome/css/solid.css" rel="stylesheet">
    <link rel="stylesheet" href="../Assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../Assets/css/registro.css">
    <link rel="stylesheet" href="../Assets/alertifyjs/css/alertify.min.css" />
    <link rel="stylesheet" href="../Assets/alertifyjs/css/themes/default.min.css" />
    <script src="../Assets/js/jquery.min.js"></script>
    <script src="../Assets/js/bootstrap.min.js"></script>
    <script src="../Assets/alertifyjs/alertify.min.js"></script>
    <script src="../Assets/js/scripts.js"></script>
</head>
<body>
    <div class="background-overlay">
        <div class="container">
            <div class="row justify-content-center align-items-center vh-100">
                <div class="col-md-6">
                    <img src="../assets/img/login.png" alt="Imagen Descriptiva" class="img-fluid" style="height: 579px !important;margin-left: 32%;">
                </div>
                <div class="col-md-6" style="background-color: white; height: 579px;">
                    <div id="registerForm">
                        <h1 style="margin-left: 3%;padding-bottom: 30px;margin-top: 3%;">Registrate</h1>
                        <div class="register-form">
                            <div class="form-group icon-inside">
                                <span class="fa fa-user icon-user"></span>
                                <input type="text" placeholder="Usuario" class="form-control" id="usuario" required>
                            </div>
                            <div class="form-group icon-inside">
                                <span class="fa-solid fa-envelope icon-user"></span>
                                <input type="text" placeholder="Correo" class="form-control" id="correo" required>
                            </div>
                            <div class="form-group icon-inside">
                                <span class="fa-solid fa-envelope icon-user"></span>
                                <input type="text" placeholder="Confirmar Correo" class="form-control" id="confirmar-correo" required>
                            </div>
                            <div class="form-group icon-inside">
                                <span class="fa fa-lock icon-lock"></span>
                                <input type="password" placeholder="Contraseña" class="form-control" id="contrasena" required>
                                <span class="toggle-password1 eye-icon">👁️</span>
                            </div>
                            <div class="form-group icon-inside">
                                <span class="fa fa-lock icon-lock"></span>
                                <input type="password" placeholder="Confirmar Contraseña" class="form-control" id="confirmar-contrasena" required>
                                <span class="toggle-password2 eye-icon">👁️</span>
                            </div>
                            <button class="btn btn-primary btn-block" onclick="Registro()">Registrarse</button>
                            <div class="xt1 text-center">
                                <span>O Registrate usando</span>
                            </div>
                            <div class="flex-c-m">
                                <a href="#" class="login-social-item bg1">
                                    <i class="fa-brands fa-facebook"></i>
                                </a>
                                <a href="#" class="login-social-item bg2">
                                    <i class="fa-brands fa-twitter"></i>
                                </a>
                                <a href="#" class="login-social-item bg3">
                                    <i class="fa-brands fa-google"></i>
                                </a>
                            </div>
                            <div class="xt1 text-center">
                                <a href="../index.php">Inciar Sesion</a>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>  
    
    <script>
        function Registro(){
            ok = true
            usuario = $('#usuario').val();
            correo = $('#correo').val();
            confirmarCorreo = $('#confirmar-correo').val();
            contrasena = $('#contrasena').val();
            confirmarContrasena = $('#confirmar-contrasena').val();
            if(correo !== confirmarCorreo){
                alert("Los correos no coinciden");
                ok = false;
            }else if(contrasena !== confirmarContrasena){
                alert("Las contraseñas no coinciden");
                ok = false;
            }else if(ValidaEmail(correo) == false){
                alert('Ingrese un correo válido.');
                $('#correo').focus();
                ok = false;
            }
            console.log(ok);

            if(usuario == ''){
                alert("Digite el nombre de usuario");
            }else if(correo == ''){
                alert("Digite el correo");
            }else if(confirmarCorreo == ''){
                alert("Digite la confirmacion del correo");
            }else if(contrasena == ''){
                alert("Digite la contraseña");
            }else if(confirmarContrasena == ''){
                alert("Digite la confirmacion de la contraseña");
            }else{
                if (ok){
                    $.ajax({
                        url: '../Controllers/registroController.php',
                        type: 'POST',
                        data: {
                            Op: 'Registro',
                            usuario: usuario,
                            correo: correo,
                            contrasena: contrasena
                        },
                        success: function(data) {
                            var datos = JSON.parse(data);
                            if (datos.success) {
                                alertify.success(`${datos.message}`);
                                setTimeout(function() {
                                    window.location.href = 'map.php';
                                }, 1500);
                            } else {
                                alertify.error(`${datos.message}`);
                            }
                        }
                    });
                };
            }
        }

        function ValidaEmail(email) {
            var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
            return regex.test(email);
        }

        $('.toggle-password1').click(function() {
            var input = $('#contrasena');
            if (input.attr('type') === 'password') {
                input.attr('type', 'text');
                $(this).text('🚫');
            } else {
                input.attr('type', 'password');
                $(this).text('👁️');
            }
        });
        $('.toggle-password2').click(function() {
            var input = $('#confirmar-contrasena');
            if (input.attr('type') === 'password') {
                input.attr('type', 'text');
                $(this).text('🚫');
            } else {
                input.attr('type', 'password');
                $(this).text('👁️');
            }
        });
    </script>
</body>
</html>
