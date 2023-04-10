<?php
require_once('../db-connect.php');

// Definir codificação para exibir caracteres especiais corretamente
$conn->set_charset("utf8");

// Inicializa um array para armazenar os usuários
$usuarios = array();

// Buscar a lista de usuários
$adms = $conn->query("SELECT DISTINCT usuario.ra_user, usuario.nome, usuario.email,  usuario.tipo
                          FROM usuario
                          WHERE usuario.tipo = 'docente'
                          ORDER BY usuario.nome ");

// Verificar se existem resultados
if ($adms->num_rows > 0) {

  // Exibir a tabela
  while ($adm = $adms->fetch_assoc()) {
    // Adiciona o usuário ao array de usuários
    $usuario = array(
      "nome" => $adm['nome'],
      "ra" => $adm['ra_user'],
      "email" => $adm['email'],
      "tipo" => $adm['tipo']
    );
    array_push($usuarios, $usuario);
  }

  // Retorna o array de usuários como um JSON válido
  header('Content-Type: application/json');
  echo json_encode($usuarios);

} else {
  // Retorna uma mensagem de erro como um JSON válido
  header('Content-Type: application/json');
  echo json_encode(array("message" => "Nenhum resultado encontrado."));
}

// Fechar a conexão com o banco de dados
$conn->close();
?>
