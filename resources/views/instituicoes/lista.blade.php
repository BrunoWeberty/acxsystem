@extends("admin")

@section("contentA")
  <div class="Container">

       <div class="page-header">
        <CENTER><h3>Listagem de Instituições</h3></CENTER>        
       </div>


         <div>
           <table class="table table-striped table-bordered table-hover table-bordered">
            <!--1-Coloca cores alternadas de linhas-->
            <!--2-Coloca bordas envolta da tabela-->
            <!--3-Coloca efeito hover nas linhas-->
            <!--4-Condensa os espacos dentro da tabela-->
             <thead>
               <tr>
                 <th>Instituições</th>
                 <th>Localidade</th>
                 <th>Editar</th>
                 <th>Excluir</th>
               </tr>
             </thead>
             <tbody>
               @foreach($instituicoes as $row)
               		<tr>
               			<td>{{ $row->nome }}</td>
                    <td>{{ $row->localidade }}</td>

                    <td>
                      <a href="/instituicao?id={{$row->id }}"><span class="glyphicon glyphicon-edit"></span> Editar</a>
                    </td>
                    <td>
                      <a onclick="return confirm('Deseja realmente excluir?');" href="/instituicao/excluir?id={{ $row->id }}"><span class="glyphicon glyphicon-remove-sign">Excluir</span></a>
                    </td>
               		</tr>
               @endforeach
             </tbody>

           </table>

           
         </div>

     </div> 

@stop