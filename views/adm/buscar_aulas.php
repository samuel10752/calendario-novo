<?php
require_once('../../db-connect.php');

$class_id = $_GET['class_id'];


    $stmt = $conn->prepare("SELECT calendario_de_aula.*, uc.id, uc.num_turma, turma.nome, usuario.nome as ra_docente
        FROM calendario_de_aula
        JOIN uc ON calendario_de_aula.id_uc = uc.id
        JOIN turma ON uc.num_turma = turma.id
        JOIN usuario ON calendario_de_aula.ra_docente = usuario.ra_user
        WHERE turma.id = ?
    ");
    $stmt->bind_param('i', $class_id);
    $stmt->execute();
    $result = $stmt->get_result();

    $events = [];

    while ($row = $result->fetch_assoc()) {
        // debugando o conteúdo da variável $row
        var_dump($row);

        $event = [
            'title' => $row['ra_docente'],
            'description' =>  $row['id_uc'] ,
            'start' => $row['horario_inicio'],
            'end' => $row['horario_fim'],
        ];
        

        $events[] = $event;
    }

if (empty($events)) {
    echo json_encode(['error' => 'Nenhum resultado encontrado.']);
} else {
    header('Content-Type: application/json');
    echo json_encode($events);
}
exit;

if (isset($conn)) $conn->close();



