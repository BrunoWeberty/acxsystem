<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Categoria;
use App\Modalidade;
use App\Turma;
use DB;

class CategoriaController extends Controller
{
    function index(Request $request){
    	if($request->get("id") == null){
    		$categoria = new Categoria();
    	}else {
    		$categoria  = Categoria::Where('id', $request->get("id"))->first();//Chamando metodo statico cliente where semelhante ao select, fazendo busca no banco, onde request traz o resultado do banco, o first garante que pega da colection somente primeiro objeto semelhante limite 1

    	}
    	return view('categorias.cadastro', array('categorias' => $categoria, 
    		'modalidades' => Modalidade::All()));
        //como chamar um arquivo dentro de uma pasta
        //categorias é o objeto, categoria nome da classe
    }

    function listar(){
    	$dados = DB::table('categoria')
            ->join("modalidades", "modalidades.id","=","categoria.modalidade_id")
            ->select("categoria.*", "modalidades.name")->get();

        return view('categorias.lista', array('categorias'=>$dados));
    }

    function salvar(Request $request){//Framework de requisição http
    //var_dump($request->all());//Serve para mostrar os arquivo enviados pelo submit

    $validatedData = $request->validate([
            "nome" => "required|max:100",
            "descricao" => "required|max:300",
            "limiteChs" => "required",
            "observacoes" => "required|max:400",
            "modalidade_id" => "required",
    ], [
            'required' => 'O campo :attribute é obrigatório',
    ]);
            
    if($request->get('id') == null){
        $categoria  = new Categoria();
    }else{
        $categoria  = Categoria::Where('id', $request->get('id'))->first();
        // SELECT * FROM chamado WHERE id = $_GET['id'] LIMIT 1
    }
    //pegando os valores e colocando dentro do objetos
    $categoria ->nome = $request->get('nome');
    $categoria ->descricao = $request->get('descricao');
    $categoria ->limiteChs = $request->get('limiteChs');

    if($request->get('limiteCertificados') == null){
        $categoria ->limiteCertificados = 100;
    }else {
        $categoria ->limiteCertificados = $request->get('limiteCertificados');
    }

    
    $categoria ->observacoes = $request->get('observacoes');
    $categoria ->modalidade_id = $request->get('modalidade_id');

    $categoria ->save();//Salvando objeto

    return $this->listar();

    }

    function excluir(Request $request){

        if($request->get('id') != null){
            $categoria  = Categoria::Where('id', $request->get('id'))->first();
            $categoria ->delete();
            return $this->listar();
        }
    }
}
