@extends('admin.layout.principal_professor')
@section('estilos')
<link href="{{ asset('admin/css/plugins/dataTables/datatables.min.css') }}" rel="stylesheet">

@endsection
@section('conteudo')



<div class="row">
    <div class="col-md-3" id="admin_provisionamento_form">
 
    </div>
    <div class="col-md-9">
        <div class="ibox ">
            <div class="ibox-title">
                <h5> Provisionamentos Para professor</h5>
             </div>
                

            
            
            <div class="ibox-content"> 
                @php
                use Carbon\Carbon;
                    $datas= \App\provisionamentos::where(\DB::raw("strftime('%m-%Y', data)"), "<>", date('m-Y'))->orderBy('data','desc')->get()->groupBy(function($val) {
                     return Carbon::parse($val->data)->format('m-Y');
                  });

                    $meses = array('01' => "Janeiro",'02' => "Fevereiro",'03' => "Março", '04' => "Abril", '05' => "Maio",'06' => "Junho", '07' => "Julho",'08' => "Agosto",'09' => "Setembro",'10' => "Outubro",'11' => "Novembro",'12' => "Dezembro");
                @endphp
                <label for="periodo">Periodo selecionado:</label>
                <select name="periodo" id="periodo" class="form-control mb-5" onchange="carrega_provisionamentos(this.value)">
                    <option value="{{ date('m-Y') }}">{{ $meses[substr(date('m-Y'),0,strpos(date('m-Y'),'-'))] }} de {{ substr(date('m-Y'),strpos(date('m-Y'),'-')+1,4) }}</option>
                    @foreach ($datas as $key => $dt)
                       <option value="{{ $key }}">{{ $meses[substr($key,0,strpos($key,'-'))] }} de {{ substr($key,strpos($key,'-')+1,4) }}</option>
                  @endforeach  
                </select>
                <div id="lista_provisionamentos">Carregando...</div>

            </div>
            </div>
        </div>


    </div>
</div>



@endsection

@section('scripts')

<script src="{{ asset('admin/js/plugins/dataTables/datatables.min.js')}}"></script>
<script src="{{ asset('admin/js/plugins/dataTables/dataTables.bootstrap4.min.js')}}"></script>


<script>
    $(function () { 
        carrega_formulario();
        @isset($messagem)
        @if($messagem)
             alert({{ $messagem }});
        @endif
        @endisset
        carrega_provisionamentos();
    
    });
    function carrega_formulario(){
        $("#admin_provisionamento_form").html('Carregando....');
        requisicao('{{ route('admin_provisionamento_form') }}','get','')
         .then(result => {
            $("#admin_provisionamento_form").html(result);
        })       
    }
    function carrega_provisionamentos(){
        $("#lista_provisionamentos").html('Carregando....');
        requisicao('{{ route('provisionamento_lista') }}','get',$('#periodo').val(),'professor')
         .then(result => {
            $("#lista_provisionamentos").html(result);
        })
    .catch(error => {
        console.log(error)
      
        alert(error.status+'-'+erro,'error');
    });
}
</script>
@endsection    