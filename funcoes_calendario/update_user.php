<?php 
require_once('../db-connect.php');

if($_SERVER['REQUEST_METHOD'] !='POST'){
    echo "<script> alert('Error: No data to save.'); location.replace('./') </script>";
    $conn->close();
    exit;
}

extract($_POST);
$allday = isset($allday);

// Define $ra before using it in the SQL statement
$ra = isset($_POST['ra']) ? $_POST['ra'] : '';

if(empty($id)){
    $sql = "UPDATE `usuario` set `ra_user` = '{$ra}', `nome` = '{$nome}', `email` = '{$email}', `senha` = '{$senha}', `tipo` = '{$tipo}' where `ra_user` = '{$ra}'";
}

$conn->query($sql); 

$conn->close();
header("Location: ../cadastrarUsuario/listar-user.php");
exit();
?>