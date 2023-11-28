<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="Assets/css/FontAwesome/css/fontawesome.css" rel="stylesheet">
    <link href="Assets/css/FontAwesome/css/brands.css" rel="stylesheet">
    <link href="Assets/css/FontAwesome/css/solid.css" rel="stylesheet">
    <link rel="stylesheet" href="Assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="Assets/css/index.css">
    <link rel="stylesheet" href="Assets/alertifyjs/css/alertify.min.css" />
    <link rel="stylesheet" href="Assets/alertifyjs/css/themes/default.min.css" />
    <script src="Assets/js/jquery.min.js"></script>
    <script src="Assets/js/bootstrap.min.js"></script>
    <script src="Assets/alertifyjs/alertify.min.js"></script>
    <script src="Assets/js/scripts.js"></script>
</head>
<body>
    <div class="background-overlay">
        <div class="container">
            <div class="row justify-content-center align-items-center vh-100">
                <div class="col-md-6" style="background-color: #ffffffe8;border-radius: 10px;height: 490px;">
                    <form id="loginForm">
                        <h1 style="margin-top: 10%;margin-left: 3%;">Iniciar Sesión</h1>
                        <div class="login-form">
                            <div class="form-group icon-inside">
                                <span class="fa fa-user icon-user"></span>
                                <input type="text" placeholder="Usuario" class="form-control" id="usuario" required>
                            </div>
                            <div class="form-group icon-inside">
                                <span class="fa fa-lock icon-lock"></span>
                                <input type="password" placeholder="Contraseña" class="form-control" id="contrasena" required>
                                <span class="toggle-password eye-icon">👁️</span>
                            </div>
                            <button type="submit" class="btn btn-primary btn-block">Iniciar Sesion</button>
                        </div>
                        
                    </form>
                </div>
            </div>
        </div>
    </div>  
    
    <script>
        $('#loginForm').submit(function(e) {
            e.preventDefault();
            $.ajax({
                url: 'Controllers/indexController.php',
                type: 'POST',
                data: {
                    Op: 'Login',
                    usuario: $('#usuario').val(),
                    contrasena: $('#contrasena').val()
                },
                success: function(data) {
                    var datos = JSON.parse(data);
                    console.log(datos);
                    if (datos.success) {
                        alertify.success(`${datos.message}`);
                        setTimeout(function() {
                            window.location.href = 'Vistas/dashboard.php';
                        }, 1500);
                    } else {
                        alertify.error(`${datos.message}`);
                    }
                }
            });
        });

        $('.toggle-password').click(function() {
            var input = $('#contrasena');
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
