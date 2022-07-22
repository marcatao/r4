@extends('admin.layout.principal')
@section('estilos')

<link href="{{ asset('admin/js/plugins/calendar2/lib/main.css') }}" rel="stylesheet" />
<script src='{{ asset('admin/js/plugins/calendar2/lib/main.js') }}'></script>
<script src='{{ asset('admin/js/plugins/calendar2/lib/locales/pt-br.js') }}'></script>


@endsection
@section('conteudo')



<div class="row animated fadeInDown">
        <div class="col-md-3">
            
 
        </div>
        <div class="col-md-9">
            <div id='calendar'></div>
        </div>
    </div>



@endsection

@section('scripts')




<script>
    $(document).ready(function(){


    });
 

document.addEventListener('DOMContentLoaded', function() {
  var calendarEl = document.getElementById('calendar');

  var calendar = new FullCalendar.Calendar(calendarEl, {
 
    monthNames: ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'],
    monthNamesShort: ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez'],
    dayNames: ['Domingo', 'Segunda', 'Terça', 'Quarta', 'Quinta', 'Sexta', 'Sabado'],
    dayNamesShort: ['Dom', 'Seg', 'Ter', 'Qua', 'Qui', 'Sex', 'Sab'],
    titleFormat: {
        month: 'MMMM yyyy',
        week: "d[ MMMM][ yyyy]{ - d MMMM yyyy}",
        day: 'dddd, d MMMM yyyy'
    },

    headerToolbar: {
      left: 'prev,next today',
      center: 'title',
      right: 'dayGridMonth,timeGridWeek,timeGridDay,listMonth'
    },
    initialDate: '2020-09-12',
    navLinks: true, // can click day/week names to navigate views
    businessHours: true, // display business hours
    editable: true,
    selectable: true,
    events: [
      {
        title: 'Business Lunch',
        start: '2020-09-03T13:00:00',
        constraint: 'businessHours'
      },
      {
        title: 'Meeting',
        start: '2020-09-13T11:00:00',
        constraint: 'availableForMeeting', // defined below
        color: '#257e4a'
      },
      {
        title: 'Conference',
        start: '2020-09-18',
        end: '2020-09-20'
      },
      {
        title: 'Party',
        start: '2020-09-29T20:00:00'
      },

      // areas where "Meeting" must be dropped
      {
        groupId: 'availableForMeeting',
        start: '2020-09-11T10:00:00',
        end: '2020-09-11T16:00:00',
        display: 'background'
      },
      {
        groupId: 'availableForMeeting',
        start: '2020-09-13T10:00:00',
        end: '2020-09-13T16:00:00',
        display: 'background'
      },

      // red areas where no events can be dropped
      {
        start: '2020-09-24',
        end: '2020-09-28',
        overlap: false,
        display: 'background',
        color: '#ff9f89'
      },
      {
        start: '2020-09-06',
        end: '2020-09-08',
        overlap: false,
        display: 'background',
        color: '#ff9f89'
      }
    ]
  });

  calendar.render();
});

</script>
@endsection