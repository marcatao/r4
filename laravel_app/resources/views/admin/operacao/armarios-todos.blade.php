<div class="table-responsive">
    <table class="table table-striped table-bordered table-hover dataTables-example" id="armarios-disponivel-table">
    <thead>
    <tr>
        <th>#</th>
        <th>Nome</th>
        <th>Valor</th>
        <th>Status</th>
 
    </tr>
    </thead>
    <tbody>
        @foreach (\App\armarios::all() as $item)
            <tr class="mao" onclick="selecionaArmarioUnico('{{ $item->id }}')">
                <td>{{ $item->id }}</td>
                <td>{{ $item->descricao }}</td>
                <td>{{  number_format($item->valor,2,",",".")  }}</td>
                <td>{{ $item->status }}</td>
            </tr>
        @endforeach
    </tbody>

    </table>
</div>

<link href="{{ asset('admin/css/plugins/dataTables/datatables.min.css') }}" rel="stylesheet">
<script src="{{ asset('admin/js/plugins/dataTables/datatables.min.js')}}"></script>
<script src="{{ asset('admin/js/plugins/dataTables/dataTables.bootstrap4.min.js')}}"></script>



<script>

    $(document).ready(function(){
        
        $('#armarios-disponivel-table').DataTable({
            responsive: true
        });
    });

function selecionaArmarioUnico(id){
    $('#id_armario').val(id);
    $('#modal').modal('hide');
    selecionaArmarioArberto(id);
}
</script>