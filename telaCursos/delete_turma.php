<?php
require_once('../db-connect.php');

// Verifica se o parâmetro id foi passado
if (!isset($_GET['id'])) {
    echo "<script> alert('ID de usuário indefinido.'); location.replace('./') </script>";
    $conn->close();
    exit;
}

$id = $_GET['id'];

// Desabilita temporariamente a verificação de chave estrangeira
$conn->query("SET foreign_key_checks = 0");

// Prepara as declarações de exclusão
$delete1 = $conn->prepare("DELETE FROM uc WHERE num_turma = ?");
$delete1->bind_param("s", $id);
$delete2 = $conn->prepare("DELETE FROM turma WHERE id = ?");
$delete2->bind_param("s", $id);

// Executa as consultas de exclusão e verifica se ocorreu algum erro
if ($delete1->execute() && $delete2->execute()) {
    // Reabilita a verificação de chave estrangeira
    $conn->query("SET foreign_key_checks = 1");
    $conn->close();
    header('Location: ../telaCursos/index.php'); // Redireciona para a tela principal
    exit();
} else {
    // Reabilita a verificação de chave estrangeira
    $conn->query("SET foreign_key_checks = 1");
    $conn->close();
    header('Location: ../telaCursos/index.php'); // Redireciona para a tela principal
    exit();
}
?>
