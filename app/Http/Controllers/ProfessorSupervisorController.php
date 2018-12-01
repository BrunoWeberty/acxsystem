<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Supervisor;
use App\Instituicao;
use App\Aluno;
use App\Aluno_Certificado;
use Illuminate\Support\Facades\Hash;
use DB;

class ProfessorSupervisorController extends Controller
{
    function index(Request $request){
        if($request->get("id") == null){
            $professor_supervisor = new Supervisor();
        }else {
            $professor_supervisor  = Supervisor::Where('id', $request->get("id"))->first();//Chamando metodo statico cliente where semelhante ao select, fazendo busca no banco, onde request traz o resultado do banco, o first garante que pega da colection somente primeiro objeto semelhante limite 1

        }
        return view('supervisores.cadastro', array('supervisores' => $professor_supervisor, 'instituicoes' => Instituicao::All() ));
        //como chamar um arquivo dentro de uma pasta
        //categorias é o objeto, categoria nome da classe
    }

    function listar(){

        $dados = DB::table('supervisores')
            ->join("instituicao", "instituicao.id","=","supervisores.instituicao_id")
            ->select("supervisores.*", "instituicao.nome")->get();

        return view('supervisores.lista', array('supervisores'=>$dados));
    }

    function listarAluno(){
        //Lista os aluno que ainda não atingiram 75 das horas e receberam aprovação do professor supervisor
        $dados = DB::select('SELECT a.name, a.id FROM alunos as a INNER JOIN aluno_certificado as ac on ac.aluno_id = a.id WHERE a.statusHorasComplementares = 0 GROUP BY a.name, a.id');

        
        return view('supervisores.listaAluno', array('alunos'=>$dados));
    }

    function listarAlunoAprovados(){
        //Lista os aluno que ainda não atingiram 75 das horas e receberam aprovação do professor supervisor
        $dados = DB::select('SELECT a.name, a.id, a.matricula FROM alunos as a INNER JOIN aluno_certificado as ac on ac.aluno_id = a.id WHERE a.statusHorasComplementares = 1 GROUP BY a.name, a.id');

        
        return view('supervisores.listaAlunoAp', array('alunos'=>$dados));
    }


    function salvar(Request $request){//Framework de requisição http
    //var_dump($request->all());//Serve para mostrar os arquivo enviados pelo submit

    $validatedData = $request->validate([          
            'name' => 'required|string|max:100',
            "matricula" => "required|max:100",
            'email' => 'required|string|email|max:100',
            'password' => 'required|string|min:6',
            "remember_token" => "required",
            "instituicao_id" => "required",
            
    ], [
            'required' => 'O campo :attribute é obrigatório',
    ]);
            
    if($request->get('id') == null){
        $professor_supervisor  = new Supervisor();
    }else{
        $professor_supervisor  = Supervisor::Where('id', $request->get('id'))->first();
        // SELECT * FROM chamado WHERE id = $_GET['id'] LIMIT 1
    }
    //pegando os valores e colocando dentro do objetos
    $professor_supervisor ->name = $request->get('name');
    $professor_supervisor ->matricula = $request->get('matricula');
    $professor_supervisor ->email = $request->get('email');

    $professor_supervisor->password = Hash::make($request->get('password'));
    $professor_supervisor->remember_token = $request->get('remember_token');
    $professor_supervisor ->instituicao_id = $request->get('instituicao_id');

    $professor_supervisor ->save();//Salvando objeto

    return $this->listar();

    }

    function excluir(Request $request){

        if($request->get('id') != null){
            $professor_supervisor  = Supervisor::Where('id', $request->get('id'))->first();
            $professor_supervisor ->delete();
            return $this->listar();
        }
    }

