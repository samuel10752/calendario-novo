<!DOCTYPE html>
<html lang="pt-br">
<!-- Teste commit brash -->

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Scheduling</title>
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"
        integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
    <link rel="stylesheet" href="../../css/bootstrap.min.css">
    <link rel="stylesheet" href="../../fullcalendar/lib/main.min.css">
    <link rel="stylesheet" href="../../css/test.css">

    <!-- teste de fazer um popup apareca e depois some e da um reset na pagina de salvar e deletar-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/css/bootstrap.min.css"
        integrity="sha512-CtCzRfZlMEvJzFpKkAl97SlNf1ysh3/nqK/O47XQ2NlA/h8zv+QlLx0cZdHw78W8evv+E0g0Xr85tHrT0Z8RvA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/js/bootstrap.bundle.min.js"
        integrity="sha512-Gi7RveP32a9p7VU1OWaqcWfZiFGmpn4n4+hGKnIMHmAT8yvy/KPlm9mSdFzsB6ZcJdjmnFca0If0I4d4wSMkCg=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <!-- teste de fazer um popup apareca e depois some e da um reset na pagina de salvar e deletar-->

    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
    <!-- Script para que os inputs quando selecionados ja preencherem -->
    <script src="https://momentjs.com/downloads/moment-with-locales.min.js"></script>

    <!-- teste de popup de nao pode modificar um feriadoz para adicionar uma aula -->
    <script src="../../js/jquery-3.6.0.min.js"></script>
    <script src="../../js/bootstrap.min.js"></script>
    <script src="../../fullcalendar/lib/main.min.js"></script>
    <script src='../../js/pt-br.js'></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0-rc.0/js/select2.min.js">
    </script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0-rc.0/css/select2.min.css" rel="stylesheet" />


</head>


