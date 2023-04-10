var calendar;
var Calendar = FullCalendar.Calendar;
var events = [];

const aulaForm = document.getElementById("aula-form");
const feriadoForm = document.getElementById("feriado-form");

const trocarFormBtn = document.getElementById("trocar-form-btn-feriado");
const trocarFormBtn2 = document.getElementById("trocar-form-btn-aula");

$(function () {

    if (!!scheds) {
        Object.keys(scheds).map(k => {
            var row = scheds[k]
            events.push({ id: row.id, title: row.ra_docente, start: row.horario_inicio, end: row.horario_fim });
        })
    }
    // Recupera o class_id da turma selecionada na página anterior (se houver)
    const urlParams = new URLSearchParams(window.location.search);
    const class_id = urlParams.get('class_id');

    var date = new Date()
    var d = date.getDate(),
        m = date.getMonth(),
        y = date.getFullYear()

    calendar = new Calendar(document.getElementById('calendar'), {
        headerToolbar: {
            left: 'title',
            right: 'prev,next,today',
            center: 'dayGridMonth,dayGridWeek,list',
            locale: 'pt-br'
        },


        locale: 'pt-br',
        selectable: true, // inicio do evento de select de varias datas e ja preenchar os inputs da data inicio e fim
        editable: true, // inicio evento de fazer as edições
        droppable: true,  // inicio evento que pode arrastar datas 
        themeSystem: 'bootstrap',
        //Random default events
        events: events,


        // inicio evento de varias datas e ja preenchar os inputs da data inicio e fim e ja formatado para o banco reconhecer como string
        select: async (arg) => {
            // Lista de feriados

            // Lista de feriados
            var holidays = [];

            // Loop para percorrer os anos desejados
            for (var year = 2023; year <= 2030; year++) {
                // Ano novo
                holidays.push(moment(year + '-01-02').format('YYYY-MM-DD'));

                // Tiradentes
                holidays.push(moment(year + '-04-22').format('YYYY-MM-DD'));

                // Dia do Trabalho
                holidays.push(moment(year + '-05-02').format('YYYY-MM-DD'));

                // Independência do Brasil
                holidays.push(moment(year + '-09-08').format('YYYY-MM-DD'));

                // Nossa Senhora Aparecida
                holidays.push(moment(year + '-10-13').format('YYYY-MM-DD'));

                // Finados
                holidays.push(moment(year + '-11-03').format('YYYY-MM-DD'));

                // Proclamação da República
                holidays.push(moment(year + '-11-16').format('YYYY-MM-DD'));

                // Natal
                holidays.push(moment(year + '-12-26').format('YYYY-MM-DD'));
            }

            // Exemplo de como utilizar a lista de feriados

            if (holidays.includes(moment(arg.start).format('YYYY-MM-DD'))) {
                if (moment(arg.start).format('YYYY-MM-DD') === '2023-01-01') { // Exibir popup somente para o feriado de Ano Novo de 2023
                    $('#feriado-modal').modal('show');
                    $('#feriado-modal .close').click(function () { // ele faz que quando cancelar ele volta para a tela de editar
                        $('#feriado-modal').modal('hide');
                    });
                    $('#feriado-modal .close, #feriado-modal .modal-footer button').click(function () {
                        $('#feriado-modal').modal('hide');
                    });
                    return;
                }
            }


            // Verifica se a data de fim selecionada está no futuro ou não
            if (moment(arg.end).isBefore(moment())) {

                // alert('A data de término selecionada já passou!');
                // Exibe o modal de aviso
                $('#alerta-modal').modal('show');
                $('#alerta-modal .close').click(function () { // ele faz que quando cancelar ele volta para a tela de editar
                    $('#alerts-modal').modal('hide');
                });
                $('#alerta-modal .close, #alerta-modal .modal-footer button').click(function () {
                    $('#alerta-modal').modal('hide');
                });

                // // Esconde o formulário
                // $('#popup-container').hide();

                return;
            }
            // Verifica se a data selecionada é um feriado
            if (holidays.includes(moment(arg.end).format('YYYY-MM-DD'))) {
                // Exibe o modal de aviso
                $('#feriado-modal').modal('show');
                $('#feriado-modal .close').click(function () { // ele faz que quando cancelar ele volta para a tela de editar
                    $('#feriado-modal').modal('hide');
                });
                $('#feriado-modal .close, #feriado-modal .modal-footer button').click(function () {
                    $('#feriado-modal').modal('hide');
                });

                // // Esconde o formulário
                // $('#popup-container').hide();

                return;
            }

            // Verifica se a data selecionada é um feriado
            if (holidays.includes(moment(arg.start).format('YYYY-MM-DD'))) {
                // Exibe o modal de aviso
                $('#feriado-modal').modal('show');
                $('#feriado-modal .close').click(function () { // ele faz que quando cancelar ele volta para a tela de editar
                    $('#feriado-modal').modal('hide');
                });
                $('#feriado-modal .close, #feriado-modal .modal-footer button').click(function () {
                    $('#feriado-modal').modal('hide');
                });

                // // Esconde o formulário
                // $('#popup-container').hide();

                return;
            }




            // Se a data selecionada não é um feriado, continue com o evento normalmente
            var startDatetime = moment(arg.start).set({ hour: 6, minute: 0, second: 0 }).format('YYYY-MM-DDTHH:mm');
            var endDatetime = moment(arg.end).set({ hour: 23, minute: 0, second: 0 }).subtract(1, 'day').format('YYYY-MM-DDTHH:mm');




            $('#start_datetime').val(startDatetime);
            $('#end_datetime').val(endDatetime);

            $('#horario_inicio').val(startDatetime);
            $('#horario_fim').val(endDatetime);

            // $('#popup-container').show();
        },


        dayHeaderContent: function (arg) {
            var dayOfWeek = arg.date.getUTCDay();
            var customDayName;

            switch (dayOfWeek) {
                case 0:
                    customDayName = 'Domingo';
                    break;
                case 1:
                    customDayName = 'Segunda';
                    break;
                case 2:
                    customDayName = 'Terça';
                    break;
                case 3:
                    customDayName = 'Quarta';
                    break;
                case 4:
                    customDayName = 'Quinta';
                    break;
                case 5:
                    customDayName = 'Sexta';
                    break;
                case 6:
                    customDayName = 'Sábado';
                    break;
                default:
                    customDayName = arg.text;
            }

            return customDayName;
        },


        // Fim evento de varias datas e ja preenchar os inputs da data inicio e fim e ja formatado para o banco reconhecer como string

        // inicio da função que vai faz que o banco ja conserta para string e va para o arquivo que faz o update para o banco de arrastar 
        eventDrop: function (info) {
            resizeAndDrop(info);
        },
        eventResize: function (info) {
            resizeAndDrop(info);
        },


        eventClick: function (info) {
            // Carregue o idioma português para o moment.js
            moment.locale('pt-br');

            var _details;
            var id = info.event.id;

            if (!!scheds[id] && scheds[id].tipo === 'aula') {
                // É um evento de aula
                // É um evento de aula
                _details = $('#event-details-modal');
                _details.find('#title').text(scheds[id].ra_docente);
                _details.find('#description').text(scheds[id].nome_uc);

            } else if (!!scheds[id] && scheds[id].tipo === 'feriado') {
                // É um evento de feriado
                _details = $('#event-details-modal-feriado');
                _details.find('#event-title').text(scheds[id].ra_docente);
                _details.find('#event-description').text(scheds[id].id_uc);
            } else {
                // Não encontrou o evento
                alert("Event is undefined");
                return;
            }

            // Formate as datas usando o moment.js
            var startDate = moment(scheds[id].sdate).format('LLL');
            var endDate = moment(scheds[id].edate).format('LLL');

            _details.find('#start').text(startDate);
            _details.find('#end').text(endDate);
            _details.find('#event-start').text(startDate);
            _details.find('#event-end').text(endDate);
            _details.find('#edit,#edit-evento,#delete,#delete-button').attr('data-id', id);
            _details.modal('show');
        },



        eventDidMount: function (info) {
            // Do Something after events mounted
        },

        dateClick: function (info) {
            // evento que select de uma data e ja preenchar os inputs da data inicio e fim
            // evento que select de uma data e já preencher os inputs da data inicio e fim
            var clickedDate = moment(info.dateStr);
            var startDatetime = clickedDate.set({ hour: 6, minute: 0, second: 0 }).format('YYYY-MM-DDTHH:mm');
            var endDatetime = clickedDate.set({ hour: 23, minute: 30, second: 0 }).format('YYYY-MM-DDTHH:mm');
            $('#start_datetime').val(startDatetime);
            $('#end_datetime').val(endDatetime);

            // ...
        }
    });


    calendar.render();





    // Teste de API de feriados
    getFeriados().then(function (feriados) {
        $.each(feriados, function (index, feriado) {
            // Cria um objeto de evento para cada feriado
            var event = {
                title: feriado.nome,
                start: feriado.data,
                allDay: true,
                backgroundColor: feriado.tipo === 'facultativo' ? '#FFA500' : (feriado.tipo === 'ponto' ? '#A9A9A9' : '#f00'), // fundo laranja para facultativo, verde para ponto feriado, vermelho para feriado
                textColor: '#fff' // texto em branco
            };
            // Adiciona o objeto de evento à lista de eventos do calendário
            calendar.addEvent(event);
        });
    });

    // Aqui ele acha a API de feriados
    function getFeriados() {
        return $.ajax({
            url: '../../funcoes_calendario/api_feriado.php',
            dataType: 'json',
            success: function (response) {
                return response;
            }
        });
    }



    // teste de api de feriados


    // Aqui e a funcao que impeca que cria aula em feriados nacionais

    $(document).ready(function () {
        // Adicionar ouvinte de evento ao botão salvar
        $('#save-btn').click(function () {
            var start_date = new Date($('#start_datetime').val());
            var year = start_date.getFullYear();
            var month = start_date.getMonth() + 1;
            var day = start_date.getDate();
            var is_holiday = getFeriados(year, month, day);

            if (is_holiday) {
                // exibir a mensagem de popup
                var feriadoModal = $('#feriado-modal');
                feriadoModal.find('.modal-body').html('Não é possível criar aula em feriados.');
                feriadoModal.modal('show');
            } else {
                $('#schedule-form').submit(); // Envia o formulário
            }
        });

        //Função que retorna true se a data for feriado
        function getFeriados(year, month, day) {
            var holidays = {
                '01-01': 'Ano Novo',
                '04-21': 'Tiradentes',
                '05-01': 'Dia do Trabalho',
                '09-07': 'Independência do Brasil',
                '10-12': 'Nossa Senhora Aparecida',
                '11-02': 'Finados',
                '11-15': 'Proclamação da República',
                '12-25': 'Natal'
            };

            var holiday = false;
            var date_string = year + '-' + (month < 10 ? '0' : '') + month + '-' + (day < 10 ? '0' : '') + day;

            for (var d in holidays) {
                var holiday_date = year + '-' + d;
                if (holiday_date === date_string) {
                    holiday = true;
                    break;
                }
            }

            return holiday;
        }

        // Adicionar ouvinte de evento ao formulário de agendamento
        $('#schedule-form').on('submit', function (e) {
            e.preventDefault();

            // faz uma verificação se é feriado antes de enviar o formulário
            var start_date = new Date($('#start_datetime').val());
            var year = start_date.getFullYear();
            var month = start_date.getMonth() + 1;
            var day = start_date.getDate();
            var is_holiday = getFeriados(year, month, day);

            if (is_holiday) {
                // exibir a mensagem de popup
                var feriadoModal = $('#feriado-modal');
                feriadoModal.find('.modal-body').html('Não é possível criar aula em feriados.');
                feriadoModal.modal('show');
            } else {
                // faz o envio do formulário via AJAX
                $.ajax({
                    url: '../../funcoes_calendario/save_schedule.php',
                    method: 'POST',
                    data: $(this).serialize(),
                    success: function () {
                        // exibe a mensagem de sucesso na caixa de diálogo
                        $('#success-modal').modal('show');

                        // esconde o formulárioapós o envio
                        $('#schedule-form').show().fadeOut(3000, function () {
                            // recarrega a página após a mensagem desaparecer
                            location.reload();
                        });
                        // limpa o formulário
                        $('#schedule-form').trigger('reset');
                    }
                });
            }
        });
    });


    // Aqui e a funcao que impeca que cria feriado em feriados nacionais

    $(document).ready(function () {
        // Adicionar ouvinte de evento ao botão salvar
        $('#save-btn').click(function () {
            var start_date = new Date($('#horario_inicio').val());
            var year = start_date.getFullYear();
            var month = start_date.getMonth() + 1;
            var day = start_date.getDate();
            var is_holiday = getFeriados(year, month, day);

            if (is_holiday) {
                // exibir a mensagem de popup
                var feriadoModal = $('#feriado-modal');
                feriadoModal.find('.modal-body').html('Não é possível criar aula em feriados.');
                feriadoModal.modal('show');
            } else {
                $('#schedule-form').submit(); // Envia o formulário
            }
        });

        //Função que retorna true se a data for feriado
        function getFeriados(year, month, day) {
            var holidays = {
                '01-01': 'Ano Novo',
                '04-21': 'Tiradentes',
                '05-01': 'Dia do Trabalho',
                '09-07': 'Independência do Brasil',
                '10-12': 'Nossa Senhora Aparecida',
                '11-02': 'Finados',
                '11-15': 'Proclamação da República',
                '12-25': 'Natal'
            };

            var holiday = false;
            var date_string = year + '-' + (month < 10 ? '0' : '') + month + '-' + (day < 10 ? '0' : '') + day;

            for (var d in holidays) {
                var holiday_date = year + '-' + d;
                if (holiday_date === date_string) {
                    holiday = true;
                    break;
                }
            }

            return holiday;
        }

        // Adicionar ouvinte de evento ao formulário de agendamento
        $('#schedule-form1').on('submit', function (e) {
            e.preventDefault();

            // faz uma verificação se é feriado antes de enviar o formulário
            var start_date = new Date($('#horario_inicio').val());
            var year = start_date.getFullYear();
            var month = start_date.getMonth() + 1;
            var day = start_date.getDate();
            var is_holiday = getFeriados(year, month, day);

            if (is_holiday) {
                // exibir a mensagem de popup
                var feriadoModal = $('#feriado-modal');
                feriadoModal.find('.modal-body').html('Não é possível criar aula em feriados.');
                feriadoModal.modal('show');
            } else {
                // faz o envio do formulário via AJAX
                $.ajax({
                    url: '../../funcoes_calendario/save_feriado.php',
                    method: 'POST',
                    data: $(this).serialize(),
                    success: function () {
                        // exibe a mensagem de sucesso na caixa de diálogo
                        $('#success-modal').modal('show');

                        // esconde o formulárioapós o envio
                        $('#schedule-form1').show().fadeOut(3000, function () {
                            // recarrega a página após a mensagem desaparecer
                            location.reload();
                        });
                        // limpa o formulário
                        $('#schedule-form1').trigger('reset');
                    }
                });
            }
        });
    });


    //teste de fazer um popup apareca e depois some e da um reset na pagina de deletar
    $('#delete').click(function () {
        var id = $(this).attr('data-id');
        if (!!scheds[id]) {
            $('#event-details-modal').modal('hide');
            $('#delete-modal').modal('show');
            $('#confirm-delete').click(function () {
                location.href = "../../funcoes_calendario/delete_schedule.php?id=" + id;
            });
            $('#delete-modal').on('hidden.bs.modal', function (e) {
                $('#event-details-modal').modal('show');
            });
            $('#delete-modal').on('shown.bs.modal', function (e) { // ele faz que quando cancelar ele volta para a tela de editar
                $('#confirm-delete').focus();
            });
            $('#delete-modal .close').click(function () { // ele faz que quando cancelar ele volta para a tela de editar
                $('#delete-modal').modal('hide');
            });
            $('#delete-modal .btn-secondary').click(function () { // ele faz que quando cancelar ele volta para a tela de editar
                $('#delete-modal').modal('hide');
            });
        } else {
            alert("Evento não definido");
        }
    });

    //teste de fazer um popup apareca e depois some e da um reset na pagina de deletar
    $('#delete-button').click(function () {
        var id = $(this).attr('data-id');
        if (!!scheds[id]) {
            $('#event-details-modal-feriado').modal('hide');
            $('#delete-modal-feriado').modal('show');
            $('#confirm-delete-feriado').click(function () {
                location.href = "../../funcoes_calendario/delete_feriado.php?id=" + id;
            });
            $('#delete-modal-feriado').on('hidden.bs.modal', function (e) {
                $('#event-details-modal-feriado').modal('show');
            });
            $('#delete-modal-feriado').on('shown.bs.modal', function (e) { // ele faz que quando cancelar ele volta para a tela de editar
                $('#confirm-delete-feriado').focus();
            });
            $('#delete-modal-feriado .close').click(function () { // ele faz que quando cancelar ele volta para a tela de editar
                $('#delete-modal-feriado').modal('hide');
            });
            $('#delete-modal-feriado .btn-secondary').click(function () { // ele faz que quando cancelar ele volta para a tela de editar
                $('#delete-modal-feriado').modal('hide');
            });
        } else {
            alert("Evento não definido");
        }
    });







    // Form reset listener
    $('#schedule-form').on('reset', function () {
        $(this).find('input:hidden').val('')
        $(this).find('input:visible').first().focus()
    })



    // Form reset listener
    $('#schedule-form1').on('reset', function () {
        $(this).find('input:hidden').val('')
        $(this).find('input:visible').first().focus()
    })
    // Editar botão de criar aula

    $(document).ready(function () {

        $('#edit').click(function () {
            var id = $(this).attr('data-id')
            if (!!scheds[id]) {
                var _form = $('#schedule-form')
                console.log(String(scheds[id].horario_inicio), String(scheds[id].horario_inicio).replace(" ", "\\t"))
                _form.find('[name="id"]').val(id)
                _form.find('[name="title"]').val(scheds[id].ra_docente) //altera para usuario_id
                _form.find('[name="description"]').val(scheds[id].id_uc)
                _form.find('[name="start_datetime"]').val(String(scheds[id].horario_inicio).replace(" ", "T"))
                _form.find('[name="end_datetime"]').val(String(scheds[id].horario_fim).replace(" ", "T"))
                $('#event-details-modal').modal('hide')
                _form.find('[name="title"]').focus()
            } else {
                alert("Event is undefined");
            }
        })
    });


    // Editar botão de criar aula
    $(document).ready(function () {
        $('#edit-evento').click(function () {
            var id = $(this).attr('data-id')
            if (!!scheds[id]) {
                var _form = $('#schedule-form1')
                console.log(String(scheds[id].horario_inicio), String(scheds[id].horario_inicio).replace(" ", "\t"))
                _form.find('[name="id"]').val(id)
                _form.find('[name="titulo"]').val(scheds[id].ra_docente) //altera para usuario_id
                _form.find('[name="descricao"]').val(scheds[id].id_uc)
                _form.find('[name="horario_inicio"]').val(String(scheds[id].horario_inicio).replace(" ", "T"))
                _form.find('[name="horario_fim"]').val(String(scheds[id].horario_fim).replace(" ", "T"))
                $('#event-details-modal-feriado').modal('hide')
                _form.find('[name="titulo]').focus()
            } else {
                alert("Event is undefined");
            }
        })
    });

    // Editar botão de feriados

    trocarFormBtn.addEventListener("click", () => {
        aulaForm.style.display = "none";
        feriadoForm.style.display = "block";
    });

    trocarFormBtn2.addEventListener("click", () => {
        feriadoForm.style.display = "none";
        aulaForm.style.display = "block";
    });
    //teste de fazer um popup apareca e depois some e da um reset na pagina


    // buscar o ra_user e o nome do professor


    $(document).ready(function () {
        $('#title').select2({
            placeholder: 'Pesquisar nome do professor',
            ajax: {
                url: '../../funcoes_calendario/buscar_usuario.php',
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
                                id: obj.ra_user,
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
                    "<ul class='select2-results__options'>";
                markup +=
                    "<li class='select2-results__option'><strong>Nome:</strong> " +
                    result.text + " - <strong>RA:</strong> " +
                    result.id + "</li>";
                markup += "</ul>";
                return markup;
            },
            templateSelection: function (result) {
                // mostrar apenas o nome selecionado em preto, com o ra_user entre parênteses
                return "<span style='color:black;'>" + result.text +
                    " (" + result.id + ")" + "</span>";
            },
            escapeMarkup: function (markup) {
                return markup;
            },
            matcher: function (term, text, option) {
                return text.toUpperCase().indexOf(term
                    .toUpperCase()) == 0;
            }
        });
    });

    $('#description').select2({
        placeholder: 'Pesquisar pela UC',
        ajax: {
            url: '../../funcoes_calendario/buscar_uc.php',
            dataType: 'json',
            delay: 250,
            data: function (params) {
                return {
                    search: params.term, // termo de pesquisa
                    turma: $('#turma').val() // valor da turma selecionada
                };
            },
            minimumInputLength: 2,
            processResults: function (data) {
                return {
                    results: $.map(data, function (obj) {
                        return {
                            id: obj.id,
                            text: obj.nome_uc,
                            text_1: obj.turma,
                        };
                    })
                };
            },
            cache: true
        },
        templateResult: function (result) {
            // mostrar como lista com o número do RA
            var markup =
                "<ul class='select2-results__options'>";
            markup +=
                "<li class='select2-results__option'><strong>UC:</strong> " +
                result.id + " - <strong>Nome:</strong> " +
                result.text + "</li>";
            markup += "</ul>";
            return markup;
        },
        templateSelection: function (result) {
            // mostrar apenas o nome selecionado em preto, com a turma entre parênteses
            return "<span style='color:black;'>" + result.id +
                " (" + result.text + " uc" + " - " + " turma)" + "</span>";
        },
        escapeMarkup: function (markup) {
            return markup;
        },
        matcher: function (term, text, option) {
            return text.toUpperCase().indexOf(term
                .toUpperCase()) == 0;
        }
    });



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

            // Verificar se a opção "todas as aulas" foi selecionada
            if (class_id === 'all') {
                // Redirecionar para a página do calendário sem filtro de turma
                window.location.href = "../adm/index.php";
            } else {
                // Redirecionar para a página do calendário com os parâmetros 'class_id' e 'uc_id' na URL
                window.location.href = "../adm/index.php?class_id=" + class_id;
            }
        });

    });



    //Arraste e redimensionamento de eventos
    // função que faz a converção de mês, data e minutos para string, para o banco reconhcer 

    //Arraste e redimensionamento de eventos
    async function resizeAndDrop(info) {
        let newDate = new Date(info.event.start);
        let month = ((newDate.getMonth() + 1) < 9) ? "0" + (newDate.getMonth() + 1) : newDate.getMonth() + 1;
        let day = ((newDate.getDate()) < 9) ? "0" + newDate.getDate() : newDate.getDate();
        let minutes = ((newDate.getMinutes()) < 9) ? "0" + newDate.getMinutes() : newDate.getMinutes();
        newDate = `${newDate.getFullYear()}-${month}-${day} ${newDate.getHours()}:${minutes}:00`

        let newDateEnd = new Date(info.event.end);
        let monthEnd = ((newDateEnd.getMonth() + 1) < 9) ? "0" + (newDateEnd.getMonth() + 1) : newDateEnd.getMonth() + 1;
        let dayEnd = ((newDateEnd.getDate()) < 9) ? "0" + newDateEnd.getDate() : newDateEnd.getDate();
        let minutesEnd = ((newDateEnd.getMinutes()) < 9) ? "0" + newDateEnd.getMinutes() : newDateEnd.getMinutes();
        newDateEnd = `${newDateEnd.getFullYear()}-${monthEnd}-${dayEnd} ${newDateEnd.getHours()}:${minutesEnd}:00`


        let reqs = await fetch('../../funcoes_calendario/ControllerDrop.php', {
            method: 'post',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            body: `id=${info.event.id}&start=${newDate}&end=${newDateEnd}`

        });
        location.reload();
        let ress = await reqs.json();

    }
});