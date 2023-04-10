<?php

header('Content-Type: application/json');

function getFeriados($ano) {
    $pascoa = date("m-d", strtotime("second sunday of april $ano"));
    $paixaoDeCristo = date("m-d", strtotime("Friday before the second Sunday in April $ano"));

    $feriados = array(
        '01-01' => 'Ano Novo',
        '04-21' => 'Tiradentes',
        '04-07' => 'Sexta-feira Santa',
        '05-01' => 'Dia do Trabalho',
        '09-07' => 'Independência do Brasil',
        '10-12' => 'Nossa Senhora Aparecida',
        '11-02' => 'Finados',
        '11-15' => 'Proclamação da República',
        '12-25' => 'Natal'
    );

    $feriados[$pascoa] = 'Páscoa';
    $feriados[$paixaoDeCristo] = 'Paixão de Cristo';

    $pontoFacultativo = array(
        '02-20' => 'Carnaval',
        '02-21' => 'Carnaval',
        '02-22' => 'Quarta-feira de Cinzas (Ponto Facultativo até as 14h)',
        '06-08' => 'Corpus Christi',
        '10-28' => 'Dia do Servidor Público',
        // Adicione outros feriados ponto facultativo aqui
    );

    $ponto = array(
        // '03-08' => 'Dia Internacional da Mulher | 8 de Março',
        // '03-20' => 'Início do Outono',
        // '04-02' => 'Domingo de Ramos',
        // '04-06' => 'Quinta-feira Santa',
        // '04-08' => 'Sábado de Aleluia',
        // '04-19' => 'Dia dos Povos Indígenas (Dia do Índio)',
        // '04-20' => '1º Eclipse Solar de 2023 - Eclipse Híbrido (não visível no Brasil)',
        // '04-22' => 'Descobrimento do Brasil',
        // '05-05' => '1º Eclipse Lunar de 2023 - Eclipse Penumbral (não visível no Brasil)',
        // '05-14' => 'Dia das Mães',
        // '06-12' => 'Dia dos Namorados',
        // '06-21' => 'Início do Inverno (Solstício de Inverno)',
        // '06-24' => 'Dia de São João',
        // '07-09' => 'Dia da Revolução Constitucionalista',
        // '07-20' => 'Dia do Amigo e Internacional da Amizade',
        // '08-13' => 'Dia dos Pais',
        // '08-22' => 'Dia do Folclore',
        // '08-25' => 'Dia do Soldado',
        // '09-21' => 'Dia da Árvore',
        // '09-23' => 'Início da Primavera',
        // '10-12' => 'Dia das Crianças',
        // '10-14' => '2º Eclipse Solar de 2023 - Eclipse Anular (visível no norte do Brasil)',
        // '10-15' => 'Dia do Professor',
        // '10-28' => '2º Eclipse Lunar de 2023 - Eclipse Parcial (não visível no Brasil)',
        // '10-31' => 'Dia das Bruxas - Halloween',
        // '11-01' => 'Dia de Todos os Santos',
        // '11-19' => 'Dia da Bandeira',
        // '11-20' => 'Dia Nacional da Consciência Negra',
        // '12-22' => 'Início do Verão - Solstício de Verão',
        // '12-24' => 'Véspera de Natal',
        // '12-31' => 'Véspera de Ano-Novo',
        // Adicione outros feriados ponto facultativo aqui
    );

    $result = array();

//...
foreach (array_merge($feriados, $pontoFacultativo, $ponto) as $data => $nome) {
    $dataCompleta = $ano . '-' . $data;
    if (in_array($data, array_keys($pontoFacultativo))) {
        $tipo = 'facultativo';
    } elseif (in_array($data, array_keys($ponto))) {
        $tipo = 'ponto';
    } else {
        $tipo = 'feriado';
    }
    $result[] = array(
        'data' => $dataCompleta,
        'nome' => $nome,
        'tipo' => $tipo
    );
}
//...


    return $result;
}

function getFeriadosTodosAnos($anoInicial, $anoFinal) {
    $feriadosTodosAnos = array();
    for ($ano = $anoInicial; $ano <= $anoFinal; $ano++) {
        $feriados = getFeriados($ano);
        $feriadosTodosAnos = array_merge($feriadosTodosAnos, $feriados);
    }
    return $feriadosTodosAnos;
}

$currentYear = intval(date("Y"));
$anoInicial = isset($_GET['ano_inicial']) && is_numeric($_GET['ano_inicial']) ? intval($_GET['ano_inicial']) : $currentYear - 5;
$anoFinal = isset($_GET['ano_final']) && is_numeric($_GET['ano_final']) ? intval($_GET['ano_final']) : $currentYear + 30;

// Verifica se os anos estão dentro de um intervalo razoável
$anoInicial = max(1900, $anoInicial);
$anoFinal = min(2100, $anoFinal);

$resultado = getFeriadosTodosAnos($anoInicial, $anoFinal);

echo json_encode($resultado);