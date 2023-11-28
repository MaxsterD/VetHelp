<?php
require_once '../db_config.php';

if ($_POST['Op'] == 'Login') {
    session_start();
    $usuario = $_POST['usuario'];
    $contrasena = $_POST['contrasena'];
    //var_dump(password_hash($contrasena, PASSWORD_DEFAULT));
    
    if (empty($usuario) || empty($contrasena)) {
        $response['success'] = false;
        $response['message'] = "Todos los campos son obligatorios.";
        echo json_encode($response);
        exit;
    }

    $query = "SELECT * FROM usuarios WHERE usuario = '$usuario' LIMIT 1";
    $result = $conn->query($query);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
       
        if (password_verify($contrasena, $row['Contrasena'])) {
            $_SESSION['usuario'] = $usuario;
            $response['success'] = true;
            $response['message'] = "Iniciando sesion...";
        } else {
            $response['success'] = false;
            $response['message'] = "Contraseña incorrecta.";
        }
    } else {
        $response['success'] = false;
        $response['message'] = "Usuario no encontrado.";
    }

    echo json_encode($response);
}



?>
