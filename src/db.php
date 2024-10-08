<?php
$host = 'db';  // nome do serviço no Docker Compose
$db   = 'emmy';
$user = 'postgres';
$pass = 'postgres';
$port = '5432';
$dsn  = "pgsql:host=$host;port=$port;dbname=$db;";

try {
    $pdo = new PDO($dsn, $user, $pass, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
} catch (PDOException $e) {
    die('Erro ao conectar ao banco de dados: ' . $e->getMessage());
}
?>
