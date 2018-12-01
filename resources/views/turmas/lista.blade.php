@extends("supervisor")

@section("contentS")
  <div class="Container">

       <div class="page-header">
        <CENTER><h3>Listagem de Turmas</h3></CENTER>        
       </div>


         <div>
           <table class="table table-striped table-bordered table-hover table-bordered">
            <!--1-Coloca cores alternadas de linhas-->
            <!--2-Coloca bordas envolta da tabela-->
            <!--3-Coloca efeito hover nas linhas-->
            <!--4-Condensa os espacos dentro da tabela-->
             <thead>
               <tr>
                 <th>Nome</th>
                 <th>Curso</th>
                 <th>Instituição</th>
                 <th>Professor Supevisor</th>
                 <th>Modelo</th>
                 <th>Código</th>
                 <th>Editar</th>
                 <th>Excluir</th>
               </tr>
             </thead>
             <tbody>
               @foreach($turmas as $row)
                  <tr>
                    <td>{{ $row->nameT }}</td>
                    <td>{{ $row->curso }}</td>
                    <td>{{ $row->nome }}</td>
                    <td>{{ $row->name }}</td>
                    <td>{{ $row->nomeM }}</td>
                    <td>{{ $row->codigo}}</td>
                    <td>
                      <a href="/turma?id={{$row->id }}"><span class="glyphicon glyphicon-edit"></span> Editar</a>
                    </td>
                    <td>
                      <a onclick="return confirm('Deseja realmente excluir?');" href="/turma/excluir?id={{ $row->id }}"><span class="glyphicon glyphicon-remove-sign">Excluir</span></a>
                    </td>
                  </tr>
               @endforeach
             </tbody>

           </table>

           
         </div>

     </div> 

@stop