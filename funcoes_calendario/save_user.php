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
  $sql = "INSERT INTO `usuario` (`ra_user`,`nome`,`email`,`senha`,`tipo`) VALUES ('$ra','$nome','$email','$senha','$tipo')";
}

$conn->query($sql); 

$conn->close();
header("Location: ../cadastrarUsuario/listar-user.php");
exit();
?>