<body class="bg-light">

    <div class="navegation">
        <nav>
            <input type="checkbox" id="nav-toggle">
            <div class="logo">
                <h1>Ca<span1>l</span1><span>l</span>endar</h1>
            </div>
            <ul class="links">
                <li><a href="../../home/home_adm.php">Home</a></li>
                <li><a href="#">Calendário</a></li>
                <li><a href="../../telaCursos/index.php">Cursos</a></li>
                <li><a href="../../cadastrarUsuario/listar-user.php">Usuários</a></li>
                <li><a href="../../index.php">Sair</a></li>
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


    <div class="container py-3" id="page-container">


        <!-- teste de fazer um popup apareca e teste  de impeca de criar aula em feriados-->
        <div class="modal" id="alerta-modal" tabindex="-1" role="dialog" aria-labelledby="feriado-modal-title">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="feriado-modal-title">Não é possível seleciona essa data.</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        Por favor, selecione outra data para criar a aula ou feriado.
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" data-dismiss="modal">OK</button>
                    </div>
                </div>

            </div>
        </div>


        <!-- teste de fazer um popup apareca e teste  de impeca de criar aula em feriados-->
        <div class="modal" id="feriado-modal" tabindex="-1" role="dialog" aria-labelledby="feriado-modal-title">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="feriado-modal-title">Não é possível criar uma aula em um feriado.
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        Por favor, selecione outra data para criar a aula.
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" data-dismiss="modal">OK</button>
                    </div>
                </div>

            </div>
        </div>

        <!-- teste de fazer um popup apareca e teste  de impeca de criar aula em feriados -->

        <!-- teste de fazer um popup apareca e depois some e da um reset na pagina -->
        <div id="success-modal" class="modal fade" tabindex="-1" aria-labelledby="success-modal-label"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="success-modal-label">Agendamento salvo com sucesso!</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Pagina sera resetada!
                    </div>
                </div>
            </div>
        </div>
        <!-- teste de fazer um popup apareca e depois some e da um reset na pagina -->

        <!-- teste de fazer um popup de delete -->
        <div class="modal fade" id="delete-modal" tabindex="-1" role="dialog" aria-labelledby="delete-modal-label"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered d-flex justify-content-center" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="delete-modal-label">Deletar evento agendado</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>Tem certeza de que deseja excluir este evento agendado?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        <button type="button" class="btn btn-danger" id="confirm-delete">Excluir</button>
                    </div>
                </div>
            </div>
        </div>


        <!-- teste de fazer um popup de delete -->
        <div class="modal fade" id="delete-modal-feriado" tabindex="-1" role="dialog"
            aria-labelledby="event-details-modal-feriado" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered d-flex justify-content-center" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="delete-modal-label">Deletar evento agendado</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>Tem certeza de que deseja excluir este evento agendado?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        <button type="button" class="btn btn-danger" id="confirm-delete-feriado">Excluir</button>
                    </div>
                </div>
            </div>
        </div>



        <!-- teste de fazer um popup de delete -->

        <div class="row">
            <div class="col-md-9">
                <div id="calendar"></div>
            </div>
            <div class="col-md-3">


                <div class="form-group mb-2">
                    <select style="margin-top: .2rem; width:100% " class="form-control form-control-sm rounded-0"
                        name="turma" id="turma" required>
                        <option for="turmas" style="margin-top: 3.5rem;" value="">Selecione uma turma</option>
                    </select>



                    <div class="borda-card" style="border:1px solid #434141; border-radius:10px; margin-top:2rem;">
                        <div id="aula-form" style="display: block; margin-top: .1   rem;">
                            <div class="card-header bg-gradient bg-primary text-light">
                                <h4 class="card-title">Adicionar aula</h4>
                                <button id="trocar-form-btn-feriado" type="button">
                                    <img src="troca2.png" alt="Troca">
                                </button>
                            </div>
                            <div class="card-body">
                                <div class="container-fluid">

                                    <form action="../../funcoes_calendario/save_schedule.php" method="post"
                                        id="schedule-form">
                                        <input type="hidden" name="id" value="">



                                        <div class="form-group mb-2">
                                            <label for="title" class="control-label">Nome:</label>
                                            <select class="form-control form-control-sm rounded-0" name="title"
                                                id="title" required>
                                                <option value="">Selecione um professor</option>
                                            </select>
                                        </div>

                                        <style>
                                        /* Estilos padrão */
                                        .select2-selection__rendered {
                                            color: black !important;
                                            white-space: nowrap;
                                            overflow-x: auto;

                                        }

                                        .select2-container--default .select2-results__option {
                                            color: black;
                                            width: 100%;
                                        }


                                        /* Estilos para telas menores */
                                        @media (max-width: 767px) {
                                            .select2-selection__rendered {
                                                font-size: 12px;
                                                overflow-x: scroll;
                                            }
                                        }
                                        </style>


                                        <div class="form-group mb-2">
                                            <label for="description" class="control-label">UC:</label>
                                            <select rows="3" class="form-control form-control-sm rounded-2"
                                                name="description" id="description" required></select>
                                        </div>
                                        <div class="form-group mb-2">
                                            <label for="start_datetime" class="control-label">Começo</label>
                                            <input type="datetime-local" class="form-control form-control-sm rounded-2"
                                                name="start_datetime" id="start_datetime" required>
                                        </div>
                                        <div class="form-group mb-2">
                                            <label for="end_datetime" class="control-label">Fim</label>
                                            <input type="datetime-local" class="form-control form-control-sm rounded-2"
                                                name="end_datetime" id="end_datetime" required>
                                        </div>
                                    </form>
                                </div>

                                <div class="">
                                    <div class="text-center">
                                        <button class="border-2 rounded-2" type="submit" form="schedule-form"
                                            style="background: #FF9022;border:none;color:white;width:80%;height:3rem;">Salvar</button>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div>
                        <div
                            style="background-color: #FFA500; display: inline-block; width: 20px; height: 20px;  margin-top:2rem;">
                        </div>
                        <span>Para feriados que são pontos facultativos, é utilizado a cor laranja.</span>
                    </div>

                    <div>
                        <div style="background-color: #A9A9A9; display: inline-block; width: 20px; height: 20px;"></div>
                        <span>Para feriados que são pontos facultativos até às 14h, é utilizado a cor cinza
                            claro.</span>
                    </div>

                    <div>
                        <div style="background-color: #f00; display: inline-block; width: 20px; height: 20px;"></div>
                        <span>Para feriados, é utilizado a cor vermelha.</span>
                    </div>

                    <div>
                        <div style="background-color: #3788d8; display: inline-block; width: 20px; height: 20px;"></div>
                        <span>Para as Aulas, é utilizado a cor Azul.</span>
                    </div>

                    <div id="feriado-form" style="display: none;" class="card-body">
                        <div class="card-header bg-gradient bg-primary text-light">
                            <h4 class="card-title">Adicionar Feriado</h4>
                            <button id="trocar-form-btn-aula" type="button"><img src="troca2.png" alt="Troca"></button>
                        </div>
                        <div class="card-body">
                            <div class="container-fluid">

                                <form action="../../funcoes_calendario/save_feriado.php" method="post"
                                    id="schedule-form1">
                                    <input type="hidden" name="id" value="">

                                    <div class="form-group mb-2">
                                        <label for="title" class="control-label">Nome:</label>
                                        <input type="text" class="form-control form-control-sm rounded-2" name="titulo"
                                            id="titulo" required>
                                    </div>

                                    <div class="form-group mb-2">
                                        <label for="title" class="control-label">Descrição:</label>
                                        <input type="text" class="form-control form-control-sm rounded-2"
                                            name="descricao" id="descricao" required>
                                    </div>

                                    <div class="form-group mb-2">
                                        <label for="start_datetime" class="control-label">Começo</label>
                                        <input type="datetime-local" class="form-control form-control-sm rounded-2"
                                            name="horario_inicio" id="horario_inicio" required>
                                    </div>

                                    <div class="form-group mb-2">
                                        <label for="end_datetime" class="control-label">Fim</label>
                                        <input type="datetime-local" class="form-control form-control-sm rounded-2"
                                            name="horario_fim" id="horario_fim" required>
                                    </div>

                                </form>
                            </div>
                            <div class="text-center">
                                <button class="border-2 rounded-2" type="submit" form="schedule-form1"
                                    style="background: #FF9022;border:none;color:white;width:80%;height:3rem;">Salvar</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <!-- Event Details Modal -->
    <div class="modal fade" tabindex="-1" data-bs-backdrop="static" id="event-details-modal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content rounded-0">
                <div class="modal-header rounded-0">
                    <h5 class="modal-title">Detalhes</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body rounded-0">
                    <div class="container-fluid">
                        <dl>
                            <dt class="text-muted">RA</dt>
                            <dd id="title" class="fw-bold fs-4"></dd>
                            <dt class="text-muted"> ID (Unidade) </dt>
                            <dd id="description" class=""></dd>

                            <dt class="text-muted">Começo</dt>
                            <dd id="start" class=""></dd>
                            <dt class="text-muted">Fim</dt>
                            <dd id="end" class=""></dd>
                        </dl>
                    </div>
                </div>
                <div class="modal-footer rounded-0">
                    <div class="text-end">
                        <button type="button" class="btn btn-primary btn-sm rounded-2" style="background-color:#FF9022"
                            id="edit" data-id="">Editar</button>
                        <button type="button" class="btn btn-danger btn-sm rounded-2" id="delete"
                            data-id="">Deletar</button>

                        <button type="button" class="btn btn-secondary btn-sm rounded-2"
                            data-bs-dismiss="modal">Fechar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <!-- Aqui ele exibe os detalhes dos feriados -->
    <div class="modal fade" tabindex="-1" data-bs-backdrop="static" id="event-details-modal-feriado">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content rounded-0">
                <div class="modal-header rounded-0">
                    <h5 class="modal-title">Detalhes</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body rounded-0">
                    <div class="container-fluid">
                        <dl>
                            <dt class="text-muted">Título</dt>
                            <dd id="event-title" class="fw-bold fs-4"></dd>
                            <dt class="text-muted">Descrição</dt>
                            <dd id="event-description" class=""></dd>
                            <dt class="text-muted">Começo</dt>
                            <dd id="event-start" class=""></dd>
                            <dt class="text-muted">Fim</dt>
                            <dd id="event-end" class=""></dd>
                        </dl>
                    </div>
                </div>
                <div class="modal-footer rounded-0">
                    <div class="text-end">
                        <button type="button" class="btn btn-primary btn-sm rounded-0" id="edit-evento"
                            data-id="">Editar</button>
                        <button type="button" class="btn btn-danger btn-sm rounded-0" id="delete-button"
                            data-id="">Deletar</button>
                        <button type="button" class="btn btn-secondary btn-sm rounded-0"
                            data-bs-dismiss="modal">Fechar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php

    // Configurações de conexão
