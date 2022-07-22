
<hr>
<div class="row">
    <div class="col-md-12">
        <h2><b>Tem certeza que deseja incluir a(o) massagista: {{ $massagista->nome }}</b>?</h2>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
            <button class="btn btn-primary btn-block" onclick="confirmaBotaoMassagista('S')" id="confirma_botao_massagista_s">S - Sim</button>
    </div>
    <div class="col-md-6">
            <button class="btn btn-warning btn-block" onclick="confirmaBotaoMassagista('N')" id="confirma_botao_massagista_n">N - Não</button>
        </div>
    </div>
</div>


<script>
    $(document).keypress(function( event ) {
         if(event.which == 115){
             $('#confirma_botao_massagista_s').trigger('click');
         }
         if(event.which == 110){
             $('#confirma_botao_massagista_n').trigger('click');
         } 
   
    });
   
    function confirmaBotaoMassagista(action){
        if(action == 'S'){
           requisicao('{{ route('inclui-massagista-operacao-item') }}','GET',$('#id_armario').val(),'{{ $massagista->id }}')
          .then(result => {
             console.log(result);
             lista_operacoes_abertas();
          });
        }
        tab_2();
        $('#tab_2_corpo_2').html('');
    }
   
   
   </script>