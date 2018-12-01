@extends("admin")

@section("contentA")
  <div class="Container">

       <div class="page-header">
        <CENTER><h3>Listagem de Professores Supervisores</h3></CENTER>        
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
                 <th>Matricula</th>
                 <th>Instituição que leciona</th>
                 <th>E-mail</th>
                 <th>Editar</th>
                 <th>Excluir</th>
               </tr>
             </thead>
             <tbody>
               @foreach($supervisores as $row)
                  <tr>
                    <td>{{ $row->name }}</td>
                    <td>{{ $row->matricula }}</td>
                    <td>{{ $row->nome }}</td>
                    <td>{{ $row->email }}</td>
                    <td>
                      <a href="/professorSupervisor?id={{$row->id }}"><span class="glyphicon glyphicon-edit"></span> Editar</a>
                    </td>
                    <td>
                      <a onclick="return confirm('Deseja realmente excluir?');" href="/professorSupervisor/excluir?id={{ $row->id }}"><span class="glyphicon glyphicon-remove-sign">Excluir</span></a>
                    </td>
                  </tr>
               @endforeach
             </tbody>

           </table>

           
         </div>

     </div> 

@stop