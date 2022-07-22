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
                                        <span><strong>Saida: </strong>@if($operacao->saida){{date('d/m/Y h:i', strtotime($operacao->entrada))}}@endif</span>
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
                                        @if($operacao->status ==0)
                                            <th></th>
                                        @endif
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($itens as $item)
                                    <tr>
                                        <td><div><strong>{{ $item->descricao }}</strong></div>
                                            <small></small></td>
                                        <td>{{ $item->qtd }}</td>
                                        <td>{{ number_format($item->vl_movimento,2,",",".")  }}</td>
                                        <td>{{ number_format($item->qtd * $item->vl_movimento,2,",",".")  }}</td>
                                        @if($operacao->status ==0)
                                        <th> 
                                            @if($item->massagista_id || $item->produto_id)
                                            <button class="btn btn-danger pull-right" onclick="deletaitemoperacao('{{ $item->id }}','{{ $operacao->id }}')"> X </button> 
                                            @endif
                                        </th>
                                    @endif
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
                           @if($operacao->status == 0)
                               <button class="btn btn-danger btn-block" onclick="EncerrarOperacaoAberta('{{ $operacao->id }}')">Encerrar Operação</button>
                           @else
                               <button class="btn btn-defalut btn-block"onclick="ReabreOperacaoAberta('{{ $operacao->id }}')">Reabrir Operação</button>
                           @endif


                        </div>
                </div>
            </div>

<script>

function deletaitemoperacao(id_item, id_operacao){
    console.log('Excluir item id: '+ id_item)
    requisicao('{{ route('excluir_produto_operacao') }}','GET',id_item)
    .then(result => {
      consultar_operacao_valor(id_operacao);
      lista_operacoes_abertas();
    });
}
</script>