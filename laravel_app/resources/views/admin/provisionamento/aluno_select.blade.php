<div class="form-group row" id="aluno_form_1">
    <label class="col-lg-2 col-form-label">Aluno:</label>
    <div class="col-lg-10">
        <select name="aluno_id" id="aluno_id"  class="form-control" required>
            <option value="">Selecione o aluno</option> 
        @foreach (\App\user::where('perfil','Aluno')->get() as $aluno)
            <option value="{{ $aluno->id }}">{{ $aluno->name }}</option>    
        @endforeach
        </select>
    </div>
</div> 