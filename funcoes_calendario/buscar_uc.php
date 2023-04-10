<?php
require_once('../db-connect.php');

// Definir codificação para exibir caracteres especiais corretamente
$conn->set_charset("utf8");

// Verificar se o parâmetro "search" foi passado
if (isset($_GET['search'])) {
    $search = $_GET['search'];
} else {
    $search = '';
}

// Buscar a lista de turmas com nome contendo o parâmetro "search"
$turmas = $conn->prepare("SELECT id, nome_uc, num_turma FROM uc WHERE nome_uc LIKE ?");
$turmas->bind_param('s', $search_query);
$search_query = '%' . $search . '%';
$turmas->execute();
$turmas->bind_result($id, $nome_uc, $num_turma);

// Criar um array associativo contendo os dados das turmas
$data = array();
while ($turmas->fetch()) {
    $data[] = array('id' => $id, 'nome_uc' => $nome_uc, 'turma' => $num_turma);
}
            

// Retornar a resposta JSON
header('Content-Type: application/json');
echo json_encode($data);


$conn->close();
?>
