<?php
require_once '../db_config.php';

if ($_POST['Op'] == 'Login') {
    $usuario = $_POST['usuario'];
    $contrasena = $_POST['contrasena'];
    
    if (empty($usuario) || empty($contrasena)) {
        $response['success'] = false;
        $response['message'] = "Todos los campos son obligatorios.";
        echo json_encode($response);
        exit;
    }

    $query = "SELECT * FROM users WHERE usuario = ? LIMIT 1";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $usuario);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
       
        if (password_verify($contrasena, $row['contrasena'])) {
            session_start();
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
