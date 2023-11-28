<?php
require_once '../db_config.php';


if ($_POST['Op'] == 'Registro'){
    error_reporting(0);
    $usuario = $_POST['usuario'];
    $correo = $_POST['correo'];
    $contrasena = $_POST['contrasena'];
    
    if (empty($usuario) || empty($contrasena)) {
        $response['success'] = false;
        $response['message'] = "Todos los campos son obligatorios.";
        echo json_encode($response);
    }

    $query = "SELECT * FROM users WHERE usuario = ? LIMIT 1";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $usuario);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    if ($row['usuario'] === $usuario) {
        $response['success'] = false;
        $response['message'] = "Ya existe este usuario en la base de datos";
    } else {
        $query2 = "SELECT * FROM users WHERE correo = ? LIMIT 1";
        $stmt2 = $conn->prepare($query2);
        $stmt2->bind_param("s", $correo);
        $stmt2->execute();
        $result2 = $stmt2->get_result();
        $row2 = $result2->fetch_assoc();
        if($row2['correo'] === $correo){
            $response['success'] = false;
            $response['message'] = "Ya existe este correo en la base de datos";
        } else {
            $contrasenaHash = password_hash($contrasena, PASSWORD_DEFAULT); 
            $insertQuery = "INSERT INTO users (usuario, correo, contrasena) VALUES (?, ?, ?)";
            $insertStmt = $conn->prepare($insertQuery);
            $insertStmt->bind_param("sss", $usuario, $correo, $contrasenaHash);
            $insertResult = $insertStmt->execute();

            if ($insertResult) {
                session_start();
                $_SESSION['usuario'] = $usuario;
                $response['success'] = true;
                $response['message'] = "Registro exitoso.";
            } else {
                $response['success'] = false;
                $response['message'] = "Error al registrar el usuario.";
            }
        }
    }
    echo json_encode($response);
}
?>