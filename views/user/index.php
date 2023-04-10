<?php require_once('../../db-connect.php') ?>

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
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="../../fullcalendar/lib/main.min.css">
    <link rel="stylesheet" href="../../css/test1.css">


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


</head>
<header>
    <div class="container">
        <h1 class="logo">Ca<span1>l</span1><span>l</span>endar</h1>

        <img src="img3.png"></img>





    </div>
</header>

<?php

include('protect.php');

?>


<body class="bg-light">

    <p class="bem">Bem Vindo</p>


    <p class="vindo"> <?php echo $_SESSION['nome']; ?></p>



    </table>

    <div class="container" id="page-container">



        <!-- teste de fazer um popup de delete -->
        <!-- teste de fazer um popup de delete -->
        <!-- <div class="select2">
    <label for="title" class="control-label">Turma:</label>
    <select class="form-control form-control-sm rounded-0" name="turma" id="turma" required>
        <option value="">Selecione uma Turma</option>
    </select>
</div>

<style>
    .select2{
        position: absolute;
        top: 13%;
        right: 20%;
        width: 40%;
    }
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
                
            <script>
  $(document).ready(function () {
        // Initialize the select2 plugin
        $('#turma').select2({
            placeholder: 'Pesquisar nome da turma',
            ajax: {
                url: '../../funcoes_calendario/buscar_turmas.php',
                dataType: 'json',
                delay: 250,
                data: function (params) {
                    return {
                        search: params.term // termo de pesquisa
                    };
                },
                minimumInputLength: 2,
                processResults: function (data) {
                    return {
                        results: $.map(data, function (obj) {
                            return {
                                id: obj.id,
                                text: obj.nome,
                            };
                        })
                    };
                },
                cache: true
            },
            templateResult: function (result) {
                // mostrar como lista com o número do RA
                var markup =
                    "<ul  class='select2-results__options'>";
                markup +=
                    "<li class='select2-results__option'><strong>Nome:</strong> " +
                    result.text + " - <strong>ID:</strong> " +
                    result.id + "</li>";
                markup += "</ul>";
                return markup;
            },
            templateSelection: function (result) {
                // mostrar apenas o nome selecionado em preto, com o id entre parênteses
                return "<span style='color:black;'>" + result.text +
                    " (" + result.id + ")" + "</span>";
            },
            escapeMarkup: function (markup) {
                return markup;
            },
            matcher: function (term, text, option) {
                return text.toUpperCase().indexOf(term
                    .toUpperCase()) == 0;
            },
            data: function (params) {
                return {
                    search: params.term // termo de pesquisa
                };
            }
        }).on('change', function () {
            // Obter o ID da turma selecionada
            var class_id = $(this).val();
            // Obter o ID da UC selecionada
            // Redirecionar para a página do calendário com os parâmetros 'class_id' e 'uc_id' na URL
            window.location.href = "../adm/index.php?class_id=" + class_id;
        });
    });

    
           </script> -->



        <div class="row">
            <div class="col-md-9" style="height: 100px;  margin-left: -5%;">
                <div id="calendar"></div>
                <div class="feriados">
                    <div>
                        <div style="background-color: #FFA500; display: inline-block; width: 20px; height: 20px; ">
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
                        <div style="background-color:  #3788d8; display: inline-block; width: 20px; height: 20px;">
                        </div>
                        <span>Para as Aulas, é utilizado a cor Azul.</span>
                    </div>
                </div>
                <style>
                .feriados {
                    position: absolute;
                    margin-left: 66%;
                    margin-top: -45%;
                }
                </style>

                <!-- Event Details Modal -->
                <div class="modal fade" tabindex="-1" data-bs-backdrop="static" id="event-details-modal">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content rounded-0">
                            <div class="modal-header rounded-0">
                                <h5 class="modal-title">Detalhes</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
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
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
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
                                    <button type="button" class="btn btn-secondary btn-sm rounded-2"
                                        data-bs-dismiss="modal">Fechar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
        </div>

    </div>



    <a href="../../index.php"><button class="logaout"><img src="img/img-logout.png"
                alt="imagem de icone de logout"></button></a>


    <!-- Event Details Modal -->

    <?php

locale:
'pt-br';

$schedules = $conn->query("SELECT c.id, u.nome as ra_docente, c.id_uc, c.horario_inicio, c.horario_fim, uc.nome_uc as nome_uc, 'aula' as tipo 
FROM `calendario_de_aula` c
JOIN usuario u ON c.ra_docente = u.ra_user
JOIN uc ON c.id_uc = uc.id
WHERE c.ra_docente = {$_SESSION['ra_user']}
UNION ALL
SELECT id, titulo, descricao, horario_inicio, horario_fim, null as nome_uc, 'feriado' as tipo 
FROM `feriado`

");

$sched_res = [];
foreach ($schedules->fetch_all(MYSQLI_ASSOC) as $row) {  
    $row['sdate'] = date("F d, Y h:i A", strtotime($row['horario_inicio']));
    $row['edate'] = date("F d, Y h:i A", strtotime($row['horario_fim']));
    $sched_res[$row['id']] = $row;
}

if (isset($conn)) $conn->close();
?>

</body>
<script>
var scheds = $.parseJSON('<?= json_encode($sched_res) ?>');
</script>

<script src="../../js/script_user.js"></script>

</html>