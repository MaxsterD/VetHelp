<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="../Assets/css/FontAwesome/css/fontawesome.css" rel="stylesheet">
    <link href="../Assets/css/FontAwesome/css/brands.css" rel="stylesheet">
    <link href="../Assets/css/FontAwesome/css/solid.css" rel="stylesheet">
    <link rel="stylesheet" href="../Assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../Assets/css/dashboard.css">
    <link rel="stylesheet" href="../Assets/alertifyjs/css/alertify.min.css" />
    <link rel="stylesheet" href="../Assets/alertifyjs/css/themes/default.min.css" />
    <script src="../Assets/js/jquery.min.js"></script>
    <script src="../Assets/js/bootstrap.min.js"></script>
    <script src="../Assets/alertifyjs/alertify.min.js"></script>
    <script src="../Assets/js/dashboard.js"></script>
</head>
<body>
<div style="position: relative;">
  <nav class="bgnavbar navbar navbar-expand-lg navbar-light">
    <button type="button" class="btn mr-1" data-bs-toggle="modal" data-bs-target="#menuModal">
      <i class="fas fa-bars"></i>
    </button>
    <img style="width: 50px;" src="../Assets/img/imageicon.png" alt="" class="mr-1"><a class="navbar-brand" href="#">VetHelp</a>
    <div class="modal fade" id="menuModal" tabindex="-1" role="dialog" aria-labelledby="menuModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered" role="document">
              <div class="modal-content">
                  <div class="modal-header">
                      <h5 class="modal-title" id="menuModalLabel">Menú</h5>
                      <button type="button" class="btn" data-bs-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                      </button>
                  </div>
                  <div class="modal-body">
                    <div class="row">
                      <div class="col">
                        <button class="btn mr-1 icon-btn" onclick="HistoriaClinica()"><i class="fa-solid fa-icons"></i></button>
                      </div>
                      <div class="col">
                        <button class="btn mr-1 icon-btn"><i class="fa-solid fa-icons"></i></button>
                      </div>
                      <div class="col">
                        <button class="btn mr-1 icon-btn"><i class="fa-solid fa-icons"></i></button>
                      </div>
                    </div>
                  </div>
              </div>
          </div>
    </div>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto">
      </ul>
      <h5 class="mr-4 mt-1">Bienvenido <?php $_SESSION['usuario']; ?></h5>
      <ul class="navbar-nav mr-3">
      <li class="nav-item active">
          <form class="form-inline my-2 my-lg-0"> 
              <button class="btn btn-success my-2 my-sm-0">Perfil</button>
          </form>
        </li>
      </ul>
      <form class="form-inline my-2 my-lg-0">
        <button class="btn btn-danger my-2 my-sm-0" onclick="CerrarSesion()">Cerrar Sesión</button>
      </form>
    </div>
  </nav>
  <div class="background-overlay">
  </div>
  
  <div class="container" style="margin-top:20%">
    <div class="item">
      
      <button class="btn btn-primary btn-block" onclick="ConsultarHistoria()">Consultar Historia Clinica</button>
    </div>
    <div class="item">
      
      <button class="btn btn-primary btn-block" onclick="GenerarHistoria()">Generar Historia Clinica</button>
    </div>
  </div>  
</div>
<script>
  function ConsultarHistoria(){
    window.location.href = 'ConsultarHistoria.php';
  }

  function GenerarHistoria(){
    window.location.href = 'GenerarHistoria.php';
  }

  function CerrarSesion(){
    var datos = {
            'Op': 'LogOut' // Reemplaza con tu token CSRF real
        };
    $.post('../Controllers/indexController.php', datos, function(data) {
            if(data.success) {
                window.location.href = '../index.php'; // Redirige al usuario a la página de inicio de sesión
            } else {
                alert('Error al cerrar sesión.');
            }
        });
  }
</script>
</body>
</html>