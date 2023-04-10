var modal = document.querySelector(".modal");
var triggers = document.querySelectorAll(".trigger");
var closeButton = document.querySelector(".close-button");

function toggleModaldetalhes() {
  modal.classList.toggle("show-modal");
}

function windowOnClick5(event) {
  if (event.target === modal) {
    toggleModaldetalhes();
  }
}



for (var i = 0, len = triggers.length; i < len; i++) {
  triggers[i].addEventListener("click", toggleModaldetalhes);
}
closeButton.addEventListener("click", toggleModaldetalhes);
window.addEventListener("click", windowOnClick5);




// modal excluir

var modalexc = document.querySelector(".modalexc");
var triggers = document.querySelectorAll(".triggerexc");
var closeButton = document.querySelector(".close-buttonexc");

function toggleModalexc() {
  modalexc.classList.toggle("show-modalexc");
}

function windowOnClick6(event) {
  if (event.target === modalexc) {
    toggleModalexc();
  }
}

for (var i = 0, len = triggers.length; i < len; i++) {
  triggers[i].addEventListener("click", toggleModalexc);
}
closeButton.addEventListener("click", toggleModalexc);
window.addEventListener("click", windowOnClick6);




// document.addEventListener('DOMContentLoaded', function() {
//   const redBox = document.querySelector('.box.red');
//   redBox.style.display = 'none';
// });

const buttons = document.querySelectorAll('.button-change');
const blueBox = document.querySelector('.table_docente');
const redBox = document.querySelector('.table_admin');
const greenBox = document.querySelector('.table_todos');


buttons.forEach((button) => {
  button.addEventListener('click', function () {
    buttons.forEach((button) => {
      button.classList.remove('active');
    });
    this.classList.add('active');
    const color = this.getAttribute('data-color');
    if (color === 'orange') {
      greenBox.style.display = 'block'

      blueBox.style.display = 'none';
      redBox.style.display = 'none';
    } else if (color === 'gray') {
      blueBox.style.display = 'block';
      redBox.style.display = 'none';
      greenBox.style.display = 'none'
    }

    else if (color === 'gray1') {
      blueBox.style.display = 'none';
      redBox.style.display = 'block';
      greenBox.style.display = 'none'
    }
  });
});


// ========================================================================

// modais

var modalUser = document.querySelector(".modal-cad-user");
var open_modalUser = document.querySelector(".open_modalUser");
var closeButtonUser = document.querySelector(".close-button-user");
var changeOpacidad = document.querySelector(".navega-color");


// essa function é pura gambiarra, mas sem tempo irmão
function backgroundChange() {
  changeOpacidad.classList.remove("navega-change")
}

function toggleModalUser() {
  modalUser.classList.toggle("show-modal");
  changeOpacidad.classList.add("navega-change")

}

function windowOnClick(event) {
  if (event.target === modalUser) {
    toggleModalUser();
    changeOpacidad.classList.remove("navega-change")
  }
}

open_modalUser.addEventListener("click", toggleModalUser);
closeButtonUser.addEventListener("click", toggleModalUser);
closeButtonUser.addEventListener("click", backgroundChange);
window.addEventListener("click", windowOnClick);


//Modal 2 -- editar

var modalEdit = document.querySelector(".modal-edit-user");
var open_modal_edit = document.querySelector(".open_modal-Edit");
var closeButton_edit = document.querySelector(".close-button-edit");

function toggleModalEdit() {
  modalEdit.classList.toggle("show-modal-edit");
  changeOpacidad.classList.add("navega-change")
}

function windowOnClick2(event) {
  if (event.target === modalEdit) {
    toggleModalEdit();
    changeOpacidad.classList.remove("navega-change")
  }
}

open_modal_edit.addEventListener("click", toggleModalEdit);
closeButton_edit.addEventListener("click", toggleModalEdit);
closeButton_edit.addEventListener("click", backgroundChange)
window.addEventListener("click", windowOnClick2);


// ========================================================================

// buscar de usuarios



const tabelaDados = document.getElementById("tabela-dados");

fetch('buscar_todos.php')
  .then(response => response.json())
  .then(data => {
    // Limpa a tabela
    tabelaDados.innerHTML = '';

    // Atualiza a tabela HTML com os dados dos usuários
    data.forEach(usuario => {
      tabelaDados.innerHTML += `
        <tr>
          <td class="btn trigger" data-ra="${usuario.ra}" onclick="exibirDetalhes(${usuario.ra})">${usuario.nome}</td>
          <td>${usuario.ra}</td>
          <td>${usuario.email}</td>
          <td>${usuario.tipo}</td>
        </tr>
      `;

    });
  })
  .catch(error => {
    console.error('Erro ao buscar usuários:', error);
  });


// ========================================================================


const tabelaUser = document.getElementById("tabela-User");

