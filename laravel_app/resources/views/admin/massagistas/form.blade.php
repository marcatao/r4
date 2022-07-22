@extends('admin.layout.principal')
@section('estilos')

<link href="{{ asset('admin/css/plugins/colorpicker/bootstrap-colorpicker.min.css') }}" rel="stylesheet">
@endsection
@section('conteudo')




<div class="row">
 
                <div class="col-lg-12">
                    <div class="ibox ">
                        <div class="ibox-title">
                            <h5>Cadastro de Massagistas </h5>
 
                        </div>
                        <div class="ibox-content">
                            <form action="{{ route('form-massagistas',$id) }}" method="POST">
                                {{  csrf_field() }}
                                <div class="form-group row"><label class="col-lg-2 col-form-label">Massagistas</label>
                                    <div class="col-lg-10">
                                        <input 
                                        @if($massagistas)
                                          value="{{ $massagistas->nome }}"
                                        @else 
                                              value="{{ old('nome') }}"
                                         @endif
                                        type="text" name="nome" id="nome" placeholder="Nome" class="form-control" required> 
                                    </div>
                                </div>
                                <div class="form-group row"><label class="col-lg-2 col-form-label">Valor</label>
                                    <div class="col-lg-10">
                                        <input 
                                        @if($massagistas)
                                          value="{{ number_format($massagistas->valor,2,",",".")  }}"
                                        @else 
                                              value="{{ old('valor') }}"
                                         @endif
                                        type="text" name="valor" id="valor" placeholder="valor" class="form-control" required> 
                                    </div>
                                </div>
                                <div class="form-group row"><label class="col-lg-2 col-form-label">Duração em minutos</label>
                                    <div class="col-lg-10">
                                        <input 
                                        @if($massagistas)
                                          value="{{ $massagistas->duracao }}"
                                        @else 
                                              value="{{ old('duracao') }}"
                                         @endif
                                        type="number" name="duracao" id="duracao" placeholder="Duração da sessão" class="form-control" required> 
                                    </div>
                                </div>
                                <div class="form-group row"><label class="col-lg-2 col-form-label">Login (opcional)</label>
                                    <div class="col-lg-10">
                                        <select name="user_id" id="user_id" class="form-control">
                                            <option value=""></option>
                                        @foreach (\App\User::all() as $item)
                                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                    </div>
                                </div>     


                                <div class="form-group row"><label class="col-lg-2 col-form-label">Cor da Agenda</label>
                                    <div class="col-lg-10">
                                        <select type="text" name="cor_agendamento" id="cor_agendamento" class="form-control"> 
                                            <option value="#00CC00">Verde</option>
                                            <option value="#CC0000">Vermelho</option>
                                            <option value="#9669FE">Azul</option> 
                                            <option value="#DFDF00">Amarelo</option>  
                                            <option value="#FF79E1">Rosa</option>    
                                            <option value="##C0C0C0 ">Cinza</option>                                    
                                        </select>
                                    </div>
                                </div>     




                                  @if ($errors->any())
                                     <div class="alert alert-danger">
                                       <ul>
                                           @foreach ($errors->all() as $error)
                                            <li>{!! $error !!}</li>
                                           @endforeach
                                        </ul>
                                     </div>
                                   @endif

                                <div class="form-group row">
                                    <div class="col-md-12">
                                        <button class="btn btn-primary btn-block" type="submit">Salvar alterações</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
</div>

            

@endsection

@section('scripts')

<script src="{{ asset('admin/js/plugins/colorpicker/bootstrap-colorpicker.min.js') }}"></script>
 

<script>
    $(function () { 
        @isset($massagistas) 
            $('#cor_agendamento').val('{{ $massagistas->cor_agendamento }}');
        @if($massagistas->user_id)
             $('#user_id').val({{ $massagistas->user_id }});
            
        @endif
        @endisset
    });

$('.demo1').colorpicker();

var divStyle = $('.back-change')[0].style;
$('#demo_apidemo').colorpicker({
    color: divStyle.backgroundColor
}).on('changeColor', function(ev) {
            divStyle.backgroundColor = ev.color.toHex();
        });

//$('.clockpicker').clockpicker();


</script>
@endsection