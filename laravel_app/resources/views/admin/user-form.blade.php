@extends('admin.layout.principal')
@section('estilos')


@endsection
@section('conteudo')


<form action="{{ route('form-user',$id) }}" method="POST">
    {{  csrf_field() }}

<div class="row">
 
                <div class="col-lg-6">
                    <div class="ibox ">
                        <div class="ibox-title">
                            <h5>Cadastro de usuários </h5>
 
                        </div>
                        <div class="ibox-content">

                                <div class="form-group row"><label class="col-lg-2 col-form-label">Nome</label>
                                    <div class="col-lg-10">
                                        <input 
                                        @if($user)
                                          value="{{ $user->name }}"
                                        @else 
                                              value="{{ old('name') }}"
                                         @endif
                                        type="text" name="name" id="name" placeholder="Nome" class="form-control" required> 
                                    </div>
                                </div>
                                <div class="form-group row"><label class="col-lg-2 col-form-label">Perfil</label>
                                    <div class="col-lg-10">
                                        <select id="perfil" name="perfil"   class="form-control" required>
                                            <option value="@if($user)
                                               {{ $user->perfil }}
                                          @else 
                                                {{ old('perfil') }}
                                           @endif">@if($user)
                                              {{ $user->perfil }}
                                         @else 
                                              {{ old('perfil') }}
                                          @endif</option>
                                          <option value="Administrador">Administrador</option>
                                          <option value="Aluno">Aluno</option>
                                          <option value="Professor">Professor</option> 
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row"><label class="col-lg-2 col-form-label">Email</label>
                                    <div class="col-lg-10">
                                        <input
                                        @if($user)
                                            value="{{ $user->email }}"
                                        @else 
                                            value="{{ old('email') }}"
                                        @endif
                                        type="email" 
                                        name="email" 
                                        id="email" 
                                        placeholder="Email" 
                                        class="form-control" required> 
                                    </div>
                                </div>

                                <div class="form-group row"><label class="col-lg-2 col-form-label">Valor aula</label>
                                    <div class="col-lg-10">
                                        <input 
                                        @if($user)
                                        value="{{  number_format($user->vl_aula,2,",",".")  }}"
                                        @else 
                                              value="{{ old('vl_aula') }}"
                                         @endif
                                        type="text" name="vl_aula" id="vl_aula" placeholder="Valor aula" class="form-control"> 
                                    </div>
                                </div>


                                <hr>
                                <div class="form-group row"><label class="col-lg-2 col-form-label">Senha</label>
                                    <div class="col-lg-10">
                                        <input type="password" name="password" id="password" placeholder="Senha" class="form-control"> 
                                    </div>
                                </div>    
                                <div class="form-group row"><label class="col-lg-2 col-form-label"></label>
                                    <div class="col-lg-10">
                                        <input type="password" name="password_confirmation" id="password_confirmation" placeholder="Confirmação da senha" class="form-control"> 
                                    </div>
                                </div>      
                        </div>
                    </div>
                </div>



                <div class="col-lg-6">
                    <div class="ibox ">
                        <div class="ibox-title">
                            <h5>Dados Adicionais </h5>
 
                        </div>
                        <div class="ibox-content ">
                            <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row"><label class="col-lg-2 col-form-label">Whatsapp</label>
                                    <div class="col-lg-10">
                                        <input 
                                        @if($user)
                                          value="{{ $user->whatsapp }}"
                                        @else 
                                              value="{{ old('whatsapp') }}"
                                         @endif
                                        type="text" name="whatsapp" id="whatsapp" placeholder="whatsapp" class="form-control"> 
                                    </div>
                                </div>
                                <div class="form-group row"><label class="col-lg-2 col-form-label">Nascito</label>
                                    <div class="col-lg-10">
                                        <input 
                                        @if($user)
                                          value="{{ $user->dt_nascimento }}"
                                        @else 
                                              value="{{ old('dt_nascimento') }}"
                                         @endif
                                        type="date" name="dt_nascimento" id="dt_nascimento" placeholder="Data de Nascimento" class="form-control"> 
                                    </div>
                                </div>    
                                <div class="form-group row"><label class="col-lg-2 col-form-label">Pai</label>
                                    <div class="col-lg-10">
                                        <input 
                                        @if($user)
                                          value="{{ $user->nome_pai }}"
                                        @else 
                                              value="{{ old('nome_pai') }}"
                                         @endif
                                        type="text" name="nome_pai" id="nome_pai" placeholder="Nome do Pai" class="form-control"> 
                                    </div>
                                </div>  
                                <div class="form-group row"><label class="col-lg-2 col-form-label">Mãe</label>
                                    <div class="col-lg-10">
                                        <input 
                                        @if($user)
                                          value="{{ $user->nome_mae }}"
                                        @else 
                                              value="{{ old('nome_mae') }}"
                                         @endif
                                        type="text" name="nome_mae" id="nome_mae" placeholder="Nome mãe" class="form-control"> 
                                    </div>
                                </div>  
                                <div class="form-group row"><label class="col-lg-2 col-form-label">Instagram</label>
                                    <div class="col-lg-10">
                                        <input 
                                        @if($user)
                                          value="{{ $user->instagram }}"
                                        @else 
                                              value="{{ old('instagram') }}"
                                         @endif
                                        type="text" name="instagram" id="instagram" placeholder="Instagam" class="form-control"> 
                                    </div>
                                </div>          
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row"><label class="col-lg-2 col-form-label">CPF</label>
                                    <div class="col-lg-10">
                                        <input 
                                        @if($user)
                                          value="{{ $user->cpf_financeiro }}"
                                        @else 
                                              value="{{ old('cpf_financeiro') }}"
                                         @endif
                                        type="text" name="cpf_financeiro" id="cpf_financeiro" placeholder="CPF responsavel" class="form-control"> 
                                    </div>
                                </div>     

                                <div class="form-group row"><label class="col-lg-2 col-form-label">Responsavel</label>
                                    <div class="col-lg-10">
                                        <input 
                                        @if($user)
                                          value="{{ $user->responsavel }}"
                                        @else 
                                              value="{{ old('responsavel') }}"
                                         @endif
                                        type="text" name="responsavel" id="responsavel" placeholder="responsavel" class="form-control"> 
                                    </div>
                                </div>              

                                <div class="form-group row"><label class="col-lg-2 col-form-label">Contato</label>
                                    <div class="col-lg-10">
                                        <input 
                                        @if($user)
                                          value="{{ $user->contato_responsavel }}"
                                        @else 
                                              value="{{ old('contato_responsavel') }}"
                                         @endif
                                        type="text" name="contato_responsavel" id="contato_responsavel" placeholder="contato responsavel" class="form-control"> 
                                    </div>
                                </div>              
                                <div class="form-group row"><label class="col-lg-2 col-form-label">Serie</label>
                                    <div class="col-lg-10">
                                        <input 
                                        @if($user)
                                          value="{{ $user->serie }}"
                                        @else 
                                              value="{{ old('serie') }}"
                                         @endif
                                        type="text" name="serie" id="serie" placeholder="Serie ou Ano" class="form-control"> 
                                    </div>
                                </div>   
                                <div class="form-group row"><label class="col-lg-2 col-form-label">Cep</label>
                                    <div class="col-lg-10">
                                        <input 
                                        @if($user)
                                          value="{{ $user->cep }}"
                                        @else 
                                              value="{{ old('cep') }}"
                                         @endif
                                        type="text" name="cep" id="cep" placeholder="contato responsavel" class="form-control"> 
                                    </div>
                                </div>   
                                <div class="form-group row"><label class="col-lg-2 col-form-label">End.:</label>
                                    <div class="col-lg-10">
                                        <input 
                                        @if($user)
                                          value="{{ $user->endereco }}"
                                        @else 
                                              value="{{ old('endereco') }}"
                                         @endif
                                        type="text" name="endereco" id="endereco" placeholder="endereço completo" class="form-control"> 
                                    </div>
                                </div>                                  
                            </div>   
                            </div>
                        </div>
                    </div>
                </div>



</div>

<div class="form-group row">
    <div class="col-md-12">
        @if ($errors->any())
        <div class="alert alert-danger">
          <ul>
              @foreach ($errors->all() as $error)
               <li>{{ $error }}</li>
              @endforeach
           </ul>
        </div>
      @endif


        <button class="btn btn-primary btn-block" type="submit">Salvar alterações</button>
        <hr>
        <a href="{{ route('admin-users') }}" class="btn btn-default btn-block" type="submit">Voltar</a>
    </div>
</div>          
</form>
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