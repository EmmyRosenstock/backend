<?php
session_start();
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    // Verificar o e-mail no banco de dados
    $sql = "SELECT id, senha_hash FROM usuarios WHERE email = :email";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['email' => $email]);
    $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($usuario && password_verify($senha, $usuario['senha_hash'])) {
        // Iniciar a sessão
        $_SESSION['usuario_id'] = $usuario['id'];

        // Manter o usuário logado
        if (isset($_POST['lembrar'])) {
            setcookie('usuario_id', $usuario['id'], time() + (86400 * 30), "/");
        }

        echo "Login realizado com sucesso!";
    } else {
        echo "E-mail ou senha inválidos.";
    }
}
?>

<form method="POST">
    Email: <input type="email" name="email" required>
    Senha: <input type="password" name="senha" required>
    <label>
        <input type="checkbox" name="lembrar"> Lembrar-me
    </label>
    <button type="submit">Login</button>
</form>
