<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");

session_start();
require 'db.php'; // Inclua o arquivo db.php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $contentType = isset($_SERVER["CONTENT_TYPE"]) ? trim($_SERVER["CONTENT_TYPE"]) : '';

    if ($contentType === "application/json") {
        // Receber os dados JSON
        $content = trim(file_get_contents("php://input"));
        $decoded = json_decode($content, true);

        $email = $decoded['email'] ?? null;
        $senha = $decoded['senha'] ?? null;
    } elseif ($contentType === "application/x-www-form-urlencoded") {
        $email = $_POST['email'] ?? null;
        $senha = $_POST['senha'] ?? null;
    } else {
        $response = array(
            'success' => false,
            'message' => 'Content-Type inválido. Esperado application/json ou application/x-www-form-urlencoded',
        );
        echo json_encode($response);
        exit();
    }

    if ($email && $senha) {
        $sql = "SELECT id, nome, senha FROM usuarios WHERE email = :email";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['email' => $email]);
        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($usuario) {
            // Removendo mensagens de depuração
            if (password_verify($senha, $usuario['senha'])) {
                $_SESSION['usuario_id'] = $usuario['id'];
                $response = array(
                    'success' => true,
                    'message' => 'Login realizado com sucesso!',
                    'user' => array(
                        'name' => $usuario['nome'],
                        'loginTime' => date('Y-m-d H:i:s'),
                        'email' => $email
                    )
                );
                echo json_encode($response);
            } else {
                $response = array(
                    'success' => false,
                    'message' => 'Senha inválida.',
                );
                echo json_encode($response);
            }
        } else {
            $response = array(
                'success' => false,
                'message' => 'E-mail não encontrado.',
            );
            echo json_encode($response);
        }
    } else {
        $response = array(
            'success' => false,
            'message' => 'Por favor, preencha todos os campos.',
        );
        echo json_encode($response);
    }
} else {
    $response = array(
        'success' => false,
        'message' => 'Método de requisição inválido.',
    );
    echo json_encode($response);
}
?>
