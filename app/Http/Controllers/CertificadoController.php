<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Certificado;
use App\Categoria;
use App\Semestre;
use App\Modalidade;
use App\Aluno_Certificado;
use Carbon\Carbon;
use Carbon\CarbonInterval;
use DB;
use Storage;
use Barryvdh\DomPDF\Facade as PDF;

class CertificadoController extends Controller
{
    function index(Request $request){
    	if($request->get('id') == null){
    		$certificado = new Certificado();
    	} else {
    		$certificado = Certificado::Where('id', $request->get('id'))->first();
    	}
    	//posicoes.cadastro: nome da view, vai estar em Resources\viewa\categorias.blade.php
    	//'posicao' é o nome do objeto que será acessado na view
    	// $posicao é o ojbeto passado do controller pra view        

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

        }

        $statusHorasComplementares = DB::select('
            SELECT statusHorasComplementares FROM `alunos` WHERE id ='.$aluno_id);

        if($statusHorasComplementares[0]->statusHorasComplementares == 0){

    	return view('certificados.cadastro', ['totalHoras' => $totalHoras, 'totalHorasExternas' =>$totalHorasExternas, 'totalHorasAtingirExternas' => $totalHorasAtingirExternas,'totalHorasInternas' => $totalHorasInternas, 'totalHorasAtingirInternas' => $totalHorasAtingirInternas,'totalHorasAtingir' => $totalHorasAtingir], array('certificados' => $certificado, 'categorias' => Categoria::All(), 'semestres' => Semestre::All(), 'modalidades' => Modalidade::All()));
        }else {
            return view('certificados.aviso', ['totalHoras' => $totalHoras, 'totalHorasExternas' =>$totalHorasExternas, 'totalHorasAtingirExternas' => $totalHorasAtingirExternas,'totalHorasInternas' => $totalHorasInternas, 'totalHorasAtingirInternas' => $totalHorasAtingirInternas,'totalHorasAtingir' => $totalHorasAtingir]);
        }
    }

