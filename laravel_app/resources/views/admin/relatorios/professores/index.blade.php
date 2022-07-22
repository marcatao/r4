@extends('admin.layout.principal')

@section('estilos')

<link href="{{ asset('admin/css/plugins/datapicker/datepicker3.css') }}" rel="stylesheet">

<link href="{{ asset('admin/css/plugins/dataTables/datatables.min.css') }}" rel="stylesheet">  
<link href="{{ asset('admin/css/plugins/daterangepicker/daterangepicker-bs3.css') }}" rel="stylesheet">
@endsection

@section('conteudo')


<div class="ibox">
    <div class="ibox-title">
        <h5>Filtros</h5>

    </div>
    <div class="ibox-content">
        <h4> Periodo:</h4>
        <div id="reportrange" class="form-control">
            <i class="fa fa-calendar"></i>
            <span></span> <b class="caret"></b>
        </div>

        
        <form action="{{ route('admin-relatorio-professores') }}" method="GET" id="FormRelatorio">
            <input type="hidden" name="dt_1" id="dt_1">
            <input type="hidden" name="dt_2" id="dt_2">
           
            <h4> Professor:</h4>
               
                    <select name="professor_id" id="professor_id"  class="form-control" required>
                        <option value="">Selecione o professor</option> 
                    @foreach (\App\user::where('perfil','Professor')->get() as $professor)
                        <option value="{{ $professor->id }}">{{ $professor->name }}</option>    
                    @endforeach
                    </select>
               
 
            
        </form>

        <button class="btn btn-primary btn-block mt-3 mb-3" id="saveBtn">Carregar</button>  
    </div>
</div>


 
<div class="row">
    <div class="col-lg-12">
    <div class="ibox ">
 
        <div class="ibox-content">

            <div class="table-responsive">
        <table class="table table-striped table-bordered table-hover dataTables-example" id="table-operacoes-relatorio">
        <thead>
        <tr>
            <th>#</th>
            <th>Data</th>
            <th class="bg-primary">Alunos</th>
            <th class="bg-primary">Aulas</th>
            <th>Custo</th>
            <th class="bg-warning">Total horas</th>
            <th>VL Aula</th>
            <th class="bg-warning">VL Adicional</th>
            <th class="bg-danger" >Total</th>
            <th class="bg-success" >Total R4</th>
        </tr>
        </thead>
        <tbody>
            @if($itens)
                        @php
                            $total_alunos = 0;
                            $total_aulas = 0;
                            $total_horas = 0;
                            $total_adicional =0;
                            $total_total = 0;
                            $total_r4 = 0;
                        @endphp
            @foreach ($itens as $item)
                    @php
                        $total_alunos +=   $item->alunos->count();   
                        $total_aulas += $item->qt_aula;
                        $total_horas += ($item->custo*$item->qt_aula);
                        $total_adicional += (((($item->alunos->count() - 1)* $item->vl_adicional)*$item->qt_aula));
                        $total_total += ((((($item->alunos->count() - 1)* $item->vl_adicional)*$item->qt_aula)+$item->custo*$item->qt_aula));
                        $total_r4 += ($item->alunos->count() * $item->vl_aula)*$item->qt_aula ;
                    @endphp
                <tr>
                    <td>{{ $item->id }}</td>
                    <td> {{date('d/m/Y', strtotime($item->data))}}</td>
                    <td class="bg-primary">{{ $item->alunos->count() }}</td>
                    <td class="bg-primary">{{ $item->qt_aula }}</td>
                    <td>{{ number_format($item->custo,2,",",".")  }}</td>
                    <td class="bg-warning">{{ number_format(($item->custo*$item->qt_aula),2,",",".")  }}</td>
                    <td>{{ number_format(($item->vl_aula),2,",",".")  }}</td>
                    <td class="bg-warning">{{ number_format((((($item->alunos->count() - 1)* $item->vl_adicional)*$item->qt_aula)),2,",",".")  }}</td>
                    <td class="bg-danger">{{ number_format(((((($item->alunos->count() - 1)* $item->vl_adicional)*$item->qt_aula)+$item->custo*$item->qt_aula)),2,",",".")  }}</td>
                    <td class="bg-success" >{{ ($item->alunos->count() * $item->vl_aula)*$item->qt_aula }}</td>
                </tr>
            @endforeach
            @endif
        </tbody>
        <tfooter>
        <tr>
            <th> </th>
            <th></th>
            <th> @if($itens){{  $total_alunos }} @endif</th>
            <th> @if($itens){{  $total_aulas }} @endif</th>
            <th>  </th>
            <th> @if($itens){{  number_format($total_horas,2,",",".")  }} @endif</th>
            <th>  </th>
            <th> @if($itens){{  number_format($total_adicional,2,",",".")  }} @endif</th>
            <th> @if($itens){{  number_format($total_total,2,",",".")  }} @endif</th>
            <th> @if($itens){{  number_format($total_r4,2,",",".")  }} @endif</th>

        </tr>
        <tr>
            <th> </th>
            <th></th>
            <th></th>
            <th>  </th>
            <th>  </th>
            <th>  </th>
            <th>  </th>
            <th>  </th>
            <th  class="bg-danger"> Lucro </th>
            <th  class="bg-danger"> @if($itens){{  number_format(($total_r4 - $total_total),2,",",".")  }} @endif</th>

        </tr>
        </tfooter>
        </table>
            </div>

        </div>
    </div>
