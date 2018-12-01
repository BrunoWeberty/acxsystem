<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Modalidade;
use App\Modelo;
use App\ModeloModalidade;
use DB;

class ModalidadesController extends Controller
{
    function index(Request $request){
    	if($request->get("id") == null){
    		$modalidade = new Modalidade();
    	}else {
    		$modalidade = Modalidade::Where('id', $request->get("id"))->first();//Chamando metodo statico cliente where semelhante ao select, fazendo busca no banco, onde request traz o resultado do banco, o first garante que pega da colection somente primeiro objeto semelhante limite 1

    	}
    	return view('modalidades.cadastro', array('modalidades' => $modalidade, 'modelos' => Modelo::All()));
        //como chamar um arquivo dentro de uma pasta
        //categorias é o objeto, categoria nome da classe
    }

    function listar(){
    	return view('modalidades.lista', array('modalidades'=> Modalidade::All()->sortBy("name")));
        //como chamar um arquivo dentro de uma pasta
    	//nao precisa da chamada da pasta app pq ja foi chamada
    }

    function salvar(Request $request){//Framework de requisição http
    //var_dump($request->all());//Serve para mostrar os arquivo enviados pelo submit

    $validatedData = $request->validate([
            "name" => "required|max:100",
            "modelo_id" => "required",
        ], [
            'required' => 'O campo :attribute é obrigatório',
        ]);
            
    if($request->get('id') == null){
        $modalidade = new Modalidade();
    }else{
        $modalidade = Modalidade::Where('id', $request->get('id'))->first();
        // SELECT * FROM chamado WHERE id = $_GET['id'] LIMIT 1
    }

    $modalidade->name = $request->get('name');//pegando os valores e colocando dentro do objetos
    $modalidade->modelo_id = $request->get('modelo_id');

    $modalidade->save();//Salvando objeto

    $modelo_modalidade = new ModeloModalidade();
    $modelo_modalidade->modalidade_id = Modalidade::max('id');

    $modelo_modalidade->modelo_id = $request->get('modelo_id');

    $modelo_modalidade->save();

    return $this->listar();

    }

    function excluir(Request $request){

        if($request->get('id') != null){
            $modalidade = Modalidade::Where('id', $request->get('id'))->first();
            $modalidade->delete();
            return $this->listar();
        }
    }
}
