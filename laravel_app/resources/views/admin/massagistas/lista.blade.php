@extends('admin.layout.principal')
@section('estilos')
    <link href="{{ asset('admin/css/plugins/dataTables/datatables.min.css') }}" rel="stylesheet">
@endsection
@section('conteudo')

<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-md-12 mb-3">
            <a href="{{ route('form-massagistas',0) }}" class="btn btn-primary btn-block">Novo massagista</a>
        </div>
    </div>
            <div class="row">
                <div class="col-lg-12">
                <div class="ibox ">
                    <div class="ibox-title">
                        <h5>Massagistas cadastrados no sistema</h5>

                    </div>
                    <div class="ibox-content">

                        <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover dataTables-example" >
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>nome</th>
                        <th>Valor</th>
                        <th>Duração(minutos)</th>
                        <th>login</th>
                        <th>Status</th>
                        <th>Cor</th>
                        <th></th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach (\App\massagistas::all() as $item)
                            <tr>
                                <td>{{ $item->id }}</td>
                                <td>{{ $item->nome }}</td>
                                <td>{{  number_format($item->valor,2,",",".")  }}</td>
                                <td>{{ $item->duracao }}</td>
                                <td>@if($item->login){{ $item->login->name }}@endif</td>
                                <td>{{ $item->status }}</td>
                                <th style="background: {{ $item->cor_agendamento }}"> </th>
                                <td> <a href="{{ route('form-massagistas', $item->id) }}" class="btn btn-primary btn-block">Editar</a> </td>
                                <td> <a href="{{ route('form-massagistas-del', $item->id) }}" class="btn btn-danger  btn-block">Excluir</a> </td>
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

@endsection

@section('scripts')

<script src="{{ asset('admin/js/plugins/dataTables/datatables.min.js')}}"></script>
<script src="{{ asset('admin/js/plugins/dataTables/dataTables.bootstrap4.min.js')}}"></script>



<script>
    $(document).ready(function(){
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

</script>
@endsection