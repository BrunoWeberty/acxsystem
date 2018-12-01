@extends("supervisor")

@section("contentS")
  <div class="Container">

       <div class="page-header">
        <CENTER><h3>Listagem de Semestres</h3></CENTER>        
       </div>


         <div>
           <table class="table table-striped table-bordered table-hover table-bordered">
            <!--1-Coloca cores alternadas de linhas-->
            <!--2-Coloca bordas envolta da tabela-->
            <!--3-Coloca efeito hover nas linhas-->
            <!--4-Condensa os espacos dentro da tabela-->
             <thead>
               <tr>
                 <th>Semestre</th>
                 <th>Início do Semestre</th>
                 <th>Fim do Semestre</th>
                 <th>Editar</th>
                 <th>Excluir</th>
               </tr>
             </thead>
             <tbody>
               @foreach($semestres as $row)
               		<tr>
               			<td>{{ $row->nomeS }}</td>
                    <td>{{date('d/m/Y',  strtotime( $row->inicioSemestre ))}}</td>
                    <td>{{date('d/m/Y',  strtotime( $row->fimSemestre ))}}</td>
                    <td>
                      <a href="/semestre?id={{$row->id }}"><span class="glyphicon glyphicon-edit"></span> Editar</a>
                    </td>
                    <td>
                      <a onclick="return confirm('Deseja realmente excluir?');" href="/semestre/excluir?id={{ $row->id }}"><span class="glyphicon glyphicon-remove-sign">Excluir</span></a>
                    </td>
               		</tr>
               @endforeach
             </tbody>

           </table>

           
         </div>

     </div> 

@stop