fetch('buscar_usuario.php')
  .then(response => response.json())
  .then(data => {
    // Limpa a tabela
    tabelaUser.innerHTML = '';

    // Atualiza a tabela HTML com os dados dos usuários
    data.forEach(usuario => {
      tabelaUser.innerHTML += `
          <tr>
          <td class="btn trigger" data-ra="${usuario.ra}" onclick="exibirDetalhes(${usuario.ra})">${usuario.nome}</td>
            <td>${usuario.ra}</td>
            <td>${usuario.email}</td>
            <td>${usuario.tipo}</td>
          </tr>
        `;
    });
  })
  .catch(error => {
    console.error('Erro ao buscar usuários:', error);
  });


const tabelaAdm = document.getElementById("tabela-Adm");

fetch('buscar_adm.php')
  .then(response => response.json())
  .then(data => {
    // Limpa a tabela
    tabelaAdm.innerHTML = '';

    // Atualiza a tabela HTML com os dados dos usuários
    data.forEach(usuario => {
      tabelaAdm.innerHTML += `
            <tr>
            <td class="btn trigger" data-ra="${usuario.ra}" onclick="exibirDetalhes(${usuario.ra})">${usuario.nome}</td>
              <td>${usuario.ra}</td>
              <td>${usuario.email}</td>
              <td>${usuario.tipo}</td>
            </tr>
          `;
    });
  })
  .catch(error => {
    console.error('Erro ao buscar usuários:', error);
  });


// ========================================================================

// Pesquisa  de usuarios

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
      url: 'processo_usuario.php',
      method: 'post',
      dataType: 'html',
      data: { campo: campo },
      success: function (data) {
        $('#tabela-User').html(data);
      }
    });
  });
});


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
      url: 'processo_adm.php',
      method: 'post',
      dataType: 'html',
      data: { campo: campo },
      success: function (data) {
        $('#tabela-Adm').html(data);
      }
    });
  });
});



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
      url: 'processo_todos.php',
      method: 'post',
      dataType: 'html',
      data: { campo: campo },
      success: function (data) {
        $('#tabela-dados').html(data);
        // faz a requisição AJAX para obter os detalhes da turma
      }
    });
  });
});



function exibirDetalhes(ra) {
  // Enviar solicitação HTTP para o arquivo PHP com o parâmetro RA
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      // Converter a resposta em um objeto JavaScript
      var usuario = JSON.parse(this.responseText);

      if (usuario) {

        // Exibir as informações do usuário na div
        document.getElementById("detalhes-turma").innerHTML = `<p data-ra="${usuario.ra_user}" onclick="exibirDetalhes(${usuario.ra_user})"> ${usuario.nome} </p>` +
          "<p> " + usuario.ra_user + "</p>" +
          "<p> " + usuario.tipo + "</p>";
        document.getElementById("detalhes-turma").innerHTML += '<div class="line-2"></div>';


      } else {
        // Exibir mensagem de erro
        document.getElementById("detalhes-turma").innerHTML = "<p>Usuário não encontrado.</p>";
      }
    }
  };
  xmlhttp.open("GET", `detalhes_user.php?ra=${ra}`, true);
  xmlhttp.send();
}


// funcao de exibir os detalhes do usuario e tambem de pegar o ra_user e exibir para o delete do usuario
function exibirDetalhes(ra) {
  // Enviar solicitação HTTP para o arquivo PHP com o parâmetro RA
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      // Converter a resposta em um objeto JavaScript
      var usuario = JSON.parse(this.responseText);

      if (usuario) {

        // Exibir as informações do usuário na div
        document.getElementById("detalhes-turma").innerHTML = `<p data-ra="${usuario.ra_user}" onclick="exibirDetalhes(${usuario.ra_user})"> ${usuario.nome} </p>` +
          "<p> " + usuario.ra_user + "</p>" +
          "<p> " + usuario.tipo + "</p>";

        // Atribuir o valor do ra_user ao input de matrícula
        document.querySelector(".ra_user").value = usuario.ra_user;
        document.querySelector(".nome").value = usuario.nome;
        document.querySelector(".email").value = usuario.email;
        document.querySelector("#hidden-ra").value = usuario.ra_user;


        document.getElementById("detalhes-turma").innerHTML += '<div class="line-2"></div>';
        document.querySelector(".modal-contentexc h2").setAttribute("data-ra", usuario.ra_user);
        document.querySelector(".modal-contentexc h2").textContent = usuario.nome;
        document.querySelector(".modal-contentexc h2").style.textAlign = "center";




        document.getElementById("btn-excluir-usuario").addEventListener("click", function () {
          excluirUsuario(ra);
        });

      } else {
        // Exibir mensagem de erro
        document.getElementById("detalhes-turma").innerHTML = "<p>Usuário não encontrado.</p>";
      }
    }
  };
  xmlhttp.open("GET", `detalhes_user.php?ra=${ra}`, true);
  xmlhttp.send();
}


function excluirUsuario(ra) {
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      // Redireciona para a página de listagem após a exclusão do usuário
      window.location.href = "delete_user.php?ra_user=" + ra;
    }
  };
  xmlhttp.open("GET", `detalhes_user.php?ra=${ra}`, true);
  xmlhttp.send();
}

