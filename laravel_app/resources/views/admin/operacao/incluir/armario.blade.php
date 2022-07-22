


                                <div class="form-group row"><label class="col-md-2 col-form-label">Numero do armario para incluir?</label>
                                    <div class="col-md-3">
                                        <input 
                                         type="text" 
                                         name="id_armario" 
                                         id="id_armario" 
                                         class="form-control" required> 
                                    </div>
                                    <div class="col-md-5">
                                        <input 
                                         type="text" 
                                         name="desc_armario" 
                                         id="desc_armario" 
                                         class="form-control" readonly> 
                                    </div>
                                    <div class="col-md-2">
                                      <button class="btn btn-primary" onclick="consultar_armarios_indisponiveis()" id="botao_consultar_armario"> Consultar </button>
                                    </div>
                                </div>

<script>
 $(function () { 
     console.log('Chamou incluir despesa');
    $('#id_armario').focus();
 });

 function consultar_armarios_indisponiveis(){
  $('#modal').modal('show');
  $('#modal-corpo').html('loading...');
  $('#modal-titulo').html('Selecione o armario para incluir o item:');
  requisicao('{{ route('lista-armarios-indisponiveis') }}','GET','0')
    .then(result => {
      $('#modal-corpo').html(result);
    });
 }

 $('#id_armario').keypress(function( event ) {
  console.log('keypres armario');
  if($("#id_armario").is(":focus")){
      if(event.which == 13){
        selecionaArmarioArberto();
    }
  }
  });

function selecionaArmarioArberto(){
    console.log('seleciona armario aberto');
    requisicao('{{ route('armario-model-aberto') }}','GET', $('#id_armario').val())
    .then(result => {
      console.log(result);
      var obj = JSON.parse(result);  
      if(obj.status == "Aberto"){
        $('#botao_consultar_armario').prop( "disabled", true );
        $('#id_armario').prop( "disabled", true );
          $('#desc_armario').val(obj.descricao);
          confirma_abrir_armario_aberto(obj.id);

      }else{
        $('#desc_armario').val('Armario não esta aberto');
      }
     
    });
 }

 function confirma_abrir_armario_aberto(id_armario){
    console.log('abrir-armario-aberto');
    requisicao('{{ route('abrir-armario-aberto') }}','GET',id_armario)
    .then(result => {
      $('#tab_2_corpo_2').html(result);
    });
 }

 

 
</script>