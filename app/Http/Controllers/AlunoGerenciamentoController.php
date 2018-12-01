<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Aluno;
use App\Instituicao;
use App\Turma;

use Illuminate\Support\Facades\Hash;
use DB;

class AlunoGerenciamentoController extends Controller
{
    function index(Request $request){
        if($request->get("id") == null){
            $aluno = new Aluno();
        }else {
            $aluno  = Aluno::Where('id', $request->get("id"))->first();//Chamando metodo statico cliente where semelhante ao select, fazendo busca no banco, onde request traz o resultado do banco, o first garante que pega da colection somente primeiro objeto semelhante limite 1

        }
        return view('alunos.cadastro', array('alunos' => $aluno, 'instituicoes' => Instituicao::All(), 'turmas' => Turma::All()));
        //como chamar um arquivo dentro de uma pasta
        //categorias é o objeto, categoria nome da classe
    }

    function listar(){
        $dados = DB::table('alunos')
            ->join("instituicao", "instituicao.id","=","alunos.instituicao_id")
            ->join("turma", "turma.id","=", "alunos.turma_id")
            ->select("alunos.*", "instituicao.nome", "turma.nameT")->get();

        return view('alunos.lista', array('alunos'=>$dados));
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
            "turma_id" => "required",
            
    ], [
            'required' => 'O campo :attribute é obrigatório',
    ]);
            
    if($request->get('id') == null){
        $aluno  = new Aluno();
    }else{
        $aluno  = Aluno::Where('id', $request->get('id'))->first();
        // SELECT * FROM chamado WHERE id = $_GET['id'] LIMIT 1
    }
    //pegando os valores e colocando dentro do objetos
    $aluno ->name = $request->get('name');
    $aluno ->matricula = $request->get('matricula');
    $aluno ->email = $request->get('email');
    $aluno ->inicioSemestre = $request->get('inicioSemestre');
    $aluno->password = Hash::make($request->get('password'));
    $aluno->remember_token = $request->get('remember_token');
    $aluno ->instituicao_id = $request->get('instituicao_id');
    $aluno ->turma_id = $request->get('turma_id');
    $aluno ->statusHorasComplementares = 0;


    $aluno ->save();//Salvando objeto

    return $this->listar();

    }

    function excluir(Request $request){

        if($request->get('id') != null){
            $aluno  = Aluno::Where('id', $request->get('id'))->first();
            $aluno ->delete();
            return $this->listar();
        }
    }


    function graficoModalidade(){

        $aluno_id = session('id_aluno');

        if($aluno_id != null){

        //Consulta para agrupar as horas de todas atividades aprovadas em modalidades
        $modalidades = DB::select('SELECT m.name, sum(c.horaAceita) as horaModalidade FROM certificado AS c JOIN aluno_certificado as ac on c.id = ac.certificado_id join alunos as a on a.id = ac.aluno_id JOIN categoria as cat on c.categoria_id = cat.id join modalidades as m on cat.modalidade_id = m.id AND ac.status = 1 AND a.id = '.$aluno_id.'  GROUP by m.name');
        //Traz todas as horas aprovadas agrupadas para o aluno de acordo com a modalidade
        //String que vai receber os dados  do grafico 1
        $string_grafico1 = "";

        //For rodando os dados de forma a pegar os dados dos professores do banco e contar quantas materias eles dão aula
        foreach($modalidades as $modalidade){
            //$id = $modalidade->id;
            $nome = $modalidade->name;
            $hora_Modalidade = $modalidade->horaModalidade;

            //String recebe os dados formando json para o grafico
            $string_grafico1 .="{ 'modalidade' : '" . $nome . "', 'horaModalidade' : ". $hora_Modalidade . "}, ";
        }

        //total de horas aprovadas
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

        return view('layouts.graficoModalidade', array('grafico' => $string_grafico1), ['totalHoras' => $totalHoras, 'totalHorasExternas' =>$totalHorasExternas, 'totalHorasAtingirExternas' => $totalHorasAtingirExternas,'totalHorasInternas' => $totalHorasInternas, 'totalHorasAtingirInternas' => $totalHorasAtingirInternas,'totalHorasAtingir' => $totalHorasAtingir]);
        } else {
            return view('auth.aluno-login');
        }
    }

    function graficoCategoria(){

        $aluno_id = session('id_aluno');

        if($aluno_id != null){
        //Consulta para agrupar as horas de todas atividades aprovadas em modalidades
        $categorias = DB::select('SELECT cat.nome, sum(c.horaAceita) as horaCategoria FROM certificado AS c JOIN aluno_certificado as ac on c.id = ac.certificado_id join alunos as a on a.id = ac.aluno_id JOIN categoria as cat on c.categoria_id = cat.id AND ac.status = 1 AND a.id = '.$aluno_id.'  GROUP by cat.nome');
        //Traz todas as horas aprovadas agrupadas para o aluno de acordo com a modalidade
        //String que vai receber os dados  do grafico 1
        $string_grafico1 = "";

        //For rodando os dados de forma a pegar os dados dos professores do banco e contar quantas materias eles dão aula
        foreach($categorias as $categoria){
            //$id = $modalidade->id;
            $nome = $categoria->nome;
            $hora_Categoria = $categoria->horaCategoria;

            //String recebe os dados formando json para o grafico
            $string_grafico1 .="{ 'categoria' : '" . $nome . "', 'horaCategoria' : ". $hora_Categoria . "}, ";
        }

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

        return view('layouts.graficoCategoria', array('grafico' => $string_grafico1), ['totalHoras' => $totalHoras, 'totalHorasExternas' =>$totalHorasExternas, 'totalHorasAtingirExternas' => $totalHorasAtingirExternas,'totalHorasInternas' => $totalHorasInternas, 'totalHorasAtingirInternas' => $totalHorasAtingirInternas,'totalHorasAtingir' => $totalHorasAtingir]);
        }else {
            return view('auth.aluno-login');
        }
    }

    function aprovar(){

        $aluno_id_listar = session('id_aluno_listar');

        if($aluno_id_listar != null){
            DB::table('alunos')->where('id', $aluno_id_listar)->update(['statusHorasComplementares' => 1]);
        }

        $dados = DB::select('
                SELECT * FROM certificado AS c JOIN aluno_certificado as ac on c.id = ac.certificado_id join alunos as a on a.id = ac.aluno_id AND a.id ='.$aluno_id_listar.'');


        $totalHoras = DB::select('
            SELECT sum(c.horaAceita) as totalHoras FROM certificado AS c JOIN aluno_certificado as ac on c.id = ac.certificado_id join alunos as a on a.id = ac.aluno_id JOIN categoria as cat on c.categoria_id = cat.id AND ac.status = 1 AND a.id ='.$aluno_id_listar);
        //total de horas por curso

        $totalHorasAtingir = DB::select('
           SELECT totalHora as totalHorasAtingir FROM `turma` WHERE id = (SELECT turma_id FROM `alunos` WHERE id ='.$aluno_id_listar.')');

        //total de horas externas aprovadas
        $totalHorasExternas = DB::select('
            SELECT sum(c.horaAceita) as totalHorasExternas FROM certificado AS c JOIN aluno_certificado as ac on c.id = ac.certificado_id join alunos as a on a.id = ac.aluno_id JOIN categoria as cat on c.categoria_id = cat.id AND ac.status = 1 AND instituicao = 1 AND a.id ='.$aluno_id_listar);

        //total de horas externas esperadas
        $totalHorasAtingirExternas = DB::select('
            SELECT CAST(SUM(totalHora* 0.2) AS DECIMAL(10,2)) as totalHorasAtingirExternas FROM `turma`
        WHERE id = (SELECT turma_id FROM `alunos` WHERE id = '.$aluno_id_listar.')');

        //total de horas internas aprovadas
        $totalHorasInternas = DB::select('
            SELECT sum(c.horaAceita) as totalHorasInternas FROM certificado AS c JOIN aluno_certificado as ac on c.id = ac.certificado_id join alunos as a on a.id = ac.aluno_id JOIN categoria as cat on c.categoria_id = cat.id AND ac.status = 1 AND instituicao = 2 AND a.id ='.$aluno_id_listar);

        //total de horas internas esperadas
        $totalHorasAtingirInternas = DB::select('
            SELECT CAST(SUM(totalHora* 0.3) AS DECIMAL(10,2)) as totalHorasAtingirInternas FROM `turma`
        WHERE id = (SELECT turma_id FROM `alunos` WHERE id = '.$aluno_id_listar.')');

        return view('supervisores.listaCertificados', array('certificados'=>$dados), ['totalHoras' => $totalHoras, 'totalHorasExternas' =>$totalHorasExternas, 'totalHorasAtingirExternas' => $totalHorasAtingirExternas,'totalHorasInternas' => $totalHorasInternas, 'totalHorasAtingirInternas' => $totalHorasAtingirInternas,'totalHorasAtingir' => $totalHorasAtingir]);

    }
}
