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
        // Buscar todos os usuários
        $usuarios = $conn->query("SELECT ra_user, nome, email, tipo, COUNT(*) AS total FROM usuario GROUP BY nome ORDER BY nome");
    } else {
        // Buscar a lista de usuários que correspondem à busca
        $usuarios = $conn->query("SELECT ra_user, nome, email, tipo, COUNT(*) AS total FROM usuario WHERE nome LIKE '%$campo%' GROUP BY nome ORDER BY nome");
    }

// Verificar se existem resultados
if ($usuarios->num_rows > 0) {

  // Exibir a tabela
  echo  '<table class="tabela_listagem">';
  echo   '<thead>';
  echo    '</thead>';
   echo   '<tbody id="tabela-corpo-todos">';
  while ($usuario = $usuarios->fetch_assoc()) {
    echo "<tr>";     
    echo '<td class="btn trigger"  style="width: 43.3%; overflow: hidden;" data-nome="' . $usuario['nome'] . '" data-tipo="' . $usuario['tipo'] . '"  >' . $usuario['nome'] . '</td>';
    echo '<td  style="width: 27.5%; overflow: hidden;">' . $usuario['ra_user'] . '</td>';
    echo '<td  style="width: 20%; overflow: hidden;">' . $usuario['email'] . '</td>';
    echo '<td  style="width: 35%; overflow: hidden;">' . $usuario['tipo'] . '</td>';
    echo '</tr>';
  }
echo '
</tbody>';
echo '    </table>';

} else {
  echo "Nenhum resultado encontrado.";
}
}
?>

