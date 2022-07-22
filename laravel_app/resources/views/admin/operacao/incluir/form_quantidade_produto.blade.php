 
<div class="form-group row"><label class="col-md-2 col-form-label"> Confirmação: </label>
    <div class="col-md-3">
        Quantidades:
        <input 
         type="number" 
         name="input_qtd" 
         id="input_qtd"
         value=1 
         min="0" max="100"
         class="form-control" required> 
    </div>
    <div class="col-md-3">
        Valor:
        <input 
         type="text" 
         name="input_vl_movimento" 
         id="input_vl_movimento"
         value="{{  number_format($produto->valor,2,",",".") }}"
         class="form-control"> 
    </div>
    <div class="col-md-3">
        &nbsp;
       <button class="btn btn-primary btn-block" onclick="adicionar_item_confirmado()">S - Confirmar</button>
    </div>
    <div class="col-md-1">
        &nbsp;
        <button class="btn btn-warning  btn-block" onclick="cancelar_inclusao_de_produto()">X</button>
    </div>
    
</div>

<script>
function cancelar_inclusao_de_produto(){
    tab_2();
}
function adicionar_item_confirmado(){
    requisicao('{{ route('form-adiciona-produto') }}','GET', '{{ $produto->id }}', $('#id_armario').val(), $('#input_qtd').val(), $('#input_vl_movimento').val() )
    .then(result => {
      console.log(result);
      if(result =='ok'){
        selecionaArmarioArberto();
        lista_operacoes_abertas();
      }

    });
}
</script>