<?php


namespace App\Http\Controllers\pessoa;
use App\Http\Controllers\Controller;
use Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\db\cadastro\Pessoa;
use App\db\cadastro\ClienteUsuario;
use App\db\cadastro\PessoaEndereco;
use App\db\cadastro\PessoaTelefone;
use App\db\cadastro\PessoaAnexo;
use App\db\configuracao\Parametro;
use App\src\org\cadastro\PessoaNegocio;
use App\db\configuracao\Usuario;
use Illuminate\Support\Facades\DB;
use App\src\org\configuracao\PermissoesTools;
use App\db\configuracao\Anexo;
use App\src\org\cadastro\AnexoNegocio;
use App\db\cadastro\Observacao;

class ClienteController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }
    protected function getImagem(Request $request){

        if ($request->file('imagem') != null && $request->file('imagem')->isValid()) {

            $img =  Image::make( $request->file('imagem') );

            // $img->fit(100, 100);
            return  $img->encode('data-url');
        }else{
            return $request->imagem; // retorna o cavas já no formato que queremos
        }
    }

    public function atualizaObservacao($id, Request $request  ){

        if(!empty($request->observacao)){

            $observacao= new Observacao;
            $observacao->observacao = strtoupper($request->observacao);
            $observacao->usuario_gravou_id = Auth::user()->id;
            $observacao->cliente_id = $id;
            $observacao->save();

        }
        return response()->json($id);
    }

    public function observacao($id ){

        $observacao = Db::table('cadastro_observacao')
            ->join('conf_usuario','conf_usuario.id', 'cadastro_observacao.usuario_gravou_id' )
            ->select( DB::raw("to_char(cadastro_observacao.data_cadastro,'DD/MM/YYYY HH24:mi') as data"),
                'cadastro_observacao.observacao as observacao',
                'conf_usuario.nome as nome' )
            ->where('cadastro_observacao.cliente_id',$id)
            ->orderBy('cadastro_observacao.data_cadastro', 'DESC')
            ->get();


        return response()->json($observacao);

    }

    public function editUsuario($id){

        $dados = DB::table('conf_usuario')
            ->join('conf_grupo','conf_grupo.id','conf_usuario.grupo_id')
            ->select('conf_usuario.id',
                'conf_usuario.nome as nomeUsuario',
                'conf_usuario.email',
                'conf_grupo.nome as grupo',
                'conf_grupo.id as grupoId',
                'conf_usuario.celular as usuarioCelular')
            ->where('conf_usuario.id',$id)->first();

        return response()->json($dados);
    }
    public function updateUsuario(Request $request){
        $mensagem = "";
        $erro = false;
        $errors = array();

        $validator = Validator::make($request->all(), [

            'nomeUsuario' => 'required',
            'email' => 'email|required',
            'senha' => 'min:6'

        ]);

        if($validator->fails()){
            $errors =$validator->errors()->all();
            $erro = true;
        }

        if( $erro == false ){
            $usuario =Usuario::find( $request->id );
            if($usuario != null ){

                $usuario->nome = mb_strtoupper ( trim( $request->nomeUsuario));
                $usuario->email = mb_strtoupper ( trim($request->email));
                $usuario->celular = $request->usuarioCelular;

                if( $request->senha != null ){
                    $usuario->password = bcrypt( $request->senha );
                }

                $usuario->save();
                $mensagem="Usuario alterado com sucesso.";
                $tool = new PermissoesTools();
                $tool->regitraHistorico(Auth::user()->id, "UPDATE", "USUARIO",$usuario, null);
            }else{
                array_push($errors, "Registro nao localizado");
                $erro=true;
            }
        }

        return response()->json( ['retorno' => $mensagem, 'erro' => $erro, 'errors' => $errors] );
    }
    public function saveUsuario(Request $request ){
        $mensagem = "";
        $errors = array();
        $erro = false;


        $validator = Validator::make($request->all(), [
            'nomeUsuario' => 'required',
            'email' => 'email|required|unique:conf_usuario',
            'senha' => 'required|min:6'

        ]);

        if($validator->fails()){
            $errors =$validator->errors()->all();
            $erro = true;
        }

        if($erro == false){

            $usuario= new Usuario;
            $usuario->nome = mb_strtoupper ( trim( $request->nomeUsuario));
            $usuario->email = mb_strtoupper ( trim($request->email));
            $usuario->usuario = mb_strtoupper ( trim($request->email));
            $usuario->password = bcrypt( $request->senha );
            $usuario->celular = str_replace('(','',str_replace(')','',str_replace('-','',str_replace(' ', '',$request->usuarioCelular))));
            $usuario->filtro_cliente = true;

            $grupoCliente = DB::table('conf_grupo')
                ->select('conf_grupo.id as grupoId')
                ->where('conf_grupo.nome','=','PARCEIRO')
                ->first();

            $usuario->grupo_id = $grupoCliente->grupoId;
            $usuario->usuario_gravou_id = Auth::user()->id;
            $usuario->save();

            $clienteUsuario = new ClienteUsuario;
            $clienteUsuario->usuario_id = $usuario->id;
            $clienteUsuario->cliente_id = $request->clienteId;
            $clienteUsuario->save();


            $mensagem="Usuario cadastrado com sucesso.";
            $tool = new PermissoesTools();
            $tool->regitraHistorico(Auth::user()->id, "SAVE", "USUARIO",$usuario, null);
        }

        return response()->json( ['retorno' => $mensagem, 'erro' => $erro, 'errors' => $errors] );
    }

    public function listaUsuario(Request $request){
        $lista = Array();
        $parametroNome= null;
        $offset = 0;
        $limit = 10;
        $paginaAtual = 0;
        $quantidadeRegistro = 0 ;

        if( isset( $request->draw ) ){
            $paginaAtual = $request->draw;
        }

        if( isset( $request->start ) ){
            $offset = $request->start;
        }

        if( isset( $request->length ) ){
            $limit = $request->length;
        }

        $qtd = DB::table('cadastro_pessoa')
            ->join('cliente_usuario','cliente_usuario.cliente_id','cadastro_pessoa.id')
            ->join('conf_usuario','conf_usuario.id','cliente_usuario.usuario_id')
            ->join('conf_grupo','conf_grupo.id','conf_usuario.grupo_id')
            ->where('cadastro_pessoa.id',$request->clienteId);


        $lista =   DB::table('cadastro_pessoa')
            ->join('cliente_usuario','cliente_usuario.cliente_id','cadastro_pessoa.id')
            ->join('conf_usuario','conf_usuario.id','cliente_usuario.usuario_id')
            ->join('conf_grupo','conf_grupo.id','conf_usuario.grupo_id')
            ->select('conf_usuario.id',
                'conf_usuario.nome',
                'conf_usuario.usuario',
                'conf_usuario.email',
                'conf_grupo.nome as grupo')
            ->where('cadastro_pessoa.id',$request->clienteId);

        $qtd = $qtd->count();

        $lista =  $lista->offset( $offset )
            ->limit( $limit )
            ->orderBy('conf_usuario.id','desc')
            ->get();

        return response()->json( [ 'draw' => $paginaAtual,
            'recordsTotal' => $qtd,
            'recordsFiltered' => $qtd,
            'data'=>$lista ]  );
    }


    public function listTipoDocumento(){

        $lista = DB::table('cadastro_tipo_documento')
            ->select('id', 'nome','mascara')
            ->whereNull('data_exclusao')
            ->get();

        return response()->json($lista);

    }
    public function listClassificacao(Request $request){

        $lista = Array();
        $parametroFiltro=null;
        $offset = 0;
        $limit = 30;
        $paginaAtual = 0;
        $quantidadeRegistro = 0 ;

        $qtd = DB::table('cadastro_classificacao')
            ->whereNull('data_exclusao');


        $lista = DB::table('cadastro_classificacao')
            ->select('id', 'nome as text')
            ->whereNull('data_exclusao');

        if( isset($request->filtro) && strlen($request->filtro)>0 ){

            $parametroFiltro = strtoupper ( trim( $request->filtro ) );

            $qtd =   $qtd->where('cadastro_classificacao.nome','like',"%".$parametroFiltro."%");

            $lista = $lista->where('cadastro_classificacao.nome','like',"%".$parametroFiltro."%");

        }

        $qtd = $qtd->count();

        $lista =  $lista->offset( $offset )
            ->limit( $limit )
            ->orderBy('id','ASC')
            ->get();

        return response()->json( ['total_count' => $qtd,
            'incomplepe_results'=>false,
            'items'=>$lista
        ]  );

    }

    public function listGrupo(Request $request){

        $lista = Array();
        $parametroFiltro=null;
        $offset = 0;
        $limit = 30;
        $paginaAtual = 0;
        $quantidadeRegistro = 0 ;

        $qtd = DB::table('conf_grupo')
            ->whereNull('data_exclusao');


        $lista = DB::table('conf_grupo')
            ->select('id', 'nome as text')
            ->whereNull('data_exclusao');

        if( isset($request->filtro) && strlen($request->filtro)>0 ){

            $parametroFiltro = strtoupper ( trim( $request->filtro ) );


            $qtd =   $qtd->where('conf_grupo.nome','like',"%".$parametroFiltro."%");


            $lista = $lista->where('conf_grupo.nome','like',"%".$parametroFiltro."%");

        }

        $qtd = $qtd->count();

        $lista =  $lista->offset( $offset )
            ->limit( $limit )
            ->orderBy('id','ASC')
            ->get();

        return response()->json( [ 'total_count' => $qtd,
                'incomplepe_results'=>false,
                'items'=>$lista ]
        );
    }
    public function listEstadoCivil(Request $request){

        $lista = Array();
        $parametroFiltro=null;
        $offset = 0;
        $limit = 30;
        $paginaAtual = 0;
        $quantidadeRegistro = 0 ;

        $qtd = DB::table('cadastro_pessoa_estado_civil')
            ->whereNull('data_exclusao');

        $lista = DB::table('cadastro_pessoa_estado_civil')
            ->select('id', 'descricao as text')
            ->whereNull('data_exclusao');

        if( isset($request->filtro) && strlen($request->filtro)>0 ){

            $parametroFiltro = strtoupper ( trim( $request->filtro ) );


            $qtd =   $qtd->where('cadastro_pessoa_estado_civil.descricao','like',"%".$parametroFiltro."%");


            $lista = $lista->where('cadastro_pessoa_estado_civil.descricao','like',"%".$parametroFiltro."%");

        }

        $qtd = $qtd->count();

        $lista =  $lista->offset( $offset )
            ->limit( $limit )
            ->orderBy('descricao','ASC')
            ->get();

        return response()->json( [ 'total_count' => $qtd,
            'incomplepe_results'=>false,
            'items'=>$lista ]  );

    }

    public function listCategoriaCnh(Request $request){


        $lista = Array();
        $parametroFiltro=null;
        $offset = 0;
        $limit = 30;
        $paginaAtual = 0;
        $quantidadeRegistro = 0 ;

        $qtd = DB::table('cadastro_cnh_categoria')
            ->whereNull('data_exclusao');


        $lista = DB::table('cadastro_cnh_categoria')
            ->select('id','categoria as text')
            ->whereNull('data_exclusao');

        if( isset($request->filtro) && strlen($request->filtro)>0 ){

            $parametroFiltro = strtoupper ( trim( $request->filtro ) );


            $qtd =   $qtd->where('cadastro_cnh_categoria.categoria','like',"%".$parametroFiltro."%");


            $lista = $lista->where('cadastro_cnh_categoria.categoria','like',"%".$parametroFiltro."%");

        }

        $qtd = $qtd->count();

        $lista =  $lista->offset( $offset )
            ->limit( $limit )
            ->orderBy('id','ASC')
            ->get();

        return response()->json( [ 'total_count' => $qtd,
            'incomplepe_results'=>false,
            'items'=>$lista ]  );
    }

    public function lista(Request $request){

        $lista = Array();
        $parametroNome = null;
        $offset = 0;
        $limit = 10;
        $paginaAtual = 0;
        $quantidadeRegistro = 0 ;

        if( isset( $request->draw ) ){
            $paginaAtual = $request->draw;
        }

        if( isset( $request->start ) ){
            $offset = $request->start;
        }

        if( isset( $request->length ) ){
            $limit = $request->length;
        }

        $negocio = new PessoaNegocio();
        $parametro = DB::table('conf_parametro')->select('relacionamento_cliente_id')->first();
        $dados =  $negocio->listPessoa($parametro->relacionamento_cliente_id, $request->pesquisa, $limit, $offset );

        unset( $parametro );
        unset( $negocio );

        $lista = $dados["lista"];
        $qtd = $dados["qtd"];

        unset($dados);

        return response()->json( [ 'draw' => $paginaAtual,
            'recordsTotal' => $qtd,
            'recordsFiltered' => $qtd,
            'data'=>$lista ]  );
    }

    public function edit($id){

        $negocio = new PessoaNegocio();
        $parametro = DB::table('conf_parametro')->select('relacionamento_cliente_id')->first();

        $dados =  $negocio->findPessoa($id, '', $parametro->relacionamento_cliente_id);

        $dados->clienteId = $id;

        unset( $parametro );
        unset( $negocio );


        return response()->json($dados);
    }

    public function retornaDados(Request $request){

        $negocio = new PessoaNegocio();
        $parametro = DB::table('conf_parametro')->select('relacionamento_cliente_id')->first();

        $documento = str_replace('-','',str_replace('.','',str_replace('/','',$request->documento)));

        $dados =  $negocio->findPessoa('', $documento, $parametro->relacionamento_cliente_id);

        unset( $parametro );
        unset( $negocio );


        return response()->json($dados);
    }

    public function remover($id){
        $mensagem = "";
        $erro = false;
        $errors = array();


        $negocio = new PessoaNegocio();
        $parametro = DB::table('conf_parametro')->select('relacionamento_cliente_id')->first();

        $negocio->removeRelacionamento($id,$parametro->relacionamento_cliente_id,Auth::user()->id);

        unset( $parametro );
        unset( $negocio );

        $mensagem="Cliente excluido com sucesso.";
        $tool = new PermissoesTools();
        $tool->regitraHistorico(Auth::user()->id, "REMOVER", "CLIENTE",$id, null);

        return response()->json( ['retorno' => $mensagem, 'erro' => $erro, 'errors' => $errors] );


    }
    public function save(Request $request ){

        $mensagem = "";
        $errors = array();
        $erro = false;

        $tipodoc = Db::table('cadastro_tipo_documento')->select('id')->where('nome','CNPJ')->first();

        //VALIDADOR PARA CNPJ

        if($tipodoc->id == $request->documentoTipo){

            $validator = Validator::make($request->all(), [

                'documentoTipo'=> 'required',
                'documento' => 'required',
                'nome' => 'required',
                'telefoneCelular'=> 'required',
                'cep'=> 'required',
                'endereco'=> 'required',
                'numero'=> 'required',
                'bairro'=> 'required',
                'cidade'=> 'required',
                'estado'=> 'required',
                'datanascimento'=> 'required',


            ]);

            if($validator->fails()){
                $errors =$validator->errors()->all();
                $erro = true;
            }

        }else{

            //VALIDADOR DIRENTE DE CNPJ

            $validator = Validator::make($request->all(), [

                'documentoTipo'=> 'required',
                'documento' => 'required',
                'nome' => 'required',
                'telefoneCelular'=> 'required',
                'cep'=> 'required',
                'endereco'=> 'required',
                'numero'=> 'required',
                'bairro'=> 'required',
                'cidade'=> 'required',
                'estado'=> 'required',
                'datanascimento'=> 'required',
                'rg'=> 'required',
                'cnhvalidade'=>'required',
                'cnh'=> 'required',
            ]);

            if($validator->fails()){
                $errors =$validator->errors()->all();
                $erro = true;
            }

            $tipodoc = Db::table('cadastro_tipo_documento')->select('id')->where('nome','CNPJ')->first();

            if( $request->categoriaCnhId == 0 ){

                array_push($errors,"O campo categoria cnh é obrigatório.");

                $erro = true;

            }

            if( !empty($request->cnh) && $request->documentoTipo == $tipodoc->id ){

                array_push($errors,"O campo número cnh é obrigatório.");

                $erro = true;

            }

            if( !empty($request->rg) && $request->documentoTipo == $tipodoc->id ){

                array_push($errors,"O campo rg é obrigatório.");

                $erro = true;

            }


        }

        if(!empty($request->documento)){
            $strDocumento = str_replace('-','',str_replace('.','',str_replace('/','',$request->documento)));
            $pessoa = Pessoa::where('documento','=', $strDocumento)->first();

            if( $pessoa != null ){

                array_push($errors, "Já existe um cliente com esse documento no sistema, tente pesquisa-lo ou espere os dados carregar ao digitar o documento no formulario de cadastro.");
                $erro = true;

            }
        }

        $negocio = new PessoaNegocio();

        if($erro == false){

            $paramentro = DB::table('conf_parametro')->select('relacionamento_cliente_id')->first();

            $tool = new PermissoesTools();

            $pessoa= new Pessoa;
            $pessoa->nome=strtoupper(trim($request->nome));
            $pessoa->documento = str_replace('-','',str_replace('.','',str_replace('/','',$request->documento)));
            $pessoa->documento_tipo_id = $request->documentoTipo;
            $pessoa->inscricao_estadual= $request->inscricaoEstadual;
            $pessoa->inscricao_municipal= $request->inscricaoMunicipal;
            $pessoa->nacionalidade=strtoupper(trim( $request->nacionalidade));
            $pessoa->naturalidade=strtoupper(trim($request->naturalidade));
            $pessoa->classificacao_id=$request->classificacaoPessoaId;

            if(!empty($request->datanascimento)){

                $pessoa->data_nascimento = date('Y/m/d',strtotime(str_replace('/', '-',$request->datanascimento)));

            }else{

                $pessoa->data_nascimento = null;
            }

            $pessoa->nome_mae = strtoupper(trim($request->nomeMae));
            $pessoa->nome_pai = strtoupper(trim($request->nomePai));
            $pessoa->observacao = strtoupper(trim($request->observacao));
            $pessoa->profissao = strtoupper(trim($request->profissao));
            $pessoa->rg= $request->rg;

            if(!empty($request->rgdataexpedicao)){

                $pessoa->rg_data_expedicao = date('Y/m/d',strtotime(str_replace('/', '-',$request->rgdataexpedicao)));

            }else{

                $pessoa->rg_data_expedicao = null;
            }

            $pessoa->rg_orgao_expedidor=strtoupper(trim($request->rgOrgaoExpedidor));
            $pessoa->razao_social= strtoupper(trim($request->razaoSocial));
            $pessoa->sexo = $request->sexo;
            $pessoa->cnh=$request->cnh;
            if($request->estadoCivilId >0){

                $pessoa->estado_civil_id= $request->estadoCivilId;

            }else{

                $pessoa->estado_civil_id= null;

            }
            if($request->categoriaCnhId >0){

                $pessoa->cnh_categoria_id= $request->categoriaCnhId;

            }else{

                $pessoa->cnh_categoria_id= null;

            }

            if(!empty($request->cnhvalidade)){

                $pessoa->cnh_validade = date('Y/m/d',strtotime(str_replace('/', '-',$request->cnhvalidade)));

            }

            $pessoa->email = strtoupper(trim($request->email));
            $pessoa->foto_perfil = $this->getImagem($request);
            $pessoa->usuario_gravou_id= Auth::user()->id;
            $pessoa->save();



            $tool->regitraHistorico(Auth::user()->id,"SAVE","CLIENTE",$pessoa, null);

            if(!empty($request->observacao)){

                $observacao= new Observacao;
                $observacao->observacao = strtoupper($request->observacao);
                $observacao->usuario_gravou_id = Auth::user()->id;
                $observacao->cliente_id = $pessoa->id;
                $observacao->save();

            }

            $negocio->verificaRelacionamento($pessoa->id,$paramentro->relacionamento_cliente_id,Auth::user()->id);

            $pessoaEndereco= new PessoaEndereco;
            $pessoaEndereco->endereco_endereco = strtoupper(trim($request->endereco));
            $pessoaEndereco->endereco_numero = $request->numero;
            $pessoaEndereco->tipo_relacionamento_id=$paramentro->relacionamento_cliente_id;
            $pessoaEndereco->endereco_complemento = strtoupper(trim($request->complemento));
            $pessoaEndereco->endereco_bairro = strtoupper(trim($request->bairro));
            $pessoaEndereco->endereco_cidade = strtoupper(trim($request->cidade));
            $pessoaEndereco->endereco_estado = strtoupper(trim($request->estado));
            $pessoaEndereco->endereco_cep =  str_replace('-','',$request->cep);
            $pessoaEndereco->pessoa_id = $pessoa->id;
            $pessoaEndereco->usuario_gravou_id= Auth::user()->id;
            $pessoaEndereco->save();

            $tool->regitraHistorico(Auth::user()->id,"SAVE","CLIENTEENDERECO",$pessoaEndereco,null);

            $pessoaTelefone= new PessoaTelefone;
            $pessoaTelefone->tipo_relacionamento_id=$paramentro->relacionamento_cliente_id;
            $pessoaTelefone->usuario_gravou_id= Auth::user()->id;
            $pessoaTelefone->telefone=str_replace('(','',str_replace(')','',str_replace('-','',str_replace(' ', '',$request->telefoneFixo))));
            $pessoaTelefone->telefone_tipo='FIXO';
            $pessoaTelefone->pessoa_id=$pessoa->id;
            $pessoaTelefone->save();

            $tool->regitraHistorico(Auth::user()->id,"SAVE","CLIENTETELEFONE",$pessoaTelefone, null);

            $pessoaTelefone= new PessoaTelefone;
            $pessoaTelefone->tipo_relacionamento_id=$paramentro->relacionamento_cliente_id;
            $pessoaTelefone->usuario_gravou_id= Auth::user()->id;
            $pessoaTelefone->telefone=str_replace('(','',str_replace(')','',str_replace('-','',str_replace(' ', '',$request->telefoneCelular))));
            $pessoaTelefone->telefone_tipo='CELULAR';
            $pessoaTelefone->pessoa_id=$pessoa->id;
            $pessoaTelefone->save();

            $tool->regitraHistorico(Auth::user()->id,"SAVE","CLIENTETELEFONE",$pessoaTelefone, null);


            unset( $pessoaTelefone );
            unset( $pessoaEndereco );
            unset( $tool );
            unset( $paramentro );

            $mensagem="CLIENTE cadastrado com sucesso.";

        }
        unset( $negocio );

        if(!empty($pessoa->id) ){

            return response()->json( ['retorno' => $mensagem, 'erro' => $erro, 'errors' => $errors, 'clienteId' => $pessoa->id] );

        }else{

            return response()->json( ['retorno' => $mensagem, 'erro' => $erro, 'errors' => $errors] );

        }

    }

    public function update(Request $request){
        $mensagem = "";
        $erro = false;
        $errors = array();

        $tipodoc = Db::table('cadastro_tipo_documento')->select('id')->where('nome','CNPJ')->first();

        //VALIDADOR DIRENTE DE CNPJ

        if($tipodoc->id == $request->documentoTipo){

            $validator = Validator::make($request->all(), [

                'documentoTipo'=> 'required',
                'documento' => 'required',
                'nome' => 'required',
                'telefoneFixo'=> 'required',
                'telefoneCelular'=> 'required',
                'cep'=> 'required',
                'endereco'=> 'required',
                'numero'=> 'required',
                'bairro'=> 'required',
                'cidade'=> 'required',
                'estado'=> 'required',
                'datanascimento'=> 'required',
            ]);

            if($validator->fails()){
                $errors =$validator->errors()->all();
                $erro = true;
            }

        }else{

            //VALIDADOR DIRENTE DE CPF

            $validator = Validator::make($request->all(), [

                'documentoTipo'=> 'required',
                'documento' => 'required',
                'nome' => 'required',
                'telefoneFixo'=> 'required',
                'telefoneCelular'=> 'required',
                'cep'=> 'required',
                'endereco'=> 'required',
                'numero'=> 'required',
                'bairro'=> 'required',
                'cidade'=> 'required',
                'estado'=> 'required',
                'datanascimento'=> 'required',
                'rg'=> 'required',
                'cnhvalidade'=>'required',
                'cnh'=> 'required',
            ]);

            if($validator->fails()){
                $errors =$validator->errors()->all();
                $erro = true;
            }

            $tipodoc = Db::table('cadastro_tipo_documento')->select('id')->where('nome','CNPJ')->first();

            if( $request->categoriaCnhId == 0 ){

                array_push($errors,"O campo categoria cnh é obrigatório.");

                $erro = true;

            }

            if( !empty($request->cnh) && $request->documentoTipo == $tipodoc->id ){

                array_push($errors,"O campo número cnh é obrigatório.");

                $erro = true;

            }

            if( !empty($request->rg) && $request->documentoTipo == $tipodoc->id ){

                array_push($errors,"O campo rg é obrigatório.");

                $erro = true;

            }
        }

        $paramentro = DB::table('conf_parametro')->select('relacionamento_cliente_id')->first();

        if( $erro == false ){
            $pessoa = Pessoa::find( $request->id );

            $tool = new PermissoesTools();
            $negocio = new PessoaNegocio();

            if($pessoa != null){

                $pessoa->nome = strtoupper(trim($request->nome));
                $pessoa->documento = str_replace('-','',str_replace('.','',str_replace('/','',$request->documento)));
                $pessoa->documento_tipo_id = $request->documentoTipo;
                $pessoa->inscricao_estadual = $request->inscricaoEstadual;
                $pessoa->inscricao_municipal = $request->inscricaoMunicipal;
                $pessoa->nacionalidade = strtoupper(trim( $request->nacionalidade));
                $pessoa->naturalidade = strtoupper(trim($request->naturalidade));
                $pessoa->classificacao_id = $request->classificacaoPessoaId;

                if($request->estadoCivilId >0){

                    $pessoa->estado_civil_id= $request->estadoCivilId;

                }else{

                    $pessoa->estado_civil_id= null;

                }
                if(!empty($request->datanascimento)){

                    $pessoa->data_nascimento = date('Y/m/d',strtotime(str_replace('/', '-',$request->datanascimento)));

                }else{

                    $pessoa->data_nascimento = null;

                }

                $pessoa->nome_mae = strtoupper(trim($request->nomeMae));
                $pessoa->nome_pai = strtoupper(trim($request->nomePai));
                $pessoa->observacao = strtoupper(trim($request->observacao));
                $pessoa->profissao = strtoupper(trim($request->profissao));
                $pessoa->rg = $request->rg;

                if(!empty($request->rgdataexpedicao)){

                    $pessoa->rg_data_expedicao = date('Y/m/d',strtotime(str_replace('/', '-',$request->rgdataexpedicao)));

                }else{

                    $pessoa->rg_data_expedicao = null;

                }

                $pessoa->rg_orgao_expedidor = strtoupper(trim($request->rgOrgaoExpedidor));
                $pessoa->razao_social = strtoupper(trim($request->razaoSocial));
                $pessoa->sexo = $request->sexo;
                $pessoa->cnh = $request->cnh;
                $pessoa->cnh_categoria_id = $request->categoriaCnhId;

                if(!empty($request->cnhvalidade)){

                    $pessoa->cnh_validade = date('Y/m/d',strtotime(str_replace('/', '-',$request->cnhvalidade)));

                }else{

                    $pessoa->rg_data_expedicao = null;

                }

                $pessoa->foto_perfil = $this->getImagem($request);
                $pessoa->email =strtoupper(trim($request->email));
                $pessoa->save();
                $negocio->verificaRelacionamento($pessoa->id,$paramentro->relacionamento_cliente_id,Auth::user()->id);
                $tool->regitraHistorico(Auth::user()->id, "UPDATE", "CLIENTE",$pessoa, null);

                $pessoaEndereco = PessoaEndereco::where('tipo_relacionamento_id', $paramentro->relacionamento_cliente_id)->where('pessoa_id',$pessoa->id)->first();

                if($pessoaEndereco == null){

                    $pessoaEndereco = new PessoaEndereco();
                    $pessoaEndereco->tipo_relacionamento_id=$paramentro->relacionamento_cliente_id;
                    $pessoaEndereco->usuario_gravou_id= Auth::user()->id;

                }

                $pessoaEndereco->endereco_endereco = strtoupper(trim($request->endereco));
                $pessoaEndereco->endereco_numero = $request->numero;
                $pessoaEndereco->endereco_complemento = strtoupper(trim($request->complemento));
                $pessoaEndereco->endereco_bairro = strtoupper(trim($request->bairro));
                $pessoaEndereco->endereco_cidade = strtoupper(trim($request->cidade));
                $pessoaEndereco->endereco_estado = strtoupper(trim($request->estado));
                $pessoaEndereco->endereco_cep =  str_replace('-','',$request->cep);
                $pessoaEndereco->pessoa_id = $pessoa->id;

                $pessoaEndereco->save();
                $tool->regitraHistorico(Auth::user()->id, "UPDATE", "CLIENTEENDERECO",$pessoaEndereco, null);


                $telefoneFixo = str_replace('(','',str_replace(')','',str_replace('-','',$request->telefoneFixo)));

                $pessoaTelefone= PessoaTelefone::where('tipo_relacionamento_id', $paramentro->relacionamento_cliente_id)
                    ->where('pessoa_id',$pessoa->id)
                    ->where('telefone_tipo','=','FIXO')
                    ->where('telefone', '!=', $telefoneFixo )
                    ->first();

                if($pessoaTelefone != null){

                    $pessoaTelefone->delete();
                    $pessoaTelefone= new PessoaTelefone();
                    $pessoaTelefone->tipo_relacionamento_id = $paramentro->relacionamento_cliente_id;
                    $pessoaTelefone->usuario_gravou_id = Auth::user()->id;
                    $pessoaTelefone->telefone=$telefoneFixo;
                    $pessoaTelefone->telefone_tipo='FIXO';
                    $pessoaTelefone->pessoa_id=$pessoa->id;
                    $pessoaTelefone->save();
                }

                $telefoneCelular = str_replace('(','',str_replace(')','',str_replace('-','',$request->telefoneCelular )));

                $pessoaTelefone = PessoaTelefone::where('tipo_relacionamento_id',$paramentro->relacionamento_cliente_id)
                    ->where('pessoa_id',$pessoa->id)
                    ->where('telefone_tipo','=','CELULAR')
                    ->where('telefone', '!=',$telefoneCelular)
                    ->first();

                if($pessoaTelefone != null){

                    $pessoaTelefone->delete();
                    $pessoaTelefone= new PessoaTelefone();
                    $pessoaTelefone->tipo_relacionamento_id=$paramentro->relacionamento_cliente_id;;
                    $pessoaTelefone->usuario_gravou_id = Auth::user()->id;
                    $pessoaTelefone->telefone=$telefoneCelular;
                    $pessoaTelefone->telefone_tipo='CELULAR';
                    $pessoaTelefone->pessoa_id=$pessoa->id;
                    $pessoaTelefone->save();
                }

                $mensagem="CLIENTE alterado com sucesso.";

            }

        }
        return response()->json( ['retorno' => $mensagem, 'erro' => $erro, 'errors' => $errors, 'clienteId' =>  $request->id ] );
    }

    public function anexo(Request $request){
        $mensagem = "";
        $errors = array();
        $erro = false;

        $validator = Validator::make($request->all(), [



        ]);

        if($validator->fails()){

            $errors =$validator->errors()->all();
            $erro = true;

        }

        if(empty($request->files)){

            array_push($errors,"O anexo é obrigatório.");

            $erro = true;

        }

        if($erro == false){

            $anexo = new AnexoNegocio();

            $anexoCliente = $anexo->anexo($request);

            $mensagem = " Cadastrado com sucesso.";

        }
        return response()->json( ['retorno' => $mensagem, 'erro' => $erro, 'errors' => $errors] );

    }

    public function visualizarAnexo($id){

        $dados = DB::table('conf_anexo')
            ->select('id',
                DB::raw("to_char(conf_anexo.data_cadastro,'DD/MM/YYYY') as datacadastro"),
                'nome',
                'nome_anexo as docNome')
            ->where('pessoa_id',$id)
            ->whereNull('data_exclusao')->get();

        return response()->json($dados);

    }

    public function removerAnexo($id){

        $mensagem = "";
        $erro = false;
        $errors = array();
        $anexo= Anexo::find( $id );

        if($anexo != null){

            $anexo->usuario_excluiu_id= Auth::user()->id;
            $anexo->data_exclusao=date("Y/m/d H:i:s ");
            $anexo->save();
            $mensagem="Anexo excluido com sucesso.";
            $tool = new PermissoesTools();
            $tool->regitraHistorico(Auth::user()->id, "REMOVER", "ANEXO",$anexo, null);

        }else{
            array_push($errors, "Registro nao localizado");
            $erro=true;

        }
        return response()->json( ['retorno' => $mensagem, 'erro' => $erro, 'errors' => $errors] );
    }
    public function anexoDownload( Request $request,  $id ){

        if( $id > 0 ){
            $doc = Anexo::where('id','=',  $id   )->first();
            if( $doc != null ){
                ob_clean();
                flush();
                $documento = stream_get_contents( $doc->anexo, -1);
                return response($documento)
                    ->header('Cache-Control', 'no-cache private')
                    ->header('Content-Description', 'File Transfer')
                    ->header('Content-Type', "application/doc")
                    ->header('Content-length', strlen($documento))
                    ->header('Content-Disposition', 'attachment; filename=' . str_replace(" ","_", $doc->nome_anexo))
                    ->header('Content-Transfer-Encoding', 'binary');
                unset( $documento );
                unset( $doc );

            }else {
                return "";
            }
        }else {
            return "";
        }

    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */

}
