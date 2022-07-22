<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendMailUser;
use App\Mail\curriculo;



class SiteController extends Controller
{
    // 

    public function index(){
        $aconteces = \App\acontece::where('status','0')->orderBy('id','desc')->take(3)->get();
        return view('site.index')->with('aconteces',$aconteces);
    }

    public function contato(){
        return view('site.contato');
    }
    
    public function meio_periodo(){
        return view('site.servicos.meio-periodo');
    }
  
    public function intermediario(){
        return view('site.servicos.intermediario');
    }
    public function integral(){
        return view('site.servicos.integral');
    }
    public function documentos(){
        return view('site.documentos');
    }
    public function atividades(Request $request){
        $atv = \App\atividades::where('nome',$request->nome)->first();
        if(!$atv) $atv= \App\atividades::find(1);
        return view('site.atividades')->with('atv',$atv);
    }
  
    public function acontece(Request $request){
        if($request->categoria){
            $aconteces = \App\acontece::where('status','0')->where('categoria_id',$request->categoria)->orderBy('id','desc')->get();
        }else{
            $aconteces = \App\acontece::where('status','0')->orderBy('id','desc')->get();

        }
        return view('site.acontece')->with('aconteces',$aconteces);
    }
    public function acontece_artigo(Request $request){
        $acontece = \App\acontece::where('link',$request->route()->action['as'])->first();
        $capa = \App\acontece_imagens::find($acontece->capa);
        return view ('site.acontece_detalhe')
        ->with('acontece',$acontece)
        ->with('capa',$capa);
    }
 
    public function contato_send(Request $request){
     
        $validatedData = $request->validate([
            'nome' => 'required',
            'email' => 'required|email',
            'mensagem' => 'min:3',
            'g-recaptcha-response' => 'required'
        ]);        
   
        Mail::to(env('MAIL_TO'))->send(new SendMailUser($request));
        return $this->index(true);
    }
}
