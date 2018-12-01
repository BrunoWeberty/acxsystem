@extends("supervisor")

@section("contentS")
  <div class="Container">

       <div class="page-header">
        <CENTER><h3>Listagem de Alunos com horas complementares completas</h3></CENTER>        
       </div>


         <div>
           <table class="table table-striped table-bordered table-hover table-bordered">
            <!--1-Coloca cores alternadas de linhas-->
            <!--2-Coloca bordas envolta da tabela-->
            <!--3-Coloca efeito hover nas linhas-->
            <!--4-Condensa os espacos dentro da tabela-->
             <thead>
               <tr>
                 <th>Matricula</th>
                 <th>Aluno</th>
               </tr>
             </thead>
             <tbody>
               @foreach($alunos as $row)
               		<tr>
                    <td>{{ $row->matricula }}</td>
               			<td>{{ $row->name }}</td>
               		</tr>
               @endforeach
             </tbody>

           </table>

           
         </div>

     </div> 

@stop