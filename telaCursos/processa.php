<?php
require_once('../db-connect.php');

// Definir codificação para exibir caracteres especiais corretamente
$conn->set_charset("utf8");

// Verificar se o valor de busca foi recebido
if (isset($_POST['campo'])) {
    // Escapar o valor de busca para evitar injeção de SQL
    $campo = $conn->real_escape_string($_POST['campo']);

    // Verificar se o valor de busca é "all"
    if ($campo == "all") {
        // Buscar todas as turmas
        $turmas = $conn->query("SELECT turma.nome, turma.id, turma.tipo,turma.sala,turma.turno, turma.carga_horaria, COUNT(uc.nome_uc) AS total_uc, GROUP_CONCAT(uc.nome_uc SEPARATOR '<br>') AS ucs_nome, GROUP_CONCAT(uc.carga_horaria SEPARATOR '<br>') AS ucs_carga_horaria FROM turma LEFT JOIN uc ON turma.id = uc.num_turma GROUP BY turma.id ORDER BY turma.nome");
    // adicionas um "id as GROUP BY nome ORDER BY nome"
    } else {
        // Buscar a lista de turmas que correspondem à busca
        $turmas = $conn->query("SELECT nome, id, tipo, sala, turno, carga_horaria, COUNT(*) AS total 
        FROM turma 
        WHERE nome LIKE '%$campo%' OR id LIKE '%$campo%' 
        GROUP BY id, nome 
        ORDER BY id, nome");
    }

    // Verificar se existem turmas correspondentes
    if ($turmas->num_rows > 0) {
        echo '<table>';
        echo '<tbody id="conteudo">';

        // Loop para exibir cada turma
        while ($turma = $turmas->fetch_assoc()) {
            echo "<tr>";
            echo '<td class="btn trigger" data-turma-id="'.$turma['id'].'" data-id="'.$turma['id'].'">' . $turma['id'] . '</td>';
            echo '<td>' . $turma['sala'] . '</td>';
            echo '<td>' . $turma['tipo'] . '</td>';
            echo '<td>' . $turma['turno'] . '</td>';
            echo "</tr>";
          }
        echo '</tbody>';
        echo '</table>';
    } else {
        echo '<p>Não foram encontradas turmas com esse nome.</p>';
    }
}
?>