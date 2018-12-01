<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;

class AlunoController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:aluno');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $id = Auth::id();
        session(['id_aluno' => $id]);
        

        $aluno_id = session('id_aluno');
        //array professor disciplina
        //$totalHorasAtingir = array()
        if($aluno_id != null){
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

        return view('aluno', ['totalHoras' => $totalHoras, 'totalHorasExternas' =>$totalHorasExternas, 'totalHorasAtingirExternas' => $totalHorasAtingirExternas,'totalHorasInternas' => $totalHorasInternas, 'totalHorasAtingirInternas' => $totalHorasAtingirInternas,'totalHorasAtingir' => $totalHorasAtingir]);
        }else {
            return view('auth.aluno-login');
        }
    }
}
