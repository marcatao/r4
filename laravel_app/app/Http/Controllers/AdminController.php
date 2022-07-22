<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use DB;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Response;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
 
         
    }

 

    
    public function index(){
        if(auth()->user()->perfil == 'Professor'){
            return redirect(route('admin_index_professor'));
        }
        if(auth()->user()->perfil == 'Aluno'){
            return redirect(route('admin_index_aluno'));
        }
        return view('admin.provisionamento.aulas');
    }
    
    public function admin_provisionamento_form(){
        return view ('admin.provisionamento.form');
    }
    public function provisionamento_lista(Request $request){
        $periodo = $request->param1;
        $professor = $request->param2;
        if($professor == 'professor'){
            $provisionamentos = \App\provisionamentos::where(\DB::raw("strftime('%m-%Y', data)"), "=", $periodo)
                                                     ->where('professor_id',auth()->user()->id)
                                                     ->get();
        }else{
            $provisionamentos = \App\provisionamentos::where(\DB::raw("strftime('%m-%Y', data)"), "=", $periodo)->get();
        }
        
        return view('admin.provisionamento.lista')->with('provisionamentos',$provisionamentos)->with('periodo',$periodo);
    }
    public function provisionamento_delete(Request $request){
        $alunos_provisionamento = \App\alunos_provisionamento::where('provisionamento_id',$request->param1);
        if($alunos_provisionamento) $alunos_provisionamento->delete();
        $provisionamento = \App\provisionamentos::find($request->param1);
        if($provisionamento) $provisionamento->delete();
        return "ok";
    }

    public function seleciona_aula(Request $request){
        $aula = \App\aulas::find($request->param1);
        return response()->json($aula, 200);
    }
    public function seleciona_aluno(Request $request){
        $aluno = \App\user::find($request->param1);
        return response()->json($aluno, 200);
    }

    public function provisionamento_save(Request $request){

        if (!array_key_exists('aluno_id',$request->param1)) return response()->json(['message' => 'Selcione pelo menos 1 aluno'], 500);
        if (!is_numeric($request->param1['vl_aula']))return response()->json(['message' => 'Informe um numero válido para Valor da aula, ou zero para cortesia'], 500);
        if (!is_numeric($request->param1['qt_aula']))return response()->json(['message' => 'Informe um numero válido para Quantidade de aulas'], 500);
        if (!$request->param1['professor_id'])return response()->json(['message' => 'Selecione um professor !'], 500);
        if (!$request->param1['aula_id'])return response()->json(['message' => 'Selecione uma Aula !'], 500);

        $provisionamento = \App\provisionamentos::find($request->param1['id']);
        if(!$provisionamento) $provisionamento = new \App\provisionamentos();
        
        $aula = \App\aulas::find($request->param1['aula_id']);
        if($aula){ 
            $provisionamento->custo = $aula->custo;
            $professor = \App\user::where('id',$request->param1['professor_id'])->first();
            if($professor) if($professor->vl_aula > 0) $provisionamento->custo = $professor->vl_aula;
           
           
            $provisionamento->vl_adicional = $aula->vl_adicional;
        }
        $provisionamento->data = $request->param1['data'];
        $provisionamento->aula_id = $request->param1['aula_id'];
        $provisionamento->professor_id= $request->param1['professor_id'];
        $provisionamento->user_id = auth()->user()->id;
        $provisionamento->qt_aula = $request->param1['qt_aula'];
        $provisionamento->vl_aula = $request->param1['vl_aula'];
        $provisionamento->status = 'novo';
        DB::beginTransaction();
        try {
            $provisionamento->save();
            $deleted = DB::table('alunos_provisionamento')->where('provisionamento_id', '=', $provisionamento->id)->delete();
            foreach($request->param1['aluno_id'] as $alunos){
                $aula =  new \App\alunos_provisionamento();
                $aula->provisionamento_id = $provisionamento->id;
                $aula->aluno_id = $alunos;
                $aula->save();                                                    
            }


            DB::commit();
            return "Dados Salvos";
        } catch (Throwable $e) {
            report($e);
            return response()->json(['message' => 'Dados inconsistentes, verifique para salvar'], 500);
            DB::rollBack();
        }
 
       
    }

    public function provisionamento_load(Request $request){
        $provisionamento = \App\provisionamentos::find($request->param1);
        $provisionamento->alunos = $provisionamento->alunos;
         return response()->json($provisionamento);
    }






    public function admin_users(){
        return view('admin.user');
    }

    public function form_user($id){
        $user = \App\user::find($id);
        return view('admin.user-form')->with('user',$user)->with('id',$id);
    } 
    public function form_user_save($id, Request $request){
        $user = \App\user::find($id);
        $validatedData = $request->validate([
            'name' => 'required',
            'email' => 'required|email|',
            'perfil' => 'required'
        ],
    
        [
            'perfil.required' => 'O campo Perfil e Obrigatório',
          
        ]); 

        if( ($request->password) or ($id==0) ){
            $validatedData = $request->validate([
                'password' => 'min:6|required_with:password_confirmation|same:password_confirmation',
                'password_confirmation' => 'min:6',
            ],
        [
            'password.same' => 'A confirmação de senha não esta correta',
            'password.min' => 'A senha tem que ter minimo 6 caracteres',
            'password_confirmation.min' => 'A confirmação de senha tem que ter minimo 6 caracteres',
        ]);  
        }
        if($id==0){
            $validatedData = $request->validate([
                'email' => 'required|email|unique:users'
            ],
        
            [
                'email.unique' => 'Este email ja esta cadastrado no banco de dados, utilize outro'
              
            ]); 

        }

        if(!$user) $user = new \App\user;
        
        $user->name = $request->name;
        $user->email = $request->email;
        $user->perfil = $request->perfil;
        $user->whatsapp = $request->whatsapp;
        $user->dt_nascimento = $request->dt_nascimento;
        $user->nome_pai = $request->nome_pai;
        $user->nome_mae = $request->nome_mae;
        $user->instagram = $request->instagram;
        $user->responsavel = $request->responsavel;
        $user->contato_responsavel = $request->contato_responsavel; 
        $user->serie = $request->serie;
        $user->cep = $request->cep;
        $user->endereco = $request->endereco;
        $user->cpf_financeiro = $request->cpf_financeiro;
        $request->vl_aula =  str_replace(",",".",$request->vl_aula);
        $request->vl_aula = floatval(str_replace(",",".",$request->vl_aula));
        $user->vl_aula = $request->vl_aula;
        if($request->password ) $user->password =  Hash::make($request->password);
        $user->save();

        return redirect(route('form-user',$user->id));
    }
    public function admin_users_del($id){
        $user = \App\user::find($id);
        if($user) $user->delete();
        return $this->admin_users('Deletado com sucesso');
    }












    public function admin_aulas(){
 
        return view('admin.aulas.lista');
    }


    public function form_aulas($id){
        $aula = \App\aulas::find($id);
        return view('admin.aulas.form')->with('aula',$aula)->with('id',$id);
    } 
    public function form_aulas_save($id, Request $request){

        $request->valor =  str_replace(",",".",$request->valor);
     
        $mensagens = [
            'required' => 'O campo <b>:attribute</b> é obrigatório!',
            'valor.numeric' => 'O campo valor e necessario um numero válido'
        ];



        $aula = \App\aulas::find($id);
        $validatedData = $request->validate([
            'descricao' => 'required',
            'valor' => 'required'
        ],$mensagens); 

        if(!$aula){
             $aula = new \App\aulas;
             $aula->status = 'Disponivel';
        }
   
        $aula->descricao = $request->descricao;
        $aula->valor = floatval(str_replace(",",".",$request->valor));
        $aula->custo = floatval(str_replace(",",".",$request->custo));
        $aula->vl_adicional = floatval(str_replace(",",".",$request->vl_adicional));
        $aula->save();

        return $this->form_aulas($aula->id);
    }

    public function admin_aulas_del($id){
        $aula = \App\aulas::find($id);
        if($aula) $aula->delete();
        return $this->admin_aulas('Deletado com sucesso');
    }







    public function admin_relatorio_professores(Request $request){

        $itens = \App\provisionamentos::where('professor_id',$request->professor_id)
                ->whereBetween(DB::raw('DATE(data)'), array($request->dt_1, $request->dt_2))
                ->get();
 
    if(!$request->dt_1) $request->dt_1 = date("Y-m-d");
    if(!$request->dt_2) $request->dt_2 = date("Y-m-d");
 
    return view('admin.relatorios.professores.index')
    ->with('itens',$itens)
    ->with('dt_1',$this->inverteData($request->dt_1))
    ->with('dt_2',$this->inverteData($request->dt_2))
    ->with('professor_id',$request->professor_id);

 
    }

    public function admin_relatorio_alunos(Request $request){

       // $itens = \App\provisionamentos::whereBetween(DB::raw('DATE(data)'), array($request->dt_1, $request->dt_2))
        
       $id_selecionados = array(); 

                $itens =DB::table('provisionamentos')
                ->join('alunos_provisionamento','provisionamentos.id', '=', 'alunos_provisionamento.provisionamento_id')
                ->select('provisionamentos.id')
                ->whereBetween(DB::raw('DATE(provisionamentos.data)'), array($request->dt_1, $request->dt_2))
                ->whereIn('alunos_provisionamento.aluno_id',[$request->aluno_id])
                ->get();
        foreach($itens as $item){
            array_push($id_selecionados, $item->id);
        }
        $itens = \App\provisionamentos::whereIn('id',$id_selecionados)->orderby('data')->get();
 
    $selecionado = \App\user::find($request->aluno_id);

    if(!$request->dt_1) $request->dt_1 = date("Y-m-d");
    if(!$request->dt_2) $request->dt_2 = date("Y-m-d");
 
    return view('admin.relatorios.alunos.index')
    ->with('itens',$itens)
    ->with('dt_1',$this->inverteData($request->dt_1))
    ->with('dt_2',$this->inverteData($request->dt_2))
    ->with('aluno_id',$request->aluno_id)
    ->with('selecionado',$selecionado);

 
    }






