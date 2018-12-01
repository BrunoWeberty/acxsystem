@extends("supervisor")

@section("contentS")
  <div class="Container">

       <div class="page-header">
        <CENTER><h3>Listagem de Alunos com certificados Cadastrados</h3></CENTER>        
       </div>


         <div>
           <table class="table table-striped table-bordered table-hover table-bordered">
            <!--1-Coloca cores alternadas de linhas-->
            <!--2-Coloca bordas envolta da tabela-->
            <!--3-Coloca efeito hover nas linhas-->
            <!--4-Condensa os espacos dentro da tabela-->
             <thead>
               <tr>
                 <th>Aluno</th>
                 <th>Visualizar certificados</th>
               </tr>
             </thead>
             <tbody>
               @foreach($alunos as $row)
               		<tr>
               			<td>{{ $row->name }}</td>
                    <td>
                      <a href="/professorSupervisor/listarCertificados?id={{ $row->id }}"><span class="glyphicon glyphicon-remove-sign">Listar</span></a>
                    </td>
               		</tr>
               @endforeach
             </tbody>

           </table>

           
         </div>

     </div> 

@stop