
// Selecionar todos os elementos com a classe "trigger"
var trigger = document.querySelectorAll('.trigger');

// Adicionar um ouvinte de eventos para cada elemento
trigger.forEach(function (el) {
  el.addEventListener('click', function () {

    // Obter os atributos de dados do elemento clicado
    var idTurma = this.getAttribute("data-id");

    // Fazer uma requisição HTTP assíncrona para o arquivo PHP
    fetch('exibir_turma.php')
      .then(response => response.json()) // Converter a resposta para JSON
      .then(data => {
        // Filtrar as turmas que correspondem ao ID da turma selecionada
        var turmaSelecionada = data.find(turma => turma.id === idTurma);

        if (turmaSelecionada) {


          // Montar o HTML da tabela com os dados da turma selecionada
          var HTML = '<div data-id="' + idTurma + '" class="cont-info-turma">';

          HTML += '<div data-id="' + idTurma + '" class="edit-btn">';
          HTML += '<button  id="edit-btn-' + idTurma + '" class="oi-btn" data-id="' + idTurma + '" onclick="edit(\'' + idTurma + '\')"><i class="fa fa-pencil"></i> Editar</button>';


          HTML += '<div data-id="' + idTurma + '" id="delete-btn-' + idTurma + '" class="delete-btn">';
          HTML += '<button onclick="deleteUser(\'' + idTurma + '\')"><i class="fa fa-trash"></i> Deletar</button>';
          HTML += '</div>';

          HTML += '<div>';
          HTML += '<button><a href="./index.php"><i class="fa fa-arrow-left"></i> Voltar</a></button>';
          HTML += '</div>';

          HTML += '</div>';

          HTML += '<ol>';
          HTML += '<form action=".././funcoes_calendario/update_curso.php" method="post">';

          HTML += '<li id="nome-curso-' + idTurma + '"> Nome do curso: </li>';
          HTML += '<div class="inp-style">';
          HTML += '<p id="valor-nome-curso-' + idTurma + '">' + turmaSelecionada.nome + '</p>';
          HTML += '<input name="nome" type="text" id="edit-nome-curso-' + idTurma + '" value="' + turmaSelecionada.nome + '" style="display:none; width: 380px; height: 30px; font-size: 23px;">';

          HTML += '</div>';
          // em uma unica linha

          HTML += '<div class="box-line">'
          HTML += '<div class="info-inp-line">'
          HTML += '<li id="codgio-curso-' + idTurma + '" class="inp-style-2"> Código: </li>'
          HTML += '<div class="inp-style">';
          HTML += '<p name="codigo" id="valor-codgio-curso-' + idTurma + '">' + turmaSelecionada.id + '</p>';
          HTML += '<input type="text" id="edit-codgio-curso-' + idTurma + '" name="codigo" id="codigo" value="' + turmaSelecionada.id + '"  style="display:none; width: 190px; font-size: 23px; style="display:none">';
          HTML += '</div>';

          HTML += '</div>'
          HTML += '</div>'

          HTML += '<div class="box-line space-line">'
          HTML += '<div class="info-inp-line">'
          HTML += '<li  id="sala-comum-' + idTurma + '" class="inp-style-2"> Sala comum: </li>'
          HTML += '<div class="inp-style">';
          HTML += '<p name="sala" id="valor-sala-comum-' + idTurma + '">' + turmaSelecionada.sala + '</p>';
          HTML += '<input  name="sala" type="text" id="edit-sala-comum-' + idTurma + '" value="' + turmaSelecionada.sala + '"  style="display:none; width: 190px; font-size: 23px; style="display:none">';
          HTML += '</div>';
          HTML += '</div>'
          HTML += '</div>'

          HTML += '<li id="tipo-' + idTurma + '" class="inp-2"> Tipo: </li>';
          HTML += '<div class="inp-style">';
          HTML += '<p name="tipo" id="valor-tipo-' + idTurma + '">' + turmaSelecionada.tipo + '</p>';
          HTML += '<select name="eixo" id="edit-tipo-' + idTurma + '" style="display:none; width: 390px; font-size: 23px; style="display:none">';
          HTML += '<option value="#" disabled>Selecione um tipo de curso</option>';
          HTML += '<option value="PSG"' + (turmaSelecionada.tipo === "PSG" ? " selected" : "") + '>PSG</option>';
          HTML += '<option value="Pago"' + (turmaSelecionada.tipo === "Pago" ? " selected" : "") + '>VDC</option>';
          HTML += '<option value="Trilhas"' + (turmaSelecionada.tipo === "Trilhas" ? " selected" : "") + '>Trilhas</option>';
          HTML += '<option value="Aprendizagem"' + (turmaSelecionada.tipo === "Aprendizagem" ? " selected" : "") + '>Aprendizagem</option>';
          HTML += '<option value="MBA"' + (turmaSelecionada.tipo === "MBA" ? " selected" : "") + '>MBA</option>';
          HTML += '</select>';
          HTML += '</div>';



          // fechado em uma unica linha

          HTML += '<li id="turno-' + idTurma + '" class="inp-2"> Turno: </li>';
          HTML += '<div class="inp-style">';
          HTML += '<p name="turno" id="valor-turno-' + idTurma + '">' + turmaSelecionada.turno + '</p>';
          HTML += '<select name="turno" id="edit-turno-' + idTurma + '" style="display:none; width: 390px; font-size: 23px; style="display:none">';
          HTML += '<option value="#" disabled>Selecione o turno</option>';
          HTML += '<option value="Matutino"' + (turmaSelecionada.turno === "Matutino" ? " selected" : "") + '>Matutino</option>';
          HTML += '<option value="Vespertino"' + (turmaSelecionada.turno === "Vespertino" ? " selected" : "") + '>Vespertino</option>';
          HTML += '<option value="Noturno"' + (turmaSelecionada.turno === "Noturno" ? " selected" : "") + '>Noturno</option>';
          HTML += '</select>';
          HTML += '</div>';


          // em uma unica linha

          HTML += '<div class="box-line">'
          HTML += '<div class="info-inp-line">'
          HTML += '<li  id="carga-horaria-' + idTurma + '" class="inp-style-2"> Carga Horaria: </li>'
          HTML += '<div class="inp-style">';
          HTML += '<p name="carga_horaria" id="valor-carga-horaria-' + idTurma + '">' + turmaSelecionada.carga_horaria + '</p>';
          HTML += '<input name="carga_horaria" type="text" id="edit-carga-horaria-' + idTurma + '" value="' + turmaSelecionada.carga_horaria + '" style="display:none; width: 190px; font-size: 23px;">';

          HTML += '</div>';
          HTML += '</div>'
          HTML += '</div>'

          HTML += '<div class="box-line space-line">'
          HTML += '<div class="info-inp-line">'
          HTML += '<li  class="inp-style-2"> Total de UCs: </li>'
          HTML += '<div class="inp-style">'
          HTML += '<p>' + turmaSelecionada.total_uc + '</p>'
          HTML += '</div>'
          HTML += '</div>'
          HTML += '</div>'

          var HTML2 = '</form><div class="cont-uc-turma">';


          HTML += '<div data-id="' + idTurma + '" class="save-btn">';
          HTML += '<button id="save-btn-' + idTurma + '" data-id="' + idTurma + '" onclick="save(\'' + idTurma + '\')" style="display:none"></i> Salvar</button>';
          HTML += '</div>';


          // fechado em uma unica linha

          HTML += '</ol>';

          HTML += '</div>';



          var HTML2 = '<div class="cont-uc-turma">';

          // uc
          HTML2 += '<h3> UCs cadastradas </h3>';
          HTML2 += '<table>';
          HTML2 += '  <thead>';
          HTML2 += '    <tr>';
          HTML2 += '      <th>ID</th>';
          HTML2 += '      <th>Nome da UC</th>';
          HTML2 += '      <th>Codigo</th>';
          HTML2 += '      <th>Carga Horária</th>';
          HTML2 += '      <th>Ações</th>';
          HTML2 += '    </tr>';
          HTML2 += '  </thead>';
          HTML2 += '  <tbody>';

          if (turmaSelecionada) {
            const ucs_id = turmaSelecionada.ucs_id ? turmaSelecionada.ucs_id.split('<br>') : [];
            const ucs_nome = turmaSelecionada.ucs_nome ? turmaSelecionada.ucs_nome.split('<br>') : [];
            const ucs_carga_horaria = turmaSelecionada.ucs_carga_horaria ? turmaSelecionada.ucs_carga_horaria.split('<br>') : [];
            const ucs_codigo = turmaSelecionada.ucs_codigo ? turmaSelecionada.ucs_codigo.split('<br>') : [];

            for (let i = 0; i < ucs_nome.length; i++) {
              HTML2 += '    <tr>';
              HTML2 += '      <td>';
              HTML2 += '        <span name="numero_uc"  id="valor-id-' + ucs_id[i] + '">' + ucs_id[i] + '</span>';
              HTML2 += '        <input name="numero_uc"  id="edit-id-' + ucs_id[i] + '" type="text" value="' + ucs_id[i] + '" style="display:none; width: 30px; height: 30px; font-size: 18px;">';
              HTML2 += '      </td>';
              HTML2 += '      <td>';
              HTML2 += '        <span name="nome"  id="valor-nome-uc-' + ucs_id[i] + '">' + ucs_nome[i] + '</span>';
              HTML2 += '        <input  name="nome"  id="edit-nome-uc-' + ucs_id[i] + '" type="text" value="' + ucs_nome[i] + '"  style="display:none; width: 90px; height: 30px; font-size: 18px;">';
              HTML2 += '      </td>';
              HTML2 += '      <td>';
              HTML2 += '        <span  name="codigo"  id="valor-codigo-' + ucs_id[i] + '">' + ucs_codigo[i] + '</span>';
              HTML2 += '        <input   name="codigo"  id="edit-codigo-' + ucs_id[i] + '" type="text" value="' + ucs_codigo[i] + '"  style="display:none; width: 30px; height: 30px; font-size: 18px;">';
              HTML2 += '      </td>';

              HTML2 += '      <td>';
              HTML2 += '        <span  name="carga_horaria"  id="valor-carga-' + ucs_id[i] + '">' + ucs_carga_horaria[i] + '</span>';
              HTML2 += '        <input   name="carga_horaria"  id="edit-carga-' + ucs_id[i] + '" type="text" value="' + ucs_carga_horaria[i] + '"  style="display:none; width: 50px; height: 30px; font-size: 18px;">';
              HTML2 += '      </td>';
              HTML2 += '      <td>';
              HTML2 += '        <button id="edit-' + ucs_id[i] + '" class="oi-btn" data-id="' + ucs_id[i] + '" onclick="edit_uc(\'' + ucs_id[i] + '\')"><i class="fa fa-pencil"></i> Editar</button>';
              HTML2 += '        <button id="save-' + ucs_id[i] + '" class="oi-btn" data-id="' + ucs_id[i] + '" onclick="save(\'' + ucs_id[i] + '\')" style="display: none;"><i class="fa fa-save"></i> Salvar</button>';
              HTML2 += '        <button onclick="delete_uc(\'' + ucs_id[i] + '\')"><i class="fa fa-trash"></i> Deletar</button>';
              HTML2 += '      </td>';
              HTML2 += '    </tr>';
            }
          }

          HTML2 += '  </tbody>';
          HTML2 += '</table>';

          // Código para exibir a mensagem de alerta de carga horária
let cargaHorariaAtual = 0;

if (turmaSelecionada && turmaSelecionada.ucs_carga_horaria) {
  const ucs_carga_horaria = turmaSelecionada.ucs_carga_horaria.split('<br>');

  for (let i = 0; i < ucs_carga_horaria.length; i++) {
    cargaHorariaAtual += parseInt(ucs_carga_horaria[i]);
  }
}

const cargaHorariaTotal = turmaSelecionada.carga_horaria; // Obter a carga horária total necessária da turma selecionada
const cargaHorariaRestante = cargaHorariaTotal - cargaHorariaAtual;

HTML2 += '<div class="carga-horaria-alerta">';
if (cargaHorariaRestante > 0) {
  HTML2 += `<p style="font-size: 18px; width: 400px; ">Ainda faltam ${cargaHorariaRestante} horas para completar a carga horária da turma.</p>`;
} else if (cargaHorariaRestante < 0) {
  const horasExcedidas = Math.abs(cargaHorariaRestante);
  HTML2 += `<p  style="font-size: 18px; width:  400px;" >A carga horária da turma foi excedida em ${horasExcedidas} horas.</p>`;
} else {
  HTML2 += '<p style="font-size: 18px; width:  400px;"  >A carga horária da turma foi completada!</p>';
}
HTML2 += '</div>';


            

          HTML += HTML2


          // Esconder a lista de cursos cadastrados e mostrar o texto de detalhes
          document.querySelector('.add_listagem').style.display = 'none';
          document.querySelector('.detalhes-curso').style.display = 'block';


          // // Mostrar a seção de cadastrar UC
          document.querySelector('.listagem').style.display = 'none';
          document.querySelector('.limha-th').style.display = 'none';

          document.querySelector('.add').style.display = 'block';

          // // Mostrar a seção de cadastrar UC
          document.querySelector('.search').style.display = 'none';

          document.querySelector('.double-btn').style.display = 'block';

          // Atualizar o texto de detalhes com o nome da turma selecionada
          document.querySelector('.detalhes-curso').textContent = turmaSelecionada.nome + ' - Detalhes do Curso';


          // Atualizar o conteúdo da seção resultado2
          document.getElementById("resultado").innerHTML = HTML;

        }
      });
  });
});




