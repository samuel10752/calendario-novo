<?php

require_once('../db-connect.php');

// Definir codificação para exibir caracteres especiais corretamente
$conn->set_charset("utf8");

// Buscar a lista de todas as turmas
$turmas = $conn->query("SELECT id, nome FROM turma");


// Criar um array associativo contendo os dados das turmas
$data = array();
$data[] = array('id' => 'all', 'nome' => 'Todas as aulas');
while ($row = $turmas->fetch_assoc()) {
    $data[] = $row;
}


// Retornar a resposta JSON
header('Content-Type: application/json');
echo json_encode($data);

$conn->close();

?>
