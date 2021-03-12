<?php

//namespace App\Http\Controllers\Auth;
namespace PetShop\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\src\org\configuracao\PermissoesTools;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class VerificaAcessoController extends Controller
{


    public function verifica(Request $request){


        if( Auth::user() == null || Auth::user()->id == 0){
            return response()->json( ['permiteAcesso' => false] );
        }
        if(isset($request->controller) == false ){
            return response()->json( ['permiteAcesso' => true] );
        }



        $acao = null;
        if( isset($request->acao) ){
            $acao =  $request->acao;
        }else{
            $acao = "index";
        }

        $tool = new PermissoesTools();
        $resultado = $tool->verificaPermissao(Auth::user()->id,
            $request->controller,
            $acao);
        unset( $tool );
        return response()->json( ['permiteAcesso' => $resultado] );
    }

}
