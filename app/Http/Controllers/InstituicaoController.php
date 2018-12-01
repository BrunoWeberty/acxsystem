<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Instituicao;

class InstituicaoController extends Controller
{
    function index(Request $request){
    	if($request->get("id") == null){
    		$instituicao = new Instituicao();
    	}else {
    		$instituicao  = Instituicao::Where('id', $request->get("id"))->first();//Chamando metodo statico cliente where semelhante ao select, fazendo busca no banco, onde request traz o resultado do banco, o first garante que pega da colection somente primeiro objeto semelhante limite 1

    	}
    	return view('instituicoes.cadastro', array('instituicoes' => $instituicao ));
        //como chamar um arquivo dentro de uma pasta
        //categorias é o objeto, categoria nome da classe
    }

    function listar(){
    	return view('instituicoes.lista', array('instituicoes'=> Instituicao::All()->sortBy("nome")));
        //como chamar um arquivo dentro de uma pasta
    	//nao precisa da chamada da pasta app pq ja foi chamada
    }

    function salvar(Request $request){//Framework de requisição http
    //var_dump($request->all());//Serve para mostrar os arquivo enviados pelo submit

    $validatedData = $request->validate([
            "nome" => "required|max:100",
            "localidade" => "required|max:100",
        ], [
            'required' => 'O campo :attribute é obrigatório',
        ]);
            
    if($request->get('id') == null){
        $instituicao  = new Instituicao();
    }else{
        $instituicao  = Instituicao::Where('id', $request->get('id'))->first();
        // SELECT * FROM chamado WHERE id = $_GET['id'] LIMIT 1
    }
    //pegando os valores e colocando dentro do objetos
    $instituicao ->nome = $request->get('nome');
    $instituicao ->localidade = $request->get('localidade');

    $instituicao ->save();//Salvando objeto

    return $this->listar();

    }

    function excluir(Request $request){

        if($request->get('id') != null){
            $instituicao  = Instituicao::Where('id', $request->get('id'))->first();
            $instituicao ->delete();
            return $this->listar();
        }else{
            return $this->listar();
        }
    }
}
