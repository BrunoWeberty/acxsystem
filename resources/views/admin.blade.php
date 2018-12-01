@extends('layouts.app')

@section('content')
<div class="container">
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
                    <li class="active"><a href="/admin">Home<span style="font-size:16px;" class="pull-right hidden-xs showopacity glyphicon glyphicon-home"></span></a></li>
                    <li class="dropdown">
                      <a href="#" class="dropdown-toggle" data-toggle="dropdown">Alunos<span style="font-size:16px;" class="pull-right hidden-xs showopacity glyphicon glyphicon-user"></span></a>
                      <ul class="dropdown-menu forAnimate" role="menu">
                        <li><a href="/alunoG">Cadastrar</a></li>
                        <li><a href="/alunoG/listagem">Listar</a></li>
                      </ul>
                    </li>
                    <li class="dropdown">
                      <a href="#" class="dropdown-toggle" data-toggle="dropdown">Professores Supervisores<span style="font-size:16px;" class="pull-right hidden-xs showopacity glyphicon glyphicon-user"></span></a>
                      <ul class="dropdown-menu forAnimate" role="menu">
                        <li><a href="/professorSupervisor">Cadastrar</a></li>
                        <li><a href="/professorSupervisor/listagem">Listar</a></li>
                      </ul>
                    </li>
                    <li class="dropdown">
                      <a href="#" class="dropdown-toggle" data-toggle="dropdown">Instituições<span style="font-size:16px;" class="pull-right hidden-xs showopacity glyphicon glyphicon-th-list"></span></a>
                      <ul class="dropdown-menu forAnimate" role="menu">
                        <li><a href="/instituicao">Cadastrar</a></li>
                        <li><a href="/instituicao/listagem">Listar</a></li>
                      </ul>
                    </li>   
                  </ul>
                </div>
              </div>
            </nav>
        </div>
        <div class="col-md-9">
            <div class="card">
                <div class="card-header" style="background: #87CEEB"><b>Administrador</b></div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                            
                        </div>
                    @endif

                    <div class="page-header">
                      <CENTER><h1>Módulo Administrador</h1></CENTER>        
                     </div>

                    @yield("contentA")
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