// funcao de editar turma
function edit(idTurma) {
  var fields = ['nome-curso', 'codgio-curso', 'sala-comum', 'tipo', 'turno', 'carga-horaria'];
  fields.forEach(field => {
    document.getElementById('valor-' + field + '-' + idTurma).style.display = 'none';
    document.getElementById('edit-' + field + '-' + idTurma).style.display = 'block';
  });
  document.getElementById('edit-btn-' + idTurma).style.display = 'none';
  document.getElementById('save-btn-' + idTurma).style.display = 'block';
}

// funcao de editar uc
function edit_uc(idTurma) {
  var fields = ['nome-uc', 'carga', 'id'];
  fields.forEach(field => {
    console.log('valor-' + field + '-' + idTurma); // Adicionado para depuração
    document.getElementById('valor-' + field + '-' + idTurma).style.display = 'none';
    document.getElementById('edit-' + field + '-' + idTurma).style.display = 'block';
  });
  document.getElementById('edit-' + idTurma).style.display = 'none';
  document.getElementById('save-' + idTurma).style.display = 'block';
}

// funcao de editar as ucs
function save(id) {
  const numeroUC = document.getElementById('edit-id-' + id).value;
  const nome = document.getElementById('edit-nome-uc-' + id).value;
  const cargaHoraria = document.getElementById('edit-carga-' + id).value;
  const codigo = document.getElementById('edit-codigo-' + id).value;

  const formData = new FormData();
  formData.append('numero_uc', numeroUC);
  formData.append('nome', nome);
  formData.append('carga_horaria', cargaHoraria);
  formData.append('codigo', codigo);

  const xhr = new XMLHttpRequest();
  xhr.open('POST', '.././funcoes_calendario/save_uc.php', true);
  xhr.onreadystatechange = function () {
    if (xhr.readyState === 4 && xhr.status === 200) {
      console.log(xhr.responseText);
      window.location.href = "../telaCursos/index.php";
    }
  };
  xhr.send(formData);
}




