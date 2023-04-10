<?php
require_once('../db-connect.php');

// Definir codificação para exibir caracteres especiais corretamente
$conn->set_charset("utf8");

// Buscar a lista de usuários
$adms = $conn->query("SELECT DISTINCT usuario.ra_user, usuario.nome, usuario.email,  usuario.tipo
                          FROM usuario
                          WHERE usuario.tipo   = 'docente'
                          ORDER BY usuario.nome ");

// Verificar se existem resultados
if ($adms->num_rows > 0) {
  echo '<table>';
  echo '<tbody id="tabela-corpo-user">';
  // Exibir a tabela
  while ($adm = $adms->fetch_assoc()) {
    echo "<tr>";     
    echo '<td class="btn trigger"  style="width: 43.3%; overflow: hidden;" data-nome="' . $adm['nome'] . '" data-tipo="' . $adm['tipo'] . '"  >' . $adm['nome'] . '</td>';
    echo '<td  style="width: 27.5%; overflow: hidden;">' . $adm['ra_user'] . '</td>';
    echo '<td  style="width: 20%; overflow: hidden;">' . $adm['email'] . '</td>';
    echo '<td  style="width: 35%; overflow: hidden;">' . $adm['tipo'] . '</td>';
    echo "</tr>";     
  }

  echo '</tbody>';
  echo '</table>';

} else {
  echo "Nenhum resultado encontrado.";
}

// Fechar a conexão com o banco de dados
$conn->close();


?>

