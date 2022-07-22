<div id="form-agendamento-1">
<form action="{{ route('form-massagistas',$agendamento->id) }}" method="POST">
{{  csrf_field() }}

<div class="form-group row">
    <label class="col-md-12 col-form-label">Massagista:</label>
    <div class="col-md-12">
        <select name="id_massagista" id="id_massagista" class="form-control" required>
            <option value=""></option>
        @foreach (\App\massagistas::all() as $item)
            <option value="{{ $item->id }}">{{ $item->nome }}</option>
        @endforeach
    </select>
    </div>
</div>     

<div class="form-group row">
    <label class="col-md-12 col-form-label">Dia:</label>
    <div class="col-md-12">
        <input type="date" name="agendamento_dia" id="agendamento_dia" class="form-control" 
            @if($agendamento)
            value="{{date('Y-m-d', strtotime($agendamento->agendamento))}}"
            @endif
        required>
    </div>
</div>    
<div class="form-group row">
    <label class="col-md-12 col-form-label">Hora:</label>
    <div class="col-md-12">
        <input type="time" name="agendamento_hora" id="agendamento_hora" class="form-control" 
        @if($agendamento)
        value="{{date('H:i', strtotime($agendamento->agendamento))}}"
        @endif
        required>
    </div>
</div>    

<div class="form-group row">
    <label class="col-md-12 col-form-label">Nome Cliente:</label>
    <div class="col-md-12">
        <input type="text" name="cliente" id="cliente" class="form-control" 
        @if($agendamento)
        value="{{$agendamento->cliente}}"
        @endif
        required>
    </div>
</div>    

</form>
<button class="btn btn-primary btn-block" onclick="salvar_agendamento()"> Salvar agendamento </button>
@if($agendamento->id <> 0)
<button class="btn btn-warning btn-block" onclick="SelecionarArmarioEntrada('{{ $agendamento->id }}')"> Entrada </button>
@endif
</div>


<script>
    $(function () { 
        @isset($agendamento)
        @if($agendamento->id_massagista)
             $('#id_massagista').val({{ $agendamento->id_massagista }});
             console.log({{ $agendamento->id_massagista }}+'id_massagista');
        @endif
        @endisset
    });

 
    function salvar_agendamento(){
    requisicao('{{ route('edicao-agendamento-massagem-save',$agendamento->id) }}','GET',$('#id_massagista').val(), $('#agendamento_dia').val(), $('#agendamento_hora').val(), $('#cliente').val())
    .then(result => {
      $('#form-agendamento-1').html(result);
      location.reload();
    });
    }


    function SelecionarArmarioEntrada(id_agendamento){

  $('#modal').modal('show');
  $('#modal-corpo').html('loading...');
  $('#aux').val(id_agendamento);
  requisicao('{{ route('lista-armarios-todos') }}','GET',id_agendamento)
    .then(result => {
      $('#modal-titulo').html('Selecione o armario para dar entrada');
      $('#modal-corpo').html(result);
    });
    }

function selecionaArmarioArberto(id_armario){
    let id_agendamento = $('#aux').val();

    $('#modal').modal('show');
    $('#modal-corpo').html('loading...');
    requisicao('{{ route('entrada-agendamento-operacao') }}','GET',id_agendamento, id_armario)
    .then(result => {
      $('#modal-titulo').html('Entrada de agendamento');
      $('#modal-corpo').html(result);
      location.reload();
    });
    }


</script>