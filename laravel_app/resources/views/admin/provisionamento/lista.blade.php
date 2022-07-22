  <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover dataTables-example">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Data <br> da aula</th>
                        <th>Aluno(s)<br> da classe</th>
                        <th>Tipo <br> da Aula</th>
                        <th>Professor<br> da Classe</th>
                        <th>Qtds<br>hora aula</th>
                        <th>Valor <br>por Aula</th>
                        <th></th>
                        <th></th>
                        <th>Responsavel</th>
                    </tr>
                    </thead>
                    <tbody>
                        @php
                            $total_aulas = 0;
                            $total_valor = 0;
                        @endphp
                        @foreach ($provisionamentos as $pv)

                        @php
                            $total_aulas +=$pv->qt_aula ;
                            $total_valor += $pv->qt_aula * $pv->vl_aula;
                        @endphp
                            <tr>
                                <td>{{ $pv->id }}</td>
                                <td>{{date('d/m/Y', strtotime($pv->data))}}</td>
                                <td>
                                    @foreach ($pv->alunos as $aluno)
                                        <li>{{ $aluno->aluno->name }}</li>
                                    @endforeach
                                </td>
                                <td>{{ $pv->aula->descricao }}</td>
                                <td>{{ $pv->professor->name }}</td>
                                <td>{{ $pv->qt_aula }}</td>
                                <td>{{ number_format($pv->vl_aula,2,",",".")  }}</td>
                                <td> <button  onclick="edit_provisionamento('{{ $pv->id }}')" class="btn btn-primary btn-block">Editar</button> </td>
                                <td> <button  onclick="delete_provisionamento('{{ $pv->id }}')" class="btn btn-danger btn-block">Delete</button> </td>
                                <td>{{ $pv->responsavel->name }}</td>
                            </tr>
                        @endforeach
                    </tbody>

                    <tfoot>
                        <tr class="bg-success">
                            <th></th>
                            <th> Totais</th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th>{{ $total_aulas }}</th>
                            <th>{{  number_format($total_valor ,2,",",".")}}</th>
                            <th></th>
                            <th></th>
                            <th></th>
                        </tr>
                    </tfoot>

                    </table>
    </div>

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

