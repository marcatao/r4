@extends('admin.layout.principal')
@section('estilos')
    <link href="{{ asset('admin/css/plugins/dataTables/datatables.min.css') }}" rel="stylesheet">
@endsection
@section('conteudo')

<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-md-12 mb-3">
            <a href="{{ route('form-produtos',0) }}" class="btn btn-primary btn-block">Novo produto</a>
        </div>
    </div>
            <div class="row">
                <div class="col-lg-12">
                <div class="ibox ">
                    <div class="ibox-title">
                        <h5>Produtos cadastrados no sistema</h5>

                    </div>
                    <div class="ibox-content">

                        <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover dataTables-example" >
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Nome</th>
                        <th>Valor</th>
                        <th>Status</th>
                        <th></th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach (\App\produtos::all() as $item)
                            <tr>
                                <td>{{ $item->id }}</td>
                                <td>{{ $item->nome }}</td>
                                <td>{{ number_format($item->valor,2,",",".")  }}</td>
                                <td>{{ $item->status }}</td>
                                <td> <a href="{{ route('form-produtos', $item->id) }}" class="btn btn-primary btn-block">Editar</a> </td>
                                <td> <a href="{{ route('form-produtos-del', $item->id) }}" class="btn btn-danger  btn-block">Excluir</a> </td>
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