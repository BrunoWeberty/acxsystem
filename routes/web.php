<?php

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

//Users
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/users/logout', 'Auth\LoginController@userLogout')->name('user.logout');

	//Admin
	Route::prefix('admin')->group(function(){
		Route::get('/login', 'Auth\AdminLoginController@showLoginForm')->name('admin.login');
		Route::post('/login', 'Auth\AdminLoginController@login')->name('admin.login.submit');
		Route::get('/', 'AdminController@index')->name('admin.dashboard');
		Route::get('/logout', 'Auth\AdminLoginController@logout')->name('admin.logout');
	//Rotas de redefinição de senha
		Route::post('/password/email', 'Auth\AdminForgotPasswordController@sendResetLinkEmail')->name('admin.password.email');
		  Route::get('/password/reset', 'Auth\AdminForgotPasswordController@showLinkRequestForm')->name('admin.password.request');
		  Route::post('/password/reset', 'Auth\AdminResetPasswordController@reset');
		  Route::get('/password/reset/{token}', 'Auth\AdminResetPasswordController@showResetForm')->name('admin.password.reset');
	});

	//Aluno
	Route::prefix('aluno')->group(function(){
		Route::get('/login', 'Auth\AlunoLoginController@showLoginForm')->name('aluno.login');
		Route::post('/login', 'Auth\AlunoLoginController@login')->name('aluno.login.submit');
		Route::get('/', 'AlunoController@index')->name('aluno.dashboard');
		Route::get('/logout', 'Auth\AlunoLoginController@logout')->name('aluno.logout');

		//Rotas de redefinição de senha
		Route::post('/password/email', 'Auth\AlunoForgotPasswordController@sendResetLinkEmail')->name('aluno.password.email');
		  Route::get('/password/reset', 'Auth\AlunoForgotPasswordController@showLinkRequestForm')->name('aluno.password.request');
		  Route::post('/password/reset', 'Auth\AlunoResetPasswordController@reset');
		  Route::get('/password/reset/{token}', 'Auth\AlunoResetPasswordController@showResetForm')->name('aluno.password.reset');
			});

	//Supervisor
	Route::prefix('supervisor')->group(function(){
		Route::get('/login', 'Auth\SupervisorLoginController@showLoginForm')->name('supervisor.login');
		Route::post('/supervisor', 'Auth\SupervisorLoginController@login')->name('supervisor.login.submit');
		Route::get('/', 'SupervisorController@index')->name('supervisor.dashboard');
		Route::get('/logout', 'Auth\SupervisorLoginController@logout')->name('supervisor.logout');

		//Rotas de redefinição de senha
		Route::post('/password/email', 'Auth\SupervisorForgotPasswordController@sendResetLinkEmail')->name('supervisor.password.email');
			  Route::get('/password/reset', 'Auth\SupervisorForgotPasswordController@showLinkRequestForm')->name('supervisor.password.request');
			  Route::post('/password/reset', 'Auth\SupervisorResetPasswordController@reset');
			  Route::get('/password/reset/{token}', 'Auth\SupervisorResetPasswordController@showResetForm')->name('supervisor.password.reset');
	});

//Modalidade
Route::get('/modalidade', 
'ModalidadesController@index');

Route::post('/modalidade/salvar',
'ModalidadesController@salvar');

Route::get('/modalidade/listagem',
'ModalidadesController@listar');

Route::get('/modalidade/excluir',
 'ModalidadesController@excluir');

//Categoria
Route::get('/categoria', 
'CategoriaController@index');

Route::post('/categoria/salvar',
'CategoriaController@salvar');

Route::get('/categoria/listagem',
'CategoriaController@listar');

Route::get('/categoria/excluir',
 'CategoriaController@excluir');

//Modelo
Route::get('/modelo', 
'ModeloController@index');

Route::post('/modelo/salvar',
'ModeloController@salvar');

Route::get('/modelo/listagem',
'ModeloController@listar');

Route::get('/modelo/excluir',
 'ModeloController@excluir');

//Turma
Route::get('/turma', 
'TurmaController@index');

Route::post('/turma/salvar',
'TurmaController@salvar');

Route::get('/turma/listagem',
'TurmaController@listar');

Route::get('/turma/excluir',
 'TurmaController@excluir');

//ProfessorSupervisor
Route::get('/professorSupervisor', 
'ProfessorSupervisorController@index');

Route::post('/professorSupervisor/salvar',
'ProfessorSupervisorController@salvar');

Route::get('/professorSupervisor/listagem',
'ProfessorSupervisorController@listar');

Route::get('/professorSupervisor/listagemAluno',
'ProfessorSupervisorController@listarAluno');

Route::get('/professorSupervisor/listagemAlunoAprovados',
'ProfessorSupervisorController@listarAlunoAprovados');

Route::get('/professorSupervisor/listarCertificados',
'ProfessorSupervisorController@listarCertificados');

Route::get('/professorSupervisor/excluir',
 'ProfessorSupervisorController@excluir');

//Aluno
Route::get('/alunoG', 
'AlunoGerenciamentoController@index');

Route::post('/alunoG/salvar',
'AlunoGerenciamentoController@salvar');

Route::get('/alunoG/listagem',
'AlunoGerenciamentoController@listar');

Route::get('/alunoG/excluir',
 'AlunoGerenciamentoController@excluir');


Route::get('/alunoG/aprovar',
 'AlunoGerenciamentoController@aprovar');

Route::get('/alunoG/gerar-graficos/Modalidade',
 'AlunoGerenciamentoController@graficoModalidade');

Route::get('/alunoG/gerar-graficos/Categoria',
 'AlunoGerenciamentoController@graficoCategoria');

//Instituicao
Route::get('/instituicao', 
'InstituicaoController@index');

Route::post('/instituicao/salvar',
'InstituicaoController@salvar');

Route::get('/instituicao/listagem',
'InstituicaoController@listar');

Route::get('/instituicao/excluir',
 'InstituicaoController@excluir');

//Semestres
Route::get('/semestre', 
'SemestreController@index');

Route::post('/semestre/salvar',
'SemestreController@salvar');

Route::get('/semestre/listagem',
'SemestreController@listar');

Route::get('/semestre/excluir',
 'SemestreController@excluir');

//Certificados
Route::get('/certificado', 
'CertificadoController@index');

Route::post('/certificado/salvar',
'CertificadoController@salvar');

Route::get('/certificado/listagem',
'CertificadoController@listar');
/*
Route::get('/certificado/horas', 
'CertificadoController@qtd_horas');
*/
Route::get('/certificado/excluir',
 'CertificadoController@excluir');

Route::get('/certificado/download', 
'CertificadoController@download');

Route::get('/certificado/pdf', 
'CertificadoController@pdf');

Route::get('pdf', 'PDFController@pdf');

Route::get('/certificado/validar',
'CertificadoController@validar');

Route::get('/certificado/invalidar',
'CertificadoController@invalidar');

Route::get('/ajax-categoria', function(){
	$modalidade_id = Input::get('modalidade_id');

	$categorias = Categoria::where('id','=', $modalidade_id)->get();

	return Response::json($categorias); 
});

//rota para busca_modalidade
Route::get('/busca_modalidade', 'CertificadoController@busca_modalidade');
//Baixar pdf
