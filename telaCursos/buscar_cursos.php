<?php
require_once('../db-connect.php');

// Consulta o ID da última turma adicionada
$stmt = $conn->prepare("SELECT id FROM turma ORDER BY id DESC LIMIT 1");
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();
$turma_id = $row['id'];

// Definir codificação para exibir caracteres especiais corretamente
$conn->set_charset("utf8");

// Buscar a lista de turmas
$turmas_uc = $conn->query("SELECT turma.nome, turma.id, turma.tipo,turma.sala,turma.turno, turma.carga_horaria, COUNT(uc.nome_uc) AS total_uc, GROUP_CONCAT(uc.nome_uc SEPARATOR '<br>') AS ucs_nome, GROUP_CONCAT(uc.carga_horaria SEPARATOR '<br>') AS ucs_carga_horaria FROM turma LEFT JOIN uc ON turma.id = uc.num_turma GROUP BY turma.id ORDER BY turma.nome");


// Verificar se existem turmas correspondentes
if ($turmas_uc->num_rows > 0) {
  echo '<table>';
  echo '<tbody class="btn trigger" id="conteudo">';

  // Loop para exibir cada turma com as UCs cadastradas
  while ($turma_uc = $turmas_uc->fetch_assoc()) {
    echo '<tr class="teste">';
    echo '<td class="btn trigger" data-turma-id="' . $turma_uc['id'] . '" class="btn trigger" data-nome="' . $turma_uc['tipo'] . '" class="btn trigger" data-tipo="' . $turma_uc['tipo'] . '" data-id="' . $turma_uc['id'] . '">' . $turma_uc['id'] . '</td>';
    echo '<td onclick="redirectToDetails(' . $turma_uc['id'] . ')">' . $turma_uc['nome'] . '</td>';
    echo '<td onclick="redirectToDetails(' . $turma_uc['id'] . ')">' . $turma_uc['sala'] . '</td>';
    echo '<td onclick="redirectToDetails(' . $turma_uc['id'] . ')">' . $turma_uc['turno'] . '</td>';
    echo '</tr>';
  }

  echo '</tbody>';
  echo '</table>';
} else {
  echo '<p> Não foram encontradas turmas com esse nome. </p>';
}

// Fechar a conexão com o banco de dados
$conn->close();
?>