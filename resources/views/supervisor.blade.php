@extends('layouts.app')

@section('content')
<div style="width: 100%;" class="container" >
    <div class="row justify-content-center">
        <div class="col-md-3">
            <nav class="navbar navbar-default sidebar" role="navigation">
                <div class="container-fluid">
                <div class="navbar-header">
                  <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-sidebar-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                  </button>      
                </div>
                <div class="collapse navbar-collapse" id="bs-sidebar-navbar-collapse-1">
                  <ul class="nav navbar-nav">

                    <li class="active"><a href="/supervisor">Home<span style="font-size:16px;" class="pull-right hidden-xs showopacity glyphicon glyphicon-home"></span></a></li>
                    <li class="dropdown">
                      <a href="#" class="dropdown-toggle" data-toggle="dropdown">Gerenciar Certificados das Atividades Complementares<span style="font-size:16px;" class="pull-right hidden-xs showopacity glyphicon glyphicon-th-list"></span></a>
                      <ul class="dropdown-menu forAnimate" role="menu">
                        <li><a href="/professorSupervisor/listagemAluno">Listar alunos em Análise</a></li>
                        <li><a href="/professorSupervisor/listagemAlunoAprovados">Listar alunos Aprovados</a></li>
                        <!--<li><a href="/semestre/listagem">Listar</a></li>-->
                      </ul>
                    </li>
                    <li class="dropdown">
                      <a href="#" class="dropdown-toggle" data-toggle="dropdown">Modalidades<span style="font-size:16px;" class="pull-right hidden-xs showopacity glyphicon glyphicon-th-list"></span></a>
                      <ul class="dropdown-menu forAnimate" role="menu">
                        <li><a href="/modalidade">Cadastrar</a></li>
                        <li><a href="/modalidade/listagem">Listar</a></li>
                      </ul>
                    </li>
                    <li class="dropdown">
                      <a href="#" class="dropdown-toggle" data-toggle="dropdown">Categorias<span style="font-size:16px;" class="pull-right hidden-xs showopacity glyphicon glyphicon-th-list"></span></a>
                      <ul class="dropdown-menu forAnimate" role="menu">
                        <li><a href="/categoria">Cadastrar</a></li>
                        <li><a href="/categoria/listagem">Listar</a></li>
                      </ul>
                    </li>
                    
                    <li class="dropdown">
                      <a href="#" class="dropdown-toggle" data-toggle="dropdown">Modelos<span style="font-size:16px;" class="pull-right hidden-xs showopacity glyphicon glyphicon-th-list"></span></a>
                      <ul class="dropdown-menu forAnimate" role="menu">
                        <li><a href="/modelo">Cadastrar</a></li>
                        <li><a href="/modelo/listagem">Listar</a></li>
                      </ul>
                    </li>
                    <li class="dropdown">
                      <a href="#" class="dropdown-toggle" data-toggle="dropdown">Turmas<span style="font-size:16px;" class="pull-right hidden-xs showopacity glyphicon glyphicon-th-list"></span></a>
                      <ul class="dropdown-menu forAnimate" role="menu">
                        <li><a href="/turma">Criar</a></li>
                        <li><a href="/turma/listagem">Listar</a></li>
                      </ul>
                    </li>

                    <li class="dropdown">
                      <a href="#" class="dropdown-toggle" data-toggle="dropdown">Gerenciar Semestres das Atividades Complementares<span style="font-size:16px;" class="pull-right hidden-xs showopacity glyphicon glyphicon-th-list"></span></a>
                      <ul class="dropdown-menu forAnimate" role="menu">
                        <li><a href="/semestre">Criar</a></li>
                        <li><a href="/semestre/listagem">Listar</a></li>
                      </ul>
                    </li>

                    
                    <!--
                    <li class="dropdown">
                      <a href="#" class="dropdown-toggle" data-toggle="dropdown">Usuarios<span style="font-size:16px;" class="pull-right hidden-xs showopacity glyphicon glyphicon-user"></span></a>
                      <ul class="dropdown-menu forAnimate" role="menu">
                        <li><a href="{{URL::to('createusuario')}}">Crear</a></li>
                        <li><a href="#">Modificar</a></li>
                        <li><a href="#">Reportar</a></li>
                        <li class="divider"></li>
                        <li><a href="#">Separated link</a></li>
                        <li class="divider"></li>
                        <li><a href="#">Informes</a></li>
                      </ul>
                    </li>  -->        
                           
                  </ul>
                </div>
              </div>
            </nav>
        </div>
        <div class="col-md-9">
            <div class="card">
                <div class="card-header" style="background: #87CEEB"><b>Professor Supervisor</b></div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>

                    @endif
                    <div class="page-header">
                      <CENTER><h1>Módulo Professor Supervisor</h1></CENTER>        
                     </div>
                    @yield("contentS")
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
