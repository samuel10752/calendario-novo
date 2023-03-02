var calendar;
var Calendar = FullCalendar.Calendar;
var events = [];
$(function() {
    if (!!scheds) {
        Object.keys(scheds).map(k => {
            var row = scheds[k]
            events.push({ id: row.id, title: row.ra_docente, start: row.horario_inicio, end: row.horario_fim });
        })
    }
    var date = new Date()
    var d = date.getDate(),
        m = date.getMonth(),
        y = date.getFullYear()

    calendar = new Calendar(document.getElementById('calendar'), {
        headerToolbar: {
            left: 'prev,next today',
            right: 'dayGridMonth,dayGridWeek,list',
            center: 'title',
            locale: 'pt-br'
        },
        locale: 'pt-br',
        selectable: true,
        editable: true,
        droppable:true,
        themeSystem: 'bootstrap',
        //Random default events
        events: events,
        // evento de varias datas e ja preenchar os inputs da data inicio e fim
        select: async (arg)=>{
            // console.log(arg);
            var startDatetime = moment(arg.start).format('YYYY-MM-DDTHH:mm');
            var endDatetime = moment(arg.end).format('YYYY-MM-DDTHH:mm');
            $('#start_datetime').val(startDatetime);
            $('#end_datetime').val(endDatetime);
        },
        eventDrop:function(info){
            console.log(info);
            resizeAndDrop(info);
        },
        eventResize:function(info){
            resizeAndDrop(info);
        },
        eventClick: function(info) {
            var _details = $('#event-details-modal')
            var id = info.event.id
            if (!!scheds[id]) {
                _details.find('#title').text(scheds[id].ra_docente)
                _details.find('#description').text(scheds[id].id_uc)
                _details.find('#start').text(scheds[id].sdate)
                _details.find('#end').text(scheds[id].edate)
                _details.find('#edit,#delete').attr('data-id', id)
                _details.modal('show')
            } else {
                alert("Event is undefined");
            }
        },
        eventDidMount: function(info) {
            // Do Something after events mounted
        },
        dateClick: function(info) {
        // evento que selecio uma e ja preenchar os inputs da data inicio e fim
            var clickedDate = moment(info.dateStr).format('YYYY-MM-DDTHH:mm');
            $('#start_datetime').val(clickedDate);
            $('#end_datetime').val(clickedDate);
            // ...
        }
    });

    calendar.render();

    // Form reset listener
    $('#schedule-form').on('reset', function() {
        $(this).find('input:hidden').val('')
        $(this).find('input:visible').first().focus()
    })

    // Edit Button
    $('#edit').click(function() {
        var id = $(this).attr('data-id')
        if (!!scheds[id]) {
            var _form = $('#schedule-form')
            console.log(String(scheds[id].horario_inicio), String(scheds[id].horario_inicio).replace(" ", "\\t"))
            _form.find('[name="id"]').val(id)
            _form.find('[name="title"]').val(scheds[id].ra_docente)
            _form.find('[name="description"]').val(scheds[id].id_uc)
            _form.find('[name="start_datetime"]').val(String(scheds[id].horario_inicio).replace(" ", "T"))
            _form.find('[name="end_datetime"]').val(String(scheds[id].horario_fim).replace(" ", "T"))
            $('#event-details-modal').modal('hide')
            _form.find('[name="title"]').focus()
        } else {
            alert("Event is undefined");
        }
    })

    // Delete Button / Deleting an Event
    $('#delete').click(function() {
        var id = $(this).attr('data-id')
        if (!!scheds[id]) {
            var _conf = confirm("Are you sure to delete this scheduled event?");
            if (_conf === true) {
                location.href = "./delete_schedule.php?id=" + id;
            }
        } else {
            alert("Event is undefined");
        }
    })

    //Arraste e redimensionamento de eventos
    async function resizeAndDrop(info){
        let newDate = new Date(info.event.start);
        let month = ((newDate.getMonth()+1)<9)?"0"+(newDate.getMonth()+1):newDate.getMonth()+1;
        let day = ((newDate.getDate())<9)?"0"+newDate.getDate():newDate.getDate();
        let minutes = ((newDate.getMinutes())<9)?"0"+newDate.getMinutes():newDate.getMinutes();
        newDate = `${newDate.getFullYear()}-${month}-${day} ${newDate.getHours()}:${minutes}:00`

        let newDateEnd = new Date(info.event.end);
        let monthEnd = ((newDateEnd.getMonth()+1)<9)?"0"+(newDateEnd.getMonth()+1):newDateEnd.getMonth()+1;
        let dayEnd = ((newDateEnd.getDate())<9)?"0"+newDateEnd.getDate():newDateEnd.getDate();
        let minutesEnd = ((newDateEnd.getMinutes())<9)?"0"+newDateEnd.getMinutes():newDateEnd.getMinutes();
        newDateEnd = `${newDateEnd.getFullYear()}-${monthEnd}-${dayEnd} ${newDateEnd.getHours()}:${minutesEnd}:00`


        let reqs = await fetch('http://localhost/schedule-master/ControllerDrop.php',{
            method:'post',
            headers:{
                'Content-Type':'application/x-www-form-urlencoded'
            },
            body:`id=${info.event.id}&start=${newDate}&end=${newDateEnd}`
        });
        let ress = await reqs.json();
    }
})