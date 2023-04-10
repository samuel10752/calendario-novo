<?php
include('conexao.php');
session_start();
if(isset($_SESSION['mensagem'])) {
    unset($_SESSION['mensagem']);
}
if(isset($_POST['ra_user']) || isset($_POST['senha'])) {

    if(strlen($_POST['ra_user']) == 0) {
        $mensagem = "Preencha seu RA";
    } else if(strlen($_POST['senha']) == 0) {
        $mensagem = "Preencha sua senha";
    } else {

        $ra_user = $mysqli->real_escape_string($_POST['ra_user']);
        $senha = $mysqli->real_escape_string($_POST['senha']);

        $sql_code = "SELECT * FROM usuario WHERE ra_user = '$ra_user' AND senha = '$senha'";
        $sql_query = $mysqli->query($sql_code) or die("Falha na execução do código SQL: " . $mysqli);

        $quantidade = $sql_query->num_rows;

        if($quantidade == 1) {
            
            $usuario = $sql_query->fetch_assoc();

            if(!isset($_SESSION)) {
                session_start();
            }

            $_SESSION['ra_user'] = $usuario['ra_user'];
            $_SESSION['nome'] = $usuario['nome'];
                
            $tipo = $usuario['tipo'];
        
        if($tipo == 'administrador'){
            header("Location: home/home_adm.php");
        } elseif($tipo == 'docente'){
            header("Location: views/user/");
        } else {
            echo "Tipo de usuário inválido";
        }
        } else {
            $mensagem = "Falha ao logar! RA ou senha incorretos";
        }

    }

}
?> 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>.:TU01:.</title>
    <link rel="stylesheet" href="style.css">

    <!-- importe do icon de mostrar senha -->
    <script src="https://kit.fontawesome.com/9b5324f6a3.js" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="login.css">

</head>
<body>

    <div class="container">

        <div class="title">

            <h1>SENAC <br> <span id="h1_baixo"> Ca<span class="letra_title">l</span><span class="letra_title">l</span>endar </span></h1>

            <p>Visualize suas aulas com eficiencia e agilidade</p>

        </div>

        <div class="imagem-principal">
            <img src="./assets/img.png" alt="" width="100%" height="auto">
        </div>

        <div class="formulario-login">

            <form action="" method="POST"class="login_enter">
                <input type="text"  name="ra_user" class="form inp_dados" placeholder="RA">
                <br>

                <div class="inp_senha">
                    <input name="senha" type="password" id="password" class="form inp_dados" placeholder="Senha">
                    <span class="show-btn" id="showPassword"><i class="fas fa-eye"></i></span>
                </div>

                <br>
                <input type="submit"  class="form send_btn" value="Entrar" class="send_btn">

                <?php
                if(isset($mensagem)) {
                    echo "<p>$mensagem</p>";
                }
                    ?>

            </form>

        </div>

    </div>

    <script src="./js.js"></script>
    
</body>
</html>