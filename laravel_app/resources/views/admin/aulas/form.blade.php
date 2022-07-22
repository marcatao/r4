@extends('admin.layout.principal')
@section('estilos')


@endsection
@section('conteudo')




<div class="row">
 
                <div class="col-lg-5">
                    <div class="ibox ">
                        <div class="ibox-title">
                            <h5>Cadastro de aula </h5>
 
                        </div>
                        <div class="ibox-content">
                            <form action="{{ route('form-aulas',$id) }}" method="POST">
                                {{  csrf_field() }}
                                <div class="form-group row"><label class="col-lg-2 col-form-label">Aula</label>
                                    <div class="col-lg-10">
                                        <input 
                                        @if($aula)
                                          value="{{ $aula->descricao }}"
                                        @else 
                                              value="{{ old('descricao') }}"
                                         @endif
                                        type="text" name="descricao" id="descricao" placeholder="Nome da Aula" class="form-control" required> 
                                    </div>
                                </div>
                                <div class="form-group row"><label class="col-lg-2 col-form-label">Valor Padrão</label>
                                    <div class="col-lg-10">
                                        <input 
                                        @if($aula)
                                          value="{{  number_format($aula->valor,2,",",".")  }}"
                                        @else 
                                              value="{{ old('valor') }}"
                                         @endif
                                        type="text" name="valor" id="valor" placeholder="Valor pre definido de aula" class="form-control" required> 
                                    </div>
                                </div>
                                <div class="form-group row"><label class="col-lg-2 col-form-label">Custo Aula</label>
                                    <div class="col-lg-10">
                                        <input 
                                        @if($aula)
                                        @if(is_numeric($aula->custo))
                                          value="{{  number_format($aula->custo,2,",",".")  }}"
                                        @else 
                                              value="{{ old('custo') }}"
                                         @endif
                                         @endif
                                        type="text" name="custo" id="custo" placeholder="Valor pre definido para o custo de aula" class="form-control" required> 
                                    </div>
                                </div>
                                <div class="form-group row"><label class="col-lg-2 col-form-label">Valor adicional</label>
                                    <div class="col-lg-10">
                                        <input 
                                        @if($aula)
                                        @if(is_numeric($aula->vl_adicional))
                                          value="{{  number_format($aula->vl_adicional,2,",",".")  }}"
                                        @else 
                                              value="{{ old('vl_adicional') }}"
                                         @endif
                                         @endif
                                        type="text" name="vl_adicional" id="vl_adicional" placeholder="Valor adicional por aluno" class="form-control" required> 
                                    </div>
                                </div>            

                                  @if ($errors->any())
                                     <div class="alert alert-danger">
                                       <ul>
                                           @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
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

                        <a class="btn btn-default btn-block" href="{{ route('admin-aulas') }}"> <i class="fa fa-arrow-left"></i>  Ver todas as aulas</a>
                    </div>
                </div>
</div>

            

@endsection

@section('scripts')

 

<script>
    $(function () { 
        @isset($messagem)
        @if($messagem)
             alert({{ $messagem }});
        @endif
        @endisset
    });
</script>
@endsection