        <div class="ibox ">
            <div class="ibox-title">
                <h5>Formulario para Classe e Aula</h5>
            </div>
            <div class="ibox-content">
                   <div class="form-group row">
                        <label class="col-lg-2 col-form-label">Data:</label>
                        <div class="col-lg-10">
                            <input type="date" name="data" id="data" placeholder="Data" class="form-control" required> 
                        </div>
                    </div>  
                    <div class="form-group row">
                        <label class="col-lg-2 col-form-label">Aula:</label>
                        <div class="col-lg-10">
                            <select name="aula_id" id="aula_id"  class="form-control" required onchange="SelecionaAula(this.value)">
                                <option value="">Selecione a aula</option> 
                            @foreach (\App\aulas::all() as $aula)
                                <option value="{{ $aula->id }}">{{ $aula->descricao }}</option>    
                            @endforeach
                            </select>
                        </div>
                    </div>
         




                          <div class="form-group row">
                            <label class="col-lg-2 col-form-label">Alunos:</label>
                            <div class="col-lg-10">
                                <select name="aluno_id[]" id="aluno_id" multiple="multiple" class="form-control js-example-basic-multiple" onchange="SelecionaAluno(this.value)">
                                    @foreach (\App\user::where('perfil','Aluno')->get() as $aluno)
                                        <option value="{{ $aluno->id }}">{{ $aluno->name }}</option>    
                                    @endforeach
                                  </select>
                            </div>
                        </div>  



            
                    <div class="form-group row">
                        <label class="col-lg-2 col-form-label">Professor:</label>
                        <div class="col-lg-10">

                            @if (auth()->user()->perfil == 'Professor')
                                 <select name="professor_id" id="professor_id"  class="form-control" disabled='true'>
                                     <option value="{{ auth()->user()->id }}">{{ auth()->user()->name }}</option> 
                                 </select>  

                            @else
                                <select name="professor_id" id="professor_id"  class="form-control" required>
                                    <option value="">Selecione o professor</option> 
                                @foreach (\App\user::where('perfil','Professor')->get() as $professor)
                                    <option value="{{ $professor->id }}">{{ $professor->name }}</option>    
                                @endforeach
                                </select>     
                            @endif



                        </div>
                    </div>  
                    <div class="form-group row">
                        <label class="col-lg-2 col-form-label">Qtidade:</label>
                        <div class="col-lg-10">
                            <input type="number" name="qt_aula" id="qt_aula" value=1 class="form-control" required> 
                        </div>
                    </div>     
                    <div class="form-group row">
                        <label class="col-lg-2 col-form-label">Valor:</label>
                        <div class="col-lg-10">
                            <input type="text" name="vl_aula" id="vl_aula" placeholder="valor aula" class="form-control" required> 
                        </div>
                    </div>     
                    <input type="hidden" name="id" id="id" value="0">  
                    <button class="btn btn-primary btn-block" onclick="save_formulario()">Salvar Registro</button>            
           </div>
        </div>
<script>

var vl_aula_padrao = 0;

$(document).ready(function() {
    $('#aluno_id').select2();
});

function delete_provisionamento(id){
    requisicao('{{ route('provisionamento_delete') }}','POST',id)
    .then(result => {
       alert('Registro deletado','warning');
       carrega_provisionamentos();
    })
}


function edit_provisionamento(id){
    requisicao('{{ route('provisionamento_load') }}','POST',id)
    .then(result => {
        let d = JSON.parse(result);
        console.log('retorno: '+d.alunos);
        let arrAlunos = [];
        d.alunos.forEach(function(aluno) {
            arrAlunos.push(aluno.aluno_id);
             console.log('aluno: '+aluno.aluno_id);
             
        });
        vl_aula_padrao = d.vl_aula;
        $('#id').val(d.id);
        $('#data').val(d.data);
        $('#aula_id').val(d.aula_id);
        $('#aluno_id').val(arrAlunos);
        $('#aluno_id').trigger('change');
        $('#professor_id').val(d.professor_id);
       
        $('#qt_aula').val(d.qt_aula);
        $('#data').focus();
        $('#vl_aula').val(d.vl_aula);
    })
}

function save_formulario(){
console.log($('#aluno_id').select2('val'));
 
    let dados = {
       "id":           $('#id').val(),
       "data":         $('#data').val(), 
       "aula_id":      $('#aula_id').val(),
       "aluno_id":     $('#aluno_id').select2('val'),
       "professor_id": $('#professor_id').val(),
       "vl_aula":      $('#vl_aula').val(),
       "qt_aula":      $('#qt_aula').val()
    }

    requisicao('{{ route('provisionamento_save') }}','POST',dados)
    .then(result => {
        
        $('#id').val('0');
        $('#data').val('');
        $('#aula_id').val('')
        $('#aluno_id').val([]).trigger('change');
        $('#professor_id').val('');
        $('#vl_aula').val('');
        $('#qt_aula').val('1');
        alert(result);

        carrega_provisionamentos();
    })
    .catch(error => {
        let erro = " Erro desconhecido";
        if(error.responseText[0]=="{"){
            erro  = JSON.parse(error.responseText).message;
        }else{
             erro = 'Dados inconsistentes, verifique para salvar';
        }
        alert(error.status+'-'+erro,'error');
    });
}

function SelecionaAula(aula_id){
    requisicao('{{ route('seleciona_aula') }}','GET',aula_id)
    .then(result => {
        vl_aula_padrao = JSON.parse(result).valor;
        $('#vl_aula').val(vl_aula_padrao);
    });
}

function SelecionaAluno(dados){
    requisicao('{{ route('seleciona_aluno') }}','GET',dados)
    .then(result => {
        vl_aluno = JSON.parse(result).vl_aula;
        if(vl_aluno > 0){
            $('#vl_aula').val(vl_aluno);
        }else{
            $('#vl_aula').val(vl_aula_padrao);
        }
    });
}
 
 
</script>
 
        