<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Certificado;
use Barryvdh\DomPDF\Facade as PDF;
use DB;

class PDFController extends Controller
{
    public function pdf(){
    	//$aluno_id = $request->get('id');
    	$certificado_id = 5;

    	$dados = DB::select('
                SELECT * FROM certificado AS c JOIN aluno_certificado as ac on c.id = ac.certificado_id join alunos as a on a.id = ac.aluno_id AND c.id ='.$certificado_id.'');
    	$pdf = PDF::loadView('pdf', ['certificados' => $dados]);
    	return $pdf->download('certificados.pdf');
    }
}