    function listarCertificados(Request $request){


        session(['id_aluno_listar' => $request->get('id')]);
        
        $aluno_id = $request->get('id');

        if($aluno_id != null){

        $dados = DB::select('
                SELECT * FROM certificado AS c JOIN aluno_certificado as ac on c.id = ac.certificado_id join alunos as a on a.id = ac.aluno_id AND a.id ='.$aluno_id.'');

        //retorna total de horas que foram aprovadas
        $totalHoras = DB::select('
            SELECT sum(c.horaAceita) as totalHoras FROM certificado AS c JOIN aluno_certificado as ac on c.id = ac.certificado_id join alunos as a on a.id = ac.aluno_id JOIN categoria as cat on c.categoria_id = cat.id AND ac.status = 1 AND a.id ='.$aluno_id);
        
        //total de horas por curso
        $totalHorasAtingir = DB::select('
           SELECT totalHora as totalHorasAtingir FROM `turma` WHERE id = (SELECT turma_id FROM `alunos` WHERE id ='.$aluno_id.')');

        //total de horas externas aprovadas
        $totalHorasExternas = DB::select('
            SELECT sum(c.horaAceita) as totalHorasExternas FROM certificado AS c JOIN aluno_certificado as ac on c.id = ac.certificado_id join alunos as a on a.id = ac.aluno_id JOIN categoria as cat on c.categoria_id = cat.id AND ac.status = 1 AND instituicao = 1 AND a.id ='.$aluno_id);

        //total de horas externas esperadas
        $totalHorasAtingirExternas = DB::select('
            SELECT CAST(SUM(totalHora* 0.2) AS DECIMAL(10,2)) as totalHorasAtingirExternas FROM `turma`
        WHERE id = (SELECT turma_id FROM `alunos` WHERE id = '.$aluno_id.')');

        //total de horas internas aprovadas
        $totalHorasInternas = DB::select('
            SELECT sum(c.horaAceita) as totalHorasInternas FROM certificado AS c JOIN aluno_certificado as ac on c.id = ac.certificado_id join alunos as a on a.id = ac.aluno_id JOIN categoria as cat on c.categoria_id = cat.id AND ac.status = 1 AND instituicao = 2 AND a.id ='.$aluno_id);

        //total de horas internas esperadas
        $totalHorasAtingirInternas = DB::select('
            SELECT CAST(SUM(totalHora* 0.3) AS DECIMAL(10,2)) as totalHorasAtingirInternas FROM `turma`
        WHERE id = (SELECT turma_id FROM `alunos` WHERE id = '.$aluno_id.')');

        //total de horas externas aprovadas
        $totalHorasExternas = DB::select('
            SELECT sum(c.horaAceita) as totalHorasExternas FROM certificado AS c JOIN aluno_certificado as ac on c.id = ac.certificado_id join alunos as a on a.id = ac.aluno_id JOIN categoria as cat on c.categoria_id = cat.id AND ac.status = 1 AND instituicao = 1 AND a.id ='.$aluno_id);

        //total de horas externas esperadas
        $totalHorasAtingirExternas = DB::select('
            SELECT CAST(SUM(totalHora* 0.2) AS DECIMAL(10,2)) as totalHorasAtingirExternas FROM `turma`
        WHERE id = (SELECT turma_id FROM `alunos` WHERE id = '.$aluno_id.')');

        //total de horas internas aprovadas
        $totalHorasInternas = DB::select('
            SELECT sum(c.horaAceita) as totalHorasInternas FROM certificado AS c JOIN aluno_certificado as ac on c.id = ac.certificado_id join alunos as a on a.id = ac.aluno_id JOIN categoria as cat on c.categoria_id = cat.id AND ac.status = 1 AND instituicao = 2 AND a.id ='.$aluno_id);

        //total de horas internas esperadas
        $totalHorasAtingirInternas = DB::select('
            SELECT CAST(SUM(totalHora* 0.3) AS DECIMAL(10,2)) as totalHorasAtingirInternas FROM `turma`
        WHERE id = (SELECT turma_id FROM `alunos` WHERE id = '.$aluno_id.')');

        return view('supervisores.listaCertificados', array('certificados'=>$dados), ['totalHoras' => $totalHoras, 'totalHorasExternas' =>$totalHorasExternas, 'totalHorasAtingirExternas' => $totalHorasAtingirExternas,'totalHorasInternas' => $totalHorasInternas, 'totalHorasAtingirInternas' => $totalHorasAtingirInternas,'totalHorasAtingir' => $totalHorasAtingir]);
        }else{//se o sistema perde referencia do aluno ele volta pra lista de alunos
            $dados = DB::select('SELECT a.name, a.id FROM alunos as a INNER JOIN aluno_certificado as ac on ac.aluno_id = a.id GROUP BY a.name, a.id');

        
            return view('supervisores.listaAluno', array('alunos'=>$dados));
        }
    }


}
