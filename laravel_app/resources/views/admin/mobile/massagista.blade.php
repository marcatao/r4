@include('admin.layout.head')


<div class="ibox">
    <div class="ibox-title">
        <h5>Filtros</h5>
        <ul class="nav navbar-top-links navbar-right">
            <li>


                <a href="{{ route('logout') }}" class="nav-link"  onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">{{ csrf_field() }}</form>
                    <i class="fa fa-sign-out"></i>
                     Sair do sistema
                </a>


            </li>
        </ul>
    </div>
    <div class="ibox-content">
 
     
        


        <div class="form-group row"><label class="col-lg-2 col-form-label">Qual numero do armario para incluir?</label>
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
            <button class="btn btn-primary" onclick="consultar_armarios_indisponiveis()" id="botao_consultar_armario"> Consultar </button>
        </div>





    </div>


     
    </div>
</div>


@include('admin.layout.rodape')
    <!-- Mainly scripts -->
    <script src="{{ asset('admin/js/jquery-3.1.1.min.js')}}"></script>
    <script src="{{ asset('admin/js/popper.min.js')}}"></script>
    <script src="{{ asset('admin/js/bootstrap.js')}}"></script>
    <script src="{{ asset('admin/js/plugins/metisMenu/jquery.metisMenu.js')}}"></script>
    <script src="{{ asset('admin/js/plugins/slimscroll/jquery.slimscroll.min.js')}}"></script>

    <!-- Custom and plugin javascript -->
    <script src="{{ asset('admin/js/inspinia.js')}}"></script>
    <script src="{{ asset('admin/js/plugins/pace/pace.min.js')}}"></script>

<script>
 
 function consultar_armarios_indisponiveis(){
  $('#modal').modal('show');
  $('#modal-corpo').html('loading...');
  $('#modal-titulo').html('Selecione o armario para incluir o item:');
  requisicao('{{ route('lista-armarios-indisponiveis') }}','GET','0')
    .then(result => {
      $('#modal-corpo').html(result);
    });
 }
 function selecionaArmarioArberto(armario_id){
    alert('Sessão registrada');
 }
</script>