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
                    <li class="active"><a href="/aluno">Home<span style="font-size:16px;" class="pull-right hidden-xs showopacity glyphicon glyphicon-home"></span></a></li>
                    <li class="dropdown">
                      <a href="#" class="dropdown-toggle" data-toggle="dropdown">Atividades Complementares <span style="font-size:16px;" class="pull-right hidden-xs showopacity glyphicon glyphicon-file"></span></a>
                      <ul class="dropdown-menu forAnimate" role="menu">
                        <li><a href="/certificado">Cadastrar</a></li>
                        <li><a href="/certificado/listagem">Listar</a></li>
                      </ul>
                    </li>  
                    <li class="dropdown">
                      <a href="#" class="dropdown-toggle" data-toggle="dropdown">Gráficos<span style="font-size:16px;" class="pull-right hidden-xs showopacity glyphicon glyphicon-stats"></span></a>
                      <ul class="dropdown-menu forAnimate" role="menu">
                        <li><a href="/alunoG/gerar-graficos/Modalidade">Horas por Modalidade</a></li>
                        <li><a href="/alunoG/gerar-graficos/Categoria">Horas por Categoria</a></li>
                      </ul>
                    </li>          
                  </ul>
                </div>
              </div>
            </nav>
        </div>

        <div class="col-md-9">
            <div class="card">
                <div class="card-header" style="background: #87CEEB"><b>Aluno</b></div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div class="page-header">
                      <CENTER><h1>Módulo Aluno</h1></CENTER>        
                     </div>
                     <div class="page-header">
                      <CENTER><h3>Quantidade de Horas</h3></CENTER>        
                     </div>


                       <div>
                         <table class="table table-striped table-bordered table-hover table-bordered">
                          <!--1-Coloca cores alternadas de linhas-->
                          <!--2-Coloca bordas envolta da tabela-->
                          <!--3-Coloca efeito hover nas linhas-->
                          <!--4-Condensa os espacos dentro da tabela-->
                           <thead>
                             <tr>
                               <th>Total de horas aprovadas</th>
                               <th>Quantidade de horas requeridas</th>
                             </tr>
                           </thead>
                           <tbody>
                            <tr>

                              @if($totalHoras[0]->totalHoras > $totalHorasAtingir[0]->totalHorasAtingir)
                                  <td align="center" style="background: #00FF7F;"><b>{{ $totalHoras[0]->totalHoras }}</b></td>
                              @else
                                  <td align="center" style="background: #FF6347;"><b>{{ $totalHoras[0]->totalHoras }}</b></td>
                              @endif
                                  <td align="center">{{ $totalHorasAtingir[0]->totalHorasAtingir}}</td>

                             </tr>
                           </tbody>
                           <thead>
                             <tr>
                               <th>Total de horas externas aprovadas</th>
                               <th>Quantidade de horas externas requeridas</th>
                             </tr>
                           </thead>
                           <tbody>
                            <tr>
@if($totalHorasExternas[0]->totalHorasExternas > $totalHorasAtingirExternas[0]->totalHorasAtingirExternas)
                                  <td align="center" style="background: #00FF7F;"><b>{{ $totalHorasExternas[0]->totalHorasExternas }}</b></td>
@else
                                  <td align="center" style="background: #FF6347;"><b>{{ $totalHorasExternas[0]->totalHorasExternas }}</b></td>
@endif
                                  <td align="center">{{ $totalHorasAtingirExternas[0]->totalHorasAtingirExternas}}</td>

                             </tr>
                           </tbody>
                           <thead>
                             <tr>
                               <th>Total de horas internas aprovadas</th>
                               <th>Quantidade de horas internas requeridas</th>
                             </tr>
                           </thead>
                           <tbody>
                            <tr>
@if($totalHorasInternas[0]->totalHorasInternas > $totalHorasAtingirInternas[0]->totalHorasAtingirInternas)
  <td align="center" style="background: #00FF7F;"><b>{{ $totalHorasInternas[0]->totalHorasInternas }}</b></td>
@else
  <td align="center" style="background: #FF6347;"><b>{{ $totalHorasInternas[0]->totalHorasInternas }}</b></td>
@endif                              

         <td align="center">{{ $totalHorasAtingirInternas[0]->totalHorasAtingirInternas}}</td>

                             </tr>
                           </tbody>
                           </table>

                           
                         </div>
                    @yield("contentAL")

            </div>
        </div>
    </div>
</div>
@endsection
