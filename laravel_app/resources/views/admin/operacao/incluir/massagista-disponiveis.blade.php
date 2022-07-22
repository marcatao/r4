<div class="table-responsive">
    <table class="table table-striped table-bordered table-hover dataTables-example" id="massagista-disponivel-table">
    <thead>
    <tr>
        <th>#</th>
        <th>Nome</th>
        <th>Valor</th>
 
 
    </tr>
    </thead>
    <tbody>
        @foreach (\App\massagistas::all() as $item)
            <tr class="mao" onclick="selecionarMassagistaUnico('{{ $item->id }}')">
                <td>{{ $item->id }}</td>
                <td>{{ $item->nome }}</td>
                <td>{{  number_format( $item->valor,2,",",".") }}</td>
 
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
        $('#massagista-disponivel-table').DataTable({
            responsive: true
        });
    });

function selecionarMassagistaUnico(id){
    $('#id_massagista').val(id);
    $('#modal').modal('hide');
    selecionaMassagista(id);
}
</script>