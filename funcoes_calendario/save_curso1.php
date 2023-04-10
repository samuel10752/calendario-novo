<?php
require_once('../db-connect.php');

if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    echo "<script> alert('Error: No data to save.'); location.replace('./') </script>";
    $conn->close();
    exit;
}

extract($_POST);
$allday = isset($allday);

if (empty($id)) {
    $sql = "INSERT INTO `turma` (`id`,`nome`,`tipo`,`sala`,`turno`,`carga_horaria`) VALUES ('$codigo','$nome','$eixo','$sala','$turno','$carga_horaria') ON DUPLICATE KEY UPDATE `nome` = VALUES(`nome`), `tipo` = VALUES(`tipo`), `sala` = VALUES(`sala`), `turno` = VALUES(`turno`), `carga_horaria` = VALUES(`carga_horaria`)";
} else {
    $sql = "UPDATE `turma` set `id` = '{$codigo}', `nome` = '{$nome}', `tipo` = '{$eixo}', `sala` = '{$sala}', `turno` = '{$turno}', `carga_horaria` = '{$carga_horaria}' where `id` = '{$id}'";
}

$conn->query($sql);

$conn->close();
header("Location: ../telaCursos/index.php"); // substitua a barra com a URL da sua página inicial
exit();
?>