$servername = "localhost";
$username = "root";
$password = "";
$dbname   ='dummy_db';

// Cria conexão
$conn = new mysqli($servername, $username, $password, $dbname);

// Verifica se houve erro na conexão
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Verifica se foi passado class_id na URL
if (isset($_GET['class_id'])) {
    $class_id = $_GET['class_id'];
    // Buscar a lista de aulas e feriados para a turma especificada
    $schedules = $conn->prepare("SELECT c.id, u.nome as ra_docente, c.id_uc, c.horario_inicio, c.horario_fim, uc.nome_uc as nome_uc, 'aula' as tipo 
        FROM `calendario_de_aula` c
        JOIN usuario u ON c.ra_docente = u.ra_user
        JOIN uc ON c.id_uc = uc.id
        JOIN turma t ON uc.num_turma = t.id
        WHERE t.id = ?
        UNION ALL
        SELECT id, titulo, descricao, horario_inicio, horario_fim,  null as nome_uc, 'feriado' as tipo FROM `feriado`
    ");
    $schedules->bind_param('i', $class_id);
    $schedules->execute();
    $result_set = $schedules->get_result();
} else {
    // Buscar a lista de todas as aulas e feriados
    $schedules = $conn->query("SELECT c.id, u.nome as ra_docente, c.id_uc, c.horario_inicio, c.horario_fim, uc.nome_uc as nome_uc, 'aula' as tipo 
        FROM `calendario_de_aula` c
        JOIN usuario u ON c.ra_docente = u.ra_user
        JOIN uc ON c.id_uc = uc.id
        JOIN turma t ON uc.num_turma = t.id
        UNION ALL
        SELECT id, titulo, descricao, horario_inicio, horario_fim,  null as nome_uc, 'feriado' as tipo FROM `feriado`
    ");
    $result_set = $schedules;
}


// Criar um array associativo contendo os dados das aulas e feriados
$sched_res = [];
while ($row = $result_set->fetch_assoc()) {
    $row['sdate'] = date("F d, Y h:i A", strtotime($row['horario_inicio']));
    $row['edate'] = date("F d, Y h:i A", strtotime($row['horario_fim']));
    $title = $row['ra_docente'];
    if (isset($row['id_uc'])) {
    $description = $row['nome_uc'];
    } else {
    $description = $row['titulo'];
    }
    $start = null;
    $end = null;
    if (isset($row['data']) && isset($row['horario_inicio']) && isset($row['horario_fim'])) {
        $start = strtotime($row['data'] . ' ' . $row['horario_inicio']);
        $end = strtotime($row['data'] . ' ' . $row['horario_fim']);
    } else if (isset($row['horario_inicio']) && isset($row['horario_fim'])) {
        $start = strtotime($row['horario_inicio']);
        $end = strtotime($row['horario_fim']);
        $sched_res[$row['id']] = $row;
    }
    
    if ($start !== null && $end !== null) {
        $start = date('Y-m-d\TH:i:s', $start);
        $end = date('Y-m-d\TH:i:s', $end);
    
        $event = array(
            'title' => $title,
            'description' => $description,
            'start' => $start,
            'end' => $end,
            'allDay' => false,
            'className' => $row['tipo']
        );
    
        array_push($sched_res, $event);
    }
    }
     

     


    // Fechar a conexão
    if (isset($conn)) {
    $conn->close();
    }

?>


</body>

<script>
var scheds = $.parseJSON('<?= json_encode($sched_res) ?>');
</script>

<script src="../../js/script.js"></script>

</html>