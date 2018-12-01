<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Semestre;

class SemestreController extends Controller
{
    function index(Request $request){
    	if($request->get("id") == null){
    		$semestre = new Semestre();
    	}else {
    		$semestre  = Semestre::Where('id', $request->get("id"))->first();//Chamando metodo statico cliente where semelhante ao select, fazendo busca no banco, onde request traz o resultado do banco, o first garante que pega da colection somente primeiro objeto semelhante limite 1

    	}
    	return view('semestres.cadastro', array('semestres' => $semestre ));
        //como chamar um arquivo dentro de uma pasta
        //categorias é o objeto, categoria nome da classe
    }

    function listar(){
    	return view('semestres.lista', array('semestres'=> Semestre::All()));
        //como chamar um arquivo dentro de uma pasta
    	//nao precisa da chamada da pasta app pq ja foi chamada
    }

    function salvar(Request $request){//Framework de requisição http
    //var_dump($request->all());//Serve para mostrar os arquivo enviados pelo submit

    $dataT = $request->get('fimSemestre');

    $validatedData = $request->validate([
            "nomeS" => "required|max:100",
            "inicioSemestre" => "required|before:$dataT",
            "fimSemestre" => "required",
    ], [
            'required' => 'O campo :attribute é obrigatório',
    ]);
            
    if($request->get('id') == null){
        $semestre  = new Semestre();
    }else{
        $semestre  = Semestre::Where('id', $request->get('id'))->first();
        // SELECT * FROM chamado WHERE id = $_GET['id'] LIMIT 1
    }
    //pegando os valores e colocando dentro do objetos
    $semestre ->nomeS = $request->get('nomeS');
    $semestre ->inicioSemestre = $request->get('inicioSemestre');
    $semestre ->fimSemestre = $request->get('fimSemestre');

    $semestre ->save();//Salvando objeto

    return $this->listar();

    }

    function excluir(Request $request){

        if($request->get('id') != null){
            $semestre  = Semestre::Where('id', $request->get('id'))->first();
            $semestre ->delete();
            return $this->listar();
        }
    }
}
