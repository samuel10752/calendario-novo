<?php
session_start();
require_once('../db-connect.php');

$conn->set_charset("utf8");

if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    echo "<script> alert('Error: No data to save.'); location.replace('./') </script>";
    $conn->close();
    exit;
}

extract($_POST);
$allday = isset($allday);

if (empty($id)) {
    $sql = "INSERT INTO `uc` (`id`,`nome_uc`,`num_turma`,`carga_horaria`) VALUES ('$numero_uc','$nome','$codigo','$carga_horaria') ON DUPLICATE KEY UPDATE `nome_uc` = '{$nome}', `num_turma` = '{$codigo}', `carga_horaria` = '{$carga_horaria}'";
} else {
    $sql = "UPDATE `uc` set `id` = '{$numero_uc}', `nome_uc` = '{$nome}', `num_turma` = '{$codigo}', `carga_horaria` = '{$carga_horaria}' where `id` = '{$id}'";
}

try {
    $conn->query($sql);
    if ($carga_horaria > 0) { // Verifica se a carga horária é maior que zero
        header("Location: .././telaCursos/index.php"); // Redireciona o usuário para a página inicial
    } else {
        echo "<script> alert('Carga horária da UC não pode ser maior do que a da Turma.'); location.replace('.././telaCursos/index.php') </script>"; // Exibe mensagem de erro e redireciona o usuário para a página anterior
    }
} catch (mysqli_sql_exception $e) {
    http_response_code(400);
    echo json_encode(['error' => $e->getMessage()]);
    $conn->close();
    exit();
}
?>
