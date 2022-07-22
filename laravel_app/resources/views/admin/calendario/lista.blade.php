@extends('admin.layout.principal')
@section('estilos')
<link href="{{ asset('admin/css/plugins/iCheck/custom.css') }}" rel="stylesheet">

<link href="{{ asset('admin/css/plugins/fullcalendar/fullcalendar.css') }}" rel="stylesheet">
<link href="{{ asset('admin/css/plugins/fullcalendar/fullcalendar.print.css') }}" rel='stylesheet' media='print'>


@endsection
@section('conteudo')



<div class="row animated fadeInDown">
          <div class="col-ms-12">
            <div class="ibox ">
                <div class="ibox-content">
                    <button class="btn btn-primary btn-block mb-4" onclick="EditaAgendamento(0)">Adicionar Agendamento</button>
                    <div id="calendar"></div>
                </div>
            </div>
        </div>
    </div>



@endsection

@section('scripts')


<script src="{{ asset('admin/js/plugins/fullcalendar/moment.min.js') }}"></script>
<script src="{{ asset('admin/js/plugins/fullcalendar/fullcalendar.min.js') }}"></script>
<script src="{{ asset('admin/js/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
<script src="{{ asset('admin/js/plugins/iCheck/icheck.min.js') }}"></script>
<script src="{{ asset('admin/js/plugins/pace/pace.min.js')}}"></script>

<script>
    $(document).ready(function(){
        var t = new Date(y, m, d);
        console.log(t);
   


      
 /* initialize the calendar
         -----------------------------------------------------------------*/
        var date = new Date();
        var d = date.getDate();
        var m = date.getMonth();
        var y = date.getFullYear();

    $('#calendar').fullCalendar({

    monthNames: ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'],
    monthNamesShort: ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez'],
    dayNames: ['Domingo', 'Segunda', 'Terça', 'Quarta', 'Quinta', 'Sexta', 'Sabado'],
    dayNamesShort: ['Dom', 'Seg', 'Ter', 'Qua', 'Qui', 'Sex', 'Sab'],
 
  
    axisFormat: 'H:mm',
    timeFormat: {
         agenda: 'H:mm até  H:mm'
    },
    buttonText: {
        prev: "Anterior",
        next: "proximo",
        today: "Hoje",
        month: "Mês",
        week: "Semana",
        day: "Dia"
    },
            header: {
                left: 'prev,next today',
                center: 'title',
                right: 'agendaDay,month'
            },

            eventClick: function(info) {
                EditaAgendamento(info.id);
            },
            events: [
                
                @foreach($itens as $item)
                @if($item->massagista)
                {
                    
                    id: {{ $item->id }},
                    title: '{{ $item->cliente }} \n {{ $item->massagista->nome }}',
                    start:  new Date('{{ $item->agendamento }}'),
                    @php
                        $to_time = strtotime('+'. $item->massagista->duracao.' minutes',strtotime($item->agendamento));
                    @endphp
                    end:  new Date('{{ $to_time }}'),
                    color: '{{ $item->massagista->cor_agendamento }}',
                    allDay: false
                },
                @endif
                @endforeach

               
            ],
            timeFormat: 'H:mm' // uppercase H for 24-hour clock
        });

    });


function EditaAgendamento(id_agendamento){
  $('#modal').modal('show');
  $('#modal-corpo').html('loading...');
  
  requisicao('{{ route('edicao-agendamento-massagem') }}','GET',id_agendamento)
    .then(result => {
      $('#modal-titulo').html('Edição Agendamento');
      $('#modal-corpo').html(result);
    });
}
</script>
@endsection