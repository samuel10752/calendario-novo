<?php 
require_once('db-connect.php');
if($_SERVER['REQUEST_METHOD'] !='POST'){
    echo "<script> alert('Error: No data to save.'); location.replace('./') </script>";
    $conn->close();
    exit;
}
extract($_POST);
$allday = isset($allday);

// Erro quando vai salvar no banco de dados assim, verificar o problema e fazefr a correção. ( erro no insert e chave estrangeira )
if(empty($id)){   // alterado de ra_docente para usuario_id para o novo banco de daods
    $sql = "INSERT INTO `calendario_de_aula` (`usuario_id`,`id_uc`,`horario_inicio`,`horario_fim`) VALUES ('$title','$description','$start_datetime','$end_datetime')";
}else{
    $sql = "UPDATE `calendario_de_aula` set `usuario_id` = '{$title}', `id_uc` = '{$description}', `horario_inicio` = '{$start_datetime}', `horario_fim` = '{$end_datetime}' where `id` = '{$id}'";
}

$save = $conn->query($sql);
// if ($save) {
//     // teste notificação depois de criar aula
//   // exibe a mensagem de sucesso e redireciona para a página inicial
//   echo "<div>Cadastro realizado com sucesso.</div>";
//   echo "<script>
//           setTimeout(function() {
//             window.location.href = 'index.php';
//           }, 3000); // a mensagem ficará visível por 3 segundos
//         </script>";
// } else {
//   // exibe a mensagem de erro e recarrega a página atual
//   echo "<div>Erro ao realizar cadastro.</div>";
//   echo "<script>
//           setTimeout(function() {
//             window.location.reload();
//           }, 3000); // a mensagem ficará visível por 3 segundos
//         </script>";
// }


$conn->close();

// // redireciona o usuário para a página inicial
header("Location: http://localhost/calendario-novo/"); // substitua a barra com a URL da sua página inicial
exit();


?>