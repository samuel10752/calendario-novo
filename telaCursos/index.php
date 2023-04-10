<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <!-- passa o link abaixo comentado pra local host  quem ????????????? n sei-->
    <!-- <script src="https://kit.fontawesome.com/43dcc20e7a.js" crossorigin="anonymous"></script> -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <script src="../js/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <title>TelaCursos</title>
</head>

<body>

    <div class="container">
        <div vlass="header">
            <!-- navegação -->

            <nav>
                <input type="checkbox" id="nav-toggle">
                <div class="logo">
                    <h1>Ca<span1>l</span1><span>l</span>endar</h1>
                </div>
                <ul class="links">

                    <li><a href="../home/home_adm.php">Home</a></li>
                    <li><a href="../views/adm/index.php">Calendário</a></li>
                    <li><a href="#">Cursos</a></li>
                    <li><a href="../cadastrarUsuario/listar-user.php">Usuarios</a></li>
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

        </div>


        <div class="title">
            <h1 class="listagem">Cursos Cadastrados:</h1>
            <h1 class="detalhes-curso">Nome do curso em detalhes</h1>



            <div class="detalhes-curso double-btn">
                <!-- <button class="btn-duplicar-uc">Duplicar UCS</button> -->
            </div>


        </div>


        <div class="search">

            <div class="meio-filtro listagem">
                <form id="pesquisa">
                    <div class="input-group">
                        <input type="text" class="search" name="campo" id="campo" placeholder="Procurar Curso"
                            autocomplete="off">
                        <!--<button type="button" id="btn-buscar"><i class="fas fa-search"></i></button>-->
                    </div>
                    <div class="suggestion-list hidden"></div>
                </form>
            </div>
        </div>

        <div class="main">

            <div class="conti-table listagem">
                <div class="limha-th">
                    <p><b>Código:</b></p>
                    <p><b>Nome do curso:</b></p>
                    <p><b>Sala Comum:</b></p>
                    <p><b>Turno:</b></p>
                </div>

            </div>

            <section id="resultado" class="listagem">

                <?php  require_once('buscar_cursos.php') ?>

            </section>


        </div>


        <div class="aside">
            <div class="add_listagem">
                <div class="top-add">
                    Cadastrar Curso
                </div>

                <div class="form-add">
                    <form action=".././funcoes_calendario/save_curso.php" method="post">
                        <div class="user__details">
                            <div class="input__box1">
                                <span class="details">Nome:</span> <br>
                                <input type="text" placeholder="Ex: Desenvolvimento de Sistemas" name="nome" id="nome"
                                    pattern="[a-zA-Z\s]+" required>
                            </div>
                            <div class="input__box">
                                <span class="details">Eixo:</span> <br>
                                <!-- <input type="text" placeholder="Ex: Técnico/Técnologo" name="tipo" id="tipo"  required> -->
                                <select name="eixo" id="eixo">
                                    <option value="#" selected disable>Selecione um tipo de curso</option>
                                    <option value="PSG">PSG</option>
                                    <option value="Pago">VDC</option>
                                    <option value="Trilhas">Trilhas</option>
                                    <option value="Aprendizagem">Aprendizagem</option>
                                    <option value="MBA">MBA</option>
                                </select>
                            </div>
                            <div class="input__box">
                                <span class="details">Código da Turma:</span> <br>
                                <input type="text" placeholder="Ex: 0222 " required
                                    onkeypress="return event.charCode >= 48 && event.charCode <= 57" name="codigo"
                                    id="codigo">
                            </div>
                            <div class="input__box">
                                <span class="details">Turno:</span> <br>
                                <select name="turno" id="turno">
                                    <option value="#" selected disable>Selecione o turno</option>
                                    <option value="Matutino">Matutino</option>
                                    <option value="Vespertino">Vespertino</option>
                                    <option value="Noturno">Noturno</option>
                                </select>
                            </div>
                            <div class="input__box">
                                <span class="details">Sala:</span> <br>
                                <input type="text" placeholder="Ex: Sala 16 ou Laboratório 16" name="sala" id="sala"
                                    required>
                            </div>

                            <div class="input__box">
                                <span class="details">Carga horária:</span> <br>
                                <input type="text" placeholder="Ex: 1200" name="carga_horaria" id="carga_horaria"
                                    required>
                            </div>


                        </div>
                        <div class="button btn-add">
                            <input id="btn-cds" type="submit" value="Cadastrar Curso">
                        </div>
                        <div class="button3 reset-btn">
                            <input id="btn-cds2" type="reset">
                        </div>
                    </form>
                </div>
            </div>



            <div class="detalhes-curso add">
                <div class="top-add">
                    Cadastrar UC
                </div>

                <div class="form-add add-curso">
                    <form action="../funcoes_calendario/save_uc.php" method="post">
                        <div class="user__details">
                            <div class="input__box1">
                                <span class="details">Nome:</span>
                                <input type="text" name="nome" id="nome" placeholder="Nome da UC" required>
                            </div>
                            <div class="input__box">
                                <span class="details">Código da Turma:</span>
                                <input type="text" name="codigo" id="codigo" placeholder="Número da turma" required>
                            </div>
                            <div class="input__box">
                                <span class="details">Carga Horária:</span>
                                <input type="text" name="carga_horaria" id="carga_horaria" placeholder="Horas da UC"
                                    required>
                            </div>

                            <div class="input__box">
                                <span class="details">Número da UC:</span>
                                <input type="text" name="numero_uc" id="numero_uc" placeholder="Número da UC" required>
                            </div>


                        </div>
                        <div id="btn-uc" class="button1 btn-add btn-detalhe">
                            <input type="submit" id="save-uc"  onclick="saveUC()"  value="Salvar">
                        </div>
                        <div id="btn-reset" class="button3 reset-btn">
                            <input type="reset">
                        </div>
                    </form>
                </div>
            </div>
        </div>


        <div class="footer">

            <div class="footer-detalhe">
                <img id="bola" src="img/Img-bola.png" alt="">
            </div>

            <div class="faq">
                <a href="../faq/index.html">
                    <img src="img/faq.png">
                </a>
            </div>

        </div>

    </div>

    </div>

    <script src="pi.js"></script>
    <script src="novo-js.js"></script>

</body>

</html>