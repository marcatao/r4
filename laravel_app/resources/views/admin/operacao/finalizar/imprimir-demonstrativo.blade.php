@extends('admin.layout.principal')
@section('conteudo')


<div class="row">
    <div class="col-lg-12">
            <div class="ibox-content p-xl">
                    <div class="row">
                        <div class="col-sm-6">
                            </div>

                        <div class="col-sm-6 text-right">
                            <h4>Operação No.</h4>
                            <h4 class="text-navy">{{ $operacao->id }}</h4>
                            <span></span>
                            <span></span>

                            <p>
                                <span><strong>Entrada: </strong>@if($operacao->entrada){{date('d/m/Y h:i', strtotime($operacao->entrada))}}@endif</span><br/>
                                <span><strong>Saida: </strong>@if($operacao->saida){{date('d/m/Y h:i', strtotime($operacao->saida))}}@endif</span>
                            </p>
                        </div>
                    </div>

                    <div class="table-responsive m-t">
                        <table class="table invoice-table">
                            <thead>
                            <tr>
                                <th>Item</th>
                                <th>Quantidade</th>
                                <th>Valor</th>
                                <th>Total</th>
                            </tr>
                            </thead>
                            <tbody>
                            @php
                                $itens = \App\item::where('id_operacao',$operacao->id)->get();    
                            @endphp    
                            @foreach ($itens as $item)
                            <tr>
                                <td><div><strong>{{ $item->descricao }}</strong></div>
                                    <small></small></td>
                                <td>{{ $item->qtd }}</td>
                                <td>{{ number_format($item->vl_movimento,2,",",".")  }}</td>
                                <td>{{ number_format($item->qtd * $item->vl_movimento,2,",",".")  }}</td>
                            </tr>
                            @endforeach
                           </tbody>
                        </table>
                    </div><!-- /table-responsive -->

                    <table class="table invoice-total">
                        <tbody>
                        <tr>
                            <td><strong>Sub Total :</strong></td>
                            <td>{{   number_format($operacao->vl_total,2,",",".")  }}</td>
                        </tr>

                        <tr>
                            <td><strong>TOTAL :</strong></td>
                            <td>{{   number_format($operacao->vl_total,2,",",".")  }}</td>
                        </tr>
                        </tbody>
                    </table>


                </div>
        </div>
    </div>


@endsection

@section('scripts')
<script type="text/javascript">
    window.onafterprint = window.close;
    window.print();
</script>
@endsection