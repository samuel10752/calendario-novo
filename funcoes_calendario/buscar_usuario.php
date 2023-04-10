<?php
require_once('../db-connect.php');

// Verificar se o parâmetro "search" foi passado
if (isset($_GET['search'])) {
    $search = $_GET['search'];
} else {
    $search = '';
}

// Buscar a lista de usuários do tipo "docente" com nome contendo o parâmetro "search"
$usuarios = $conn->prepare("SELECT nome, ra_user FROM usuario WHERE tipo='docente' AND nome LIKE ?");
$usuarios->bind_param('s', $search_query);
$search_query = '%' . $search . '%';
$usuarios->execute();
$usuarios->bind_result($nome, $ra_user);

// Criar um array associativo contendo os dados dos usuários
$data = array();
while ($usuarios->fetch()) {
    $data[] = array('nome' => $nome, 'ra_user' => $ra_user);
}

// Retornar a resposta JSON
header('Content-Type: application/json');
echo json_encode($data);

$conn->close();
?>
