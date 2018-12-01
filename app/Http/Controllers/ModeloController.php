<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Modelo;
use Carbon\Carbon;
use Carbon\CarbonInterval;
use App\Supervisor_Modelo;
use DB;

use Illuminate\Support\Facades\Auth;

class ModeloController extends Controller
{
    function index(Request $request){
    	if($request->get("id") == null){
    		$modelo = new Modelo();
    	}else {
    		$modelo  = Modelo::Where('id', $request->get("id"))->first();//Chamando metodo statico cliente where semelhante ao select, fazendo busca no banco, onde request traz o resultado do banco, o first garante que pega da colection somente primeiro objeto semelhante limite 1

    	}

    	return view('modelos.cadastro', array('modelos' => $modelo));
        //como chamar um arquivo dentro de uma pasta
        //categorias é o objeto, categoria nome da classe
    }

    function listar(){
    	return view('modelos.lista', array('modelos'=> Modelo::All()->sortBy("nomeM")));
        //como chamar um arquivo dentro de uma pasta
    	//nao precisa da chamada da pasta app pq ja foi chamada
    }

    function salvar(Request $request){//Framework de requisição http
    //var_dump($request->all());//Serve para mostrar os arquivo enviados pelo submit

    date_default_timezone_set("Brazil/East");

    $agora = Carbon::now();

    $validatedData = $request->validate([
            "nomeM" => "required|max:100",
    ], [
            'required' => 'O campo :attribute é obrigatório',
        ]);
            
    if($request->get('id') == null){
        $modelo  = new Modelo();
    }else{
        $modelo  = Modelo::Where('id', $request->get('id'))->first();
        // SELECT * FROM chamado WHERE id = $_GET['id'] LIMIT 1
    }
    //pegando os valores e colocando dentro do objetos
    $modelo ->nomeM = $request->get('nomeM');
    $modelo ->dataCriacao = $agora;

    $modelo ->save();//Salvando objeto


    return $this->listar();

    }

    function excluir(Request $request){

        if($request->get('id') != null){
            $modelo  = Modelo::Where('id', $request->get('id'))->first();
            $modelo ->delete();
            return $this->listar();
        }
    }
}
