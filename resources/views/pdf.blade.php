<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Certificado</title>
	
	<!-- Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <!-- JQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
	<div class="container-fluid">
		<div class="page-header">
                <CENTER><h2>Informações do Certificado</h2></CENTER>        
               </div>
	<table class="table table-striped table-bordered">

		@foreach($certificados as $c)
		<tr><th>Nome do Aluno: </th> <td>{{$c->name}}</td></tr>
		<tr><th>Nome do Certificado: </th> <td>{{$c->nomeC}}</td></tr>
		@foreach($categorias as $row)
		@if($row->id == $c->categoria_id)
		<tr><th>Categoria: </th> <td>{{$row->nome}}</td></tr>              
        @endif
        @endforeach
		
        @foreach($semestres as $row)
		@if($row->id == $c->semestre_id)
		<tr><th>Semestre: </th> <td>{{$row->nomeS}}</td></tr>              
        @endif
        @endforeach

		<tr><th>Entidade Promotora: </th> <td>{{$c->entidadePromotora}}</td></tr>
		<tr><th>Date de Conclusão: </th> <td>{{date('d/m/Y',  strtotime( $c->dataConclusao ))}}</td></tr>
		<tr><th>Carga Horária: </th> <td>{{$c->cargaHoraria}} hora(s)</td></tr>
		<tr><th>Relatório: </th> <td align='justify'>{{$c->relatorio}}</td></tr>
		<br>
		@endforeach
	</table>
	</div>
</body>
</html>