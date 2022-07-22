@extends('admin.layout.principal')
@section('estilos')


@endsection
@section('conteudo')




<div class="row">
 
                <div class="col-lg-5">
                    <div class="ibox ">
                        <div class="ibox-title">
                            <h5>Cadastro de produtos </h5>
 
                        </div>
                        <div class="ibox-content">
                            <form action="{{ route('form-produtos',$id) }}" method="POST">
                                {{  csrf_field() }}

                                <div class="form-group row"><label class="col-lg-2 col-form-label">ID</label>
                                    <div class="col-lg-10">
                                        <input 
                                        @if($produtos)
                                          value="{{ $produtos->id }}"
                                        @else 
                                              value="{{ old('id') }}"
                                         @endif
                                        type="text" name="id" id="id" placeholder="Descrição" class="form-control" required> 
                                    </div>
                                </div>



                                <div class="form-group row"><label class="col-lg-2 col-form-label">Produtos</label>
                                    <div class="col-lg-10">
                                        <input 
                                        @if($produtos)
                                          value="{{ $produtos->nome }}"
                                        @else 
                                              value="{{ old('nome') }}"
                                         @endif
                                        type="text" name="nome" id="nome" placeholder="Descrição" class="form-control" required> 
                                    </div>
                                </div>
                                <div class="form-group row"><label class="col-lg-2 col-form-label">Valor</label>
                                    <div class="col-lg-10">
                                        <input 
                                        @if($produtos)
                                          value="{{ $produtos->valor }}"
                                        @else 
                                              value="{{ old('valor') }}"
                                         @endif
                                        type="text" name="valor" id="valor" placeholder="valor" class="form-control" required> 
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