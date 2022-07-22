@extends('admin.layout.principal')
@section('conteudo')



<div class="wrapper wrapper-content animated fadeIn">

            <div class="row">
                <div class="col-md-12">
                    <div class="tabs-container">
                        <ul class="nav nav-tabs" role="tablist" id="myTab">
                            <li><a class="nav-link active" data-toggle="tab" href="#tab-1" onclick="tab_1()"> 1 - Abrir</a></li>
                            <li><a class="nav-link" data-toggle="tab" href="#tab-2" onclick="tab_2()">2 - Incluir despesa</a></li>
                            <li><a class="nav-link" data-toggle="tab" href="#tab-3" onclick="tab_3()">3 - Consultar / Encerrar / Reabrir</a></li>
                            <!--<li><a class="nav-link" data-toggle="tab" href="#tab-4">4 - Reabrir</a></li>
                            <li><a class="nav-link" data-toggle="tab" href="#tab-5">5 - Fechar</a></li>-->
                        </ul>
                        <div class="tab-content">
                            <div role="tabpanel" id="tab-1" class="tab-pane active">
                                <div class="panel-body"><div id="tab_1_corpo"></div><div id="tab_1_corpo_2"></div></div>
                            </div>
                            <div role="tabpanel" id="tab-2" class="tab-pane">
                                <div class="panel-body">
                                  <div id="tab_2_corpo"></div>
                                  <div id="tab_2_corpo_2"></div>
                                </div>
                            </div>
                            <div role="tabpanel" id="tab-3" class="tab-pane">
                              <div class="panel-body">
                                <div id="tab_3_corpo"></div>
                                  <div id="tab_3_corpo_2"></div>
                             </div>
                          </div>
                          <div role="tabpanel" id="tab-4" class="tab-pane">
                            <div class="panel-body">
                              <p>4</p>
                           </div>
                        </div>
                        <div role="tabpanel" id="tab-5" class="tab-pane">
                          <div class="panel-body">
                            <p>5</p>
                         </div>
                      </div>
                        </div>


                    </div>
                </div>
              
            </div>

            






        </div>



        <div class="wrapper wrapper-content animated fadeIn">
          <div class="row">
            <div class="col-md-12">
              <div id="lista_operacoes_abertas_div"></div>
            </div>
          </div>

        </div>

</div>
@endsection

@section('scripts')
<script>

$(function () { 
  tab_1();
  lista_operacoes_abertas();
 });


 $(document).keypress(function( event ) {

  if(!$("#id_armario").is(":focus")){
    if(!$("#id_produto").is(":focus")){ 
      if(!$("#input_qtd").is(":focus")){ 
        if(!$("#input_vl_movimento").is(":focus")){ 
          if(!$("#id_massagista").is(":focus")){ 
      if(event.which == 49){
        tab_1();
       }else if(event.which == 50){
        $('#myTab a[href="#tab-2"]').tab('show');
        tab_2();
      }else if(event.which == 51){
        $('#myTab a[href="#tab-3"]').tab('show');
        tab_3();
      }else if(event.which == 52){
       $('#myTab a[href="#tab-4"]').tab('show');
       
     }else if(event.which == 53){
        $('#myTab a[href="#tab-5"]').tab('show');
       
    }
   console.log('com focus');
  }}}}}
  });

function tab_1(){
  limpa_tabs();
  $('#tab_1_corpo').html('Carregando...');
  $('#myTab a[href="#tab-1"]').tab('show');
    requisicao('{{ route('operacao-form-1') }}','GET','0')
    .then(result => {
      $('#tab_1_corpo').html(result);
    });
}
function lista_operacoes_abertas(){
  requisicao('{{ route('lista_operacoes_abertas') }}','GET','0')
    .then(result => {
      $('#lista_operacoes_abertas_div').html(result);
    });
}

function tab_2(carrega_armario=null){
  limpa_tabs();
  console.log('chamou tab 2');
  $('#tab_2_corpo').html('Carregando...');
  $('#myTab a[href="#tab-2"]').tab('show');
    requisicao('{{ route('operacao-form-2') }}','GET','0')
    .then(result => {
      $('#tab_2_corpo').html(result);
       if(carrega_armario){
        console.log('Carrega armario block');
        $('#id_armario').val(carrega_armario);
        selecionaArmarioArberto();
       }
    });
}

function tab_3(){
  limpa_tabs();
  $('#tab_3_corpo').html('Carregando...');
  $('#myTab a[href="#tab-2"]').tab('show');
    requisicao('{{ route('operacao-form-3') }}','GET','0')
    .then(result => {
      $('#tab_3_corpo').html(result);
    })
}

function EncerrarOperacaoAberta(id_operacao){
  $('#modal').modal('show');
         $('#modal-corpo').html('loading...');
         $('#modal-titulo').html('');
         requisicao('{{ route('encerra-operacao') }}','GET',id_operacao)
          .then(result => {
           $('#modal-corpo').html(result);
           tab_3();
           lista_operacoes_abertas();
         });
}
function ReabreOperacaoAberta(id_operacao){
  $('#modal').modal('show');
         $('#modal-corpo').html('loading...');
         $('#modal-titulo').html('');
         requisicao('{{ route('reabre-operacao') }}','GET',id_operacao)
          .then(result => {
           $('#modal-corpo').html(result);
           tab_3();
           lista_operacoes_abertas();
         });
}



function limpa_tabs(){
  $('#tab_1_corpo').html('');
  $('#tab_1_corpo_2').html('');
  $('#tab_2_corpo').html('');
  $('#tab_2_corpo_2').html('');
  $('#tab_3_corpo').html('');
  $('#tab_3_corpo_2').html('');
}
</script>
@endsection