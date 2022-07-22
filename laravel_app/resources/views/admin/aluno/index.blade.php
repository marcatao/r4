@extends('admin.layout.principal_aluno')
@section('estilos')
    <link href="{{ asset('admin/css/plugins/dataTables/datatables.min.css') }}" rel="stylesheet">
@endsection
@section('conteudo')

<div class="wrapper wrapper-content animated fadeInRight">

            <div class="row">
                <div class="col-lg-12">
                <div class="ibox ">
                    <div class="ibox-title">
                        <h5>Minhas Aulas</h5>

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
 
        
                    </div>


                    <div class="ibox-content">

                        <div class="table-responsive">
                         
                    <table class="table table-striped table-bordered table-hover dataTables-example" >
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>data</th>
                        <th>Nome da Aula</th>
                        <th>Quantidade</th>
                        <th>Valor Aula</th>
                        <th>Professor</th>
                    </tr>
                    </thead>
                    <tbody>

                        @php
                        $total_aulas = 0;
                        $total_valor = 0;
                    @endphp

                        @foreach ($aulas as $item)

                        
                    @php
                    $total_aulas +=$item->qt_aula ;
                    $total_valor += $item->qt_aula * $item->vl_aula;
                     @endphp
                            <tr>
                                <td>{{ $item->id }}</td>
                                <td>{{date('d/m/Y', strtotime($item->data))}}</td>
                                <td>{{ $item->aula->descricao }}</td>
                                <td>{{ $item->qt_aula }}</td>
                                <td>@if(is_numeric($item->vl_aula)) {{ number_format($item->vl_aula,2,",",".")  }} @endif</td>
                                <td>{{ $item->professor->name }}</td>
                            </tr>
                        @endforeach
                    </tbody>

                    <tfoot>
                        <tr class="bg-success">
                            <th></th>
                            <th></th>
                            <th> Totais</th>
    
                            <th>{{ $total_aulas }}</th>
                            <th>{{  number_format($total_valor ,2,",",".")}}</th>
                            <th></th>
                        </tr>
                    </tfoot>
                    </table>
                        </div>

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
    $(document).ready(function(){

        @if($param1)
            $('#periodo').val('{{ $param1 }}');
            console.log('{{ $param1 }}');
        @endif


        $('.dataTables-example').DataTable({
            pageLength: 25,
            responsive: true,
            dom: '<"html5buttons"B>lTfgitp',
            buttons: [
                { extend: 'copy'},
                {extend: 'csv'},
                {extend: 'excel', title: 'ExampleFile'},
                {extend: 'pdf', title: 'ExampleFile'},

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


    function carrega_provisionamentos(data){
        window.location.href ='{{ route('admin_index_aluno') }}'+'?param1='+data;
    }
</script>
@endsection