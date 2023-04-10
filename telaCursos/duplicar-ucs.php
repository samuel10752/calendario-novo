<?php
require_once('../db-connect.php');

if ($_SERVER['REQUEST_METHOD'] != 'POST') {
  http_response_code(400);
  echo "Error: No data to save.";
  exit;
}

$turma_id = $_POST['turma_id'];

// Desativa a verificação de chaves estrangeiras temporariamente
$conn->query("SET FOREIGN_KEY_CHECKS = 0");

// Gera um ID aleatório único para a nova turma
do {
  $nova_turma_id = rand(1, 999); // Altere o intervalo conforme necessário
  $id_check = $conn->prepare("SELECT id FROM turma WHERE id = ?");
  $id_check->bind_param("i", $nova_turma_id);
  $id_check->execute();
  $id_check->store_result();
} while ($id_check->num_rows > 0);

$id_check->close();

// Insere uma nova turma com o ID aleatório gerado e os mesmos dados da turma selecionada, exceto pelo ID da turma
$stmt = $conn->prepare("INSERT INTO turma (id, nome, tipo, sala, turno, carga_horaria) SELECT ?, nome, tipo, sala, turno, carga_horaria FROM turma WHERE id = ?");
$stmt->bind_param("ii", $nova_turma_id, $turma_id);
$stmt->execute();

// Seleciona todas as unidades curriculares associadas à turma selecionada e as insere na nova turma
$stmt = $conn->prepare("INSERT INTO uc (num_turma, nome_uc, carga_horaria) SELECT ?, nome_uc, carga_horaria FROM uc WHERE num_turma = ?");
$stmt->bind_param("ii", $nova_turma_id, $turma_id);
$stmt->execute();

// Ativa a verificação de chaves estrangeiras novamente
$conn->query("SET FOREIGN_KEY_CHECKS = 1");

// Fecha a conexão com o banco de dados
$stmt->close();

// Retorna uma mensagem de sucesso para a solicitação AJAX
echo "Turma duplicada com sucesso!";
?>
