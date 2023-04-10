<?php

require_once('../db-connect.php');

// Definir codificação para exibir caracteres especiais corretamente
$conn->set_charset("utf8");

// Buscar a lista de turmas com as UCs cadastradas
$turmas_uc = $conn->query("SELECT turma.nome, turma.id, turma.tipo,turma.sala,turma.turno, turma.carga_horaria, COUNT(uc.nome_uc) AS total_uc, GROUP_CONCAT(uc.nome_uc SEPARATOR '<br>') AS ucs_nome, GROUP_CONCAT(uc.carga_horaria SEPARATOR '<br>') AS ucs_carga_horaria, GROUP_CONCAT(uc.id SEPARATOR '<br>') AS ucs_id, GROUP_CONCAT(uc.num_turma SEPARATOR '<br>') AS ucs_codigo  FROM turma LEFT JOIN uc ON turma.id = uc.num_turma GROUP BY turma.id ORDER BY turma.nome");


// Verificar se existem turmas correspondentes
if ($turmas_uc->num_rows > 0) {
  $turmas = array();
  
  // Loop para exibir cada turma com as UCs cadastradas
  while ($turma_uc = $turmas_uc->fetch_assoc()) {
    $turmas[] = array(
        'id' => $turma_uc['id'],
        'nome' => $turma_uc['nome'],
        'tipo' => $turma_uc['tipo'],
        'sala' => $turma_uc['sala'],
        'turno' => $turma_uc['turno'],
        'carga_horaria' => $turma_uc['carga_horaria'],
        'total_uc' => $turma_uc['total_uc'],
        'ucs_codigo' => $turma_uc['ucs_codigo'], // Adicione esta linha
        'ucs_id' => $turma_uc['ucs_id'], // Adicione esta linha
        'ucs_nome' => $turma_uc['ucs_nome'],
        'ucs_carga_horaria' => $turma_uc['ucs_carga_horaria']
    );
}

  
  // Codificar o array em JSON
  $json_turmas = json_encode($turmas);
  echo $json_turmas;
} else {
  echo '{"error": "Não foram encontradas turmas com UCs cadastradas."}';
}

// Fechar a conexão com o banco de dados
$conn->close();

?>
