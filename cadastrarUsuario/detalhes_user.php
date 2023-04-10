<?php
require_once('../db-connect.php');

// Definir codificação para exibir caracteres especiais corretamente
$conn->set_charset("utf8");


// Obter a ra passada via parâmetro na URL
if (isset($_GET['ra'])) {
  $ra = $_GET['ra'];
  // Resto do código
} else {
  // Retornar mensagem de erro
  header('Content-Type: application/json');
  echo json_encode(array('erro' => 'RA não informado.'));
}

// Buscar o usuário com a ra igual àquela passada via parâmetro
$stmt = $conn->prepare("SELECT * FROM usuario WHERE ra_user = ?");
$stmt->bind_param("i", $ra);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
  // Retornar o primeiro (e único) usuário encontrado
  $usuario = $result->fetch_assoc();
  $ra_user = $usuario['ra_user']; // Definir a variável $ra_user para o valor do RA do usuário encontrado
  header('Content-Type: application/json');
  echo json_encode($usuario);
} else {
  // Retornar mensagem de erro
  header('Content-Type: application/json');
}

// Fechar conexão com o banco de dados
$stmt->close();
$conn->close();
?>