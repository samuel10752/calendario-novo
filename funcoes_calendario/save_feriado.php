<?php 
require_once('../db-connect.php');
if($_SERVER['REQUEST_METHOD'] !='POST'){
    echo "<script> alert('Error: No data to save.'); location.replace('./') </script>";
    $conn->close();
    exit;
}
extract($_POST);
$allday = isset($allday);

if(empty($id)){
  $sql = "INSERT INTO `feriado` (`titulo`,`descricao`,`horario_inicio`,`horario_fim`) VALUES ('$titulo','$descricao','$horario_inicio','$horario_fim')";
}else{
  $sql = "UPDATE `feriado` set `titulo` = '{$titulo}', `descricao` = '{$descricao}', `horario_inicio` = '{$horario_inicio}', `horario_fim` = '{$horario_fim}' where `id` = '{$id}'";
}
$conn->query($sql); 

$conn->close();
header("Location:../views/adm/index.php"); // substitua a barra com a URL da sua página inicial
exit();
?>