
 
@extends('admin.layout.principal')

@section('estilos')

<link href="{{ asset('admin/css/plugins/datapicker/datepicker3.css') }}" rel="stylesheet">

<link href="{{ asset('admin/css/plugins/dataTables/datatables.min.css') }}" rel="stylesheet">  
<link href="{{ asset('admin/css/plugins/daterangepicker/daterangepicker-bs3.css') }}" rel="stylesheet">
@endsection

@section('conteudo')


<div class="ibox">
    <div class="ibox-title">
        <h5>Alunos Filtros</h5>

    </div>
    <div class="ibox-content">
        <h4> Periodo:</h4>
        <div id="reportrange" class="form-control">
            <i class="fa fa-calendar"></i>
            <span></span> <b class="caret"></b>
        </div>

        
        <form action="{{ route('admin-relatorio-alunos') }}" method="GET" id="FormRelatorio">
            <input type="hidden" name="dt_1" id="dt_1">
            <input type="hidden" name="dt_2" id="dt_2">
           
            <h4> Aluno:</h4>
               
                    <select name="aluno_id" id="aluno_id"  class="form-control" required>
                        <option value="">Selecione o Aluno</option> 
                    @foreach (\App\user::where('perfil','Aluno')->get() as $aluno)
                        <option value="{{ $aluno->id }}">{{ $aluno->name }}</option>    
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
                @if($selecionado)
                <h3>{{ $aluno_id }} - {{ $selecionado->name }}</h3>
                @endif
                <table class="table table-striped table-bordered table-hover dataTables-example" id="table-operacoes-relatorio">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th  class="bg-warning">Data</th>
                            @foreach ($itens->groupBy('aula_id') as $key=>$item)
                                <th>{{ \App\aulas::find($key)->descricao }}</th>
                            @endforeach
                            <th class="bg-warning">Aulas dia</th>
                            <th class="bg-primary">Total dia</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $valores = [];
                            $total_valor=0;
                        @endphp
                        @foreach ($itens->groupBy('data') as $key_data=>$r)
                        @php $valor_dia=0; $aulas_dia=0; @endphp
                            <tr>
                                <th>{{ $loop->index +1 }}</th>
                                    <td  class="bg-warning">{{date('d/m/Y', strtotime($r[0]->data))}}</td>
                                     @foreach ($itens->groupBy('aula_id') as $key=>$item)
                                    <td> {{ $item->where('data',$r[0]->data)->SUM('qt_aula') }}<br>

                                        <!-- calculando Valor do dia/aula-->
                                       
                                        @foreach ( $item->where('data',$r[0]->data) as  $a)
                                            @php $valor_dia += $a->qt_aula * $a->vl_aula; 
                                                 $aulas_dia += $a->qt_aula;
                                            @endphp
                                        @endforeach 
                 
                                    </td>
                                    @endforeach
                                @php $arr = array($r[0]->data => $valor_dia);
                                array_push($valores, $arr);
                                $total_valor +=$valor_dia;
                                @endphp
                                <td class="bg-warning">{{ $aulas_dia }}</td>
                                <td  class="bg-primary">{{ number_format($valor_dia,2,",",".") }}</td>
                            </tr>
                        @endforeach
                    </tbody>

                    <tfoot>

                        <tr>
                            <th  class="bg-primary"> </th>
                            <th  class="bg-primary"> TOTAIS </th>
                            @foreach ($itens->groupBy('aula_id') as $key=>$item)
                                <th  class="bg-primary">{{ $item->SUM('qt_aula') }} </th>
                            @endforeach
                    <td  class="bg-primary">{{ $itens->SUM('qt_aula') }}</td>
                    <td class="bg-primary">{{ number_format($total_valor,2,",",".") }}</td>
                </tr>

                    </tfoot>
                
                </table>
                @if($selecionado)
                @if($selecionado->whatsapp)
                <a href="https://api.whatsapp.com/send?phone={ $selecionado->whatsapp }}&amp;text=Olá {{ $selecionado->name }} a fatura da escola R4 de {{ $dt_1 }} a {{ $dt_2 }} ficou no valor {{ number_format($total_valor,2,",",".") }}" 
                class="btn btn-primary btn-block" target="_blank">
                   Enviar cobrança no whatsapp do Aluno - {{ $selecionado->whatsapp }}
                    </a>
                @endif
                @endif

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
    @isset($aluno_id)
        @if($aluno_id)
            $('#aluno_id').val({{ $aluno_id }})
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
                {extend: 'excel', title: 'Reletório {{ $aluno->name }}'},
                {extend: 'pdf', title: 'Reletório de {{ $dt_1 }} a {{ $dt_2 }}'},

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
 
</script>
@endsection