<?php
require_once('../db-connect.php');

if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    echo "<script> alert('Error: No data to save.'); location.replace('./') </script>";
    $conn->close();
    exit;
}

extract($_POST);
var_dump($_POST); // Adicione esta linha
$allday = isset($allday);

if (empty($id)){
    $sql = "INSERT INTO `turma` (`id`,`nome`,`tipo`,`sala`,`turno`,`carga_horaria`) VALUES ('$codigo','$nome','$eixo','$sala','$turno','$carga_horaria')";
}

$conn->query($sql);

$conn->close();
header("Location: ../telaCursos/index.php"); // substitua a barra com a URL da sua página inicial
exit();
?>
