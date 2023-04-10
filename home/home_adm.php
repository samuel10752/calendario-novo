<!DOCTYPE html>
<html lang="pt-br">
<link href='https://fonts.googleapis.com/css?family=Nunito' rel='stylesheet'>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>.: Home Adm :.</title>
    <link rel="stylesheet" href="home_adm.css" type="text/css">
</head>

<body>

    <!-- navegação -->
    <nav>
        <input type="checkbox" id="nav-toggle">
        <div class="logo">
            <h1>Ca<span1>l</span1><span>l</span>endar</h1>
        </div>
        <ul class="links">

            <li><a href="#">Home</a></li>
            <li><a href="../views/adm/index.php">Calendário</a></li>
            <li><a href=".././telaCursos/index.php">Cursos</a></li>
            <li><a href=".././cadastrarUsuario/listar-user.php">Usuários</a></li>
            <li><a href=".././index.php">Sair</a></li>
        </ul>

        <label for="nav-toggle" class="icon-burger">
            <div class="line"></div>
            <div class="line"></div>
            <div class="line"></div>
        </label>

    </nav>

    <label for="nav-toggle" class="icon-burger">
        <div class="line"></div>
        <div class="line"></div>
        <div class="line"></div>
    </label>

    <!-- corpo da pagina -->
    <?php

include('../protect.php');

?>

    <div class="container">

        <div class="img_principia">
            <img src="./assets/img_base_home.png" alt="">
        </div>

        <div class="info">
            <h1>Seja bem vindo, <?php echo $_SESSION['nome']; ?></h1>
            <p>Bem-vindo ao novo calendário de aulas! Sua presença é essencial para o sucesso do nosso semestre letivo.

Neste calendário, encontrará todas as informações necessárias para gerenciar aulas e eventos relacionados.

Estamos aqui para apoiá-lo e desejamos um semestre produtivo e gratificante.

Atenciosamente, <br> Senac Minas/Turma 0222
            </p>

        </div>

        <div class="img_circle">
            <img src="./assets/two_circle.png" alt="">
        </div>

    </div>

    <?php
require_once('../db-connect.php');

// Definir codificação para exibir caracteres especiais corretamente
$conn->set_charset("utf8");

// Buscar o número total de docentes cadastrados
$total_docentes = $conn->query("SELECT COUNT(*) AS total FROM usuario WHERE tipo = 'docente'");
if ($total_docentes) {
  $total_docentes = $total_docentes->fetch_assoc()['total'];
} else {
  $total_docentes = 0;
}

?>


<?php
require_once('../db-connect.php');

// Definir codificação para exibir caracteres especiais corretamente
$conn->set_charset("utf8");

// Buscar o número total de cursos cadastrados
$total_cursos = $conn->query("SELECT COUNT(*) AS total FROM turma");
if ($total_cursos) {
  $total_cursos = $total_cursos->fetch_assoc()['total'];
} else {
  $total_cursos = 0;
}

?>


<?php
require_once('../db-connect.php');

// Definir codificação para exibir caracteres especiais corretamente
$conn->set_charset("utf8");

// Buscar o número total de cursos cadastrados
$total_uc = $conn->query("SELECT COUNT(*) AS total FROM uc");
if ($total_uc ) {
  $total_uc  = $total_uc ->fetch_assoc()['total'];
} else {
  $total_uc  = 0;
}

?>


    <div class="cards">
        <div class="card">
            <h3>Docentes cadastrados
                

            <p><?php echo $total_docentes; ?></p>
            </h3>
            <img src="assets/imagem1.png" alt="">
        </div>

        <div class="card">
            <h3>Cursos cadastrados
            <p><?php echo $total_cursos; ?></p>
            </h3>
            <img src="assets/imagem2.png" alt="">
        </div>
        <div class="card">
            <h3>UCs cadastrados

            <p><?php echo $total_uc; ?></p>
            </h3>
            <img src="assets/imagem3.png" alt="">
        </div>
    </div>

</body>

</html>