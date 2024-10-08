<?php
session_start();
session_unset();
session_destroy();

// Remover cookie também
setcookie('usuario_id', '', time() - 3600, "/");

echo "Você saiu do sistema.";
?>