</div>
</div> 
</div>


@endsection

@section('scripts')

<!-- Data picker -->
<script src="{{ asset('admin/js/plugins/datapicker/bootstrap-datepicker.js')}}"></script>

<!-- Date range use moment.js same as full calendar plugin -->
<script src="{{ asset('admin/js/plugins/fullcalendar/moment.min.js')}}"></script>

<!-- Date range picker -->
<script src="{{ asset('admin/js/plugins/daterangepicker/daterangepicker.js')}}"></script>

<script src="{{ asset('admin/js/plugins/dataTables/datatables.min.js')}}"></script>
<script src="{{ asset('admin/js/plugins/dataTables/dataTables.bootstrap4.min.js')}}"></script>
<script>
    var startDate;
    var endDate;

$(document).ready(function(){
    @isset($professor_id)
        @if($professor_id)
            $('#professor_id').val({{ $professor_id }})
        @endif
    @endisset
    $('#reportrange span').html('{{ $dt_1 }}' + ' - ' + '{{ $dt_2 }}');

$('#reportrange').daterangepicker({
    format: 'D/MM/YYYY',
    startDate: '{{ $dt_1 }}',
    endDate: '{{ $dt_2 }}',
    minDate: '01/01/2012',  
    maxDate: '12/31/2022',
    showDropdowns: true,
    showWeekNumbers: true,
    timePicker: false,
    timePickerIncrement: 1,
    timePicker12Hour: true,
    ranges: {
        "Este Mês": [moment().startOf("month"), moment().endOf("month")],
        "Mês passado": [moment().subtract(1, "month").startOf("month"), moment().subtract(1, "month").endOf("month")]
    },
    opens: 'right',
    drops: 'down',
    buttonClasses: ['btn', 'btn-sm'],
    applyClass: 'btn-primary',
    cancelClass: 'btn-default',
    separator: ' to ',
    locale: {
        applyLabel: 'Aplicar',
        cancelLabel: 'Cancelar',
        fromLabel: 'De',
        toLabel: 'Até',
        customRangeLabel: 'Intervalo',
        daysOfWeek: ['Dom', 'Seg', 'Ter', 'Qua', 'Qui', 'Sex','Sab'],
        monthNames: ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Stembro', 'Outubro', 'Novembro', 'Dezembro'],
        firstDay: 1
    }
}, function(start, end, label) {
    console.log(start.toISOString(), end.toISOString(), label);
    $('#reportrange span').html(start.format('D/MM/YYYY') + ' - ' + end.format('D/MM/YYYY'));
    startDate = start;
    endDate = end; 
});

$('#saveBtn').click(function(){
    startDate = $("#reportrange").data('daterangepicker').startDate.format('YYYY-MM-DD');
    endDate = $("#reportrange").data('daterangepicker').endDate.format('YYYY-MM-DD');
    console.log(startDate + ' - ' + endDate);
    $('#dt_1').val(startDate);
    $('#dt_2').val(endDate);

    $('#FormRelatorio').submit();

});

    $('#table-operacoes-relatorio').DataTable({
        responsive: true,
        paginate : false,
        dom: '<"html5buttons"B>lTfgitp',
            buttons: [
                { extend: 'copy'},
                {extend: 'csv'},
                {extend: 'excel', title: 'Reletório de Operações'},
                {extend: 'pdf', title: 'Reletório de Operações - {{ $dt_1 }} a {{ $dt_2 }}'},

                {extend: 'print',
                 customize: function (win){
                        $(win.document.body).addClass('white-bg');
                        $(win.document.body).css('font-size', '10px');

                        $(win.document.body).find('table')
                                .addClass('compact')
                                .css('font-size', 'inherit');
                }
                }
            ]
    });

});

function CarregaRelatorio(){
    console.log('Carrega Relatorio');
}
function itens_da_operacao(id_operacao){
    console.log('{{ route('admin-itens-da-operacao') }}: ' + id_operacao);
    $('#modal').modal('show');
         $('#modal-corpo').html('loading...');
         $('#modal-titulo').html('');
         requisicao('{{ route('admin-itens-da-operacao') }}','GET',id_operacao)
          .then(result => {
           $('#modal-corpo').html(result);
    });
}
</script>
@endsection