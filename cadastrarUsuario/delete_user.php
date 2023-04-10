<?php 
require_once('../db-connect.php');

// Verifica se o parâmetro ra_user foi passado
if(!isset($_GET['ra_user'])){
    echo "<script> alert('ID de usuário indefinido.'); location.replace('./') </script>";
    $conn->close();
    exit;
}

$ra = $_GET['ra_user'];

// Desabilita a verificação de chave estrangeira temporariamente
$conn->query("SET foreign_key_checks = 0");

// Prepara as declarações de exclusão
$delete1 = $conn->prepare("DELETE FROM docentes WHERE ra = ?");
$delete1->bind_param("s", $ra);
$delete2 = $conn->prepare("DELETE FROM usuario WHERE ra_user = ?");
$delete2->bind_param("s", $ra);

// Executa as consultas de exclusão e verifica se ocorreu algum erro
if ($delete1->execute() && $delete2->execute()) {
    $conn->query("SET foreign_key_checks = 1"); // Reabilita a verificação de chave estrangeira
    $conn->close();
    header("Location: .././cadastrarUsuario/listar-user.php");
    exit();
} else {
    $conn->query("SET foreign_key_checks = 1"); // Reabilita a verificação de chave estrangeira
    $conn->close();
    exit();
}
?>
