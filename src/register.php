<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Permite requisições de qualquer origem (CORS)
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");

// Verifica se é uma requisição OPTIONS (para CORS)
if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    http_response_code(200);
    exit();
}

require 'db.php';

// Verifica se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (!empty($_POST['email']) && !empty($_POST['nome']) && !empty($_POST['senha'])) {
        $email = $_POST['email'];
        $nome = $_POST['nome'];
        $senha = $_POST['senha'];

        // Verificar se o email é válido
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo "Email inválido.";
            exit();
        }

        // Verificar se o email já está registrado
        $sql = "SELECT email FROM usuarios WHERE email = :email";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['email' => $email]);
        $usuarioExistente = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($usuarioExistente) {
            echo "E-mail já está registrado. Por favor, use um email diferente.";
        } else {
            // Gerar o hash da senha
            $senhaHashed = password_hash($senha, PASSWORD_BCRYPT);

            // Inserir novo usuário no banco de dados
            $sql = "INSERT INTO usuarios (email, nome, senha) VALUES (:email, :nome, :senha)";
            $stmt = $pdo->prepare($sql);
            $stmt->execute(['email' => $email, 'nome' => $nome, 'senha' => $senhaHashed]);

            echo "Usuário registrado com sucesso!";
        }
    } else {
        echo "Por favor, preencha todos os campos.";
    }
} else {
    echo "Método de requisição inválido.";
}
?>

<!-- Formulário de registro -->
<form method="POST">
    Email: <input type="email" name="email" required>
    Nome: <input type="text" name="nome" required>
    Senha: <input type="password" name="senha" required>
    <button type="submit">Cadastrar</button>
</form>
