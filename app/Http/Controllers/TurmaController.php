<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Turma;
use App\Instituicao;
use App\Supervisor;
use App\Modelo;
use DB;

class TurmaController extends Controller
{
    function index(Request $request){
        if($request->get("id") == null){
            $turma = new Turma();
        }else {
            $turma  = Turma::Where('id', $request->get("id"))->first();//Chamando metodo statico cliente where semelhante ao select, fazendo busca no banco, onde request traz o resultado do banco, o first garante que pega da colection somente primeiro objeto semelhante limite 1

        }
        return view('turmas.cadastro', array('turmas' => $turma, 'instituicoes' => Instituicao::All(), 'supervisores' => Supervisor::All(), 'modelos' => Modelo::All()));
        //como chamar um arquivo dentro de uma pasta
        //categorias é o objeto, categoria nome da classe
    }

    function listar(){
        $dados = DB::table('turma')
            ->join("instituicao", "instituicao.id","=","turma.instituicao_id")
            ->join("supervisores", "supervisores.id","=", "turma.supervisor_id")
            ->join("modelo", "modelo.id","=", "turma.modelo_id")
            ->select("turma.*", "instituicao.nome", "supervisores.name", "modelo.nomeM")->get();

        return view('turmas.lista', array('turmas'=>$dados));
    }

    function salvar(Request $request){//Framework de requisição http
    //var_dump($request->all());//Serve para mostrar os arquivo enviados pelo submit

    $validatedData = $request->validate([          
            'nameT' => 'required|string|max:100',
            "curso" => "required|max:100",
            "codigo" => "required|max:100",
            "totalHora" => "required|max:100",
            "instituicao_id" => "required",            
    ], [
            'required' => 'O campo :attribute é obrigatório',
        ]);
            
    if($request->get('id') == null){
        $turma  = new Turma();
    }else{
        $turma  = Turma::Where('id', $request->get('id'))->first();
        // SELECT * FROM chamado WHERE id = $_GET['id'] LIMIT 1
    }
    //pegando os valores e colocando dentro do objetos
    $turma ->nameT = $request->get('nameT');
    $turma ->curso = $request->get('curso');
    $turma ->codigo = $request->get('codigo');
    $turma ->totalHora = $request->get('totalHora');
    $turma ->instituicao_id = $request->get('instituicao_id');
    //arrumar uma forma de pegar o login do professor logado
    $turma ->supervisor_id = session()->get('id_supervisor');
    $turma ->modelo_id = $request->get('modelo_id');

    $turma ->save();//Salvando objeto

    return $this->listar();

    }

    function excluir(Request $request){

        if($request->get('id') != null){
            $turma  = Turma::Where('id', $request->get('id'))->first();
            $turma ->delete();
            return $this->listar();
        }
    }
}