private function para_numero($brl, $casasDecimais = 2) {
    // Se já estiver no formato USD, retorna como float e formatado
    if(preg_match('/^\d+\.{1}\d+$/', $brl))
        return (float) number_format($brl, $casasDecimais, '.', '');
    // Tira tudo que não for número, ponto ou vírgula
    $brl = preg_replace('/[^\d\.\,]+/', '', $brl);
    // Tira o ponto
    $decimal = str_replace('.', '', $brl);
    // Troca a vírgula por ponto
    $decimal = str_replace(',', '.', $decimal);
    return (float) number_format($decimal, $casasDecimais, '.', '');
}







public function imprimir($id){
    $operacao = \App\operacoes::find($id);
    return view('admin.operacao.finalizar.imprimir-demonstrativo')->with('operacao',$operacao);
}


 

 
 

 

 
private function inverteData($data){
    if(count(explode("/",$data)) > 1){
        return implode("-",array_reverse(explode("/",$data)));
    }elseif(count(explode("-",$data)) > 1){
        return implode("/",array_reverse(explode("-",$data)));
    }
}

 
 
public function admin_calendario(){
    $itens = \App\agendamentos::where('status','0')->get();
    return view('admin.calendario.lista')->with('itens',$itens);
}

 
 

 



public function admin_index_aluno(Request $request){

    $filtro =  date('m-Y');
    if($request->param1) $filtro=$request->param1;

    $id_selecionados = array();
    $itens =DB::table('provisionamentos')
    ->join('alunos_provisionamento','provisionamentos.id', '=', 'alunos_provisionamento.provisionamento_id')
    ->select('provisionamentos.id')
    ->where('alunos_provisionamento.aluno_id',auth()->user()->id)
    ->where(\DB::raw("strftime('%m-%Y', data)"), "=", $filtro)
    ->get();
    foreach($itens as $item){
     array_push($id_selecionados, $item->id);
    }
    $aulas = \App\provisionamentos::whereIn('id',$id_selecionados)->orderby('data')->get();
    return view ('admin.aluno.index')->with('aulas',$aulas)->with('param1',$filtro);
}





public function admin_index_professor(){

    $aulas = \App\provisionamentos::where('professor_id',auth()->user()->id)->orderby('data')->get();
    return view ('admin.professor.index')->with('aulas',$aulas);
    }
}
