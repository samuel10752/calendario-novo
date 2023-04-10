5
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>.: Listagem de user :.</title>
    <link rel="stylesheet" href="listar-user.css">
    <script src="../js/jquery-3.6.0.min.js"></script>
</head>

<body>

    <div class="container">

        <header>
            <nav class="navega-color">
                <input type="checkbox" id="nav-toggle">
                <div class="logo">
                    <h1>Ca<span1>l</span1><span>l</span>endar</h1>
                </div>
                <ul class="links">




                    <li><a href="../home/home_adm.php">Home</a></li>
                    <li><a href="../views/adm/index.php">Calendário</a></li>
                    <li><a href=".././telaCursos/index.php">Cursos</a></li>
                    <li><a href="#">Usuarios</a></li>
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
        </header>

        <main>
            <div class="actions">
                <!-- botoes e pesquisa -->

                <div class="campo_pesquisa">
                    <form action="" class="search_user">
                        <input type="text" id="campo" placeholder="Pesquise aqui">
                        <img src="#" alt="">
                    </form>
                </div>

                <div class="three_crud">
                    <!-- <img src="./assets/trash.png" alt="">
                    <img src="./assets/magicpen.png" class="open_modal-Edit" alt=""> -->
                    <img src="./assets/create-add.png" class="open_modalUser" alt="">
                </div>

                <div class="swith_type">
                    <div class="button-group">
                        <button class="button-change active" data-color="orange">Todos</button>
                        <button class="button-change" data-color="gray">Docente</button>
                        <button class="button-change" data-color="gray1">Supervisor</button>
                    </div>
                </div>

            </div>

            <div class="tables">
                <!-- as duas tables -->

                <div class="table_todos">
                    <h1>Todos Usuários</h1>
                    <table class="tabela_listagem">
                        <thead>
                            <tr>
                                <th>Nome:</th>
                                <th>Matrícula:</th>
                                <th>Email:</th>
                                <th>Tipo:</th>
                            </tr>
                        </thead>
                        <tbody class="btn trigger" id="tabela-dados">
                            <!-- Os dados serão inseridos aqui dinamicamente via JavaScript -->
                        </tbody>
                    </table>
                </div>








                <div class="table_docente">
                    <h1>Docentes cadastrados</h1>
                    <table class="tabela_listagem">
                        <thead>
                            <tr>
                                <th>Nome:</th>
                                <th>Matrícula:</th>
                                <th>Email:</th>
                                <th>Tipo:</th>
                            </tr>
                        </thead>
                        <tbody class="btn trigger" id="tabela-User">
                            <!-- Os dados serão inseridos aqui dinamicamente via JavaScript -->
                        </tbody>
                    </table>
                </div>





                <div class="table_admin">

                    <h1>Administradores cadastrados</h1>

                    <table class="tabela_listagem">
                        <thead>
                            <tr>
                                <th>Nome:</th>
                                <th>Matrícula:</th>
                                <th>Email:</th>
                                <th>Tipo:</th>
                            </tr>
                        </thead>
                        <tbody class="btn trigger" id="tabela-Adm">
                            <!-- Os dados serão inseridos aqui dinamicamente via JavaScript -->
                        </tbody>
                    </table>
                </div>

        </main>

        <footer>
            <div class="left">
                <img src="./assets/Img-bola.png" alt="">
            </div>

            <div class="right">
                <a href="../faq/index.html"><img src="./assets/faq.png"></a>
            </div>
        </footer>

    </div>

    <div class="modais">
        <div class="modal-cad-user">
            <div class="modal-content-cad-user">

                <div class="info_modal">

                    <h1>Cadastrar Usuario</h1>

                    <div class="formulario">
                        <form action=".././funcoes_calendario/save_user.php" method="post">

                            <div class="item">
                                <label for="nome">Nome:</label> <br>
                                <input type="text" placeholder="Ex: João ninguem" name="nome" id="nome">
                            </div>

                            <div class="item">
                                <label for="tipo">Tipo:</label> <br>
                                <select name="tipo" id="tipo">
                                    <option value="0" disabled selected>Selecione um tipo</option>
                                    <option value="docente">Docente</option>
                                    <option value="administrador">Administrador</option>
                                </select>
                            </div>

                            <div class="item">
                                <label for="matricula">Matricula:</label> <br>
                                <input value="666" type="number" name="ra" id="ra" placeholder="Ex: 8880088">
                            </div>

                            <div class="item">
                                <label for="mail">Email:</label> <br>
                                <input type="email" name="email" id="email" placeholder="Ex: nome@email.com">
                            </div>

                            <div class="item">
                                <label for="password">Senha:</label> <br>
                                <input type="password" name="senha" id="senha" placeholder="Ex: 123">
                            </div>

                            <div class="send">
                                <input type="submit" value="Cadastrar">
                            </div>

                        </form>
                    </div>

                    <span class="close-button-user">Cancelar</span>

                </div>

            </div>
        </div>

        <div class="modal-edit-user">
            <div class="modal-content-edit-user">

                <div class="info_modal_edit">

                    <h1>Editar Usuario</h1>

                    <div class="formulario">
                        <form action=".././funcoes_calendario/update_user.php" method="post">

                        <input type="hidden" name="ra" value="" id="hidden-ra">

                            <div class="item_edit">
                                <label for="nome">Nome:</label> <br>
                                <input type="text" placeholder="Ex: João ninguem" class="nome" name="nome" id="nome">
                            </div>

                            
                            <div class="item_edit">
                                <label for="tipo">Tipo:</label> <br>
                                <select name="tipo" id="tipo">
                                    <option value="0" disabled selected>Selecione um tipo</option>
                                    <option value="docente">Docente</option>
                                    <option value="administrador">Adiministrador</option>
                                </select>
                            </div>

                            <div class="item_edit dissmis">
                                <label for="matricula">Matricula:</label> <br>
                                <!-- Use class instead of id to select the input -->
                                <input type="number" name="ra" id="ra"class="ra_user" placeholder="Ex: 8880088" disabled>

                            </div>

                            <div class="item_edit">
                                <label for="mail">Email:</label> <br>
                                <input type="email" name="email" id="email" class="email"
                                    placeholder="Ex: nome@email.com">
                            </div>

                            <div class="item_edit">
                                <label for="password">Senha:</label> <br>
                                <input type="password" name="senha" id="senha" class="senha" placeholder="Ex: 123">
                            </div>

                            <div class="send_edit">
                                <input type="submit" value="Concluir">
                            </div>

                        </form>
                    </div>

                    <span class="close-button-edit">Cancelar</span>

                </div>

            </div>
        </div>

    </div>

    <div class="modal">
        <div class="modal-content">
            <span class="close-button">&times;</span>
            <h2>Detalhes</h2>
            <div id="detalhes-turma" class="info">

            <input type="hidden" name="id" value="666">


                <p id="nome"></p>



                <p id="tipo"></p>


                <p id="ra_user"></p>

                <div class="line-2"></div>


            </div>



            <img id="exc" src="./assets/trash.png" alt="" class="btn triggerexc">
            <img id="edit" src="./assets/magicpen.png" class="open_modal-Edit" alt="">



        </div>
    </div>


    <div class="modalexc">
        <div class="modal-contentexc">

            <h1>Deseja mesmo excluir o usuário:</h1>

            <h2 class="h2" data-ra=""></h2>

            <div id="detalhes-turma" class="info">

                <!-- <p id="nome"></p>

            <p id="tipo"></p>

            <p id="ra_user"></p> -->


                <button id="btn-excluir-usuario"> Excluir </button>

                <span class="close-buttonexc">Sair</span>

            </div>

        </div>
    </div>



    <script src="listar-user.js"></script>

</body>

</html>