 
<link href="{{ asset('admin/css/plugins/dataTables/datatables.min.css') }}" rel="stylesheet">
<div class="wrapper wrapper-content animated fadeInRight">
 
            <div class="row">
                <div class="col-lg-12">
                <div class="ibox ">
                    <div class="ibox-title">
                        <h5>Operações em aberto...</h5>

                    </div>
                    <div class="ibox-content">

                        <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover dataTables-example" id="table-operacoes-abertas-lista">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Armario</th>
                        <th>Valor</th>
                        <th>Entrada</th>
                        <th>Tempo Massagem:</th>
                        <th></th>
 
                    </tr>
                    </thead>
                    <tbody>
                        @foreach (\App\operacoes::where('status','0')->get() as $item)
                            <tr>
                                <td>{{ $item->id }}</td>
                                <td>{{ $item->armario->descricao }}</td>
                                <td>{{  number_format( $item->vl_total,2,",",".") }}</td>
                                <td> {{date('d/m/Y h:i', strtotime($item->entrada))}}</td>
                                <td> 
                                    @if($item->massagistas)
                                        @foreach ($item->massagistas->where('finalized_at' , null) as $item_massagem) 
                                        @php
                                            $to_time = strtotime('+'. $item_massagem->massagista->duracao.' minutes',strtotime($item_massagem->created_at));
                                            $from_time = strtotime(now());
                                       @endphp
                                            <div >{{ $item_massagem->massagista->nome }}: 
                                                <b id="time_{{ $item_massagem->id }}">...</b>min

                                                @if($to_time < $from_time)
                                                    <i class="text-danger">extrapolados</i>
                                                @endif 
                                                <button class="btn btn-warning pull-right" onclick="encerrarsessaomassagem('{{ $item_massagem->id }}')">Encerrar Sessão</button>
                                             </div>
                                        
                                    
                                        @endforeach 
                                    @endif
                                </td>
                                <td><button class="btn btn-primary" onclick="consultar_operacao_valor('{{ $item->id  }}')">Consultar</button></td>
                            </tr>
                        @endforeach
                    </tbody>

                    </table>
 
                        </div>

                    </div>
                </div>
            </div>
            </div> 
        </div>
        

<script src="{{ asset('admin/js/plugins/dataTables/datatables.min.js')}}"></script>
<script src="{{ asset('admin/js/plugins/dataTables/dataTables.bootstrap4.min.js')}}"></script>



<script>
    $(document).ready(function(){

        @foreach (\App\operacoes::where('status','0')->get() as $item)
            @if($item->massagistas)
                @foreach ($item->massagistas->where('finalized_at' , null) as $item_massagem) 
                    @php
                       $to_time = strtotime('+'. $item_massagem->massagista->duracao.' minutes',strtotime($item_massagem->created_at));
                       $from_time = strtotime(now());
                       $time =  60 * (round(abs($to_time - $from_time) / 60,2));
                    @endphp

                    display = document.querySelector("#time_{{ $item_massagem->id }}");

                    @if($to_time < $from_time)
                        startTimer_up({{ $time }},display );
                    @else
                         startTimer({{ $time }},display );
                    @endif 
                    
                    console.log('{{ $to_time }}->{{ $from_time }} = {{ $time }}');
                   @endforeach 
            @endif
        @endforeach

        $('#table-operacoes-abertas-lista').DataTable({
            pageLength: 25,
            responsive: true
        });

    });
    function encerrarsessaomassagem(id_item){
        requisicao('{{ route('encerra-sessao-massagem') }}','GET',id_item)
          .then(result => {
            lista_operacoes_abertas();
         });
    }
    function consultar_operacao_valor(id_operacao){
        $('#modal').modal('show');
         $('#modal-corpo').html('loading...');
         $('#modal-titulo').html('');
         requisicao('{{ route('consultar_operacao_valor') }}','GET',id_operacao)
          .then(result => {
           $('#modal-corpo').html(result);
         });
 }
 

 function startTimer(duration, display) {
    var timer = duration, minutes, seconds;
    setInterval(function () {
        minutes = parseInt(timer / 60, 10);
        seconds = parseInt(timer % 60, 10);
        minutes = minutes < 10 ? "0" + minutes : minutes;
        seconds = seconds < 10 ? "0" + seconds : seconds;
        display.textContent = minutes + ":" + seconds;
        if (--timer < 0) {
            timer = duration;
        }
    }, 1000);
}
function startTimer_up(duration, display) {
    var timer = duration, minutes, seconds;
    setInterval(function () {
        minutes = parseInt(timer / 60, 10);
        seconds = parseInt(timer % 60, 10);
        minutes = minutes < 10 ? "0" + minutes : minutes;
        seconds = seconds < 10 ? "0" + seconds : seconds;
        display.textContent = minutes + ":" + seconds;
        if (++timer < 0) {
            timer = duration;
        }
    }, 1000);
}
</script>
