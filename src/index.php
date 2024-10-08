<?php
session_start();

if (!isset($_SESSION['usuario_id']) && isset($_COOKIE['usuario_id'])) {
    $_SESSION['usuario_id'] = $_COOKIE['usuario_id'];
}

if (isset($_SESSION['usuario_id'])) {
    echo "Bem-vindo, usuário!";
    echo '<a href="logout.php">Sair</a>';
} else {
    echo "Por favor, faça login.";
    echo '<a href="login.php">Login</a> ou <a href="register.php">Cadastre-se</a>';
}
?>
