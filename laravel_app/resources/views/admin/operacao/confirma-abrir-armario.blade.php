<hr>
<div class="row">
    <div class="col-md-12 text-center">
        <h2><b>Tem certeza que deseja abrir o {{ $armario->descricao }}? </b></h2>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <button class="btn btn-primary btn-block" onclick="confirmaBotao('S')" id="confirma_botao_s">S - Sim</button>
    </div>
    <div class="col-md-6">
        <button class="btn btn-warning btn-block" onclick="confirmaBotao('N')" id="confirma_botao_n">N - Não</button>
    </div>
</div>



<script>
 $(document).keypress(function( event ) {
      if(event.which == 115){
          $('#confirma_botao_s').trigger('click');
      }
      if(event.which == 110){
          $('#confirma_botao_n').trigger('click');
      } 

 });

 function confirmaBotao(action){
     if(action == 'S'){
        requisicao('{{ route('abrir-armario') }}','GET','{{ $armario->id }}')
       .then(result => {
          console.log(result);
          lista_operacoes_abertas();
       });
     }
     tab_2('{{ $armario->id }}');
     $('#tab_1_corpo_2').html('');
 }


</script>