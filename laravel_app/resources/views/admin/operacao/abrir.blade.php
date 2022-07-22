


                                <div class="form-group row">
                                  <label class="col-md-2 col-form-label">Numero do armario?</label>
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
                                    <button class="btn btn-primary" onclick="consultar_armarios_disponiveis()"> Consultar </button>
                                    </div>
                                </div>

<script>
  $('#id_armario').keypress(function( event ) {
    console.log('keypress abrir');
    if($("#id_armario").is(":focus")){
      if(event.which == 13){
      selecionaArmario();
      }
    }
  });


 $(function () { 
    $('#id_armario').focus();
 });

 function consultar_armarios_disponiveis(){
  $('#modal').modal('show');
  $('#modal-corpo').html('loading...');
  $('#modal-titulo').html('Selecione o armario para abrir:');
  requisicao('{{ route('lista-armarios-disponiveis') }}','GET','0')
    .then(result => {
      $('#modal-corpo').html(result);
    });
 }

 function selecionaArmario(){
     console.log('selecionar armario');
     requisicao('{{ route('armario-model') }}','GET', $('#id_armario').val())
    .then(result => {
      console.log(result);
      var obj = JSON.parse(result);  
      if(obj.status == "Disponivel"){
        $('#id_armario').prop( "disabled", true );
          $('#desc_armario').val(obj.descricao);
          confirma_abrir_armario(obj.id);

      }else{
        $('#desc_armario').val('Armario não disponivel');
      }
     
    });
 }

 function confirma_abrir_armario(id_armario){
    console.log('confirma_abrir_armario');
    requisicao('{{ route('confirma-abrir-armario') }}','GET',id_armario)
    .then(result => {
      $('#tab_1_corpo_2').html(result);
    });
 }
</script>