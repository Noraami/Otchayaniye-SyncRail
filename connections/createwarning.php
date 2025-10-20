<?php
require_once('db.php');

session_start();

$titulo = $_POST['tituloAlerta'] ?? '';
$descricao = $_POST['descricao'] ?? '';

$stmt = $conn->prepare("INSERT INTO alertas (alerta_titulo, fk_user, alerta_texto, alerta_data) VALUES (?, ?, ?, NOW())");
$stmt->bind_param("sis", $titulo, $_SESSION['professor_id'], $descricao);

if ($stmt->execute()) {
    header("Location: ../pages/status.php");
    exit;
} else {
    echo "Erro ao inserir: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>