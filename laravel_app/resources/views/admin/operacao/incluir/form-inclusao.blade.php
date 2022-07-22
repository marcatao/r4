 
            <div class="row">
                <div class="col-md-12">
                    <div class="tabs-container">
                        <ul class="nav nav-tabs" role="tablist" id="myTab_produtos_massagens">
                            <li><a class="nav-link active" data-toggle="tab" href="#tab-produtos">P - Produtos</a></li>
                            <li><a class="nav-link" data-toggle="tab" href="#tab-massagistas">M - Massagistas</a></li>
                        </ul>
                        <div class="tab-content">
                            <div role="tabpanel" id="tab-produtos" class="tab-pane active">
                                <div class="panel-body">

                                    <div class="form-group row"><label class="col-md-2 col-form-label">Qual <b>Produto</b> deseja incluir?</label>
                                        <div class="col-md-2">
                                            <input 
                                             type="text" 
                                             name="id_produto" 
                                             id="id_produto" 
                                             class="form-control" required> 
                                        </div>
                                        <div class="col-md-5">
                                            <input 
                                             type="text" 
                                             name="desc_produto" 
                                             id="desc_produto" 
                                             class="form-control" readonly> 
                                        </div>
                                        <div class="col-md-3">
                                            <button class="btn btn-primary" onclick="consultar_produtos_disponiveis()" id="botao_consulta_produto"> Consultar</button>
                               
                                        <button class="btn btn-warning" onclick="cancela_inclusao_no_armario()">X</button>
                                        </div>
                                        
                                    </div>
                                    <div id="tab_2_corpo_3"></div>
                                </div>
                            </div>
                            <div role="tabpanel" id="tab-massagistas" class="tab-pane">
                                <div class="panel-body">
                                    <div class="form-group row"><label class="col-md-2 col-form-label"><b>Massagista</b> deseja incluir?</label>
                                        <div class="col-md-2">
                                            <input 
                                             type="text" 
                                             name="id_massagista" 
                                             id="id_massagista" 
                                             class="form-control" required> 
                                        </div>
                                        <div class="col-md-5">
                                            <input 
                                             type="text" 
                                             name="desc_masssagista" 
                                             id="desc_masssagista" 
                                             class="form-control" readonly> 
                                        </div>
                                        <div class="col-md-3">
                                        <button class="btn btn-primary" onclick="consultar_massagista_disponiveis()" id="botao_consulta_massagista">Consultar</button>
                                        <button class="btn btn-warning" onclick="cancela_inclusao_no_armario()">X</button>
                                        </div>
                                    </div>
                                    <div id="tab_2_corpo_4"></div>
                                </div>
                            </div>
                        </div>


                    </div>
                </div>
                
            </div>


<script>
 $(function () { 
     console.log('Chamou incluir despesa');
    $('#id_produto').focus();
 });

 $(document).keypress(function( event ) {
    console.log('teclaPress: ' + event.which);
    if($("#id_produto").is(":focus")){
        if(event.which == 13){
            console.log('carregaproduto');
            selecionaProduto($("#id_produto").val());
        }
        return;
    }
    if($("#id_massagista").is(":focus")){
        if(event.which == 13){
            console.log('Chamou carregar massagista');
            selecionaMassagista($("#id_massagista").val());
        }
        return;
    }
    if(event.which == 112 || event.which==80){
         $('#myTab_produtos_massagens a[href="#tab-produtos"]').tab('show');
         $('#id_produto').focus();

         return;
    }
    if(event.which == 109 || event.which==77){
         $('#myTab_produtos_massagens a[href="#tab-massagistas"]').tab('show');

         return;
    }
});

function consultar_produtos_disponiveis(){
    $('#modal').modal('show');
    $('#modal-corpo').html('loading...');
    $('#modal-titulo').html('Selecione o produto para incluir:');
    requisicao('{{ route('lista-produtos-disponiveis') }}','GET','0')
    .then(result => {
      $('#modal-corpo').html(result);
    });
}

function selecionaProduto(id_produto){
    console.log('produto selecionado: ' + id_produto);
    requisicao('{{ route('produto-model') }}','GET', id_produto)
    .then(result => {
      console.log(result);
      var obj = JSON.parse(result); 
        console.log('obj lenth: '+ Object.keys(obj).length);
      if(Object.keys(obj).length > 2){
          let desc_produto = obj.nome;
          $('#botao_consulta_produto').prop( "disabled", true );
          $('#id_produto').prop( "disabled", true );
          $('#desc_produto').val(desc_produto);
          qual_quantidade_do_produto(obj.id);

      }else{
        $('#desc_produto').val('Produto não disponivel');
      }
     
    });
}

function qual_quantidade_do_produto(id_produto){
    console.log('Quantidade para o produto: ' +id_produto)
    requisicao('{{ route('form-quantidade-produto') }}','GET', id_produto)
    .then(result => {
      $('#tab_2_corpo_3').html(result);
    });
}

function cancela_inclusao_no_armario(){
    tab_2();
}




function consultar_massagista_disponiveis(){
    $('#modal').modal('show');
    $('#modal-corpo').html('loading...');
    $('#modal-titulo').html('Selecione o Massagista para incluir:');
    requisicao('{{ route('lista-massagista-disponiveis') }}','GET','0')
    .then(result => {
      $('#modal-corpo').html(result);
    });
}

function selecionaMassagista(id_massagista){
    console.log('Massagista selecionado: ' + id_massagista);
    requisicao('{{ route('massagista-model') }}','GET', id_massagista)
    .then(result => {
      console.log(result);
      var obj = JSON.parse(result);  
      if(obj.status =='Disponivel'){
          console.log('OBJ: ' + obj);
          $('#botao_consulta_massagista').prop( "disabled", true );
          $('#id_massagista').prop( "disabled", true );
          $('#desc_masssagista').val(obj.nome);
          certeza_incluir_massagista(obj.id);

      }else{
        $('#desc_massagista').val('Massagista não disponivel');
      }
     
    });
}

function certeza_incluir_massagista(id_massagista){
    console.log('Certeza incluir massagista?');
    requisicao('{{ route('form-adiciona-massagista') }}','GET',id_massagista)
    .then(result => {
      $('#tab_2_corpo_4').html(result);
    });
}
</script>