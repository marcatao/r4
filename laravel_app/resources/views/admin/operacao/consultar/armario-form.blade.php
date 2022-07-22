


                                <div class="form-group row"><label class="col-lg-2 col-form-label">Qual numero do armario para consultar?</label>
                                    <div class="col-md-1">
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
                                    <button class="btn btn-primary" onclick="consultar_armarios_todos()" id="botao_consultar_armario"> Consultar </button>
                                </div>

<script>
 $(function () { 
     console.log('Chamou incluir despesa');
    $('#id_armario').focus();
 });

 function consultar_armarios_todos(){
  $('#modal').modal('show');
  $('#modal-corpo').html('loading...');
  $('#modal-titulo').html('Selecione o armario para incluir o item:');
  requisicao('{{ route('lista-armarios-todos') }}','GET','0')
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
      if(obj.status == 'Aberto' || obj.status == 'Disponivel'){
        $('#botao_consultar_armario').prop( "disabled", true );
        $('#id_armario').prop( "disabled", true );
          $('#desc_armario').val(obj.descricao);
          carrega_consulta_armario(obj.id);

      }else{
        $('#desc_armario').val('Não existe Operacao para esse armario');
      }
     
    });
 }

 function carrega_consulta_armario(id_armario){
    console.log('consulta-armario-aberto');
    requisicao('{{ route('consulta-armario-aberto') }}','GET',id_armario)
    .then(result => {
      $('#tab_3_corpo_2').html(result);
    });
 }

 

 
</script>