// funcao de deletar a turma
function deleteUser(idTurma) {
  if (!idTurma) {
    console.error('ID da turma não definido!');
    return;
  }

  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      // Redireciona para a página de listagem após a exclusão da turma
      window.location.href = "delete_turma.php?id=" + idTurma;
    }
  };
  xmlhttp.open("POST", "delete_turma.php", true);
  xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xmlhttp.send("id=" + idTurma);
}

// funcao de deletar a turma
function delete_uc(idTurma) {
  if (!idTurma) {
    console.error('ID da turma não definido!');
    return;
  }

  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      // Redireciona para a página de listagem após a exclusão da turma
      window.location.href = "delete_uc.php?id=" + idTurma;
    }
  };
  xmlhttp.open("POST", "delete_uc.php", true);
  xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xmlhttp.send("id=" + idTurma);
}


// ele busca no banco o nome do curso e ja da o reset 
$(document).ready(function () {
  // define a ação do campo de busca
  $('#campo').keyup(function () {
    // obtém o valor digitado no campo de busca
    var campo = $(this).val();
    // verifica se o campo de busca está vazio
    if (campo == "") {
      campo = "all"; // define um valor para indicar que todas as turmas devem ser buscadas
    }
    // envia uma solicitação AJAX para processa.php
    $.ajax({
      url: 'processa.php',
      method: 'post',
      dataType: 'html',
      data: { campo: campo },
      success: function (data) {
        $('#resultado').html(data);

        // Adicionar um ouvinte de eventos de clique para exibir detalhes da turma
        $('.trigger').click(function () {
          var idTurma = this.getAttribute("data-id");

          // envia uma solicitação AJAX para exibir_detalhes.php
// Fazer uma requisição HTTP assíncrona para o arquivo PHP
fetch('exibir_turma.php')
.then(response => response.json()) // Converter a resposta para JSON
.then(data => {
  // Filtrar as turmas que correspondem ao ID da turma selecionada
  var turmaSelecionada = data.find(turma => turma.id === idTurma);

  if (turmaSelecionada) {


    // Montar o HTML da tabela com os dados da turma selecionada
    var HTML = '<div data-id="' + idTurma + '" class="cont-info-turma">';

    HTML += '<div data-id="' + idTurma + '" class="edit-btn">';
    HTML += '<button  id="edit-btn-' + idTurma + '" class="oi-btn" data-id="' + idTurma + '" onclick="edit(\'' + idTurma + '\')"><i class="fa fa-pencil"></i> Editar</button>';


    HTML += '<div data-id="' + idTurma + '" id="delete-btn-' + idTurma + '" class="delete-btn">';
    HTML += '<button onclick="deleteUser(\'' + idTurma + '\')"><i class="fa fa-trash"></i> Deletar</button>';
    HTML += '</div>';

    HTML += '<div>';
    HTML += '<button><a href="./index.php"><i class="fa fa-arrow-left"></i> Voltar</a></button>';
    HTML += '</div>';

    HTML += '</div>';

    HTML += '<ol>';
    HTML += '<form action=".././funcoes_calendario/save_curso.php" method="post">';

    HTML += '<li id="nome-curso-' + idTurma + '"> Nome do curso: </li>';
    HTML += '<div class="inp-style">';
    HTML += '<p id="valor-nome-curso-' + idTurma + '">' + turmaSelecionada.nome + '</p>';
    HTML += '<input name="nome" type="text" id="edit-nome-curso-' + idTurma + '" value="' + turmaSelecionada.nome + '" style="display:none; width: 380px; height: 30px; font-size: 23px;">';

    HTML += '</div>';
    // em uma unica linha

    HTML += '<div class="box-line">'
    HTML += '<div class="info-inp-line">'
    HTML += '<li id="codgio-curso-' + idTurma + '" class="inp-style-2"> Código: </li>'
    HTML += '<div class="inp-style">';
    HTML += '<p name="codigo" id="valor-codgio-curso-' + idTurma + '">' + turmaSelecionada.id + '</p>';
    HTML += '<input type="text" id="edit-codgio-curso-' + idTurma + '" name="codigo" id="codigo" value="' + turmaSelecionada.id + '"  style="display:none; width: 190px; font-size: 23px; style="display:none">';
    HTML += '</div>';

    HTML += '</div>'
    HTML += '</div>'

    HTML += '<div class="box-line space-line">'
    HTML += '<div class="info-inp-line">'
    HTML += '<li  id="sala-comum-' + idTurma + '" class="inp-style-2"> Sala comum: </li>'
    HTML += '<div class="inp-style">';
    HTML += '<p name="sala" id="valor-sala-comum-' + idTurma + '">' + turmaSelecionada.sala + '</p>';
    HTML += '<input  name="sala" type="text" id="edit-sala-comum-' + idTurma + '" value="' + turmaSelecionada.sala + '"  style="display:none; width: 190px; font-size: 23px; style="display:none">';
    HTML += '</div>';
    HTML += '</div>'
    HTML += '</div>'

    HTML += '<li id="tipo-' + idTurma + '" class="inp-2"> Tipo: </li>';
    HTML += '<div class="inp-style">';
    HTML += '<p name="tipo" id="valor-tipo-' + idTurma + '">' + turmaSelecionada.tipo + '</p>';
    HTML += '<select name="eixo" id="edit-tipo-' + idTurma + '" style="display:none; width: 390px; font-size: 23px; style="display:none">';
    HTML += '<option value="#" disabled>Selecione um tipo de curso</option>';
    HTML += '<option value="PSG"' + (turmaSelecionada.tipo === "PSG" ? " selected" : "") + '>PSG</option>';
    HTML += '<option value="Pago"' + (turmaSelecionada.tipo === "Pago" ? " selected" : "") + '>VDC</option>';
    HTML += '<option value="Trilhas"' + (turmaSelecionada.tipo === "Trilhas" ? " selected" : "") + '>Trilhas</option>';
    HTML += '<option value="Aprendizagem"' + (turmaSelecionada.tipo === "Aprendizagem" ? " selected" : "") + '>Aprendizagem</option>';
    HTML += '<option value="MBA"' + (turmaSelecionada.tipo === "MBA" ? " selected" : "") + '>MBA</option>';
    HTML += '</select>';
    HTML += '</div>';



    // fechado em uma unica linha

    HTML += '<li id="turno-' + idTurma + '" class="inp-2"> Turno: </li>';
    HTML += '<div class="inp-style">';
    HTML += '<p name="turno" id="valor-turno-' + idTurma + '">' + turmaSelecionada.turno + '</p>';
    HTML += '<select name="turno" id="edit-turno-' + idTurma + '" style="display:none; width: 390px; font-size: 23px; style="display:none">';
    HTML += '<option value="#" disabled>Selecione o turno</option>';
    HTML += '<option value="Manhã"' + (turmaSelecionada.turno === "Manhã" ? " selected" : "") + '>Manhã</option>';
    HTML += '<option value="Tarde"' + (turmaSelecionada.turno === "Tarde" ? " selected" : "") + '>Tarde</option>';
    HTML += '<option value="Noite"' + (turmaSelecionada.turno === "Noite" ? " selected" : "") + '>Noite</option>';
    HTML += '</select>';
    HTML += '</div>';


    // em uma unica linha

    HTML += '<div class="box-line">'
    HTML += '<div class="info-inp-line">'
    HTML += '<li  id="carga-horaria-' + idTurma + '" class="inp-style-2"> Carga Horaria: </li>'
    HTML += '<div class="inp-style">';
    HTML += '<p name="carga_horaria" id="valor-carga-horaria-' + idTurma + '">' + turmaSelecionada.carga_horaria + '</p>';
    HTML += '<input name="carga_horaria" type="text" id="edit-carga-horaria-' + idTurma + '" value="' + turmaSelecionada.carga_horaria + '" style="display:none; width: 190px; font-size: 23px;">';

    HTML += '</div>';
    HTML += '</div>'
    HTML += '</div>'

    HTML += '<div class="box-line space-line">'
    HTML += '<div class="info-inp-line">'
    HTML += '<li  class="inp-style-2"> Total de UCs: </li>'
    HTML += '<div class="inp-style">'
    HTML += '<p>' + turmaSelecionada.total_uc + '</p>'
    HTML += '</div>'
    HTML += '</div>'
    HTML += '</div>'

    var HTML2 = '</form><div class="cont-uc-turma">';


    HTML += '<div data-id="' + idTurma + '" class="save-btn">';
    HTML += '<button id="save-btn-' + idTurma + '" data-id="' + idTurma + '" onclick="save(\'' + idTurma + '\')" style="display:none"></i> Salvar</button>';
    HTML += '</div>';


    // fechado em uma unica linha

    HTML += '</ol>';

    HTML += '</div>';



    var HTML2 = '<div class="cont-uc-turma">';

    // uc
    HTML2 += '<h3> UCs cadastradas </h3>';
    HTML2 += '<table>';
    HTML2 += '  <thead>';
    HTML2 += '    <tr>';
    HTML2 += '      <th>ID</th>';
    HTML2 += '      <th>Nome da UC</th>';
    HTML2 += '      <th>Codigo</th>';
    HTML2 += '      <th>Carga Horária</th>';
    HTML2 += '      <th>Ações</th>';
    HTML2 += '    </tr>';
    HTML2 += '  </thead>';
    HTML2 += '  <tbody>';

    if (turmaSelecionada) {
      const ucs_id = turmaSelecionada.ucs_id ? turmaSelecionada.ucs_id.split('<br>') : [];
      const ucs_nome = turmaSelecionada.ucs_nome ? turmaSelecionada.ucs_nome.split('<br>') : [];
      const ucs_carga_horaria = turmaSelecionada.ucs_carga_horaria ? turmaSelecionada.ucs_carga_horaria.split('<br>') : [];
      const ucs_codigo = turmaSelecionada.ucs_codigo ? turmaSelecionada.ucs_codigo.split('<br>') : [];

      for (let i = 0; i < ucs_nome.length; i++) {
        HTML2 += '    <tr>';
        HTML2 += '      <td>';
        HTML2 += '        <span name="numero_uc"  id="valor-id-' + ucs_id[i] + '">' + ucs_id[i] + '</span>';
        HTML2 += '        <input name="numero_uc"  id="edit-id-' + ucs_id[i] + '" type="text" value="' + ucs_id[i] + '" style="display:none; width: 30px; height: 30px; font-size: 18px;">';
        HTML2 += '      </td>';
        HTML2 += '      <td>';
        HTML2 += '        <span name="nome"  id="valor-nome-uc-' + ucs_id[i] + '">' + ucs_nome[i] + '</span>';
        HTML2 += '        <input  name="nome"  id="edit-nome-uc-' + ucs_id[i] + '" type="text" value="' + ucs_nome[i] + '"  style="display:none; width: 90px; height: 30px; font-size: 18px;">';
        HTML2 += '      </td>';
        HTML2 += '      <td>';
        HTML2 += '        <span  name="codigo"  id="valor-codigo-' + ucs_id[i] + '">' + ucs_codigo[i] + '</span>';
        HTML2 += '        <input   name="codigo"  id="edit-codigo-' + ucs_id[i] + '" type="text" value="' + ucs_codigo[i] + '"  style="display:none; width: 30px; height: 30px; font-size: 18px;">';
        HTML2 += '      </td>';

        HTML2 += '      <td>';
        HTML2 += '        <span  name="carga_horaria"  id="valor-carga-' + ucs_id[i] + '">' + ucs_carga_horaria[i] + '</span>';
        HTML2 += '        <input   name="carga_horaria"  id="edit-carga-' + ucs_id[i] + '" type="text" value="' + ucs_carga_horaria[i] + '"  style="display:none; width: 50px; height: 30px; font-size: 18px;">';
        HTML2 += '      </td>';
        HTML2 += '      <td>';
        HTML2 += '        <button id="edit-' + ucs_id[i] + '" class="oi-btn" data-id="' + ucs_id[i] + '" onclick="edit_uc(\'' + ucs_id[i] + '\')"><i class="fa fa-pencil"></i> Editar</button>';
        HTML2 += '        <button id="save-' + ucs_id[i] + '" class="oi-btn" data-id="' + ucs_id[i] + '" onclick="save(\'' + ucs_id[i] + '\')" style="display: none;"><i class="fa fa-save"></i> Salvar</button>';
        HTML2 += '        <button onclick="delete_uc(\'' + ucs_id[i] + '\')"><i class="fa fa-trash"></i> Deletar</button>';
        HTML2 += '      </td>';
        HTML2 += '    </tr>';
      }
    }

    HTML2 += '  </tbody>';
    HTML2 += '</table>';

    // Código para exibir a mensagem de alerta de carga horária
let cargaHorariaAtual = 0;

if (turmaSelecionada && turmaSelecionada.ucs_carga_horaria) {
const ucs_carga_horaria = turmaSelecionada.ucs_carga_horaria.split('<br>');

for (let i = 0; i < ucs_carga_horaria.length; i++) {
cargaHorariaAtual += parseInt(ucs_carga_horaria[i]);
}
}

const cargaHorariaTotal = turmaSelecionada.carga_horaria; // Obter a carga horária total necessária da turma selecionada
const cargaHorariaRestante = cargaHorariaTotal - cargaHorariaAtual;

HTML2 += '<div class="carga-horaria-alerta">';
if (cargaHorariaRestante > 0) {
HTML2 += `<p style="font-size: 18px; width: 400px; ">Ainda faltam ${cargaHorariaRestante} horas para completar a carga horária da turma.</p>`;
} else if (cargaHorariaRestante < 0) {
const horasExcedidas = Math.abs(cargaHorariaRestante);
HTML2 += `<p  style="font-size: 18px; width:  400px;" >A carga horária da turma foi excedida em ${horasExcedidas} horas.</p>`;
} else {
HTML2 += '<p style="font-size: 18px; width:  400px;"  >A carga horária da turma foi completada!</p>';
}
HTML2 += '</div>';


      

    HTML += HTML2


    // Esconder a lista de cursos cadastrados e mostrar o texto de detalhes
    document.querySelector('.add_listagem').style.display = 'none';
    document.querySelector('.detalhes-curso').style.display = 'block';


    // // Mostrar a seção de cadastrar UC
    document.querySelector('.listagem').style.display = 'none';
    document.querySelector('.limha-th').style.display = 'none';

    document.querySelector('.add').style.display = 'block';

    // // Mostrar a seção de cadastrar UC
    document.querySelector('.search').style.display = 'none';

    document.querySelector('.double-btn').style.display = 'block';

    // Atualizar o texto de detalhes com o nome da turma selecionada
    document.querySelector('.detalhes-curso').textContent = turmaSelecionada.nome + ' - Detalhes do Curso';


    // Atualizar o conteúdo da seção resultado2
    document.getElementById("resultado").innerHTML = HTML;


                // Esconder a lista de cursos cadastrados e mostrar o texto de detalhes
                document.querySelector('.listagem').style.display = 'none';
                document.querySelector('.detalhes-curso').style.display = 'block';

                // Atualizar o conteúdo da seção detalhes com a tabela da turma selecionada
                document.querySelector('.detalhes-curso').textContent = turmaSelecionada.nome + ' - Detalhes do Curso';
                // Atualizar o conteúdo da seção resultado2
                document.getElementById("resultado").innerHTML = html;
                // Adicionar um manipulador de eventos de clique ao botão "Cadastrar UC" na seção de detalhes do curso
                document.querySelector('.add').addEventListener('click', function () {
                  // Exibir o formulário de cadastro de UC
                  document.querySelector('.form-add').style.display = 'block';

                  document.querySelector('.form-add').classList.add('show');
                });



              }
            })
            .catch(error => console.error('Erro:', error));
        });
      }
    });
  });
});

var btnDuplicarTurma = document.querySelector('.btn-duplicar-uc');

btnDuplicarTurma.addEventListener('click', function() {
  var turmaId = "0777" /* código para obter o ID da turma selecionada */

  var xhr =new XMLHttpRequest();

  xhr.onreadystatechange = function() {
    if (xhr.readyState === XMLHttpRequest.DONE) {
      if (xhr.status === 200) {
        alert(xhr.responseText);
        // atualiza a página para exibir as turmas atualizadas
        location.reload();
      } else {
        alert('Erro ao duplicar turma');
      }
    }
  };
  
  // define a URL do arquivo PHP responsável pela duplicação da turma
  var url = 'duplicar-ucs.php';
  
  // define os dados a serem enviados para o servidor
  var data = new FormData();
  data.append('turma_id', turmaId);
  
  // envia a solicitação AJAX para duplicar a turma
  xhr.open('POST', url, true);
  xhr.send(data);
});
