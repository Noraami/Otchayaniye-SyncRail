<?php
// conexao.php
// Conexão simples ao MySQL usando mysqli (XAMPP). Ajuste usuário/senha se necessário.

$host     = "localhost";
$usuario  = "root";
$senha    = "root";
$banco    = "tsf";

// Cria a conexão
$conn = new mysqli($host, $usuario, $senha, $banco);

// Verifica erro de conexão
if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}

$stmt=$conn->prepare("ALTER TABLE USUARIO AUTO_INCREMENT = 1");
$stmt->execute();

// Força charset utf8 para acentuação
$conn->set_charset("utf8");

// Opcional: define timezone (se for importante para consultas/datas)
date_default_timezone_set("America/Sao_Paulo");