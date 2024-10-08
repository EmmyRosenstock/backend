<?php
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    // Gerar o hash da senha
    $senha_hash = password_hash($senha, PASSWORD_DEFAULT);

    // Inserir usuário no banco de dados
    $sql = "INSERT INTO usuarios (email, senha_hash) VALUES (:email, :senha_hash)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['email' => $email, 'senha_hash' => $senha_hash]);

    echo "Usuário cadastrado com sucesso!";
}
?>

<form method="POST">
    Email: <input type="email" name="email" required>
    Senha: <input type="password" name="senha" required>
    <button type="submit">Cadastrar</button>
</form>