    function salvar(Request $request) {

        //verificar se data de semestre é depois da data de matricula de aluno
        $aluno_id = session('id_aluno');

        $dataIngresso = DB::select('
            SELECT inicioSemestre FROM `alunos` WHERE id ='.$aluno_id);

        $dataVerify = $dataIngresso[0]->inicioSemestre; 

    	$validatedData = $request->validate([
            "nomeC" => "required|max:100",
            "instituicao" => "required",
            "entidadePromotora" => "required|max:100",
            "dataConclusao" => "required|after:$dataVerify",
            "cargaHoraria" => "required|numeric",
            "arquivo" => "required",
            "relatorio" => "required|max:400",
            "categoria_id" => "required",
            "semestre_id" => "required",
        ], [
            'required' => 'O campo :attribute é obrigatório',
            'after' => 'A :attribute do certificado não pode ser anterior a data de ingresso na instituição consulte o Regulamento', 
        ]




);

    	if($request->get('id') == null){
    		$certificado = new Certificado();
    	}else {
    		$certificado = Certificado::Where('id', $request->get('id'))->first();
    	}
    	//Atribuição de todos os parametros
    	$certificado->nomeC = $request->get('nomeC');
        $certificado->instituicao = $request->get('instituicao');
    	$certificado->entidadePromotora = $request->get('entidadePromotora');
        $certificado->categoria_id = $request->get('categoria_id');
        $certificado->semestre_id = $request->get('semestre_id');
    	$certificado->dataConclusao = $request->get('dataConclusao');
        
    	$certificado->cargaHoraria = (float) $request->get('cargaHoraria');



        $porcentagem = DB::select('
            SELECT CAST(SUM(limiteChs/100) AS DECIMAL(10,2)) as porcentagemCategoria from categoria WHERE id ='.$certificado->categoria_id.' limit 1');

        if($certificado->cargaHoraria > 75){
            $certificado->horaAceita = 37.5;
        }else{

            $certificado->horaAceita = $certificado->cargaHoraria * $porcentagem[0]->porcentagemCategoria;
        }
 /*
         $string = "Um teste";
         $string = str_replace(" ","-",$string);
         echo $string;
*/


    	if($request->hasFile('arquivo')){//getClientOriginalName pega o nome do upload para colocar no objet que sera persistido no banco
        //$certificado->arquivo = $request->file('arquivo')->getClientOriginalName();
        //testar
        $extension = $request->file('arquivo')->extension();
        $name = uniqid(date('HisYmd'));

        $certificado->arquivo = $name.".".$extension;

        //storeAs recebe 3 parametros: 
        //1. nome a ser salvo(mesmo nome do objeto),
        //2.pasta a salvar(null salvar direto na raiz),
        //3. disco(usaremos o public)
        $request->file('arquivo')->storeAs($certificado->arquivo, null, 'public');//Salva o arquivo dentro da pasta storage

        }else{
            $certificado->arquivo = null;//Se não tiver arquivo ele seta null no banco
        }

        
        
        $certificado->relatorio = $request->get('relatorio');

        //tras do banco o limite de carga horaria da categoria setada
        /*$limiteChs = DB::select('
                SELECT limiteChs FROM categoria AS c Where c.id ='.$categoria_id);
        //tras do banco o limite de certificados da categoria setada
        $limiteCertificados = DB::select('
                SELECT limiteCertificados FROM categoria AS c Where c.id ='.$categoria_id);

        //tras quantidade de certificados cadastrados
        $qtdCategoria = DB::select('
                SELECT count('.$categoria_id.') FROM certificado';
        
        if($limiteCertificados == null){
        	if ($certificado->cargaHoraria > $limiteChs) {
        		$certificado->cargaHoraria = $limiteChs;
        	}
        }*/

        
/*
        if(strtotime($dataIngresso) < strtotime($certificado->dataConclusao)){
            //emitir mensagem pro aluno de que o certificado so vale apos data de ingresso na faculdade
        }*/

        //Validar porcentagem de instituição interna e externa



        //Tras a quantidade de horas aprovadas Internas
        $totalHorasInstituicaoInterna = DB::select('
            SELECT sum(c.horaAceita) as totalHoras FROM certificado AS c JOIN aluno_certificado as ac on c.id = ac.certificado_id join alunos as a on a.id = ac.aluno_id JOIN categoria as cat on c.categoria_id = cat.id AND ac.status = 1 AND c.instituicao = 1 AND a.id ='.$aluno_id);

        //Tras a quantidade de horas aprovadas Externas
        $totalHorasInstituicaoExterna = DB::select('
            SELECT sum(c.horaAceita) as totalHoras FROM certificado AS c JOIN aluno_certificado as ac on c.id = ac.certificado_id join alunos as a on a.id = ac.aluno_id JOIN categoria as cat on c.categoria_id = cat.id AND ac.status = 1 AND c.instituicao = 2 AND a.id ='.$aluno_id);     


    	//Persite os dados
    	$certificado->save();

        $aluno_Certificado = new Aluno_Certificado();
        $aluno_Certificado->certificado_id = Certificado::max('id');
        $aluno_Certificado->aluno_id = session('id_aluno');
        $aluno_Certificado->status = 0;

        $aluno_Certificado->save();
        
    	//Redireciona para a lista
    	return $this->listar();
    }

    function excluir(Request $request){
    	if($request->get('id') != null){
    		//Destroy semelhante ao delete, mas exclui pela chave primaria
    		Certificado::destroy($request->get('id'));
    	}
    	return $this->listar();
    }

    function listar(){
        $aluno_id = session('id_aluno');

        if($aluno_id != null){

        $dados = DB::select('
                SELECT * FROM certificado AS c JOIN aluno_certificado as ac on c.id = ac.certificado_id join alunos as a on a.id = ac.aluno_id JOIN categoria as cat on c.categoria_id = cat.id AND a.id ='.$aluno_id);   

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

    	return view('certificados.lista', ['totalHoras' => $totalHoras, 'totalHorasExternas' =>$totalHorasExternas, 'totalHorasAtingirExternas' => $totalHorasAtingirExternas,'totalHorasInternas' => $totalHorasInternas, 'totalHorasAtingirInternas' => $totalHorasAtingirInternas,'totalHorasAtingir' => $totalHorasAtingir], array('certificados' => $dados));
        }else{
            return view('auth.aluno-login');
        }
    }

    function busca_modalidade(Request $request){

        if($request->get('id') != null){//se entra aqui e pq recebeu id
            
            $categoria = DB::select('SELECT * FROM categoria WHERE modalidade_id ='.$request->post('id'));
            //return $categorias;
            return $categoria;
        }

    }

    function download(Request $request){

        $headers = [
              'Content-Type' => 'application/pdf',
           ];
           
        //da problema se o arquivo tive espaço no nome ao salvar, retirar espaços
           
        $file_path = public_path()."\\storage\\".$request->get('arquivo');
        //storage_path('app\\public\\'.$request->get('arquivo'));
        //storage_path('app\\public\\'.$request->get('arquivo'));
        //public_path()."\\storage\\".$request->get('arquivo');
        //storage_path('app\\public\\'.$request->get('arquivo'));
        //Storage::url($request->get('arquivo'));

        

        return response()->file($file_path);
        //return view('pdf', array('certificados' => $dados, 'categorias' => $categorias, 'semestres' => $semestres));

    }

    public function pdf(Request $request){
        //$aluno_id = $request->get('id');
        $certificado_id = $request->get('id');

        $dados = DB::select('
                SELECT * FROM certificado AS c JOIN aluno_certificado as ac on c.id = ac.certificado_id join alunos as a on a.id = ac.aluno_id AND c.id ='.$certificado_id.'');

        $categorias = Categoria::All();

        $semestres= Semestre::All();

        //$pdf = PDF::loadView('pdf', ['certificados' => $dados, 'categorias' => $categorias, 'semestres' => $semestres]);
        //return $pdf->download('certificados.pdf');

        return view('pdf', array('certificados' => $dados, 'categorias' => $categorias, 'semestres' => $semestres));
    }

    function validar(Request $request){

        $aluno_id_listar = session('id_aluno_listar');

        if($aluno_id_listar != null){
            if ($request->get('id') != null) { // valido se eu tenho o campo ID na request
                $id = $request->get('id');  // crio e atribuo uma variavel ID
                /*
                Aluno_Certificado::where('certificado_id', '$id') // estou fazendo um UPDATE com a condição do WHERE do id igual a request que eu to recebo
                ->update(['status' => 1]);  /// e atribuo a figura igual a 1 no campo*/
                DB::table('aluno_certificado')->where('certificado_id', $id)->update(['status' => 1]);

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

                //return redirect()->action('ProfessorSupervisorController@listarAluno');   // aqui eu somente redireciono para a view de listagem pra poder atualizar a pagina
            }
        }else{//se o sistema perde referencia do aluno ele volta pra lista de alunos
            $dados = DB::select('SELECT a.name, a.id FROM alunos as a INNER JOIN aluno_certificado as ac on ac.aluno_id = a.id GROUP BY a.name, a.id');

        
            return view('supervisores.listaAluno', array('alunos'=>$dados));
        }

    }

    function invalidar(Request $request){
        $aluno_id_listar = session('id_aluno_listar');

        if($aluno_id_listar != null){
            if ($request->get('id') != null) { // valido se eu tenho o campo ID na request
                $id = $request->get('id');  // crio e atribuo uma variavel ID
                /*
                Aluno_Certificado::where('certificado_id', '$id') // estou fazendo um UPDATE com a condição do WHERE do id igual a request que eu to recebo
                ->update(['status' => 2]);  /// e atribuo a figura igual a 1 no campo */
                DB::table('aluno_certificado')->where('certificado_id', $id)->update(['status' => 2]);

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

                //return redirect()->action('ProfessorSupervisorController@listarAluno');   // aqui eu somente redireciono para a view de listagem pra poder atualizar a pagina
            }
        }else{//se o sistema perde referencia do aluno ele volta pra lista de alunos
            $dados = DB::select('SELECT a.name, a.id FROM alunos as a INNER JOIN aluno_certificado as ac on ac.aluno_id = a.id GROUP BY a.name, a.id');

        
            return view('supervisores.listaAluno', array('alunos'=>$dados));
        }
    }


    /*
    function qtd_horas(){
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

        return view('certificados.totalHoras', ['totalHoras' => $totalHoras, 'totalHorasAtingir' => $totalHorasAtingir]);

        }else{
            return view('aluno');
        }
    }
*/

}
